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
        $methodlist = $this->methodlist();
        $params = array(
            'cmd' => 'token',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'uuid' => '123',
        );
        $result = $this->request('openapi', '', 'pay', $params);
        $token = isset($result['data']['token']) ? $result['data']['token'] : '';
        return View('shopping.paymentmethod', ['token' => $token, 'methodlist' => $methodlist['data']]);
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
        if(!$result['data']['success']){
            $result['params'] = $params;
        }
        return $result;
    }

    //测试默认支付类型
    public function getDefault()
    {

        $params = array(
            'cmd' => 'getdefault',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $result = $this->request('openapi', '', 'pay', $params);
        dd($result);
    }

    //获取支付列表
    public function methodlist()
    {

        $params = array(
            'cmd' => 'methodlist',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'src' => 'H5',
        );
        $result = $this->request('openapi', '', 'pay', $params);
        return $result;
    }

    //删除绑定
    public function delMethod(Request $request)
    {
        $cmd = "delmethod";
        $params = array(
            'cmd' => $cmd,
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'methodtoken' => $request->input('methodtoken')
        );
        $system = "";
        $service = "pay";
        $result = $this->request('openapi', $system, $service, $params);
        if(empty($result)){
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }
}