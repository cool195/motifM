<?php

namespace App\Http\Controllers\Shopping;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class UserController extends ApiController
{
    const API_SYSTEM = "";
    const API_SERVICE = "user";

    public function setting(Request $request)
    {
        return View('shopping.profilesetting');
    }
    
    public function changeProfile(Request $request)
    {
        return View('shopping.profilesetting_changeprofile');
    }

    public function register(Request $request)
    {
        return View('shopping.register');
    }

    public function signup(Request $request)
    {
        $email = $request->input('email');
        $params = array(
            'cmd' => 'signup',
            'uuid' => md5($email),
            'email' => $email,
            'pw' => $request->input('pw'),
            'nick' => $request->input('nick')
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        } else{
            if($result['success']){
                $expiresAt = Carbon::now()->addMinute(10);
                Cache::put('user', $result['data'], $expiresAt);
            }
        }
        return $result;
    }

    public function login(Request $request)
    {
        return View('shopping.login');
    }

    public function loginCheck(Request $request)
    {
        $email = $request->input('email');
        $params = array(
            'cmd' => "login",
            'uuid' => $request->input('uuid', md5($email)),
            'email' => $email,
            'pw' => $request->input('pw'),
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        } else {
            if ($result['success']) {
                $expiresAt = Carbon::now()->addMinute(10);
                Cache::forget('user');
                Cache::put("user", $result['data'], $expiresAt);
            }
        }
        return $result;
    }

    public function signout(Request $request)
    {
        $user = Cache::get('user');
        $result = array('success'=>false, 'error_msg'=>"user is signout", 'data' => array());
        if(!empty($user)) {
            $params = array(
                'cmd' => "signout",
                'pin' => $request->input('pin', $user['pin']),
                'token' => $request->input('token', $user['token'])
            );
            $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
            if (empty($result)) {
                $result['success'] = false;
                $result['error_msg'] = "Data access failed";
                $result['data'] = array();
            } else {
                if ($result['success']) {
                    Cache::forget('user');
                }
            }
        }
        return $result;
    }

    public function reset(Request $request)
    {
        return View('shopping.resetpwd');
    }

    public function resetPassword(Request $request)
    {
        $user = Cache::get('user');
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
            'cmd' => "forgetwd",
            'uuid' => $request->input('uuid', "199999999999"),
            'email' => $request->input('email', "kangdongno.4@163.com"),
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

    public function changePassword(Request $request)
    {
        return View('shopping.profilesetting_changepassword');
    }

    public function modifyUserPwd(Request $request)
    {
        $params = array(
            'cmd' => "modifypwd",
            'pin' => $request->input('pin'),
            'oldpwd' => $request->input('oldpwd'),
            'pw' => $request->input('pw'),
            'token' => $request->input('token')
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

    public function shippingAddress(Request $request)
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
        return View('shopping.profilesetting_shippingaddress', ['data'=>$result['data']]);
    }

}

