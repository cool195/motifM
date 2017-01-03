<?php

namespace App\Http\Controllers\Daily;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;
use App\Services\Publicfun;

class DailyController extends ApiController
{

    public function home(Request $request)
    {
        return redirect('/');
    }
    //Daily首页列表
    public function index(Request $request)
    {
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') || strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios')){
            return redirect('motif://o.c?a=daily');
        }
        $params = array(
            'cmd' => $request->input('cmd'),
            'token' => Session::get('user.token'),
            'pagesize' => $request->input('pagesize', 10),
            'pagenum' => $request->input('pagenum', 1),
            'puton' => $request->input('puton', 1),
        );
        if (empty($params['cmd'])) {
            return View('daily.index', ['puton' => $params['puton'],'NavShowDaily'=>true]);
        } else {
            $result = $this->request('openapi', '', 'daily', $params);
            if (empty($result)) {
                $result['success'] = false;
                $result['error_msg'] = "Data access failed";
                $result['data']['list'] = array();
            }
            return $result;
        }
    }

    //Daily无数据加载
    public function recData(Request $request)
    {
        $params = array(
            'recid' => '100001',
            'pagesize' => $request->input('pagesize', 3),
            'pagenum' => $request->input('pagenum', 1),
            'uuid' => $_COOKIE['uid'],
            'pin' => Session::get('user.pin'),
        );
        $productAll = $this->request('openapi', '', 'rec', $params);
        return $productAll;
    }

    //动态模版专题详情
    public function show(Request $request, $id)
    {
        $params = array(
            'cmd' => 'topic',
            'id' => $id
        );

        $result = $this->request('openapi', '', "topicf", $params);
        $view = '';
        $NavShow = true;
        if ($request->input('test') || strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') || strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios')) {
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
                //执行登录前操作
                if ($request->input('wishspu')) {
                    Publicfun::addWishProduct($request->input('wishspu'));
                    $result['data']['pushspu'] = $request->input('wishspu');
                }
                $spuArray = array();
                foreach ($result['data']['infos'] as $value) {
                    if (isset($value['spus'])) {
                        $spuArray = array_merge($value['spus'], $spuArray);
                    }
                }
                $result['data']['spuArray'] = json_encode($spuArray);
                $NavShow = false;
            } else {
                Session::forget('user');
            }

            $view = 'daily.topicApp';
        } else {
            $view = 'daily.topic';
        }
        //设置topic分享主图
        foreach ($result['data']['infos'] as $value){
            if($value['imgPath']){
                $result['data']['mainImg'] = $value['imgPath'];
                break;
            }
        }
        return View($view, ['NavShowDaily'=>$NavShow,'topic' => $result['data'], 'topicID' => $id, 'shareFlag' => true]);
    }

    //商品详情动态模版
    public function staticShow($id)
    {
        $params = array(
            'cmd' => 'template',
            'id' => $id
        );

        $result = $this->request('openapi', '', "topicf", $params);
        $view = '';
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') || strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios')) {
            $view = 'daily.topicApp';
        } else {
            $view = 'daily.topic';
        }

        return View($view, ['topic' => $result['data'], 'topicID' => $id, 'shareFlag' => false]);
    }
}

?>