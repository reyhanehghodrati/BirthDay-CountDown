<?php
require_once 'config/database.php';
require_once 'php/jdf.php';

class Birthday
{
    public $name;
    public $birthday;
    public $about;
    public $mobile;

    function shamsi_to_miladi($date) {
        // Separate the Shamsi date components
        list($year, $month, $day) = explode('/', $date);

        // Convert Shamsi date to Miladi
        list($gy, $gm, $gd) = jalali_to_gregorian((int)$year, (int)$month, (int)$day);

        return sprintf('%04d-%02d-%02d', $gy, $gm, $gd);
    }
    function ValidDate($date) {
        $pattern = '/^(۱۳[۰-۹]{2}|۱۴[۰-۹]{2})\/-(۰[۱-۹]|۱[۰-۲])\/-(۰[۱-۹]|[۱۲][۰-۹]|۳[۰-۱])$/u';
        return preg_match($pattern, $date);
    }
    public function get_birthday()
    {
        $conn=database::connect();
        $query = "SELECT * FROM birthdays";
        $result = $conn->query($query);
        return $result;
    }
     public function set_birthday(){
         $conn=database::connect();
         $input_date=$this->birthday;
         $date_shamsi=$this->ValidDate($input_date);
         $miladi_date=$this->shamsi_to_miladi($date_shamsi);

         $sql = "INSERT INTO birthdays (name,mobile,birthday,about)VALUES ('$this->name','$this->mobile','$this->birthday','$this->about')";
         if ($conn->query($sql) === TRUE) {
             return true;
         } else {
             return false;
         }

     }


     public function get_closeset_birthday(){

         $conn = database::connect();

         $today = date('m-d');
         $end = date('m-d', strtotime('+30 days'));

         $query = "SELECT *, 
                DATEDIFF(STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', DATE_FORMAT(birthday, '%m-%d')), '%Y-%m-%d'), CURDATE()) AS days_left
                FROM birthdays
                HAVING days_left BETWEEN 0 AND 30
                ORDER BY days_left ASC";

         return $conn->query($query);
     }
    public function get_closeset_birthday_toSend(){

        $conn = database::connect();

        $today = date('m-d');
        $end = date('m-d', strtotime('+10 days'));

        $query = "SELECT *, 
                DATEDIFF(STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', DATE_FORMAT(birthday, '%m-%d')), '%Y-%m-%d'), CURDATE()) AS days_left
                FROM birthdays
                HAVING days_left BETWEEN 0 AND 10
                ORDER BY days_left ASC";

        return $conn->query($query);
    }
   }