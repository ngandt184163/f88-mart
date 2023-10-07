
<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng nhập</title>
        <link rel="stylesheet" href="/css/login.css">
    </head>
    <body>

    <h2 class="title">Đăng nhập</h2>

    <form action="" enctype="multipart/form-data" method="POST">
        <div class="imgcontainer">
            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="email"><b>Email</b></label>
            <input type="email" name="email" id="email" value="<?php echo set_value('email'); ?>"><br>
            <?php echo form_error('email'); ?>

            <label for="password"><b>Password</b></label>
            <input type="password" name="password" id="password">
            <?php echo form_error('password'); ?>
                
            <input class="login" type="submit" name="btn" value="Login">
            <?php echo form_error('account'); ?>
            <input class="remember_me" type="checkbox" value="yes" name="remember_me"> Remember me
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <span class=""><a href="?mod=users&controller=index&action=register">Đăng ký</a></span>
            <span class="psw"><a href="?mod=users&controller=index&action=resetPassword">Quên mật khẩu</a></span>
        </div>
    </form>

    </body>
</html>