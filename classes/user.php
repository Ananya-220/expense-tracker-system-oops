<?php
require_once ('db.php');
class User {
    private $conn;
    public function __construct()
    {
        $db = new DB;
        $this -> conn = $db -> getConnection();
    }

    public function register ($first_name , $last_name , $email , $password)
    {
        $sql = "INSERT INTO users (first_name , last_name , email , password , created_date) VALUES ('" . $first_name . "' , '" . $last_name . "' , '" . $email . "' , '" . $password . "' , CURRENT_DATE)";

        if ($this -> conn -> query($sql))
            {
                return true;
            }
        else 
            {
                return false;
            }
    }

    public function login ($email , $password)
    {
        $sql = " SELECT email , password FROM users WHERE email = '$email' AND password = '$password' ";
        if ($this -> conn -> query($sql))
            {
                return true;
            }
        else 
            {
                return false;
            }
    }
}
?>