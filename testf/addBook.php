<?php
header("Content-Type: application/json");
include "/iap-configurations/conf.php"; // your database connection

$book_name = $_POST['book_name'] ?? '';
$author = $_POST['author'] ?? '';
$price = $_POST['price'] ?? '';

if (empty($book_name) || empty($author) || empty($price)) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

try {

    $stmt = $conn->prepare("INSERT INTO book (book_name, author, book_price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $book_name, $author, $price);
    $stmt->execute();

    echo json_encode(["success" => true, "message" => "Book added successfully!"]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
}

$conn->close();
