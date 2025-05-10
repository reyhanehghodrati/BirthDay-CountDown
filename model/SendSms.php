<?php

//namespace Sms;

use http\Env\Response;

class SendSms

{
    public array $param = array(
        "adminTemplate" => "teamsbirthday",
        "userTemplate" => "teamsbirthday",
        "adminPhoneNumber" => "09109253995",
        "apiKey" => "723454473278747443444E65453776625A6A706A59773167416E3768724F4336"
    );
    function sendMsgToUser($name){
        $phone = $this->param['adminPhoneNumber'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.kavenegar.com/v1/'.$this->param['apiKey'].'/verify/lookup.json?receptor='.$phone.'&token='.$name.'&template='.$this->param['userTemplate'],
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
