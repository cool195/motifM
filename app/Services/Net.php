<?php
namespace App\Services;

//use Illuminate\Support\Facades\Log;

class Net
{
    const TimeOut = 15000;

    public static function api($apiName, $system, $service, $params)
    {
        $api = "";
        $api .= $apiName;
        if (!empty($system) && "" != $system) {
            $api .= "/" . $system;
        }
        if (!empty($service) && "" != $service) {
            $api .= "/" . $service . "?";
        }
        $result = self::getContent($api, $params, self::TimeOut, self::TimeOut);
        return $result;
    }

    public static function getContent($api, $parameter = "", $total_timeout, $con_timeout)
    {

        $url = $api . $parameter;
        $ch = curl_init($url);
        //Log::info($url);
        $opt = array(
            CURLOPT_USERAGENT => 'jason curl lib',
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
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

        curl_setopt_array($ch, $opt);
        $content = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlCode = curl_errno($ch);
        if ($curlCode == 0 && $httpCode == 200) {
            curl_close($ch);
        }
        return $content;
    }
}
