<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ApiController;

class ProductController extends ApiController
{
    const API_SYSTEM = "";
    const API_SERVICE = "product";

    /*
     * 跳转至商品详情页面
     * @author zhangtao@evermarker.net
     * @params Request $request, int $spu
     * @return View
     *
     * */
    public function index(Request $request, $spu)
    {
        if (empty($spu)) {
            return redirect('/shopping');
        }
        $result = $this->getProductDetail($request, $spu);
        if (!$result['success']) {
            return redirect('/shopping');
        }
        $recommended = $this->recommended($spu,$result['data']['front_category_ids'][0],$result['data']['designer']['designer_id']);
        return View('shopping.detail', ['data' => $result['data'], 'recommended' => $recommended['data']]);
    }

    //获取相关推荐商品
    public function recommended($spu,$cid,$designerId)
    {
        $params = array(
            'recid' => '100002',
            'uuid' => $_COOKIE['uid'],
            'pagenum' => 1,
            'pagesize' => 20,
            'spu' => $spu,
            'extra_kv'=>!empty($designerId) ? $designerId : -1
        );
        $params['cid'] = isset($cid) ? $cid : -1;
        return $this->request('openapi', '', "rec", $params,0);
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
