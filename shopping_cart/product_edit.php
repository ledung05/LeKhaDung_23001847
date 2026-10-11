<?php
require_once 'model/product.php';

$id = $_GET['id'] ?? 0;
$product = getProductById($id);

if (!$product) {
    die("Sản phẩm không tồn tại!");
}

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
        if (updateProduct($id, $name, $price, $quantity)) {
            header("Location: product_list.php");
            exit();
        } else {
            $error = "Có lỗi xảy ra khi cập nhật sản phẩm!";
        }
    }
} else {
    $name = $product['name'];
    $price = $product['price'];
    $quantity = $product['quantity'];
}

include 'view/header.php';
?>

<h3>Chỉnh sửa sản phẩm</h3>

<?php if ($error): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<form action="product_edit.php?id=<?php echo $id; ?>" method="POST">
    <p>
        <label>Tên sản phẩm:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
    </p>
    <p>
        <label>Giá:</label><br>
        <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($price); ?>">
    </p>
    <p>
        <label>Số lượng:</label><br>
        <input type="number" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
    </p>
    <p>
        <button type="submit">Cập nhật</button>
        <a href="product_list.php">Hủy</a>
    </p>
</form>

<?php include 'view/footer.php'; ?>