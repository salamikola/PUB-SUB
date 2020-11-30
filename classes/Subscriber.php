<?php
namespace App;

use Contract\SubscriberContract;

class Subscriber implements SubscriberContract {

    public function listen($data,$event){

        $post_data = array('message' => $data);
        $payload = json_encode($post_data);
        $url = 'http://pub-sub.test/publish.php?topic='.$event.'';
        $cURLConnection = curl_init($url);
        curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        $apiResponse = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        var_dump($apiResponse);
    }
}