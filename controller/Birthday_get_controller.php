<?php
require_once 'model/Birthday.php';

class Birthday_get_controller{
    public function show_result() {
        //ساخت یه شی از کلاس کانتکت
        $show = new Birthday();
        $birthday_list=$show->get_closeset_birthday();
        include 'view/Home.php';
    }

}