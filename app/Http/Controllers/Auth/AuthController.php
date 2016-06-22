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
            'cmd' => 'tplogin',
            'uuid' => '123',
            'type' => 4,
        );

        $params['reinfo'] = json_encode(array(
                'email' => $request->get('email'),
                'id' => $request->get('token'),
                'name' => $request->get('name'),
                'type' => 4,
                'avatar' => urlencode($request->get('avatar')),
            )
        );
        $result = $this->request('openapi', '', "user", $params);
        $result['params'] = $params;
        return $result;
    }
}
?>