<?php

namespace App\Services;

use App\Services\Net;
use Log;

class Publicfun
{
    /**
     * 接口地址数组
     *
     * @var array
     */
    const ApiUrl = [
        'openapi_local' => array('api' => 'http://192.168.0.230', 'rec' => 'http://192.168.0.230'),//本地
        'openapi_test' => array('api' => 'http://54.222.233.255', 'rec' => 'http://54.222.233.255'),//预发布
        'openapi' => array('api' => 'https://api.motif.me', 'rec' => 'https://rec.motif.me'),//生产
    ];

    //收藏商品操作
    public static function addWishProduct($spu, $pin, $token, $action = false)
    {
        Log::info($spu.$pin.$token);
        if ($action) {
            $params = array(
                'cmd' => 'is',
                'spu' => $spu,
                'pin' => $pin,
                'token' => $token,
            );
            $result = self::request('openapi', '', 'wishlist', $params);
            $cmd = $result['data']['isFC'] ? 'del' : 'add';
        } else {
            $cmd = 'add';
        }

        $params = array(
            'cmd' => $cmd,
            'spu' => $spu,
            'pin' => $pin,
            'token' => $token,
        );
        $result = self::request('openapi', '', 'wishlist', $params);
        $result['cmd'] = $cmd == 'add' ? true : false;
        return $result;
    }

    //接口服务
    public static function request($system, $service, array $params, $cacheTime = 0)
    {
        $ApiName = $_SERVER['SERVER_NAME'] == 'm.motif.me' ? 'openapi' : ($_SERVER['SERVER_NAME'] == 'test.m.motif.me' ? 'openapi_test' : 'openapi_local');
        $Api = $service == 'rec' ? self::ApiUrl[$ApiName]['rec'] : self::ApiUrl[$ApiName]['api'];
        $buildParams = http_build_query($params);
        $key = md5($buildParams);
        $result = "";
        if ($cacheTime > 0 && Cache::has($key)) {
            $result = Cache::get($key);
        }
        if (empty($result) || "" == $result) {
            $result = Net::api($Api, $system, $service, $buildParams);
            if ($cacheTime > 0) {
                Cache::put($key, $result, $cacheTime);
            }
        }
        return json_decode($result, true);
    }
}
