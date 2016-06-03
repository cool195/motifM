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
		$result['data']['spuAttrs'] = $this->getSpuAttrsStockStatus($result['data']['spuAttrs'], $result['data']['skuExps']);

		return View('shopping.detail', ['data' => $result['data']]);
	}

	public function getProductDetail(Request $request, $spu)		
	{
		$cmd = 'productdetail';	
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
		}else{
			$result['data']['spuAttrs'] = $this->getSpuAttrsStockStatus($result['data']['spuAttrs'], $result['data']['skuExps']);
		}
		//return View('shopping.detail', ['data' => $result['data']]);
		return $result;
	}

	private function getSpuAttrsStockStatus(Array $spuAttrs, Array $skuExps)
	{
		$spuAttrsCopy = array();
		foreach($spuAttrs as $spuAttr)
		{
			$skuAttrsValues = array();
			foreach($spuAttr['skuAttrValues'] as $skuAttrValue)
			{
				$skuAttrValue['stock'] = $this->getSkuStockStatus($skuAttrValue['skus'], $skuExps);
				$skuAttrsValues[] = $skuAttrValue;
			} 
			$spuAttr['skuAttrValues'] = $skuAttrsValues;
			$spuAttrsCopy[] = $spuAttr;
		}
		return $spuAttrsCopy;
	}

	private function getSkuStockStatus($skus, $skuExps)
	{
		$flag = false;
		foreach($skus as $sku){
			foreach($skuExps as $skuExp)
			{
				if($sku == $skuExp['sku']){
					if($skuExp['stock_qtty'] > 0){
						$flag = true;
						break;
					}
				}
			}
		}
		return $flag;
	}








}
