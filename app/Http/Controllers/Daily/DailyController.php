<?php

namespace App\Http\Controllers\Daily;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class DailyController extends ApiController
{
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

    public function show(Request $request, $id)
    {
        $params = array(
            'cmd' => $request->input("cmd", 'designerdetail'),
            'pin' => 'e052d5681da34fad83d0597b7b72acf7',
            'token' => '1110',
            'd_id' => $id,
        );

        $service = "designer";
        $result = $this->request('openapi', '', $service, $params);
        return View('designer.show', ['designer' => $result['data']]);
    }
}

?>