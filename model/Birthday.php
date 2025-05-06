<?php
require_once 'config/database.php';

class Birthday
{
    public $name;
    public $birthday;
    public $about;
    public $mobile;

    public function get_birthday()
    {
        $conn=database::connect();
        $query = "SELECT * FROM birthdays";
        $result = $conn->query($query);
        return $result;
    }
     public function set_birthday(){
         $conn=database::connect();

         $sql = "INSERT INTO birthdays (name,mobile,birthday,about)VALUES ('$this->name','$this->mobile','$this->birthday','$this->about')";
         if ($conn->query($sql) === TRUE) {
             return true;
         } else {
             return false;
         }
     }

}
