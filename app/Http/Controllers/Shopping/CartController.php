<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;

class CartController extends ApiController
{
    /*
     * 购物车页面接口
     *
     * @author zhangtao@evermarker.net
     *
     * */
    public function index(Request $request)
    {
        $cartList = $this->getCartList($request);
        $saveList = $this->getCartSaveList($request);
        return View('shopping.cart', [
            'cartData' => $cartList['data'],
            'saveData' => $saveList['data']
        ]);
    }

    /*
     * 订单确认接口
     *
     * @author zhangtao@evermarker.net
     *
     * */
    public function orderCheckout(Request $request)
    {
        //$defaultPayMethod = $this->getDefaultPayMethod();
        $stype = !empty($request->input('stype')) ? $request->input('stype', 1) : 1; //必须加非空验证
        $bindid = $request->input('bindid');
        $address = $this->getUserAddrByAid($request->input('aid', 0));
        if(empty($address)){
            return redirect('cart/addradd?first=1');
        }
        $defaultMethod = $this->getShippingMethodByStypeOrDefault($stype);
        $result = $this->getCartAccountList($request, $defaultMethod['logistics_type'], $bindid,'',$address['receiving_id']);

        if (empty($result['data']) || empty($result['success']) || !$result['success']) {
            return redirect('cart/ordercheckout');
        }
        $result['data']['cardlist'] = array('Diners' => 'diners-club', 'Discover' => 'discover', 'JCB' => 'jcb', 'Maestro' => 'maestro', 'AmericanExpress' => 'american-express', 'Visa' => 'visa', 'MasterCard' => 'master-card');
        return View('shopping.ordercheckout', [
            'data' => $result['data'],
            'addr' => $address,
            //'paym'=> $request->input('paym', !empty($defaultPayMethod['data']['type']) ? $defaultPayMethod['data']['type'] : ""),
            'paym' => $request->input('paym', "Oceanpay"),
            'cardType' => $request->input('cardType', !empty($defaultPayMethod['data']['cardType']) ? $defaultPayMethod['data']['cardType'] : ""),
            //'methodtoken' => $request->input('methodtoken', !empty($defaultPayMethod['data']['token']) ? $defaultPayMethod['data']['token'] : "" ),
            //'showName' => $request->input('showName', !empty($defaultPayMethod['data']['showName']) ? $defaultPayMethod['data']['showName'] : "" ),
            'showName' => $request->input('showName', 'PayPal'),
            'shipMethodList' => $this->getShippingMethod(),
            'defaultMethod' => $defaultMethod,
            'bindid' => $bindid,
            'remark' => $request->input('remark', ""),
            'stype' => $defaultMethod['logistics_type'],
            'input' => $request->except('pageSrc', 'aid', 'stype', 'paym', 'cardType', 'methodtoken', 'showName', 'eid')
        ]);
    }

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

    public function addressList(Request $request)
    {
        //$input = $request->except('aid', 'checkout');
        $input = $request->except('aid', 'checkout', 'email', 'name', 'addr1', 'addr2', 'state', 'city', 'zip', 'tel', 'idnum', 'country', 'isd', 'route', 'eid');
        $aid = $request->input('aid', 0);
        $result = $this->getUserAddressList();
        return View('shopping.ordercheckout_addresslist', ['data' => $result['data'], 'input' => $input, 'aid' => $aid]);
    }

    private function getUserAddrByAid($aid)
    {
        $addrList = $this->getUserAddressList();
        $defaultAddr = $this->getUserDefaultAddr();
        $addr = $defaultAddr['data'];
        if ($addrList['success'] && !empty($addrList['data']['list'])) {
            if (isset($addrList['data']['list'][$aid])) {
                $addr = $addrList['data']['list'][$aid];
            }
        }
        return $addr;
    }

    private function getUserAddressList()
    {
        $cmd = 'list';
        $params = array(
            'cmd' => $cmd,
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
            $result['data']['list'] = array();
        } else {
            if ($result['success'] && !empty($result['data']['list'])) {
                $list = array();
                foreach ($result['data']['list'] as $addr) {
                    $list[$addr['receiving_id']] = $addr;
                }
                $result['data']['list'] = $list;
            }
        }
        return $result;
    }

