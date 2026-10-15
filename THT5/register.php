<?php
session_start();
require_once 'model/user.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = 'Vui lòng điền đầy đủ thông tin!';
    } elseif (getUserByUsername($username)) {
        $error = 'Tên đăng nhập đã tồn tại, vui lòng chọn tên khác!';
    } else {
        if (registerUser($username, $password)) {
            echo "<script>alert('Đăng ký thành công! Chuyển hướng tới trang đăng nhập.'); window.location.href='login.php';</script>";
            exit();
        } else {
            $error = 'Đã xảy ra lỗi trong quá trình đăng ký!';
        }
    }
}

include 'view/header.php';
?>

<h3>Đăng ký tài khoản</h3>
<?php if ($error): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<form action="register.php" method="POST">
    <p>
        <label>Tên đăng nhập:</label><br>
        <input type="text" name="username" required>
    </p>
    <p>
        <label>Mật khẩu:</label><br>
        <input type="password" name="password" required>
    </p>
    <button type="submit">Đăng ký</button>
</form>
<p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>

<?php include 'view/footer.php'; ?>