<?php
header("Content-Type: text/plain");
include 'C:/Apache24/htdocs/iap-configurations/conf.php'; // your database connection file

$user_id = $_POST['user_id'] ?? null;
$ref_no  = $_POST['ref_no'] ?? null;

if ($user_id && $ref_no) {
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO cart (cart_id, ref_no) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $ref_no);

    if ($stmt->execute()) {
        echo "Book added to cart successfully!";
    } else {
        echo "Error adding to cart.";
    }

    $stmt->close();
} else {
    echo "Invalid input.";
}

$conn->close();
