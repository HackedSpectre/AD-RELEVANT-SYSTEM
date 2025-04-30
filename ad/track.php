<?php
require 'db.php';

session_start();
echo "Session ID: " . session_id();

$session_id = session_id();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['activity'])) {
    $activity = trim($_POST['activity']);

    if (!empty($activity)) {
        $stmt = $conn->prepare("INSERT INTO user_activity (session_id, activity) VALUES (?, ?)");
        $stmt->bind_param("ss", $session_id, $activity);
        $stmt->execute();
        echo "Activity tracked: " . htmlspecialchars($activity);
    } else {
        echo "No activity provided.";
    }
} else {
    echo "Invalid request.";
}
?>
