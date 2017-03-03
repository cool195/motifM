<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;
use App\Services\Publicfun;
use Cache;

class AuthController extends ApiController
{
    const Token = 'eeec7a32dcb6115abfe4a871c6b08b47';

    //google login
    public function googleLogin(Request $request)
    {
        $params = array(
            'cmd' => 'tplogin',
            'uuid' => $_COOKIE['uid'],
            'type' => 4,
            'token' => self::Token,
        );

        $params['reinfo'] = json_encode(array(
                'email' => $request->get('email'),
                'id' => $request->get('id'),
                'name' => $request->get('name',$request->get('email')),
                'type' => 4,
                'avatar' => urlencode($request->get('avatar')),
            )
        );
        $result = $this->request('openapi', '', "user", $params);
        if ($result['success']) {
            //$result['redirectUrl'] = (Session::get('redirectUrl') && !strstr(Session::get('redirectUrl'), 'login') && !strstr(Session::get('redirectUrl'), 'register')) ? Session::get('redirectUrl') : "/daily";
            $result['redirectUrl'] = ($request->input('referer') && !strstr($request->input('referer'), 'register')) ? $request->input('referer') : "/trending";
            Session::forget('user');
            Session::put('user', $result['data']);
            Cache::forget($result['data']['token']);
            Cache::put($result['data']['token'], $result['data'], ($result['data']['tokenTtl'] / 60));
            if($_COOKIE['wishSpu']){
                Publicfun::addWishProduct($_COOKIE['wishSpu']);
            } elseif($_COOKIE['followDid']){
                Publicfun::addFollowDesigner($_COOKIE['followDid']);
            }
            Publicfun::mergeCartSkus();
        }
        return $result;
    }

    //facebook login
    public function facebookLogin(Request $request)
    {
        $params = array(
            'cmd' => 'tplogin',
            'uuid' => $_COOKIE['uid'],
            'type' => 2,
            'token' => self::Token,
        );

        $params['reinfo'] = json_encode(array(
                'email' => $request->get('email'),
                'id' => $request->get('id'),
                'name' => $request->get('name'),
                'type' => 2,
                'avatar' => urlencode($request->get('avatar')),
            )
        );
        $result = $this->request('openapi', '', "user", $params);
        if ($result['success']) {
            //$result['redirectUrl'] = (Session::get('redirectUrl') && !strstr(Session::get('redirectUrl'), 'login') && !strstr(Session::get('redirectUrl'), 'register')) ? Session::get('redirectUrl') : "/daily";
            $result['redirectUrl'] = ($request->input('referer') && !strstr($request->input('referer'), 'register')) ? $request->input('referer') : "/trending";
            Session::forget('user');
            Session::put('user', $result['data']);
            Cache::forget($result['data']['token']);
            Cache::put($result['data']['token'], $result['data'], ($result['data']['tokenTtl'] / 60));
            if($_COOKIE['wishSpu']){
                Publicfun::addWishProduct($_COOKIE['wishSpu']);
            } elseif($_COOKIE['followDid']){
                Publicfun::addFollowDesigner($_COOKIE['followDid']);
            }
            Publicfun::mergeCartSkus();
        }
        return $result;
    }

    //facebook 没有绑定邮箱
    public function addFacebookEmail(Request $request)
    {
        $params = array(
            'id' => $request->get('id'),
            'name' => $request->get('name'),
            'avatar' => urldecode($request->get('avatar')),
        );
        return view('shopping.registerAddEmail', ['params' => $params]);
    }

    //验证是否新用户
    public function faceBookAuthStatus($trdid)
    {
        $params = array(
            'cmd' => 'email',
            'type' => 2,
            'trdid' => $trdid,
            'token' => self::Token,
        );
        $result = $this->request('openapi', '', "user", $params);
        $result['status'] = $result['data']['email'] ? true : false;
        return $result;
    }
}

?>