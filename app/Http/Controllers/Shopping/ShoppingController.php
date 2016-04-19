<?php 
namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

class ShoppingController extends ApiController
{
	public function index(Request $request)	
	{
		$cmd = $request->input('cmd', 'categorylist');	
		$src = $request->input('src', "");
		$ver = $request->input('ver', "");
		$version = $request->input('version', 1.0);
		$uuid = $request->input('uuid', "4560aecaa5dd9d92e169a402bb0cf71c74992f50");
		$pin = $request->input('pin', "9ee2ddaadf134a988f62bea9705a4d8f");
		$token = $request->input('token', "51afe0b7c5331d3df4920c46a0ee4ca2");
		$params = array(
			'cmd'=>$cmd, 
			'src'=>$src,
			'ver'=>$ver,
			'version'=>$version,
			'uuid'=>$uuid,
			'pin'=>$pin,
			'token'=>$token
		);
		
		$system = "product";	
		$service = "product";
		$result = $this->request('openapi', $system, $service, $params, 300, false);
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
		$src = $request->input('src', "");
		$ver = $request->input('ver', "");
		$version = $request->input('version', 1.0);
		$uuid = $request->input('uuid', "4560aecaa5dd9d92e169a402bb0cf71c74992f50");
		$pin = $request->input('pin', "9ee2ddaadf134a988f62bea9705a4d8f");
		$token = $request->input('token', "51afe0b7c5331d3df4920c46a0ee4ca2");
		$params = array(
			'cmd'=>$cmd, 
			'src'=>$src,
			'ver'=>$ver,
			'version'=>$version,
			'uuid'=>$uuid,
			'pin'=>$pin,
			'token'=>$token
		);
		
		$system = "product";	
		$service = "product";
		$result = $this->request('openapi', $system, $service, $params, 300, false);
		if(empty($result['success'])){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data']['list'] = array();
		}
		dd($result);
		return $result;
	}

	public function getShoppingProductList(Request $request)
	{
		$recid = $request->input('recid', 100);  
		$pin = $request->input('pin', "xxx123");
		$uuid = $request->input('uuid', "");
		$cid = $request->input('cid', "135");
		$pagenum = $request->input('pagenum', 1);
		$pagesize = $request->input('pagesize', 20);
		$extra = $request->input('extra', "");
		$encode = $request->input("encode", "UTF-8"); 
		$exp = $request->input('exp', "");
		$token = $request->input("token", "1111");
		$params = array(
			'recid'=>$recid,
			'pin'=>$pin,
			'uuid'=>$uuid,
			'cid'=>$cid,
			'pagenum'=>$pagenum,
			'pagesize'=>$pagesize,
			'exp'=>$exp,
			'encode'=>$encode,
			'token'=>$token
		);
		$system = "feed";	
		$service = "rec";
		$result = $this->request('openapi', $system, $service, $params, 300, false);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data']['list'] = array();
		}
		dd($result);
		return $result;
	}
}
