<?php
require_once ROOT.'config/database.php';
class Setting {
    private $conn;
    public $phone;
    public $notif_day;
    public function __construct() {
        $this->conn = database::connect();
    }

    public function getSettings() {
        $conn=database::connect();
        $query=("SELECT * FROM settings LIMIT 1");
        return $conn->query($query);
    }
    public function updatePhone() {
        $result = $this->conn->query("UPDATE settings SET admin_phone ='$this->phone'");
        return $result;
    }
    public function updateNotifday() {
        $conn = database::connect();
        $result = $conn->query("UPDATE settings SET notif_day ='$this->notif_day'");
        return $result;
    }
}