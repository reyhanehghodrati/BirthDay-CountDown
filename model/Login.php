<?php
include 'config/database.php';

class Login
{
    public $username;
    public $password;


    public function login()
    {
        $conn = database::connect();

        $stmt = $conn->prepare("SELECT password FROM site_users WHERE username = ?");
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedHash = $row['password'];
            if (password_verify($this->password, $storedHash)) {
                return true;
            }
        }
        return false;
    }

}
