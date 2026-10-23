<?php
session_start();

require_once 'classes/db.php';
require_once('classes/category.php');

if (isset($_POST['editCategory'])) {
    $category = new Category();
    $category_id = $_POST['id'];
    $name = $_POST['categoryName'];
    $status = $_POST['status'];

    $check = $category->editCategoryValidation($category_id , $name , $status);

    if ($check === true) {
        if ($category -> editCategory($category_id, $name, $status)) {
            header('Location: category.php');
            exit();
        } 
        else {
            header('Location: edit_category_form.php?id='.$category_id);
            exit();
        }
    } else {
        if ($check == "Name is required !") {
            $_SESSION['nameErr'] = $check;
        }
        if ($check == "Status is required !") {
            $_SESSION['statusErr'] = $check;
        }
        header('Location: edit_category_form.php?id='.$category_id);
    }
}

