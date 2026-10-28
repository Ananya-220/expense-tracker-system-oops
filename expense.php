<?php

session_start();
$pagename = "Expense";
include_once('sidebar.php');
require_once('classes/user.php');
include_once('classes/expense.php');
$expenseObj = new Expense();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BudgeIT - Expense</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-5">
            <h1 class="h3 mb-2 text-gray-800">Expenses</h1>
            <a class="btn btn-primary btn-md" type="button" href='add_expense_form.php'>+ Add Expense</a>
        </div>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h5 class="m-0 font-weight-bold text-primary">
                        Expenses Table
                    </h5>
                    <form method="GET" class="d-flex align-items-center flex-wrap gap-2">
                        <select name="category" class="form-select" style="width:170px;">
                            <option value="">All Categories</option>

                            <?php
                            $category = $expenseObj->getCategories($_SESSION['id']);
                            while ($row = $category->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['id']; ?>"
                                    <?php if (isset($_GET['category']) && $_GET['category'] == $row['id']) echo "selected"; ?>>
                                    <?php echo ucfirst($row['name']); ?>
                                </option>
                            <?php } ?>
                        </select>

                        <select name="payment" class="form-select" style="width:190px;">
                            <option value="">All Payment Modes</option>
                            <option value="Cash" <?php if (($_GET['payment'] ?? '') == "Cash") echo "selected"; ?>>Cash</option>
                            <option value="Card" <?php if (($_GET['payment'] ?? '') == "Card") echo "selected"; ?>>Card</option>
                            <option value="UPI" <?php if (($_GET['payment'] ?? '') == "UPI") echo "selected"; ?>>UPI</option>
                        </select>

                        <input type="date" name="date" class="form-control" style="width:144px;"
                            value="<?php echo $_GET['date'] ?? ''; ?>">

                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z" />
                            </svg>
                        </button>

                        <a href="expense.php" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                            </svg>
                        </a>

                    </form>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead align="center">
                            <tr>
                                <th>Sr No.</th>
                                <th>Date</th>
                                <th>Expense</th>
                                <th>Category</th>
                                <th>Payment Mode</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot align="center">
                            <tr>
                                <th>Sr No.</th>
                                <th>Date</th>
                                <th>Expense</th>
                                <th>Category</th>
                                <th>Payment Mode</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody align="center">
                            <?php
                            $expenseObj = new Expense();
                            $category = $_GET['category'] ?? "";
                            $date = $_GET['date'] ?? "";
                            $payment = $_GET['payment'] ?? "";

                            $result = $expenseObj->filterExpense($_SESSION['id'], $category, $date, $payment);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $row["id"]; ?></th>
                                        <td><?php echo date('d-m-Y', strtotime($row["added_date"])); ?></td>
                                        <td><?php echo ucfirst($row["expName"]); ?></td>
                                        <td><?php echo ucfirst($row["name"]); ?></td>
                                        <?php
                                        if (strtolower($row["payment_mode"]) == "cash") {
                                            $badge = "success";
                                        } else if (strtolower($row["payment_mode"]) == "card") {
                                            $badge = "primary";
                                        } else if (strtolower($row["payment_mode"]) == "upi") {
                                            $badge = "info";
                                        } else {
                                            $badge = "dark";
                                        }
                                        ?>

                                        <td class="text-center align-middle">
                                            <span class="badge rounded-pill px-3 py-2 text-bg-<?php echo $badge; ?>">
                                                <?php echo ucfirst($row["payment_mode"]); ?>
                                            </span>
                                        </td>
                                        <td><?php echo $row["amount"]; ?></td>
                                        <td class="table-data align-top" align="center">
                                            <div class="d-grid gap-2 mx-auto d-md-block">
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewModal<?php echo $row['id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                                    </svg></button>
                                                <div class="modal fade" id="viewModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Expense Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-borderless">
                                                                    <tr>
                                                                        <th width="35%">Expense Name</th>
                                                                        <td><?php echo ucfirst($row['expName']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Date</th>
                                                                        <td><?php echo date('d-m-Y', strtotime($row['added_date'])); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Category</th>
                                                                        <td><?php echo ucfirst($row['name']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Payment Mode</th>
                                                                        <td><?php echo $row['payment_mode']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Amount</th>
                                                                        <td>₹ <?php echo $row['amount']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Description</th>
                                                                        <td><?php echo $row['details']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Bill Uploaded</th>
                                                                        <td>
                                                                            <?php if (!empty($row['bill_upload'])) { ?>
                                                                                <a href="<?php echo $row['bill_upload']; ?>" target="_blank">
                                                                                    <img src="<?php echo $row['bill_upload']; ?>" class="img-thumbnail" width="250">
                                                                                </a>
                                                                            <?php } else { ?>
                                                                                <span class="text-danger">No Bill Uploaded</span>
                                                                            <?php } ?>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                    Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a type="button" class="btn btn-success btn-sm" href="edit_expense_form.php?id=<?php $row["id"];
                                                                                                                                echo $row['id'] ?>" name="edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                                    </svg>
                                                </a>
                                                <a type="button" class="btn btn-danger btn-sm" href="delete_expense_form.php?id=<?php $row["id"];
                                                                                                                                echo $row['id'] ?>" name="delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>

                            <?php
                            } else {
                            ?>
                                <tr>
                                    <td colspan="7" align="center">No Records Found</td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
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
                <span>Copyright &copy; Your Website 2020</span>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>