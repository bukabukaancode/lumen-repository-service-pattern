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

$router->get('/sample', 'SampleController@index');
$router->get('/sample/{id}', 'SampleController@show');
$router->post('/sample/create', 'SampleController@store');
$router->put('/sample/update/{id}', 'SampleController@update');
$router->delete('/sample/{id}', 'SampleController@destroy');