    public function addrAdd(Request $request)
    {
        $defaultCountry = array('country_id' => 1, 'child_label' => "State", 'child_type' => 2, 'country_name_cn' => '美国', 'country_name_sn'=>'US','country_name_en' => "United States", 'iDnumberReq' => 0, 'isFreq' => 1, 'sort_no' => 100);
        $country = json_decode(base64_decode($request->input('countryState',$request->input('country', base64_encode(json_encode($defaultCountry))))), true);
        $state = json_decode(base64_decode($request->input('state')), true);
        $input = $request->except('country');
        $checkout = $request->except('email', 'name', 'addr1', 'addr2', 'state', 'city', 'zip', 'tel', 'idnum', 'country', 'isd', 'route');
        return View('shopping.ordercheckout_addaddress', ['input' => $input,'state'=>$state, 'checkout' => $checkout, 'country' => $country, 'first' => $request->input('first')]);
    }

    public function addrModify(Request $request)
    {
        $checkout = $request->except('email', 'name', 'addr1', 'addr2', 'state', 'city', 'zip', 'tel', 'idnum', 'country', 'isd', 'route', 'eid');
        $state = json_decode(base64_decode($request->input('state')), true);
        if ($request->has('country')) {
            $input = $request->except('country', 'eid');
            $input['detail_address1'] = $input['addr1'];
            $input['detail_address2'] = $input['addr2'];
            $input['telephone'] = $input['tel'];
            //$input['iDnumber'] = $input['idnum'];
            $input['isDefault'] = $input['isd'];
            $input['receiving_id'] = $input['aid'];
            $country = json_decode(base64_decode($request->input('countryState',$request->input('country'))), true);
            $input['country'] = $country['country_name_en'];
        } else {
            $eid = $request->input('eid', 0);
            $input = $this->getUserAddrByAid($eid);
            $state = $state ? $state : array('state_name_sn'=>$input['state']);
            $params = array(
                'cmd' => 'country',
                'token' => Session::get('user.token'),
                'pin' => Session::get('user.pin')
            );
            $countrylist = $this->request('openapi', '', 'addr', $params);
            foreach ($countrylist['data']['list'] as $value){
                if($value['country_name_en']==trim($input['country'])){
                    $country = $value;
                    break;
                }
            }
        }

        return View('shopping.ordercheckout_modaddress', ['country'=>$country,'state'=>$state,'input' => $input, 'checkout' => $checkout]);
    }

