<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;
use App\Services\MCrypt;

class CheckoutController extends ApiController
{
    //checkout支付控制
    public function index()
    {
        $payInfo = $this->getPayInfo();
        $isPay = false;
        foreach ($payInfo['data']['list'] as $value) {
            if ($value['isLast'] == 1) {
                $isPay = true;
            }
        }
        //是否成功支付过
        if ($isPay) {
            return redirect('/checkout/review');
        } else {
            return redirect('/checkout/shipping');
        }
    }

    //shipping
    public function shipping()
    {
        //获取默认地址
        if (Session::get('user.checkout.address')) {
            $address = Session::get('user.checkout.address');
        } else {
            $address = $this->getUserDefaultAddr();
            Session::put('user.checkout.address', $address['data']);
        }

        //没有地址进入添加地址页面
        if (empty($address)) {
            return redirect('/checkout/address');
        } else {
            $shipPrice = $this->getCheckOutAccountList($address['receiving_id']);
            $shippingMethod = $this->getShippingMethod($address['country_name_sn'], $shipPrice['data']['total_amount'] + $shipPrice['data']['vas_amount']);
            $shipKey = md5($address['country_name_sn'] . ($shipPrice['data']['total_amount'] + $shipPrice['data']['vas_amount']));
            if (Session::get('user.checkout.shipKey') != $shipKey) {
                Session::put('user.checkout.shipKey', $shipKey);
                Session::put('user.checkout.selship', $shippingMethod[0]);
                Session::put('user.checkout.shipping', $shippingMethod);
            }
        }

        $continueUrl = '/checkout/payment';

        return View('checkout.shipping', ['continueUrl' => $continueUrl]);
    }

    //payment
    public function payment()
    {
        $payInfo = $this->getPayInfo();
        $params = array(
            'cmd' => 'couponlist',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $coupon = $this->request('openapi', '', 'cart', $params);
        foreach ($coupon['data']['list'] as $value) {
            if ($value['selected']) {
                $couponInfo = $value;
            }
        }
        $country = $this->getCountry();
        
        return View('checkout.payment', ['payInfo' => $payInfo['data']['list'], 'couponInfo' => $couponInfo, 'country' => $country['data']]);
    }

    //review
    public function review()
    {
        return View('checkout.review');
    }

    //地址管理
    public function address()
    {
        $result = $this->addrList();

        $country = $this->getCountry();

        return View('checkout.address', ['address' => $result['data']['list'], 'country' => $country['data']]);
    }

    //获取国家列表
    public function getCountry()
    {
        $params = array(
            'cmd' => 'country',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin')
        );
        $system = "";
        $service = "addr";
        $country = $this->request('openapi', $system, $service, $params);
        if (empty($country)) {
            $country['success'] = false;
            $country['error_msg'] = "Data access failed";
            $country['data'] = array();
        } else {
            if ($country['success']) {
                $commonlist = array();
                for ($index = 0; $index < $country['data']['amount']; $index++) {
                    $commonlist[] = array_shift($country['data']['list']);
                }
                $country['data']['commonlist'] = $commonlist;
            }
        }
        return $country;
    }

    //获取地址列表
    public function addrList()
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
        return $result;
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

    //动态切换选择地址
    public function selAddr($aid)
    {
        $address = $this->addrList();
        foreach ($address['data']['list'] as $value) {
            if ($value['receiving_id'] == $aid) {
                Session::put('user.checkout.address', $value);
                return $value;
            }
        }
    }

    //动态切换配送方式
    public function selShip($type)
    {
        foreach (Session::get('user.checkout.shipping') as $value) {
            if ($value['logistics_type'] == $type) {
                Session::put('user.checkout.selship', $value);
            }
        }
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
        } else {
            Session::put('user.checkout.address', $result['data']);
        }

        return $result;
    }

    //修改地址
    public function updateUserAddr(Request $request, $aid)
    {

        $params = array(
            'cmd' => 'modify',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'aid' => $aid,
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
        } else {
            Session::put('user.checkout.address', $result['data']);
        }
        return $result;

    }

    //获取支付列表
    public function getPayInfo()
    {
        $params = array(
            'cmd' => 'plist',
            'uuid' => $_COOKIE['uid'],
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        return $this->request('openapi', '', 'pay', $params);
    }

    //绑定支付信息
    public function addCard(Request $request)
    {

        $cardInfo = MCrypt::encrypt($request->get('month') . $request->get('year') . $request->get('card') . '/' . $request->get('cvv'));

        $params = array(
            'cmd' => 'acrd',
            'uuid' => $_COOKIE['uid'],
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'ci' => $cardInfo,//卡加密信息
        );

        $params['tel'] = $request->get('tel');
        $params['name'] = $request->get('name');
        $params['addr1'] = $request->get('addr1');
        $params['addr2'] = $request->get('addr2');
        $params['city'] = $request->get('city');
        $params['state'] = $request->get('state');
        $params['zip'] = $request->get('zip');
        $params['country'] = $request->get('country');
        $params['csn'] = $request->get('csn');


        return $this->request('openapi', '', 'pay', $params);
    }
}
