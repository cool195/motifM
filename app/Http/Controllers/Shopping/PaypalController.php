<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;
use App\libs\PayOrder;

class PaypalController extends ApiController
{

    //请求paypal支付
    public function index(Request $request)
    {
        PayOrder::createOrder('juchao_test', 99, 11);
    }

    //paypal回调
    public function paypal(Request $request)
    {
        $result = PayOrder::paypalStatic($request);
        dd($result);
    }
}