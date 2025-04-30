<?php
$conn = new mysqli('localhost', 'root', '', 'ad_system');
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error);
}
?>
