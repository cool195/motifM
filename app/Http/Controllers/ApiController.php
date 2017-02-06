<?php

namespace App\Http\Controllers;

use App\Services\Net;
use Cache;
use Illuminate\Support\Facades\Session;

error_reporting(0);

class ApiController extends Controller
{
    /**
     * 接口地址数组
     *
     * @var array
     */
    protected $ApiUrl = [
        'openapi_local' => array('api' => 'http://192.168.0.230', 'rec' => 'http://192.168.0.230'),//本地
        'openapi_test' => array('api' => 'http://54.222.233.255', 'rec' => 'http://54.222.233.255'),//预发布
        'openapi' => array('api' => 'https://api.motif.me', 'rec' => 'https://rec.motif.me'),//生产
    ];

    function __construct()
    {
/*        if(Session::has('user')){
            if(!Cache::has(Session::get('user.token'))){
                Session::forget('user');
            }
        }*/
    }

    protected function request($ApiName, $system, $service, array $params)
    {
        $params['src'] = 'h5';
        $ApiName = $_SERVER['SERVER_NAME'] == 'm.motif.me' ? 'openapi' : ($_SERVER['SERVER_NAME'] == 'test.m.motif.me' ? 'openapi_test' : 'openapi_local');
        $Api = $service == 'rec' ? $this->ApiUrl[$ApiName]['rec'] : $this->ApiUrl[$ApiName]['api'];
        $buildParams = http_build_query($params);
        $result = Net::api($Api, $system, $service, $buildParams);
        return json_decode($result, true);
    }

}
