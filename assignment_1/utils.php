<?php
require './vendor/autoload.php';
use GuzzleHttp\Client;
class Helper{
    public $base_url='https://ir-dev-d9.innoraft-sites.com/';

    //function to make api request using guzzle.
    function makeGetRequest($url){
      $client =new Client();
      $response = $client->request('GET', $url);
        $decoded_result = json_decode($response->getBody(), true);
        return $decoded_result['data'];
    }
}
