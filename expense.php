<?php

session_start();
$pagename = "Expense";
include_once('sidebar.php');
require_once('classes/user.php');
include_once('classes/expense.php');

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
        <h1 class="h3 mb-2 text-gray-800">Expenses</h1>
        <div class="d-grid gap-2 d-md-flex mb-2 justify-content-md-end">
            <a class="btn btn-primary btn-lg" type="button" href='add_expense_form.php'>+ Add Expense</a>
        </div>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Expenses Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead align="center">
                            <tr>
                                <th>ID</th>
                                <th>Expense</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot align="center">
                            <tr>
                                <th>ID</th>
                                <th>Expense</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody align="center">
                            <?php
                            $expenseObj = new Expense();
                            $result = $expenseObj->displayExpense($_SESSION['id']);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $row["id"]; ?></th>
                                        <td><?php echo ucfirst($row["expName"]); ?></td>
                                        <td><?php echo ucfirst($row["name"]); ?></td>
                                        <td><?php echo $row["amount"]; ?></td>
                                        <td><?php echo $row["payment_mode"]; ?></td>
                                        <td><?php echo $row["added_date"]; ?></td>
                                        <td class="table-data align-top" align="center">
                                            <div class="d-grid gap-2 mx-auto d-md-block">
                                                <a type="button" class="btn btn-success btn-sm" href="edit_expense_form.php?id=<?php $row["id"]; echo $row['id'] ?>" name="edit">Edit</a>
                                                <a type="button" class="btn btn-danger btn-sm" href="delete_expense_form.php?id=<?php $row["id"]; echo $row['id'] ?>" name="delete">Delete</a>
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