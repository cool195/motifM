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


$app->get('/', 'Daily\DailyController@index');
$app->get('/daily', 'Daily\DailyController@index');
$app->get('/topic/{id}', 'Daily\DailyController@show');
$app->get('/shopping', 'Shopping\ShoppingController@index');

$app->get('/designer', 'Designer\DesignerController@index');
$app->get('/designer/{id}', 'Designer\DesignerController@show');

$app->group(['middleware' => 'logincheck', 'namespace' => 'App\Http\Controllers\Shopping'], function ($app) {

    $app->get('/cart', 'CartController@index');
    $app->get('/cart/ordercheckout', 'CartController@orderCheckout');
    $app->get('/cart/addresslist', 'CartController@addressList');
    $app->get('/cart/coupon', 'CartController@coupon');
    $app->get('/cart/message', 'CartController@message');
    //todo
    $app->get('/shopping/cart', 'CartController@index');
    $app->get('/shopping/ordercheckout', 'CartController@orderCheckout');
    $app->get('/shopping/cart/addresslist', 'CartController@addressList');
    $app->get('/shopping/cart/coupon', 'CartController@coupon');
    $app->get('/shopping/cart/message', 'CartController@message');

    $app->get('/cart/amount', 'CartController@getCartAmount');
    $app->get('/cart/list', 'CartController@getCartList');
    $app->get('/cart/accountlist', 'CartController@getCartAccountList');
    $app->get('/cart/savelist', 'CartController@getCartSaveList');
    $app->patch('/cart', 'CartController@addCart');
    $app->put('/cart', 'CartController@promptlyBuy');
    $app->get('/cart/addBatchCart', 'CartController@addBatchCart');
    $app->get('/cart/alterQtty', 'CartController@alterCartProQtty');
    $app->post('/cart/alterQtty', 'CartController@alterCartProQtty');
    $app->get('/cart/operate', 'CartController@operateCartProduct');
    $app->post('/cart/operate', 'CartController@operateCartProduct');
    $app->post('/cart/verifycoupon', 'CartController@verifyCoupon');
    $app->get('/cart/addradd', 'CartController@addrAdd');
    $app->get('/cart/countrylist', 'CartController@countrylist');

    $app->get('/addr/list', 'AddressController@getUserAddrList');
    $app->get('/addr/default', 'Shopping\AddressController@getUserDefaultAddr');
    $app->get('/addr/add', 'AddressController@addUserAddr');
    $app->post('/addr/add', 'AddressController@addUserAddr');
    $app->post('/useraddr/addUserAddress', 'AddressController@addUserAddr');
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
    $app->put('/user/uuid', 'UserController@saveUUID');


    $app->get('/shopping/orderlist', 'OrderController@index');
    $app->get('/order/orderlist', 'OrderController@index');
    $app->get('/orders', 'OrderController@getOrderList');
    $app->get('/order/orderdetail/{subno}', 'OrderController@orderDetail');
    $app->get('/orderdetail/{subno}', 'OrderController@getOrderDetail');
    $app->get('/order/orderSubmit', 'OrderController@orderSubmit');
    $app->post('/order/orderSubmit', 'OrderController@orderSubmit');

    //第三方支付
    $app->get('/braintree', 'BraintreeController@index');
    $app->delete('/braintree', 'BraintreeController@delMethod');
    $app->post('/braintree', 'BraintreeController@checkout');
    $app->get('/braintree/addcard', 'BraintreeController@addCard');
    //测试支付
    $app->get('/testpay', 'BraintreeController@testpay');
    $app->post('/testcheck', 'BraintreeController@testcheck');
});

$app->group(['namespace' => 'App\Http\Controllers\Shopping'], function ($app) {
    $app->get('/shopping', 'ShoppingController@index');
    $app->get('/category', 'ShoppingController@getShoppingCategoryList');
    $app->get('/products', 'ShoppingController@getShoppingProductList');
    $app->get('/stock/checkstock', 'ShoppingController@checkStock');

    $app->get('/products/{spu}', 'ProductController@getProductDetail');
    $app->get('/detail/{spu}', 'ProductController@index');


    $app->get('/login', 'UserController@login');
    $app->patch('/login', 'UserController@login');
    $app->get('/user/logincheck', 'UserController@loginCheck');
    $app->post('/user/logincheck', 'UserController@loginCheck');
    $app->get('/register', 'UserController@register');
    $app->get('/user/signup', 'UserController@signup');
    $app->post('/user/signup', 'UserController@signup');
});

$app->group(['middleware' => 'logincheck', 'namespace' => 'App\Http\Controllers\Other'], function ($app) {
    $app->get('/askshopping', 'AskController@show');
    $app->put('/askshopping', 'AskController@install');
});


$app->group(['namespace' => 'App\Http\Controllers\Other'], function ($app) {
    $app->get('/aboutmotif', 'PageController@aboutMotif');
    $app->get('/contactus', 'PageController@contactUs');
    $app->get('/faq', 'PageController@faq');
    $app->get('/termsconditions', 'PageController@termsService');
    $app->get('/privacynotice', 'PageController@privacyPolicy');
    $app->get('/sizeguide', 'PageController@sizeGuide');
    $app->get('/shippingreturns', 'PageController@shippingreturns');
    $app->get('/payments', 'PageController@payments');

    //$app->get('/cancellationpolicy', 'PageController@cancellationPolicy');
    //$app->get('/motifguarantee', 'PageController@motifGuarantee');
    //$app->get('/termsservice', 'PageController@termsService');

});
