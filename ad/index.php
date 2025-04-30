<?php
require 'get_ads.php';
$ads = getRelevantAds();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ads System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="dark-mode">
    <div id="dark-mode-toggle">
        <button onclick="toggleDarkMode()">🌙 Toggle Dark Mode</button>
    </div>

    <!-- Admin Login Button -->
    <div class="navbar">
        <a href="login.php" class="admin-login-btn">🔑 Admin Login</a>
    </div>

    <!-- Search Form -->
    <div class="container">
        <form id="search-form" onsubmit="submitSearch(event)">
            <input type="text" id="search-input" placeholder="Search for something..." required>
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="button-center">
        <button onclick="clearHistory()" class="clear-history-btn">🧹 Clear Search History</button>
    </div>

    <div class="container">
        <h2>Relevant Ads</h2>
        <div id="ads-container">
            <?php if (!empty($ads)): ?>
                <?php foreach ($ads as $ad): ?>
                    <a href="<?= htmlspecialchars($ad['link_url']) ?>" target="_blank" class="ad-card">
                        <div>
                            <h3><?= htmlspecialchars($ad['title']) ?></h3>
                            <img src="<?= htmlspecialchars($ad['image_url']) ?>" alt="Ad Image">
                            <p><?= htmlspecialchars($ad['description']) ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No ads available.</p>
            <?php endif; ?>
        </div>
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

        function trackActivity(activity) {
            fetch('track.php', {
                method: 'POST',
                body: new URLSearchParams({ activity })
            }).then(res => res.text()).then(data => {
                console.log("Tracked:", activity);
            });
        }

        function submitSearch(event) {
            event.preventDefault();
            const input = document.getElementById("search-input");
            const query = input.value.trim();
            if (query !== "") {
                trackActivity(query);
                setTimeout(() => location.reload(), 300); // Wait before reload to log activity
            }
        }
        function clearHistory() {
            fetch('clear_history.php')
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload(); // Refresh the page to reflect cleared history
                });
        }
        function fetchAds() {
            fetch('get_ads_ajax.php')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('ads-container').innerHTML = html;
                });
        }

        // Refresh ads every 5 seconds
        setInterval(fetchAds, 5000);
    </script>
</body>
</html>
