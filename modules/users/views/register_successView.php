<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang 404 - Không tìm thấy</title>
    <style>
        /* CSS nội bộ (internal CSS) */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            text-align: center;
            margin-top: 100px;
        }

        h1 {
            font-size: 36px;
            color: #333;
        }

        p {
            font-size: 18px;
            color: #666;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Đăng ký tài khoản thành công!</h1>
        <p>Vui lòng kiểm tra email và làm theo hướng dẫn để xác thực tài khoản.</p>
        <p>Quay lại trang chủ <a href="<?php echo base_url(); ?>">ở đây</a>.</p>
    </div>
</body>
</html>
