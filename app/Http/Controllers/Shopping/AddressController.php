<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

use Illuminate\Support\Facades\Cache;

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
		$cmd = 'list';
		$uuid = $request->input("uuid", "608341ba8191ba1bf7a2dec25f0158df3c6670da");
		$pin = $request->input("pin", "3e448648b3814c999b646f25cde12b2a");
		$token = $request->input("token", "71b5cb03786f9d6207421caeab91da8f");
		$params = array(
			'cmd'=>$cmd,
			'uuid'=>$uuid,
			'pin'=>$pin,
			'token'=>$token
		);
/*		$user = Cache::get('user');
		$params = array(
			'cmd' => 'list',
			'uuid' => $request->input('uuid', md5($user['login_email'])),
			'pin' => $user['pin'],
			'token' => $user['token'],
		);*/
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
/*		$cmd = 'gdefault';
		$uuid = $request->input('uuid', "608341ba8191ba1bf7a2dec25f0158df3c6670da");
		$pin = $request->input("pin", "3e448648b3814c999b646f25cde12b2a");
		$token = $request->input("token", "71b5cb03786f9d6207421caeab91da8f");
		$params = array(
			'cmd'=>$cmd,
			'uuid'=>$uuid,
			'pin'=>$pin,
			'token'=>$token
		);*/
		$user = Cache::get('user');
		$params = array(
			'cmd' => 'gdefault',
			'uuid' => $request->input('uuid', md5($user['login_email'])),
			'pin' => $user['pin'],
			'token' => $user['token']
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
/*		$cmd = 'add';
		$pin = $request->input("pin", "e052d5681da34fad83d0597b7b72acf7");
		$email = $request->input("email");
		$tel = $request->input("tel");
		$name = $request->input("name");
		$addr1 = $request->input("addr1");
		$addr2 = $request->input("addr2");
		$city = $request->input("city");
		$state = $request->input("state");
		$zip = $request->input("zip");
		$idnum = $request->input("idnum");
		$country = $request->input("country");
		$isd = $request->input("isd", 0);
		$token = $request->input("token", "eeec7a32dcb6115abfe4a871c6b08b47");
		$params = array(
			'cmd'=>$cmd,
			'pin'=>$pin,
			'email'=>$email,
			'tel'=>$tel,
			'name'=>$name,
			'addr1'=>$addr1,
			'addr2'=>$addr2,
			'city'=>$city,
			'state'=>$state,
			'zip'=>$zip,
			'idnum'=>$idnum,
			'country'=>$country,
			'isd'=>$isd,
			'token'=>$token
		);*/
		$user = Cache::get('user');
		$params = array(
			'cmd' => 'add',
			'pin' => $user['pin'],
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
			'token' => $user['token']
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
	 * 修改用户收货地址
	 *
	 * @author zhangtao@evermarker.net
	 * @params Request
	 * @return Array
	 * */
	public function modifyUserAddr(Request $request)
	{
/*		$cmd = 'modify';
		$pin = $request->input("pin", "e052d5681da34fad83d0597b7b72acf7");
		$aid = $request->input("aid");
		$email = $request->input("email");
		$tel = $request->input("tel");
		$name = $request->input("name");
		$addr1 = $request->input("addr1");
		$addr2 = $request->input("addr2");
		$city = $request->input("city");
		$state = $request->input("state");
		$zip = $request->input("zip");
		$idnum = $request->input("idnum");
		$country = $request->input("country");
		$isd = $request->input("isd", 0);
		$token = $request->input("token", "eeec7a32dcb6115abfe4a871c6b08b47");
		$params = array(
			'cmd'=>$cmd,
			'pin'=>$pin,
			'aid'=>$aid,
			'email'=>$email,
			'tel'=>$tel,
			'name'=>$name,
			'addr1'=>$addr1,
			'addr2'=>$addr2,
			'city'=>$city,
			'state'=>$state,
			'zip'=>$zip,
			'idnum'=>$idnum,
			'country'=>$country,
			'isd'=>$isd,
			'token'=>$token
		);*/
		$user = Cache::get('user');
		$params = array(
			'cmd' => 'modify',
			'pin' => $user['pin'],
			'aid' => $user['aid'],
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
			'token' => $user['token']
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
/*		$cmd = "mdefault";
		$pin = $request->input("pin", "e052d5681da34fad83d0597b7b72acf7");
		$aid = $request->input("aid");
		$isd = $request->input("isd");
		$params = array(
			'cmd'=>$cmd,
			'pin'=>$pin,
			'aid'=>$aid,
			'isd'=>$isd
		);*/
		$user = Cache::get('user');
		$params = array(
			'cmd' => 'mdefault',
			'pin' => $user['pin'],
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
/*		$cmd = "del";
		$pin = $request->input("pin", "e052d5681da34fad83d0597b7b72acf7");
		$aid = $request->input("aid");
		$token = $request->input("token", "eeec7a32dcb6115abfe4a871c6b08b47");
		$params = array(
			'cmd'=>$cmd,
			'pin'=>$pin,
			'aid'=>$aid,
			'token'=>$token
		);*/
		$user = Cache::get('user');
		$params = array(
			'cmd' => "del",
			'pin' => $user['pin'],
			'aid' => $request->input('aid'),
			'token' => $user['token']
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
		//$user = Cache::get('user');
		$params = array(
			'cmd'=>'country',
		//	'token'=> $user['token']
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
