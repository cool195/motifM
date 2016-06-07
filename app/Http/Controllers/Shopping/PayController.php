<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

class PayController extends ApiController
{
	public function getPayToken(Request $request)
	{
		$cmd = "token";
		//$uuid = $request->input('uuid', "");
		$token = $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47");
		$params = array(
			'cmd'=>$cmd,
		//	'uuid'=>$uuid,
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
		$cmd = "methodlist";
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