<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Cache;

class PayController extends ApiController
{
	public function paymentMethod(Request $request)
	{
		$result = $this->getMethodList($request);
		return view('shopping.paymentmethod', ['data'=>$result['data'], 'support'=>$result['data']['support']]);
	}

	public function newCardAdd(Request $request)
	{
		return view('shopping.paymentmethod_addcard');
	}

	public function getPayToken(Request $request)
	{
		$user = Cache::get('user');
		$cmd = "token";
		$token = $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47");
		$params = array(
			'cmd'=>'token',
			'uuid'=>$request->input('uuid', md5($user['login_email'])),
			'token'=>$user['token']
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
		$token = $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47");
		//$uuid = $request->input('uuid', "");
		$nonce = $request->input('noonce', "xxx");
		$userid = $request->input('userid', 123);
		$devicedata = $request->input('devicedata', "asdf");
		$params = array(
			'cmd'=>$cmd,
			'token'=>$token,
			'nonce'=>$nonce,
			'userid'=>$userid,
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
		$token = $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47");
		$orderid = $request->input('orderid');
		$userid = $request->input('userid', 123);
		$paytype = $request->input('paytype');
		$cardtype = $request->input('cardtype');
		$methodtoken = $request->input('methodtoken');
		$nonce = $request->input('nonce');
		$setdefault = $request->input('setdefault', 1);
		$devicedata = $request->input('devicedata');
		$params = array(
			'cmd'=>$cmd,
			'token'=>$token,
			'orderid'=>$orderid,
			'userid'=>$userid,
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
		$token = $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47");
		$transid = $request->input('transid');
		$params = array(
			'cmd'=>$cmd,
			'token'=>$token,
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
		$user = Cache::get('user');
		$params = array(
			'cmd' => 'methodlist',
			'token' => $user['token'],
			'uuid' => $request->input('uuid', $user['uuid']),
			'pin' => $user['pin'],
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
		$token = $request->input("token", "eeec7a32dcb6115abfe4a871c6b08b47");
		$userid = $request->input('userid');
		$methodtoken = $request->input('methodtoken');
		$params = array(
			'cmd' => $cmd,
			'token' => $token,
			'userid' => $userid,
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
		$uuid = $request->input('uuid', "608341ba8191ba1bf7a2dec25f0158df3c6670da");
		$pin = $request->input('pin', "3e448648b3814c999b646f25cde12b2a");
		$token = $request->input('token', "71b5cb03786f9d6207421caeab91da8f");
		$params = array(
			'cmd'=>$cmd,
			'uuid'=>$uuid,
			'pin'=>$pin,
			'token'=>$token
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
		$token = $request->input("token", "eeec7a32dcb6115abfe4a871c6b08b47");
		$userid = $request->input('userid');
		$methodtoken = $request->input('methodtoken');
		$params = array(
			'cmd' => $cmd,
			'token' => $token,
			'userid' => $userid,
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
		$token = $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47");
		$userid = $request->input('userid');
		$params = array(
			'cmd' => $cmd,
			'token' => $token,
			'userid' => $userid
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