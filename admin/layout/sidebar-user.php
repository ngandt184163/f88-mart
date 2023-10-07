<div id="sidebar" class="fl-left">
    <ul id="list-cat">
        <li>
            <a href="?mod=users&controller=index&action=infoAccount" title="">Cập nhật thông tin</a>
        </li>
        <li>
            <a href="?mod=users&controller=index&action=changePass" title="">Đổi mật khẩu</a>
        </li>
        <li>
            <?php 
            if($data['role'] == 1){
                ?>
                <a href="?mod=users&controller=team&action=index" title="">Nhóm quản trị</a>
                <?php
            }
            ?>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>" title="">Thoát</a>
        </li>
    </ul>
</div>