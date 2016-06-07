<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Session;

class CartController extends ApiController
{
	public function index(Request $request)
	{
		$cartList = $this->getCartList($request); 
		$saveList = $this->getCartSaveList($request);
		return View('shopping.cart', [
			'cartData' => $cartList['data'], 
			'saveData' => $cartList['data']
		]);
	}

	public function orderCheckout(Request $request)
	{
		$result = $this->getCartAccountList($request);
		$defaultAddr = $this->getUserDefaultAddr();
		$defaultPayMethod = $this->getDefaultPayMethod();
		return View('shopping.ordercheckout', [
			'data'=>$result['data'], 
			'addr'=>$defaultAddr['data'],
			'pay'=>$defaultPayMethod['data']
		]);
	}

	private function getUserDefaultAddr()
	{
		$result = "";
		if(Session::has('defaultAddr'))
		{
			$result = Session::get('defaultAddr');
		}else{
			$cmd = 'gdefault';		
			$uuid = "608341ba8191ba1bf7a2dec25f0158df3c6670da";
			$pin = "3e448648b3814c999b646f25cde12b2a";
			$token = "71b5cb03786f9d6207421caeab91da8f";
			$params = array(
				'cmd'=>$cmd,
				'uuid'=>$uuid,
				'pin'=>$pin,
				'token'=>$token
			);
			$system = "";
			$service = "useraddr";
			$result = $this->request('openapi', $system, $service, $params);
			if(empty($result)){
				$result['success'] = false;
				$result['error_msg'] = "Data access failed";
				$result['data'] = array();
			}
		}
		return $result;
	}

	public function addressList(Request $request)		
	{
		$cmd = 'list';	
		$uuid = $request->input("uuid", "608341ba8191ba1bf7a2dec25f0158df3c6670da");	
		$pin = $request->input("pin", "3e448648b3814c999b646f25cde12b2a");
		$token = $request->input("token", "71b5cb03786f9d6207421caeab91da8f");
		$params = array(
			'cmd'=>$cmd,
			'uuid'=>$uuid,
			'pin'=>$pin,
			'token'=>$token
		);
		$system = "";
		$service = "useraddr";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data']['list'] = array();
		}
		return View('shopping.ordercheckout_addresslist', ['data'=>$result['data']]);
	}


	private function getDefaultPayMethod()
	{
		$cmd = "getdefault";
		$uuid = "608341ba8191ba1bf7a2dec25f0158df3c6670da";
		$pin = "3e448648b3814c999b646f25cde12b2a";
		$token = "71b5cb03786f9d6207421caeab91da8f";
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
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
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
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		return $result;
	}

	public function getCartAccountList(Request $request)
	{
		$cmd = "accountlist";	
		$pin = $request->input('pin', 'xuzhijie');
		$logisticstype = $request->input('logisticstype');
		$paytype = $request->input('paytype');
		//$addressid = $request->input('addressid', "");
		$couponcode = $request->input('couponcode', "");
		$token = $request->input('token', 'xxx');
		$params = array(
			'cmd' => $cmd,
			'pin' => $pin,
			'logisticstype' => $logisticstype,
			'paytype' => $paytype,
		//	'addressid' => $addressid,
			'couponcode' => $couponcode,
			'token' => $token
		);
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
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
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
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
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		return $result;
	}

	public function addBatchCart(Request $request)
	{
		$cmd = "batchaddskus";
		$operate = $request->input('operate');
		$pin = $request->input('pin', "xuzhijie");
		$token = $request->input('token', 1);
		$params = array(
			'cmd' => $cmd,
			'operate' => $operate,
			'pin' => $pin,
			'token' => $token
		);		
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		return $result;
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
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		return $result;
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
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		return $result;
	}

	public function operateCartProduct(Request $request)
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
				'sku' => $sku,
				'pin' => $pin,
				'token' => $token
			);		
			$system = "";
			$service = "cart";
			$result = $this->request('openapi', $system, $service, $params);
			if(!empty($result) && $result['success']){
				return Redirect('/shopping/cart');	
			}
		
		}
	}

	public function verifyCoupon(Request $request)
	{
		$cmd = "verifyCoupon";
		$couponcode = $request->input('couponcode', "61et");
		$token = $request->input('token', "xxx");
		$params = array(
			'cmd' => $cmd,
			'couponcode' => $couponcode,
			'token' => $token
		);
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		return $result;
	}


}
