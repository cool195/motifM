<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CheckoutController extends ApiController
{
    //shipping
    public function shipping()
    {
        //获取默认地址
        $address = $this->getUserDefaultAddr();
        //没有地址进入添加地址页面
        if (empty($address['data'])) {
            return redirect('/checkout/address');
        } else {
            $shipPrice = $this->getCheckOutAccountList($address['data']['receiving_id']);
            $shippingMethod = $this->getShippingMethod($address['data']['country_name_sn'], $shipPrice['data']['total_amount'] + $shipPrice['data']['vas_amount']);
        }

        return View('checkout.shipping', ['address' => $address['data'], 'shippingMethod' => $shippingMethod]);
    }

    //payment
    public function payment()
    {
        return View('checkout.payment');
    }

    //review
    public function review()
    {
        return View('checkout.review');
    }

    //获取默认地址
    private function getUserDefaultAddr()
    {
        if (Session::has('defaultAddr')) {
            $result = Session::get('defaultAddr');
        } else {
            $params = array(
                'cmd' => 'gdefault',
                'uuid' => $_COOKIE['uid'],
                'token' => Session::get('user.token'),
                'pin' => Session::get('user.pin'),
            );
            $system = "";
            $service = "useraddr";
            $result = $this->request('openapi', $system, $service, $params);
            if (empty($result)) {
                $result['success'] = false;
                $result['error_msg'] = "Data access failed";
                $result['data'] = array();
            }
        }
        return $result;
    }

    //获取物流方式
    public function getShippingMethod($country = 0, $price = 0)
    {
        $params = array(
            'cmd' => 'logis',
            'token' => Session::get('user.token')
        );
        if ($price != 0) {
            $params['amount'] = $price;
            $params['country'] = $country;
        }
        $result = $this->request('openapi', "", "general", $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data']['list'] = array();
        }
        return $result['data']['list'];
    }

    //结算商品列表
    public function getCheckOutAccountList($aid, $logisticstype = "", $bindid = "", $paytype = "")
    {
        $params = array(
            'cmd' => 'accountlist',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'logisticstype' => $logisticstype,
            'paytype' => $paytype,
            'bindid' => $bindid,
            'addressid' => $aid
        );
        $system = "";
        $service = "cart";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }

    //地址管理
    public function address(Request $request)
    {
        $params = array(
            'cmd' => 'list',
            'uuid' => $_COOKIE['uid'],
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $system = "";
        $service = "useraddr";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }

        return View('checkout.address', ['address' => $result['data']['list']]);
    }


    //添加地址
    public function addUserAddr(Request $request)
    {

        $params = array(
            'cmd' => 'add',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'email' => $request->input('email'),
            'tel' => $request->input('tel'),
            'name' => $request->input("name"),
            'addr1' => $request->input("addr1"),
            'addr2' => $request->input("addr2"),
            'city' => $request->input("city"),
            'state' => $request->input("state"),
            'zip' => $request->input("zip"),
            'idnum' => $request->input("idnum"),
            'country' => $request->input("country"),
            'isd' => $request->input("isd", 0),
        );

        $system = "";
        $service = "useraddr";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Failed to add address";
            $result['data'] = array();
        }

        return $result;
    }

}
