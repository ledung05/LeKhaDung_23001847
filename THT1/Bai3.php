<?php
// Mảng danh sách sinh viên mẫu
$students = [
    ["name" => "Nguyen Van A", "age" => 20, "score" => 8.5],
    ["name" => "Tran Thi Binh", "age" => 21, "score" => 6.5],
    ["name" => "Le Van Cuong", "age" => 19, "score" => 4.5],
    ["name" => "Pham Thi Dung", "age" => 20, "score" => 7.5]
];

// 1. Tìm và trả về sinh viên có điểm cao nhất
function findBestStudent($students) {
    if (empty($students)) return null;
    $best = $students[0];
    foreach ($students as $student) {
        if ($student['score'] > $best['score']) {
            $best = $student;
        }
    }
    return $best;
}

// 2. Tìm và trả về sinh viên có điểm thấp nhất
function findWorstStudent($students) {
    if (empty($students)) return null;
    $worst = $students[0];
    foreach ($students as $student) {
        if ($student['score'] < $worst['score']) {
            $worst = $student;
        }
    }
    return $worst;
}

// 3. Đếm số sinh viên đạt (điểm >= 5)
function countPassedStudents($students) {
    $count = 0;
    foreach ($students as $student) {
        if ($student['score'] >= 5.0) {
            $count++;
        }
    }
    return $count;
}

// 4. Tìm sinh viên theo tên
function findStudentByName($students, $name) {
    foreach ($students as $student) {
        if (mb_strtolower($student['name']) === mb_strtolower($name)) {
            return $student;
        }
    }
    return null;
}

// 1. In sinh viên điểm cao nhất
$best = findBestStudent($students);
if ($best) {
    echo "<b>Sinh viên điểm cao nhất:</b> {$best['name']} ({$best['score']} điểm)<br>";
}

// 2. In sinh viên điểm thấp nhất
$worst = findWorstStudent($students);
if ($worst) {
    echo "<b>Sinh viên điểm thấp nhất:</b> {$worst['name']} ({$worst['score']} điểm)<br>";
}

// 3. In số lượng sinh viên đạt
$passedCount = countPassedStudents($students);
echo "<b>Số sinh viên đạt (điểm >= 5):</b> $passedCount sinh viên<br>";

echo "<hr>";

// 4. Thử tìm kiếm sinh viên theo tên
$searchName = "Tran Thi Binh";
$foundStudent = findStudentByName($students, $searchName);

if ($foundStudent) {
    echo "Họ tên: {$foundStudent['name']} | Tuổi: {$foundStudent['age']} | Điểm: {$foundStudent['score']}<br>";
} else {
    echo "Không tìm thấy sinh viên nào có tên '$searchName'<br>";
}
?>