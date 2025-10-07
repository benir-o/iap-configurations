<?php
session_start();
require_once '../classAutoLoad.php';
// if (!isset($_SESSION['can_access_validateinsertion']) && !isset($_SESSION['can_access_validateselection'])) {
//     header("Location: /iap-configurations/index.php");
//     exit;
// }
$dbaseObject->databaseinsertion();
$dbaseObject->displayUsers();
