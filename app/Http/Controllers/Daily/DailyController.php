<?php

namespace App\Http\Controllers\Daily;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class DailyController extends ApiController
{
    public function index(Request $request)
    {
        $params = array(
            'cmd' => $request->input("cmd", 'list'),
            'token' => '1110',
        );
        $service = "daily";
        $result = $this->request('openapi', '', $service, $params);
        return View('daily.index',['daily'=>$result['data']['list']]);
    }

    public function show(Request $request,$id)
    {
        $params = array(
            'cmd' => $request->input("cmd", 'designerdetail'),
            'pin' => 'e052d5681da34fad83d0597b7b72acf7',
            'token' => '1110',
            'd_id' => $id,
        );

        $service = "designer";
        $result = $this->request('openapi', '', $service, $params);
        return View('designer.show',['designer'=>$result['data']]);
    }
}

?>