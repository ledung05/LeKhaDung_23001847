<?php

$students = [
    [
        "name" => 'Nguyen Van A',
        "age" => 20,
        "score" => 8.5
    ],
    [
        "name" => "Tran Thi Binh",
        "age" => 21,
        "score" => 6.5
    ],
    [
        "name" => "Le Van Cuong",
        "age" => 19,
        "score" => 4.5
    ],
    [
        "name" => "Pham Thi Dung",
        "age" => 20,
        "score" => 7.5
    ]
];

// Hàm 1: Tính và trả về điểm trung bình của danh sách sinh viên
function calculateAverageScore($students) {
    if (empty($students)) {
        return 0;
    }
    $totalScore = 0;
    foreach ($students as $student) {
        $totalScore += $student['score'];
    }
    return $totalScore / count($students);
}

// Hàm 2: Trả về xếp loại của sinh viên dựa trên điểm số
function getRank($score) {
    if ($score >= 8.0) {
        return "Giỏi";
    } elseif ($score >= 6.5) {
        return "Khá";
    } elseif ($score >= 5.0) {
        return "Trung bình";
    } else {
        return "Yếu";
    }
}

// Hàm 3: Hiển thị thông tin một sinh viên
function displayStudent($student) {
    $rank = getRank($student['score']);
    echo "Họ tên: " . $student['name'] . " | Tuổi: " . $student['age'] . " | Điểm: " . $student['score'] . " | Xếp loại: " . $rank . "<br>";
}


// Gọi hàm displayStudent cho từng sinh viên
foreach ($students as $student) {
    displayStudent($student);
}
// Gọi hàm calculateAverageScore để lấy điểm trung bình
$avgScore = calculateAverageScore($students);
echo "Điểm trung bình cả lớp: " . round($avgScore, 2);

?>