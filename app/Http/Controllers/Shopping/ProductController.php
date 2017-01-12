<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Cache;

class ProductController extends ApiController
{
    const API_SYSTEM = "";
    const API_SERVICE = "product";


    //seo商品详情302永久重定向
    /*public function detail(Request $request, $spu)
    {
        $result = $this->getProductDetail($request, $spu);
        if ($request->input('ajax')) {
            return $result;
        }
        $url = "/detail/".$spu."/".$result['data']['main_title'];
        return redirect($url);
    }*/


    /*
     * 跳转至商品详情页面
     * @author zhangtao@evermarker.net
     * @params Request $request, int $spu
     * @return View
     *
     * */
    public function index(Request $request, $spuTitle)
    {
        $spu = "";
        $result = array();
        if(is_numeric($spuTitle)){
            $result = $this->getProductDetail($request, $spuTitle);
            if ($request->input('ajax')) {
                return $result;
            }
            $params = $request->all();
            $url = "/detail/".$result['data']['seo_link'];
            if(!empty($params)){
                $url = "/detail/".$result['data']['seo_link']."?".http_build_query($params);
            }
            return redirect($url);
        }else{
            $titleArray = explode("-", $spuTitle);
            end($titleArray);
            $spu = current($titleArray);
            $result = $this->getProductDetail($request, $spu);
            if($spuTitle !== $result['data']['seo_link']){
                $params = $request->all();
                $url = "/detail/".$result['data']['seo_link'];
                if(!empty($params)){
                    $url = "/detail/".$result['data']['seo_link']."?".http_build_query($params);
                }
                return redirect($url);
            }
        }

        if(!$result['success']){
            abort(404);
        } else {
            $category = Cache::remember('category', 60, function () {
                $params = array(
                    'cmd' => 'categorylist',
                );
                return $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params);
            });
            $categoryName = '';
            foreach ($category['data']['list'] as $value) {
                if ($value['category_id'] == $result['data']['front_category_ids'][0]) {
                    $categoryName = $value['category_name'];
                    $result['data']['category_id'] = $result['data']['front_category_ids'][0];
                    break;
                }
            }
            $result['data']['category_name'] = $categoryName;
        }
        if ($request->input('ajax')){
            return $result;
        }

        $recommended = $this->recommended($spu,$result['data']['front_category_ids'][0],$result['data']['designer']['designer_id']);
        return View('shopping.detail', ['data' => $result['data'], 'recommended' => $recommended['data'],'NavShowShop'=>true]);
    }

    //获取相关推荐商品
    public function recommended($spu,$cid,$designerId)
    {
        $params = array(
            'recid' => '100012',
            'uuid' => $_COOKIE['uid'],
            'pagenum' => 1,
            'pagesize' => 8,
            'spu' => $spu,
            'extra_kv'=>!empty($designerId) ? "designerId:".$designerId : "designerId:-1"
        );
        $params['cid'] = isset($cid) ? $cid : -1;
        $result = $this->request('openapi', '', "rec", $params,0);
        if($result['success']){
            foreach($result['data']['list'] as &$product){
                $titleArray = explode(" ", $product['main_title']);
                $titleArray[] = $product['spu'];
                $product['seo_link'] = implode("-", $titleArray);
            }
        }
        return $result;
    }

    /*
     * 获取商品详情信息
     * @author zhangtao@evermarker.net
     * @params Request $request , int $spu
     * @return Array
     *
     * */
    public function getProductDetail(Request $request, $spu)
    {
        $params = array(
            'cmd' => 'productdetail',
            'spu' => $spu,
        );
        $result = $this->request('openapi', self::API_SYSTEM, self::API_SERVICE, $params,0);
        if (empty($result)) {
            $result['success'] = false;
            $result['data'] = array();
            $result['error_msg'] = "Data access failed";
        } else {
            if (isset($result['data']['spuAttrs'])) {
                $result['data']['spuAttrs'] = $this->getSpuAttrsStockStatus($result['data']['spuAttrs'], $result['data']['skuExps']);
            }
            $result['data']['sale_status'] = true;
            if(1 == $result['data']['sale_type']){
                Session::put('referer', "/detail/$spu");
                $result['data']['sale_status'] = $this->getSaleStatus($result['data']);
            }

            $titleArray = explode(" ", $result['data']['main_title']);
            $titleArray[] = $result['data']['spu'];
            $result['data']['seo_link'] = implode("-", $titleArray);
        }
        return $result;
    }

    private function getSaleStatus(Array $data)
    {
        $flag = true;
        if(1 == $data['sale_type'] && !isset($data['skuPrice']['skuPromotion']))
        {
            $flag = false;
        }
        elseif(!empty($data['spuStock']) && $data['spuStock']['stock_qtty'] == $data['spuStock']['saled_qtty'] )
        {
            $flag = false;
        }
        elseif(0 == $data['skuPrice']['skuPromotion']['remain_time'])
        {
            $flag = false;
        }else{

        }
        return $flag;
    }

    private function getSpuAttrsStockStatus(Array $spuAttrs, Array $skuExps)
    {
        $spuAttrsCopy = array();
        foreach ($spuAttrs as $spuAttr) {
            $skuAttrsValues = array();
            foreach ($spuAttr['skuAttrValues'] as $skuAttrValue) {
                $skuAttrValue['stock'] = $this->getSkuStockStatus($skuAttrValue['skus'], $skuExps);
                $skuAttrsValues[] = $skuAttrValue;
            }
            $spuAttr['skuAttrValues'] = $skuAttrsValues;
            $spuAttrsCopy[] = $spuAttr;
        }
        return $spuAttrsCopy;
    }

    private function getSkuStockStatus($skus, $skuExps)
    {
        $flag = false;
        foreach ($skus as $sku) {
            foreach ($skuExps as $skuExp) {
                if ($sku == $skuExp['sku']) {
                    if ($skuExp['stock_qtty'] > 0) {
                        $flag = true;
                        break;
                    }
                }
            }
        }
        return $flag;
    }

    //收藏操作
    public function wishProduct($id){
        $params = array(
            'cmd' => 'is',
            'spu' => $id,
            'pin' => Session::get('user.pin'),
            'token' => Session::get('user.token'),
        );
        $result = $this->request('openapi', self::API_SYSTEM, 'wishlist', $params);
        $cmd = $result['data']['isFC'] ? 'del' : 'add';
        $params = array(
            'cmd' => $cmd,
            'spu' => $id,
            'pin' => Session::get('user.pin'),
            'token' => Session::get('user.token'),
        );
        $result = $this->request('openapi', self::API_SYSTEM, 'wishlist', $params);
        $result['cmd'] = $cmd == 'add' ? true : false;
        return $result;
    }


}
