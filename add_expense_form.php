<?php
session_start();

$pagename = "Add Expense";
include_once('sidebar.php');
require_once('classes/user.php');
include_once('classes/category.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BudgeIT - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <h1 class="h3 mb-0 text-gray-800">Add Expense</h1>
        <div class="d-grid gap-2 d-md-flex mb-1 justify-content-md-end">
            <a class="btn btn-primary" type="button" href='expense.php'>Back -> </a>
        </div>

        <!-- DataTales Example -->
        <div class="row justify-content-center">

            <div class="col-md-10">

                <div class="card o-hidden border-0 shadow-lg my-4">
                    <div class="card-body">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-sm">
                                <div class="p-2">
                                    <h1 style="color: black;" align="center">Add Expenses</h1><br>

                                    <?php
                                    if (isset($_SESSION['expenseExists'])) {
                                    ?>
                                        <div class="alert alert-danger">
                                            <?php
                                            echo $_SESSION['expenseExists'];
                                            unset($_SESSION['expenseExists']);
                                            ?>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    <form class="expense" action="add_expense.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" name="expenseName"
                                                    id="expenseName" placeholder="Expense Name">
                                                <p style="color: red;" id="nameErr"></p>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="number" class="form-control form-control-user" name="amount"
                                                    id="amount" placeholder="Expense Amount">
                                                <p style="color: red;" id="amountErr"></p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <select class="form-control form-control-user" id="payment" name="payment">
                                                    <option value="">Select Payment Mode</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="UPI">UPI</option>
                                                    <option value="Card">Card</option>
                                                </select>
                                                <span style="color:red" id="paymentErr"></span>
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="date" class="form-control form-control-user" name="added_date"
                                                    id="added_date">
                                                <p style="color: red;" id="dateErr"></p>

                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <select class="form-control form-control-user" id="category" name="category">
                                                <option value="">Select Category</option>
                                                <?php
                                                $categoryObj = new Category();
                                                $result = $categoryObj->displayCategories($_SESSION['id']);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {

                                                ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>


                                                <?php

                                                    }
                                                }
                                                ?>
                                            </select>
                                            <span style="color:red" id="categoryErr"></span>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control form-control-user" name="details" id="details" rows="6" placeholder="Description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <span style="color: black;">Upload Bill here : </span><input type="file" name="billUpload" id="billUpload">
                                        </div>
                                        <button type="submit" id="addExpense" name="addExpense" class="btn btn-primary btn-user btn-block">
                                            Add Expense
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
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

    <script src="js/expense.js"></script>
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