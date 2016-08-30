<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;
use App\Services\Publicfun;

class OrderController extends ApiController
{
    public function index(Request $request)
    {
        $orderList = $this->getOrderList($request);
        return View('shopping.orderlist', ['data' => $orderList['data']]);

    }

    public function orderSuccess(Request $request)
    {
        $view = view('shopping.ordercheckout_success');
        if ($request->has('orderid')) {
            $result = $this->getOrderDetail($request->input('orderid'));
            $view = view('shopping.ordercheckout_success', ['order' => $result['data']]);
        }
        return $view;
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
        if (!empty($result) && $result['success']) {
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
                    $subOrder['update_time'] = Publicfun::getMyDate($subOrder['update_time']);
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

    public function OrderDetail($subno)
    {
        $result = $this->getOrderDetail($subno);
        if (!$result['success']) {
            return redirect('/daily');
        }
        $result['data']['cardlist'] = array('Diners' => 'diners-club', 'Discover' => 'discover', 'JCB' => 'jcb', 'Maestro' => 'maestro', 'AmericanExpress' => 'american-express', 'Visa' => 'visa', 'MasterCard' => 'master-card');

        $params = array(
            'cmd' => 'payinfo',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'uuid' => @$_COOKIE['uid'],
            'orderid' => $subno,
        );
        $resultOrder = $this->request('openapi', '', 'pay', $params);
        $pay_type = !empty($resultOrder['data']['pay_type']) ? $resultOrder['data']['pay_type'] : null;
        $result['data']['orderPayInfo'] = array('pay_type' => $pay_type, 'show_name' => $resultOrder['data']['show_name'], 'card_type' => $resultOrder['data']['card_type']);
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
        if (!empty($result) && $result['success']) {
            $result = $this->jsonDecodeOrderDetailResult($result);
        }
        return $result;
    }

    private function jsonDecodeOrderDetailResult(Array $result)
    {
        if (!empty($result['data']['lineOrderList'])) {
            $lineOrderList = array();
            foreach ($result['data']['lineOrderList'] as $lineOrder) {
                if (isset($lineOrder['attrValues'])) {
                    $lineOrder['attrValues'] = json_decode($lineOrder['attrValues'], true);
                }
                if (isset($lineOrder['vas_info'])) {
                    $lineOrder['vas_info'] = json_decode($lineOrder['vas_info'], true);
                }
                $lineOrderList[] = $lineOrder;
            }
            $result['data']['lineOrderList'] = $lineOrderList;
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
            'paym' => $request->input('paym', "Oceanpay"),
            'cps' => $request->input('cps', ""),
            'remark' => $request->input('remark'),
            'stype' => $request->input('stype'),
            'src' => $request->input('src', "H5"),
            'ver' => $request->input('ver', 1)
        );
        $result = $this->request('openapi', "", "order", $params);
        if (!empty($result) && $result['success']) {
            if ($params['paym'] == 'Oceanpay') {
                $result['redirectUrl'] = "/qianhai?orderid=" . $result['data']['orderID'] . "&totalPrice=" . $result['data']['pay_amount'] / 100;
            } else {
                $result['redirectUrl'] = "/paypalorder?orderid=" . $result['data']['orderID'] . "&orderDetail=" . $result['data']['shortInfo'] . "&totalPrice=" . $result['data']['pay_amount'] / 100;
            }
        } else {
            $result['redirectUrl'] = Session::has('referer') ? Session::get('referer') : '/shopping';
        }
        return $result;

//        $params = array(
//            'cmd' => "dopay",
//            'uuid' => @$_COOKIE['uid'],
//            'token' => Session::get('user.token'),
//            'pin' => Session::get('user.pin'),
//            'orderid' => $orderId,
//            'paytype' => $request->input('paym'),
//            'cardtype' => $request->input('cardType'),
//            'showname' => $request->input('showName'),
//            'methodtoken' => $request->input('methodtoken'),
//            'setdefault' => 1,
//            'devicedata' => "H5"
//        );
//        $result = $this->request('openapi', "", "pay", $params);
//        if (!empty($result) && $result['success']) {
//            $transid = $result['data']['id'];
//        } else {
//            return $result;
//        }
//
//        $params = array(
//            'cmd' => 'checkpay',
//            'transid' => $transid,
//            'orderid' => $orderId
//        );
//        $result = $this->request('openapi', "", "pay", $params);
//        if (!empty($result) && $result['success']) {
//            //$result['redirectUrl'] = "/order/orderdetail/".$orderId;
//            $result['redirectUrl'] = "/success";
//        } else {
//            $result['success'] = false;
//        }
//
//        return $result;
    }

    //重新获取订单信息
    public function orderPayInfo($orderid, $paytype)
    {
        $params = array(
            'cmd' => "payinfo",
            'ordno' => $orderid,
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin')
        );
        $result = $this->request('openapi', "", "order", $params);

        if ($result['success']) {
            if ($paytype == 1) {
                return redirect("/paypalorder?orderid={$orderid}&orderDetail={$orderid}&totalPrice=" . $result['data']['pay_amount'] / 100);
            } else {
                return redirect("/qianhai?orderid={$orderid}&totalPrice=" . $result['data']['pay_amount'] / 100);
            }
        } else {
            return redirect("/order/orderdetail/$orderid");
        }
    }

}