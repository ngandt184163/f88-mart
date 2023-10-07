<?php
get_header("", $data);
?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="<?php echo base_url(); ?>" title="">Trang chủ</a>
                    </li>
                    <?php
                        for ($i = count($list_parent_categories) - 1; $i >= 0; $i--) {
                            $item = $list_parent_categories[$i];
                            ?>
                            <li>
                                <a href="?mod=product&controller=index&action=categoryProduct&category_id=<?php echo $item['category_id'] ?>" title=""><?php echo $item['name'] ?></a>
                            </li>
                            <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <?php
            if(!empty($product)){
                ?>
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <a href="" title="" id="main-thumb">
                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg"/>
                            </a>
                            <div id="list-thumb">
                                <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="/images/img-pro-01.png" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name"><?php echo $product['name']; ?></h3>
                            <div class="desc"><?php echo $product['des_c']; ?></div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                <span class="status"><?php if($product['total'] > 0) echo "Còn hàng: {$product['total']}"; else echo "Hết hàng"; ?></span>
                            </div>
                            <p class="price"><?php echo currency_format($product['price']); ?></p>
                            <div id="num-order-wp">
                                <a title="" class="minus"><i class="fa fa-minus"></i></a>
                                <input style="width:40px;" require type="number" name="num-order" value="1" min="1" max="<?php echo $product['total']; ?>" id="num-order" class="num-order">
                                <a title="" class="plus"><i class="fa fa-plus"></i></a>
                            </div>
                            <a href="#" title="Thêm giỏ hàng" class="add-cart" data-product-id="<?php echo $product['product_id']; ?>">Thêm giỏ hàng</a>
                        </div>
                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail"><?php echo $product['content']; ?></div>
                </div>
                <?php
            }
            ?>

            <?php
            if(!empty($list_same_categories)){
                
                
            }
            ?>
            
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        foreach($list_same_categories as $item) {
                            ?>
                            <li>
                                <a href="" title="" class="thumb">
                                    <img src="/images/<?php echo $item['image']; ?>">
                                </a>
                                <a href="?mod=product&controller=index=action=detailProduct&product_id=<?php echo $item['product_id']; ?>" title="" class="product-name"><?php echo $item['name']; ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($item['price']); ?></span>
                                    <!-- <span class="old">20.900.000đ</span> -->
                                </div>
                                <div class="action clearfix">
                                    <a href="?mod=cart&controller=index&action=addCart&product_id=<?php echo $item['product_id']; ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="?mod=cart&controller=index&action=cart" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
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