<?php
session_start();
require_once 'model/user.php';

if (isset($_SESSION['user'])) {
    header('Location: product_list.php');
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = 'Vui lòng điền đầy đủ tên đăng nhập và mật khẩu!';
    } else {
        $user = getUserByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username']
            ];
            header('Location: product_list.php');
            exit();
        } else {
            $error = 'Tên đăng nhập hoặc mật khẩu không chính xác!';
        }
    }
}

include 'view/header.php';
?>

<h3>Đăng nhập</h3>
<?php if ($error): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<form action="login.php" method="POST">
    <p>
        <label>Tên đăng nhập:</label><br>
        <input type="text" name="username" required>
    </p>
    <p>
        <label>Mật khẩu:</label><br>
        <input type="password" name="password" required>
    </p>
    <button type="submit">Đăng nhập</button>
</form>
<p>Chưa có tài khoản? <a href="register.php">Đăng ký tại đây</a></p>

<?php include 'view/footer.php'; ?>