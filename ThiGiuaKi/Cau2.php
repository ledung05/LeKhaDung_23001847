<?php
$prices = [150000, 450000, 120000, 800000, 250000];

function calculateTotal($arr) {
    $total = 0;
    foreach ($arr as $price) {
        $total += $price;
    }
    return $total;
}

function findMaxPrice($arr) {
    $max = $arr[0];
    foreach ($arr as $price) {
        if ($price > $max) {
            $max = $price;
        }
    }
    return $max;
}

$tongGia = calculateTotal($prices);
$giaCaoNhat = findMaxPrice($prices);

echo "Tổng giá trị của tất cả sản phẩm là: " . number_format($tongGia) . "<br>";
echo "Giá sản phẩm cao nhất là: " . number_format($giaCaoNhat);
?>