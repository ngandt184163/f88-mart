
<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quen mat khau</title>
        <link rel="stylesheet" href="/css/login.css">
    </head>
    <body>

    <h2 class="title">Quen mat khau</h2>

    <form action="" enctype="multipart/form-data" method="POST">
        <div class="container">
            <label for="email"><b>Email</b></label>
            <input type="email" name="email" id="email" value="<?php echo set_value('email'); ?>"><br>
            <?php echo form_error('email'); ?>

            <input class="login" type="submit" name="btn" value="Xac nhan email">
            <?php echo form_error('account'); ?>
            
        </div>

        <div class="container" style="background-color:#f1f1f1">
        <a href="?mod=users&controller=index&action=login">Dang nhap</a>
        </div>
    </form>

    </body>
</html>

