<?php

namespace App\Exceptions;

use Throwable;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

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
//        HttpException::class,
//        ModelNotFoundException::class,
//        ValidationException::class,
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
        if ($e instanceof ModelNotFoundException) {

            $data = [
                'origin_msg' => $e->getMessage(),
                'origin_code' => $e->getCode(),
                'model' => ($e->getModel()),
                'ids' => ($e->getIds()),
                'trace' => ($e->getTrace()),
                '$e' => ($e),
                'called_from' => static::class,
            ];

            $msg = 'No result for ' . $data['ids'][0];

            return response()->json($msg);
        }

        if (env('APP_DEBUG') === true) {
            return parent::render($request, $e);
        }



        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin, x-access-token'
        ];

        $statusCode = 500;

        if ($e instanceof HttpException) {
            $statusCode = $e->getStatusCode();
        }

        return response()->json([$e->getMessage(), $statusCode,], $statusCode, $headers);

    }
}
