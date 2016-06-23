<?php

namespace App\Http\Controllers\Designer;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Cookie;

class DesignerController extends ApiController
{
    //设计师首页
    public function index(Request $request)
    {
        $params = array(
            'cmd' => $request->input('cmd'),//designerinfolist
            'token' => '1110',
            'pin' => 'e052d5681da34fad83d0597b7b72acf7',
            'size' => $request->input('size', 10),
            'start' => $request->input('start', 1),
        );

        if (empty($params['cmd'])) {
            //首次加载,请求推荐设计师数据
            $result = $this->request('openapi', '', 'designer', array(
                'cmd' => 'recdesignerlist',
                'token' => '1110',
                'pin' => 'e052d5681da34fad83d0597b7b72acf7'
            ));

            return View('designer.index', ['recdesigner' => isset($result['data']['list']) ? $result['data']['list'] : array()]);
        } else {
            //非首次加载,请求设计师列表数据
            $result = $this->request('openapi', '', 'designer', $params);
            return $result;
        }

    }

    //设计师详情
    public function show(Request $request, $id)
    {
        $params = array(
            'cmd' => $request->input("cmd", 'designerdetail'),
            'pin' => 'e052d5681da34fad83d0597b7b72acf7',
            'token' => '1110',
            'd_id' => $id,
        );

        $result = $this->request('openapi', '', 'designer', $params);
        //设计师商品动态模版
        $params = array(
            'id' => $id,
        );
        $product = $this->request('openapi', 'designerf', 'content', $params);
        $view = '';
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') || strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios')) {
            $view = 'designer.showApp';
        } else {
            $view = 'designer.show';
        }
        return View($view, ['designer' => $result['data'], 'product' => $product['data']]);
    }
}

?>