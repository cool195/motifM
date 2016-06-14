<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;

class CartController extends ApiController
{
	/*
	 * 购物车页面接口
	 *
	 * @author zhangtao@evermarker.net
	 *
	 * */
	public function index(Request $request)
	{
		$cartList = $this->getCartList($request); 
		$saveList = $this->getCartSaveList($request);
		return View('shopping.cart', [
			'cartData' => $cartList['data'], 
			'saveData' => $saveList['data']
		]);
	}

	/*
	 * 订单确认接口
	 *
	 * @author zhangtao@evermarker.net
	 *
	 * */
	public function orderCheckout(Request $request)
	{
		$result = $this->getCartAccountList($request);
		$defaultAddr = $this->getUserDefaultAddr();
		$defaultPayMethod = $this->getDefaultPayMethod();
		if(empty($result['data'])){
			return redirect('/shopping');
		}
		return View('shopping.ordercheckout', [
			'data'=>$result['data'], 
			'addr'=>$defaultAddr['data'],
			'pay'=>$defaultPayMethod['data']
		]);
	}

	private function getUserDefaultAddr()
	{
		if(Session::has('defaultAddr'))
		{
			$result = Session::get('defaultAddr');
		}else{
			$params = array(
				'cmd'=> 'gdefault',
				'uuid'=> Session::get('user.uuid'),
				'token' => Session::get('user.token'),
				'pin' => Session::get('user.pin'),
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
		$params = array(
			'cmd'=>$cmd,
			'uuid'=>$uuid,
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
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
		$params = array(
			'cmd'=>"getdefault",
			'uuid'=>Session::get('user.uuid'),
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

	public function coupon(Request $request)
	{
		return View('shopping.ordercheckout_addcoupon');
	}

	public function message(Request $request)
	{
		return View('shopping.ordercheckout_message');
	}

	/*
	 * 获取购物车数量
	 *
	 * @author zhangtao@evermarker.net
	 * */
	public function getCartAmount(Request $request)		
	{
		$params = array(
			'cmd' => 'amount',
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
		);
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}else{
			if($result['success']){
				if(empty($result['data']['saveAmout'])){
					$result['data']['saveAmout'] = 0;
				}
				if(empty($result['data']['skusAmout'])){
					$result['data']['skusAmout'] = 0;
				}
			}
		}
		return $result;
	}

	/*
	 * 获取购物车商品列表
	 *
	 * @author zhangtao@evermarker.net
	 * @param Request
	 * @return Array
	 *
	 * */
	public function getCartList(Request $request) 
	{

		$params = array(
			'cmd' =>"cartlist",
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
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

	/*
	 * 获取购物车结算商品列表
	 *
	 * @author zhangtao@evermarker.net
	 * @param Request
	 * @return Array
	 *
	 * */
	public function getCartAccountList(Request $request)
	{

		$params = array(
			'cmd'=>'accountlist',
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'logisticstype'=>$request->input('logisticstype'),
			'paytype'=>$request->input('paytype'),
			'couponcode'=>$request->input('couponcode')
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

	/*
	 * 获取购物车暂存商品列表
	 *
	 * @author zhangtao@evermarker.net
	 * @param Request
	 * @return Array
	 *
	 * */
	public function getCartSaveList(Request $request)
	{
		$params = array(
			'cmd' => 'savelist',
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
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
		$params = array(
			'cmd' => 'addsku',
			'operate' => json_encode($request->input('operate')),
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
		);
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}else{
			if($result['success']){
				$result['redirectUrl'] = "";
			}
		}
		return $result;
	}

	public function addBatchCart(Request $request)
	{

		$params = array(
			'cmd' => 'batchaddskus',
			'operate' => $request->input('operate'),
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
		);
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		return $result;
	}

	public function alterCartProQtty(Request $request)
	{
		$params = array(
			'cmd' => 'alterqtty',
			'sku' => $request->input('sku'),
			'qtty' => $request->input('qtty'),
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
		);
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		return $result;
	}

	/*
	 * 立即购买接口
	 *
	 * @author zhangtao@evermarker.net
	 *
	 * @return Array
	 * */
	public function promptlyBuy(Request $request)
	{

		$params = array(
			'cmd' => 'promptlybuy',
			'operate' => json_encode($request->input('operate')),
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
		);
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		if($result['success']){
			$result['redirectUrl'] = '/cart/ordercheckout';
		}
		return $result;
	}
	/*
	 * 购物车其它操作接口
	 *
	 * @author zhangtao@evermarker.net
	 *
	 * @params Request
	 * @return Array
	 * */
	public function operateCartProduct(Request $request)
	{
		$cmdSelector = array("select", "cancal", "delsku", "save", "movetocart", "delsave");	
		$cmd = $request->input('cmd'); 
		$result = "";	
		if(in_array($cmd, $cmdSelector))
		{
			$params = array(
				'cmd' => $cmd,
				'sku' => $request->input('sku'),
				'token' => Session::get('user.token'),
				'pin' => Session::get('user.pin'),
			);
			$system = "";
			$service = "cart";
			$result = $this->request('openapi', $system, $service, $params);
			if(!empty($result) && $result['success']){
				return $result;
			}
		}
	}

	public function verifyCoupon(Request $request)
	{
		$params = array(
			'cmd' => 'verifyCoupon',
			'couponcode' => $request->input('couponcode'),
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
		);
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		return $result;
	}


}
