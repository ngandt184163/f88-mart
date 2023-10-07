<?php
    get_header();
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <?php 
            if($data['role'] == 1){
                ?>
                <a href="?mod=users&controller=team&action=addUser" title="" id="add-new" class="fl-left">Thêm mới</a>
                <?php
            }
            ?>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar('user');
        // print_r($data);
        if(isset($data['status'])) echo $data['status'];
        ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
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
        </div>
    </div>
</div>

<?php
    get_footer();
?>