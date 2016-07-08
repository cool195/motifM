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
        $this->putRefererInSession();
        return View('Other.AskShopping', ['id' => $request->input('id'), 'skiptype' => $request->input('skiptype')]);
    }

    private function putRefererInSession()
    {
        if(isset($_SERVER['HTTP_REFERER'])) {
            if(empty($_SERVER['PHP_SELF']) || $_SERVER['PHP_SELF'] !== $_SERVER['HTTP_REFERER']) {
                $referer = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "/daily";
                Session::put('referer', $referer);
            }
        }
    }

    //提交ASK表单
    public function install(Request $request)
    {

        $params = array(
            'cmd' => 'support',
            'content' => $request->input('content'),
            'email' => $request->input('email'),
            'pin' => Session::get('user.pin'),
            'type' => $request->input('skiptype'),
        );
        $urlStr = '';
        if ($request->input('skiptype') == 3) {
            $params['spu'] = $request->input('id');
            $params['stype'] = 3;
            $urlStr = '/detail/';
        } elseif ($request->input('skiptype') == 2) {
            $params['orderno'] = $request->input('id');
            $params['stype'] = 1;
            $urlStr = '/order/orderdetail/';
        }

        $result = $this->request('openapi', '', "feedback", $params);
        if($result['success']){
            $result['redirectUrl'] = $urlStr . $request->input('id');
            Session::forget('referer');
        }
        $result['redirectUrl'] = $urlStr . $request->input('id');
        return $result;
    }
}

?>