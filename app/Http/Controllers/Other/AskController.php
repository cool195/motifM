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
        return View('Other.AskShopping', ['id' => $request->input('id'), 'skiptype' => $request->input('skiptype')]);
    }

    //提交ASK表单
    public function install(Request $request)
    {

        $params = array(
            'cmd' => 'support',
            'content' => mb_convert_encoding($request->input('content'), "GBK","UTF-8"),
            'email' => $request->input('email'),
            'pin' => Session::get('user.pin'),
            'type' => $request->input('skiptype'),
            'stype' => $request->input('skiptype'),
        );
        $urlStr = '';
        if ($request->input('skiptype') == 3) {
            $params['spu'] = $request->input('id');
            $urlStr = '/detail/';
        } elseif ($request->input('skiptype') == 2) {
            $params['orderno'] = $request->input('id');
            $urlStr = '/order/orderdetail/';
        }

        $this->request('openapi', '', "feedback", $params);

        return redirect($urlStr . $request->input('id'));
    }
}

?>