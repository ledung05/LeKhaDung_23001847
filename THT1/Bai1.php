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

    $totalScore = 0;

    foreach ($students as $student) {
        echo "Họ tên: " . $student['name'] . ", Tuổi: " . $student['age'] . ", Điểm: " . $student['score'] . "<br>";
        $totalScore += $student['score'];
    }

    $studentCount = count($students);
    $averageScore = $totalScore / $studentCount;

    echo "Điểm trung bình: " . $averageScore . "<br>";
?>