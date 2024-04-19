<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

// Kiểm tra 
if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    require_once "./models/database.php";
    $login_email = $_POST['email'];
    $login_password = $_POST['password'];

    $sql = "SELECT `name`, `email`, `password`, `status` FROM `users` WHERE `email` = '$login_email'";

    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Kiểm tra mật khẩu
        if (password_verify($login_password, $row['password'])) {
            $_SESSION['user_login'] = $row;
            header('Location: index.php');
            exit;
        } else {
            echo "Sai tài khoản hoặc mật khẩu.";
        }
    }
}
