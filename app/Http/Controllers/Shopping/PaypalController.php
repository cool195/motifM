<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\libs\PayOrder;

class PaypalController extends ApiController
{

    //请求paypal支付
    public function index(Request $request)
    {
        PayOrder::createOrder($request->input('orderDetail', $request->input('orderid')), $request->input('totalPrice'), $request->input('shippingPrice'));
    }

    //paypal回调
    public function paypal(Request $request)
    {
        if($request->input('success')){
            $result = PayOrder::paypalStatic($request);
            if ($result) {

                $value['response'] = array(
                    'create_time' => $result->create_time,
                    'id' => $result->id,
                    'intent' => $result->intent,
                    'state' => $result->state,
                );
                $value['response_type'] = 'payment';
            }
            return $value;
        }else{
            return $request->all();
        }

    }
}