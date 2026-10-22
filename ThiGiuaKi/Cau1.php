<?php
$name = "Lê Khả Dũng";
$score = 7.5;

if ($score >= 8) {
    $rank = "Giỏi";
} elseif ($score >= 6.5) {
    $rank = "Khá";
} elseif ($score >= 5) {
    $rank = "Trung bình";
} else {          
    $rank = "Yếu";
}

echo "Học sinh: " . $name . "<br>";
echo "Điểm số: " . $score . "<br>";
echo "Xếp loại: " . $rank;
?>


