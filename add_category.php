<?php
session_start();

require_once 'classes/db.php';
require_once('classes/category.php');

if (isset($_POST['addCategory'])) {

    $category = new Category();

    $check = $category->addCategoryValidation($_POST['categoryName'], $_POST['status']);
    $name = $_POST['categoryName'];
    $status = $_POST['status'];
    
    if ($check === true) {
        if ($category -> addCategory($name , $status)) {

            header('Location: category.php');
            exit();
        } else {
            header('Location: add_category_form.php');
            exit();
        }
    } 
    else {
        if ($check == "Name is required !") {
            $_SESSION['nameErr'] = $check;
        }
        if ($check == "Status is required !") {
            $_SESSION['statusErr'] = $check;
        }
        header('Location: add_category_form.php');
    }
}
