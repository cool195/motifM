<?php
namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ShoppingController extends ApiController
{
    public function index(Request $request,$id)
    {
        $params = array(
            'cmd' => 'list',
        );
        $search = $this->request('openapi', '', 'sea', $params);

        $result = $this->getShoppingCategoryList($request);
        $selectCid = $request->get('cid', $id);
        return View('shopping.list', ['selectCid' => $selectCid, 'categories' => $result['data']['list'], 'search' => $search['data'], 'NavShowShop' => true]);
    }

    public function getShoppingCategoryList(Request $request)
    {
        $params = array(
            'cmd' => 'categorylist',
        );
        $system = "";
        $service = "product";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result['success'])) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data']['list'] = array();
        }
        return $result;
    }

    //todo
    public function getShoppingProductList(Request $request)
    {
        $params = array(
            'token' => Session::get('user.token'),
            'pin' => Session::get('user.pin'),
            'recid' => $request->input('recid', '100000'),
            'uuid' => $_COOKIE['uid'],
            'cid' => $request->input('cid', '0'),
            'pagenum' => $request->input('pagenum', 1),
            'pagesize' => $request->input('pagesize', 5),
            'extra_kv' => $request->input('extra_kv', "")
        );
        $data = $this->request('openapi', "", "rec", $params);
        $result = $this->getListWishedStatus($data);
        return $result;
    }

    private function getListWishedStatus(Array $result)
    {
        if (!empty($result['data']['list'])) {
            $wishlist = $this->wishlist();
            $list = array();
            foreach ($result['data']['list'] as $value) {
                $value['isWished'] = 0;
                if (in_array($value['spu'], $wishlist)) {
                    $value['isWished'] = 1;
                }
                $list[] = $value;
            }
            $result['data']['list'] = $list;
        }
        return $result;
    }

    public function checkStock(Request $request)
    {
        $params = array(
            'cmd' => 'checkstock',
            'skus' => $request->input('skus')
        );
        $system = "";
        $service = "stock";
        $result = $this->request('openapi', $system, $service, $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data']['list'] = array();
        }
        return $result;
    }

    public function feedback(Request $request)
    {
        $customerSupportIndex = 3;
        $result = $this->getFeedbackList($request);
        $this->putRefererInSession();
        return View('Other.customersupport', ['customers' => $result['data']['list'][$customerSupportIndex]]);
    }

    private function putRefererInSession()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            if (empty($_SERVER['PHP_SELF']) || $_SERVER['PHP_SELF'] !== $_SERVER['HTTP_REFERER']) {
                $referer = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "/shopping";
                Session::put('referer', $referer);
            }
        }
    }

    public function getFeedbackList(Request $request)
    {
        $params = array(
            'cmd' => 'list',
            'pin' => Session::get('user.pin'),
            'token' => Session::get('user.token'),
        );
        if ($request->has('type')) {
            $params['type'] = $request->input('type');
        }
        $result = $this->request('openapi', '', 'feedback', $params);
        if (!empty($result) && $result['success']) {
            if (!empty($result['data']['list'])) {
                $lists = array();
                foreach ($result['data']['list'] as $list) {
                    $lists[$list['feedback_type']] = $list;
                }
                $result['data']['list'] = $lists;
            }
        }
        return $result;
    }

    public function addSupport(Request $request)
    {
        $type = $request->input('type');
        $params = array(
            'cmd' => "support",
            //todo 转码?'content' => mb_convert_encoding($request->input('content'), "GBK","UTF-8"),
            'content' => $request->input('content'),
            'email' => $request->input('email'),
            'type' => $type,
            'stype' => $request->input('stype'),
        );
        if (1 == $type) {
            $params['spu'] = $request->input('spu');
        } elseif (2 == $type) {
            $params['orderno'] = $request->input('orderno');
        }
        $result = $this->request('openapi', '', 'feedback', $params);
        if (empty($result)) {
            $result['success'] = false;
            $result['error_msg'] = "Data access failed";
            $result['data']['list'] = array();
        } else {
            if ($result['success']) {
                $result['redirectUrl'] = Session::has('referer') ? Session::get('referer') : "/shopping";
                Session::forget('referer');
            }
        }
        return $result;
    }

    public function guide()
    {
        $referer = strstr($_SERVER['HTTP_REFERER'], 'http://motif') ? false : $_SERVER['HTTP_REFERER'];
        return view('shopping.pcguide', ['referer' => $referer]);
    }

    //Wishlist Start
    public function wish(Request $request)
    {
        $params = array(
            'cmd' => 'list',
            'num' => $request->input('num', 1),
            'size' => $request->input('size', 20),
            'pin' => Session::get('user.pin'),
            'token' => Session::get('user.token')
        );
        $result = $this->request('openapi', '', 'wishlist', $params);
        if ($request->input('ajax')) {
            return $result;
        }
        return view('Other.wishlist', ['data' => $result['data']]);
    }

    public function wishlist()
    {
        if (Session::get('user.pin')) {

            $value = Cache::remember(Session::get('user.pin') . 'wishlist',600, function () {
                $params = array(
                    'cmd' => 'list',
                    'num' => 1,
                    'size' => 500,
                    'pin' => Session::get('user.pin'),
                    'token' => Session::get('user.token')
                );
                $result = $this->request('openapi', '', 'wishlist', $params);
                $result['cacheList'] = array();
                if ($result['success'] && $result['data']['amount'] > 0) {
                    foreach ($result['data']['list'] as $value) {
                        $result['cacheList'][] = $value['spu'];
                    }
                }
                return $result['cacheList'];
            });
            return $value;
        }
        return array();
    }

    public function updateWish(Request $request)
    {
        $params = array(
            'cmd' => $this->isWished($request) ? 'del' : 'add',
            'spu' => $request->input('spu'),
            'pin' => Session::get('user.pin'),
            'token' => Session::get('user.token')
        );
        $result = $this->request('openapi', '', 'wishlist', $params);
        if ($result['success']) {
            Cache::forget(Session::get('user.pin') . 'wishlist');
        }
        return $result;
    }

    public function isWished(Request $request)
    {
        $params = array(
            'cmd' => 'is',
            'pin' => Session::get('user.pin'),
            'token' => Session::get('user.token'),
            'spu' => $request->input('spu')
        );
        $result = $this->request('openapi', '', 'wishlist', $params);
        return $result['data']['isFC'];
    }

    //Wishlist End


}
