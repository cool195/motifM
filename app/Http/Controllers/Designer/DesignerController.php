<?php

namespace App\Http\Controllers\Designer;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DesignerController extends ApiController
{
    //设计师首页
    public function index(Request $request)
    {
        $params = array(
            'cmd' => $request->input('cmd'),//designerinfolist
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'size' => $request->input('size', 10),
            'start' => $request->input('start', 1),
        );

        if (empty($params['cmd'])) {
            //首次加载,请求推荐设计师数据
            /*            $result = $this->request('openapi', '', 'designer', array(
                            'cmd' => 'recdesignerlist',
                            'token' => Session::get('user.token'),
                            'pin' => Session::get('user.pin')
                        ));*/

            return View('designer.index'/*, ['recdesigner' => isset($result['data']['list']) ? $result['data']['list'] : array()]*/);
        } else {
            //非首次加载,请求设计师列表数据
            $result = $this->request('openapi', '', 'designer', $params);
            return $result;
        }

    }

    //设计师详情
    public function show(Request $request, $id)
    {
        //设计师详情
        $params = array(
            'cmd' => 'designerdetail',
            'pin' => Session::get('user.pin'),
            'token' => Session::get('user.token'),
            'd_id' => $id,
        );

        $result = $this->request('openapi', '', 'designer', $params);
        //设计师商品动态模版
        $params = array(
            'id' => $id,
        );
        $product = $this->request('openapi', 'designerf', 'content', $params);

        //设计师商品
        $params = array(
            'recid' => '100004',
            'pagenum' => 1,
            'pagesize' => 50,
            'uuid' => $_COOKIE['uid'] ? $_COOKIE['uid'] : 'ioscookieuidnull',
            'extra_kv' => 'designerId:' . $id,
            'pin' => Session::get('user.pin'),
        );
        $productAll = $this->request('openapi', '', 'rec', $params);


        $view = '';
        $result['data']['osType'] = strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios') ? 'ios' : 'android';
        if ($_GET['test'] || strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') || strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios')) {

            if ($request->input('token') || !empty($_COOKIE['PIN'])) {
                if ($request->input('token')) {
                    Session::put('user', array(
                        'login_email' => $request->input('email'),
                        'nickname' => $request->input('name'),
                        'pin' => $request->input('pin'),
                        'token' => $request->input('token'),
                        'uuid' => $_COOKIE['uid'],
                    ));
                } else {
                    Session::put('user', array(
                        'login_email' => $_COOKIE['EMAIL'],
                        'nickname' => urldecode($_COOKIE['NAME']),
                        'pin' => $_COOKIE['PIN'],
                        'token' => $_COOKIE['TOKEN'],
                        'uuid' => $_COOKIE['UUID'],
                    ));
                }
                $followParams = array(
                    'cmd' => 'is',
                    'pin' => Session::get('user.pin'),
                    'token' => Session::get('user.token'),
                    'did' => $id,
                );
                $follow = $this->request('openapi', '', 'follow', $followParams);
                $result['data']['followStatus'] = $follow['data']['isFC'];
            } else {
                Session::forget('user');
            }
            $view = 'designer.showApp';
        } else {
            $view = 'designer.show';
        }
        return View($view, ['designerid' => $id, 'designer' => $result['data'], 'productAll' => $productAll, 'product' => $product['data']]);
    }

    //关注或取消设计师
    public function follow($id)
    {
        $followParams = array(
            'cmd' => 'is',
            'pin' => Session::get('user.pin'),
            'token' => Session::get('user.token'),
            'did' => $id,
        );
        $follow = $this->request('openapi', '', 'follow', $followParams);
        if ($follow['data']['isFC']) {
            //取消关注
            $followParams = array(
                'cmd' => 'del',
                'pin' => Session::get('user.pin'),
                'token' => Session::get('user.token'),
                'did' => $id,
            );
            $follow = $this->request('openapi', '', 'follow', $followParams);
        } else {
            //关注
            $followParams = array(
                'cmd' => 'add',
                'pin' => Session::get('user.pin'),
                'token' => Session::get('user.token'),
                'did' => $id,
            );
            $follow = $this->request('openapi', '', 'follow', $followParams);
        }
        return $follow;
    }
}

?>