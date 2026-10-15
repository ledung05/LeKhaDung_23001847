<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

require_once 'model/product.php';

$errors = [];
$name = '';
$price = '';
$quantity = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $quantity = trim($_POST['quantity']);

    // Validation
    if (empty($name)) {
        $errors[] = 'Tên sản phẩm không được để rỗng.';
    }
    if (!is_numeric($price) || $price <= 0) {
        $errors[] = 'Giá phải là số lớn hơn 0.';
    }
    if (!is_numeric($quantity) || $quantity < 0) {
        $errors[] = 'Số lượng phải là số lớn hơn hoặc bằng 0.';
    }

    if (empty($errors)) {
        if (addProduct($name, $price, $quantity)) {
            header('Location: product_list.php');
            exit();
        } else {
            $errors[] = 'Thêm sản phẩm thất bại!';
        }
    }
}

include 'view/header.php';
?>

<h3>Thêm sản phẩm mới</h3>
<p><a href="product_list.php"> Quay lại danh sách</a></p>

<?php if (!empty($errors)): ?>
    <div style="color: red;">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="product_add.php" method="POST">
    <p>
        <label>Tên sản phẩm:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
    </p>
    <p>
        <label>Giá sản phẩm:</label><br>
        <input type="text" name="price" value="<?php echo htmlspecialchars($price); ?>">
    </p>
    <p>
        <label>Số lượng:</label><br>
        <input type="number" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
    </p>
    <button type="submit">Lưu sản phẩm</button>
</form>

<?php include 'view/footer.php'; ?>