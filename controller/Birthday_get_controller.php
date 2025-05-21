<?php
require_once ROOT.'model/Birthday.php';
require ROOT.'vendor/autoload.php';
require_once ROOT.'model/SendSms.php';
require_once ROOT.'config/database.php';
require_once ROOT.'model/Settings.php';
class Birthday_get_controller
{
    public function show_result()
    {
        //ساخت یه شی از کلاس کانتکت
        $show = new Birthday();
        $birthday_list = $show->get_closeset_birthday();
        include 'view/Home.php';
    }

    public function sendSMS()
    {
        $db = new database();
        $db->Loadenv(__DIR__ . '/../.env');
        $apikey = $_ENV['apiKey'] ?? '';

        $birthdayModel = new Birthday();
        $settingModel = new Setting();
        $sms = new SendSms();

        $config = $settingModel->getSettings();
        $row =$config->fetch_assoc();
        $adminPhone = $row['admin_phone'];

        $birthdayModel->days= $row['notif_day'];
        $birthdays = $birthdayModel->get_closeset_birthday_toSend();

        if ($birthdays && $birthdays->num_rows > 0) {
            while ($row = $birthdays->fetch_assoc()) {
                $name = str_replace(' ', '', $row['name']);
                $birthdayModel->send_id=$row['id'];
                $alreadySent = $birthdayModel->check_send();

                if ($alreadySent->num_rows > 0) {
                    $sent = $sms->sendMsgToUser($name, $adminPhone, $apikey);
                    if ($sent) {
                        $birthdayModel->update_status();
                    }
                }
            }
        }
    }

    public function deleteUser()
    {
        $del = new Birthday();

        $del->id = $_POST['id'];
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