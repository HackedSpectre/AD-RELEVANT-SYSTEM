<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user data
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $_SESSION['admin'] = $user['username'];
        header("Location: admin.php");
        exit();
    } else {
        echo "<p style='color: red; text-align: center;'>Invalid credentials</p>";
    }
}
?>
<?php if (isset($_GET['logged_out'])): ?>
    <p style="color: green; text-align: center;">✅ You have been logged out successfully.</p>
<?php endif; ?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="dark-mode">
    <div style="text-align: center; margin-top: 20px;">
        <a href="index.php" style="background: #007bff; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">🏠 Home</a>
    </div>
    <div id="dark-mode-toggle">
        <button onclick="toggleDarkMode()">🌙 Toggle Dark Mode</button>
    </div>
    <div class="container">
        <h2>Admin Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
       function toggleDarkMode() {
                document.body.classList.toggle("dark-mode");
                let mode = document.body.classList.contains("dark-mode") ? "dark" : "light";
                localStorage.setItem("theme", mode);
            }

            // Apply dark mode on load
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
