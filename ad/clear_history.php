<?php
session_start();
require 'db.php';

$session_id = session_id();

$stmt = $conn->prepare("DELETE FROM user_activity WHERE session_id = ?");
$stmt->bind_param("s", $session_id);
$stmt->execute();

echo "Search history cleared.";
?>
