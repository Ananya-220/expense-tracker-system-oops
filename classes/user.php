<?php
require_once('db.php');
class User
{
    private $conn;
    public function __construct()
    {
        $db = new DB;
        $this->conn = $db->getConnection();
    }

    public function register($first_name, $last_name, $email, $password)
    {
        $sql = "INSERT INTO users (first_name , last_name , email , password , created_date) VALUES ('" . $first_name . "' , '" . $last_name . "' , '" . $email . "' , '" . $password . "' , CURRENT_DATE)";

        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows == 1) {
            return true;
        }

        return false;
    }

    public function login_validation($email, $password)
    {
        
    }
}
