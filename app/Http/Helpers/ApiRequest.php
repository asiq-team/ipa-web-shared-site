<?php
namespace App\Http\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ApiRequest {
    public static function Get($key, $server, $uri, $timeout = 15.0, $ttl = 2 * 60){
        $client = new Client([
            'base_uri' => env($server,null),
            'timeout'  => $timeout
        ]);

        try {
            $body = Cache::remember($key, $ttl, function () use ($client,$uri) {
                $response = $client->request('GET', $uri);
                return  (string)$response->getBody();
            });

            $dataresp=array();
            if($body != null){
                $obj = json_decode($body);
                if(!$obj->success)
                    return null;

                if($obj->data)
                    $dataresp=$obj->data;
            }

            return $dataresp;

        } catch (RequestException $e) {
            Log::warning($e->getMessage());
            return null;
        } catch (ConnectException $e) {
            Log::warning($e->getMessage());
            return null;
        }
    }
}