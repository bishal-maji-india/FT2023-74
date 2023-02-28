<?php
class Helper{
    public $base_url='https://ir-dev-d9.innoraft-sites.com/';

    function makeGetRequest($url){
        $curlObj = curl_init();
        curl_setopt_array($curlObj, array(
          CURLOPT_URL => $url ,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
          ),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_FOLLOWLOCATION => true,
        ));

        $response = curl_exec($curlObj);
        curl_close($curlObj);
        $decoded_result = json_decode($response, true);
        return $decoded_result['data'];
    }
}
?>