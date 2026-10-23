<?php
session_start();

require_once 'classes/db.php';
require_once('classes/category.php');
if (isset($_POST['deleteCategory'])) {
    $category = new Category();
    $category_id = $_POST['id'];

    if ($category -> deleteCategory($category_id))
        {
            header('Location: category.php');
            exit();
        }
}
?>