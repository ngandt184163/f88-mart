<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo base_url(); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dang ki</title>
    <link rel="stylesheet" href="public/css/login.css">
</head>
<body>
    <div class="container">
        <form action="" enctype="multipart/form-data" method="POST">
            <label for="username">UserName</label><br>
            <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>"><br>
            <?php echo form_error('username'); ?>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" value="<?php echo set_value('email'); ?>"><br>
            <?php echo form_error('email'); ?>
            <label for="pass">Mat khau</label><br>
            <input type="password" name="password" id="password">
            <?php echo form_error('password'); ?>
            <input type="checkbox" value="yes" name="remember_me"> Remember me
            <br>
            
            <a href="?mod=users&controller=index&action=login">Dang nhap</a>
            <input type="submit" name="btn">
            <?php echo form_error('account'); ?>
        </form>
    </div>
</body>
</html>