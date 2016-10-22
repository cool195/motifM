<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\libs\PayOrder;
use Illuminate\Support\Facades\Session;

class PaypalController extends ApiController
{

    //请求paypal支付
    public function index(Request $request)
    {
        PayOrder::createOrder($request->input('orderid'), $request->input('orderDetail'), $request->input('totalPrice'), $request->input('shippingPrice'));
    }

    //paypal回调
    public function paypal(Request $request)
    {
        if ($request->input('success')) {
            $result = PayOrder::paypalStatic($request);
            if ($result) {
                $params = array(
                    'cmd' => "dopay",
                    'uuid' => $_COOKIE['uid'],
                    'token' => Session::get('user.token'),
                    'pin' => Session::get('user.pin'),
                    'orderid' => $result->transactions[0]->item_list->items[0]->name,
                    'paytype' => 'PayPalNative',
                    'showname' => 'PayPal',
                    'devicedata' => "H5",
                    'nonce' => '{"response_type":"payment","response":{"id":"'.$result->id.'","state":"'.$result->state.'","create_time":"'.$result->create_time.'","intent":"'.$result->intent.'"}}',
                );
                $content = $this->request('openapi', "", "pay", $params);
                if(!empty($content) && $content['success']){
                    Session::forget('user.checkout');
                    return redirect('/success?orderid='.$params['orderid']);
                }
            }
        }

        return redirect('/order/orderdetail/'.$request->input('orderid'));
    }
}