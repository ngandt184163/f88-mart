<?php
    get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="detail-exhibition fl-right">
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <ul class="list-item">
                    <li>
                        <h3 class="title">Mã đơn hàng</h3>
                        <span class="detail"><?php echo $sale['code']; ?></span>
                    </li>
                    <li>
                        <h3 class="title">Địa chỉ nhận hàng</h3>
                        <span class="detail"><?php echo $sale['name']."/".$sale['address']."/".$sale['phone']; ?></span>
                    </li>
                    <li>
                        <h3 class="title">Thông tin vận chuyển</h3>
                        <span class="detail">
                            <?php
                            if($sale['type_payment'] == 1) echo "Thanh toán tại nhà"; 
                            if($sale['type_payment'] == 2) echo "Thanh toán online";
                            ?>
                        </span>
                    </li>
                    <form method="POST" action="">
                        <li>
                            <h3 class="title">Tình trạng đơn hàng</h3>
                            <form action="" method="POST">
                            <select class="status" name="status">
                                <option <?php if($sale['status'] == 1) echo "selected='selected'"; ?> value='1'>Chờ duyệt</option>
                                <option <?php if($sale['status'] == 2) echo "selected='selected'"; ?> value='2'>Đang vận chuyển</option>
                                <option <?php if($sale['status'] == 3) echo "selected='selected'"; ?> value='3'>Thành công</option>                            </select>
                                <!-- <input id="btn-update-status" type="submit" name="btn" value="Cập nhật đơn hàng"> -->
                                <button id="btn-update-status">Cập nhật đơn hàng</button>
                            </form>
                            
                        </li>
                    </form>
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh sản phẩm</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $index = 0;
                        if(!empty($list_order)) {
                            foreach($list_order as $order){
                                $index++;
                            ?>
                            <tr>
                                <td class="thead-text"><?php echo $index; ?></td>
                                <td class="thead-text">
                                    <div class="thumb">
                                        <img src="public/images/<?php echo $order['image']; ?>" alt="">
                                    </div>
                                </td>
                                <td class="thead-text"><?php echo $order['name']; ?></td>
                                <td class="thead-text"><?php echo currency_format($order['price']); ?></td>
                                <td class="thead-text"><?php echo $order['total']; ?></td>
                                <td class="thead-text"><?php echo currency_format($order['total_price']); ?></td>
                            </tr>
                            <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee"><?php echo $sale['total'] ?></span>
                            <span class="total"><?php echo currency_format($sale['total_price']); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
    get_footer();
?>