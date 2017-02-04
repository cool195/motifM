<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;
use App\Services\Publicfun;

class UserController extends ApiController
{
    const API_SYSTEM = "";
    const API_SERVICE = "user";
    const Token = 'eeec7a32dcb6115abfe4a871c6b08b47';

    /*
     * @author zhangtao@evermarker.net
     *
     * 跳转至个人中心页
     *
     * */
    public function setting()
    {
        return View('shopping.profilesetting');
    }

    /*
     * @author zhangtao@evermarker.net
     *
     * 跳转至个人中心
     *
     * */
    public function changeProfile()
    {
        $user = Session::get('user');
        return View('shopping.profilesetting_changeprofile', ['user' => $user]);
    }

    /*
     * @author zhangtao@evermarker.net
     *
     * 跳转至注册页面
     *
     * */
    public function register(Request $request)
    {
        $referer = $request->input('referer');
        return View('shopping.register', ['referer' => $referer]);
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
            'uuid' => $_COOKIE['uid'],
            'email' => $email,
            'pw' => md5($request->input('pw')),
            'nick' => $request->input('nick'),
            'token' => self::Token,
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);

        if ($result['success']) {
            Session::forget('user');
            Session::put('user', $result['data']);
            if($_COOKIE['wishSpu']){
                Publicfun::addWishProduct($_COOKIE['wishSpu']);
            } elseif($_COOKIE['followDid']){
                Publicfun::addFollowDesigner($_COOKIE['followDid']);
            }
            Publicfun::mergeCartSkus();
            $result['redirectUrl'] = ($request->input('referer') && !strstr($request->input('referer'), 'login')) ? $request->input('referer') : "/daily";
        } else {
            $result['prompt_msg'] = $result['error_msg'];
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
        if (Session::has('user')) {
            return redirect('/daily');
        }

        $referer = $request->input('url') ? $request->input('url') : $request->header('referer');
        Session::put('redirectUrl', $referer);
        return view('shopping.login', ['referer' => $referer,'path'=>$request->get('path')]);
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
            'uuid' => $_COOKIE['uid'],
            'email' => $email,
            'pw' => md5($request->input('pw')),
            'token' => self::Token,
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        } else {
            if ($result['success']) {
                $result['redirectUrl'] = ($request->input('referer') && !strstr($request->input('referer'), 'register')) ? $request->input('referer') : "/daily";
                Session::forget('user');
                Session::put('user', $result['data']);
                if($_COOKIE['wishSpu']){
                    Publicfun::addWishProduct($_COOKIE['wishSpu']);
                } elseif($_COOKIE['followDid']){
                    Publicfun::addFollowDesigner($_COOKIE['followDid']);
                }
                Publicfun::mergeCartSkus();
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
    public function signout()
    {
        Session::forget('user');
        return redirect('/login');
    }

    /*
     * 跳转至重置密码页面
     *
     * @author zhangtao@evermarker.net
     * */
    public function reset()
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
            'pw' => md5($request->input('pw')),
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
            'cmd' => "forgetpwd",
            'uuid' => $_COOKIE['uid'],
            'email' => $request->input('email'),
            'token' => self::Token,
            //'pin' => Session::get('user.pin'),
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (!empty($result) && $result['success']) {
            $result['redirectUrl'] = "/login";
            $result['prompt_msg'] = "We have send you an email to your email address";
        }
        return $result;
    }

    /*
     * 跳转至修改密码页面
     *
     * @author zhangtao@evermarker.net
     *
     * */
    public function changePassword()
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
            'oldpw' => md5($request->input('oldpw')),
            'pw' => md5($request->input('pw')),
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        } else {
            $result['prompt_msg'] = "Password change failed, Please try agian!";
            if ($result['success']) {
                Session::forget('user');
                $result['prompt_msg'] = "Your password has been changed. Please login agian";
                $result['redirectUrl'] = "/login";
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
    public function getUserDetailInfo()
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
            'nick' => $request->input('nick'),
            'token' => $user['token']
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        } else {
            $result['error_msg'] = "Modify Info Failed";
            if ($result['success']) {
                $result['prompt_msg'] = "Modify Info Success";
                $result['redirectUrl'] = "/user/setting";
                $userInfo = $this->getUserDetailInfo($request);
                $user['nickname'] = $userInfo['data']['nickname'];
                Session::forget('user');
                Session::put('user', $user);
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

    public function getShippingAddress()
    {
        $cmd = 'list';
        $params = array(
            'cmd' => $cmd,
            'uuid' => $_COOKIE['uid'],
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $system = "";
        $service = "useraddr";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result) || empty($result['data']['list'])) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
            $result['data']['list'] = array();
        } else {
            if ($result['success']) {
                $list = array();
                foreach ($result['data']['list'] as $addr) {
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
        $result = $this->getShippingAddress($request);
        return View('shopping.profilesetting_shippingaddress', ['data' => $result['data']]);
    }

    public function addrAdd(Request $request)
    {
        $defaultCountry = array('country_id' => 1, 'child_label' => "State", 'child_type' => 2, 'country_name_cn' => '美国', 'country_name_sn'=>'US','country_name_en' => "United States", 'iDnumberReq' => 0, 'isFreq' => 1, 'sort_no' => 100, 'zipcode_label' => 'Zip code');
        $country = json_decode(base64_decode($request->input('countryState',$request->input('country', base64_encode(json_encode($defaultCountry))))), true);
        $state = json_decode(base64_decode($request->input('state')), true);
        $input = $request->except('country');
        $view = View('shopping.profilesetting_addaddress', ['state'=>$state,'input' => $input, 'first' => $request->get('first')]);
        if (!empty($country)) {
            $view = View('shopping.profilesetting_addaddress', ['state'=>$state,'country' => $country, 'input' => $input, 'first' => $request->get('first')]);
        }
        return $view;
    }

    public function addrModify(Request $request, $aid)
    {
        $state = json_decode(base64_decode($request->input('state')), true);
        if ($request->has('aid')) {
            $input = $request->all();
            $input['detail_address1'] = $input['addr1'];
            $input['detail_address2'] = $input['addr2'];
            $input['telephone'] = $input['tel'];
            $input['isDefault'] = $input['isd'];
            $input['receiving_id'] = $input['aid'];
        } else {
            $res = $this->getShippingAddress($request);
            $addrList = $res['data']['list'];
            $input = $addrList[$aid];
        }
        $state = $state ? $state : array('state_name_sn'=>$input['state']);
        $country = json_decode(base64_decode($request->input('country')), true);
        if (!empty($country)) {
            $input['country'] = $country['country_name_en'];
        }else{
            $params = array(
                'cmd' => 'country',
                'token' => Session::get('user.token'),
                'pin' => Session::get('user.pin')
            );
            $countrylist = $this->request('openapi', '', 'addr', $params);
            
            foreach ($countrylist['data']['list'] as $value){
                if($value['country_name_en']==trim($input['country'])){
                    $country = $value;
                    break;
                }
            }
        }
        if (empty($input)) {
            return redirect('/user/shippingaddress');
        }

        return View('shopping.profilesetting_modaddress', ['country'=>$country,'input' => $input,'state'=>$state]);
    }

    public function countryList(Request $request)
    {

        $input = $request->except('country', 'route');
        $params = array(
            'cmd' => 'country',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin')
        );
        $system = "";
        $service = "addr";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        } else {
            if ($result['success']) {
                $commonlist = array();
                for ($index = 0; $index < $result['data']['amount']; $index++) {
                    $commonlist[] = array_shift($result['data']['list']);
                }
                $result['data']['commonlist'] = $commonlist;
            }
        }
        return View('shopping.countrylist', ['list' => $result['data']['list'], 'commonlist' => $result['data']['commonlist'], 'route' => $request->input('route'), 'input' => $input]);
    }

    public function statelist(Request $request)
    {
        $input = $request->except('route');
        $params = array(
            'cmd' => 'state',
            'countryid' => $input['countryid']
        );
        $route = $request->input('route');
        $result = $this->request('openapi', '', 'addr', $params);

        if ($result['success'] && !empty($result['data']['list'])) {
            $commonlist = array();
            for ($index = 0; $index < $result['data']['amount']; $index++) {
                $commonlist[] = array_shift($result['data']['list']);
            }
            $result['data']['commonlist'] = $commonlist;
        }
        return View('shopping.statelist', ['route'=>$route,'list' => $result['data']['list'], 'commonlist' => $result['data']['commonlist'],'input' => $input]);
    }

    //APP同步登录
    public function rsyncLogin(Request $request)
    {
        Session::put('user', array(
            'login_email' => $request->input('email'),
            'nickname' => $request->input('name'),
            'pin' => $request->input('pin'),
            'token' => $request->input('token'),
            'uuid' => $_COOKIE['uid'],
        ));
        if (Session::get('user.pin')) {
            return array('success' => true);
        } else {
            return array('success' => false);
        }
    }

    //找回密码并修改密码
    public function forgetPWD(Request $request)
    {
        if ($request->input('pw')) {
            if ($request->input('pw') != $request->input('lastpw')) {
                return array('success' => false, 'error_msg' => 'Passwords do not match');
            }
            $params = array(
                'cmd' => 'modifyfgtpwd',
                'pw' => md5($request->input('pw')),
                'tp' => $request->input('tp'),
                'sig' => $request->input('sig'),
                'token' => self::Token
            );
            $result = $this->request('openapi', '', 'user', $params);
            if ($result['success']) {
                $result['redirectUrl'] = "/login";
            }
            return $result;
        } else {
            $params = array(
                'tp' => $request->input('tp'),
                'sig' => $request->input('sig'),
            );
            return View('shopping.forgetpwd', ['params' => $params]);
        }

    }

    //记录登录前操作
    public function notesAction(Request $request){
        if($request->input('action') == 'wish'){
            setcookie("wishSpu",$request->input('spu'),time() + 300,'/');
        } elseif ($request->input('action') == 'follow') {
            setcookie("followDid", $request->input('did'), time() + 300, '/');
        }
    }

    //promocode
    public function promocode(){
        $params = array(
            'cmd' => 'couponlist',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $result = $this->request('openapi', '', 'coupon', $params);
        return View('profile.promocode', ['couponlist'=>$result['data']]);
    }
}

