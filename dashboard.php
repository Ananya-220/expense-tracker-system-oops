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
        $totalExpense = $dashboardObj->dashboardExpense('today');
        $monthExpense = $dashboardObj->dashboardExpense('month');
        $topCategory = $dashboardObj->dashboardCategory();
        $paymentModes = $dashboardObj->dashboardPaymentMode();
        ?>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center mb-5">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="row col-xl-8 col-lg-7 mb-4">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h3 text-sm font-weight-bold text-primary text-uppercase mb-4">
                                        Today's Expenses </div>
                                    <div class="text-xl h4 mb-0 font-weight-bold text-gray-800">
                                        ₹ <?php echo $totalExpense; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h3 text-sm font-weight-bold text-success text-uppercase mb-4">
                                        This Month's Expense </div>
                                    <div class="text-xl h4 mb-0 font-weight-bolder text-gray-800">
                                        ₹ <?php echo $monthExpense; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Most Used Payment Mode</h6>
                    </div>
                    <div class="card-body">
                        <?php
                        $total = 0;

                        while ($row = $paymentModes->fetch_assoc()) {
                            $total += $row['total'];
                        }

                        $paymentModes->data_seek(0);

                        $colors = [
                            "bg-primary",
                            "bg-success",
                            "bg-info",
                            "bg-warning",
                            "bg-danger"
                        ];

                        $i = 0;

                        while ($row = $paymentModes->fetch_assoc()) {

                            $percentage = ($total > 0) ? round(($row['total'] / $total) * 100) : 0;
                            $color = $colors[$i % count($colors)];
                        ?>
                            <h4 class="small font-weight-bold">
                                <?php echo $row['payment_mode']; ?>
                                <span class="float-right"><?php echo $percentage; ?>%</span>
                            </h4>

                            <div class="progress mb-4">
                                <div class="progress-bar <?php echo $color; ?>"
                                    role="progressbar"
                                    style="width: <?php echo $percentage; ?>%"
                                    aria-valuenow="<?php echo $percentage; ?>"
                                    aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        <?php
                            $i++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Expenses Overview</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Top 3 Categories</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </a>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <h4 class="m-0 font-weight-bold text-primary">
                            <?php while ($row = $topCategory->fetch_assoc()) { ?>
                                <div class="mb-3">
                                    <h5 class="font-weight-bold text-primary">
                                        <?php echo " -> " . $row['name']; ?>
                                    </h5>
                                </div>
                            <?php } ?>
                        </h4>
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