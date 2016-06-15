<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;

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
        $user = Session::get('user');
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
        if(Session::has('user')){
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
                if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
                    $result['redirectUrl'] = $_SERVER['HTTP_REFERER'];
                }
                Session::forget('user');
                Session::put('user', $result['data']);
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
        $user = Session::get('user');
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
                    Session::forget('user');
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
        $params = array(
            'cmd' => "forgetwd",
            'uuid' => '123',
            'email' => $request->input('email'),
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
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
        $params = array(
            'cmd' => "modifypwd",
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'oldpw' => $request->input('oldpw'),
            'pw' => $request->input('pw'),
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }else{
            if($result['success']){
                Session::forget('user');
                $result['redirectUrl'] = "/login";
            }
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
                Session::forget('user');
                Session::put("user", $result['data']);
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
        $params = array(
            'cmd' => "detail",
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
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
        $user = Session::get('user');
        $params = array(
            'cmd' => 'modify',
            'pin' => $user['pin'],
            'nick' => $user['nickname'],
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
        $cmd = 'list';
        $uuid = $request->input('uuid', '123');
        $params = array(
            'cmd'=>$cmd,
            'uuid'=>$uuid,
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
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
        $input = Session::get('input');
        Session::forget('input');
        return View('shopping.profilesetting_addaddress', ['country'=>$country, 'input'=>$input,'first' => $request->get('first')]);
    }

    public function addrModify(Request $request, $aid)
    {
        if(Session::has('input')){
            $input = Session::get('input');
            $input['detail_address1'] = $input['addr1'];
            $input['detail_address2'] = $input['addr2'];
            $input['telephone'] = $input['tel'];
            $input['iDnumber'] = $input['idnum'];
            $input['isDefault'] = $input['isd'];
            $input['receiving_id'] = $input['aid'];
        }else {
            $res = $this->getShippingAddress($request);
            $addrList = $res['data']['list'];
            $input = $addrList[$aid];
        }
        $country = json_decode(base64_decode($request->input('country')), true);
        if(!empty($country)){
            $input['country'] = $country['country_name_en'];
        }
        if(empty($input)){
            return redirect('/user/shippingaddress');
        }
        Session::forget('input');
        return View('shopping.profilesetting_modaddress', ['input'=>$input]);
    }

    public function countryList(Request $request)
    {

        $input = $request->all();
        Session::forget('input');
        Session::put('input', $input);
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

