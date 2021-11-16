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

$router->get('/{uri}', [
    'uses' => 'RedirectController@index'
]);

$router->post('/link/store', [
    'uses' => 'LinkController@store'
]);
$router->put('/link/{id:[0-9]+}/update', [
    'uses' => 'LinkController@update'
]);

$router->post('/linkout/store', [
    'uses' => 'LinkOutController@store'
]);
$router->put('/linkout/{id:[0-9]+}/update', [
    'uses' => 'LinkOutController@update'
]);