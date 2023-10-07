<?php
session_start();
ob_start();

// thoi gian
date_default_timezone_set("Asia/Ho_Chi_Minh");

/*
 * ---------------------------------------------------------
 * BASE URL
 * ---------------------------------------------------------
 * Cấu hình đường dẫn gốc của ứng dụng
 * Ví dụ: 
 * http://hocweb123.com đường dẫn chạy online 
 * http://localhost/yourproject.com đường dẫn dự án ở local
 * 
 */

$config['base_url'] = "https://f88-mart.vercel.app/";


$config['default_module'] = 'post';
$config['default_controller'] = 'index';
$config['default_action'] = 'index';












