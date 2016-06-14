<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;

class BraintreeController extends ApiController
{

    //进入braintree绑定支付信息模版
    public function index()
    {
        return View('shopping.braintree');
    }

    //Braintree回调,绑定支付信息方法
    public function checkout(Request $request)
    {
        $params = array(
            'cmd' => 'method',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'nonce' => $request->input("payment_method_nonce"),
        );
        $result = $this->request('openapi', '', 'pay', $params);
        return $result;
    }

    public function getDefault(Request $request)
    {

        $params = array(
            'cmd' => 'getdefault',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $result = $this->request('openapi', '', 'pay', $params);
        dd($result);
    }

}