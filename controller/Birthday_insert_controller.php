<?php
require_once 'model/Birthday.php';


class Birthday_insert_controller{



    public function show_result() {
            //ساخت یه شی از کلاس کانتکت
            $show = new Birthday();
            $result=$show->get_birthday();
            include 'view/Admin_dashboard.php';
    }
    public function set_result(){
        $set= new Birthday();

        $set->name=$_POST['name'];
        $set->mobile=$_POST['mobile'];
        $set->birthday=$_POST['birthday'];
        $set->about=$_POST['about'];


        if ($set->set_birthday()) {
            $_SESSION['message'] ="<span style='color: green;'>ثبت شد</span>";
        } else {
            $_SESSION['message'] ="<span style='color: red;'>خطا در ثبت: </span>";
        }
        exit;
    }
}



