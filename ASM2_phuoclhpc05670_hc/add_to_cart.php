<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin sản phẩm từ form
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $thumbnail = $_POST['thumbnail'];

    $_SESSION['cart'][$product_id] = [
        'product_id' => $product_id,
        'name' => $name,
        'price' => $price,
        'sale_price' => $sale_price,
        'thumbnail' => $thumbnail,
        'qty' => 1 // Số lượng mặc định là 1
    ];

    header("Location: cart.php");
    exit;
} else {
    header("Location: product.php");
    exit;
}
?>
