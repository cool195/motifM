<?php

namespace App\Http\Controllers\Designer;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;
use Cache;
use Cookie;
use App\Services\Publicfun;

class DesignerController extends ApiController
{
    //设计师首页
    public function index(Request $request)
    {
        $params = array(
            'cmd' => $request->input('cmd'),//designerinfolist
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'size' => $request->input('size', 10),
            'start' => $request->input('start', 1),
        );

        if (empty($params['cmd'])) {
            //首次加载,请求推荐设计师数据
            /*            $result = $this->request('openapi', '', 'designer', array(
                            'cmd' => 'recdesignerlist',
                            'token' => Session::get('user.token'),
                            'pin' => Session::get('user.pin')
                        ));*/

            return View('designer.index', ['NavShowDesigner' => true]);
        } else {
            //非首次加载,请求设计师列表数据
            $result = $this->request('openapi', '', 'designer', $params);
            foreach ($result['data']['list'] as &$list) {
                $list['spus'] = "";
                if (isset($list['products'])) {
                    $spus = array();
                    foreach ($list['products'] as $product) {
                        $spus[] = $product['spu'];
                    }
                    $list['spus'] = implode('_', $spus);
                }
            }
            return $result;
        }

    }

    //设计师详情
    public function show(Request $request, $id)
    {
        if (is_numeric($id)) {
            //设计师详情
            $params = array(
                'cmd' => 'designerdetail',
                'pin' => Session::get('user.pin'),
                'token' => Session::get('user.token'),
                'd_id' => $id,
            );

            $result = $this->request('openapi', '', 'designer', $params);

            $result = $this->pregDesignerUrl($result);
            //设计师商品动态模版
            $params = array(
                'cmd' => 'dmodel',
                'id' => $id,
            );
            $product = $this->request('openapi', '', 'designer', $params);
            if($product['success']){
                foreach($product['data']['spuInfos'] as &$pro){
                    $titleArray = explode(" ", $pro['spuBase']['main_title']);
                    $titleArray[] = $pro['spuBase']['spu'];
                    $pro['spuBase']['seo_link'] = implode("-", $titleArray);
                }
            }

            //设计师推荐商品
            $params = array(
                'recid' => '100004',
                'pagenum' => 1,
                'pagesize' => 50,
                'uuid' => $_COOKIE['uid'] ? $_COOKIE['uid'] : 'ioscookieuidnull',
                'extra_kv' => 'designerId:' . $id,
                'pin' => Session::get('user.pin'),
            );
            $productAll = $this->request('openapi', '', 'rec', $params);

            $view = '';
            $NavShow = true;
            $result['data']['osType'] = strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios') ? 'ios' : 'android';
            if ($_GET['test'] || strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') || strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios')) {

                error_log(print_r("--------header cookie--------\n", "\n"), 3, '/tmp/myerror.log');
                error_log(print_r($request->header(), "\n"), 3, '/tmp/myerror.log');

                error_log(print_r("-------request all-------\n", "\n"), 3, '/tmp/myerror.log');
                error_log(print_r($request->all(), "\n"), 3, '/tmp/myerror.log');

                !empty($_COOKIE['VERSION']) ? Session::put('VERSION', implode("", explode("." ,$_COOKIE['VERSION']))) : "";

                if ($request->input('token') || !empty($_COOKIE['PIN'])) {
                    if ($request->input('token')) {
                        Session::put('user', array(
                            'login_email' => $request->input('email'),
                            'nickname' => $request->input('name'),
                            'pin' => $request->input('pin'),
                            'token' => $request->input('token'),
                            'uuid' => $_COOKIE['uid'],
                        ));
                        /*Cache::put($request->input('token'), array(
                            'login_email' => $request->input('email'),
                            'nickname' => $request->input('name'),
                            'pin' => $request->input('pin'),
                            'token' => $request->input('token'),
                            'uuid' => $_COOKIE['uid'],
                        ));*/
                    } else {
                        Session::put('user', array(
                            'login_email' => $_COOKIE['EMAIL'],
                            'nickname' => urldecode($_COOKIE['NAME']),
                            'pin' => $_COOKIE['PIN'],
                            'token' => $_COOKIE['TOKEN'],
                            'uuid' => $_COOKIE['UUID'],
                        ));
                        /*Cache::put($request->input('token'), array(
                            'login_email' => $request->input('email'),
                            'nickname' => $request->input('name'),
                            'pin' => $request->input('pin'),
                            'token' => $request->input('token'),
                            'uuid' => $_COOKIE['uid'],
                        ));*/
                    }

                    //执行登录前wish操作
                    if ($request->input('wishspu')) {
                        Publicfun::addWishProduct($request->input('wishspu'));
                        $result['data']['pushspu'] = $request->input('wishspu');
                    }

                    //执行登录前follow操作
                    if ($request->input('des')) {
                        Publicfun::addFollowDesigner($request->input('des'));
                        $result['data']['followStatus'] = true;
                    }


                    $spuArray = array();
                    foreach ($product['data']['infos'] as $value) {
                        if (isset($value['spus'])) {
                            $spuArray = array_merge($value['spus'], $spuArray);
                        }
                    }

                    foreach ($productAll['data']['list'] as $value) {



                        if (isset($value['spu'])) {
                            $spuArray = array_merge([$value['spu']], $spuArray);
                        }
                    }

                } else {
                    //Cache::forget(Session::get('user.token'));
                    Session::forget('user');
                }
                $view = 'designer.showApp';
                $NavShow = false;

                error_log(print_r("--------cookie token--------\n", "\n"), 3, '/tmp/myerror.log');
                error_log(print_r(Cookie::get('TOKEN'), "\n"), 3, '/tmp/myerror.log');
                error_log(print_r("--------pin--------\n", "\n"), 3, '/tmp/myerror.log');
                error_log(print_r(Cookie::get('PIN'), "\n"), 3, '/tmp/myerror.log');
                error_log(print_r("--------user--------\n", "\n"), 3, '/tmp/myerror.log');
                error_log(print_r(Session::get('user'), "\n"), 3, '/tmp/myerror.log');
            } else {
                $view = 'designer.show';
            }
            $result['data']['spuArray'] = json_encode($spuArray);
            $followParams = array(
                'cmd' => 'is',
                'pin' => Session::get('user.pin'),
                'token' => Session::get('user.token'),
                'did' => $result['data']['designer_id'],
            );
            $follow = $this->request('openapi', '', 'follow', $followParams);
            $result['data']['followStatus'] = $follow['data']['isFC'];

            $maidian['uuid'] = $_COOKIE['UUID'] ? $_COOKIE['UUID'] : $_COOKIE['uid'];
            $maidian['utm_medium'] = $request->get('utm_medium');
            $maidian['utm_source'] = $request->get('utm_source');
            return View($view, ['maidian' => $maidian, 'NavShowDesigner' => $NavShow,'designer' => $result['data'], 'productAll' => $productAll, 'product' => $product['data']]);
        }

    }

    private function pregDesignerUrl($result)
    {
        if(!empty($result['data']['instagram_link'])){
            $result['data']['instagram_link'] = $this->pregUrl($result['data']['instagram_link']);
        }
        if(!empty($data['data']['facebook_link'])){
            $result['data']['facebook_link'] = $this->pregUrl($result['data']['facebook_link']);
        }
        if(!empty($result['data']['youtube_link'])){
            $result['data']['youtube_link'] = $this->pregUrl($result['data']['youtube_link']);
        }
        if(!empty($result['data']['blog_link'])){
            $result['data']['blog_link'] = $this->pregUrl($result['data']['blog_link']);
        }
        if(!empty($result['data']['snapchat_link'])){
            $result['data']['snapchat_link'] = $this->pregUrl($result['data']['snapchat_link']);
        }
        return $result;
    }

    private function pregUrl($url)
    {
        $preg = '/^http/';
        if(!preg_match($preg, $url)){
            $url = 'http://'.$url;
        }
        return $url;
    }

    //关注或取消设计师
    public function follow($id)
    {
        if (!empty($id)) {
            return Publicfun::addFollowDesigner($id, true);
        }
    }

    public function skipDesigner()
    {
        if ($this->isMobile()) {
            return redirect('/designer/99');
            //return View('designer.skipDesigner');
        } else {
            return View('daily.download_guide');
        }

    }

    //关注设计师列表
    public function following(Request $request)
    {
        $params = array(
            'cmd' => 'list',
            'pin' => Session::get('user.pin'),
            'token' => Session::get('user.token'),
            'num' => $request->input('num', 1),
            'size' => $request->input('size', 8)
        );
        $result = $this->request('openapi', '', 'follow', $params);
        if ($request->input('ajax')) {
            return $result;
        }
        return View('designer.followlist', ['followlist' => $result['data']['list']]);
    }

    public function followList()
    {
        if (Session::get('user.pin')) {
            $value = Cache::remember(Session::get('user.pin') . 'followlist',60, function () {
                $params = array(
                    'cmd' => 'list',
                    'pin' => Session::get('user.pin'),
                    'token' => Session::get('user.token'),
                    'num' => 1,
                    'size' => 500
                );
                $result = $this->request('follow', $params);
                if ($result['success'] && $result['data']['amount'] > 0) {
                    foreach ($result['data']['list'] as $value) {
                        $result['cacheList'][] = $value['userId'];
                    }
                }
                return $result['cacheList'];
            });
            return $value;
        }
        return false;
    }

    public function redSquare(Request $request)
    {
        return view('designer.redsquare');
    }

    public function redSelected(Request $request)
    {
        return view('designer.redselected');
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