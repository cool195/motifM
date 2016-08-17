<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;

class QianhaiController extends ApiController
{

    //请求钱海支付
    public function index($orderid = 0, $price = 0)
    {
        $secureCode = 'v842rr80';
        $postData = array(
            'postUrl' => $_SERVER['HTTP_HOST'] == 'm.motif.me' ? 'https://secure.oceanpayment.com/gateway/service/pay' : 'https://secure.oceanpayment.com/gateway/service/test',
            'data' => array(
                'account' => '160444',
                'terminal' => '16044401',
                'backUrl' => 'http://' . $_SERVER['HTTP_HOST'] . '/qianhai',
                'noticeUrl' => 'http://54.222.233.255/oceanpaycb',
                'methods' => 'Credit Card',
                'pages' => '1',
                'order_number' => $orderid,
                'order_currency' => 'USD',
                'order_amount' => $price,
                'billing_firstName' => 'N/A',
                'billing_lastName' => 'N/A',
                'billing_email' => Session::get('user.login_email'),
                'billing_phone' => 'N/A',
                'billing_country' => 'N/A',
                'billing_city' => 'N/A',
                'billing_address' => 'N/A',
                'billing_zip' => 'N/A',
                'productSku' => 'N/A',
                'productName' => 'N/A',
                'productNum' => 'N/A'
            )
        );
        $postData['data']['signValue'] = hash("sha256", $postData['data']['account'] . $postData['data']['terminal'] . $postData['data']['backUrl'] . $postData['data']['order_number'] . $postData['data']['order_currency'] . $postData['data']['order_amount'] . $postData['data']['billing_firstName'] . $postData['data']['billing_lastName'] . $postData['data']['billing_email'] . $secureCode);
        return $postData;
    }

    //钱海回调
    public function checkStatus(Request $request)
    {
        if ($request->input('payment_status') == 1) {
            $params = array(
                'cmd' => "dopay",
                'uuid' => $_COOKIE['uid'],
                'token' => Session::get('user.token'),
                'pin' => Session::get('user.pin'),
                'orderid' => $request->input('order_number'),
                'paytype' => 'Oceanpay',
                'showname' => 'QianhaiCard',
                'devicedata' => "H5",
                'nonce' => '{"response":{"order_number":"' . $request->input('order_number') . '","payment_id":"' . $request->input('payment_id') . '","order_amount":"' . $request->input('order_amount') . '","payment_status":"' . $request->input('payment_status') . '","methods":"' . $request->input('payment_Method') . '","card_number":"' . $request->input('card_number') . '"}}',
            );
            if (strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') || strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios')) {
                return redirect('http://AppPayWithStatus='.$params['nonce']);
            }else{
                $this->request('openapi', "", "pay", $params);
                return redirect('/success?orderid=' . $request->input('order_number'));
            }
        } else {
            return redirect('/order/orderdetail/' . $request->input('order_number'));
        }
    }
}