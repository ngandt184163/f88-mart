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
                    <label for="name">Tên</label>
                    <input type="text" name="name" id="name" value="<?php echo $data['name']; ?>">
                    <?php echo form_error('name'); ?>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="not-allowed" value="<?php echo $data['email']; ?>" readonly="readonly">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $data['phone']; ?>">
                    <?php echo form_error('phone'); ?>

                    <label for="address">Địa chỉ</label>
                    <textarea name="address" id="address"><?php echo $data['address']; ?></textarea>
                    <?php echo form_error('address'); ?>

                    <label for="gender">Giới tính</label>
                    <input <?php if($data['gender'] =="male") echo "checked='checked'"; ?> type="radio" name="gender" value="male"> Nữ
                    <input <?php if($data['gender'] =="female") echo "checked='checked'"; ?> type="radio" name="gender" value="female"> Nam
                    <br>
                    <?php echo form_error('gender'); ?>
                    <input type="submit" name="btn" id="btn-submit" value="Cap nhat">
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