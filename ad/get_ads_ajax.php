<?php
require 'get_ads.php';
$ads = getRelevantAds();

if (!empty($ads)) {
    foreach ($ads as $ad) {
        echo '<a href="' . htmlspecialchars($ad['link_url']) . '" target="_blank" class="ad-card">';
        echo '<div>';
        echo '<h3>' . htmlspecialchars($ad['title']) . '</h3>';
        echo '<img src="' . htmlspecialchars($ad['image_url']) . '" alt="Ad Image">';
        echo '<p>' . htmlspecialchars($ad['description']) . '</p>';
        echo '</div>';
        echo '</a>';
    }
} else {
    echo '<p>No ads available.</p>';
}
