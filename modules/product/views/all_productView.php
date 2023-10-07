<?php
get_header("", $data);
?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="<?php echo base_url(); ?>" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="#" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Tất cả sản phẩm</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <?php echo count($list_products); ?> trên <?php echo $pagination['per_page']; ?> sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option <?php if(set_value('option')== "1") echo "selected='selected'"; ?> value="1">Từ A-Z</option>
                                    <option <?php if(set_value('option')== "2") echo "selected='selected'"; ?> value="2">Từ Z-A</option>
                                    <option <?php if(set_value('option')== "3") echo "selected='selected'"; ?> value="3">Giá cao xuống thấp</option>
                                    <option <?php if(set_value('option')== "4") echo "selected='selected'"; ?> value="4">Giá thấp lên cao</option>
                                </select>
                                <input type="submit" name="btn-filter" value="Lọc">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                        if(!empty($list_products)) {
                            foreach($list_products as $item) {
                                ?>
                                <li>
                                    <a href="?mod=product&controller=index&action=detailProduct&product_id=<?php echo $item['product_id']; ?>" title="" class="thumb">
                                        <img src="/images/<?php echo $item['image']; ?>">
                                    </a>
                                    <a href="?mod=product&controller=index&action=detailProduct&product_id=<?php echo $item['product_id']; ?>" title="" class="product-name"><?php echo $item['name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']); ?></span>
                                        <!-- <span class="old">20.900.000đ</span> -->
                                    </div>
                                    <div class="action clearfix">
                                        <a href="#" title="Thêm giỏ hàng" class="add-cart fl-left" data-product-id="<?php echo $item['product_id']; ?>">Thêm giỏ hàng</a>
                                        <a href="?mod=product&controller=index&action=detailProduct&product_id=<?php echo $item['product_id']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                        if($pagination['page'] > 1){
                            ?>
                            <li><a href="<?php echo $data['url']; ?>&page=<?php echo ($pagination['page']-1) ?>"><<</a></li>
                            <?php
                        }
                        ?>
                        
                        <?php
                        for($i = 1; $i <= $pagination['num_page']; $i++){
                            ?>
                        <li <?php if($i == $pagination['page']) echo "class = 'active_page'"?>><a href="<?php echo $data['url']; ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php
                        }
                        ?>
                        <?php
                        if($pagination['page'] < $pagination['num_page']){
                            ?>
                            <li><a href="<?php echo $data['url']; ?>&page=<?php echo ($pagination['page']+1) ?>">>></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <?php 
            get_sidebar("1", $data);
            get_sidebar("3");
            ?>
        </div>
    </div>
</div>

<?php
get_footer();
?>

<script>
    var base_url = "<?php echo base_url(); ?>";
    var is_login = "<?php if(isset($_SESSION['is_login'])) echo $_SESSION['is_login']; ?>";
    var url_login = "<?php echo base_url(); ?>" + "?mod=users&controller=index&action=login";
    addCart(base_url, is_login, url_login);
</script>