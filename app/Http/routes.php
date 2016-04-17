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
$app->get('/shopping/category', 'Shopping\ShoppingController@getShoppingCategoryList');
$app->get('/shopping/list', 'Shopping\ShoppingController@getShoppingProductList');
$app->get('/shopping/product/{spu}', 'Shopping\ProductController@index');


