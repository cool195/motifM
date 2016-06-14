<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;

class PayController extends ApiController
{
	/*
	 * 跳转到支付方式列表页面
	 *
	 * @author zhangtao@evermarker.net
	 * */
	public function paymentMethod(Request $request)
	{
		$result = $this->getMethodList($request);
		return view('shopping.paymentmethod', ['data'=>$result['data']]);
	}

	/*
	 * 跳转到添加支付卡页面
	 *
	 * @author zhangtao@evermarker.net
	 *
	 * */
	public function newCardAdd(Request $request)
	{
		return view('shopping.paymentmethod_addcard');
	}

	/*
	 * 获取支付Token
	 *
	 * @author zhangtao@evermarker.net
	 * */
	//todo 改为私有方法
	public function getPayToken(Request $request)
	{
		$params = array(
			'cmd'=>'token',
			'uuid'=>$request->input('uuid', '123'),
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
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

	public function createPayMethod(Request $request)
	{
		$cmd = "method";
		$nonce = $request->input('noonce', "xxx");
		$devicedata = $request->input('devicedata', "asdf");
		$params = array(
			'cmd'=>$cmd,
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'nonce'=>$nonce,
			'devicedata'=>$devicedata
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

	public function pay(Request $request)
	{
		$cmd = "dopay";
		$orderid = $request->input('orderid');
		$paytype = $request->input('paytype');
		$cardtype = $request->input('cardtype');
		$methodtoken = $request->input('methodtoken');
		$nonce = $request->input('nonce');
		$setdefault = $request->input('setdefault', 1);
		$params = array(
			'cmd'=>$cmd,
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'orderid'=>$orderid,
			'paytype'=>$paytype,
			'cardtype'=>$cardtype,
			'methodtoken'=>$methodtoken,
			'nonce'=>$nonce,
			'setdefault'=>$setdefault
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

	public function checkPay(Request $request)
	{
		$cmd = "checkpay";
		$transid = $request->input('transid');
		$params = array(
			'cmd'=>$cmd,
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'transid'=>$transid
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

	public function getMethodList(Request $request)
	{
		$params = array(
			'cmd' => 'methodlist',
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'uuid' => $request->input('uuid','123'),
			'src' => "H5"
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

	public function delMethod(Request $request)
	{
		$cmd = "delmethod";
		$methodtoken = $request->input('methodtoken');
		$params = array(
			'cmd' => $cmd,
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'methodtoken' => $methodtoken
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

	public function getDefaultMethod(Request $request)
	{
		$cmd = "getdefault";
		$uuid = $request->input('uuid', '123');
		$params = array(
			'cmd'=>$cmd,
			'uuid'=>$uuid,
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
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

	public function setDefaultMethod(Request $request)
	{
		$cmd = "setdefault";
		$methodtoken = $request->input('methodtoken');
		$params = array(
			'cmd' => $cmd,
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'methodtoken' => $methodtoken
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

	public function check(Request $request)
	{
		$cmd = "check";
		$params = array(
			'cmd' => $cmd,
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
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