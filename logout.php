<?php
session_start();
session_unset();
session_destroy();

// Optional: clear cookies if set
setcookie(session_name(), '', time() - 3600);

header("Location: index.php"); // redirect to login
exit();
?>
