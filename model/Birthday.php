<?php
require_once 'config/database.php';
require_once 'php/jdf.php';

class Birthday
{
    public string $name;
    public $birthday;
    public string $about;
    public int $mobile;
    public int $id;
    public int $send_id;
    public $days;

    function shamsi_to_miladi($date) {
        list($year, $month, $day) = explode('/', $date);
        list($gy, $gm, $gd) = jalali_to_gregorian((int)$year, (int)$month, (int)$day);
        return sprintf('%04d-%02d-%02d', $gy, $gm, $gd);
    }




    private function fa_to_en($string) {
        $farsi = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        $latin = ['0','1','2','3','4','5','6','7','8','9'];
        return str_replace($farsi, $latin, $string);
    }




    private function ValidDate($date) {
        $pattern = '/^(13[0-9]{2}|14[0-9]{2})\/(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])$/';
        return preg_match($pattern, $date);
    }




    public function get_birthday()
    {
        $conn=database::connect();
        $query = "SELECT * FROM birthdays";
        return $conn->query($query);
    }




    public function set_birthday() {
        $conn = database::connect();
        $input_date = $this->fa_to_en($this->birthday);

        if (!$this->ValidDate($input_date)) {
            return false;
        }
        $miladi_date = $this->shamsi_to_miladi($input_date);
        $sql = "INSERT INTO birthdays (name, mobile, birthday, about)
                VALUES ('$this->name', '$this->mobile', '$miladi_date', '$this->about')";

        return $conn->query($sql) === TRUE;
    }




     public function get_closeset_birthday(){

         $conn = database::connect();
         $query = "SELECT *, 
                DATEDIFF(STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', DATE_FORMAT(birthday, '%m-%d')), '%Y-%m-%d'), CURDATE()) AS days_left
                FROM birthdays
                HAVING days_left BETWEEN 0 AND 30
                ORDER BY days_left ASC";

         return $conn->query($query);
     }




    public function get_closeset_birthday_toSend(){
        $conn = database::connect();
    $query = "SELECT *, 
            DATEDIFF(
                STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', DATE_FORMAT(birthday, '%m-%d')), '%Y-%m-%d'),
                CURDATE()
            ) AS days_left
            FROM birthdays
            HAVING days_left BETWEEN 0 AND ?
            ORDER BY days_left ASC";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $this->days);
    $stmt->execute();
    return $stmt->get_result();
    }

    public function check_send(){
        $conn = database::connect();

        $query = "SELECT * 
          FROM birthdays 
          WHERE (sms_status = 0 AND id = '$this->send_id') 
          OR (id = '$this->send_id' AND sms_send_at <= DATE_SUB(NOW(), INTERVAL 1 YEAR))";



        return $conn->query($query);
    }
    public function update_status(){
        $conn = database::connect();

        $query = "UPDATE birthdays
                SET sms_status = sms_status+1
                WHERE id = '$this->send_id'";

        return $conn->query($query);
    }
    public function delete_selected_birthday(){
        $conn = database::connect();
        $query = "DELETE FROM birthdays WHERE id = '$this->id'";


        return $conn->query($query);
    }




   }