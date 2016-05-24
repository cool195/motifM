<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

class ShoppingController extends ApiController
{
	public function index(Request $request)	
	{
		$recid = $request->input('recid', '100');
		$pin = $request->input('pin', 'xxx123');
		$uuid = $request->input('uuid', '');
		$cid = $request->input('cid', '');
		$pagenum = $request->input('pagenum',1);
		$pagesize = $request->input('pagesize',20);
		$exp = $request->input('exp','');
		$encode = $request->input('encode','UTF-8');
		$token = $request->input('token','1111');
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

		$result = $this->request('Hot',$system, $service, $params);
		dd($result);
	}

	public function store()
	{
		dd("store");
	}

	public function create()
	{
		dd("create");
	}

	public function destroy($id)
	{
		dd("destroy" . $id);
	}

	public function update($id)
	{
		dd("update" . $id);
	}

	public function show($id)
	{
		dd("show" . $id);
	}

	public function edit($id)
	{
		dd("edit" . $id);
	}
}
