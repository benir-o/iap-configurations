<?php
require "C://Apache24/htdocs/iap-configurations/conf.php"; // adjust path as needed

header("Content-Type: application/json");

$query = $_POST['query'] ?? ''; // optional search term

if ($query !== '') {
    $stmt = $conn->prepare("SELECT id, username, email FROM users WHERE username LIKE ?");
    $like = "%$query%";
    $stmt->bind_param("s", $like);
} else {
    $stmt = $conn->prepare("SELECT id, username, email FROM bokstore_users");
}

$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
$stmt->close();
$conn->close();
