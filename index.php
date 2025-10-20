<?php
@ob_start();
session_start();
?>
<?php
include("includes/db.conn.php");
$error = ''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prevent SQL Injection
        $username = mysqli_real_escape_string($conn, stripslashes($username));

        // Fetch hashed password from DB
        $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' LIMIT 1");

        if ($query && mysqli_num_rows($query) == 1) {
            $row = mysqli_fetch_assoc($query);
            
            // Verify password
            if (password_verify($password, $row['password'])) {
                $_SESSION['login_user'] = $username; // Initializing Session
                ?>
                <script>
                    window.location = 'home.php';
                </script>
                <?php
                exit();
            } else {
                $error = "Username or Password is invalid";
            }
        } else {
            $error = "Username or Password is invalid";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title>Sourashtra Matriculation School, Emaneswaram</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/login.css" />
    <link rel="stylesheet" href="assets/plugins/magic/magic.css" />
    <link rel="stylesheet" href="style/style.css" />
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body>

   <!-- PAGE CONTENT --> 
   <?php include("header.php")?>
       
   <div class="container">
        <div class="tab-content">
            <div id="login" class="tab-pane active">
                <div class="blue-box">
                    <div class="blue-box-header">
                        🔐 Admin Login
                    </div>
                    <div class="blue-box-body" style="text-align: center">
                        <form action="" method="post" class="form-signin">
                            <p class="text-muted text-center btn-block btn-primary btn-rect">
                                Enter your username and password
                            </p>
                            <input type="text" name="username" placeholder="Username" class="form-control" 
                                   oncopy="return false" onpaste="return false" oncut="return false" />
                            <input type="password" name="password" placeholder="Password" class="form-control"
                                   oncopy="return false" onpaste="return false" oncut="return false" />
                            <button class="btn text-muted text-center btn-danger" type="submit" name="submit">Sign in</button>
                            <div id="error"><?php echo $error;?></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </div>

   <!--END PAGE CONTENT -->     

   <script src="assets/plugins/jquery-2.0.3.min.js"></script>
   <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
   <script src="assets/js/login.js"></script>
        
   <?php include("footer.php"); ?>
</body>
<!-- END BODY -->
</html>
