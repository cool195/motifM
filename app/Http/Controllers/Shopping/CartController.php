<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

class CartController extends ApiController
{
	public function getCartAmount(Request $request)		
	{
		$cmd = $request->input('cmd', 'amount');	
		$pin = $request->input('pin', 'xuzhijie');
		$token = $request->input('token', 1);
		$params = array(
			'cmd' => $cmd,
			'pin' => $pin,
			'token' => $token
		);
		$system = "cart";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params, 300);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		dd($result);
		return $result;
	}

	public function getCartList(Request $request) 
	{
		$cmd = "cartlist";	
		$pin = $request->input('pin', 'xuzhijie');
		$token = $request->input('token', 1);
		$params = array(
			'cmd' => $cmd,
			'pin' => $pin,
			'token' => $token
		);
		$system = "cart";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params, 300);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		dd($result);
		return $result;
	}

	public function getCartAccountList(Request $request)
	{
		$cmd = "accountlist";	
		$pin = $request->input('pin', 'xuzhijie');
		$token = $request->input('token', 1);
		$addressid = $request->input('addressid', "");
		$couponcode = $request->input('couponcode', "");
		$params = array(
			'cmd' => $cmd,
			'pin' => $pin,
			'token' => $token,
			'addressid' => $addressid,
			'couponcode' => $couponcode
		);
		$system = "cart";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params, 300);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		dd($result);
		return $result;
	}

	public function getCartSaveList(Request $request)
	{
		$cmd = "savelist";	
		$pin = $request->input('pin', "xuzhijie");
		$token = $request->input('token', 1);
		$params = array(
			'cmd' => $cmd,
			'pin' => $pin,
			'token' => $token,
		);
		$system = "cart";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params, 300);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		dd($result);
		return $result;
	}

	public function addCart(Request $request)
	{
		$cmd = "addsku";
		$operate = $request->input('operate');
		$pin = $request->input('pin', "xuzhijie");
		$token = $request->input('token', 1);
		$params = array(
			'cmd' => $cmd,
			'operate' => $operate,
			'pin' => $pin,
			'token' => $token
		);		
		$system = "cart";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params, 300);
		dd($result);
		if($result['success']){
			return $result;
		}
	}

	public function alterCartProQtty(Request $request)
	{
		$cmd = "alterqtty";	
		$sku = $request->input('sku');
		$qtty = $request->input('qtty');
		$pin = $request->input('pin', "xuzhijie");
		$token = $request->input('token', 1);	
		$params = array(
			'cmd' => $cmd,
			'sku' => $sku,
			'qtty' => $qtty,
			'pin' => $pin,
			'token' => $token
		);		
		$system = "cart";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params, 300);
		dd($result);
		if($result['success']){
			return $result;
		}
	}

	public function promptlyBuy(Request $request)
	{
		$cmd = "promptlybuy";
		$operate = $request->input('operate');
		$pin = $request->input('pin', "xuzhijie");
		$token = $request->input('token', 1);
		$params = array(
			'cmd' => $cmd,
			'operate' => $operate,
			'pin' => $pin,
			'token' => $token
		);		
		$system = "cart";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params, 300);
		dd($result);
		if($result['success']){
			return $result;
		}
	}

	public function other(Request $request)
	{
		$cmdSelector = array("select", "cancal", "delsku", "save", "movetocart", "delsave");	
		$cmd = $request->input('cmd'); 
		$result = "";	
		if(in_array($cmd, $cmdSelector))
		{
			$sku = $request->input('sku');
			$pin = $request->input('pin', "xuzhijie");
			$token = $request->input('token', 1);	
			$params = array(
				'cmd' => $cmd,
				'operate' => $operate,
				'pin' => $pin,
				'token' => $token
			);		
			$system = "cart";
			$service = "cart";
			$result = $this->request('openapi', $system, $service, $params, 300);
		}
		dd($result);
		return $result;
	}
}
