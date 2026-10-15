<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

require_once 'model/product.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: product_list.php');
    exit();
}

$product = getProductById($id);

if (!$product) {
    include 'view/header.php';
    echo "<h3>Lỗi</h3>";
    echo "<p style='color:red;'>Sản phẩm không tồn tại hoặc đã bị xóa trước đó!</p>";
    echo "<p><a href='product_list.php'>Quay lại danh sách sản phẩm</a></p>";
    include 'view/footer.php';
    exit();
} else {
    deleteProduct($id);
    header('Location: product_list.php');
    exit();
}
?>