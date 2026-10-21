<?php
session_start();
require_once __DIR__ . '\classes\db.php';
require_once __DIR__ . '\classes\user.php';

if (isset($_POST['register'])) {
    $user = new User();

    $check = $user->register_validation($_POST['first_name'] , $_POST['last_name'] , $_POST['email'] , $_POST['password']);

    if ($check === true) {
        if ($user -> emailExists($_POST['email'])) {
            $_SESSION['emailExists'] = "Email already exists.";

            header("Location: register.php");
            exit();
        }

        if ($user->register($_POST['first_name'] , $_POST['last_name'] , $_POST['email'] , $_POST['password'])) {
            header("Location: login.php");
            exit();
        }
    } 
    else {

        $_SESSION['emailExists'] = $check;

        header("Location: register.php");
        exit();
    }
}
