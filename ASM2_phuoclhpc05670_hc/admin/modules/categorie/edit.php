<?php
include "../models/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['description'])) {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        updateCategory($connection, $name, $description, $id);
        echo "Cập nhật thành công!";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = getCategoryById($connection, $id);
}

function getCategoryById($connection, $id)
{
    $query = "SELECT * FROM categories WHERE `id` = $id";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

function updateCategory($connection, $name, $description, $id)
{
    $query = "UPDATE categories SET 
      `name`='$name',
      `description`='$description'
      WHERE `id` =$id
  ";
    $connection->query($query);
}
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Chỉnh sửa loại sản phẩm</h3>
    </div>
    <form method="POST" action="" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Tên loại sản phẩm</label>
                <input type="text" class="form-control" name="name" id="name" value="<?= $data['name'] ?? '' ?>" placeholder="Nhập tên loại sản phẩm">
                <span class="error-message" id="name-error" style="display: none;">Vui lòng nhập tên loại sản phẩm</span>
            </div>
            <label for="summernote">Nội dung</label>
            <textarea name="description" id="summernote"><?= $data['description'] ?? '' ?></textarea>
            <span class="error-message" id="description-error" style="display: none;">Vui lòng nhập nội dung</span>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
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
