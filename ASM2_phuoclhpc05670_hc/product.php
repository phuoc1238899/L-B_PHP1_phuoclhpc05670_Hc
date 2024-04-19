<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include "client/header.php";

include "./models/database.php";

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$limit = 6;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $limit;
$query_home = "SELECT id as product_id, name, price, sale_price, thumbnail FROM products LIMIT $start_from, $limit";
$result_home = $connection->query($query_home);

if ($result_home->num_rows === 0) {
    header("Location: index.php");
} else {
    // echo "Kết nối dữ liệu thành công.";
}
?>
<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <h1 class="h2 pb-4">Danh mục</h1>
            <ul class="list-unstyled templatemo-accordion border rounded p-3">
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Món ăn nổi bật
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul class="collapse show list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="#">Món chính</a></li>
                        <li><a class="text-decoration-none" href="#">Món phụ</a></li>
                        <li><a class="text-decoration-none" href="#">Đồ uống</a></li>
                        <li><a class="text-decoration-none" href="#">Tráng miệng</a></li>
                    </ul>
                </li>
            </ul>
        </div>


        <div class="col-lg-9">
            <ul id="list-products" class="list-unstyled">
                <?php while ($row_home = $result_home->fetch_assoc()) { ?>
                    <li class="item">
                        <img src="./admin/uploads/<?php echo $row_home['thumbnail'] ?? '' ?>" alt="" width="250px" height="150px">
                        <div class="stars">
                            <span><img src="assets/star.png" alt=""></span>
                            <span><img src="assets/star.png" alt=""></span>
                            <span><img src="assets/star.png" alt=""></span>
                            <span><img src="assets/star.png" alt=""></span>
                            <span><img src="assets/star.png" alt=""></span>
                        </div>
                        <div class="text-center">
                            <a href="single-product.php?id=<?php echo $row_home['product_id'] ?? '' ?>" class="h6 text-decoration-none"><?php echo $row_home['name'] ?? '' ?></a>
                        </div>
                        <div class="desc">Mô Tả Ngắn Cho Sản Phẩm</div>
                        <div class="price"><?php echo number_format($row_home['price']) ?? '' ?> đ</div>
                    </li>
                <?php } ?>
            </ul>

            <div class="list-page">
                <?php
                $query_count = "SELECT COUNT(id) AS total_records FROM products";
                $result_count = $connection->query($query_count);
                $row_count = $result_count->fetch_assoc();
                $total_records = $row_count['total_records'];
                $total_pages = ($total_records % $limit == 0) ? $total_records / $limit : floor($total_records / $limit) + 1;
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<div class='item'><a href='?page=$i'>$i</a></div>";
                }
                ?>
            </div>
        </div>

    </div>
</div>

<?php
include "client/footer.php";
?>