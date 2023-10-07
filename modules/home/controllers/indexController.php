<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    // load("helper", "sidebar");
}

function indexAction() {
    // lay danh sach danh muc
    $list_categories = get_list_categories();
    // danh sach san pham ban chay
    $best_sale = get_list_best_sale();
    // show_array($list_categories);
    // die();

    

    // gio hang, neu da dang nhap moi co gio hang
    global $cart, $list_orders, $list_search, $phones, $laptops;
    if(isset($_SESSION['is_login'])) {
        $user_id = info_user('user_id');
        $cart = get_cart($user_id);
        // echo $user_id;
        // show_array($cart);
        // die();
        if(!empty($cart)){
            $cart = $cart[0];
            $list_orders = get_list_orders($cart['sale_id']);
            // show_array($list_orders);
            // die();
        }
    }

    // if(isset($_POST['btn'])){
    //     $search = $_POST['search'];
    //     $list_search = get_list_search($search);
    //     $data['is_search'] = true;
    //     $data['search'] = $search;
    // }else {
    //     // lay 10 san pham dien thoai
    //     $phones = get_list_phones();
    //     $laptops = get_list_laptops();
    //     $data['is_search'] = false;
    //     $data['search'] = '';
    // }

    $phones = get_list_phones();
    $laptops = get_list_laptops();
    

    $data['list_categories'] = $list_categories;
    $data['best_sale'] = $best_sale;
    $data['phones'] = $phones;
    $data['laptops'] = $laptops;
    $data['cart'] = $cart;
    $data['list_orders'] = $list_orders;
    // $data['list_search'] = $list_search;

    load_view("home", $data);
}