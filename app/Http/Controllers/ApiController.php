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
        'openapi' => 'http://192.168.0.230/',
        //分类列表
        'Category' => 'http://192.168.0.230/product?cmd=categorylist&token=1001'
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

        $buildParams = http_build_query($params);
		$key = md5($buildParams);
        $result = "";
        if ($cacheTime > 0 && Cache::has($key)) {
            $result = Cache::get($key);
        } 
		if(empty($result) || "" == $result ) {
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
