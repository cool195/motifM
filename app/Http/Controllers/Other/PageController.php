<?php

namespace App\Http\Controllers\Other;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ApiController;

class PageController extends ApiController
{
    //aboutMotif
    public function error()
    {
        return View('error');
    }

    //aboutMotif
    public function aboutmotif()
    {
        return View('Other.page-aboutMotif');
    }

    //cancellationPolicy
    public function cancellationPolicy()
    {
        return View('Other.page-cancellationPolicy');
    }

    //contactUs
    public function contactUs()
    {
        return View('Other.page-contactUs');
    }

    //shippingreturns
    public function shippingreturns()
    {
        return redirect('/template/23');
        //return View('Other.page-shippingreturns');
    }

    //payments
    public function payments()
    {
        return View('Other.page-payment');
    }

    //faq
    public function faq()
    {
        return View('Other.page-FAQ');
    }

    //motifGuarantee
    public function motifGuarantee()
    {
        return View('Other.page-motifGuarantee');
    }

    //privacyPolicy
    public function privacyPolicy()
    {
        return View('Other.page-privacyPolicy');
    }

    //sizeGuide
    public function sizeGuide()
    {
        return View('Other.page-sizeGuide');
    }

    //termsService
    public function termsService()
    {
        return View('Other.page-termsService');
    }

    //userAgreement
    public function userAgreement()
    {
        return View('Other.page-userAgreement');
    }

    public function pcPrivacyPolicy()
    {
        return View('Other.pc-privacyPolicy');
    }

    public function pcTermsService()
    {
        return view('Other.pc-termsService');
    }

    public function invite($code = "")
    {
        return view('Other.invite', ['code' => $code]);
    }

    public function inviteFriends()
    {
        $params = array(
            'cmd' => "detail",
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
        );
        $result = $this->request('openapi', '', 'user', $params);
        return view('Other.invite-friend', ['code' => $result['data']['invite_code']]);
    }

    public function saleinfo()
    {
        return view('Other.saleinfo');
    }

    public function apptest()
    {
        $mobile = $this->isMobile();
        return view('Other.apptest', ['mobile' => $mobile]);
    }

    public function orderlist()
    {
        return view('Other.orderlist');
    }

    public function error404()
    {
        return view('errors.404');
    }

    public function downapp()
    {
        return View('designer.downapp');
    }

    private function isMobile()
    {
        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return true;
        }

        if (isset($_SERVER['HTTP_VIA'])) {
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }

        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array(
                'nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
            );

            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }

        if (isset($_SERVER['HTTP_ACCEPT'])) {
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }

        return false;

    }
}

?>