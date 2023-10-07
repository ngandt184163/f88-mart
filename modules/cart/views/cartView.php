<?php
get_header();
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
                        <a href="#" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
            <form action="" method="POST">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                        if(!empty($list_orders)) {
                            foreach($list_orders as $item) {
                                ?>
                                <tr>
                                    <td><?php echo $item['code']; ?></td>
                                    <td>
                                        <a href="?mod=product&controller=index&action=detailProduct&product_id=<?php echo $item['product_id']; ?>" title="" class="thumb">
                                            <img src="public/images/<?php echo $item['image']; ?>" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" title="" class="name-product"><?php echo $item['name']; ?></a>
                                    </td>
                                    <td><?php echo currency_format($item['price']); ?></td>
                                    <td>
                                        <div id="num-order-wp">
                                            <a title="" class="minus"><i class="fa fa-minus"></i></a>
                                            <input type="number" required name="<?php echo $item['product_id']; ?>" value="<?php echo $item['total']; ?>"min="1" max="<?php echo $item['total_p']; ?>" id="num-order" class="num-order">
                                            <a title="" class="plus"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </td>
                                    <td><?php echo currency_format($item['total_price']); ?></td>
                                    <td>
                                        <a href="?mod=cart&controller=index&action=deleteProduct&product_id=<?php echo $item['product_id']; ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format($cart['total_price']); ?></span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <!-- <a href="" title="" id="update-cart">Cập nhật giỏ hàng</a> -->
                                        <input type="submit" name="btn_update_cart" value="Cập nhật giỏ hàng">
                                        <a href="?mod=checkout&controller=index&action=checkout" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="<?php echo base_url(); ?>" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="?mod=cart&controller=index&action=deleteCart" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>