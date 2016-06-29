<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;

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
            'token'=> self::Token,
        );

        $params['reinfo'] = json_encode(array(
                'email' => $request->get('email'),
                'id' => $request->get('id'),
                'name' => $request->get('name'),
                'type' => 4,
                'avatar' => urlencode($request->get('avatar')),
            )
        );
        $result = $this->request('openapi', '', "user", $params);
        if ($result['success']) {
            $result['redirectUrl'] = "/daily";
            Session::forget('user');
            Session::put('user', $result['data']);
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
            'token'=> self::Token,
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
            $result['redirectUrl'] = "/daily";
            Session::forget('user');
            Session::put('user', $result['data']);
        }
        return $result;
    }
}

?>