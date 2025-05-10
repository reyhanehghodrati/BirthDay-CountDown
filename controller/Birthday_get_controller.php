<?php
require_once 'model/Birthday.php';
require 'vendor/autoload.php';
require_once 'model/SendSms.php';
require_once 'config/database.php';

class Birthday_get_controller{
    public function show_result() {
        //ساخت یه شی از کلاس کانتکت
        $show = new Birthday();
        $birthday_list=$show->get_closeset_birthday();
        include 'view/Home.php';
    }
    public function sendSMS(){

        $apikey=new database();
        $apikey->Loadenv(__DIR__ . '/../.env');
        $apikey = $_ENV['apiKey'] ?? '';

        $phone='';

        $send= new SendSms();

        $show = new Birthday();

        $birthday_list=$show->get_closeset_birthday_toSend();
        if (!empty($birthday_list) && $birthday_list->num_rows>0):{
            foreach ($birthday_list as $item):{
                $name = str_replace(' ', '',$item['name']);
                $send->sendMsgToUser($name,$apikey,$phone);
            }endforeach;}
    endif;
        header('Location: home');
        exit();
    }
    public function deleteUser(){
        $del= new Birthday();

        $del->id= $_POST['id'];
        if ($del->delete_selected_birthday()) {
            $_SESSION['message'] = '<div style="padding: 10px; background-color: #fafafa; color: #37ff00; border: 1px solid #37ff00; border-radius: 5px;">حذف شد</div>';
            header('Location: Admin-dashboard');
            exit();

        } else {
            $_SESSION['message'] = '<div style="padding: 10px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px;">عملیات ناموفق</div>';
            header('Location: Admin-dashboard');
            exit();
        }
    }
}