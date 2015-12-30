<?php
namespace common\classes\urlcutter;

class GoogleUrlShortener
{
    private $apiKey = 'AIzaSyDZ3zXQsa8dT8GsJtybakH_Wj01Wm-3OxE';

    public function shorten($url)
    {
        $postData = ['longUrl' => $url, 'key' => $this->apiKey];
        $jsonData = json_encode($postData);
        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key='.$this->apiKey);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
        $response = curl_exec($curlObj);
        $json = json_decode($response);
        curl_close($curlObj);
        return $json->id;
    }
}
