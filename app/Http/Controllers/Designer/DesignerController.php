<?php

namespace App\Http\Controllers\Designer;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class DesignerController extends ApiController
{
    public function index(Request $request)
    {
        return View('designer.index');
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