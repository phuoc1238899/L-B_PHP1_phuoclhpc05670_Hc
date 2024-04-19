<?php

$hostname_db = "localhost";
$username_db = "root";
$password_db = "mysql";
$database_db = "asm2_php";
$connection = new mysqli(
    $hostname_db,
    $username_db,
    $password_db,
    $database_db,
);
if ($connection->connect_error) {
    die("Lỗi kết nối database" . $connection->connect_error);
}
