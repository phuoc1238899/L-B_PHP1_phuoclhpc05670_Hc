<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include "client/header.php";

// Kiểm tra nếu có yêu cầu xóa sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];

    unset($_SESSION['cart'][$product_id]);
}
// Kiểm tra nếu giỏ hàng không trống
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) :
    $total_price = 0;
?>
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-7">
                                    <h5 class="mb-3"><a href="product.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Tiếp tục mua sắm</a></h5>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <p class="mb-1">Giỏ hàng</p>
                                            <p class="mb-0">Bạn có <?= count($_SESSION['cart']) ?> sản phẩm trong giỏ hàng</p>
                                        </div>
                                        <div>
                                            <p class="mb-0"><span class="text-muted">Sắp xếp theo:</span> <a href="#!" class="text-body">giá <i class="fas fa-angle-down mt-1"></i></a></p>
                                        </div>
                                    </div>
                                    <?php foreach ($_SESSION['cart'] as $product_id => $product) : ?>
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div>
                                                            <img src="/admin/uploads/<?= $product['thumbnail'] ?>" class="img-fluid me-3" style="max-width: 80px;" alt="<?= $product['name'] ?>">
                                                        </div>
                                                        <div><?= $product['name'] ?></div>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div style="width: 50px;">
                                                            <h5 class="fw-normal mb-0"><?= $product['qty'] ?></h5>
                                                        </div>
                                                        <div style="width: 80px;">
                                                            <h5 class="mb-0"><?= isset($product['sale_price']) && $product['sale_price'] != 0 ? number_format($product['sale_price']) : number_format($product['price']) ?></h5>
                                                        </div>
                                                        
                                                        <form method="post" action="cart.php">
                                                            <input type="hidden" name="remove_product" value="1">
                                                            <input type="hidden" name="product_id" value="<?= $product_id ?>">
                                                            <button type="submit" style="color: #cecece; background: none; border: none;"><i class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        // Cập nhật tổng giá trị của giỏ hàng
                                        $item_total = isset($product['sale_price']) && $product['sale_price'] != 0 ? $product['sale_price'] * $product['qty'] : $product['price'] * $product['qty'];
                                        $total_price += $item_total;
                                        ?>
                                    <?php endforeach; ?>
                                </div>
                                <div class="col-lg-5">
                                    <div class="card bg-dark text-white rounded-3">
                                        <div class="card-body">
                                            <form class="mt-4">
                                            </form>
                                            <hr class="my-4">
                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Tổng phụ</p>
                                                <p class="mb-2">$<?= $total_price ?></p>
                                            </div>
                                            <div class="d-flex justify-content-between mb-4">
                                                <p class="mb-2">Tổng cộng (Bao gồm thuế)</p>
                                                <p class="mb-2">$<?= $total_price ?></p>
                                            </div>
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-block btn-lg">
                                                <a href="order_form.html" class="btn btn-info btn-sm btn-block">
                                                    <div class="d-flex justify-content-between">
                                                        <!-- <span>$<= $total_price ?></span> -->
                                                        <span>Thanh toán <i class="fas fa-long-arrow-alt-right ms-2 "></i></span>
                                                    </div>
                                                </a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-7">
                                    <h5 class="mb-3"><a href="product.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Tiếp tục mua sắm</a></h5>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <p class="mb-1">Giỏ hàng</p>
                                            <p class="mb-0">Bạn có <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?> sản phẩm trong giỏ hàng</p>
                                        </div>
                                        <div>
                                            <p class="mb-0"><span class="text-muted">Sắp xếp theo:</span> <a href="#!" class="text-body">giá <i class="fas fa-angle-down mt-1"></i></a></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-5">
                                    <div class="card bg-dark text-white rounded-3">
                                        <div class="card-body">
                                            <form class="mt-4">

                                            </form>
                                            <hr class="my-4">
                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Tổng phụ</p>

                                            </div>
                                            <div class="d-flex justify-content-between mb-4">
                                                <p class="mb-2">Tổng cộng (Bao gồm thuế)</p>

                                            </div>
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-block btn-lg">
                                                <a href="order_form.html" class="btn btn-info btn-sm btn-block">
                                                    <div class="d-flex justify-content-between">
                                                        <!-- <span>$<= $total_price ?></span> -->
                                                        <span>Thanh toán <i class="fas fa-long-arrow-alt-right ms-2 "></i></span>
                                                    </div>
                                                </a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>

<?php
include "client/footer.php";
?>