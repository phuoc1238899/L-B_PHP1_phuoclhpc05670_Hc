<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include "./models/database.php";

if (isset($_GET['category_id'])) {
    $id = $_GET['category_id'];
    $query_product_bycate = "SELECT id as product_id, name, content, thumbnail, price
    FROM products WHERE category_id = $id";
} else if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $query_product_bycate = "SELECT id as product_id, name, content, thumbnail, price
    FROM products WHERE name LIKE '%$keyword%'";
} else {
    header("Location: index.php");
}

$result_product_bycate = $connection->query($query_product_bycate);

if (!$result_product_bycate || $result_product_bycate->num_rows === 0) {
    header("Location: index.php");
    exit;
}

include "client/header.php";
?>

<section id="new-arrival" class="product-store py-5">
    <div class="container">
        <h4 class="display-6 fw-light text-uppercase text-center mb-5">
            Sản Phẩm Danh Mục</h4>

        <ul id="list-products">
            <?php while ($row = $result_product_bycate->fetch_assoc()) { ?>
                <div class="item">
                    <img src="./admin/uploads/<?php echo $row['thumbnail'] ?? '' ?>" alt="" width="250px" height="150px">
                    <div class="stars">
                        <span>
                            <img src="assets/star.png" alt="">
                        </span>
                        <span>
                            <img src="assets/star.png" alt="">
                        </span>
                        <span>
                            <img src="assets/star.png" alt="">
                        </span>
                        <span>
                            <img src="assets/star.png" alt="">
                        </span>
                        <span>
                            <img src="assets/star.png" alt="">
                        </span>
                    </div>

                    <div class="name"><?php echo $row['name'] ?? '' ?></div>
                    <div class="desc">Mô Tả Ngắn Cho Sản Phẩm</div>
                    <div class="price"><?php echo number_format($row['price']) ?? '' ?> đ</div>
                </div>
            <?php } ?>
        </ul>

    </div>
</section>

<div class="text-center mt-5 mb-5 pt-4">
    <a href="#" class="btn btn-dark rounded-3">View All Products</a>
</div>

<?php
include "client/footer.php";
?>