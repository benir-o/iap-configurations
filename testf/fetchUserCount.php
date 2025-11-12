<?php
header('Content-Type: application/json');
require 'C://Apache24/htdocs/iap-configurations/conf.php';

$response = ["success" => false, "count" => 0];

$sql = "SELECT COUNT(*) AS total FROM bookstore_users";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    $response["success"] = true;
    $response["count"] = (int)$row["total"];
} else {
    $response["message"] = "Failed to fetch user count.";
}

echo json_encode($response);

$conn->close();
