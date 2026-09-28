<?php

class Movie {
    private int $id;
    private string $title;
    private float $price;
    private int $totalSeats;
    private int $availableSeats;

    public function __construct(int $id, string $title, float $price, int $totalSeats) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->totalSeats = $totalSeats;
        $this->availableSeats = $totalSeats;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getTotalSeats(): int {
        return $this->totalSeats;
    }

    public function getAvailableSeats(): int {
        return $this->availableSeats;
    }

    public function bookTicket(int $quantity): bool {
        if ($quantity <= 0) {
            echo "Lỗi [{$this->title}]: Số lượng vé đặt phải lớn hơn 0.\n";
            return false;
        }

        if ($quantity > $this->availableSeats) {
            echo "Lỗi [{$this->title}]: Không thể đặt {$quantity} vé. Chỉ còn {$this->availableSeats} ghế trống.\n";
            return false;
        }

        $this->availableSeats -= $quantity;
        echo "Thành công: Đã đặt {$quantity} vé cho phim '{$this->title}'.\n";
        return true;
    }

    public function cancelTicket(int $quantity): bool {
        if ($quantity <= 0) {
            echo "Lỗi [{$this->title}]: Số lượng vé hủy phải lớn hơn 0.\n";
            return false;
        }

        $soldSeats = $this->getSoldSeats();
        if ($quantity > $soldSeats) {
            echo "Lỗi [{$this->title}]: Không thể hủy {$quantity} vé. Số vé đã bán chỉ là {$soldSeats}.\n";
            return false;
        }

        $this->availableSeats += $quantity;
        echo "Thành công: Đã hủy {$quantity} vé cho phim '{$this->title}'.\n";
        return true;
    }

    public function getSoldSeats(): int {
        return $this->totalSeats - $this->availableSeats;
    }

    public function getRevenue(): float {
        return $this->getSoldSeats() * $this->price;
    }

    public function displayInfo(): void {
        printf(
            "ID: %-3d | Phim: %-12s | Giá vé: %-10s | Tong ghế: %-3d | Ghế còn: %-3d | Đã bán: %-3d | Doanh thu: %s VNĐ\n",
            $this->id,
            $this->title,
            number_format($this->price, 0, ',', '.'),
            $this->totalSeats,
            $this->availableSeats,
            $this->getSoldSeats(),
            number_format($this->getRevenue(), 0, ',', '.')
        );
    }
}

function findMovieById(array $movies, int $id): ?Movie {
    foreach ($movies as $movie) {
        if ($movie instanceof Movie && $movie->getId() === $id) {
            return $movie;
        }
    }
    return null;
}

function getTotalRevenue(array $movies): float {
    if (empty($movies)) {
        return 0;
    }

    $totalRevenue = 0;
    foreach ($movies as $movie) {
        if ($movie instanceof Movie) {
            $totalRevenue += $movie->getRevenue();
        }
    }
    return $totalRevenue;
}

function getBestSellingMovie(array $movies): ?Movie {
    if (empty($movies)) {
        return null;
    }

    $bestMovie = null;
    $maxSold = -1;

    foreach ($movies as $movie) {
        if ($movie instanceof Movie) {
            if ($movie->getSoldSeats() > $maxSold) {
                $maxSold = $movie->getSoldSeats();
                $bestMovie = $movie;
            }
        }
    }

    return $bestMovie;
}

echo "<pre>";

// 1. Tạo danh sách các object Movie mẫu
$movies = [
    new Movie(1, "Avengers", 100000, 100),
    new Movie(2, "Avatar", 120000, 80),
    new Movie(3, "Batman", 90000, 120)
];

// 2. Đặt vé cho phim Avengers
echo "Đặt vé phim Avengers\n";
$avengers = findMovieById($movies, 1);
if ($avengers) {
    $avengers->bookTicket(30);
}

// 3. Đặt vé cho phim Avatar
echo "\nĐặt vé phim Avatar\n";
$avatar = findMovieById($movies, 2);
if ($avatar) {
    $avatar->bookTicket(50);
}

// 4. Hủy một số vé đã đặt của phim Avengers
echo "\nHủy vé phim Avengers\n";
if ($avengers) {
    $avengers->cancelTicket(10);
}

// 5. Hiển thị thông tin của tất cả các phim
echo "\n Thông tin của tất cả các phim \n";
foreach ($movies as $movie) {
    $movie->displayInfo();
}
echo "\n";

// 6. Tính tổng doanh thu của tất cả các phim
echo "Tổng doanh thu tất cả các phim: " . number_format(getTotalRevenue($movies), 0, ',', '.') . " VNĐ\n\n";

// 7. Tìm và hiển thị phim có số vé bán ra nhiều nhất
$bestMovie = getBestSellingMovie($movies);
if ($bestMovie) {
    echo "Phim có số vé bán ra nhiều nhất:\n";
    echo "Tên phim: " . $bestMovie->getTitle() . "\n";
    echo "Số vé đã bán: " . $bestMovie->getSoldSeats() . " vé\n";
    echo "Doanh thu mang lại: " . number_format($bestMovie->getRevenue(), 0, ',', '.') . " VNĐ\n";
}