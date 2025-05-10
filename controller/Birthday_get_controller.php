<?php
require_once 'model/Birthday.php';
require 'vendor/autoload.php';
require_once 'model/SendSms.php';


class Birthday_get_controller{
    public function show_result() {
        //ساخت یه شی از کلاس کانتکت
        $show = new Birthday();
        $birthday_list=$show->get_closeset_birthday();
        include 'view/Home.php';
    }
    public function sendSMS(){

        $send= new SendSms();
        $show = new Birthday();
        $birthday_list=$show->get_closeset_birthday_toSend();
        if (!empty($birthday_list) && $birthday_list->num_rows>0):{
            foreach ($birthday_list as $item):{
                $name = $item['name'];
                $send->sendMsgToUser($name);
            }endforeach;}
    endif;
        header('Location: home');
        exit();
    }
}