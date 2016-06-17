<?php

namespace App\Http\Controllers\Other;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ApiController;

class AskController extends ApiController
{
    //Ask提交页
    public function show(Request $request)
    {
        return View('other.AskShopping', ['spu' => $request->input('spu')]);
    }

    //提交ASK表单
    public function install(Request $request)
    {

        $params = array(
            'cmd' => 'support',
            'content' => $request->input('content'),
            'email' => $request->input('email'),
            'pin' => Session::get('user.pin'),
            'type' => '3',
            'stype' => '3',
            'spu' => $request->input('spu'),
        );

        $this->request('openapi', '', "feedback", $params);
        return redirect('/detail/'.$request->input('spu'));
    }
}

?>