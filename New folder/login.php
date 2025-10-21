<?php
include("includes/db.conn.php");
$error=''; // Variable To Store Error Message
if (!empty($_POST['adsubmit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$query = mysql_query("select * from admin where password='$password' AND username='$username'");
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
?>

<script>
    window.location = 'dashboard.php';
</script>
<?php
} else {
$error = "Username or Password is invalid";
}
}
} ?>