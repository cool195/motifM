<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

class ProductController extends ApiController
{
	public function index(Request $request, $spu)		
	{
		$cmd = 'productdetail';
//		$spu = 10000086;
		if(empty($spu)){
			return redirect('/shopping');
		}
//		$src = $request->input('src', "");
//		$ver = $request->input('ver', "");
//		$version = $request->input('version', 1.0);
//		$uuid = $request->input('uuid', "4560aecaa5dd9d92e169a402bb0cf71c74992f50");
//		$pin = $request->input('pin', "xuzhijie");
//		$token = $request->input('token', "51afe0b7c5331d3df4920c46a0ee4ca2");
		$params = array(
			'cmd'=>$cmd, 
			'spu'=>$spu
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
		if(empty($result) || false == $result['success'] || empty($result['data']))
		{
			return redirect('/shopping');
		}		
		return View('shopping.detail', ['data' => $result['data']]);
	}

	public function getProductDetail(Request $request, $spu)		
	{
		$cmd = 'productdetail';	
		$spu = $request->input('spu', 10000086);
		// $src = $request->input('src', "");
		// $ver = $request->input('ver', "");
		// $version = $request->input('version', 1.0);
		// $uuid = $request->input('uuid', "4560aecaa5dd9d92e169a402bb0cf71c74992f50");
		// $pin = $request->input('pin', "xuzhijie");
		// $token = $request->input('token', "51afe0b7c5331d3df4920c46a0ee4ca2");
		$params = array(
			'cmd'=>$cmd, 
			'spu'=>$spu,
			// 'src'=>$src,
			// 'ver'=>$ver,
			// 'version'=>$version,
			// 'uuid'=>$uuid,
			// 'pin'=>$pin,
			// 'token'=>$token
		);
		$system = "";
		$service = "product";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;
			$result['data'] = array();
			$result['error_msg'] = "Data access failed";
		}
		//return View('shopping.detail', ['data' => $result['data']]);
		return $result;
	}

}
