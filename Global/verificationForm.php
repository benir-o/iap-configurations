<?php
require_once "../classAutoLoad.php";
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: /iap-configurations/index.php");
}
$dbaseObject->authenticateUser();
