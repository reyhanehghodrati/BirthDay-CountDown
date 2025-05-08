<?php
require_once 'model/Birthday.php';
require 'vendor/autoload.php';



class Birthday_get_controller{
    public function show_result() {
        //ساخت یه شی از کلاس کانتکت
        $show = new Birthday();
        $birthday_list=$show->get_closeset_birthday();
        include 'view/Home.php';
    }
    public function sendSMS(){
        $sender = "2000660110";
        $receptor = "09109253995";
        $message = "وب سرویس پیام کوتاه کاوه نگار";
        $api = new \Kavenegar\KavenegarApi("723454473278747443444E65453776625A6A706A59773167416E3768724F4336");
        $api -> Send ($sender,$receptor,$message);
    }
}