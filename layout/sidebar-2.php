<div class="section" id="selling-wp">
    <div class="section-head">
        <h3 class="section-title">Sản phẩm bán chạy</h3>
    </div>
    <div class="section-detail">
        <ul class="list-item">
            <?php
            if(!empty($best_sale)) {
                foreach($best_sale as $item){
                    ?>
                    <li class="clearfix">
                        <a href="?mod=product&controller=index&action=detailProduct&product_id=<?php echo $item['product_id']; ?>" title="" class="thumb fl-left">
                            <img src="public/images/<?php echo $item['image']; ?>" alt="">
                        </a>
                        <div class="info fl-right">
                            <a href="?mod=product&controller=index&action=detailProduct&product_id=<?php echo $item['product_id']; ?>" title="" class="product-name"><?php echo $item['name']; ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['price']); ?></span>
                                <!-- <span class="old">7.190.000đ</span> -->
                            </div>
                            <a href="?mod=product&controller=index&action=detailProduct&product_id=<?php echo $item['product_id']; ?>" title="" class="buy-now">Mua ngay</a>
                        </div>
                    </li>
                    <?php
                }
            }
            ?>
            <!-- <li class="clearfix">
                <a href="?mod=product&controller=index&action=detailProduct" title="" class="thumb fl-left">
                    <img src="public/images/img-pro-13.png" alt="">
                </a>
                <div class="info fl-right">
                    <a href="?mod=product&controller=index&action=detailProduct" title="" class="product-name">Laptop Asus A540UP I5</a>
                    <div class="price">
                        <span class="new">5.190.000đ</span>
                        <span class="old">7.190.000đ</span>
                    </div>
                    <a href="" title="" class="buy-now">Mua ngay</a>
                </div>
            </li> -->
        </ul>
    </div>
</div>