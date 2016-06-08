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
            'token' => $request->input('token', "1110"),
            'pagesize' => $request->input('pagesize', 10),
            'pagenum' => $request->input('pagenum', 1),
        );
        if(empty($params['cmd'])){
            return View('daily.index');
        }else{
            $system = "";
            $service = "daily";
            $result = $this->request('openapi', $system, $service, $params);
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

        return View('daily.topic', ['topic' => $result['data']['infos']]);
    }
}

?>