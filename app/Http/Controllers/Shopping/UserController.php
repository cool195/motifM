<?php

namespace App\Http\Controllers\Shopping;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends ApiController
{
    const API_SYSTEM = "";
    const API_SERVICE = "user";

    /*
     * @author zhangtao@evermarker.net
     *
     * 跳转至个人中心页
     *
     * */
    public function setting(Request $request)
    {
        return View('shopping.profilesetting');
    }

    /*
     * @author zhangtao@evermarker.net
     *
     * 跳转至个人中心
     *
     * */
    public function changeProfile(Request $request)
    {
        return View('shopping.profilesetting_changeprofile');
    }

    /*
     * @author zhangtao@evermarker.net
     *
     * 跳转至注册页面
     *
     * */
    public function register(Request $request)
    {
        return View('shopping.register');
    }

    /*
     * 用户注册接口(异步)
     *
     * @author zhangtao@evermarker.net
     * @params Request $request
     * @return Array
     * */
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
                $result['redirectUrl'] = "/login";
                $expiresAt = Carbon::now()->addMinute(10);
                Cache::forget('user');
                Cache::put('user', $result['data'], $expiresAt);
            }
        }
         return $result;
    }

    /*
     * 跳转至用户登录页面
     *
     * @author zhangtao@evemarker.net
     * */
    public function login(Request $request)
    {
        return view('shopping.login');
    }

    /*
     * 用户登录接口(异步)
     *
     * @author zhangtao@evermarker.net
     * @params Request $request
     * @return Array
     * */
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
                $result['redirectUrl'] = "/login";
                $expiresAt = Carbon::now()->addMinute(10);
                Cache::forget('user');
                Cache::put("user", $result['data'], $expiresAt);
            }
        }
        return $result;
    }

    /*
     * 用户注销登录接口
     *
     * @author zhangtao@evermarker.net
     * @params Request $request
     * @return Array
     * */
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

    /*
     * 跳转至重置密码页面
     *
     * @author zhangtao@evermarker.net
     * */
    public function reset(Request $request)
    {
        return View('shopping.resetpwd');
    }

    /*
     * 重置密码接口
     *
     * @author zhangtao@evermarker.net
     * @params Request $request
     * @return Array
     * */
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

    /*
     * 找回密码
     *
     * @author zhangtao@evermarker.net
     * @params Request $request
     * @return Array
     * */
    public function forgetPassword(Request $request)
    {
        $user = Cache::get('user');
        $params = array(
            'cmd' => "forgetwd",
            'uuid' => $user['uuid'],
            'email' => $request->input('email'),
            'token' => $user['token']
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }

    /*
     *
     * */
    public function changePassword(Request $request)
    {
        return View('shopping.profilesetting_changepassword');
    }

    /*
     * 修改用户密码接口
     *
     * @author zhangtao@evermarker.net
     * @params Request $request
     * @return Array
     * */
    public function modifyUserPwd(Request $request)
    {
        $user = Cache::get('user');
        $params = array(
            'cmd' => "modifypwd",
            'pin' => $user['pin'],
            'oldpw' => $request->input('oldpw'),
            'pw' => $request->input('pw'),
            'token' => $user['token']
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }

    /*
     * 用户第三方登录
     *
     * @author zhangtao@evermarker.net
     * @params Request $request
     * @return Array
     * */
    public function tryPrtLogin(Request $request)
    {
        $reinfo = $request->input('reinfo');
        $params = array(
            'cmd' => "tplogin",
            'uuid' => $request->input('uuid', md5($reinfo)),
            'type' => $request->input('type', 1),
            'reinfo' => $reinfo,
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }else {
            if ($result['success']) {
                $expiresAt = Carbon::now()->addMinute(10);
                Cache::forget('user');
                Cache::put("user", $result['data'], $expiresAt);
            }
        }
        return $result;
    }

    /*
     * 获取用户信息
     *
     * @author zhangtao@evermarker.net
     * @params Request $request
     * @return Array
     * */
    public function getUserDetailInfo(Request $request)
    {
        $user = Cache::get('user');
        $params = array(
            'cmd' => "detail",
            'pin' => $user['pin'],
            'token' => $user['token']
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }

    /*
     * 修改用户信息
     *
     * @author zhangtao@evermarker.net
     * @params Request $request
     * @return Array
     * */
    public function modifyUserInfo(Request $request)
    {
        $user = Cache::get('user');
        $params = array(
            'cmd' => 'modify',
            'pin' => $user['pin'],
            'nick' => $request->input('nick', $user['nickname']),
           //'icon' => $request->input('icon', $user['icon']),
            'token' => $user['token']
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }

    /*
     *
     * */
    public function shippingAddress(Request $request)
    {
        $user = Cache::get('user');
        $cmd = 'list';
        $pin = $user['pin'];
        $uuid = $request->input("uuid", md5($cmd));
        $token = $user['token'];
        $params = array(
            'cmd'=>$cmd,
            'uuid'=>$uuid,
            'pin'=>$pin,
            'token'=>$token
        );
        $system = "";
        $service = "useraddr";
        $result = $this->request('openapi', $system, $service, $params);
        if(empty($result) || empty($result['data']['list'])){
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
            $result['data']['list'] = array();
        }
        return View('shopping.profilesetting_shippingaddress', ['data'=>$result['data']]);
    }

}

