<?php
require_once('db.php');
require_once('user.php');
class Expense
{
    private $conn;
    public function __construct()
    {
        $db = new DB;
        $this->conn = $db->getConnection();
    }

    public function displayExpense($user_id)
    {
        $sql = "SELECT expense.*, category.name FROM expense, category WHERE expense.category_id = category.id AND expense.user_id = $user_id";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function addExpense($category_id, $name, $amount, $payment, $date, $details, $bill)
    {
        $user_id = $_SESSION['id'];
        $sql = "INSERT INTO expense (category_id , user_id , expName , amount , payment_mode , details , added_date , bill_upload) VALUES ($category_id , $user_id ,'$name' , $amount , '$payment' , '$details' , '$date' , '$bill')";
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function addExpenseValidation($name, $amount, $payment, $category)
    {
        if (empty($name)) {
            return "Name is required !";
        }

        if (empty($amount)) {
            return "Amount is required !";
        }

        if ($payment == "") {
            return "Payment Mode is required !";
        }

        if ($category == "") {
            return "Category is required !";
        }

        $checkName = "SELECT * FROM expense WHERE expName = '$name'";
        $result = $this->conn->query($checkName);

        if ($result->num_rows > 0) {
            return "Expense already exists!";
        }

        return true;
    }

    public function displayEditExpense($id)
    {
        $user_id = $_SESSION['id'];
        $sql = "SELECT expense.*, category.name FROM expense, category WHERE expense.category_id = category.id AND expense.user_id = $user_id AND expense.id = $id";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function editExpenseValidation($id, $name, $amount, $payment, $category)
    {
        if (empty($name)) {
            return "Name is required !";
        }

        if (empty($amount)) {
            return "Amount is required !";
        }

        if ($payment == "") {
            return "Payment Mode is required !";
        }

        if ($category == "") {
            return "Category is required !";
        }


        $sql = "SELECT * FROM expense WHERE expName='$name' AND id != $id";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return "Expense already exists!";
        }

        return true;
    }

    public function editExpense($expense_id, $category_id, $name, $amount, $payment, $date, $details, $bill)
    {
        $sql = "UPDATE expense SET category_id = $category_id , expName = '$name' , amount = $amount , payment_mode = '$payment' , details = '$details' , added_date = '$date' , bill_Upload = '$bill' WHERE id = $expense_id";
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteExpense($expense_id)
    {
        $sql = "DELETE FROM expense WHERE id = $expense_id";
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getCategories($user_id)
    {
        $sql = "SELECT * FROM category WHERE user_id='$user_id' ORDER BY name";

        $result = $this->conn->query($sql);

        return $result;
    }

    public function filterExpense($user_id, $category, $date, $payment)
    {
        if ($date == "") {
            $date = date('n');
        }

        $sql = "SELECT expense.*, category.name
            FROM expense
            INNER JOIN category ON expense.category_id = category.id
            WHERE expense.user_id='$user_id'
            AND MONTH(expense.added_date)='$date'";

        if ($category != "") {
            $sql .= " AND expense.category_id='$category'";
        }

        if ($payment != "") {
            $sql .= " AND expense.payment_mode='$payment'";
        }

        $sql .= " ORDER BY expense.added_date DESC";

        return $this->conn->query($sql);
    }

    public function getExpenseNames($user_id)
    {
        $sql = "SELECT DISTINCT expName FROM expense WHERE user_id='$user_id' ORDER BY expName";
        $result = $this->conn->query($sql);
        return $result;
    }
}
