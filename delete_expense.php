<?php
session_start();

require_once 'classes/db.php';
require_once('classes/expense.php');

if (isset($_POST['deleteExpense'])) {
    $expense = new Expense();
    $expense_id = $_POST['id'];

    if ($expense -> deleteExpense($expense_id))
        {
            header('Location: expense.php');
            exit();
        }
}
?>