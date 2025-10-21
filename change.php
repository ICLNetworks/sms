<?php
@ob_start();
session_start();
?>
<?php
if (isset($_SESSION['login_user'])) {
    include("includes/db.conn.php"); // assumes $conn is your mysqli connection

    if (isset($_POST['submit'])) {
        $newpassword = $_POST['confirm_password2'];
        $username = $_SESSION['login_user'];

        // ✅ Hash the new password
        $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);

        // ✅ Use prepared statement
        $stmt = $conn->prepare("UPDATE admin SET password=? WHERE username=?");
        $stmt->bind_param("ss", $hashedPassword, $username);

        if ($stmt->execute()) {
            echo "<font color='green'>Password changed successfully</font>";
            header("Location: home.php");
            exit();
        } else {
            echo "<font color='red'>Error updating password</font>";
        }

        $stmt->close();
    }
    ?>

    <!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
    <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="en"> <!--<![endif]-->

    <!-- BEGIN HEAD -->

    <head>
        <meta charset="UTF-8" />
        <title>Sourshtra Matriculation School</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
        <!-- GLOBAL STYLES -->
        <!-- GLOBAL STYLES -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/theme.css" />
        <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
        <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />

        <!--END GLOBAL STYLES -->

        <!-- PAGE LEVEL STYLES -->
        <!-- PAGE LEVEL STYLES -->

        <link href="assets/css/jquery-ui.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/plugins/uniform/themes/default/css/uniform.default.css" />
        <link rel="stylesheet" href="assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css" />
        <link rel="stylesheet" href="assets/plugins/chosen/chosen.min.css" />
        <link rel="stylesheet" href="assets/plugins/colorpicker/css/colorpicker.css" />
        <link rel="stylesheet" href="assets/plugins/tagsinput/jquery.tagsinput.css" />
        <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css" />
        <link rel="stylesheet" href="assets/plugins/datepicker/css/datepicker.css" />
        <link rel="stylesheet" href="assets/plugins/timepicker/css/bootstrap-timepicker.min.css" />
        <link rel="stylesheet" href="assets/plugins/switch/static/stylesheets/bootstrap-switch.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-fileupload.min.css" />
        <link rel="stylesheet" href="assets/plugins/validationengine/css/validationEngine.jquery.css" />
        <!-- END PAGE LEVEL  STYLES -->

        <link rel="stylesheet" href="assets/css/countdown.css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->

    <body>
        <!--MAIN CONTAINER -->

        <?php include("header.php"); ?>

        <div id="main">

            <!-- PAGE CONTENT -->
            <div class="container">

                <div class="clearfix">

                </div>
                <div id="counter"></div>


                <div id="counter-default" class="row">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-th-large"></i></div>
                                    <a class="btn btn-danger btn-sm btn-line" style="float:right!important;"
                                        href="logout.php">Logout</a>

                                    <a class="btn btn-danger btn-sm btn-line" style="float:right!important;"
                                        href="home.php">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <h5>Password Change</h5>
                                    <div class="toolbar">
                                        <ul class="nav">
                                            <li>
                                                <div class="btn-group">
                                                    <a class="accordion-toggle btn btn-xs minimize-box"
                                                        data-toggle="collapse" href="#collapseOne">
                                                        <i class="icon-chevron-up"></i>
                                                    </a>
                                                    <button class="btn btn-xs btn-danger close-box">
                                                        <i class="icon-remove"></i>
                                                    </button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </header>
                                <div id="collapseOne" class="accordion-body collapse in body">
                                    <form action="#" method="post" class="form-horizontal" id="block-validate">


                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Password</label>

                                            <div class="col-lg-4">
                                                <input type="password" id="password2" name="password2"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Confirm Password</label>

                                            <div class="col-lg-4">
                                                <input type="password" id="confirm_password2" name="confirm_password2"
                                                    class="form-control" />
                                            </div>
                                        </div>



                                        <div class="form-actions no-margin-bottom" style="text-align:center;">
                                            <input type="submit" value="Change" class="btn btn-primary btn-lg "
                                                name="submit" />
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>


            </div>
            <!--END PAGE CONTENT -->
        </div>
        <!--END MAIN CONTAINER -->


        <!-- GLOBAL SCRIPTS -->

        <script src="assets/plugins/jquery-2.0.3.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>

        <!-- END GLOBAL SCRIPTS -->

        <!-- PAGE LEVEL SCRIPTS -->
        <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="assets/plugins/countdown/jquery.countdown.min.js"></script>
        <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="assets/plugins/daterangepicker/moment.min.js"></script>
        <script src="assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>

        <script type="text/javascript" src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>

        <script type="text/javascript" src="assets/js/countdown.js"></script>
        <script src="assets/plugins/jasny/js/bootstrap-fileupload.js"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- PAGE LEVEL SCRIPT-->
        <script src="assets/js/jquery-ui.min.js"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
        <script src="assets/plugins/chosen/chosen.jquery.min.js"></script>
        <script src="assets/plugins/colorpicker/js/bootstrap-colorpicker.js"></script>
        <script src="assets/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <script src="assets/plugins/validVal/js/jquery.validVal.min.js"></script>
        <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="assets/plugins/daterangepicker/moment.min.js"></script>
        <script src="assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/plugins/timepicker/js/bootstrap-timepicker.min.js"></script>
        <script src="assets/plugins/switch/static/js/bootstrap-switch.min.js"></script>
        <script src="assets/plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js"></script>
        <script src="assets/plugins/autosize/jquery.autosize.min.js"></script>
        <script src="assets/plugins/jasny/js/bootstrap-inputmask.js"></script>
        <script src="assets/js/formsInit.js"></script>
        <script>
            $(function () { formInit(); });
        </script>
        <script src="assets/plugins/validationengine/js/jquery.validationEngine.js"></script>
        <script src="assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
        <script src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
        <script src="assets/js/validationInit.js"></script>
        <script>
            $(function () { formValidation(); });
        </script>

    </body>
    <!-- END BODY -->

    </html>
<?php
} else {
    header("Location:index.php");
}
?>