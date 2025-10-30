<?php
// Only allow AJAX requests
if (
    !isset($_SERVER['HTTP_X_REQUESTED_WITH']) ||
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
) {
    die('Access denied');
}

//Specify the contents to be returned
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "";      // change if needed
$password = "";          // change if needed
$dbname = "";   // change to your actual DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed."]));
}

$sql = "SELECT name, age, campus FROM students";
$result = $conn->query($sql);

$students = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

$conn->close();

// Output JSON
echo json_encode(["students" => $students]);
