<?php
header('Content-Type: application/json'); // send response as JSON
require 'C://Apache24/htdocs/iap-configurations/conf.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookName = trim($_POST['bookName'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $book_price = trim($_POST['price'] ?? '');
    $quantity = trim($_POST['quantity'] ?? '');

    if ($bookName === '' || $author === '' || $book_price === '' || $quantity <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
        exit;
    }

    // Use prepared statement for safety
    $stmt = $conn->prepare("INSERT INTO book (book_name, author, book_price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $bookName, $author, $book_price);

    $successCount = 0;

    for ($i = 0; $i < $quantity; $i++) {
        if ($stmt->execute()) {
            $successCount++;
        }
    }
    $stmt->close();
    $conn->close();

    if ($successCount > 0) {
        echo json_encode(['status' => 'success', 'message' => "$successCount copies of '$bookName' added successfully!"]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No records inserted.']);
    }
}
