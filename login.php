<?php
session_start();

if (isset($_SESSION['email'])) {
    header("Location: dashboard.php");
    exit();
}

require_once __DIR__ . '/classes/db.php';
require_once __DIR__ . '/classes/user.php';

if (isset($_POST['login'])) {

    $user = new User();

    if ($user->login($_POST['email'], $_POST['password'])) {

        $_SESSION['email'] = $_POST['email'];

        header("Location: dashboard.php");
        exit();

    } else {

        header("Location: login.html");
        exit();
    }
}
?>