<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
} else {
    header('Location: product_list.php');
    exit();
}
?>