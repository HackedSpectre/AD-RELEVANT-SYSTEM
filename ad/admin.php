<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$successMessage = "";
$errorMessage = "";

// Handle Ad Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $link_url = $_POST['link_url'];
    $keywords = $_POST['keywords'];

    $stmt = $conn->prepare("INSERT INTO ads (title, description, image_url, link_url, keywords) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $description, $image_url, $link_url, $keywords);

    if ($stmt->execute()) {
        $successMessage = "✅ Ad added successfully!";
    } else {
        $errorMessage = "❌ Failed to add ad.";
    }
}

// Handle Admin Creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_admin'])) {
    $new_username = $_POST['new_admin_username'];
    $new_password = $_POST['new_admin_password'];

    // Prevent duplicate usernames
    $checkStmt = $conn->prepare("SELECT id FROM admin_users WHERE username = ?");
    $checkStmt->bind_param("s", $new_username);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        $errorMessage = "❌ Username already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $new_username, $new_password);

        if ($stmt->execute()) {
            $successMessage = "✅ New admin created successfully!";
        } else {
            $errorMessage = "❌ Failed to create admin.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="dark-mode">
    <div id="dark-mode-toggle">
        <button onclick="toggleDarkMode()">🌙 Toggle Dark Mode</button>
    </div>
    <div class="navbar">
        <a href="admin.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <h2>Admin Panel - Manage Ads</h2>

        <!-- Display Success or Error Message -->
        <?php if (!empty($successMessage)): ?>
            <p style="color: green;"><?= $successMessage ?></p>
        <?php endif; ?>
        <?php if (!empty($errorMessage)): ?>
            <p style="color: red;"><?= $errorMessage ?></p>
        <?php endif; ?>

        <h3>Add New Ad</h3>
        <form method="post">
            <input type="text" name="title" placeholder="Ad Title" required>
            <textarea name="description" placeholder="Ad Description" required></textarea>
            <input type="text" name="image_url" placeholder="Image URL" required>
            <input type="text" name="link_url" placeholder="Target URL (e.g., https://example.com)" required>
            <input type="text" name="keywords" placeholder="Keywords (comma-separated)" required>
            <button type="submit">Add Ad</button>
        </form>

        <h3>Create New Admin</h3>
        <form method="post">
            <input type="text" name="new_admin_username" placeholder="New Admin Username" required>
            <input type="password" name="new_admin_password" placeholder="New Admin Password" required>
            <button type="submit" name="create_admin">Create Admin</button>
        </form>
    </div>

    <script>
        function toggleDarkMode() {
            document.body.classList.toggle("dark-mode");
            let mode = document.body.classList.contains("dark-mode") ? "dark" : "light";
            localStorage.setItem("theme", mode);
        }

        // Always load dark mode by default
        window.onload = function () {
            let theme = localStorage.getItem("theme");
            if (!theme) {
                theme = "dark";
                localStorage.setItem("theme", "dark");
            }
            if (theme === "dark") {
                document.body.classList.add("dark-mode");
            } else {
                document.body.classList.remove("dark-mode");
            }
        };
    </script>

</body>
</html>
