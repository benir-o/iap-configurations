<?php
require "C:/Apache24/htdocs/iap-configurations/Global/databaseOperations.php";
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /iap-configurations/index.php");
    exit;
}
$dbaseObject1->authenticateUser();
