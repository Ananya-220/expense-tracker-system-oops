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
                $_SESSION['name'] =  $row['first_name'] . $row['last_name'];
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

    public function getUser($id)
    {
        $sql = "SELECT * FROM users WHERE id='$id'";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return false;
    }

    public function updateProfile($id, $first_name, $last_name, $mobile)
    {
        $first_name = trim($first_name);
        $last_name = trim($last_name);
        $mobile = trim($mobile);

        $sql = "UPDATE users SET first_name='$first_name' , last_name='$last_name', mobile='$mobile' WHERE id='$id'";
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        }

        return false;
    }

    public function changePassword($id, $oldPassword, $newPassword)
    {
        $sql = "SELECT password FROM users WHERE id='$id'";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($oldPassword, $row['password'])) {

                $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $sql = "UPDATE users SET password='$newPassword' WHERE id='$id'";
                $result = $this->conn->query($sql);
                if ($result) {
                    return "true";
                }
            }

            return "Old password is incorrect.";
        }

        return "User not found.";
    }

    public function profileValidation($first_name, $last_name, $mobile)
    {
        if (empty($first_name)) {
            return "First Name is required";
        }

        if (empty($last_name)) {
            return "Last Name is required";
        }

        if (!empty($mobile)) {
            if (!preg_match('/^[0-9]{10}$/', $mobile)) {
                return "Mobile number must contain exactly 10 digits.";
            }
        }

        return true;
    }

    public function passwordValidation($old, $new, $confirm)
    {
        if (empty($old)) {
            return "Old Password is required";
        }

        if (empty($new)) {
            return "New Password is required";
        }

        if (empty($confirm)) {
            return "Confirm Password is required";
        }

        if (strlen($new) < 8) {
            return "Password must contain at least 8 characters.";
        }

        if ($new != $confirm) {
            return "Passwords do not match.";
        }

        return true;
    }
}
