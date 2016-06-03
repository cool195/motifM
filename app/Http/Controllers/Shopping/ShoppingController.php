<?php 
namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

class ShoppingController extends ApiController
{
	public function index(Request $request)	
	{
		$cmd = $request->input('cmd', 'categorylist');
//		$src = $request->input('src', "");
//		$ver = $request->input('ver', "");
//		$version = $request->input('version', 1.0);
//		$uuid = $request->input('uuid', "4560aecaa5dd9d92e169a402bb0cf71c74992f50");
//		$pin = $request->input('pin', "9ee2ddaadf134a988f62bea9705a4d8f");
//		$token = $request->input('token', "51afe0b7c5331d3df4920c46a0ee4ca2");
		$params = array(
			'cmd'=>$cmd,
//			'src'=>$src,
//			'ver'=>$ver,
//			'version'=>$version,
//			'uuid'=>$uuid,
//			'pin'=>$pin,
//			'token'=>$token
		);

		$system = "";
		$service = "product";
		$result = $this->request('openapi', $system, $service, $params);
		//dd($result);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data']['list'] = array();
		}
		return View('shopping.list', ['categories'=>$result['data']['list']]);
	}

	public function getShoppingCategoryList(Request $request)
	{
		$cmd = $request->input('cmd', 'categorylist');	
//		$src = $request->input('src', "");
//		$ver = $request->input('ver', "");
//		$version = $request->input('version', 1.0);
//		$uuid = $request->input('uuid', "4560aecaa5dd9d92e169a402bb0cf71c74992f50");
//		$pin = $request->input('pin', "9ee2ddaadf134a988f62bea9705a4d8f");
//		$token = $request->input('token', "51afe0b7c5331d3df4920c46a0ee4ca2");
		$params = array(
			'cmd'=>$cmd, 
//			'src'=>$src,
//			'ver'=>$ver,
//			'version'=>$version,
//			'uuid'=>$uuid,
//			'pin'=>$pin,
//			'token'=>$token
		);
		
		$system = "";
		$service = "product";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result['success'])){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data']['list'] = array();
		}
		return $result;
	}

	public function getShoppingProductList(Request $request)
	{
		$recid = $request->input('recid', 100000);
		$pin = $request->input('pin', "xuzhijie");
		$uuid = $request->input('uuid', "xuzhijie");
		$cid = $request->input('cid', "367");
		$pagenum = $request->input('pagenum', 1);
		$pagesize = $request->input('pagesize', 5);
		$extra = $request->input('extra_kv', "");
		$params = array(
			'recid'=>$recid,
			'pin'=>$pin,
			'uuid'=>$uuid,
			'cid'=>$cid,
			'pagenum'=>$pagenum,
			'pagesize'=>$pagesize
		);
		$system = "";
		$service = "rec";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data']['list'] = array();
		}
		return $result;
	}

	public function checkStock(Request $request)
	{
		$cmd = "checkstock";
		$skus = $request->input('skus', '1000000038_1,1000000039_10');
		$params = array(
			'cmd'=>$cmd,
			'skus'=>$skus
		);
		$system = "";
		$service = "stock";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data']['list'] = array();
		}
		return $result;
	}












}
