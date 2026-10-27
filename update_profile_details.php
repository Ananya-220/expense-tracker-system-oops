<?php
session_start();
require_once('classes/user.php');
$user = new User();

// Details
if (isset($_POST['updateProfile'])) {

    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email = $_POST["email"];
    $mobile = $_POST['mobile'];

    $validation = $user->profileValidation($first_name, $last_name, $email, $mobile);

    if ($validation !== true) {
        header("Location: update_profile.php");
        exit;
    }

    if ($user->updateProfile($_SESSION['id'], $first_name, $last_name, $email, $mobile)) {
        header("Location: profile_page.php");
        exit;
    } 
    else {
        header("Location: update_profile.php");
        exit;
    }
}

// Password
if (isset($_POST['changePassword'])) {

    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirm     = $_POST['confirm_password'];

    $validation = $user->passwordValidation($oldPassword, $newPassword, $confirm);

    if ($validation !== true) {
        header("Location: update_profile.php");
        exit;
    }

    $change = $user->changePassword($_SESSION['id'], $oldPassword, $newPassword);

    if ($change == "success") {
        header("Location: profile_page.php");
        exit;
    } 
    else {
        if ($change == "Old password is incorrect !") {
            $_SESSION['oldPasswordErr'] = $change;
        }
        header("Location: update_profile.php");
        exit;
    }
}