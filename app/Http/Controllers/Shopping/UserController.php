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
        $user = Cache::get('user');
        return View('shopping.profilesetting_changeprofile', ['user'=>$user]);
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
/*                $expiresAt = Carbon::now()->addDays(180);
                Cache::forget('user');
                Cache::put('user', $result['data'], $expiresAt);*/
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
        if(Cache::has('user')){
            return redirect('/daily');
        }
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
                $result['redirectUrl'] = "/daily";
                $expiresAt = Carbon::now()->addMinute(10000);
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
                'pin' => $user['pin'],
                'token' => $user['token']
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
        return redirect('/login');
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
     * 跳转至修改密码页面
     *
     * @author zhangtao@evermarker.net
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
        }else{
            if($result['success']){
                //Cache::forget('user');
                $result['redirectUrl'] = "/login";
            }
        }
        return $result;
    }

    public function paymentMethod(Request $request)
    {
        return view('shopping.paymentmethod');
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
                $expiresAt = Carbon::now()->addMinute(180);
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
            'nick' => $user['nickname'],
           //'icon' => $request->input('icon', $user['icon']),
            'token' => $user['token']
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }else{
            if($result['success']){
                $userInfo = $this->getUserDetailInfo($request);
                $user['nickname'] = $userInfo['data']['nickname'];
            }
        }
        return $result;
    }

    /*
     * 获取用户收货地址
     *
     * @author zhangtao@evermarker.net
     *
     * */

    public function getShippingAddress(Request $request)
    {
        $user = Cache::get('user');
        $cmd = 'list';
        $pin = $user['pin'];
        $uuid = $request->input('uuid', md5($pin));
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
        }else{
            if($result['success']){
                $list = array();
                foreach($result['data']['list'] as $addr){
                    $list[$addr['receiving_id']] = $addr;
                }
                $result['data']['list'] = $list;
            }
        }
        return $result;
    }

    /*
     * 跳转至地址列表页面
     *
     * @author zhangtao@evermarker.net
     * */
    public function shippingAddress(Request $request)
    {
      /*  $user = Cache::get('user');
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
        }*/
        $result = $this->getShippingAddress($request);
        return View('shopping.profilesetting_shippingaddress', ['data'=>$result['data']]);
    }

    public function addrAdd(Request $request)
    {
        $country = json_decode(base64_decode($request->input('country', base64_encode(json_encode(['country_id'=>5, 'country_name_cn'=>"中国", 'country_name_en'=>"China", 'iDnumberReq'=>0, 'isFreq'=>0])))), true);
        $input = Cache::get('input');
        Cache::forget('input');
        return View('shopping.profilesetting_addaddress', ['country'=>$country, 'input'=>$input]);
    }

    public function addrModify(Request $request, $aid)
    {
        $res = $this->getShippingAddress($request);
        $addrList = $res['data']['list'];
        $input = $addrList[$aid];
        $country = json_decode(base64_decode($request->input('country')), true);
        if(!empty($country)){
            $input['country'] = $country['country_name_en'];
        }
        if(empty($input)){
            return redirect('/user/shippingaddress');
        }
        Cache::forget('input');
        return View('shopping.profilesetting_modaddress', ['input'=>$input]);
    }

    public function countryList(Request $request)
    {

        $input = $request->all();
        Cache::forget('input');
        Cache::forever('input', $input);
        $params = array(
            'cmd'=>'country',
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
        return View('shopping.profilesetting_countrylist', ['list'=>$result['data']['list'], 'commonlist'=>$result['data']['commonlist'], 'route'=>$input['route']]);
    }
}

