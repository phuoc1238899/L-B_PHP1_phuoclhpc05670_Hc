<?php

include "../models/database.php";

// Kiểm tra
if (isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_GET['id'];
  $name = $_POST['name'];
  $content = $_POST['content'];
  $price = $_POST['price'];
  $sale_price = $_POST['sale_price'];
  $category_id = $_POST["category"];
  $thumbnail = $_FILES['thumbnail']['name'];

  move_uploaded_file($_FILES["thumbnail"]["tmp_name"], "uploads/" . $thumbnail);

  updateProduct($connection, $name, $content, $price, $sale_price, $category_id, $thumbnail, $id);
  echo "Cập nhật thành công!";
}


if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $data = getProductById($connection, $id);
}

// lay thong tin id từ csdl từ id đã cho 
function getProductById($connection, $id)
{
  $query = "SELECT * FROM products WHERE `id` = $id";
  $result = $connection->query($query);
  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  } else {
    return false;
  }
}
function updateProduct($connection, $name, $content, $price, $sale_price,  $category_id, $thumbnail, $id)
{
  $query = "UPDATE products SET 
      `name`='$name',
      `content`='$content',
      `price`='$price',
      `sale_price`='$sale_price',
      `category_id` =  '$category_id',
      `thumbnail` = '$thumbnail'
      WHERE `id` =$id ";
  $connection->query($query);
}
?>
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Chỉnh sửa sản phẩm</h3>
  </div>
  <form method="POST" action="" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $data['name'] ?? '' ?>" placeholder="Nhập tên sản phẩm">
            <span class="error-message" id="name-error" style="display: none;">Vui lòng nhập tên sản phẩm</span>
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Giá sản phẩm</label>
            <input type="number" class="form-control" name="price" id="price" value="<?= $data['price'] ?? '' ?>" placeholder="Nhập giá sản phẩm">
            <span class="error-message" id="price-error" style="display: none;">Vui lòng nhập giá sản phẩm</span>
          </div>
          <div class="mb-3">
            <label for="sale_price" class="form-label">Giá khuyến mãi</label>
            <input type="number" class="form-control" name="sale_price" id="sale_price" value="<?= $data['sale_price'] ?? '' ?>" placeholder="Nhập giá khuyến mãi">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="category" class="form-label">Danh mục sản phẩm</label>
            <select name="category" class="form-control" id="category">
              <?php
              $query_categories = "SELECT * FROM categories";
              $result_categories = $connection->query($query_categories);
              if ($result_categories->num_rows > 0) {
                while ($row = $result_categories->fetch_assoc()) {
                  echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="thumbnail" class="form-label">Ảnh</label>
            <input type="file" class="form-control " name="thumbnail" id="thumbnail">
            <span class="error-message" id="thumbnail-error" style="display: none;">Vui lòng chọn ảnh sản phẩm</span>
          </div>
          <div class="mb-3">
            <?php if (isset($data['thumbnail'])) : ?>
              <img src="/admin/uploads/<?= $data['thumbnail'] ?>" alt="Product Thumbnail" style="width: 100px; height: 100px;">
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label for="summernote">Nội dung</label>
        <textarea name="content" required id="summernote"><?= $data['content'] ?? '' ?></textarea>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
  </form>
</div>

<script>
  function validateForm() {
    var name = document.getElementById('name').value;
    var price = document.getElementById('price').value;
    var thumbnail = document.getElementById('thumbnail').value;

    var nameError = document.getElementById('name-error');
    var priceError = document.getElementById('price-error');
    var thumbnailError = document.getElementById('thumbnail-error');

    if (name.trim() === '') {
      nameError.style.display = 'block';
      return false;
    } else {
      nameError.style.display = 'none';
    }

    if (price.trim() === '') {
      priceError.style.display = 'block';
      return false;
    } else {
      priceError.style.display = 'none';
    }

    if (thumbnail.trim() === '') {
      thumbnailError.style.display = 'block';
      return false;
    } else {
      thumbnailError.style.display = 'none';
    }

    return true;
  }
</script>