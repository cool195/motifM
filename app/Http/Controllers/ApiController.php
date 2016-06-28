<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\support\Facades\Input;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use App\Services\Net;


abstract class ApiController extends Controller
{

    private $sessionId = "";
    /**
     * 接口地址数组
     *
     * @var array
     */
    protected $ApiUrl = [
        //接口名称
        'openapi_local' => 'http://192.168.0.230',//本地
        'openapi_test' => 'http://192.168.0.230',//预发布
        'openapi' => 'http://54.222.233.255',//生产
    ];

    public function __construct()
    {
        if (Cache::has('frontend')) {
            $this->sessionId = Cache::get('frontend');
        } else {
            $this->sessionId = md5(time());
            $expiresAt = Carbon::now()->addMinutes(30);
            Cache::put('frontend', $this->sessionId, $expiresAt);
        }
    }

    protected function request($ApiName, $system, $service, array $params, $cacheTime = 0, $output = false)
    {
        $ApiName = $_SERVER['SERVER_NAME'] == 'm.motif.me' ? 'openapi' : ($_SERVER['SERVER_NAME'] == 'motif.app' ? 'openapi_local' : 'openapi_test');
        $buildParams = http_build_query($params);
        $key = md5($buildParams);
        $result = "";
        if ($cacheTime > 0 && Cache::has($key)) {
            $result = Cache::get($key);
        }
        if (empty($result) || "" == $result) {
            $result = Net::api($this->ApiUrl[$ApiName], $system, $service, $buildParams, ['Cookie:frontend=' . $this->sessionId]);
            if ($cacheTime > 0) {
                Cache::put($key, $result, $cacheTime);
            }
        }
        if ($output) {
            return response($result)->header('Content-Type', 'application/json');
        } else {
            return json_decode($result, true);
        }

    }

}
