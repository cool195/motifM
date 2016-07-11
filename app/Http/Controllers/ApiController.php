<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Services\Net;

error_reporting(0);

abstract class ApiController extends Controller
{
    /**
     * 接口地址数组
     *
     * @var array
     */
    protected $ApiUrl = [
        'openapi_local' => array('api' => 'http://192.168.0.230', 'rec' => 'http://192.168.0.230'),//本地
        'openapi_test' => array('api' => 'http://54.222.233.255', 'rec' => 'http://54.222.233.255'),//预发布
        'openapi' => array('api' => 'http://api.motif.me', 'rec' => 'http://rec.motif.me'),//生产
    ];

    protected function request($ApiName, $system, $service, array $params, $cacheTime = 0)
    {

        $ApiName = $_SERVER['SERVER_NAME'] == 'm.motif.me' ? 'openapi' : ($_SERVER['SERVER_NAME'] == 'test.m.motif.me' ? 'openapi_test' : 'openapi_local');
        $Api = $service == 'rec' ? $this->ApiUrl[$ApiName]['rec'] : $this->ApiUrl[$ApiName]['api'];
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
