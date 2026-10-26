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

        if ($type == 'today') {

            $sub_sql = "AND added_date = '$today'";
        } elseif ($type == 'month') {

            $from = date('Y-m-01'); // First day of current month
            $sub_sql = "AND added_date BETWEEN '$from' AND '$today'";
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

    public function dashboardCategory()
    {
        $user_id = $_SESSION['id'];

        $sql = "SELECT category.name,
                COUNT(*) AS usage_count
            FROM expense
            INNER JOIN category
                ON expense.category_id = category.id
            WHERE expense.user_id = '$user_id'
            GROUP BY expense.category_id, category.name
            ORDER BY usage_count DESC
            LIMIT 3";

        $result = $this->conn->query($sql);
        return $result;
    }

    public function dashboardPaymentMode()
    {
        $user_id = $_SESSION['id'];

        $sql = "SELECT payment_mode,
                   COUNT(*) AS total
            FROM expense
            WHERE user_id = '$user_id'
            GROUP BY payment_mode
            ORDER BY total DESC";

        $result = $this->conn->query($sql);

        return $result;
    }
}
