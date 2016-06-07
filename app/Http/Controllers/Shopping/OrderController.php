<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

class OrderController extends ApiController
{
	public function index(Request $request)
	{
		$orderList = $this->getOrderList($request);
		return View('shopping.orderlist', ['data' => $orderList['data']]);

	}

	public function getOrderList(Request $request)
	{
		$cmd = "ordlist";
		$pin = $request->input("pin", "e052d5681da34fad83d0597b7b72acf7");
		$num = $request->input("num", 1);
		$size = $request->input("size", 100);
		$token = $request->input('token', 11);
		$params = array(
			'cmd' => $cmd,
			'pin' => $pin,
			'num' => $num,
			'size' => $size,
			'token' => $token
		);
		$system = "";
		$service = "order";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		return $result;
	}

	public function OrderDetail(Request $request, $subno)
	{
		$cmd = 'detail';
		$pin = $request->input('pin', 'e052d5681da34fad83d0597b7b72acf7');
		//$subno = $request->input('subno', 14601491629216);
		$token = $request->input('token', 1);
		$params = array(
			'cmd' => $cmd,
			'pin' => $pin,
			'subno' => $subno,
			'token' => $token
		);
		$system = "";
		$service = "order";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		return View('shopping.orderdetail', ['data'=>$result['data']]);
	}

	public function orderSubmit(Request $request)
	{
		$cmd = "ordsubmit";
		$pin = $request->input('pin', 'e052d5681da34fad83d0597b7b72acf7');
		$aid = $request->input('aid', 15);			
		$paym = $request->input('paym', 'paypal');
		$cps = $request->input('cps', 'cd333');
		$remark = $request->input('remark', 'quickly');
		$stype = $request->input('stype', 1);
		$src = $request->input('src', 1);
		$ver = $request->input('ver', 1);
		$token = $request->input('token', 1);
		$params = array(
			'cmd' => $cmd,
			'pin' => $pin,
			'aid' => $aid,
			'paym' => $paym,
			'cps' => $cps,
			'remark' => $remark,
			'stype' => $stype,
			'src' => $src,
			'ver' => $ver,
			'token' => $token
		);
		$system = "";	
		$service = "order";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		return $result;
	}





















}