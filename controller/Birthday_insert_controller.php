<?php
require_once ROOT.'model/Birthday.php';
require_once ROOT.'model/Settings.php';


class Birthday_insert_controller{



    public function show_result() {
            //ساخت یه شی از کلاس کانتکت
            $show = new Birthday();
            $settongs = new Setting();

            $result=$show->get_birthday();
            $setting_r=$settongs->getSettings();

            include 'view/Admin_dashboard.php';
//        header("Location:/BirthDay-CountDown/Admin_dashboard");

    }
    public function sms_status(){
        $set=new Birthday();
        $set->send_id=$_SESSION['send_id'];
        $set->check_send();
        exit();

    }
    public function set_result()
    {
//        $captcha = $_POST['captcha_input'] ?? '';
//        if ($_POST['captcha_input'] === $_SESSION['captcha']) {
//            if (!isset($_POST["token"]) || !isset($_SESSION["token"])) {
//                exit("token not set");
//            }
////check token:
//            if ($_POST["token"] == $_SESSION["token"]) {
//                if (time() >= $_SESSION["token-expire"]) {
//                    unset($_SESSION["token"]);
//                    unset($_SESSION["token-expire"]);
//                    exit("token expire.reload the form");
//                }
                $set = new Birthday();
                if (isset($_POST['name'], $_POST['mobile'], $_POST['birthday'], $_POST['about'])) {
                    $set->name = $_POST['name'];
                    $set->mobile = $_POST['mobile'];
                    $set->birthday = $_POST['birthday'];
                    $set->about = $_POST['about'];
                }

                if ($set->set_birthday()) {
                    $_SESSION['message'] = '<div style="padding: 10px; background-color: #fafafa; color: #37ff00; border: 1px solid #37ff00; border-radius: 5px;">ثبت شد</div>';
                    header('Location: Admin-dashboard');
                    exit();

                } else {
                    $_SESSION['message'] = '<div style="padding: 10px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px;">تاریخ ورودی معتبر نیست</div>';
                    header('Location: Admin-dashboard');
                    exit();
                }
                exit;
            }
//        }
//    }
}



