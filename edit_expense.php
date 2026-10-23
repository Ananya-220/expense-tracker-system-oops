<?php
session_start();

require_once 'classes/db.php';
require_once('classes/category.php');
require_once('classes/expense.php');

if (isset($_POST['editExpense'])) {

    $expense = new Expense();
    $expense_id = $_POST['id'];
    $name = $_POST['expenseName'];
    $amount = $_POST['amount'];
    $payment = $_POST['payment'];
    $date = $_POST['added_date'];
    $category = $_POST['category'];
    $details = $_POST['details'];

    $file = $_FILES['billUpload']['name'];
    $tempname = $_FILES['billUpload']['tmp_name'];
    $upload = "img/" . $file;
    $bill = move_uploaded_file($tempname, $upload);

    if ($_FILES['billUpload']['name'] != "") {

        // Upload new bill
        $bill = $_FILES['billUpload']['name'];
        move_uploaded_file($_FILES['billUpload']['tmp_name'], "uploads/" . $bill);
    } else {

        // Keep existing bill
        $bill = $_POST['oldBill'];
    }

    $check = $expense->editExpenseValidation($expense_id, $name, $amount, $payment, $category);

    if ($check === true) {
        if ($expense->editExpense($expense_id, $category, $name, $amount, $payment, $date, $details, $bill)) {
            header('Location: expense.php');
            exit();
        } else {
            header('Location: edit_expense_form.php?id=' . $expense_id);
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
        header('Location: edit_expense_form.php?id=' . $expense_id);
    }
}
