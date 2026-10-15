<?php
require_once __DIR__ . '/../common/dbConnect.php';

function getAllProducts() {
    global $conn;
    $sql = "SELECT * FROM products ORDER BY id DESC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getProductById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function addProduct($name, $price, $quantity) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO products (name, price, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $name, $price, $quantity);
    return $stmt->execute();
}

function updateProduct($id, $name, $price, $quantity) {
    global $conn;
    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, quantity = ? WHERE id = ?");
    $stmt->bind_param("sdii", $name, $price, $quantity, $id);
    return $stmt->execute();
}

function deleteProduct($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>