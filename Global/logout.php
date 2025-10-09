<?php
require "../classAutoLoad.php";
session_start();
global $conn;

// Close the database connection if it exists
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}
if (isset($_SERVER['REQUEST_METHOD'])) {
    session_destroy();
    header("Location: /iap-configurations/index.php");
}


// Destroy the session

// Redirect to the default page
