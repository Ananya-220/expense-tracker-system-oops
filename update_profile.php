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

        <div class="d-sm-flex align-items-center justify-content-between mb-5">
            <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
            <a class="btn btn-primary" type="button" href='profile_page.php'>Back -> </a>
        </div>

        <div class="container mt-5">

            <div class="row">

                <!-- Profile Card -->
                <div class="col-md-6">

                    <div class="card shadow">

                        <div class="card-header bg-primary text-white">
                            <h4>My Profile Details</h4>
                        </div>

                        <div class="card-body">

                            <?php
                            if (isset($_GET['success'])) {
                                echo "<div class='alert alert-success'>Profile Updated Successfully.</div>";
                            }

                            if (isset($_GET['error'])) {
                                echo "<div class='alert alert-danger'>" . $_GET['error'] . "</div>";
                            }
                            ?>

                            <form action="update_profile_details.php" method="POST">

                                <input type="hidden" name="action" value="update">

                                <div class="mb-3">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $data['first_name']; ?>">
                                    <p style="color: red;" id="first_nameErr"></p>
                                </div>

                                <div class="mb-3">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $data['last_name']; ?>">
                                    <p style="color: red;" id="last_nameErr"></p>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $data['email']; ?>">
                                    <p style="color: red;" id="emailErr"></p>
                                </div>

                                <div class="mb-3">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $data['mobile']; ?>">
                                    <p style="color: red;" id="mobileErr"></p>
                                </div>

                                <button type="submit" class="btn btn-primary" name="updateProfile" id="updateProfile">Update Profile</button>

                            </form>

                        </div>

                    </div>

                </div>

                <!-- Change Password Card -->

                <div class="col-md-6">

                    <div class="card shadow">

                        <div class="card-header bg-success text-white">
                            <h4>Change Password</h4>
                        </div>

                        <div class="card-body">

                            <?php
                            if (isset($_GET['passsuccess'])) {
                                echo "<div class='alert alert-success'>Password Changed Successfully.</div>";
                            }

                            if (isset($_GET['passerror'])) {
                                echo "<div class='alert alert-danger'>" . $_GET['passerror'] . "</div>";
                            }
                            ?>

                            <form action="update_profile_details.php" method="POST">

                                <div class="mb-3">
                                    <span style="color: red;">
                                        <?php
                                        if (isset($_SESSION['oldPasswordErr'])) {
                                        ?>
                                            <div class="alert alert-danger">
                                                <?php
                                                echo $_SESSION['oldPasswordErr'];
                                                unset($_SESSION['oldPasswordErr']);
                                                ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </span>
                                    <label>Old Password</label>
                                    <input type="password" class="form-control" name="old_password" id="old_password">
                                    <p style="color: red;" id="oldPasswordErr"></p>
                                    
                                </div>

                                <div class="mb-3">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" name="new_password" id="new_password">
                                    <p style="color: red;" id="newPasswordErr"></p>
                                </div>

                                <div class="mb-3">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                                    <p style="color: red;" id="confirmPasswordErr"></p>
                                </div>

                                <button type="submit" class="btn btn-success" name="changePassword" id="changePassword">Change Password</button>

                            </form>

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
    <script src="js/change_password.js"></script>

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