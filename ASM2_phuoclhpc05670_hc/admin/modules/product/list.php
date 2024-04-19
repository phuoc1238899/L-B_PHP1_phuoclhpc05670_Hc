<?php
include "../models/database.php";

if (isset($_GET['action']) && $_GET['action'] == 'xoa') {
    if (isset($_GET['id'])) {
        // Lấy id cần xóa
        $id = $_GET['id'];
        // Câu query
        $query = "DELETE FROM products WHERE `id` = $id";
        // Thực hiện câu query
        if (mysqli_query($connection, $query)) {
            echo 'xóa thành công';
        } else {
            echo "Có lỗi khi xóa sản phẩm";
        }
    }
}
// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$query_select_products = "SELECT * FROM products ORDER BY ID DESC";
$result_products = $connection->query($query_select_products);
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách sản phẩm</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Giá khuyến mãi</th>
                            <th>Ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_products->num_rows > 0) {
                            while ($row = $result_products->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["price"] . "</td>";
                                echo "<td>" . $row["sale_price"] . "</td>";
                                echo "<td><img src='./uploads/" . $row["thumbnail"] . "' alt='Product Thumbnail' style='width: 60px; height: 60px;'></td>";
                                echo "<td>
                                          <a href='/admin/?pages=product&action=edit&id=" . $row['id'] . "' class='btn btn-warning'>Sửa</a>
                                          <a href='/admin/?pages=product&action=xoa&id=" . $row['id'] . "' class='btn btn-danger' onclick=\"return confirm('Bạn có chắc muốn xóa sản phẩm này?');\">Xóa</a>
                                      </td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>