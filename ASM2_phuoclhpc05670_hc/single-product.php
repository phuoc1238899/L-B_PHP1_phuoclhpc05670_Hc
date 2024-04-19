<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// Phần hiển thị sản phẩm và mua hàng
$id = $_GET['id'];
include "./models/database.php";

$query = "SELECT id as product_id, name, content, price, sale_price, thumbnail FROM products WHERE id = $id";
$result = $connection->query($query);

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit; // Đảm bảo không tiếp tục chạy mã nếu không có sản phẩm nào được tìm thấy
}

$product = $result->fetch_assoc();

include "client/header.php";
?>

<section id="product-detail" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="admin/uploads/<?= $product['thumbnail'] ?? '' ?>" alt="Product Image" style="width: 500px; height: 280px;" class="img-fluid">
            </div>
            <div class="col-md-6 product-details">
                <h2><?= $product['name'] ?? '' ?></h2>
                <?php
                // tính giá giảm giá
                $price = $product['price'] ?? '';
                $sale_price = $product['sale_price'] ?? '';
                ?>
                <?php if ($sale_price != 0) : ?>
                    <p><strike><?= number_format($price) ?? '' ?></strike> đ</p>
                    <p class="text-danger"><?= number_format($sale_price) ?? '' ?> đ</p>
                <?php else : ?>
                    <p><?= number_format($price) ?? '' ?> đ</p>
                <?php endif; ?>

                <div class="product-description">
                    <h3>Mô Tả</h3>
                    <p><?= $product['content'] ?? '' ?></p>
                </div>
                <div class="product-details">
                    <div class="mt-3">
                        <form id="add-to-cart-form" method="post" action="add_to_cart.php">
                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                            <input type="hidden" name="name" value="<?= $product['name'] ?>">
                            <input type="hidden" name="sale_price" value="<?= $product['sale_price'] ?>">
                            <input type="hidden" name="price" value="<?= $product['price'] ?>">
                            <input type="hidden" name="thumbnail" value="<?= $product['thumbnail'] ?>">
                            <button type="submit" class="btn btn-primary">Đặt món</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Mô tả</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Bình luận</a>
            </li>
            <div class="container mt-3">
                <div class="product-content">
                    <?= $product['content'] ?? '' ?>
                </div>
            </div>
        </ul>
    </div>
</section>


<?php
include "client/footer.php";
?>