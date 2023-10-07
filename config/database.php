<?php

/*
 * --------------------------------
 * CẤU HÌNH DATABASE
 * --------------------------------
 * Trong phần này chúng ta khai báo các thông số để cấu hình
 * Kết nối đến DB
 * --------------------------------
 * GIẢI THÍCH BIẾN
 * --------------------------------
 * hostname: Tên server
 * username: Tên đăng nhập kết nối nối
 * password: Mật khẩu kết nối
 * database: Tên database kết nối
 */

$db = array(
    'hostname' => $_ENV['DB_HOST'],
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'database' => $_ENV['DB_NAME'],
);


