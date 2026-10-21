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
        $first_name = trim($first_name);
        $last_name = trim($last_name);
        $email = trim($email);

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name , last_name , email , password , created_date)
            VALUES ('$first_name' , '$last_name' , '$email' , '$password' , CURRENT_DATE)";

        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function register_validation($first_name, $last_name, $email, $password)
    {
        if (empty($first_name)) {
            return "First Name is required";
        }

        if (empty($last_name)) {
            return "Last Name is required";
        }

        if (empty($email)) {
            return "Email is required";
        }

        if (empty($password)) {
            return "Password is required";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid Email Address";
        }

        if (strlen($password) < 8) {
            return "Password must contain at least 8 characters";
        }

        return true;
    }

    public function login($email, $password)
    { 
        $sql = "SELECT * FROM users WHERE email='$email'";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function login_validation($email, $password)
    {
        if (empty($email)) {
            return "Email is required";
        }

        if (empty($password)) {
            return "Password is required";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid Email Address";
        }

        return true;
    }

    public function emailExists($email)
    {
        $sql = "SELECT * FROM users WHERE email ='$email'";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
