<?php
// session_start();
// $user_id = $_SESSION['user_id'] ?? null;
// $user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : null;
include "C://Apache24/htdocs/iap-configurations/conf.php";
$book_name = $_POST['book_name'];
$author    = $_POST['author'];
$user_id = 1;

if ($book_name === '' || $author === '') {
    echo json_encode(['success' => false, 'message' => 'INVALID_INPUT']);
    exit;
}

try {
    $conn->begin_transaction();

    // 1) find the highest ref_no for this user and this book (lock it)
    $stmt = $conn->prepare(
        "SELECT c.ref_no
         FROM cart c
         JOIN book b ON c.ref_no = b.ref_no
         WHERE c.cart_id = ? AND b.book_name = ? AND b.author = ?
         ORDER BY c.ref_no DESC
         LIMIT 1
         FOR UPDATE"
    );
    $stmt->bind_param("iss", $user_id, $book_name, $author);
    $stmt->execute();
    $stmt->bind_result($ref_no);
    $found = $stmt->fetch();
    $stmt->close();

    if (!$found || !$ref_no) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'OUT_OF_STOCK_OR_NOT_IN_CART']);
        exit;
    }

    // 2) We then delete that specific cart row
    $del = $conn->prepare("DELETE FROM cart WHERE cart_id = ? AND ref_no = ? LIMIT 1");
    $del->bind_param("ii", $user_id, $ref_no);
    $del->execute();
    if ($del->affected_rows === 0) {
        $del->close();
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'DELETE_FAILED']);
        exit;
    }
    $del->close();

    // 3) mark the book copy available again
    $upd = $conn->prepare("UPDATE book SET is_available = 1 WHERE ref_no = ?");
    $upd->bind_param("i", $ref_no);
    $upd->execute();
    $upd->close();

    // 4) recompute aggregated cart for this specific user and return it
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


    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();
    $res = $stmt2->get_result();
    $cart = [];
    while ($row = $res->fetch_assoc()) {
        $cart[] = $row;
    }
    $stmt2->close();

    $conn->commit();

    echo json_encode(['success' => true, 'cart' => $cart]);
} catch (Exception $e) {
    $conn->rollback();
    // Log $e->getMessage() on server; avoid exposing internal errors in production
    echo json_encode(['success' => false, 'message' => 'ERROR', 'detail' => $e->getMessage()]);
}
