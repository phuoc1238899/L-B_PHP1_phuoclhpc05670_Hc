<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include "../models/database.php";

if (isset($_GET['action']) && $_GET['action'] == 'xoa') {
    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $query = "DELETE FROM categories WHERE `id` = $id";

        if (mysqli_query($connection, $query)) {
            echo 'Xóa thành công';
        
        } else {
            echo "Có lỗi khi xóa loại sản phẩm";
        }
    }
}

$query_select_categories = "SELECT * FROM categories ORDER BY ID DESC";
$result_categories = $connection->query($query_select_categories);
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách loại sản phẩm</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>Tên loại</th>
                            <th>Mô tả</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_categories->num_rows > 0) {
                            while ($row = $result_categories->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["description"] . "</td>";
                                echo "<td>
                                          <a href='/admin/?pages=categorie&action=edit&id=" . $row['id'] . "' class='btn btn-warning'>Sửa</a>
                                          <a href='/admin/?pages=categorie&action=xoa&id=" . $row['id'] . "' class='btn btn-danger' onclick=\"return confirm('Bạn có chắc muốn xóa sản phẩm này?');\">Xóa</a>
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