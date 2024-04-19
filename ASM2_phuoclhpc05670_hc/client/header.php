<?php

require_once "./models/database.php";
session_start();
// Kiểm tra xem người dùng đã đăng nhập thành công chưa
if (isset($_SESSION['user_login'])) {
    // Lấy thông tin người dùng từ session
    $user = $_SESSION['user_login'];
} else {
    // Nếu chưa đăng nhập, hiển thị thông báo hoặc chuyển hướng đến trang đăng nhập
    // echo 'Xin vui lòng đăng nhập.';
}
// Kiểm tra xem phần tử 'status' có tồn tại trong mảng $_SESSION['user_login'] không trước khi truy cập
if (isset($_SESSION['user_login']) && isset($_SESSION['user_login']['status']) && $_SESSION['user_login']['status'] == 0) {
    // Nếu là admin, hiển thị menu admin
}
$query_cate = "SELECT id, name, description FROM categories";
$result_cate = $connection->query($query_cate);
if ($result_cate->num_rows === 0) {
    //     header("Location: index.php");
    // } else {
    // echo "Kết nối dữ liệu thành công.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>FOOD</title>
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <a href="index.php" class="logo">
                <img src="assets/logo.png" alt="">
            </a>
            <div id="menu">
                <div class="item">
                    <a href="index.php">Trang chủ</a>
                </div>
                <div class="item">
                    <a href="product.php">Sản phẩm</a>
                    <div class="sub-menu dropdown-menu" aria-labelledby="navbarDropdown">
                        <ul class="list-unstyled">
                            <?php while ($row_cate = $result_cate->fetch_assoc()) { ?>
                                <li><a class="dropdown-item" href="product_cate.php?category_id=<?= $row_cate['id'] ?>"><?= $row_cate['name'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
                <div class="item">
                    <a href="blog.php">Tin tức</a>
                </div>
                <div class="item">
                    <a href="blog.php">Liên Hệ</a>
                </div>
            </div>

            <div id="actions">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle btn-sm text-dark" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-sm" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Xin Chào : <?php echo $user['name'] ?? ''; ?></a></li>
                        <?php if (!isset($_SESSION['user_login'])) : ?>
                            <!-- Hiển thị thẻ li khi người dùng chưa đăng nhập -->
                            <li><a class="dropdown-item" href="login.php"><i class="bi bi-box-arrow-in-right bi-sm"></i></a></li>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['user_login'])) : ?>
                            <!-- Hiển thị thẻ li khi người dùng đã đăng nhập -->
                            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right bi-sm"></i></a></li>

                            <?php if (isset($_SESSION['user_login']['status']) && $_SESSION['user_login']['status'] == 0) : ?>
                                <!-- Hiển thị thẻ li menu admin khi người dùng là admin -->
                                <li><a class="dropdown-item" href="/admin/index.php"><i class="bi bi-person-fill-gear"></i></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div id="banner">
            <div class="single_slider d-flex align-items-center justify-content-center">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-9">
                            <div class="slider_text text-center">
                                <div class="find_dowmain">
                                    <form action="product_cate.php" class="find_dowmain_form">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Tìm kiếm" name="keyword" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
                                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-right">
                <img src="assets/img_1.png" alt="">
                <img src="assets/img_2.png" alt="">
                <img src="assets/img_3.png" alt="">
            </div>
            <div class="to-bottom">
                <a href="">
                    <img src="assets/to_bottom.png" alt="">
                </a>
            </div>
        </div>