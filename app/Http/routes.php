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

$app->get('/book', ['middleware' => 'test', 'uses'=> 'BookController@index']);
//$app->get('/detail/{spu}', ['middleware'=>'logincheck', 'uses'=>'Shopping\ProductController@index']);


$app->get('/shopping', 'Shopping\ShoppingController@index');
//$app->get('/shopping/category', 'Shopping\ShoppingController@getShoppingCategoryList');
//$app->get('/shopping/list', 'Shopping\ShoppingController@getShoppingProductList');
//$app->get('/stock/checkstock', 'Shopping\ShoppingController@checkStock');


$app->group(['middleware'=>'logincheck', 'namespace'=>'App\Http\Controllers\Shopping'], function($app){

    $app->get('/products/{spu}', 'ProductController@getProductDetail');
    $app->get('/detail/{spu}', 'ProductController@index');


    $app->get('/shopping/cart', 'CartController@index');
    $app->get('/shopping/ordercheckout', 'CartController@orderCheckout');
    $app->get('/shopping/cart/addresslist', 'CartController@addressList');
    $app->get('/shopping/cart/coupon', 'CartController@coupon');
    $app->get('/shopping/cart/message', 'CartController@message');


    $app->get('/cart/amount', 'CartController@getCartAmount');
    $app->get('/cart/list', 'CartController@getCartList');
    $app->get('/cart/accountlist', 'CartController@getCartAccountList');
    $app->get('/cart/savelist', 'CartController@getCartSaveList');
//$app->get('/shopping/cart/addCart', 'Shopping\CartController@addCart');
    $app->patch('/cart', 'CartController@addCart');
    $app->put('/cart', 'CartController@promptlyBuy');
    $app->get('/shopping/cart/addBatchCart', 'CartController@addBatchCart');
    $app->get('/cart/alterQtty', 'CartController@alterCartProQtty');

//$app->get('/shopping/cart/promptlyBuy', 'Shopping\CartController@promptlyBuy');
    $app->get('/cart/operate', 'CartController@operateCartProduct');
    $app->post('/cart/operate', 'CartController@operateCartProduct');

    $app->get('/pay/paymentmethod', 'PayController@paymentMethod');
    $app->get('/pay/cardadd', 'PayController@newCardAdd');

    $app->get('/pay/token', 'PayController@getPayToken');
    $app->get('/shopping/pay/method', 'PayController@createPayMethod');
    $app->get('/shopping/pay/pay', 'PayController@pay');
    $app->get('/shopping/pay/checkpay', 'PayController@pay');
    $app->get('/pay/methodlist', 'PayController@getMethodList');
    $app->get('/shopping/pay/del', 'PayController@delMethod');
    $app->get('/shopping/pay/getDefault', 'PayController@getDefaultMethod');
    $app->get('/shopping/pay/setDefault', 'PayController@setDefaultMethod');
    $app->get('/shopping/pay/check', 'PayController@check');

    $app->get('/addr/list', 'AddressController@getUserAddrList');
    $app->get('/addr/default', 'Shopping\AddressController@getUserDefaultAddr');
    $app->get('/addr/add', 'AddressController@addUserAddr');
    $app->post('/addr/add', 'AddressController@addUserAddr');
    $app->get('/addr/modify', 'AddressController@modifyUserAddr');
    $app->post('/addr/modify', 'AddressController@modifyUserAddr');
    $app->get('/addr/mdefault', 'AddressController@modifyUserDefaultAddr');
    $app->get('/addr/del', 'AddressController@delUserAddr');
    $app->delete('/addresses', 'AddressController@delUserAddr');
    $app->get('/addr/country', 'AddressController@getCountry');




    $app->get('/reset', 'UserController@reset');
    $app->get('/user/setting', 'UserController@setting');
    $app->get('/user/changeprofile', 'UserController@changeProfile');
    $app->get('/user/shippingaddress', 'UserController@shippingAddress');
    $app->get('/user/addradd', 'UserController@addrAdd');
    $app->get('/user/addrmod/{aid}', 'UserController@addrModify');
    $app->get('/user/countrylist', 'UserController@countryList');
    $app->get('/user/changepassword', 'UserController@changePassword');


    $app->get('/user/signout', 'UserController@signout');
    $app->get('/user/resetPwd', 'UserController@resetPassword');
    $app->get('/user/forget', 'UserController@forgetPassword');
    $app->post('/user/modifyUserPwd', 'UserController@modifyUserPwd');
    $app->get('/user/trilogin', 'UserController@tryPrtLogin');
    $app->get('/user/userdetail', 'UserController@getUserDetailInfo');
    $app->get('/user/modifyUserInfo', 'UserController@modifyUserInfo');
    $app->post('/user/modifyUserInfo', 'UserController@modifyUserInfo');



    $app->get('/shopping/orderlist', 'OrderController@index');
//$app->get('/shopping/order/orderlist', 'Shopping\OrderController@getOrderList');
    $app->get('/orders', 'OrderController@getOrderList');
    $app->get('/shopping/order/orderdetail/{subno}', 'OrderController@orderDetail');
    $app->get('/shopping/order/orderSubmit', 'OrderController@orderSubmit');
});

$app->group(['namespace'=>'App\Http\Controllers\Shopping'], function($app){
    $app->get('/shopping', 'ShoppingController@index');
    $app->get('/category', 'ShoppingController@getShoppingCategoryList');
    $app->get('/products', 'ShoppingController@getShoppingProductList');
    $app->get('/stock/checkstock', 'ShoppingController@checkStock');
});



$app->get('/login', 'Shopping\UserController@login');
$app->get('/user/logincheck', 'Shopping\UserController@loginCheck');
$app->post('/user/logincheck', 'Shopping\UserController@loginCheck');
$app->get('/register', 'Shopping\UserController@register');
$app->get('/user/signup', 'UserController@signup');
$app->post('/user/signup', 'UserController@signup');

$app->get('/designer', 'Designer\DesignerController@index');
$app->get('/designer/{id}', 'Designer\DesignerController@show');

$app->get('/', 'Daily\DailyController@index');
$app->get('/daily', 'Daily\DailyController@index');
$app->get('/topic/{id}', 'Daily\DailyController@show');

$app->get('/braintree', 'Shopping\BraintreeController@index');
$app->post('/braintree', 'Shopping\BraintreeController@checkout');