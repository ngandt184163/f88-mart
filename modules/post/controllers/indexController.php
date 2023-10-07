<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction() {
    load_view("index");
}

function blogAction() {
    global $cart, $list_orders, $list_blog;

    // danh sach san pham ban chay
    $best_sale = get_list_best_sale();

    // gio hang, neu da dang nhap moi co gio hang
    if(isset($_SESSION['is_login'])) {
        $user_id = info_user('user_id');
        $cart = get_cart($user_id);
        if(!empty($cart)){
            $cart = $cart[0];
            $list_orders = get_list_orders($cart['sale_id']);
        }
    }

    // phan trang
    $pagination['per_page'] = 12;
    $pagination['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
    $pagination['start'] = ($pagination['page']-1)*$pagination['per_page'];
    $pagination['total_item'] = get_total_item_blog(); 
    $pagination['num_page'] = ceil($pagination['total_item']/$pagination['per_page']);

    $list_blog = get_list_blog($pagination['start'], $pagination['per_page']);

    $data['best_sale'] = $best_sale;
    $data['cart'] = $cart;
    $data['list_orders'] = $list_orders;
    $data['list_blog'] = $list_blog;
    $data['pagination'] = $pagination;
    $data['url'] = "?mod=post&controller=index&action=blog";

    load_view("blog", $data);
}

function detailBlogAction() {

    // danh sach san pham ban chay
    $best_sale = get_list_best_sale();

    // gio hang, neu da dang nhap moi co gio hang
    global $cart, $list_orders, $list_search, $phones, $laptops;
    if(isset($_SESSION['is_login'])) {
        $user_id = info_user('user_id');
        $cart = get_cart($user_id);
        if(!empty($cart)){
            $list_orders = get_list_orders($cart[0]['sale_id']);
        }
    }

    // lay bai viet co post_id
    $post_id = $_GET['post_id'];

    $post = get_post_by_id($post_id);

    $data['best_sale'] = $best_sale;
    $data['cart'] = $cart;
    $data['list_orders'] = $list_orders;
    $data['post'] = $post;

    load_view("detail_blog", $data);
}

function categoryNewsAction() {
    load_view("detail_blog");
}

