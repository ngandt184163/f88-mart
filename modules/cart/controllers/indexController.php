<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction() {
    load_view("index");
}

function cartAction(){

    if(isset($_POST['btn_update_cart'])){
        // show_array($_POST);
        $data = $_POST;
        updateCart($data);
    } else {
        $user_id = info_user();
        $cart = get_cart($user_id);
        // if(!empty($cart)) {
        //     $cart = $cart[0];
        // }
        
        $list_orders = get_list_orders($cart['sale_id']);
        $data['cart'] = $cart;
        $data['list_orders'] = $list_orders;
        load_view("cart", $data);
    }    
}

function updateCart($data) {
    $user_id = info_user();
    $cart = get_cart($user_id);
    
    array_pop($data);
    show_array($data);
    $total_price = 0;
    foreach($data as $key => $value) {
        // echo $key."-".$value;
        $key = (int) $key;
        $total_price+=updateDataOrder($cart['sale_id'], $key, $value);
    }
    updateDataCart($cart['sale_id'], $total_price);
    redirect("?mod=cart&controller=index&action=cart");
}

function addCartAction(){
    // echo "vao day chua";
    // die();
    global $data;

    $product_id = $_POST['product_id'];
    $user_id = info_user();

    $num = $_POST['quantity'];
    if($num > get_info_product($product_id, "total") || empty($num)) {
        $response['message'] = "Số lượng sản phẩm không hợp lệ, vui lòng chọn lại";
        $response['success'] = false;
    } else {
        $price = $num * get_info_product($product_id, "price");
    
        // kiem tra xem nguoi nay da co gio hang chua
        $cart = get_cart($user_id);
    
        if(!empty($cart)) {
            // da co gio hang, gio can cap nhat gio hang
            // kiem tra xem san pham nay da co trong gio hang chua
            $order = in_cart($cart['sale_id'], $product_id);
            // show_array($order);
            // die();
            if(!empty($order)){
                // tang so luong san pham trong gio hang len
                $total = $order['total']+$num;
                $total_price_o = $order['total_price'] +$price;
                $total_price_s = get_info_cart($cart['sale_id'], "total_price") + $price;
                update_cart_and_order($cart['sale_id'], $product_id, $total, $total_price_o, $total_price_s);
            }else {
                // them moi san pham vao gio hang
                $order = array(
                    'sale_id' => $cart['sale_id'],
                    'product_id' => $product_id,
                    'total' => $num,
                    'total_price' => $price,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $total = get_info_cart($cart['sale_id'], "total") + 1;
                $total_price = get_info_cart($cart['sale_id'], "total_price") + $price;
                add_order_and_update_cart($cart['sale_id'], $order, $total, $total_price);
            }
            
        }else {
            // tao gio hang moi
            $data['code'] = $user_id."-".time();
            $data['total'] = 1;
            $data['total_price'] = $price;
            $data['user_id'] = $user_id;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            
            $order = array(
                'product_id' => $product_id,
                'total' => $num,
                'total_price' => $price,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
    
            createCart($data, $order);
        }

        $cart = get_cart($user_id);;
        $list_orders = get_list_orders($cart['sale_id']);
        
        $response['message'] = "Thêm giỏ hàng thành công!";
        $response['success'] = true;
        $response['list_orders'] = $list_orders;
        $response['cart'] = $cart;
    }

    
 
    echo json_encode($response);
}

function deleteProductAction() {
    $product_id = $_GET['product_id'];

    $user_id = info_user();
    $cart = get_cart($user_id);
    // neu gio hang chi con 1 san pham thi xoa luon gio hang
    if($cart['total'] == 1) {
        deleteCart($cart['sale_id']);
    }
    $price = get_info_order($cart['sale_id'], $product_id, "total_price");
    // echo $price."<br>";
    // echo get_info_cart($cart['sale_id'], "total_price");
    // die();
    $total = get_info_cart($cart['sale_id'], "total") - 1;
    $total_price = get_info_cart($cart['sale_id'], "total_price") - $price;
    delete_order_and_update_cart($cart['sale_id'], $product_id, $total, $total_price);
    redirect("?mod=cart&controller=index&action=cart");
}

function deleteCartAction() {
    $user_id = info_user();
    $cart = get_cart($user_id);

    deleteCart($cart['sale_id']);
    // chuyen huong ve trang chu
    redirect();
}

function listCartOdersAction() {
    global $status, $list_orders;

    $user_id = info_user();
    if(isset($_GET['status'])){
        $status = $_GET['status'];
    }

    $data['list_cart_orders'] = get_list_cart_orders($status, $user_id);

    $data['status'] = $status;

    // ===========================================
    // lay gio hang cua user
    $cart = get_cart($user_id);
    if(!empty($cart)){
        // $cart = $cart[0];
        $list_orders = get_list_orders($cart['sale_id']);
        // show_array($list_orders);
        // die();
    }

    $data['cart'] = $cart;
    $data['list_orders'] = $list_orders;
    // ===========================================

    load_view("list_cart_orders", $data);
}

function detailOrderAction() {
    global $list_orders;
    
    $sale_id = $_GET['sale_id'];
    // $sale la don hang
    $sale = get_sale_by_id($sale_id);
    // show_array($sale);
    // die();
    // $list_order la chi tiet don hang
    $list_order = get_list_orders($sale_id);
    $data['sale'] = $sale;
    $data['list_order'] = $list_order;

    // if(isset($_POST['btn'])) {
    //     // co su cap nhat trang thai don hang
    //     $sale['status'] = $_POST['status'];
    //     updateSale($data, $sale_id);
    // }

    // ===========================================
    // lay gio hang cua user
    $user_id = info_user();
    $cart = get_cart($user_id);
    if(!empty($cart)){
        // $cart = $cart[0];
        $list_orders = get_list_orders($cart['sale_id']);
        // show_array($list_orders);
        // die();
    }

    $data['cart'] = $cart;
    $data['list_orders'] = $list_orders;
    // ===========================================

    load_view("detailOrder", $data);
}

function cancelOrderAction() {
    $sale_id = $_GET['sale_id'];

    $data = array(
        'status' => -1, // trang thai don hang bi huy
        'updated_at' => date('Y-m-d H:i:s')
    );
    $where = "sale_id = '{$sale_id}'";
    // cap nhat lai trang thai cho don hang
    db_update("sales", $data, $where);

    // chuyen huong ve trang cu
    redirect("?mod=cart&controller=index&action=listCartOders&status=-1");


}