<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction() {
    // danh sach san pham ban chay
    $best_sale = get_list_best_sale();

    // gio hang, neu da dang nhap moi co gio hang
    global $cart, $list_orders, $list_search, $phones, $laptops;
    if(isset($_SESSION['is_login'])) {
        $user_id = info_user('user_id');
        $cart = get_cart($user_id);
        if(!empty($cart)){
            $cart = $cart[0];
            $list_orders = get_list_orders($cart['sale_id']);
        }
    }

    // lay bai viet co post_id
    $page_id = $_GET['page_id'];

    $page = get_page_by_id($page_id);

    $data['best_sale'] = $best_sale;
    $data['cart'] = $cart;
    $data['list_orders'] = $list_orders;
    $data['page'] = $page;

    load_view("index", $data);
}