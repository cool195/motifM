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

$app->group(['middleware' => 'pcguide', 'namespace' => 'App\Http\Controllers'], function ($app) {

    $app->get('/', 'Daily\DailyController@index');
    $app->get('/daily', 'Daily\DailyController@index');
    $app->get('/recdata', 'Daily\DailyController@recData');
    $app->get('/topic/{id}', 'Daily\DailyController@show');
    $app->get('/template/{id}', 'Daily\DailyController@staticShow');
    $app->get('/shopping', 'Shopping\ShoppingController@index');

    $app->get('/designer', 'Designer\DesignerController@index');
    $app->get('/designer/{id}', 'Designer\DesignerController@show');

    $app->post('/googlelogin', 'Auth\AuthController@googleLogin');
    $app->post('/facebooklogin', 'Auth\AuthController@facebookLogin');
    $app->get('/facebooklogin', 'Auth\AuthController@facebookLogin');
    //$app->get('/forgetpwd', 'Shopping\UserController@forgetPWD');
    //$app->post('/forgetpwd', 'Shopping\UserController@forgetPWD');
    $app->get('/addFacebookEmail', 'Auth\AuthController@addFacebookEmail');
    $app->get('/facebookstatus/{trdid}', 'Auth\AuthController@faceBookAuthStatus');
    $app->get('methodlist', 'Shopping\BraintreeController@methodlist');

});


$app->group(['middleware' => 'pcguide|logincheck', 'namespace' => 'App\Http\Controllers\Shopping'], function ($app) {

    //New CheckOut
    $app->get('/testttt', 'CheckoutController@test');
    $app->get('/checkout/shipping', 'CheckoutController@shipping');
    $app->get('/checkout/address', 'CheckoutController@address');
    $app->get('/checkout/payment', 'CheckoutController@payment');
    $app->get('/checkout/review', 'CheckoutController@review');
    $app->post('/checkout/addcard', 'CheckoutController@addCard');
    $app->post('/checkout/address', 'CheckoutController@addUserAddr');
    $app->get('/checkout/selAddr/{aid}', 'CheckoutController@selAddr');
    $app->post('/updateUserAddr/{aid}', 'CheckoutController@updateUserAddr');
    $app->get('/checkout/selShip/{type}', 'CheckoutController@selShip');
    $app->get('/checkout/paywith/{type}/{cardid}', 'CheckoutController@paywith');
    $app->get('/checkout/selCode/{bindid}', 'CheckoutController@selCode');

    $app->get('/feed', 'ShoppingController@feedback');
    $app->get('/feedback', 'ShoppingController@addSupport');
    $app->get('/feedbacklist', 'ShoppingController@getFeedbackList');

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
    $app->post('/cart/addBatchCart', 'CartController@addBatchCart');
    $app->get('/cart/alterQtty', 'CartController@alterCartProQtty');
    $app->post('/cart/alterQtty', 'CartController@alterCartProQtty');
    $app->get('/cart/operate', 'CartController@operateCartProduct');
    $app->post('/cart/operate', 'CartController@operateCartProduct');
    $app->post('/cart/verifycoupon', 'CartController@verifyCoupon');
    $app->get('/cart/addradd', 'CartController@addrAdd');
    $app->get('/cart/addrmod', 'CartController@addrModify');
    $app->get('/cart/countrylist', 'CartController@countrylist');

    $app->get('/address/{aid}', 'AddressController@getAddressInfo');
    $app->get('/addr/list', 'AddressController@getUserAddrList');
    $app->get('/addr/default', 'AddressController@getUserDefaultAddr');
    $app->get('/addr/add', 'AddressController@addUserAddr');
    $app->post('/addr/add', 'AddressController@addUserAddr');
    $app->post('/useraddr/addUserAddress', 'AddressController@addUserAddr');
    $app->get('/addr/modify', 'AddressController@modifyUserAddr');
    $app->post('/addr/modify', 'AddressController@modifyUserAddr');
    $app->get('/addr/mdefault', 'AddressController@modifyUserDefaultAddr');
    $app->get('/addr/del', 'AddressController@delUserAddr');
    $app->delete('/addresses', 'AddressController@delUserAddr');
    $app->get('/addr/country', 'AddressController@getCountry');
    $app->get('/statelist/{id}','AddressController@getState');


    $app->get('/user/setting', 'UserController@setting');
    $app->get('/user/changeprofile', 'UserController@changeProfile');
    $app->get('/user/shippingaddress', 'UserController@shippingAddress');
    $app->get('/user/addradd', 'UserController@addrAdd');
    $app->get('/user/statelist', 'UserController@statelist');
    $app->get('/user/addrmod/{aid}', 'UserController@addrModify');
    $app->get('/user/countrylist', 'UserController@countryList');
    $app->get('/user/changepassword', 'UserController@changePassword');

    $app->get('/user/signout', 'UserController@signout');
    $app->post('/user/modifyUserPwd', 'UserController@modifyUserPwd');
    $app->get('/user/trilogin', 'UserController@tryPrtLogin');
    $app->get('/user/userdetail', 'UserController@getUserDetailInfo');
    $app->get('/user/modifyUserInfo', 'UserController@modifyUserInfo');
    $app->post('/user/modifyUserInfo', 'UserController@modifyUserInfo');
    $app->put('/user/uuid', 'UserController@saveUUID');

    $app->post('/useraddr/addUserAddress', 'AddressController@addUserAddr');

    $app->get('/forgetpwd', 'UserController@forgetPWD');
    $app->post('/forgetpwd', 'UserController@forgetPWD');


    $app->get('/shopping/orderlist', 'OrderController@index');
    $app->get('/order/orderlist', 'OrderController@index');
    $app->get('/orders', 'OrderController@getOrderList');
    $app->get('/order/orderdetail/{subno}', 'OrderController@orderDetail');
    $app->get('/orderdetail/{subno}', 'OrderController@getOrderDetail');
    $app->get('/order/orderSubmit', 'OrderController@orderSubmit');
    //old
    $app->post('/order/orderSubmit', 'OrderController@orderSubmit');
    //new
    $app->post('/payorder', 'OrderController@payOrder');
    $app->get('/success', 'OrderController@orderSuccess');

    $app->get('/wish', 'ShoppingController@wish');

    $app->get('/wishlist', 'ShoppingController@wishlist');

    $app->post('/updateWish', 'ShoppingController@updateWish');

    //promocode
    $app->get('/promocode', 'UserController@promocode');
    $app->post('/promocode', 'UserController@promocode');

    //braintree
    $app->get('/braintree', 'BraintreeController@index');
    $app->delete('/braintree', 'BraintreeController@delMethod');
    $app->post('/braintree', 'BraintreeController@checkout');
    $app->get('/braintree/addcard', 'BraintreeController@addCard');
    //paypal
    $app->get('/paypalorder', 'PaypalController@index');
    $app->get('/paypal', 'PaypalController@paypal');
    $app->get('/payAgain/{orderid}/{paytype}','OrderController@orderPayInfo');
    //钱海
    $app->get('/qianhai', 'QianhaiController@index');
});

