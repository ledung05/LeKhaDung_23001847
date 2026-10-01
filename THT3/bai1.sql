-- 0. Tạo database và sử dụng database
CREATE DATABASE IF NOT EXISTS shopping_cart;
USE shopping_cart;

-- 1. Tạo bảng cart_items
CREATE TABLE cart_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL
);

-- 2. Thực hiện các yêu cầu:

-- 1. Thêm ít nhất 5 sản phẩm vào bảng
INSERT INTO cart_items (name, price, quantity) VALUES
('Áo sơ mi', 150000.00, 3),
('Quần jean', 250000.00, 2),
('Giày thể thao', 500000.00, 10),
('Tất cổ ngắn', 20000.00, 8),
('Mũ bảo hiểm', 80000.00, 4);

-- 2. Hiển thị toàn bộ sản phẩm
SELECT * FROM cart_items;

-- 3. Hiển thị sản phẩm có giá lớn hơn 100000
SELECT * FROM cart_items 
WHERE price > 100000;

-- 4. Hiển thị sản phẩm có số lượng lớn hơn 5
SELECT * FROM cart_items 
WHERE quantity > 5;

-- 5. Sắp xếp sản phẩm theo giá giảm dần
SELECT * FROM cart_items 
ORDER BY price DESC;

-- 6. Cập nhật giá của một sản phẩm (Ví dụ: cập nhật giá sản phẩm có id = 1 thành 180000)
UPDATE cart_items 
SET price = 180000.00 
WHERE id = 1;

-- 7. Cập nhật số lượng của một sản phẩm (Ví dụ: cập nhật số lượng sản phẩm có id = 2 thành 5)
UPDATE cart_items 
SET quantity = 5 
WHERE id = 2;

-- 8. Xóa một sản phẩm (Ví dụ: xóa sản phẩm có id = 4)
DELETE FROM cart_items 
WHERE id = 4;

-- 9. Hiển thị tên sản phẩm, giá, số lượng và thành tiền (price * quantity)
SELECT name, price, quantity, (price * quantity) AS thanh_tien 
FROM cart_items;

-- 10. Tính tổng tiền của toàn bộ giỏ hàng
SELECT SUM(price * quantity) AS tong_tien_gio_hang 
FROM cart_items;
