<?php
session_start();
$pagename = "Dashboard";
include_once('sidebar.php');
require_once('classes/user.php');
include_once('classes/dashboard.php');

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BudgeIT - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <?php
        $dashboardObj = new Dashboard();
        $todayExpense = $dashboardObj->dashboardExpense('today');
        $monthExpense = $dashboardObj->dashboardExpense('month');
        $topCategory = $dashboardObj->dashboardCategory();
        $paymentModes = $dashboardObj->dashboardPaymentMode();
        $monthlyExpense = $dashboardObj->monthlyExpense();
        ?>

        <!-- ===================== TOP ROW ===================== -->

        <!-- Left Side -->
        <div class="col-lg-12">

            <div class="row">

                <!-- Today's Expense -->
                <div class="col-lg-6 mb-4">
                    <div class="card border-left-primary shadow h-100" style="min-height:220px;">
                        <div class="card-body d-flex flex-column justify-content-center">

                            <div class="h4 text-sm font-weight-bold text-primary text-uppercase mb-2">
                                Today's Expenses
                            </div>

                            <div class="h2 font-weight-bold text-gray-800">
                                ₹ <?php echo $todayExpense; ?>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- This Month -->
                <div class="col-lg-6 mb-4">
                    <div class="card border-left-success shadow h-100" style="min-height:220px;">
                        <div class="card-body d-flex flex-column justify-content-center">

                            <div class="h4 text-sm font-weight-bold text-success text-uppercase mb-2">
                                Expenses (This Month)
                            </div>

                            <div class="h2 font-weight-bold text-gray-800">
                                ₹ <?php echo $monthExpense; ?>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- ===================== END TOP ROW ===================== -->


        <!-- ===================== SECOND ROW ===================== -->
        <div class="col-lg-12 mt-2">

            <div class="row">


                <div class="col-lg-6 mb-4">

                    <div class="card shadow h-100">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Most Used Payment Mode
                            </h6>
                        </div>

                        <div class="card-body">

                            <table class="table table-bordered table-hover text-center">

                                <thead class="thead-light">
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Payment Mode</th>
                                        <th>Payments Made</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $srNo = 1;
                                    while ($row = $paymentModes->fetch_assoc()) {
                                    ?>

                                        <tr>

                                            <td><?php echo $srNo++; ?></td>

                                            <td>
                                                <a href="expense.php?payment=<?php echo urlencode($row['payment_mode']); ?>">
                                                    <?php echo ucfirst($row['payment_mode']); ?>
                                                </a>
                                            </td>

                                            <td>
                                                <span class="badge badge-primary px-2 py-1">
                                                    <?php echo $row['total']; ?>
                                                </span>
                                            </td>

                                            <td>
                                                <?php echo "₹ " . $row['amt']; ?>
                                            </td>

                                        </tr>

                                    <?php } ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>



                <!-- Top Categories -->
                <div class="col-lg-6 mb-4">

                    <div class="card shadow h-40">

                        <div class="card-header py-3">

                            <h6 class="m-0 font-weight-bold text-primary">
                                Top 3 Categories
                            </h6>

                        </div>

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-bordered table-hover text-center">

                                    <thead class="thead-light">

                                        <tr>

                                            <th>Sr No.</th>
                                            <th>Category</th>
                                            <th>Used</th>
                                            <th>Total</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php
                                        $srNo = 1;
                                        while ($row = $topCategory->fetch_assoc()) {
                                        ?>

                                            <tr>

                                                <td><?php echo $srNo++; ?></td>

                                                <td>
                                                    <a href="expense.php?category=<?php echo $row['id']; ?>&month=<?php echo date('n'); ?>">
                                                        <?php echo ucfirst($row['name']); ?>
                                                    </a>
                                                </td>

                                                <td>

                                                    <span class="badge badge-success px-2 py-1">
                                                        <?php echo $row['used_count']; ?>
                                                    </span>

                                                </td>

                                                <td>
                                                    <?php echo "₹" . $row['total']; ?>
                                                </td>

                                            </tr>

                                        <?php } ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>


            </div>
        </div>
        <!-- ===================== END SECOND ROW ===================== -->

        <!-- Expenses Overview -->
        <div class="col-lg-12 mt-2">

            <div class="card shadow h-50">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Expenses Overview
                    </h6>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover text-center">

                            <thead class="thead-light">

                                <tr>
                                    <th width="60%">Month</th>
                                    <th>Total Expense (₹)</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php
                                $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                                $expense = [];
                                $year = date("Y");
                                while ($row = $monthlyExpense->fetch_assoc()) {
                                    $expense[$row['month']] = $row['total'];
                                    $year = $row['year'];
                                }
                                foreach ($months as $month) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $month . " " . $year; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (isset($expense[$month])) {
                                                echo "₹ " . $expense[$month];
                                            } else {
                                                echo '<span class="text-danger">No Expenses in this month</span>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2021</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include_once('header_logout.php'); ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>