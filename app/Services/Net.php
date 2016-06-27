<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;

class Net
{
    public static function api($apiName, $system, $service, $params, array $headers = [])
    {
        $api = "";
        $api .= $apiName;
        if (!empty($system) && "" != $system) {
            $api .= "/" . $system;
        }
        if (!empty($service) && "" != $service) {
            $api .= "/" . $service . "?";
        }
        $opt_timeout = 10000;
        $con_timeout = 10000;
        $result = self::getContent($api, $params, $opt_timeout, $con_timeout);
        return $result;
    }

    public static function getContent($api, $parameter = "", $total_timeout = 10000, $con_timeout = 0, $max_failed = 3, $headers = [])
    {
        if ($total_timeout <= 0) {
            $total_timeout = 10000;
        }
        if ($con_timeout <= 0) {
            $con_timeout = 10000;
        }
        if ($max_failed < 1) {
            $max_failed = 3;
        }
        $urlIndex = 0;
        $content = "";
        while ($urlIndex < $max_failed) {
            $url = $api . $parameter;
            $ch = curl_init($url);
            Log::info($url);
            $opt = array(
                CURLOPT_USERAGENT => 'jason curl lib',
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                #CURLOPT_FOLLOWLOCATION => true,
            );
            if (defined('CURLOPT_TIMEOUT_MS')) {
                $opt[CURLOPT_NOSIGNAL] = true;
                $opt[CURLOPT_TIMEOUT_MS] = $total_timeout;
                $opt[CURLOPT_CONNECTTIMEOUT_MS] = $con_timeout;
            } else {
                $opt[CURLOPT_TIMEOUT] = ceil($total_timeout / 1000);
                $opt[CURLOPT_CONNECTTIMEOUT] = ceil($con_timeout / 1000);
            }
            if ($headers) {
                $opt[CURLOPT_HTTPHEADER] = $headers;
            }
            curl_setopt_array($ch, $opt);
            $content = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlCode = curl_errno($ch);
            if ($curlCode == 0 && $httpCode == 200) {
                curl_close($ch);
                break;
            } else {
                $urlIndex++;
            }
            curl_close($ch);
        }
        return $content;
    }
}
