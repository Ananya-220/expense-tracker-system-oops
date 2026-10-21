<?php
session_start();

require_once 'classes/db.php';
require_once 'classes/user.php';

if (isset($_POST['login'])) {
    $user = new User();
    
    $check = $user -> login_validation($_POST['email'] , $_POST['password']);

    if ($check === true) {
        if ($user -> login($_POST['email'], $_POST['password'])) {
            $_SESSION['email'] = $_POST['email'];

            header("Location: dashboard.php");
            exit();

        } 
        else {
            $_SESSION['error'] = "Invalid Email or Password";

            header("Location: login.php");
            exit();
        }
    } 
    else {
        if ($check == "Email is required" || $check == "Invalid Email Address") {
            $_SESSION['email_err'] = $check;
        }

        if ($check == "Password is required") {
            $_SESSION['password_err'] = $check;
        }

        header("Location: login.php");
        exit();
    }
}
