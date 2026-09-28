<?php
class CartItem {
    private $name;
    private $price;
    private $quantity;

    public function __construct($name, $price, $quantity) {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getTotal() {
        return $this->price * $this->quantity;
    }
}

class ShoppingCart {
    private $items = [];

    public function addItem(CartItem $item) {
        // Kiểm tra giá sản phẩm
        if ($item->getPrice() <= 0) {
            echo "Lỗi: Giá của sản phẩm '{$item->getName()}' phải lớn hơn 0.\n";
            return;
        }

        // Kiểm tra số lượng sản phẩm
        if ($item->getQuantity() <= 0) {
            echo "Lỗi: Số lượng của sản phẩm '{$item->getName()}' phải lớn hơn 0.\n";
            return;
        }

        // Nếu sản phẩm đã tồn tại thì cộng dồn số lượng
        foreach ($this->items as $index => $cartItem) {
            if (strcasecmp($cartItem->getName(), $item->getName()) === 0) {
                $newQuantity = $cartItem->getQuantity() + $item->getQuantity();
                $this->items[$index] = new CartItem($cartItem->getName(), $cartItem->getPrice(), $newQuantity);
                echo "Đã cập nhật số lượng sản phẩm '{$item->getName()}' trong giỏ hàng.\n";
                return;
            }
        }

        $this->items[] = $item;
        echo "Đã thêm sản phẩm '{$item->getName()}' vào giỏ hàng thành công.\n";
    }

    public function removeItem($name) {
        foreach ($this->items as $index => $item) {
            if (strcasecmp($item->getName(), $name) === 0) {
                unset($this->items[$index]);
                $this->items = array_values($this->items); // Reset lại chỉ số mảng
                echo "Đã xóa sản phẩm '{$name}'.\n";
                return;
            }
        }
        echo "Không tìm thấy sản phẩm '{$name}' trong giỏ hàng để xóa.\n";
    }

    public function calculateTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getTotal(); // Gọi method getTotal() của CartItem
        }
        return $total;
    }

    public function displayCart() {

        if (empty($this->items)) {
            echo "Giỏ hàng hiện đang trống.\n";
            return;
        }

        foreach ($this->items as $index => $item) {
            echo ($index + 1) . ". Sản phẩm: " . $item->getName() .
                 " | Đơn giá: " . number_format($item->getPrice()) . " VNĐ" .
                 " | Số lượng: " . $item->getQuantity() .
                 " | Thành tiền: " . number_format($item->getTotal()) . " VNĐ\n";
        }
        echo "Tổng tiền giỏ hàng: " . number_format($this->calculateTotal()) . " VNĐ\n";
    }
}

echo "<pre>";
#1. Khởi tạo giỏ hàng
$cart = new ShoppingCart();

#2. Tạo các sản phẩm
$item1 = new CartItem("Điện thoại iPhone 15", 20000000, 1);
$item2 = new CartItem("Tai nghe Bluetooth", 1500000, 2);
$item3 = new CartItem("Sạc dự phòng", 500000, 1);
$item4 = new CartItem("Ốp lưng", 100000, 3);

$itemInvalidPrice = new CartItem("Sản phẩm lỗi giá", 0, 1);
$itemInvalidQty = new CartItem("Sản phẩm lỗi số lượng", 50000, -2);

#3. Thêm các sản phẩm vào giỏ hàng
$cart->addItem($item1);
$cart->addItem($item2);
$cart->addItem($item3);
$cart->addItem($item4);
$cart->addItem($itemInvalidPrice);
$cart->addItem($itemInvalidQty);
echo "\n";

#4 & #5. Hiển thị giỏ hàng & Tính tổng tiền
$cart->displayCart();
echo "\n";

#6. Xóa sản phẩm theo tên
$cart->removeItem("Sạc dự phòng");
$cart->removeItem("Bàn phím cơ"); 
echo "\n";

#7. Hiển thị lại giỏ hàng sau khi xóa
$cart->displayCart();

?>