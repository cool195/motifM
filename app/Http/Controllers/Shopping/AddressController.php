<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

class AddressController extends ApiController
{
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

	public function getUserDefaultAddr(Request $request)
	{
		$cmd = 'gdefault';		
		$uuid = $request->input('uuid', "608341ba8191ba1bf7a2dec25f0158df3c6670da");
		$pin = $request->input("pin", "3e448648b3814c999b646f25cde12b2a");
		$token = $request->input("token", "71b5cb03786f9d6207421caeab91da8f");
		$params = array(
			'cmd'=>$cmd,
			'uuid'=>$uuid,
			'pin'=>$pin,
			'token'=>$token
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

	public function addUserAddr(Request $request)
	{
		$cmd = 'add';	
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
		);
		$system = "user";
		$service = "useraddr";
		$result = $this->request('openapi', $system, $service, $params, 300);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Failed to add address";
			$result['data'] = array();
		}
		dd($result);
		return $result;
	}

	public function modifyUserAddr(Request $request)
	{
		$cmd = 'modify';	
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
		);
		$system = "user";
		$service = "useraddr";
		$result = $this->request('openapi', $system, $service, $params, 300);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Failed to add address";
			$result['data'] = array();
		}
		dd($result);
		return $result;
		
	}
	
	public function modifyUserDefaultAddr(Request $request)
	{
		$cmd = "mdefault";	
		$pin = $request->input("pin", "e052d5681da34fad83d0597b7b72acf7");
		$aid = $request->input("aid");
		$isd = $request->input("isd");
		$params = array(
			'cmd'=>$cmd,
			'pin'=>$pin,
			'aid'=>$aid,
			'isd'=>$isd
		);
		$system = "user";
		$service = "useraddr";
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		dd($result);
		return $result;
	}

	public function delUserAddr(Request $request)
	{
		$cmd = "del";	
		$pin = $request->input("pin", "e052d5681da34fad83d0597b7b72acf7");
		$aid = $request->input("aid");
		$token = $request->input("token", "eeec7a32dcb6115abfe4a871c6b08b47");
		$params = array(
			'cmd'=>$cmd,
			'pin'=>$pin,
			'aid'=>$aid,
			'token'=>$token
		);
		$system = "user";
		$service = "useraddr";
		$result = $this->request('openapi', $system, $service, $params, 300);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		dd($result);
		return $result;
	}

	public function getCountry(Request $request)
	{
		$cmd = 'country';			
		$pin = $request->input("pin", "e052d5681da34fad83d0597b7b72acf7");
		$token = $request->input("token", "eeec7a32dcb6115abfe4a871c6b08b47");
		$params = array(
			'cmd'=>$cmd,
			'pin'=>$pin,
			'token'=>$token
		);
		$system = "user";
		$service = "useraddr";
		$result = $this->request('openapi', $system, $service, $params, 300);
		if(empty($result)){
			$result['success'] = false;
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		dd($result);
		return $result;
	}
}
