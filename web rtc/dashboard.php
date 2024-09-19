<?php
// dashboard.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

echo "<h2>Welcome, " . $_SESSION['user_name'] . "!</h2>";
echo "<p><a href='logout.php'>Logout</a></p>";
