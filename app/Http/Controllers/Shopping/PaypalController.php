<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;
use App\PayPal\PayPal;

class PaypalController extends ApiController
{

    //请求paypal支付
    public function index(Request $request)
    {
        PayPal::createOrder('juchao_test', 99, 11);
    }

    //paypal回调
    public function paypal(Request $request)
    {
        $result = PayPal::paypalStatic($request);
        dd($result);
    }
}