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
            <h3 id="index" class="fl-left">Danh sách quản trị viên</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar('user');
        ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(10)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(5)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt <span class="count">(5)</span></a></li>
                            <li class="trash"><a href="">Thùng rác <span class="count">(0)</span></a></li>
                        </ul>
                        <form method="POST" class="form-s fl-right">
                            <input type="text" name="search" id="search"  placeholder="Enter name">
                            <input type="submit" name="btn" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Chỉnh sửa</option>
                                <option value="2">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div>
                    <table class="table list-table-wp">
                        <thead>
                            <tr>
                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">User_Id</span></td>
                                <td><span class="thead-text">Name</span></td>
                                <td><span class="thead-text">Email</span></td>
                                <td><span class="thead-text">Active</span></td>
                                <td><span class="thead-text">Role</span></td>
                                <td><span class="thead-text">Phone</span></td>
                                <td><span class="thead-text">Address</span></td>
                                <td><span class="thead-text">Gender</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 0;
                            if(!empty($list_users)) {
                                foreach($list_users as $user){
                                    $index++;
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                        <td><span class="tbody-text"><?php echo $index; ?></h3></span>
                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo $user['user_id']; ?></a>
                                            </div>
                                            <ul class="list-operation fl-right">
                                                <li><a href="?mod=users&controller=team&action=updateInfoUser&email=<?php echo $user['email']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <li><a href="?mod=users&controller=team&action=deleteUser&email=<?php echo $user['email']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $user['name']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $user['email']; ?></span></td>
                                        <td><span class="tbody-text"><?php if($user['is_active']==0) echo "Chờ kích hoạt"; else if($user['is_active']==1) echo "Đang hoạt động"; ?></span></td>
                                        <td><span class="tbody-text"><?php if($user['role']==1) echo "Toàn quyền"; else if($user['role']==2) echo "Biên tập viên"; else if($user['role']==3) echo "Cộng tác viên"; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $user['phone']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $user['address']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $user['gender']; ?></span></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                <td><span class="tfoot-text">STT</span></td>
                                <td><span class="tfoot-text">Tiêu đề</span></td>
                                <td><span class="tfoot-text">Danh mục</span></td>
                                <td><span class="tfoot-text">Trạng thái</span></td>
                                <td><span class="tfoot-text">Người tạo</span></td>
                                <td><span class="tfoot-text">Thời gian</span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    get_footer();
?>