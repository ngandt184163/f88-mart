<?php
    get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li <?php if(empty($status)) echo "style='background-color:#abe092;'"; ?> class="all"><a href="?mod=sales&controller=index&action=listOrder">Tất cả <span class="count">(<?php if(empty($status)) echo count($list_orders) ?>)</span></a> |</li>
                            <li <?php if($status == 1) echo "style='background-color:#abe092;'"; ?> class="publish"><a href="?mod=sales&controller=index&action=listOrder&status=1">Chờ xét duyệt<span class="count">(<?php if($status == 1) echo count($list_orders) ?>)</span></a> |</li>
                            <li <?php if($status == 2) echo "style='background-color:#abe092;'"; ?> class="pending"><a href="?mod=sales&controller=index&action=listOrder&status=2">Đang vận chuyển<span class="count">(<?php if($status == 2) echo count($list_orders) ?>)</span> |</a></li>
                            <li <?php if($status == 3) echo "style='background-color:#abe092;'"; ?> class="pending"><a href="?mod=sales&controller=index&action=listOrder&status=3">Thành công<span class="count">(<?php if($status == 3) echo count($list_orders) ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Công khai</option>
                                <option value="1">Chờ duyệt</option>
                                <option value="2">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số sản phẩm</span></td>
                                    <td><span class="thead-text">Tổng giá</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Chi tiết</span></td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $index = 0;
                                if(!empty($list_orders)) {
                                    // show_array($list_orders);
                                    // die();
                                    foreach($list_orders as $order){
                                        $index++;
                                    ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php echo $index; ?></h3></span>
                                    <td><span class="tbody-text"><?php echo $order['code']; ?></h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo get_info_user($order['user_id'], "name") ?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="#" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=sales&controller=index=action=deleteSale" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $order['total']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $order['total_price']; ?></span></td>
                                    <td><span class="tbody-text"><?php 
                                        if($order['status'] == 0) echo "Đang trong giỏ hàng";
                                        if($order['status'] == 1) echo "Chờ duyệt";
                                        if($order['status'] == 2) echo "Đang vận chuyển";
                                        if($order['status'] == 3) echo "Thành công";
                                    ?></span></td>
                                    <td><span class="tbody-text"><?php echo $order['created_at']; ?></span></td>
                                    <td><a href="?mod=sales&controller=index&action=detailOrder&sale_id=<?php echo $order['sale_id']; ?>" title="" class="tbody-text">Chi tiết</a></td>
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
                                    <td><span class="tfoot-text">Mã đơn hàng</span></td>
                                    <td><span class="tfoot-text">Họ và tên</span></td>
                                    <td><span class="tfoot-text">Số sản phẩm</span></td>
                                    <td><span class="tfoot-text">Tổng giá</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                    <td><span class="tfoot-text">Chi tiết</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title=""><</a>
                        </li>
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                        <li>
                            <a href="" title="">></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    get_footer();
?>