<?php 
namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
class ShoppingController extends ApiController
{
	public function index(Request $request)
	{
		$result = $this->getShoppingCategoryList($request);
		return View('shopping.list', ['categories' => $result['data']['list']]);
	}

	public function getShoppingCategoryList(Request $request)
	{
		$params = array(
			'cmd' => 'categorylist',
		);
		$system = "";
		$service = "product";
		$result = $this->request('openapi', $system, $service, $params);
		if (empty($result['success'])) {
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data']['list'] = array();
		}
		return $result;
	}

	//todo
	public function getShoppingProductList(Request $request)
	{
		$params = array(
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'recid' => $request->input('recid', '100000'),
			'uuid' => $request->input('uuid', 'xuzhijie'),
			'cid' => $request->input('cid', '0'),
			'pagenum' => $request->input('pagenum', 1),
			'pagesize' => $request->input('pagesize', 5),
			'extra' => $request->input('extra_kv', "")
		);
		$system = "";
		$service = "rec";
		$result = $this->request('openapi', $system, $service, $params);
		if (empty($result)) {
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data']['list'] = array();
		}
		return $result;
	}

	public function checkStock(Request $request)
	{
		$params = array(
			'cmd' => 'checkstock',
			'skus' => $request->input('skus')
		);
		$system = "";
		$service = "stock";
		$result = $this->request('openapi', $system, $service, $params);
		if (empty($result)) {
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data']['list'] = array();
		}
		return $result;
	}

	public function feedback(Request $request)
	{
		$result = $this->getFeedbackList($request);
		return View('Other.CustomerSupport', ['customers' => $result['data']['list'][3]]);
	}

	public function getFeedbackList(Request $request)
	{
		$params = array(
			'cmd' => 'list',
			'pin' => Session::get('user.pin'),
			'token' => Session::get('user.token'),
		);
		if ($request->has('type')) {
			$params['type'] = $request->input('type');
		}
		$result = $this->request('openapi', '', 'feedback', $params);
		if (!empty($result) && $result['success']) {
			if (!empty($result['data']['list'])) {
				$lists = array();
				foreach ($result['data']['list'] as $list) {
					$lists[$list['feedback_type']] = $list;
				}
				$result['data']['list'] = $lists;
			}
		}
		return $result;
	}

	public function addSupport(Request $request)
	{
		$type = $request->input('type');
		$params = array(
			'cmd' => "support",
			'content' => $request->input('content'),
			'email' => $request->input('email'),
			'type' => $type,
			'stype' => $request->input('stype'),
		);
		if(1 == $type){
			$params['spu'] = $request->input('spu');
		}elseif(2 == $type){
			$params['orderno'] = $request->input('orderno');
		}
		$result = $this->request('openapi', '', 'feedback', $params);
		return $result;
	}











}
