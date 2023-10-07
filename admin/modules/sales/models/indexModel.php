<?php 
function get_list_customers() {
    $result = db_fetch_array("SELECT users.*, COUNT(sales.sale_id) AS order_count
    FROM users
    LEFT JOIN sales ON users.user_id = sales.user_id
    WHERE users.role = 0
    GROUP BY users.user_id, users.name");
    return $result;
}

function get_list_customers_search($search) {
    $result = db_fetch_array("SELECT users.*, COUNT(sales.sale_id) AS order_count
    FROM users
    LEFT JOIN sales ON users.user_id = sales.user_id
    WHERE users.name LIKE "%search%" AND users.role = 0
    GROUP BY users.user_id, users.name");
    return $result;
}

function get_list_orders($status='') {
    $where = "";
    switch($status) {
        case 1:
            $where = "WHERE sales.status = 1";
            break;
        case 2:
            $where = "WHERE sales.status = 2";
            break;
        case 3:
            $where = "WHERE sales.status = 3";
            break;
        default :
            $where = "WHERE sales.status > 0";
            break;
    }
    $result = db_fetch_array("SELECT sales.*, users.name
    FROM sales
    JOIN users ON sales.user_id = users.user_id
    $where
    ");
    return $result;
}

function get_list_orders_search($search, $status) {
    $result = db_fetch_array("SELECT sales.*, users.name
    FROM sales
    JOIN users ON sales.user_id = users.user_id
    WHERE AND users.name LIKE '%{$search}%'");
    return $result;
}

function get_sale_by_id($sale_id) {
    $item = db_fetch_row("SELECT sales.*, users.name, users.address, users.phone 
    FROM sales 
    JOIN users ON sales.user_id = users.user_id
    WHERE sales.sale_id = '{$sale_id}'");
    return $item;
}

function get_list_order($sale_id) {
    $result = db_fetch_array("SELECT orders.*, products.name, products.price, products.image 
    FROM orders 
    JOIN products ON orders.product_id = products.product_id
    WHERE orders.sale_id = '{$sale_id}'");
    return $result;
}

function deleteSale($sale_id){
    db_delete('sales', "`sale_id`='{$sale_id}'");
}

function updateSale($data, $sale_id) {
    return db_update('sales', $data, "`sale_id`='{$sale_id}'");
}

function get_list_orders_of_sale($sale_id) {
    $result = db_fetch_array("SELECT * FROM orders WHERE sale_id = '{$sale_id}'");
    return $result;
}

function get_info_product($product_id, $label="name") {
    $product = db_fetch_array("SELECT * FROM `products` WHERE `product_id`='{$product_id}'");
    // print_r($product) ;
    return $product[0][$label];
}

?>