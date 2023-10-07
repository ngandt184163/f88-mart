<?php
    get_header("", $data);
    
    // show_array($data);
    // die();
?>
<div id="main-content-wp" class="info-account-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="info-account-wp">
                <form method="POST">
                    <label for="old-pass">Mật khẩu cũ</label>
                    <input type="password" name="password_0" id="old-pass">
                    <?php echo form_error('password_0'); ?>

                    <label for="password_1"><b>Mật khẩu mới</b></label>
                    <input type="password" name="password_1" id="password_1">
                    <?php echo form_error('password_1'); ?>

                    <label for="password_2"><b>Xác nhận mật khẩu</b></label>
                    <input type="password" name="password_2" id="password_2">
                    <?php echo form_error('password_2'); ?>

                    <input class="login" type="submit" name="btn" value="Cập nhật">
                    <?php echo form_error('password'); ?>
                </form>
            </div>
        </div>
        <div class="sidebar fl-left">
            <?php 
            // show_array($data[1]);
            // die(); 
            get_sidebar("user", $data);
            ?>
        </div>
    </div>
</div>

<?php
    get_footer();
?>