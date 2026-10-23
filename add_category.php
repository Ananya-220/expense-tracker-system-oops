<?php
session_start();

require_once 'classes/db.php';
require_once('classes/category.php');

if (isset($_POST['addCategory'])) {

    $category = new Category();

    $name = $_POST['categoryName'];
    $status = $_POST['status'];

    $check = $category->addCategoryValidation($name , $status);
    
    
    if ($check === true) {
        if ($category -> addCategory($name , $status)) {
            header('Location: category.php');
            exit();
        } 
        else {
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
        if ($check == "Category already exists!") {
            $_SESSION['categoryExists'] = $check;
        }
        header('Location: add_category_form.php');
    }
}
