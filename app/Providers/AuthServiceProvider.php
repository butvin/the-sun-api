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
    public function boot(): void
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api/v1', function ($request) {
            $headers = $request->headers->all();

            if ($request->input('api_token')) {
                return User::where('api_token', $request->input('api_token'))->first();
            }
        });
    }

    public function checkAccessToken($token): \Illuminate\Http\JsonResponse
    {
//        $token = User::where(['api_token' => $token])->first();

//        if (! $token) {
//            if ($token->expires_at < time()) {
//                $data = ['msg' => 'Access token expired'];
//                return response()->json($response, 200, []);
//            }
//            $data = ['status' => 'failed', 'msg' => 'access token not found'];
//
//            return response()->json($data, 204);
//        }

//        return $token;
    }

}
