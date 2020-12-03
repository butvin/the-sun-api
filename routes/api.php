<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', fn() => redirect('api/v1'));

$router->group(['prefix' => 'api/v1', 'middleware' => 'cors'], function () use ($router) {

    $router->get('/', fn () => redirect()->route('users'));
    $router->get('users', [
        'as' => 'users',
        'uses' =>'UserController@index',
    ]);
    $router->get('user/{id:[0-9]+}', 'UserController@getUser');
    $router->post('user/register', 'UserController@register');
    $router->delete('user/{id:[0-9]+}/', 'UserController@destroy');

});




//    $router->get('user/{id}/', 'UserController@show'); //->where('name', '[A-Za-z]+');

//    $router->get('profile', [
//        'as' => 'profile', 'uses' => 'UserController@showProfile',
//    ]);

//    $router->get('user/{id}/profile', ['as' => 'profile', function ($id) {
//        //
//    }]);

//    $router->group(['prefix' => 'admin'], function () use ($router) {
//        $router->get('users', function () {
//            // Matches The "/admin/users" URL
//        });
//    });

