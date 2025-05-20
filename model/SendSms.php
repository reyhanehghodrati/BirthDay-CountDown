<?php


use http\Env\Response;

require_once 'config/database.php';
class SendSms
 {
    public function sendMsgToUser($name, $phone, $apikey) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.kavenegar.com/v1/'.$apikey.'/verify/lookup.json?receptor='.$phone.'&token='.$name.'&template=teamsbirthday',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        // اختیاری: بررسی پاسخ Kavenegar
        return true;
    }
}