//钱海
$app->post('/qianhai', 'Shopping\QianhaiController@checkStatus');

$app->group(['middleware' => 'pcguide', 'namespace' => 'App\Http\Controllers\Shopping'], function ($app) {
    $app->get('/shopping', 'ShoppingController@index');
    $app->get('/category', 'ShoppingController@getShoppingCategoryList');
    $app->get('/products', 'ShoppingController@getShoppingProductList');
    $app->get('/stock/checkstock', 'ShoppingController@checkStock');

    $app->get('/wish/{spu}', 'ProductController@wishProduct');
    $app->get('/products/{spu}', 'ProductController@getProductDetail');
    $app->get('/detail/{spu}', 'ProductController@index');

    $app->post('/rsyncLogin', 'UserController@rsyncLogin');
    $app->get('/login', 'UserController@login');
    $app->patch('/login', 'UserController@login');
    $app->get('/user/logincheck', 'UserController@loginCheck');
    $app->post('/user/logincheck', 'UserController@loginCheck');
    $app->get('/register', 'UserController@register');
    $app->get('/user/signup', 'UserController@signup');
    $app->post('/user/signup', 'UserController@signup');
    $app->get('/reset', 'UserController@reset');
    $app->post('/user/forget', 'UserController@forgetPassword');
    $app->get('/user/resetPwd', 'UserController@resetPassword');

    //记录登录前操作
    $app->get('notesaction','UserController@notesAction');
});

$app->group(['middleware' => 'pcguide|logincheck', 'namespace' => 'App\Http\Controllers\Other'], function ($app) {
    $app->get('/askshopping', 'AskController@show');
    $app->put('/askshopping', 'AskController@install');
    $app->get('/invitefriends', 'PageController@inviteFriends');
});

$app->group(['middleware' => 'logincheck','namespace' => 'App\Http\Controllers\Designer'], function ($app) {
    $app->get('/followDesigner/{id:[0-9]+}', 'DesignerController@follow');
    $app->get('/following', 'DesignerController@following');
});


$app->group(['middleware' => 'pcguide', 'namespace' => 'App\Http\Controllers\Other'], function ($app) {
    $app->get('/aboutmotif', 'PageController@aboutMotif');
    $app->get('/contactus', 'PageController@contactUs');
    $app->get('/faq', 'PageController@faq');
    $app->get('/termsconditions', 'PageController@termsService');
    $app->get('/privacynotice', 'PageController@privacyPolicy');
    $app->get('/sizeguide', 'PageController@sizeGuide');
    $app->get('/shippingreturns', 'PageController@shippingreturns');
    $app->get('/payments', 'PageController@payments');

    $app->get('/d/invite/{code}','PageController@invite');
    $app->get('/d/invite', 'PageController@invite');
    //$app->get('/cancellationpolicy', 'PageController@cancellationPolicy');
    //$app->get('/motifguarantee', 'PageController@motifGuarantee');
    //$app->get('/termsservice', 'PageController@termsService');

});


$app->get('home', 'Shopping\ShoppingController@guide');
$app->get('pcprivacypolicy', 'Other\PageController@pcPrivacyPolicy');
$app->get('pctermsservice', 'Other\PageController@pcTermsService');


$app->get('/saleinfo', 'Other\PageController@saleinfo');

//为解决分享链接拿不到图,不再PC跳转
//$app->get('/detail/{spu}', 'Shopping\ProductController@index');
//$app->get('/designer/{id}', 'Designer\DesignerController@show');

$app->get('/apptest', 'Other\PageController@apptest');


//rae网红
$app->get('rae', function (){
    return redirect("/designer/99".($_SERVER["QUERY_STRING"] ? '?'.$_SERVER["QUERY_STRING"] : ''));
});
$app->get('/Rae', function (){
    return redirect("/designer/99".($_SERVER["QUERY_STRING"] ? '?'.$_SERVER["QUERY_STRING"] : ''));
});
$app->get('/RAE', function (){
    return redirect("/designer/99".($_SERVER["QUERY_STRING"] ? '?'.$_SERVER["QUERY_STRING"] : ''));
});
$app->get('/downapp','Other\PageController@downapp');

$app->get('/orderlist', 'Other\PageController@orderlist');

$app->get('404','Other\PageController@error404');

$app->get('aes','Other\PageController@aes');

