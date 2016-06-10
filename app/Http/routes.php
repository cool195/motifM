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



$app->get('/shopping', 'Shopping\ShoppingController@index');
//$app->get('/shopping/category', 'Shopping\ShoppingController@getShoppingCategoryList');
//$app->get('/shopping/list', 'Shopping\ShoppingController@getShoppingProductList');
$app->get('/stock/checkstock', 'Shopping\ShoppingController@checkStock');

$app->get('/detail/{spu}', 'Shopping\ProductController@index');



$app->get('/shopping/cart', 'Shopping\CartController@index');
$app->get('/shopping/ordercheckout', 'Shopping\CartController@orderCheckout');
$app->get('/shopping/cart/addresslist', 'Shopping\CartController@addressList');
$app->get('/shopping/cart/coupon', 'Shopping\CartController@coupon');
$app->get('/shopping/cart/message', 'Shopping\CartController@message');



$app->get('/shopping/cart/amount', 'Shopping\CartController@getCartAmount');
$app->get('/shopping/cart/list', 'Shopping\CartController@getCartList');
$app->get('/shopping/cart/accountlist', 'Shopping\CartController@getCartAccountList');
$app->get('/shopping/cart/savelist', 'Shopping\CartController@getCartSaveList');
//$app->get('/shopping/cart/addCart', 'Shopping\CartController@addCart');
$app->patch('/cart', 'Shopping\CartController@addCart');
$app->put('/cart', 'Shopping\CartController@promptlyBuy');
$app->get('/shopping/cart/addBatchCart', 'Shopping\CartController@addBatchCart');
$app->get('/shopping/cart/alterQtty', 'Shopping\CartController@alterCartProQtty');
//$app->get('/shopping/cart/promptlyBuy', 'Shopping\CartController@promptlyBuy');
$app->get('/shopping/cart/other', 'Shopping\CartController@operateCartProduct');



$app->get('/shopping/pay/token', 'Shopping\PayController@getPayToken');
$app->get('/shopping/pay/method', 'Shopping\PayController@createPayMethod');
$app->get('/shopping/pay/pay', 'Shopping\PayController@pay');
$app->get('/shopping/pay/checkpay', 'Shopping\PayController@pay');
$app->get('/shopping/pay/methodlist', 'Shopping\PayController@getMethodList');
$app->get('/shopping/pay/del', 'Shopping\PayController@delMethod');
$app->get('/shopping/pay/getDefault', 'Shopping\PayController@getDefaultMethod');
$app->get('/shopping/pay/setDefault', 'Shopping\PayController@setDefaultMethod');
$app->get('/shopping/pay/check', 'Shopping\PayController@check');



$app->get('/shopping/addr/list', 'Shopping\AddressController@getUserAddrList');
$app->get('/shopping/addr/default', 'Shopping\AddressController@getUserDefaultAddr');
$app->get('/shopping/addr/add', 'Shopping\AddressController@getUserAddr');
$app->get('/shopping/addr/modify', 'Shopping\AddressController@modifyUserAddr');
$app->get('/shopping/addr/mdefault', 'Shopping\AddressController@modifyUserDefaultAddr');
//$app->get('/shopping/addr/delete', 'Shopping\AddressController@delUserAddr');
$app->delete('/addresses', 'Shopping\AddressController@delUserAddr');
$app->get('/shopping/addr/country', 'Shopping\AddressController@getCountry');



$app->get('/login', 'Shopping\UserController@login');
$app->get('/register', 'Shopping\UserController@register');
$app->get('/reset', 'Shopping\UserController@reset');
$app->get('/user/setting', 'Shopping\UserController@setting');
$app->get('/user/changeprofile', 'Shopping\UserController@changeProfile');
$app->get('/user/shippingaddress', 'Shopping\UserController@shippingAddress');
$app->get('/user/changepassword', 'Shopping\UserController@changePassword');

$app->get('/user/signup', 'Shopping\UserController@signup');
$app->post('/user/signup', 'Shopping\UserController@signup');
$app->get('/user/logincheck', 'Shopping\UserController@loginCheck');
$app->get('/user/signout', 'Shopping\UserController@signout');
$app->get('/user/resetPwd', 'Shopping\UserController@resetPassword');
$app->get('/user/forget', 'Shopping\UserController@forgetPassword');
$app->get('/user/modifyUserPwd', 'Shopping\UserController@modifyUserPwd');
$app->get('/user/trilogin', 'Shopping\UserController@tryPrtLogin');
$app->get('/user/userdetail', 'Shopping\UserController@getUserDetailInfo');
$app->get('/user/modifyUserInfo', 'Shopping\UserController@modifyUserInfo');



$app->get('/shopping/orderlist', 'Shopping\OrderController@index');
//$app->get('/shopping/order/orderlist', 'Shopping\OrderController@getOrderList');
$app->get('/orders', 'Shopping\OrderController@getOrderList');
$app->get('/shopping/order/orderdetail/{subno}', 'Shopping\OrderController@orderDetail');
$app->get('/shopping/order/orderSubmit', 'Shopping\OrderController@orderSubmit');

$app->get('/category', 'Shopping\ShoppingController@getShoppingCategoryList');
$app->get('/products', 'Shopping\ShoppingController@getShoppingProductList');
$app->get('/products/{spu}', 'Shopping\ProductController@getProductDetail');

$app->get('/designer', 'Designer\DesignerController@index');
$app->get('/designer/{id}', 'Designer\DesignerController@show');

$app->get('/daily', 'Daily\DailyController@index');
$app->get('/topic/{id}', 'Daily\DailyController@show');
