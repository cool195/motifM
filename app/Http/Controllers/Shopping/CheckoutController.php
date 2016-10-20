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
        //是否成功支付过 TODO 暂时判断是否为空,以后更新成是否支付成功过
        if (!empty($payInfo['data']['list'])) {
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
            $shipPrice = $this->getCheckOutAccountList($address['data']['receiving_id']);
            $shippingMethod = $this->getShippingMethod($address['data']['country_name_sn'], $shipPrice['data']['total_amount'] + $shipPrice['data']['vas_amount']);
            Session::put('user.checkout.shipping', $shippingMethod);
        }

        return View('checkout.shipping');
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

    //地址管理
    public function address()
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

        $params = array(
            'cmd' => 'country',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin')
        );
        $system = "";
        $service = "useraddr";
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

        return View('checkout.address', ['address' => $result['data']['list'], 'country' => $country['data']]);
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

        if ($request->get('isDefault')) {
            $address = $this->getUserDefaultAddr();
            $params['tel'] = $address['data']['telephone'];
            $params['name'] = $address['data']['name'];
            $params['addr1'] = $address['data']['detail_address1'];
            $params['addr2'] = $address['data']['detail_address2'];
            $params['city'] = $address['data']['city'];
            $params['state'] = $address['data']['state'];
            $params['zip'] = $address['data']['zip'];
            $params['country'] = $address['data']['country'];
            $params['csn'] = $address['data']['country_name_sn'];
        } else {
            $params['tel'] = $request->get('tel');
            $params['name'] = $request->get('name');
            $params['addr1'] = $request->get('addr1');
            $params['addr2'] = $request->get('addr2');
            $params['city'] = $request->get('city');
            $params['state'] = $request->get('state');
            $params['zip'] = $request->get('zip');
            $params['country'] = $request->get('country');
            $params['csn'] = $request->get('csn');
        }

        return $this->request('openapi', '', 'pay', $params);
    }
}
