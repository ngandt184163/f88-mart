<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Doi mat khau</title>
        <link rel="stylesheet" href="/css/login.css">
    </head>
    <body>

    <h2 class="title">Doi mat khau</h2>

    <form action="" enctype="multipart/form-data" method="POST">
        <div class="container">
            <label for="password_1"><b>Mat khau moi</b></label>
            <input type="password" name="password_1" id="password_1">
            <?php echo form_error('password'); ?>

            <label for="password_2"><b>Xac nhan mat khau</b></label>
            <input type="password" name="password_2" id="password_2">
            <?php echo form_error('password'); ?>
                
            <input class="login" type="submit" name="btn" value="Luu mat khau">
            <?php echo form_error('account'); ?>
            
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <a href="?mod=users&controller=index&action=login">Dang nhap</a>
        </div>
    </form>

    </body>
</html>