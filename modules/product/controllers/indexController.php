<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load("lib", "validation");
}

function indexAction() {
    load_view("index");
}

function detailAction() {
    // echo "hihi";
    if($_GET['id'] == 63) {
        echo "bai viet so 63";
    }else if($_GET['id'] == 1){
        load_view("product");
    }
}

function detailProductAction(){
    // lay danh sach danh muc
    $list_categories = get_list_categories();
    // danh sach san pham ban chay
    // $best_sale = get_list_best_sale();
    // show_array($list_categories);
    // die();

    

    // gio hang, neu da dang nhap moi co gio hang
    global $cart, $list_orders, $list_search, $product, $list_same_categories, $list_parent_categories;
    if(isset($_SESSION['is_login'])) {
        $user_id = info_user('user_id');
        $cart = get_cart($user_id);
        if(!empty($cart)){
            $cart = $cart[0];
            $list_orders = get_list_orders($cart['sale_id']);
        }
    }

    // if(isset($_POST['btn'])){
    //     $search = $_POST['search'];
    //     $list_search = get_list_search($search);
    //     $data['is_search'] = true;
    //     $data['search'] = $search;
    // }else {
    //     // lay 10 san pham dien thoai
    //     // $phones = get_list_phones();
    //     // $laptops = get_list_laptops();
    //     $product_id = $_GET['product_id'];
    //     $product = get_product_by_id($product_id);
    //     $list_same_categories = get_list_same_categories($product['category_id']);
    //     $list_parent_categories = get_list_parent_categories($product['category_id']);
    //     $data['is_search'] = false;
    //     $data['search'] = '';
    // }

    $product_id = $_GET['product_id'];
    $product = get_product_by_id($product_id);
    $list_same_categories = get_list_same_categories($product['category_id']);
    $list_parent_categories = get_list_parent_categories($product['category_id']);
   
    $data['list_categories'] = $list_categories;
    // $data['best_sale'] = $best_sale;
    // $data['phones'] = $phones;
    // $data['laptops'] = $laptops;
    $data['cart'] = $cart;
    $data['list_orders'] = $list_orders;
    $data['list_search'] = $list_search;
    $data['product'] = $product;
    $data['list_same_categories'] = $list_same_categories;
    $data['list_parent_categories'] = $list_parent_categories;

    load_view("detail_product", $data);
}

