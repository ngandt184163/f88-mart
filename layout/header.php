<!DOCTYPE html>
<html>
    <head>
        <title>F88 STORE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="/reset.css" rel="stylesheet" type="text/css"/>
        <link href="/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="/css/carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <link href="/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <link href="/style.css" rel="stylesheet" type="text/css"/>

        <!-- STYLE CSS -->
        <link href="css/import/fonts.css" rel="stylesheet" type="text/css"/>
        <link href="css/import/global.css" rel="stylesheet" type="text/css"/>
        <link href="css/import/header.css" rel="stylesheet" type="text/css"/>
        <link href="css/import/footer.css" rel="stylesheet" type="text/css"/>
        <link href="css/import/home.css" rel="stylesheet" type="text/css"/>
        <link href="css/import/category_product.css" rel="stylesheet" type="text/css"/>
        <link href="css/import/blog.css" rel="stylesheet" type="text/css"/>
        <link href="css/import/detail_product.css" rel="stylesheet" type="text/css"/>
        <link href="css/import/detail_blog.css" rel="stylesheet" type="text/css"/>
        <link href="css/import/cart.css" rel="stylesheet" type="text/css"/>
        <link href="css/import/checkout.css" rel="stylesheet" type="text/css"/>
        <link href="css/import/info_account.css" rel="stylesheet" type="text/css"/>
        <link href="css/import/list_cart_order.css" rel="stylesheet" type="text/css"/>
        <link href="css/import/detail_order.css" rel="stylesheet" type="text/css"/>
        <!-- ===================== -->

        <link href="/responsive.css" rel="stylesheet" type="text/css"/>

        <script src="/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        
        <!-- <script src="public/js/code.jquery.com_jquery-3.7.1.min.js" type="text/javascript"></script> -->
        <script src="/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
        <script src="/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="/js/carousel/owl.carousel.js" type="text/javascript"></script>
        <script src="/js/main.js" type="text/javascript"></script>

    </head>
    <body>
        <div id="status-message" class="hidden">
            message
        </div>
        <!-- <div id="test"> click here</div> -->

        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                            <div id="main-menu-wp" class="fl-right">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        <a href="<?php echo base_url(); ?>" title="">Trang chủ</a>
                                    </li>
                                    <li>
                                        <a href="?mod=product&controller=index&action=allProduct" title="">Sản phẩm</a>
                                    </li>
                                    <li>
                                        <a href="?mod=post&controller=index&action=blog" title="">Blog</a>
                                    </li>
                                    <li>
                                        <a href="?mod=page&controller=index&action=index&page_id=1" title="">Giới thiệu</a>
                                    </li>
                                    <li>
                                        <a href="?mod=page&controller=index&action=index&page_id=2" title="">Liên hệ</a>
                                    </li>
                                    <?php
                                    if(is_login()) {
                                        ?>
                                        <li>
                                            <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                                                <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <div id="thumb-circle" class="fl-left">
                                                        <img src="/images/<?php if(!empty(info_user('image'))) echo info_user('image'); else echo "img-admin.png"; ?>">
                                                    </div>
                                                    <h3 id="account" class="fl-right"><?php echo info_user('name'); ?></h3>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li style="float: none;"><a href="?mod=users&controller=index&action=infoAccount" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                                                    <li style="float: none;"><a href="?mod=cart&controller=index&action=listCartOders" title="list_cart_orders">Đơn mua</a></li>
                                                    <li style="float: none;"><a href="?mod=users&controller=index&action=logout" title="Thoát">Thoát</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <?php
                                    }else {
                                        ?>
                                        <li>
                                            <a href="?mod=users&controller=index&action=login" title="">Đăng nhập</a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="<?php echo base_url(); ?>" title="" id="logo" class="fl-left"><h1 class="logo">F88</h1></a>
                            <div id="search-wp" class="fl-left">
                                <form method="POST" action="?mod=product&controller=index&action=search">
                                    <input type="text" name="search" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!" value=<?php if(!empty($data['search'])) echo $data['search'] ?>>
                                    <input type="submit" id="sm-s" name="btn" value="Tìm kiếm">
                                    <!-- <a href="?mod=product&controller=index&action=search">Tìm kiếm</a> -->
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">Tư vấn</span>
                                    <span class="phone">0342.012.925</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="">2</span>
                                </a>
                                <div id="cart-wp" class="fl-right">
                                    <div id="btn-cart">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="num"><?php if(empty($cart)) echo ""; else echo $cart['total']; ?></span>
                                    </div>
                                    <?php
                                    // show_array($cart);
                                    // die();
                                    if(!empty($cart)) {
                                        ?>
                                        <div id="dropdown">
                                            <p id="total-in-cart" class="desc">Có <span><?php echo $cart['total'] ?> sản phẩm</span> trong giỏ hàng</p>
                                            <ul class="list-cart" id="order-list">
                                                <?php
                                                if(!empty($list_orders)) {
                                                    // show_array($list_orders);
                                                    // die();
                                                    foreach($list_orders as $item) {
                                                        ?>
                                                        <li class="clearfix">
                                                            <a href="" title="" class="thumb fl-left">
                                                                <img src="/images/<?php echo $item['image']; ?>" alt="">
                                                            </a>
                                                            <div class="info fl-right">
                                                                <a href="" title="" class="product-name"><?php echo $item['name']; ?></a>
                                                                <p class="price"><?php echo currency_format($item['price']); ?></p>
                                                                <p class="qty">Số lượng: <span><?php echo $item['total']; ?></span></p>
                                                            </div>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                            <div class="total-price clearfix">
                                                <p class="title fl-left">Tổng:</p>
                                                <p id="total-payment" class="price fl-right"><?php echo currency_format($cart['total_price']); ?></p>
                                            </div>
                                            <dic class="action-cart clearfix">
                                                <a href="?mod=cart&controller=index&action=cart" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                                <a href="?mod=checkout&controller=index&action=checkout" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                            </dic>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>