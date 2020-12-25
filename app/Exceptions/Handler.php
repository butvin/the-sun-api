<?php

namespace App\Exceptions;

use Throwable;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Common required headers.
     *
     * @var array|string[]
     */
    protected array $commonHeaders = [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
        'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, x-access-token, X-Butvin-Header',
        'Access-Control-Allow-Credentials' => 'true',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $e
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        $data = [
            'msg' => null,
            'success' => false,
            'meta' => [
                'origin_msg' => null,
                'origin_code' => null,
                'origin_exception' => null,
            ],
        ];

        if ($e instanceof ModelNotFoundException) {
            $data['msg'] = 'no result with id '.$e->getIds()[0];
            $data['meta']['model'] = $e->getModel();
            $data['meta']['origin_msg'] = $e->getMessage();
            $data['meta']['origin_code'] = $e->getCode();
            $data['meta']['origin_exception'] = get_class($e);
            $data['meta']['ids'] = $e->getIds();

            return response()->json($data, 200, $this->commonHeaders);
        }

        if ($e instanceof HttpException) {

            if ($e instanceof NotFoundHttpException) {
                $data['msg'] = 'bad request';
                $data['meta']['origin_msg'] = $e->getMessage() || 'Bad Request';
                $data['meta']['origin_code'] = 400;
                $data['meta']['origin_exception'] = get_class($e);

                return response()->json($data, 400, $this->commonHeaders);
            }
        }

//        if (env('APP_DEBUG') === true) {
//            return parent::render($request, $e);
//        }

        return response()->json($data, 200, $this->commonHeaders);
    }

}
