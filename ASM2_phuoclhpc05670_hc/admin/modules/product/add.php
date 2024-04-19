<?php

include "../models/database.php";

// Kiểm tra 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST["name"], $_POST["content"], $_POST["price"], $_POST["sale_price"], $_FILES["thumbnail"]["name"], $_POST["category"])) {
    $name = $_POST["name"];
    $content = $_POST["content"];
    $price = $_POST["price"];
    $sale_price = $_POST["sale_price"];
    $thumbnail = $_FILES["thumbnail"]["name"];
    $category_id = $_POST["category"];

    // Di chuyển file ảnh đã upload vào thư mục "uploads"
    move_uploaded_file($_FILES["thumbnail"]["tmp_name"], "uploads/" . $thumbnail);

    $query_insert_product = "INSERT INTO products (name, content, price, sale_price, thumbnail, category_id) VALUES ('$name', '$content', '$price', '$sale_price', '$thumbnail', '$category_id')";

    if ($connection->query($query_insert_product) === TRUE) {
      echo "Thêm sản phẩm thành công.";
    } else {
      echo "Lỗi: " . $connection->error;
    }
  }
}
?>

<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Sản phẩm</h3>
  </div>
  <form method="POST" action="" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control " name="name" id="name" placeholder="Nhập tên sản phẩm">
            <span class="error-message" id="name-error" style="display: none;">Vui lòng nhập tên sản phẩm</span>
          </div>
          <div class="form-group">
            <label for="price">Giá sản phẩm</label>
            <input type="number" class="form-control " name="price" id="price" placeholder="Nhập giá sản phẩm">
            <span class="error-message" id="price-error" style="display: none;">Vui lòng nhập giá sản phẩm</span>
          </div>
          <div class="form-group">
            <label for="sale_price">Giá khuyến mãi</label>
            <input type="number" class="form-control " name="sale_price" id="sale_price" placeholder="Nhập giá khuyến mãi">
            <span class="error-message" id="sale_price-error" style="display: none;">Vui lòng nhập giá khuyến mãi</span>
          </div>
          <div class="form-group">
            <label for="thumbnail">Ảnh</label>
            <input type="file" class="form-control " name="thumbnail">
            <span class="error-message" id="thumbnail-error" style="display: none;">Vui lòng chọn ảnh sản phẩm</span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="summernote" class="form-label">Nội dung</label>
            <textarea name="content" class="form-control " id="summernote"></textarea>
            <span class="error-message" id="content-error" style="display: none;">Vui lòng nhập nội dung sản phẩm</span>
          </div>
          <div class="mb-3">
            <label for="category" class="form-label">Danh mục sản phẩm</label>
            <select name="category" class="form-control" id="category">
              <option value="">Chọn danh mục sản phẩm</option>
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
            <span class="error-message" id="category-error" style="display: none;">Vui lòng chọn danh mục sản phẩm</span>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Thêm</button>
    </div>
  </form>
</div>

<script>
  function validateForm() {
    var name = document.getElementById('name').value;
    var price = document.getElementById('price').value;
    var sale_price = document.getElementById('sale_price').value;
    var thumbnail = document.querySelector('input[type=file]').value;
    var content = document.getElementById('summernote').value;
    var category = document.getElementById('category').value;

    var nameError = document.getElementById('name-error');
    var priceError = document.getElementById('price-error');
    var salePriceError = document.getElementById('sale_price-error');
    var thumbnailError = document.getElementById('thumbnail-error');
    var contentError = document.getElementById('content-error');
    var categoryError = document.getElementById('category-error');

    var isValid = true;

    if (name.trim() === '') {
      nameError.style.display = 'block';
      isValid = false;
    } else {
      nameError.style.display = 'none';
    }

    if (price.trim() === '') {
      priceError.style.display = 'block';
      isValid = false;
    } else {
      priceError.style.display = 'none';
    }

    if (sale_price.trim() === '') {
      salePriceError.style.display = 'block';
      isValid = false;
    } else {
      salePriceError.style.display = 'none';
    }

    if (thumbnail === '') {
      thumbnailError.style.display = 'block';
      isValid = false;
    } else {
      thumbnailError.style.display = 'none';
    }

    if (content.trim() === '') {
      contentError.style.display = 'block';
      isValid = false;
    } else {
      contentError.style.display = 'none';
    }

    if (category === '') {
      categoryError.style.display = 'block';
      isValid = false;
    } else {
      categoryError.style.display = 'none';
    }

    return isValid;
  }
</script>