<?php 
namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

class ShoppingController extends ApiController
{
	public function index(Request $request)	
	{
		$result = $this->getShoppingCategoryList($request);
		return View('shopping.list', ['categories'=>$result['data']['list']]);
	}

	public function getShoppingCategoryList(Request $request)
	{
		$params = array(
			'cmd'=>'categorylist',
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
		$user = Cache::get('user');
		$params = array(
			'recid'=>$request->input('recid'),
			'pin'=>$user['pin'],
			'uuid'=>$request->input('uuid', md5($user['pin'])),
			'cid'=>$request->input('cid'),
			'pagenum'=>$request->input('pagenum', 1),
			'pagesize'=>$request->input('pagesize', 5),
			'extra'=>$request->input('extra_kv', "")
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
		$params = array(
			'cmd'=>'checkstock',
			'skus'=>$request->input('skus')
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
