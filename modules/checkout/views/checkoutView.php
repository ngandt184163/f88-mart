<?php
get_header();
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="<?php echo base_url(); ?>" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="#" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <form method="POST" action="" name="form-checkout">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="name">Họ tên</label>
                            <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>">
                            <?php echo form_error("name"); ?>
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="not-allowed" value="<?php echo $user['email']; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" value="<?php echo $user['address']; ?>">
                            <?php echo form_error("address"); ?>
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" value="<?php echo $user['phone']; ?>">
                            <?php echo form_error("phone"); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note"><?php echo set_value('note'); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($list_orders)) {
                                foreach($list_orders as $item) {
                                    ?>
                                    <tr class="cart-item">
                                        <td class="product-name"><?php echo $item['name']; ?><strong class="product-quantity">x <?php echo $item['total']; ?></strong></td>
                                        <td class="product-total"><?php echo currency_format($item['total_price']); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price"><?php echo currency_format($cart['total_price']); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input <?php if(set_value('type_payment') == 2) echo "checked='checked'"; ?> type="radio" id="direct-payment" name="type_payment" value="2">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input <?php if(set_value('type_payment') == 1) echo "checked='checked'"; ?> type="radio" id="payment-home" name="type_payment" value="1">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                            <?php echo form_error("type_payment"); ?>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" name="btn-order" id="order-now" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
get_footer();
?>