function categoryProductAction(){
    global $cart, $list_orders, $list_search, $list_products, $list_parent_categories, $search, $filter_from_price, $filter_to_price, $pagination, $option;
    $category_id = $_GET['category_id'];

    // lay danh sach danh muc
    $list_categories = get_list_categories();
    // lay danh sach danh muc cha
    $list_parent_categories = get_list_parent_categories($category_id);

    // show_array($list_categories);
    // die();


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
    $pagination['per_page'] = 2;
    $pagination['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
    $pagination['start'] = ($pagination['page']-1)*$pagination['per_page'];
    $pagination['total_item'] = get_total_item($category_id); 

    // loc dữ liệu
    if(isset($_POST['btn-filter']) && !empty($_POST['select'])) {
        $option = $_POST['select'];
    }else if(isset($_POST['btn-filter-price']) && (!empty($_POST['filter_from_price']) || !empty($_POST['filter_to_price']))) {
        $filter_from_price = $_POST['filter_from_price'];
        $filter_to_price = $_POST['filter_to_price'];
    }

    $list_products = get_list_products_by_category_id($category_id, $pagination['start'], $pagination['per_page'], $option, $filter_from_price, $filter_to_price);
    

    $data['list_categories'] = $list_categories;
    $data['list_products'] = $list_products;
    $data['cart'] = $cart;
    $data['list_orders'] = $list_orders;
    $data['list_parent_categories'] = $list_parent_categories;
    $data['category_name'] = get_info_category($category_id);
    $data['url'] = "?mod=product&controller=index&action=categoryProduct&category_id={$category_id}";

    // phan trang
    $pagination['num_page'] = ceil($pagination['total_item']/$pagination['per_page']);
    $data['pagination'] = $pagination;


    load_view("category_product", $data);
}

function allProductAction() {
    global $cart, $list_orders, $list_products, $filter_from_price, $filter_to_price, $option;

    $list_categories = get_list_categories();

    if(isset($_SESSION['is_login'])) {
        $user_id = info_user('user_id');
        $cart = get_cart($user_id);
        if(!empty($cart)){
            $cart = $cart[0];
            $list_orders = get_list_orders($cart['sale_id']);
        }
    }

    // phan trang
    $pagination['per_page'] = 2;
    $pagination['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
    $pagination['start'] = ($pagination['page']-1)*$pagination['per_page'];
    $pagination['total_item'] = get_total_item_all_product(); 
    $pagination['num_page'] = ceil($pagination['total_item']/$pagination['per_page']);

    // loc du lieu
    if(isset($_POST['btn-filter']) && !empty($_POST['select'])) {
        $option = $_POST['select'];
    }else if(isset($_POST['btn-filter-price']) && (!empty($_POST['filter_from_price']) || !empty($_POST['filter_to_price']))){
        $filter_from_price = $_POST['filter_from_price'];
        $filter_to_price = $_POST['filter_to_price'];
    }
    
    $list_products = get_all_products($pagination['start'], $pagination['per_page'], $option, $filter_from_price, $filter_to_price);

    $data['list_categories'] = $list_categories;
    $data['list_products'] = $list_products;
    $data['cart'] = $cart;
    $data['list_orders'] = $list_orders;
    $data['pagination'] = $pagination;
    $data['url'] = "?mod=product&controller=index&action=allProduct";

    load_view("all_product", $data);
}

function searchAction() {
    global $cart, $list_orders, $list_products, $filter_from_price, $filter_to_price, $option, $search;

    if(isset($_POST['btn'])) {
        $search = $_POST['search'];
        $_SESSION['$search'] = $search;
    }else {
        if(!empty($_SESSION['$search'])){
            $search = $_SESSION['$search'];
        }
    }
    $list_categories = get_list_categories();

    if(isset($_SESSION['is_login'])) {
        $user_id = info_user('user_id');
        $cart = get_cart($user_id);
        if(!empty($cart)){
            $cart = $cart[0];
            $list_orders = get_list_orders($cart['sale_id']);
        }
    }

    // phan trang
    $pagination['per_page'] = 2;
    $pagination['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
    $pagination['start'] = ($pagination['page']-1)*$pagination['per_page'];
    $pagination['total_item'] = get_total_item_search($search); 
    $pagination['num_page'] = ceil($pagination['total_item']/$pagination['per_page']);

    // loc du lieu
    if(isset($_POST['btn-filter']) && !empty($_POST['select'])) {
        $option = $_POST['select'];
        // $list_products = get_list_search_products_by_option($search, $option);
    }else if(isset($_POST['btn-filter-price']) && (!empty($_POST['filter_from_price']) || !empty($_POST['filter_to_price']))){
        $filter_from_price = $_POST['filter_from_price'];
        $filter_to_price = $_POST['filter_to_price'];
        // $list_products = get_list_search_products_by_price($search, $filter_from_price, $filter_to_price);
    }
    // else {
    //     $list_products = get_list_search($search);
    // }
    
    $list_products = get_list_search($search, $pagination['start'], $pagination['per_page'], $option, $filter_from_price, $filter_to_price);

    $data['list_categories'] = $list_categories;
    $data['list_products'] = $list_products;
    $data['cart'] = $cart;
    $data['list_orders'] = $list_orders;
    $data['search'] = $search;
    $data['pagination'] = $pagination;
    $data['url'] = "?mod=product&controller=index&action=search";

    // show_array($data);
    // die();

    load_view("search_product", $data);
}