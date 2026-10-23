<?php
session_start();
$pagename = "Delete Category";
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

        <h1 class="h3 mb-0 text-gray-800">Delete Category</h1>
        <div class="d-grid gap-2 d-md-flex mb-1 justify-content-md-end">
            <a class="btn btn-primary" type="button" href='category.php'>Back -> </a>
        </div>

        <!-- DataTales Example -->
        <div class="row justify-content-center">

            <div class="col-md-5">

                <div class="card o-hidden border-0 shadow-lg my-5 py-3">
                    <div class="card-body">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-4">
                                    <h1 style="color: black;" align="center">Delete Category</h1><br>

                                    <form class="category" action="delete_category.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                        <p style="font-size: 24px; color:black;" align="center">Are you sure you want to Delete this Category ?</p>
                                        <div class="d-flex justify-content-between w-100 mt-5">
                                            <button type="submit" id="deleteCategory" name="deleteCategory" class="btn btn-danger btn-lg">Delete Category</button>
                                            <a type="submit" id="cancel" name="cancel" class="btn btn-primary btn-lg" href="category.php">Cancel</a>
                                        </div>

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

    <script src="js/addCategory.js"></script>
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