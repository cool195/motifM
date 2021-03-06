<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;
use App\Services\MCrypt;

class CheckoutController extends ApiController
{

    //shipping
    public function shipping(Request $request)
    {
        $payInfo = $this->getPayInfo();
        $isPay = false;
        foreach ($payInfo['data']['list'] as $value) {
            if ($value['isLast'] == 1) {
                $isPay = true;
            }
        }

        //获取默认地址
        if (!empty(Session::get('user.checkout.address'))) {
            $address = Session::get('user.checkout.address');
        } else {
            $address = $this->getUserDefaultAddr();
            Session::put('user.checkout.address', $address['data']);
            $address = $address['data'];
        }

        //没有地址进入添加地址页面

        if (empty($address)) {
            return redirect('/checkout/address');
        } else {
            $shipPrice = $this->getCheckOutAccountList($address['receiving_id']);
            if (empty($shipPrice['data'])) {
                return redirect('/cart');
            }

            $shippingMethod = $this->getShippingMethod(Session::get('user.checkout.address.country_name_sn'), $shipPrice['data']['total_amount'] + $shipPrice['data']['vas_amount']);

            $shipKey = md5($address['receiving_id'] . ($shipPrice['data']['total_amount'] + $shipPrice['data']['vas_amount']));
            if (Session::get('user.checkout.shipKey') != $shipKey) {
                Session::put('user.checkout.shipKey', $shipKey);
                if (!$this->searchSelShip($shippingMethod)) {
                    Session::put('user.checkout.selship', $shippingMethod[0]);
                }
                Session::put('user.checkout.shipping', $shippingMethod);
                //Session::forget('user.checkout.couponInfo');
            }
        }

        //是否成功支付过
        if ($isPay && !$request->get('from')) {
            $this->lastPay($payInfo);
            return redirect('/checkout/review');
        }
        $continueUrl = '/checkout/' . ($request->get('from') ? $request->get('from') : 'payment');

        return View('checkout.shipping', ['continueUrl' => $continueUrl, 'isPay' => $isPay, 'from' => $request->get('from')]);
    }

    //payment
    public function payment(Request $request)
    {
        //return Session::get('user.checkout');
        $payInfo = $this->getPayInfo();
        $coupon = $this->couponCache();
        $country = $this->getCountry(1);

        return View('checkout.payment', ['payInfo' => $payInfo['data']['list'], 'coupon' => $coupon['data'], 'country' => $country['data'], 'from' => $request->get('from')]);
    }

    //review
    public function review(Request $request)
    {
        if (!Session::has('user.checkout.address.receiving_id') || !Session::has('user.checkout.selship.logistics_type')) {
            return redirect('/checkout/shipping');
        } else if (!Session::has('user.checkout.paywith.pay_method')) {
            return redirect('/checkout/payment');
        } else if (!Session::get('user.checkout.couponInfo.bind_id')) {
            $this->couponCache();
        }
        $checkInfo = $this->getCheckOutAccountList(Session::get('user.checkout.address.receiving_id'), Session::get('user.checkout.selship.logistics_type'), Session::get('user.checkout.couponInfo.bind_id'));

        if (empty($checkInfo['data'])) {
            return redirect('/cart');
        }

        $shipKey = md5(Session::get('user.checkout.address.receiving_id') . ($checkInfo['data']['total_amount'] + $checkInfo['data']['vas_amount']));

        if (Session::get('user.checkout.shipKey') != $shipKey) {
            $message = '';
            Session::put('user.checkout.shipKey', $shipKey);
            $shippingMethod = $this->getShippingMethod(Session::get('user.checkout.address.country_name_sn'), $checkInfo['data']['total_amount'] + $checkInfo['data']['vas_amount']);
            if (!$this->searchSelShip($shippingMethod)) {
                Session::put('user.checkout.selship', $shippingMethod[0]);
                $message = '?message=true';
            }
            Session::put('user.checkout.shipping', $shippingMethod);
            return redirect('/checkout/review'.$message);
        }
        if ($request->get('message')) {
            $checkInfo['data']['message'] = 'Opps~~ shipping method changed.';
        }
        return View('checkout.review', ['checkInfo' => $checkInfo['data'], 'payStatus' => $request->get('pay')]);
    }

