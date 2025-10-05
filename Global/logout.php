<?php
require "../classAutoLoad.php";
session_start();
global $conn;

// Close the database connection if it exists
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}

// Destroy the session
session_destroy();

// Redirect to the default page
header("Location: /iap-configurations/index.php");
exit;
