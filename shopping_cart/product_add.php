<?php
require_once 'model/product.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = $_POST['price'] ?? 0;
    $quantity = $_POST['quantity'] ?? 0;

    // Validation
    if (empty($name)) {
        $error = "Tên sản phẩm không được để rỗng!";
    } elseif ($price <= 0) {
        $error = "Giá sản phẩm phải lớn hơn 0!";
    } elseif ($quantity < 0) {
        $error = "Số lượng sản phẩm phải lớn hơn hoặc bằng 0!";
    } else {
        if (addProduct($name, $price, $quantity)) {
            header("Location: product_list.php");
            exit();
        } else {
            $error = "Có lỗi xảy ra khi thêm sản phẩm!";
        }
    }
}

include 'view/header.php';
?>

<h3>Thêm sản phẩm mới</h3>

<?php if ($error): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<form action="product_add.php" method="POST">
    <p>
        <label>Tên sản phẩm:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
    </p>
    <p>
        <label>Giá:</label><br>
        <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>">
    </p>
    <p>
        <label>Số lượng:</label><br>
        <input type="number" name="quantity" value="<?php echo htmlspecialchars($_POST['quantity'] ?? ''); ?>">
    </p>
    <p>
        <button type="submit">Thêm sản phẩm</button>
        <a href="product_list.php">Quay lại</a>
    </p>
</form>

<?php include 'view/footer.php'; ?>