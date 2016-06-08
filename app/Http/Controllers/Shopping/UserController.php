<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class UserController extends ApiController
{
    const API_SYSTEM = "";
    const API_SERVICE = "user";

    public function index(Request $request)
    {
        return View('shopping.profilesetting');
    }

    public function register(Request $request)
    {
        return View('shopping.register');
    }

    public function signup(Request $request)
    {
        $params = array(
            'cmd' => 'signup',
            'uuid' => $request->input('uuid', "199999999999"),
            'email' => $request->input('email', "kangdong111@evermarker.net"),
            'pw' => $request->input('pw', "dfafdasEFDdadfa"),
            'nick' => $request->input('nick', "kangdong"),
            'token' => $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47")
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }

    public function login(Request $request)
    {
        return View('shopping.login');
    }

    public function loginCheck(Request $request)
    {
        $params = array(
            'cmd' => "login",
            'uuid' => $request->input('uuid', "199999999999"),
            'email' => $request->input('email', "kangdong111@evermarker.net"),
            'pw' => $request->input('pw', "dfafdasEFDdadfa"),
            'token' => $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47")
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        } else {
            if ($result['success']) {
                Session::put('user', $result['data']);
            }
        }
        return $result;
    }

    public function signout(Request $request)
    {
        $params = array(
            'cmd' => "signout",
            'pin' => $request->input('pin', "e052d5681da34fad83d0597b7b72acf7"),
            'token' => $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47")
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }

    public function reset(Request $request)
    {
        return View('shopping.resetpwd');
    }

    public function resetPassword(Request $request)
    {
        $params = array(
            'cmd' => "modifyfgttpwd",
            'pw' => $request->input('pw'),
            'tp' => $request->input('tp'),
            'sig' => $request->input('sig')
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
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
            'cmd' => $cmd,
            'uuid' => $uuid,
            'email' => $email,
            'token' => $token
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }

    public function modifyUserPwd(Request $request)
    {
        $cmd = "modifypwd";
        $params = array(
            'cmd' => $cmd,
            'pin' => $request->input('pin', "2fed8e13f80a4980a86437d4f6dd5917"),
            'oldpwd' => $request->input('oldpwd', "11111"),
            'pw' => $request->input('pw', "8888"),
            'token' => $request->input('token', "199999999999")
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }

    public function tryPrtLogin(Request $request)
    {
        $params = array(
            'cmd' => "tplogin",
            'uuid' => $request->input('uuid', ""),
            'type' => $request->input('type', 2),
            'reinfo' => $request->input('reinfo', ""),
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }

    public function getUserDetailInfo(Request $request)
    {
        $params = array(
            'cmd' => "detail",
            'pin' => $request->input('pin', "e052d5681da34fad83d0597b7b72acf7"),
            'token' => $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47")
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }

    public function modifyUserInfo(Request $request)
    {
        $params = array(
            'cmd' => 'modify',
            'pin' => $request->input('pin', 'e052d5681da34fad83d0597b7b72acf7'),
            'nick' => $request->input('nick', 'kangdong'),
            'icon' => $request->input('icon'),
            'token' => $request->input('token', "eeec7a32dcb6115abfe4a871c6b08b47")
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }

}

