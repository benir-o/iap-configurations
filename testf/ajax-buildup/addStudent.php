<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "ManCity@254";
$dbname = "basedata5";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed."]));
}

// Get data from AJAX (POST)
$name = $_POST['name'] ?? '';
$age = $_POST['age'] ?? '';
$campus = $_POST['campus'] ?? '';

// Simple validation
if (empty($name) || empty($age) || empty($campus)) {
    echo json_encode(["success" => false, "message" => "Missing data."]);
    exit;
}

// Insert into DB
$sql = "INSERT INTO students (name, age, campus) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sis", $name, $age, $campus);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Student added successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Error adding student."]);
}

$stmt->close();
$conn->close();
