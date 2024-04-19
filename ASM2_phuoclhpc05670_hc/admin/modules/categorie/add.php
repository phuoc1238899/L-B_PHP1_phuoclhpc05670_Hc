<?php

include "../models/database.php";

// Kiểm tra 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST["name"], $_POST["description"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];

    $query_insert_category = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";

    if ($connection->query($query_insert_category) === TRUE) {
      echo "Thêm loại thành công.";
    } else {
      echo "Lỗi: " . $connection->error;
    }
  }
}
?>

<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Thêm loại sản phẩm</h3>
  </div>
  <form method="POST" action="" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div class="card-body">
      <div class="mb-3">
        <label for="name" class="form-label">Tên loại sản phẩm</label>
        <input type="text" class="form-control " name="name" id="name" placeholder="Nhập tên loại sản phẩm">
        <span class="error-message" id="name-error" style="display: none;">Vui lòng nhập tên loại sản phẩm</span>
      </div>
      <div class="mb-3">
        <label for="summernote" class="form-label">Nội dung</label>
        <textarea name="description" class="form-control " id="summernote"></textarea>
        <span class="error-message" id="description-error" style="display: none;">Vui lòng nhập nội dung</span>
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
    var description = document.getElementById('summernote').value;
    var nameError = document.getElementById('name-error');
    var descriptionError = document.getElementById('description-error');

    if (name.trim() === '') {
      nameError.style.display = 'block';
      return false;
    } else {
      nameError.style.display = 'none';
    }

    if (description.trim() === '') {
      descriptionError.style.display = 'block';
      return false;
    } else {
      descriptionError.style.display = 'none';
    }

    return true;
  }
</script>