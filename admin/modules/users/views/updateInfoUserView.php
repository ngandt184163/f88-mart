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
                        <input type="text" name="name" id="name" class="not-allowed" value="<?php echo $data['name']; ?>" readonly="readonly">

                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="not-allowed" value="<?php echo $data['email']; ?>" readonly="readonly">

                        <label for="active">Active</label>
                        <input <?php if($data['is_active']== 0) echo "checked='checked'"; ?> type="radio" name="active" value="0"> Chờ kích hoạt <br>
                        <input <?php if($data['is_active']==1) echo "checked='checked'"; ?> type="radio" name="active" value="1"> Đang hoạt động <br>
                        <input <?php if($data['is_active']==2) echo "checked='checked'"; ?> type="radio" name="active" value="2"> Tắt <br>
                        <br>

                        <label for="role">Role</label>
                        <input <?php if($data['role_']== 1) echo "checked='checked'"; ?> type="radio" name="role" value="1"> Toàn quyền <br>
                        <input <?php if($data['role_']==2) echo "checked='checked'"; ?> type="radio" name="role" value="2"> Biên tập viên <br>
                        <input <?php if($data['role_']==3) echo "checked='checked'"; ?> type="radio" name="role" value="3"> Cộng tác viên <br>
                        <br>

                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" class="not-allowed" readonly="readonly" value="<?php echo $data['phone']; ?>">

                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address" class="not-allowed" readonly="readonly"><?php echo $data['address']; ?></textarea>

                        <label for="gender">Giới tính</label>
                        <input <?php if($data['gender'] =="male") echo "checked='checked'"; ?> type="radio" name="gender" value="male" class="not-allowed" disabled> Nữ
                        <input <?php if($data['gender'] =="female") echo "checked='checked'"; ?> type="radio" name="gender" value="female" class="not-allowed" disabled> Nam
                        <br>
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