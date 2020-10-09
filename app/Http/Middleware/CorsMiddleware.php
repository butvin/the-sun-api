<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CorsMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $origin = $request->header('origin');

        $headers = [
            'Access-Control-Allow-Origin' => $origin ? $origin : '*',
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin, x-access-token, Access-Control-Request-Method, Access-Control-Request-Headers, Access-Control-Allow-Headers',
            'Access-Control-Allow-Credentials' => 'true'
        ];

        if($request->getMethod() == "OPTIONS") {
            $response = new Response(' ', 200, $headers);
            return $response->send();
        }

        $response = $next($request);

        foreach($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }

}
