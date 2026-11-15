<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 1. Kết nối cơ sở dữ liệu bằng PDO
$host = 'localhost';
$dbname = 'quan_ly_san_pham';
$username = 'root';
$password = ''; // Mặc định của XAMPP là rỗng

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Lỗi kết nối cơ sở dữ liệu: ' . $e->getMessage()
    ]);
    exit;
}

// Hàm kiểm tra dữ liệu đầu vào (Validation)
function validateProduct($data) {
    if (!isset($data['name']) || !isset($data['price']) || !isset($data['stock'])) {
        return "Vui lòng nhập đầy đủ tên, đơn giá và số lượng tồn.";
    }

    $name = trim((string)$data['name']);
    $len = mb_strlen($name, 'UTF-8');
    if ($len < 1 || $len > 100) {
        return "Tên sản phẩm phải từ 1 đến 100 ký tự.";
    }

    // Kiểm tra số nguyên hợp lệ
    $price = filter_var($data['price'], FILTER_VALIDATE_INT);
    if ($price === false || $price <= 0) {
        return "Đơn giá phải là số nguyên lớn hơn 0.";
    }

    $stock = filter_var($data['stock'], FILTER_VALIDATE_INT);
    if ($stock === false || $stock < 0) {
        return "Số lượng tồn phải là số nguyên không âm.";
    }

    return null; // Hợp lệ
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    // 2. Lấy danh sách sản phẩm
    case 'GET':
        $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode([
            'success' => true,
            'data' => $products
        ]);
        break;

    // 3. Thêm sản phẩm mới
    case 'POST':
        $input = json_decode(file_get_contents("php://input"), true);
        if (!is_array($input)) {
            echo json_encode(['success' => false, 'message' => 'Dữ liệu JSON không hợp lệ.']);
            exit;
        }

        $error = validateProduct($input);
        if ($error !== null) {
            echo json_encode(['success' => false, 'message' => $error]);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO products (name, price, stock) VALUES (:name, :price, :stock)");
        $stmt->execute([
            ':name' => trim($input['name']),
            ':price' => (int)$input['price'],
            ':stock' => (int)$input['stock']
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Thêm sản phẩm thành công.'
        ]);
        break;

    // 4. Cập nhật sản phẩm theo id trên URL
    case 'PUT':
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : false;
        if ($id === false || $id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Mã sản phẩm (ID) không hợp lệ.']);
            exit;
        }

        // Kiểm tra sản phẩm có tồn tại không
        $checkStmt = $pdo->prepare("SELECT id FROM products WHERE id = :id");
        $checkStmt->execute([':id' => $id]);
        if (!$checkStmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm để cập nhật.']);
            exit;
        }

        $input = json_decode(file_get_contents("php://input"), true);
        if (!is_array($input)) {
            echo json_encode(['success' => false, 'message' => 'Dữ liệu JSON không hợp lệ.']);
            exit;
        }

        $error = validateProduct($input);
        if ($error !== null) {
            echo json_encode(['success' => false, 'message' => $error]);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE products SET name = :name, price = :price, stock = :stock WHERE id = :id");
        $stmt->execute([
            ':name' => trim($input['name']),
            ':price' => (int)$input['price'],
            ':stock' => (int)$input['stock'],
            ':id' => $id
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Cập nhật sản phẩm thành công.'
        ]);
        break;

    // 5. Xóa sản phẩm theo id trên URL
    case 'DELETE':
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : false;
        if ($id === false || $id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Mã sản phẩm (ID) không hợp lệ.']);
            exit;
        }

        $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);

        if ($stmt->rowCount() === 0) {
            echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại hoặc đã bị xóa.']);
        } else {
            echo json_encode(['success' => true, 'message' => 'Xóa sản phẩm thành công.']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Phương thức không được hỗ trợ.']);
        break;
}