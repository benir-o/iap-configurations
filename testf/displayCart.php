<?php
include 'C://Apache24/htdocs/iap-configurations/conf.php';
header("Content-Type: application/json");
$user_id = $_GET['user_id'] ?? null;

if (!$user_id) {
    echo json_encode(["error" => "Missing user_id"]);
    exit;
}

$sql = "
    SELECT 
        b.book_name,
        b.author,
        b.book_price,
        COUNT(c.ref_no) AS quantity,
        (b.book_price * COUNT(c.ref_no)) AS total_price
    FROM cart c
    JOIN book b ON c.ref_no = b.ref_no
    WHERE c.cart_id = ?
    GROUP BY b.book_name, b.author, b.book_price
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];

while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

echo json_encode($cartItems);

$stmt->close();
$conn->close();
