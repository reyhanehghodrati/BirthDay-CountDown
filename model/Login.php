<?php
include 'config/database.php';

class Login
{
    public $username;
    public $password;


    public function login()
    {
        $password=$this->password;
        $password=md5($password);
        $conn=database::connect();
        $sql = "SELECT * FROM site_users WHERE username = '$this->username' AND password ='$password'";
        $result=$conn->query($sql);
        if ($result && $result->num_rows>0) {
            return TRUE;
        } else {
            return false;
        }


    }


}
