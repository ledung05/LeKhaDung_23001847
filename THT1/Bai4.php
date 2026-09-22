<?php
class Student {
    public function __construct(
        public string $name,
        public int $age,
        public float $score
    ) {}

    public function getRank(): string {
        return match(true) {
            $this->score >= 8.0 => "Giỏi",
            $this->score >= 6.5 => "Khá",
            $this->score >= 5.0 => "Trung bình",
            default => "Yếu"
        };
    }

    public function isPassed(): bool {
        return $this->score >= 5.0;
    }

    public function display(): void {
        echo "Họ tên: {$this->name} | Tuổi: {$this->age} | Điểm: {$this->score} | Xếp loại: {$this->getRank()}<br>";
    }
}

function getBestStudent(array $list): Student {
    return array_reduce($list, fn($best, $s) => ($best === null || $s->score > $best->score) ? $s : $best);
}

function countPassed(array $list): int {
    return count(array_filter($list, fn($s) => $s->isPassed()));
}

function getAverage(array $list): float {
    return array_sum(array_column($list, 'score')) / count($list);
}


$students = [
    new Student("Nguyen Van An", 20, 8.5),
    new Student("Tran Thi Binh", 21, 6.5),
    new Student("Le Van Cuong", 19, 4.5),
    new Student("Pham Thi Dung", 20, 7.5)
];

    foreach ($students as $student) {
        $student->display();
    }

    $bestStudent = getBestStudent($students);

    echo "<br>Điểm cao nhất: " . $bestStudent->score;
    echo "<br>Số sinh viên đạt: " . countPassed($students);
    echo "<br>Điểm trung bình của lớp: " . getAverage($students);
?>