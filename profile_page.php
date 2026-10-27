<?php
session_start();
$pagename = "Profile";
include_once('sidebar.php');
require_once('classes/user.php');

$user = new User();
$data = $user->getUser($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BudgeIT - Profile</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <!-- Begin Page Content -->

    <div class="container">

        <!-- Page Heading -->

        <div class="d-sm-flex align-items-center mb-5">
            <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
        </div>

        <div class="container mt-5">

            <div class="row">

                <!-- Profile Card -->
                <div class="col-md-12">

                    <div class="card shadow">

                        <div class="card-header bg-primary text-white">
                            <h4>My Profile Details</h4>
                        </div>

                        <div class="card-body">

                                <div class="mb-3">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $data['first_name']; ?>" disabled>
                                    <p style="color: red;" id="first_nameErr"></p>
                                </div>

                                <div class="mb-3">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $data['last_name']; ?>" disabled>
                                    <p style="color: red;" id="last_nameErr"></p>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="email" value="<?php echo $data ['email']; ?>" disabled>
                                    <p style="color: red;" id="emailErr"></p>
                                </div>

                                <div class="mb-3">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $data['mobile']; ?>" disabled>
                                </div>

                                <a type="submit" class="btn btn-primary" href="update_profile.php">Click here to Update</a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

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

    <script src="js/update_profile.js"></script>

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