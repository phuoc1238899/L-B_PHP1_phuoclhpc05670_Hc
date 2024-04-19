<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="/css/css.css">
</head>

<body>

    <div class="background">
        <div class="shape"></div>
    </div>

    <form class="row login_form" action="loginxl.php" method="post" id="contactForm" novalidate="novalidate">
        <h4>Đăng Nhập</h4>
        <label for="name">Email</label>
        <input type="text" class="form-control" required id="email" name="email" placeholder="Nhập Email">
        <span class="error-message" id="email-error">Vui lòng điền Email</span>
        <label for="password">Mật Khẩu</label>
        <input type="password" class="form-control" required id="password" name="password" placeholder="Nhập Password">
        <span class="error-message" id="password-error">Vui lòng điền Mật khẩu</span>
        <button type="submit" value="submit" name="login" onclick="return validateForm()">Đăng nhập</button>
        <div class="register-link">
            <a href="register.php">Đăng kí</a>
        </div>
    </form>

    <script>
        function validateForm() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var emailError = document.getElementById('email-error');
            var passwordError = document.getElementById('password-error');

            if (email.trim() === '') {
                emailError.style.display = 'block';
                return false;
            } else {
                emailError.style.display = 'none';
            }

            if (password.trim() === '') {
                passwordError.style.display = 'block';
                return false;
            } else {
                passwordError.style.display = 'none';
            }

            return true;
        }
    </script>

</body>

</html>