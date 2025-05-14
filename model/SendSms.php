<?php


use http\Env\Response;

require_once 'config/database.php';
class SendSms

{



    public array $param = array(
        "adminTemplate" => "teamsbirthday",
        "userTemplate" => "teamsbirthday",
        "adminPhoneNumber" => "09109253995",
    );
    function sendMsgToUser($name,$apikey,$phone){

        $phone = $this->param['adminPhoneNumber'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.kavenegar.com/v1/'.$apikey.'/verify/lookup.json?receptor='.$phone.'&token='.$name.'&template='.$this->param['userTemplate'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
    }
}
