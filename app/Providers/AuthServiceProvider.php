<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {

//            $headers=$request->headers->all();

            if ($request->input('api_token')) {
                return User::where('api_token', $request->input('api_token'))->first();
            }
        });
    }

//    public function checkAccessToken($token)
//    {
//        $token = User::where(['api_token' => $token])->first();
//        if ($token) {
//            if ($token->expires_at < time()) {
//                $response = ['status' => 200, 'message' => 'Access token expired'];
//                return response()->json($response, 200, []);
//            }
//            return User::where(['id' => $token->user_id])->first();
//        } else {
//            $response = ['status' => 404, 'error' => 'Access token not found'];
//            return response()->json($response, 404, [], JSON_PRETTY_PRINT)->send();
//        }
//    }

}
