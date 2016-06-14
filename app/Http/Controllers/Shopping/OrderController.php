<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;

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
		$num = $request->input("num", 1);
		$size = $request->input("size", 100);
		$params = array(
			'cmd' => $cmd,
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'num' => $num,
			'size' => $size,
		);
		$system = "";
		$service = "order";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}else{
			$result = $this->resultJsonDecode($result);
		}
		return $result;
	}

	private function resultJsonDecode(Array $result)
	{
		$orderList = array();
		foreach($result['data']['list'] as $order)
		{
			$subOrderList = array();
			foreach($order['subOrderList'] as $subOrder)
			{
				$lineOrderList = array();
				foreach($subOrder['lineOrderList'] as $lineOrder)
				{
					if(!empty($lineOrder['attrValues'])){
						$lineOrder['attrValues'] = json_decode($lineOrder['attrValues'], true);
					}
					if(!empty($lineOrder['vas_info'])){
						$lineOrder['vas_info'] = json_decode($lineOrder['vas_info'], true);
					}
					$lineOrderList[] = $lineOrder;
				}
				$subOrder['lineOrderList'] = $lineOrderList;
				$subOrderList[] = $subOrder;
			}
			$order['subOrderList'] = $subOrderList;
			$orderList[] = $order;
		}
		$result['data']['list'] = $orderList;
		return $result;
	}

	public function OrderDetail(Request $request, $subno)
	{
		$cmd = 'detail';
		$params = array(
			'cmd' => $cmd,
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'subno' => $subno,
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
		$aid = $request->input('aid', 15);			
		$paym = $request->input('paym', 'paypal');
		$cps = $request->input('cps', 'cd333');
		$remark = $request->input('remark', 'quickly');
		$stype = $request->input('stype', 1);
		$src = $request->input('src', 1);
		$ver = $request->input('ver', 1);
		$params = array(
			'cmd' => $cmd,
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'aid' => $aid,
			'paym' => $paym,
			'cps' => $cps,
			'remark' => $remark,
			'stype' => $stype,
			'src' => $src,
			'ver' => $ver,
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