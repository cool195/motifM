<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class AuthController extends ApiController
{
    //google login
    public function googleLogin(Request $request)
    {
        $params = array(
            'cmd' => $request->get('tplogin'),
            'uuid' => '123',
            'type' => 4,
        );

        $params['reinfo'] = json_encode(array(
                'email' => $request->get('email'),
                'token' => $request->get('token'),
                'name' => $request->get('name'),
                'avatar' => urlencode($request->get('avatar')),
            )
        );
        $result = $this->request('openapi', '', "user", $params);
        $request['params'] = $params;
        return $result;
    }
}

?>