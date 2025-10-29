<?php
session_start();
header('Content-Type: application/json');

// Database connection
$host = "localhost";
$username = "";
$password = "";
$database = "";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Get or create user session
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1; //For testing purposes we put our user_id to 1
}

$user_id = $_SESSION['user_id'];
$action = $_GET['action'] ?? '';

switch ($action) {

    case 'add':
        // Add book to cart
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['ref_no'])) {
            echo json_encode(['success' => false, 'message' => 'ref_no is required']);
            exit;
        }

        $ref_no = $input['ref_no'];
        // $quantity = isset($input['quantity']) ? (int)$input['quantity'] : 1;

        // Validate book exists in books table
        $stmt = $conn->prepare("SELECT ref_no, title FROM books WHERE ref_no = ?");
        $stmt->bind_param("s", $ref_no);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo json_encode(['success' => false, 'message' => 'Book not found']);
            exit;
        }

        $book = $result->fetch_assoc();

        // Check if book already in cart
        $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = ? AND ref_no = ?");
        $stmt->bind_param("is", $user_id, $ref_no);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Book already in cart - update quantity
            $row = $result->fetch_assoc();
            // $new_quantity = $row['quantity'] + $quantity;

            $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND ref_no = ?");
            $stmt->bind_param("iis", $new_quantity, $user_id, $ref_no);

            if ($stmt->execute()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Quantity updated',
                    'action' => 'updated',
                    'quantity' => $new_quantity
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update quantity']);
            }
        } else {
            // Book not in cart - insert new
            $stmt = $conn->prepare("INSERT INTO cart (user_id, ref_no, quantity) VALUES (?, ?, ?)");
            $stmt->bind_param("isi", $user_id, $ref_no, $quantity);

            if ($stmt->execute()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Book added to cart',
                    'action' => 'added',
                    'book_title' => $book['title']
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add to cart: ' . $conn->error]);
            }
        }
        break;

    case 'get':
        // Get all cart items for this user
        $stmt = $conn->prepare("
            SELECT 
                c.id as cart_id,
                c.ref_no,
                c.quantity,
                c.added_at,
                b.title,
                b.author,
                b.price
            FROM cart c
            INNER JOIN books b ON c.ref_no = b.ref_no
            WHERE c.user_id = ?
            ORDER BY c.added_at DESC
        ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $items = [];
        $total = 0;

        while ($row = $result->fetch_assoc()) {
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;

            $items[] = [
                'cart_id' => $row['cart_id'],
                'ref_no' => $row['ref_no'],
                'title' => $row['title'],
                'author' => $row['author'],
                'price' => number_format($row['price'], 2),
                'quantity' => (int)$row['quantity'],
                'subtotal' => number_format($subtotal, 2)
            ];
        }

        echo json_encode([
            'success' => true,
            'items' => $items,
            'count' => count($items),
            'total' => number_format($total, 2)
        ]);
        break;

    case 'remove':
        // Remove item from cart
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['ref_no'])) {
            echo json_encode(['success' => false, 'message' => 'ref_no is required']);
            exit;
        }

        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND ref_no = ?");
        $stmt->bind_param("is", $user_id, $input['ref_no']);

        if ($stmt->execute() && $stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Item removed from cart']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Item not found in cart']);
        }
        break;

    case 'clear':
        // Clear entire cart
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Cart cleared']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to clear cart']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

$stmt->close();
$conn->close();
