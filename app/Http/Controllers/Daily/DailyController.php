<?php

namespace App\Http\Controllers\Daily;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;

class DailyController extends ApiController
{
    //Daily首页列表
    public function index(Request $request)
    {
        $params = array(
            'cmd' => $request->input('cmd'),
            'token' => Session::get('user.token'),
            'pagesize' => $request->input('pagesize', 10),
            'pagenum' => $request->input('pagenum', 1),
            'puton' => $request->input('puton', 1),
        );
        if (empty($params['cmd'])) {
            return View('daily.index', ['puton' => $params['puton']]);
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
            'id' => $id
        );

        $result = $this->request('openapi', 'topicf', "content", $params);
        $view = '';

        if (strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') || strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios')) {
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

            } else {
                Session::forget('user');
            }
            $spuArray = array();
            foreach ($result['data']['infos'] as $value) {
                if (isset($value['spus'])) {
                    $spuArray = array_merge($value['spus'], $spuArray);
                }
            }
            $result['data']['spuArray'] = json_encode($spuArray);
            $view = 'daily.topicApp';
        } else {
            $view = 'daily.topic';
        }

        return View($view, ['topic' => $result['data'], 'topicID' => $id, 'shareFlag' => true]);
    }

    //商品详情动态模版
    public function staticShow($id)
    {
        $params = array(
            'id' => $id
        );

        $result = $this->request('openapi', 'topicf', "template", $params);
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