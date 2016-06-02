<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
	const API_SYSTEM = "";
	const API_SERVICE = "user";

	public function signup(Request $request)	
	{
		$cmd = "signup";		
		$uuid = $request->input('uuid', "199999999999");
		$email = $request->input('email', "kangdong111@evermarker.net");
		//$pw = md5($request->input('pw'));
		$pw = $request->input('dfafdasEFDdadfa');
		$nick = $request->input('nick', "kangdong");
		$token = $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47");
		$params = array(
			'cmd'=>$cmd,
			'uuid'=>$uuid,
			'email'=>$email,
			'pw'=>$pw,
			'nick'=>$nick,
			'token'=>$token	
		);
		$result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		return $result;
	}

	public function login(Request $request)
	{
		$cmd = "login";
		$uuid = $request->input('uuid', "199999999999");
		$email = $request->input('email', "kangdongno.4@163.com");
		//$pw = md5($request->input('pw'));
		$pw = $request->input('pw');
		$token = $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47");
		$params = array(
			'cmd'=>$cmd,
			'uuid'=>$uuid,
			'email'=>$email,
			'pw'=>$pw,
			'token'=>$token	
		);
		$result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params, 300);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		dd($result);
		return $result;
	}

	public function forgetPassword(Request $request)
	{
		$cmd = "forgetwd";
		$uuid = $request->input('uuid', "199999999999");
		$email = $request->input('email', "kangdongno.4@163.com");
		//$pw = md5($request->input('pw'));
		$token = $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47");
		$params = array(
			'cmd'=>$cmd,
			'uuid'=>$uuid,
			'email'=>$email,
			'token'=>$token	
		);
		$result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params, 300);
		if(empty($result)){
	 		$result['success'] = false;	
			$result['error_msg'] = "Data access failed";
			$result['data'] = array();
		}
		dd($result);
		return $result;
	}

	public function modifyUserPwd(Request $request)
	{
		$cmd = "modifypwd";
	}


}
