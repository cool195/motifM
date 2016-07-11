<?php
namespace App\PayPal;

use \PayPal\Api\Payer;
use \PayPal\Api\Item;
use \PayPal\Api\ItemList;
use \PayPal\Api\Details;
use \PayPal\Api\Amount;
use \PayPal\Api\Transaction;
use \PayPal\Api\RedirectUrls;
use \PayPal\Api\Payment;
use \PayPal\Exception\PayPalConnectionException;
use Illuminate\Http\Request;

Class PayPal
{
//live:
//     clientid:
//AeJ0JypMpSkBh2pvVrWMSg8Km_l6fcmWXUQ0oWxom2tz8nPzBB1rWu71bkL1j4S-TGsjGYrbfDZYiWWe
//     secret
//ECmKQFY0UdanCEXHr6bHQ1PCwivwmtEMWma30r3ejfOlvQVlSW6_rwuXp4leydeHrcqSCthauqka1BYU
//lijiang.hou-buyer2@gmail.com
//gsx12345
    public static $paypalObj;
    const clientID = 'AV8SZ3C16kSXKT4-vPI3pRf0Fo2j-kHLj9jDc3Eg346Q74XcbxJyAMlQsSPy3x5iiRFsXhn3xM57Pj4b';
    const secret = 'EApPC9Qkz0WFkK76gFbz8miNMgsMeZT27LTc24ABFpAcyUqMqBXiLKjR73xX-U7Q8Xlc_szx_5yGP52q';
    const SITE_URL = 'http://m.motif.me';

    public static function __construct()
    {
        Self::$paypalObj = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthTokenCredential(Self::clientID, Self::secret));
        //$this->paypal = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthTokenCredential(Self::clientID, Self::secret));
    }

    public static function createOrder($product, $price, $shipping)
    {
        $total = $price + $shipping;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($product)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping($shipping)
            ->setSubtotal($price);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("支付描述内容")
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(Self::SITE_URL . '/paypal?success=true')
            ->setCancelUrl(Self::SITE_URL . '/paypal?success=false');

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create(Self::$paypalObj);
        } catch (PayPalConnectionException $e) {
            echo $e->getData();
            die();
        }

        $approvalUrl = $payment->getApprovalLink();
        header("Location: {$approvalUrl}");
    }

    //paypal回调
    public static function paypalStatic(Request $request)
    {
        if ($request->input('paymentId') || $request->input('success') || $request->input('PayerID')) {
            die();
        }

        if ((bool)$request->input('success') === 'false') {

            echo 'Transaction cancelled!';
            die();
        }

        $paymentID = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        $payment = Payment::get($paymentID, Self::$paypalObj);

        $execute = new PaymentExecution();
        $execute->setPayerId($payerId);

        try {
            $result = $payment->execute($execute, Self::$paypalObj);
            return $result;
        } catch (Exception $e) {
            die($e);
        }
    }
}