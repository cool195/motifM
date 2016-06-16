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
		$defaultPayMethod = $this->getDefaultPayMethod();
		$stype = !empty($request->input('stype')) ? $request->input('stype', 1) : 1; //必须加非空验证
		$defaultMethod = $this->getShippingMethodByStype($stype);
		if(empty($result['data'])){
			return redirect('/shopping');
		}
		return View('shopping.ordercheckout', [
			'data'=>$result['data'], 
			'addr'=>$this->getUserAddrByAid($request->input('aid', 0)),
			'paym'=> $request->input('paym', isset($defaultPayMethod['data']['type']) ? $defaultPayMethod['data']['type'] : "paypal"),
			'shipMethodList' => $this->getShippingMethod(),
			'defaultMethod' => $defaultMethod,
			'cps' => $request->input('cps', ""),
			'remark' => $request->input('remark', ""),
			'stype' => $defaultMethod['logistics_type'],
			'input' => $request->except('aid', 'stype')
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
		$input = $request->except('aid');
		$aid = $request->input('aid', 0);
		$result = $this->getUserAddressList();
		return View('shopping.ordercheckout_addresslist', ['data'=>$result['data'], 'input'=>$input, 'aid'=>$aid]);
	}

	private function getUserAddrByAid($aid)
	{
		$addrList = $this->getUserAddressList();
		$defaultAddr = $this->getUserDefaultAddr();
		$addr = $defaultAddr['data'];
		if($addrList['success'] && !empty($addrList['data']['list'])){
			if(isset($addrList['data']['list'][$aid])) {
				$addr = $addrList['data']['list'][$aid];
			}
		}
		return $addr;
	}

	private function getUserAddressList()
	{
		$cmd = 'list';
		$params = array(
			'cmd'=>$cmd,
			'uuid'=>Session::get('user.uuid'),
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
		}else{
			if($result['success'] && !empty($result['data']['list'])){
				$list = array();
				foreach($result['data']['list'] as $addr){
					$list[$addr['receiving_id']] = $addr;
				}
				$result['data']['list'] = $list;
			}
		}
		return $result;
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

	/*
	 * 跳转至填写Coupon页面
	 *
	 * @author zhangtao@evermarker.net
	 * */
	public function coupon(Request $request)
	{
		$input = $request->except('cps');
		$cps = $request->input('cps', "");
		return View('shopping.ordercheckout_addcoupon', ['input'=>$input, 'cps'=>$cps ]);
	}

	public function message(Request $request)
	{
		$input = $request->except('remark');
		$remark = $request->input('remark', "");
		return View('shopping.ordercheckout_message', ['input'=>$input, 'remark'=>$remark]);
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

	/*
	 * 添加购物车
	 *
	 * @author zhangtao@evermarker.net
	 * @return Array
	 * */
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

	/*
	 * 修改购物车商品数量
	 *
	 * @author zhangtao@evermarker.net
	 * @return Array
	 * */
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
	/*
	 * 验证Coupon是否有效
	 *
	 * @author zhangtao@evermarker.net
	 * @return Array
	 *
	 * */
	public function verifyCoupon(Request $request)
	{
		$params = array(
			'cmd' => 'verifyCoupon',
			'couponcode' => $request->input('couponcode', $request->input('cps')),
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
		);
		$system = "";
		$service = "cart";
		$result = $this->request('openapi', $system, $service, $params);
		return $result;
	}

	public function getShippingMethodByStype($stype)
	{
		$methodList = $this->getShippingMethod();
		$method = array();
		if( !empty($methodList)){
			$method = $methodList[1];
			if(isset($methodList[$stype])){
				$method = $methodList[$stype];
			}
		}
		return $method;
	}

	public function getShippingMethod()
	{
		$params = array(
			'cmd'=>'logis',
			'token' => Session::get('user.token')
		);
		$result = $this->request('openapi', "", "general", $params);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data']['list'] = array();
		}else{
			if($result['success'] && !empty($result['data']['list'])){
				$list = array();
				foreach($result['data']['list'] as $method){
					$list[$method['logistics_type']] = $method;
				}
				$result['data']['list'] = $list;
			}
		}
		return $result['data']['list'];
	}

/*	public function verifyCoupon(Request $request)
	{
		$result['success'] = true;
		return $result;
	}*/

}
