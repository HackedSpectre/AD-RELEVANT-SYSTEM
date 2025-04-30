<?php
session_start();
session_destroy(); // Destroy session

// Redirect to login page after logout
header("Location: login.php?logged_out=1");
exit();
?>
