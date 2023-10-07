<?php
    get_header("", $data);
    
    // show_array($data);
    // die();
?>

<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="<?php echo base_url(); ?>" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="#" title="">Đơn mua</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <div class="filter-wp clearfix">
                    <ul class="post-status fl-left">
                        <li <?php if(empty($status)) echo "style='background-color:#abe092;'"; ?> class="all"><a href="?mod=cart&controller=index&action=listCartOders">Tất cả <span class="count">(<?php if(empty($status)) echo count($list_cart_orders) ?>)</span></a> |</li>
                        <li <?php if($status == 1) echo "style='background-color:#abe092;'"; ?> class="publish"><a href="?mod=cart&controller=index&action=listCartOders&status=1">Chờ xét duyệt<span class="count">(<?php if($status == 1) echo count($list_cart_orders) ?>)</span></a> |</li>
                        <li <?php if($status == 2) echo "style='background-color:#abe092;'"; ?> class="pending"><a href="?mod=cart&controller=index&action=listCartOders&status=2">Đang vận chuyển<span class="count">(<?php if($status == 2) echo count($list_cart_orders) ?>)</span> |</a></li>
                        <li <?php if($status == 3) echo "style='background-color:#abe092;'"; ?> class="pending"><a href="?mod=cart&controller=index&action=listCartOders&status=3">Thành công<span class="count">(<?php if($status == 3) echo count($list_cart_orders) ?>)</span></a></li>
                        <li <?php if($status == -1) echo "style='background-color:#abe092;'"; ?> class="pending"><a href="?mod=cart&controller=index&action=listCartOders&status=-1">Đã hủy<span class="count">(<?php if($status == -1) echo count($list_cart_orders) ?>)</span></a></li>
                    </ul>
                    <!-- <form method="GET" class="form-s fl-right">
                        <input type="text" name="s" id="s">
                        <input type="submit" name="sm_s" value="Tìm kiếm">
                    </form> -->
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
                                <td><span class="thead-text">Số sản phẩm</span></td>
                                <td><span class="thead-text">Tổng giá</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                                <td><span class="thead-text">Chi tiết</span></td>
                                <?php
                                if(!empty($status) && $status == 1) {
                                    ?>
                                    <td><span class="thead-text">Hủy đơn hàng</span></td>
                                    <?php
                                }
                                ?>
                                <?php
                                if(!empty($status) && $status == -1) {
                                    ?>
                                    <td><span class="thead-text">Mua lại</span></td>
                                    <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $index = 0;
                            if(!empty($list_cart_orders)) {
                                // show_array($list_cart_orders);
                                // die();
                                foreach($list_cart_orders as $item){
                                    $index++;
                                ?>
                            <tr>
                                <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                <td><span class="tbody-text"><?php echo $index; ?></h3></span>
                                <td><span class="tbody-text"><?php echo $item['code']; ?></h3></span>
                                <td><span class="tbody-text"><?php echo $item['total']; ?></span></td>
                                <td><span class="tbody-text"><?php echo $item['total_price']; ?></span></td>
                                <td><span class="tbody-text"><?php 
                                    if($item['status'] == 0) echo "Đang trong giỏ hàng";
                                    if($item['status'] == 1) echo "Chờ duyệt";
                                    if($item['status'] == 2) echo "Đang vận chuyển";
                                    if($item['status'] == 3) echo "Thành công";
                                ?></span></td>
                                <td><span class="tbody-text"><?php echo $item['created_at']; ?></span></td>
                                <td><a href="?mod=cart&controller=index&action=detailOrder&sale_id=<?php echo $item['sale_id']; ?>" title="" class="tbody-text">Chi tiết</a></td>
                                <?php
                                if(!empty($status) && $status == 1) {
                                    ?>
                                    <td><a href="?mod=cart&controller=index&action=cancelOrder&sale_id=<?php echo $item['sale_id']; ?>" title="" class="tbody-text">Hủy đơn hàng</a></td>
                                    <?php
                                }
                                ?>
                                <?php
                                if(!empty($status) && $status == -1) {
                                    ?>
                                    <td><a href="?mod=checkout&controller=index&action=repurchase&sale_id=<?php echo $item['sale_id']; ?>" title="" class="tbody-text">Mua lại</a></td>
                                    <?php
                                }
                                ?>
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
                                <td><span class="tfoot-text">Số sản phẩm</span></td>
                                <td><span class="tfoot-text">Tổng giá</span></td>
                                <td><span class="tfoot-text">Trạng thái</span></td>
                                <td><span class="tfoot-text">Thời gian</span></td>
                                <td><span class="tfoot-text">Chi tiết</span></td>
                                <?php
                                if(!empty($status) && $status == 1) {
                                    ?>
                                    <td><span class="thead-text">Hủy đơn hàng</span></td>
                                    <?php
                                }
                                ?>
                                <?php
                                if(!empty($status) && $status == -1) {
                                    ?>
                                    <td><span class="thead-text">Mua lại</span></td>
                                    <?php
                                }
                                ?>
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