<?php

namespace App\Services;


use GuzzleHttp\Client;
use Illuminate\Http\Client\Response;
use GuzzleHttp\Exception\ClientException;

class GuzzleService {

    public static function handle($requestUrl, $formParams = [])  {

        try{
            $http= new Client();

            return $http->request('POST', $requestUrl, [
                'headers' => [
                    'cache-control' => 'no-cache',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => $formParams
            ]);
        }catch (ClientException $exception){
            return $exception->getMessage();
        }
    }


}
