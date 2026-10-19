<?php
session_start();

require_once 'classes/db.php';
require_once 'classes/user.php';

if (isset($_POST['login'])) {
    $user = new User();

    if ($user->login($_POST['email'], $_POST['password'])) {
        $_SESSION['email'] = $_POST['email'];

        header("Location: dashboard.php");
        exit();
    } 
    else {
        if (empty($_POST['email']))
            {
                $_SESSION['email_err'] = "Enter correct email !";
            }
        else 
            {
                $_SESSION['email_err'] = "";
            }

        if (empty($_POST['password']))
            {
                $_SESSION['password_err'] = "Enter correct password !";
            }
        else 
            {
                $_SESSION['password_err'] = "";
            }
        header("Location: login.php");
        exit();
    }
}
