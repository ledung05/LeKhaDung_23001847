<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "shopping_cart";
$port = 3308;

// Tắt thông báo exception mặc định của mysqli
mysqli_report(MYSQLI_REPORT_OFF);

// Kết nối bao gồm tham số port
$conn = @new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Kết nối database thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>