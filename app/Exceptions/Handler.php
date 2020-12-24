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
//        AuthorizationException::class,
        HttpException::class,
//        ModelNotFoundException::class,
        ValidationException::class,
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
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin, x-access-token'
        ];

        if ($e instanceof ModelNotFoundException) {
            $data = [
                'msg' => 'Not found model by id '.$e->getIds()[0],
                'success' => false,
                'meta' => [
                    'origin_msg' => $e->getMessage(),
                    'origin_code' => $e->getCode(),
                    'model' => $e->getModel(),
                    'requested_ids' => count($e->getIds()) === 1 ?
                        $e->getIds()[0] : $e->getIds(),
                ],
            ];
            return response()->json($data, 200, $headers);
        }

        if ($e instanceof HttpException) {
            $data = [
                'msg' => $e->getMessage(),
                'success' => false,
                'meta' => [
                    'original_code' => $e->getStatusCode(),
                ],
            ];
            return response()->json($data, 200, $headers);
        }

        if (env('APP_DEBUG') === true) {
            return parent::render($request, $e);
        }
    }

}
