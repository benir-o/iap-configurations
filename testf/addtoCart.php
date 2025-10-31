<?php
header("Content-Type: text/plain");
include 'C://Apache24/htdocs/iap-configurations/conf.php';

$user_id = $_POST['user_id'] ?? null;
$book_name = $_POST['book_name'] ?? null;
$author  = $_POST['author'] ?? null;

if (!$user_id || !$book_name || !$author) {
    echo "INVALID_INPUT";
    exit;
}

$conn->begin_transaction();

try {
    // Step 1: Find the next available copy (is_available = 1)
    $stmt = $conn->prepare("SELECT ref_no FROM book WHERE book_name=? AND author=? AND is_available=1 ORDER BY ref_no ASC LIMIT 1 FOR UPDATE");
    $stmt->bind_param("ss", $book_name, $author);
    $stmt->execute();
    $stmt->bind_result($ref_no);
    $stmt->fetch();
    $stmt->close();

    if (!$ref_no) {
        echo "OUT_OF_STOCK";
        $conn->rollback();
        exit;
    }

    // Step 2: Mark that copy as taken
    $stmt = $conn->prepare("UPDATE book SET is_available=0 WHERE ref_no=?");
    $stmt->bind_param("i", $ref_no);
    $stmt->execute();
    $stmt->close();

    // Step 3: Add that ref_no to the cart
    $stmt = $conn->prepare("INSERT INTO cart (cart_id, ref_no) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $ref_no);
    $stmt->execute();
    $stmt->close();

    $conn->commit();
    echo "ADDED";
} catch (Exception $e) {
    $conn->rollback();
    echo "ERROR: " . $e->getMessage();
}

$conn->close();
