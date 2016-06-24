<?php

namespace App\Http\Controllers\Daily;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

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
        );
        if (empty($params['cmd'])) {
            return View('daily.index');
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

    //动态模版专题详情
    public function show($id)
    {
        $params = array(
            'id' => $id
        );

        $result = $this->request('openapi', 'topicf', "content", $params);
        $view = '';
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') || strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios')) {
            $view = 'daily.topicApp';
        } else {
            $view = 'daily.topic';
        }

        return View($view, ['topic' => $result['data'], 'topicID' => $id]);
    }
}

?>