    public function countryList(Request $request)
    {

        $input = $request->except('route', 'country');
        $route = $request->input('route');
        //$checkout = $request->except('email', 'name', 'addr1', 'addr2', 'state', 'city', 'zip', 'tel', 'idnum', 'country', 'isd', 'route');
        $params = array(
            'cmd' => 'country',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin')
        );
        $system = "";
        $service = "addr";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        } else {
            if ($result['success'] && !empty($result['data']['list'])) {
                $commonlist = array();
                for ($index = 0; $index < $result['data']['amount']; $index++) {
                    $commonlist[] = array_shift($result['data']['list']);
                }
                $result['data']['commonlist'] = $commonlist;
            }
        }
        return View('shopping.countrylist', ['list' => $result['data']['list'], 'commonlist' => $result['data']['commonlist'], 'route' => $route, 'input' => $input]);
    }

    private function getDefaultPayMethod()
    {
        $params = array(
            'cmd' => "getdefault",
            'uuid' => @$_COOKIE['uid'],
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $system = "";
        $service = "pay";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        }
        return $result;
    }

    /*
     * 跳转至填写Coupon页面
     *
     * @author zhangtao@evermarker.net
     * */
    public function coupon(Request $request)
    {
        $input = $request->except('bindid');
        $bindid = $request->input('bindid', "");

        $params = array(
            'cmd' => 'couponlist',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $result = $this->request('openapi', '', 'cart', $params);
        return View('shopping.ordercheckout_addcoupon', ['couponlist' => $result['data'], 'input' => $input, 'bindid' => $bindid]);
    }

    public function message(Request $request)
    {
        $input = $request->except('remark');
        $remark = $request->input('remark', "");
        return View('shopping.ordercheckout_message', ['input' => $input, 'remark' => $remark]);
    }

    /*
     * 获取购物车数量
     *
     * @author zhangtao@evermarker.net
     * */
    public function getCartAmount(Request $request)
    {
        $params = array(
            'cmd' => 'amount',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $system = "";
        $service = "cart";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        } else {
            if ($result['success']) {
                if (empty($result['data']['saveAmout'])) {
                    $result['data']['saveAmout'] = 0;
                }
                if (empty($result['data']['skusAmout'])) {
                    $result['data']['skusAmout'] = 0;
                }
            }
        }
        return $result;
    }

    /*
     * 获取购物车商品列表
     *
     * @author zhangtao@evermarker.net
     * @param Request
     * @return Array
     *
     * */
    public function getCartList(Request $request)
    {
        $params = array(
            'cmd' => "cartlist",
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
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

    /*
     * 获取购物车结算商品列表
     *
     * @author zhangtao@evermarker.net
     * @param Request
     * @return Array
     *
     * */
    public function getCartAccountList(Request $request, $logisticstype = 1, $bindid = "", $paytype = "",$aid)
    {

        $params = array(
            'cmd' => 'accountlist',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'logisticstype' => $request->input('logisticstype', $logisticstype),
            'paytype' => $request->input('paytype', $paytype),
            'bindid' => $request->input('bindid', $bindid),
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

    /*
     * 获取购物车暂存商品列表
     *
     * @author zhangtao@evermarker.net
     * @param Request
     * @return Array
     *
     * */
    public function getCartSaveList(Request $request)
    {
        $params = array(
            'cmd' => 'savelist',
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
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

    /*
     * 添加购物车
     *
     * @author zhangtao@evermarker.net
     * @return Array
     * */
    public function addCart(Request $request)
    {
        $params = array(
            'cmd' => 'addsku',
            'operate' => json_encode($request->input('operate')),
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $system = "";
        $service = "cart";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data'] = array();
        } else {
            if ($result['success']) {
                $result['redirectUrl'] = "";
            }
        }
        return $result;
    }

    public function addBatchCart(Request $request)
    {

        $params = array(
            'cmd' => 'batchaddskus',
            'operate' => json_encode($request->input('operate')),
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $system = "";
        $service = "cart";
        $result = $this->request('openapi', $system, $service, $params);
        if (!empty($result) && $result['success']) {
            $result['redirectUrl'] = '/cart';
        }
        return $result;
    }

    /*
     * 修改购物车商品数量
     *
     * @author zhangtao@evermarker.net
     * @return Array
     * */
    public function alterCartProQtty(Request $request)
    {
        $params = array(
            'cmd' => 'alterqtty',
            'sku' => $request->input('sku'),
            'qtty' => $request->input('qtty'),
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $system = "";
        $service = "cart";
        $result = $this->request('openapi', $system, $service, $params);
        return $result;
    }

    /*
     * 立即购买接口
     *
     * @author zhangtao@evermarker.net
     *
     * @return Array
     * */
    public function promptlyBuy(Request $request)
    {
        $params = array(
            'cmd' => 'promptlybuy',
            'operate' => json_encode($request->input('operate')),
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $system = "";
        $service = "cart";
        $result = $this->request('openapi', $system, $service, $params);
        if ($result['success']) {
            $result['redirectUrl'] = '/cart/ordercheckout';
        }
        return $result;
    }

    /*
     * 购物车其它操作接口
     *
     * @author zhangtao@evermarker.net
     *
     * @params Request
     * @return Array
     * */
    public function operateCartProduct(Request $request)
    {
        $cmdSelector = array("select", "cancal", "delsku", "save", "movetocart", "delsave");
        $cmd = $request->input('cmd');
        $result = "";
        if (in_array($cmd, $cmdSelector)) {
            $params = array(
                'cmd' => $cmd,
                'sku' => $request->input('sku'),
                'token' => Session::get('user.token'),
                'pin' => Session::get('user.pin'),
            );
            $system = "";
            $service = "cart";
            $result = $this->request('openapi', $system, $service, $params);
            if (!empty($result) && $result['success']) {
                return $result;
            }
        }
    }

    /*
     * 验证Coupon是否有效
     *
     * @author zhangtao@evermarker.net
     * @return Array
     *
     * */
    public function verifyCoupon(Request $request)
    {
        $params = array(
            'cmd' => 'bind',
            'couponcode' => $request->input('couponcode'),
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $system = "";
        $service = "coupon";
        $result = $this->request('openapi', $system, $service, $params);
        return $result;
    }

    public function getShippingMethodByStypeOrDefault($stype)
    {
        $method = array();
        $methodList = $this->getShippingMethod();
        if (!empty($methodList)) {
            $method = current($methodList);
            if (isset($methodList[$stype])) {
                $method = $methodList[$stype];
            }
        }
        return $method;
    }

    public function getShippingMethod()
    {
        $params = array(
            'cmd' => 'logis',
            'token' => Session::get('user.token')
        );
        $result = $this->request('openapi', "", "general", $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data']['list'] = array();
        } else {
            if ($result['success'] && !empty($result['data']['list'])) {
                $list = array();
                foreach ($result['data']['list'] as $method) {
                    $list[$method['logistics_type']] = $method;
                }
                $result['data']['list'] = $list;
            }
        }
        return $result['data']['list'];
    }

}
