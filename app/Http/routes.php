<?php

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

$app->get('/', function () use ($app) {
    return $app->welcome();
});

$app->get('/shopping', 'Shopping\ShoppingController@index');

$app->get('/shopping/{id}', 'Shopping\ShoppingController@show');

$app->post('/shopping', 'Shopping\ShoppingController@create');

$app->put('/shopping/{id}', 'Shopping\ShoppingController@update');

$app->delete('/shopping/{id}', 'Shopping\ShoppingController@destroy');

