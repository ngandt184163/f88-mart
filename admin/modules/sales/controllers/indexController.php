<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load("helper", "format");
}

function indexAction() {
    load_view("index");
}

function listOrderAction() {
    global $search, $status;

    if(isset($_GET['status'])){
        $status = $_GET['status'];
    }
    
    if(isset($_POST['btn'])){
        $search = $_POST['search'];
        $data['list_orders'] = get_list_orders_search($search, $status);
    }else{
        $data['list_orders'] = get_list_orders($status);
    }

    $data['status'] = $status;
    load_view("list_order", $data);
}

function listCustomerAction() {
    global $search;
    
    if(isset($_POST['btn'])){
        $search = $_POST['search'];
        $data['list_customers'] = get_list_customers_search($search);
    }else{
        $data['list_customers'] = get_list_customers();
    }

    load_view("list_customer", $data);
}

function detailOrderAction() {
    $sale_id = $_GET['sale_id'];
    // $sale la don hang
    $sale = get_sale_by_id($sale_id);
    // show_array($sale);
    // die();
    // $list_order la chi tiet don hang
    $list_order = get_list_order($sale_id);
    $data['sale'] = $sale;
    $data['list_order'] = $list_order;

    if(isset($_POST['btn'])) {
        // co su cap nhat trang thai don hang
        $sale['status'] = $_POST['status'];
        updateSale($data, $sale_id);
    }

    load_view("detail_order", $data);
}

function updateSaleAction(){
    
    global $sale_id;
    $sale_id = $_GET['sale_id'];

}

function deleteSaleAction() {
    global $sale_id;
    $sale_id = $_GET['sale_id'];
    deleteSale($sale_id);
    // chuyen huong ve trang cu
    redirect("?mod=sales&controller=index&action=listOrder");
}

function updateStatusSaleAction() {
    $sale_id = $_POST['sale_id'];
    $status = $_POST['status'];

    $data_update_sale['status'] = $status;
    $data_update_sale['updated_at'] = date('Y-m-d H:i:s');
    // cap nhat don hang
    updateSale($data_update_sale, $sale_id);

    // cap nhat so luong san pham con hang, neu status = 2 
    if($status == 2) {
        $list_orders_of_sale = get_list_orders_of_sale($sale_id);
        foreach($list_orders_of_sale as $item) {
            $total = get_info_product($item['product_id'], "total");
            $data_update_product['total'] = $total - $item['total'];
            $data_update_product['updated_at'] = date('Y-m-d H:i:s');
            $where = "product_id = '{$item['product_id']}'";
            db_update("products", $data_update_product, $where);
        }
    }

    $response['success'] = true;
    $response['message'] = "Cập nhật đơn hàng thành công";
    echo json_encode($response);
}