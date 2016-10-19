<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;

class AddressController extends ApiController
{
	/*
	 * 获取用户收货地址列表
	 *
	 * @author zhangtao@evermarker.net
	 * @params Request
	 * @return Array
	 *
	 * */
	public function getUserAddrList(Request $request)		
	{
		$params = array(
			'cmd' => 'list',
			'uuid' => $_COOKIE['uid'],
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
		);
		$system = "";
		$service = "useraddr";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		return $result;
	}

	/*
	 * 获取用户默认收货地址
	 *
	 * @author zhangtao@evermarker.net
	 * @param Request
	 * @return Array
	 *
	 * */
	public function getUserDefaultAddr(Request $request)
	{
		$params = array(
			'cmd' => 'gdefault',
			'uuid' => @$_COOKIE['uid'],
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
		);

		$system = "";
		$service = "useraddr";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		return $result;
	}

	/*
	 * 增加用户收货地址
	 *
	 * @author zhangtao@evermarker.net
	 * @params Request
	 * @return Array
	 *
	 * */
	public function addUserAddr(Request $request)
	{

		$params = array(
			'cmd' => 'add',
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'email' => $request->input('email'),
			'tel' => $request->input('tel'),
			'name' => $request->input("name"),
			'addr1' => $request->input("addr1"),
			'addr2' => $request->input("addr2"),
			'city' => $request->input("city"),
			'state' => $request->input("state"),
			'zip' => $request->input("zip"),
			'idnum' => $request->input("idnum"),
			'country' => $request->input("country"),
			'isd' => $request->input("isd", 0),
		);

		$system = "";
		$service = "useraddr";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Failed to add address";
			$result['data'] = array();
		}else{
			if($result['success']){
				$result['redirectUrl'] = "/user/shippingaddress";
			}
		}
		return $result;
	}

	/*
	 * 修改用户收货地址
	 *
	 * @author zhangtao@evermarker.net
	 * @params Request
	 * @return Array
	 * */
	public function modifyUserAddr(Request $request)
	{

		$params = array(
			'cmd' => 'modify',
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'aid' => $request->input('aid'),
			'email' => $request->input('email'),
			'tel' => $request->input('tel'),
			'name' => $request->input("name"),
			'addr1' => $request->input("addr1"),
			'addr2' => $request->input("addr2"),
			'city' => $request->input("city"),
			'state' => $request->input("state"),
			'zip' => $request->input("zip"),
			'idnum' => $request->input("idnum"),
			'country' => $request->input("country"),
			'isd' => $request->input("isd", 0),
		);

		$system = "";
		$service = "useraddr";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Failed to add address";
			$result['data'] = array();
		}
		return $result;
		
	}

	/*
	 * 修改用户默认地址
	 *
	 * @author zhangtao@evermarker.net
	 * @params Request
	 * @return Array
	 *
	 * */
	public function modifyUserDefaultAddr(Request $request)
	{

		$params = array(
			'cmd' => 'mdefault',
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'aid' => $request->input('aid'),
			'isd' => $request->input('isd')
		);
		$system = "";
		$service = "useraddr";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		return $result;
	}

	/*
	 * 删除用户收货地址
	 *
	 * @author zhangtao@evermarker.net
	 * @param Request
	 * @return Array
	 *
	 * */
	public function delUserAddr(Request $request)
	{

		$params = array(
			'cmd' => "del",
			'token' => Session::get('user.token'),
			'pin' => Session::get('user.pin'),
			'aid' => $request->input('aid'),
		);
		$system = "";
		$service = "useraddr";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		return $result;
	}

	/*
	 * 获取国家列表
	 *
	 * @author zhangtao@evermarker.net
	 * @param Request
	 * @return Array
	 *
	 * */
	public function getCountry(Request $request)
	{
		$params = array(
			'cmd'=>'country',
			'token'=>Session::get('user.token'),
			'pin'=>Session::get('user.pin')
		);
		$system = "";
		$service = "useraddr";
		$result = $this->request('openapi', $system, $service, $params);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}else{
			if($result['success']){
				$commonlist = array();
				for($index = 0; $index < $result['data']['amount']; $index++)
				{
					$commonlist[] = array_shift($result['data']['list']);
				}
				$result['data']['commonlist'] = $commonlist;
			}
		}
		return $result;
	}
}
