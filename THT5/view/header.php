<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hệ thống Quản lý Giỏ hàng</title>
</head>
<body>
    <h2>HỆ THỐNG QUẢN LÝ THÔNG TIN GIỎ HÀNG</h2>
    <hr>
    <?php if (isset($_SESSION['user'])): ?>
        <p>Xin chào, <strong><?php echo htmlspecialchars($_SESSION['user']['username']); ?></strong> | <a href="logout.php">Đăng xuất</a></p>
        <hr>
    <?php endif; ?>