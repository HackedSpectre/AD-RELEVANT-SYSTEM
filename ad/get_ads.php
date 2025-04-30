<?php
require 'db.php';

function getRelevantAds() {
    global $conn;
    session_start();
    $session_id = session_id();

    // Fetch the latest 5 activities for the session
    $stmt = $conn->prepare("SELECT activity FROM user_activity WHERE session_id = ? ORDER BY timestamp DESC LIMIT 5");
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $keywords = [];
    while ($row = $result->fetch_assoc()) {
        $words = preg_split('/[\s,]+/', strtolower($row['activity']));
        $keywords = array_merge($keywords, $words);
    }

    if (empty($keywords)) {
        return [];
    }

    // Prepare SQL query with placeholders
    $placeholders = implode(' OR ', array_fill(0, count($keywords), 'keywords LIKE ?'));
    $sql = "SELECT * FROM ads WHERE $placeholders";
    $stmt = $conn->prepare($sql);

    // Bind parameters dynamically
    $types = str_repeat('s', count($keywords));
    $params = array_map(function($kw) {
        return '%' . $kw . '%';
    }, $keywords);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>
