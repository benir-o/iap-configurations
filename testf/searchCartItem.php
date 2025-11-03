<?php
require_once "C://Apache24/htdocs/iap-configurations/conf.php"; // your database connection

$query = $_GET['search'];

$sql = "
    SELECT 
        b.book_name,
        b.author,
        b.book_price,
        COUNT(c.ref_no) AS quantity,
        (b.book_price * COUNT(c.ref_no)) AS total_price
    FROM cart c
    JOIN book b ON c.ref_no = b.ref_no
";

if (!empty($query)) {
    $sql .= " WHERE (b.book_name LIKE ? OR b.author LIKE ?)";
    $sql .= " GROUP BY b.book_name, b.author, b.book_price";

    $stmt = $conn->prepare($sql);
    $searchParam = "%$query%";
    $stmt->bind_param("ss", $searchParam, $searchParam); // Two placeholders now

} else {
    $sql .= " GROUP BY b.book_name, b.author, b.book_price";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}
echo json_encode($cartItems);
