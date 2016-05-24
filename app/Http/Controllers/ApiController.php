<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        'Hot' => 'http://54.222.146.28',
        //分类列表
        'Category' => 'http://54.222.146.28/product/product?cmd=categorylist&token=1001'
    ];

    public function __construct()
    {

        if (Cache::has('frontend')) {
            $this->sessionId = Cache::get('frontend');
        } else {
            $this->sessionId = md5(mt_rand());
            $expiresAt = Carbon::now()->addMinutes(30);
            Cache::add('frontend', $this->sessionId, $expiresAt);
        }
    }

    protected function request($ApiName, $system, $service, array $params, $cacheTime = 0, $output = false)
    {
        $buildParams = http_build_query($params);
        $result = "";
        if ($cacheTime > 0 && Cache::has($buildParams)) {
            $result = Cache::get($buildParams);
        } else {
            $result = Net::api($this->ApiUrl[$ApiName], $system, $service, $buildParams, ['Cookie:frontend=' . $this->sessionId]);
            if ($cacheTime > 0) {
                Cache::put($buildParams, $result, $cacheTime);
            }
        }
        if ($output) {
            return response($result)->header('Content-Type', 'application/json');
        } else {
            return json_decode($result, true);
        }

    }

}
