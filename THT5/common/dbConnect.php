<?php
$host = "127.0.0.1"; 
$username = "root";
$password = "";     
$dbname = "shopping_cart";
$port = 3308;        

$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Kết nối database thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>