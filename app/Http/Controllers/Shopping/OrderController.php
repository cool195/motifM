<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;

class OrderController extends ApiController
{
    public function index(Request $request)
    {
        $orderList = $this->getOrderList($request);
        return View('shopping.orderlist', ['data' => $orderList['data']]);

    }

    public function getOrderList(Request $request)
    {
        $cmd = "ordlist";
        $params = array(
            'cmd' => $cmd,
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'num' => $request->input("num", 1),
            'size' => $size = $request->input("size", 5),
        );
        $system = "";
        $service = "order";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        } else {
            $result = $this->resultJsonDecode($result);
        }
        return $result;
    }

    private function resultJsonDecode(Array $result)
    {
        $orderList = array();
        if (isset($result['data']['list'])) {
            foreach ($result['data']['list'] as $order) {
                $subOrderList = array();
                foreach ($order['subOrderList'] as $subOrder) {
                    $lineOrderList = array();
                    foreach ($subOrder['lineOrderList'] as $lineOrder) {
                        if (!empty($lineOrder['attrValues'])) {
                            $lineOrder['attrValues'] = json_decode($lineOrder['attrValues'], true);
                        }
                        if (!empty($lineOrder['vas_info'])) {
                            $lineOrder['vas_info'] = json_decode($lineOrder['vas_info'], true);
                        }
                        $lineOrderList[] = $lineOrder;
                    }
                    $subOrder['lineOrderList'] = $lineOrderList;
                    $subOrderList[] = $subOrder;
                }
                $order['subOrderList'] = $subOrderList;
                $orderList[] = $order;
            }
        }

        $result['data']['list'] = $orderList;
        return $result;
    }

    public function OrderDetail(Request $request, $subno)
    {
        $result = $this->getOrderDetail($subno);
        return View('shopping.orderdetail', ['data' => $result['data']]);
    }

    public function getOrderDetail($subno)
    {
        $cmd = 'detail';
        $params = array(
            'cmd' => $cmd,
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'subno' => $subno,
        );
        $system = "";
        $service = "order";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }else{
            if($result['success'] && !empty($result['data']['lineOrderList'])){
                $lineOrderList = array();
                foreach($result['data']['lineOrderList'] as $lineOrder){
                    if(isset($lineOrder['attrValues'])){
                        $lineOrder['attrValues'] = json_decode($lineOrder['attrValues'], true);
                    }
                    if(isset($lineOrder['vas_info'])){
                        $lineOrder['vas_info'] = json_decode($lineOrder['vas_info'], true);
                    }
                    $lineOrderList[] = $lineOrder;
                }
                $result['data']['lineOrderList'] = $lineOrderList;
            }
        }
        return $result;
    }

    /*
     * 提交订单接口
     *
     * @author zhangtao@evermarker.net
     *
     * */
    public function orderSubmit(Request $request)
    {
        $params = array(
            'cmd' => 'ordsubmit',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'aid' => $request->input('aid'),
            'paym' => $request->input('paym', ""),
            'cps' => $request->input('cps', ""),
            'remark' => $request->input('remark'),
            'stype' => $request->input('stype'),
            'src' => $request->input('src', "H5"),
            'ver' => $request->input('ver', 1)
        );
        error_log(print_r("------------------\n", "\n"), 3, '/tmp/myerror.log');
        error_log(print_r($params, "\n"), 3, '/tmp/myerror.log');
        $system = "";
        $service = "order";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }


}