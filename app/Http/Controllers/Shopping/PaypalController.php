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

                $value['response'] = array(
                    'create_time' => $result->create_time,
                    'id' => $result->id,
                    'intent' => $result->intent,
                    'state' => $result->state,
                );
                $value['response_type'] = 'payment';

                $params = array(
                    'cmd' => "dopay",
                    'uuid' => $_COOKIE['uid'],
                    'token' => Session::get('user.token'),
                    'pin' => Session::get('user.pin'),
                    'orderid' => $result->transactions[0]->item_list->items[0]->name,
                    'paytype' => 'PayPal',
                    'showname' => 'PayPal',
                    'devicedata' => "H5"
                );
                $this->request('openapi', "", "pay", $params);
            }
        }
        return redirect('/order/orderlist');
    }
}