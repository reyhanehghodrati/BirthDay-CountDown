<?php
session_start();
include ROOT.'model/login.php';


class Login_controller{



    public function showForm(){
        require_once ROOT.'view/Login.php';
    }




    public function login_check() {

        $name = $_POST['username'];
        $password = $_POST['password'];
        if ($name && $password) {
            //ساخت یه شی از کلاس کانتکت
            $check = new Login();
            $check->username = $name;
            $check->password = $password;
            //-------
            if ($check->login()) {
                $_SESSION['username']=$name;
                header("Location: /Admin-dashboard");
                exit;
            } else {
                $_SESSION['message'] = "<span style='color: red;'>نام کاربری یا پسوورد اشتباه است  ;</span>";

            }
        } else {
            $_SESSION['message'] = "<span style='color: red;'>همه فیلدها الزامی هستند</span>";
        }
        header("Location: /login");
        exit;
    }
}



