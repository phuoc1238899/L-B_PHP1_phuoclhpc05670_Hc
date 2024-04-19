<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include './models/database.php';
// kiem tra
if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $status = 1;

    $checkEmailQuery = "SELECT COUNT(*) as count FROM users WHERE email = '$email'";
    $result = $connection->query($checkEmailQuery);
    $emailRow = $result->fetch_assoc();
    if ($emailRow['count'] > 0) {
        echo "Lỗi: Email đã tồn tại.";
        exit;
    }

    $sql = "INSERT INTO users(`name`, `email`, `password`, `phone`, `address`, `status`) 
            VALUES ('$name', '$email', '$password', '$phone', '$address', '$status')";
    $result = $connection->query($sql);

    if ($result) {
        echo "Đăng ký thành công.";
        header('Location: login.php');
    } else {
        echo "Lỗi: " . $connection->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="/css/css.css">
</head>

<body>
    <div class="background">
        <div class="shape"></div>
    </div>

    <form class="row login_form" action="register.php" method="POST" id="contactForm" novalidate="novalidate" onsubmit="return validateForm()">
        <h4>Đăng Ký</h4>
        <label for="fullname">Tên</label>
        <input type="text" class="form-control" required name="name" placeholder="Nhập Tên Tài Khoản">
        <span class="error-message" id="name-error">Vui lòng điền Tên</span>
        <label for="email">Email</label>
        <input type="text" class="form-control" required name="email" placeholder="Nhập Email">
        <span class="error-message" id="email-error">Vui lòng điền Email</span>
        <label for="password">Mật khẩu</label>
        <input type="password" class="form-control" required name="password" placeholder="Nhập Password">
        <span class="error-message" id="password-error">Vui lòng điền Mật khẩu</span>
        <label for="phone">Số điện thoại</label>
        <input type="text" class="form-control" required name="phone" placeholder="Nhập Số Điện Thoại">
        <span class="error-message" id="phone-error">Số điện thoại phải là số và có ít nhất 10 chữ số</span>
        <label for="phone">Địa chỉ</label>
        <input type="text" class="form-control" required name="address" placeholder="Nhập Địa Chỉ">
        <span class="error-message" id="address-error">Vui lòng điền Địa chỉ</span>
        <button type="submit" value="submit" name="register" class="primary-btn">Đăng ký</button>
        <div class="register-link">
            <a href="login.php">Đăng nhập</a>
        </div>
    </form>
    <script>
        function validateForm() {
            var name = document.getElementsByName('name')[0];
            var email = document.getElementsByName('email')[0];
            var password = document.getElementsByName('password')[0];
            var phone = document.getElementsByName('phone')[0];
            var address = document.getElementsByName('address')[0];
            var nameError = document.getElementById('name-error');
            var emailError = document.getElementById('email-error');
            var passwordError = document.getElementById('password-error');
            var phoneError = document.getElementById('phone-error');
            var addressError = document.getElementById('address-error');

            var isValid = true;

            if (name.value.trim() === '') {
                nameError.style.display = 'block';
                name.classList.add('error');
                isValid = false;
            } else {
                nameError.style.display = 'none';
                name.classList.remove('error');
            }

            if (email.value.trim() === '') {
                emailError.style.display = 'block';
                email.classList.add('error');
                isValid = false;
            } else {
                emailError.style.display = 'none';
                email.classList.remove('error');
            }

            if (password.value.trim() === '') {
                passwordError.style.display = 'block';
                password.classList.add('error');
                isValid = false;
            } else {
                passwordError.style.display = 'none';
                password.classList.remove('error');
            }

            if (phone.value.trim() === '' || isNaN(phone.value) || phone.value.length !== 10) {
                phoneError.style.display = 'block';
                phone.classList.add('error');
                isValid = false;
            } else {
                phoneError.style.display = 'none';
                phone.classList.remove('error');
            }

            if (address.value.trim() === '') {
                addressError.style.display = 'block';
                address.classList.add('error');
                isValid = false;
            } else {
                addressError.style.display = 'none';
                address.classList.remove('error');
            }

            return isValid;
        }
    </script>

</body>

</html>