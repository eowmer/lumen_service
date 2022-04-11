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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'auth'], function ($router) {

    $router->post('login', 'AuthController@login');
    $router->post('register', 'AuthController@register');

});

$router->group(['prefix' => 'client','middleware' => 'auth'], function ($router) {

    $router->get('/', 'ClientController@index');
    $router->post('/', 'ClientController@store');
    $router->get('/{client}', 'ClientController@show');
    $router->put('/{client}', 'ClientController@update');
    $router->delete('/', 'ClientController@destroy');
});