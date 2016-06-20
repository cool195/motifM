<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;

class BraintreeController extends ApiController
{

    //支付方式
    //PAYPAL("PayPal"),
    //CREDIT_CARD("Card"),
    //APPLE_PAY("ApplePay"),
    //ANDROID_PAY("AndroidPay"),
    //UNKNOWN("unknown");
    //
    //
    //卡类型
    //AMEX("AmericanExpress"),
    //DINERS("Diners"),
    //DISCOVER("Discover"),
    //JCB("JCB"),
    //MAESTRO("Maestro"),
    //MASTERCARD("MasterCard"),
    //VISA("Visa"),
    //UNION("ChinaUnionPay"),
    //UNKNOWN("unknown");

    //进入个人中心braintree绑定支付信息模版
    public function index(Request $request)
    {
        $methodlist = $this->methodlist();
        $methodlist['data']['cardlist'] = array('Diners' => 'diners-club', 'Discover' => 'discover', 'JCB' => 'jcb', 'Maestro' => 'maestro', 'AmericanExpress' => 'american-express', 'Visa' => 'visa', 'MasterCard' => 'master-card');
        $params = array(
            'cmd' => 'token',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'uuid' => '123',
        );
        $result = $this->request('openapi', '', 'pay', $params);
        $token = isset($result['data']['token']) ? $result['data']['token'] : '';
        $view = View('shopping.paymentmethod', ['token' => $token, 'methodlist' => $methodlist['data']]);
        if ('checkout' == $request->input('pageSrc')) {
            $input = $request->except('pageSrc', 'methodtoken', 'paym');
            $paym = $request->input('paym');
            $view = View('shopping.checkpayment', ['token' => $token, 'methodlist' => $methodlist['data'], 'input' => $input, 'paym'=>$paym]);
        }
        return $view;
    }

    //Braintree回调,绑定支付信息方法
    public function checkout(Request $request)
    {
        $params = array(
            'cmd' => 'method',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'nonce' => $request->input("nonce"),
        );
        $result = $this->request('openapi', '', 'pay', $params);
        $result['redirectUrl'] = "/braintree";
        return $result;
    }

    /*
	 * 跳转到添加支付卡页面
	 *
	 * @author zhangtao@evermarker.net
	 *
	 * */
    public function addCard(Request $request)
    {
        $params = array(
            'cmd' => 'token',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'uuid' => '123',
        );
        $result = $this->request('openapi', '', 'pay', $params);
        $token = isset($result['data']['token']) ? $result['data']['token'] : '';
        return view('shopping.paymentaddCard',['token' => $token]);
    }

    //测试支付类型
    public function testpay()
    {
        $params = array(
            'cmd' => 'token',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'uuid' => '123',
        );
        $result = $this->request('openapi', '', 'pay', $params);
        $token = isset($result['data']['token']) ? $result['data']['token'] : '';
        return View('shopping.braintree', ['token' => $token]);
    }

    public function testcheck(Request $request){
        $params = array(
            'cmd' => 'method',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'nonce' => $request->input("payment_method_nonce"),
        );
        $result = $this->request('openapi', '', 'pay', $params);
        $result['params'] = $params;
        return $result;
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
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }
}