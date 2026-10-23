<?php
session_start();
require_once __DIR__ . '\classes\db.php';
require_once __DIR__ . '\classes\user.php';

if (isset($_POST['register'])) {
    $user = new User();

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = $user->register_validation($firstName , $lastName , $email , $password);

    if ($check === true) {
        if ($user -> emailExists($_POST['email'])) {
            $_SESSION['emailExists'] = "Email already exists.";
            header("Location: register.php");
            exit();
        }

        if ($user->register($firstName , $lastName , $email , $password)) {
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
