<?php
define("MYSQL_SERVER", "localhost");
define("MYSQL_USER", "root");
define("MYSQL_PASSWORD", "");
define("MYSQL_DATABASE", "sms");

$conn=mysqli_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASSWORD) or die ('I cannot connect to the database because 1: ' . mysqli_error());
mysqli_select_db($conn,MYSQL_DATABASE) or die ('I cannot connect to the database because 2: ' . mysqli_error());
?>
<!-- <?php
// Define constants only if they are not already defined
if (!defined("MYSQL_SERVER")) define("MYSQL_SERVER", "localhost");
if (!defined("MYSQL_USER")) define("MYSQL_USER", "root");
if (!defined("MYSQL_PASSWORD")) define("MYSQL_PASSWORD", "");
if (!defined("MYSQL_DATABASE")) define("MYSQL_DATABASE", "sms");

// Create database connection
$conn = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD) 
    or die('I cannot connect to the database because 1: ' . mysqli_error($conn));

mysqli_select_db($conn, MYSQL_DATABASE) 
    or die('I cannot connect to the database because 2: ' . mysqli_error($conn));
?>
 -->
