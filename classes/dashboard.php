<?php
require_once('db.php');
require_once('user.php');
class Dashboard
{
    private $conn;
    public function __construct()
    {
        $db = new DB;
        $this->conn = $db->getConnection();
    }

    public function dashboardExpense($type)
    {
        $today = date('Y-m-d');
        $user_id = $_SESSION['id'];

        if ($type == 'month') {
            $from = date('Y-m-d', strtotime("-1 month"));
            $sub_sql = " AND added_date BETWEEN '$from' AND '$today'";
        } else {
            $sub_sql = "";
        }

        $sql = "SELECT SUM(amount) AS amount
            FROM expense
            WHERE user_id = '$user_id'
            $sub_sql";

        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();

        return $row['amount'] ?? 0;
    }
}
