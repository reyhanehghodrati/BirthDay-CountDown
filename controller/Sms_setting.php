<?php
require_once ROOT.'model/Settings.php';
class Sms_setting{


    public function showSettings() {
        $settongs = new Setting();
        $setting_r=$settongs->getSettings();

        include'view/Admin_dashboard.php';
    }



    public function update_notifday(){
        $notifday = $_POST['notif_day'];
        $update = new Setting();
        $update->notif_day = $notifday;
        if ($update->updateNotifday()) {
            $_SESSION['message'] = '<div style="padding: 10px; background-color: #fafafa; color: #37ff00; border: 1px solid #37ff00; border-radius: 5px;">بروز شد</div>';
            header("Location: /Admin-dashboard");
            exit;
        }
        else {
            $_SESSION['message'] = '<div style="padding: 10px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px;">عملیات ناموفق</div>';
            header('Location: Admin-dashboard');
            exit();
        }
    }
    public function update_phone(){
        $phone = $_POST['admin-num'];
        $update = new Setting();
        $update->phone = $phone;
        if ($update->updatePhone()) {
            $_SESSION['message'] = '<div style="padding: 10px; background-color: #fafafa; color: #37ff00; border: 1px solid #37ff00; border-radius: 5px;">بروز شد</div>';
            header("Location: /Admin-dashboard");
            exit;
        }
        else {
            $_SESSION['message'] = '<div style="padding: 10px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px;">عملیات ناموفق</div>';
            header('Location: Admin-dashboard');
            exit();
        }
    }
}
