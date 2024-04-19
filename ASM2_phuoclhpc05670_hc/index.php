<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include "./models/database.php";
$query_home = "SELECT id as product_id, name, price, sale_price, thumbnail FROM products";
$result_home = $connection->query($query_home);

$limit = 8;
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
include "client/header.php";
?>
<div id="wp-products">
    <h2>SẢN PHẨM CỦA CHÚNG TÔI</h2>
    <ul id="list-products">
        <?php while ($row_home = $result_home->fetch_assoc()) { ?>
            <div class="item">
                <img src="./admin/uploads/<?php echo $row_home['thumbnail'] ?? '' ?>" alt="" width="250px" height="150px">
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

                <div class="name"><?php echo $row_home['name'] ?? '' ?></div>
                <div class="desc">Mô Tả Ngắn Cho Sản Phẩm</div>
                <div class="price"><?php echo number_format($row_home['price']) ?? '' ?> đ</div>
            </div>
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

<div class="text-center mt-5 mb-5 pt-4">
    <a href="#" class="btn btn-dark rounded-3">View All Products</a>
</div>

<div id="saleoff">
    <div class="box-left">
        <h1>
            <span>GIẢM GIÁ LÊN ĐẾN</span>
            <span>45%</span>
        </h1>
    </div>
    <div class="box-right"></div>
</div>

<div id="comment">
    <h2>NHẬN XÉT CỦA KHÁCH HÀNG</h2>
    <div id="comment-body">
        <div class="prev">
            <a href="#">
                <img src="assets/prev.png" alt="">
            </a>
        </div>
        <ul id="list-comment">
            <li class="item">
                <div class="avatar">
                    <img src="assets/avatar_1.png" alt="">

                </div>
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
                <div class="name">Nguyễn Đình Vũ</div>

                <div class="text">
                    <p>Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum has been the industry's
                        standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it to make a type
                        specimen book.</p>
                </div>
            </li>
            <li class="item">
                <div class="avatar">
                    <img src="assets/avatar_1.png" alt="">

                </div>
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
                <div class="name">Trần Ngọc Sơn</div>

                <div class="text">
                    <p>Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum has been the industry's
                        standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it to make a type
                        specimen book.</p>
                </div>
            </li>
            <li class="item">
                <div class="avatar">
                    <img src="assets/avatar_1.png" alt="">

                </div>
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
                <div class="name">Nguyễn Trần Vi</div>

                <div class="text">
                    <p>Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum has been the industry's
                        standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it to make a type
                        specimen book.</p>
                </div>
            </li>
        </ul>
        <div class="next">
            <a href="#">
                <img src="assets/next.png" alt="">
            </a>
        </div>
    </div>
</div>

<?php
include "client/footer.php";
?>