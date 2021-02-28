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

$router->get('/', fn() => redirect('api/v1/'));

$router->group([
    'prefix' => '/v1',
//    'middleware' => ['auth'],
], function () use ($router) {
    $router->get('/', fn() => $router->app->version());

    // Users resource collection
    $router->get('users', ['uses' => 'UserController@getAllUsers']);

    // Crud users resource
    $router->post('users', ['uses' => 'UserController@register']);
    $router->get('users/{id:[0-9]+}', ['uses' => 'UserController@getUser']);
    $router->put('users/{id:[0-9]+}', ['uses' => 'UserController@updateUser']);
    $router->delete('users/{id:[0-9]+}/', ['uses' => 'UserController@destroyUser']);
});

