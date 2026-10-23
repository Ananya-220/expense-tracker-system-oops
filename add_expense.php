<?php
session_start();

require_once 'classes/db.php';
require_once('classes/expense.php');

if (isset($_POST['addExpense'])) {

    $expense = new Expense();

    $name = $_POST['expenseName'];
    $amount = $_POST['amount'];
    $payment = $_POST['payment'];
    $date = date('Y-m-d');
    $category_id = $_POST['category'];
    $details = $_POST['details'];

    $file = $_FILES['billUpload']['name'];
    $tempname = $_FILES['billUpload']['tmp_name'];
    $upload = "img/" . $file;
    $bill = move_uploaded_file($tempname , $upload);

    $check = $expense->addExpenseValidation($name, $amount, $payment, $category_id);

    if ($check === true) {
        if ($expense->addExpense($category_id, $name, $amount, $payment, $date, $details, $upload)) {
            header('Location: expense.php');
            exit();
        } 
        else {
            header('Location: add_expense_form.php');
            exit();
        }
    } else {
        if ($check == "Name is required !") {
            $_SESSION['nameErr'] = $check;
        }
        if ($check == "Amount is required !") {
            $_SESSION['amountErr'] = $check;
        }
        if ($check == "Payment Mode is required !") {
            $_SESSION['paymentErr'] = $check;
        }
        if ($check == "Amount is required !") {
            $_SESSION['Category is required !'] = $check;
        }
        if ($check == "Expense already exists!") {
            $_SESSION['expenseExists'] = $check;
        }
        header('Location: add_expense_form.php');
    }
}