    //物流方式是否变更
    private function searchSelShip($shippingMethod)
    {
        foreach ($shippingMethod as $value) {
            if ($value['logistics_type'] == Session::get('user.checkout.selship.logistics_type')) {
                return true;
            }
        }
        return false;
    }

    //couponcache
    public function couponCache()
    {
        $coupon = $this->getCouponInfo();
        $isCoupon = false;
        foreach ($coupon['data']['list'] as $value) {
            if (Session::get('user.checkout.couponInfo.bind_id') == $value['bind_id']) {
                $isCoupon = true;
                break;
            }
        }

        if (!$isCoupon) {
            foreach ($coupon['data']['list'] as $value) {
                if ($value['selected']) {
                    $couponInfo = $value;
                    Session::put('user.checkout.couponInfo', $couponInfo);
                }
            }
        }
        return $coupon;
    }

    //地址管理
    public function address(Request $request)
    {
        $result = $this->addrList();

        $country = $this->getCountry();

        return View('checkout.address', ['address' => $result['data']['list'], 'country' => $country['data'], 'from' => $request->get('from')]);
    }

    //获取国家列表
    public function getCountry($scope = 0)
    {
        $params = array(
            'cmd' => 'country',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'scope' => $scope ? $scope : 0
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
            'bindid' => $bindid ? $bindid : '',
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

    //删除支付卡
    public function deleteCard($id)
    {
        $params = array(
            'cmd' => 'dcrd',
            'uuid' => $_COOKIE['uid'],
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'cd' => $id,
        );
        $result = $this->request('openapi', '', 'pay', $params);
        if ($result['success'] && Session::get('user.checkout.paywith.withCard.card_id') == $id) {
            Session::forget('user.checkout.paywith');
        }
        return $result;
    }

    //获取coupon列表
    public function getCouponInfo()
    {
        $params = array(
            'cmd' => 'couponlist',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $coupon = $this->request('openapi', '', 'cart', $params);
        return $coupon;
    }

    //绑定支付信息
    public function addCard(Request $request)
    {
        $expiry = explode('/', $request->get('expiry'));
        $cardInfo = MCrypt::encrypt(trim($expiry[0]) . '20' . trim($expiry[1]) . str_replace(' ', '', $request->get('card')) . '/' . $request->get('cvv'));

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
        $params['ctype'] = $request->get('card_type');
        $result = $this->request('openapi', '', 'pay', $params);
        if ($result['success']) {
            $this->paywith($request->get('add_type'), $result['data']['card_id']);
        }
        return $result;
    }

    //选择支付方式
    public function paywith($type, $cardid)
    {
        $payInfo = $this->getPayInfo();
        foreach ($payInfo['data']['list'] as $value) {
            if ($cardid > 0) {
                foreach ($value['creditCards'] as $card) {
                    if ($card['card_id'] == $cardid) {
                        $value['withCard'] = $card;
                        Session::put('user.checkout.paywith', $value);
                        Session::forget('user.checkout.paywith.creditCards');
                        return $value;
                    }
                }
            } else {
                if ($value['pay_type'] == $type) {
                    Session::put('user.checkout.paywith', $value);
                    Session::forget('user.checkout.paywith.creditCards');
                    return $value;
                }
            }
        }
    }

    //获取最后一次的支付信息
    public function lastPay($payInfo)
    {
        foreach ($payInfo['data']['list'] as $value) {
            if ($value['isLast'] == 1) {
                if (empty($value['creditCards'])) {
                    Session::put('user.checkout.paywith', $value);
                    Session::forget('user.checkout.paywith.creditCards');
                    return $value;
                } else {
                    foreach ($value['creditCards'] as $card) {
                        if ($card['isLast'] == 1) {
                            $value['withCard'] = $card;
                            Session::put('user.checkout.paywith', $value);
                            Session::forget('user.checkout.paywith.creditCards');
                            return $value;
                        }
                    }
                }
            }
        }
    }

    //选择code
    public function selCode($bindid)
    {
        $coupon = $this->getCouponInfo();
        foreach ($coupon['data']['list'] as $value) {
            if ($value['bind_id'] == $bindid && $value['usable']) {
                $couponInfo = $value;
                Session::put('user.checkout.couponInfo', $couponInfo);
            }
        }
    }
}
