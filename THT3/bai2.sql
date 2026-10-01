-- 0. Tạo database (nếu chưa có) và chọn sử dụng database
CREATE DATABASE IF NOT EXISTS movie_management;
USE movie_management;

-- 1. Tạo bảng movies
CREATE TABLE movies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    total_seats INT NOT NULL,
    available_seats INT NOT NULL
);

-- 2. Thực hiện các yêu cầu:

-- 1. Thêm ít nhất 5 bộ phim
INSERT INTO movies (title, price, total_seats, available_seats) VALUES
('Mai', 110000.00, 150, 40),
('Dune 2', 120000.00, 200, 80),
('Kung Fu Panda 4', 90000.00, 120, 30),
('Exhuma: Quật Mộ Trùng Phùng', 105000.00, 180, 60),
('Lật Mặt 7', 95000.00, 150, 20);

-- 2. Hiển thị toàn bộ danh sách phim
SELECT * FROM movies;

-- 3. Hiển thị phim có giá vé lớn hơn 100000
SELECT * FROM movies 
WHERE price > 100000;

-- 4. Hiển thị phim còn nhiều hơn 50 ghế
SELECT * FROM movies 
WHERE available_seats > 50;

-- 5. Sắp xếp phim theo giá vé giảm dần
SELECT * FROM movies 
ORDER BY price DESC;

-- 6. Cập nhật số ghế còn lại của một phim (Ví dụ: cập nhật phim có id = 1 còn 25 ghế)
UPDATE movies 
SET available_seats = 25 
WHERE id = 1;

-- 7. Xóa một phim (Ví dụ: xóa phim có id = 3)
DELETE FROM movies 
WHERE id = 3;

-- 8. Hiển thị số vé đã bán của từng phim: total_seats - available_seats
SELECT title, total_seats, available_seats, 
       (total_seats - available_seats) AS tickets_sold 
FROM movies;

-- 9. Tính doanh thu của từng phim: (total_seats - available_seats) * price
SELECT title, 
       ((total_seats - available_seats) * price) AS revenue 
FROM movies;

-- 10. Tính tổng doanh thu của tất cả các phim
SELECT SUM((total_seats - available_seats) * price) AS total_revenue 
FROM movies;

-- 11. Tìm phim có số vé bán ra nhiều nhất
SELECT title, (total_seats - available_seats) AS tickets_sold 
FROM movies 
ORDER BY tickets_sold DESC 
LIMIT 1;