<?php
require_once 'model/product.php';

$id = $_GET['id'] ?? 0;
$product = getProductById($id);

if (!$product) {
    include 'view/header.php';
    echo "<h3>Lỗi</h3>";
    echo "<p style='color:red;'>Sản phẩm không tồn tại hoặc đã bị xóa!</p>";
    echo "<a href='product_list.php'>Quay lại danh sách</a>";
    include 'view/footer.php';
    exit();
}

if (deleteProduct($id)) {
    header("Location: product_list.php");
    exit();
} else {
    include 'view/header.php';
    echo "<p style='color:red;'>Xóa sản phẩm thất bại!</p>";
    echo "<a href='product_list.php'>Quay lại danh sách</a>";
    include 'view/footer.php';
}
?>