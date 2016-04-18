<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

class ProductController extends ApiController
{
	public function index(Request $request, $spu)		
	{
		$cmd = 'productdetail';	
		$spu = 10000025;	
		$src = $request->input('src', "");
		$ver = $request->input('ver', "");
		$version = $request->input('version', 1.0);
		$uuid = $request->input('uuid', "4560aecaa5dd9d92e169a402bb0cf71c74992f50");
		$pin = $request->input('pin', "xuzhijie");
		$token = $request->input('token', "51afe0b7c5331d3df4920c46a0ee4ca2");
		$params = array(
			'cmd'=>$cmd, 
			'spu'=>$spu,
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
		dd($result);
		if($result['success'])
		{
			return $result;
		}		
		
	}

	public function testindex(Request $request, $spu)		
	{
		$cmd = 'productdetail';	
		$spu = 10000025;	
		$src = $request->input('src', "");
		$ver = $request->input('ver', "");
		$version = $request->input('version', 1.0);
		$uuid = $request->input('uuid', "4560aecaa5dd9d92e169a402bb0cf71c74992f50");
		$pin = $request->input('pin', "xuzhijie");
		$token = $request->input('token', "51afe0b7c5331d3df4920c46a0ee4ca2");
		$params = array(
			'cmd'=>$cmd, 
			'spu'=>$spu,
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
		if($result['success'])
		{
			return View('shopping.detail', ['data' => $result['data']]);
		}		
		
	}
}
