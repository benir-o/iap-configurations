<?php
header('Content-Type: application/json');
require 'C://Apache24/htdocs/iap-configurations/conf.php';

$sql = "SELECT id, username, email FROM bookstore_users";
$result = $conn->query($sql);

$users = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

echo json_encode($users);

$conn->close();
