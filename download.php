<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require("ServerManager.php");
$serverManager = new ServerManager();
$allowedFiles = array("1122pack.zip", "1182world.zip", "1710pack.zip", "247minecraft.zip", "atm6world.zip", "atm8world.zip");

if (isset($_GET['file']) && in_array($_GET['file'], $allowedFiles)) {
    $file_name = $_GET['file'];
    $filePath = __DIR__  . "/static/" . $_GET['file'];
    $ip_address = $_SERVER['HTTP_CF_CONNECTING_IP'];
    $serverManager->logDownload($file_name, $ip_address);

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
} else {
    header("HTTP/1.0 404 Not Found");
    exit;
}
?>
