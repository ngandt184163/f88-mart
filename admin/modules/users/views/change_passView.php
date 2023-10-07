<?php
    get_header();
?>
<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
        <?php 
            if($data['role'] == 1){
                ?>
                <a href="?mod=users&controller=team&action=addUser" title="" id="add-new" class="fl-left">Thêm mới</a>
                <?php
            }
            ?>
            <h3 id="index" class="fl-left">Đổi mật khẩu</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar('user');
        if(isset($data['status'])) echo $data['status'];
        ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="old-pass">Mật khẩu cũ</label>
                        <input type="password" name="password_0" id="old-pass">
                        <?php echo form_error('password_0'); ?>

                        <label for="password_1"><b>Mat khau moi</b></label>
                        <input type="password" name="password_1" id="password_1">
                        <?php echo form_error('password_1'); ?>

                        <label for="password_2"><b>Xac nhan mat khau</b></label>
                        <input type="password" name="password_2" id="password_2">
                        <?php echo form_error('password_2'); ?>

                        <input class="login" type="submit" name="btn" value="Cap nhat">
                        <?php echo form_error('password'); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    get_footer();
?>