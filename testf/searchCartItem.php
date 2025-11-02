<?php
require_once "C://Apache24/htdocs/iap-configurations/conf.php"; // your database connection

// $search = $_GET['search'] ?? '';
$query = isset($_GET['search']) ? $_GET['search'] : '';

// $sql = "SELECT * FROM cart WHERE 1";
$sql  = "
    SELECT 
        b.book_name,
        b.author,
        b.book_price,
        COUNT(c.ref_no) AS quantity,
        (b.book_price * COUNT(c.ref_no)) AS total_price
    FROM cart c
    JOIN book b ON c.ref_no = b.ref_no
    WHERE 1
";

if (!empty($query)) {
    $sql .= " AND (book_name LIKE '%$query%' OR author LIKE '%$query%')";
    $sql .= " GROUP BY b.book_name,b.author,b.book_price";
}


$stmt = $conn->prepare($sql);

if (!empty($sql)) {
    //     $searchParam = "%$query%";
    //     $stmt->bind_param("ss", $searchParam, $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();

    $cartItems = [];
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }
    echo json_encode($cartItems);
}

// $stmt->execute();
// $result = $stmt->get_result();

// $cartItems = [];
// while ($row = $result->fetch_assoc()) {
//     $cartItems[] = $row;
// }

// echo json_encode($cartItems);
