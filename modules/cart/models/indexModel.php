<?php
function get_cart($user_id) {
    $query_string = "SELECT * FROM sales WHERE `user_id` = '{$user_id}' AND `status` = 0";
    return db_fetch_row($query_string);
}

function createCart($data, $order) {
    $sale_id = db_insert('sales', $data);
    $order['sale_id'] = $sale_id;
    db_insert('orders', $order);
}

function in_cart($sale_id, $product_id) {
    $query_string = "SELECT * FROM orders WHERE `sale_id` = '{$sale_id}' AND `product_id` = '{$product_id}'";
    return db_fetch_row($query_string);
}

function get_info_product($product_id, $label="name") {
    $product = db_fetch_array("SELECT * FROM `products` WHERE `product_id`='{$product_id}'");
    // print_r($product) ;
    return $product[0][$label];
}

function get_info_cart($sale_id, $label="name") {
    $product = db_fetch_array("SELECT * FROM `sales` WHERE `sale_id`='{$sale_id}'");
    // print_r($product) ;
    return $product[0][$label];
}

function update_cart_and_order($sale_id, $product_id, $total, $total_price_o, $total_price_s) {
    global $conn;
    // update so luong san pham o bang orders
    $updated_at = date('Y-m-d H:i:s');
    $sql = "UPDATE orders 
    SET total= {$total}, total_price= {$total_price_o}, updated_at='{$updated_at}'
    WHERE sale_id = {$sale_id} AND product_id = {$product_id}";
    mysqli_query($conn, $sql);

    // update o bang sales
    $sql = "UPDATE sales 
    SET total_price= {$total_price_s}, updated_at='{$updated_at}'
    WHERE sale_id = {$sale_id}";
    mysqli_query($conn, $sql);

}

function add_order_and_update_cart($sale_id, $data, $total, $total_price){
    global $conn;
    // insert order
    db_insert("orders", $data);

    // update o bang sales
    $updated_at = date('Y-m-d H:i:s');
    $sql = "UPDATE sales 
    SET total= {$total}, total_price= {$total_price}, updated_at='{$updated_at}'
    WHERE sale_id = {$sale_id}";
    mysqli_query($conn, $sql);
}

function get_list_orders($sale_id) {
    $query_string = "SELECT orders.*, products.code, products.image, products.name, products.price, products.total as total_p
    FROM `orders` 
    JOIN products ON orders.product_id = products.product_id
    WHERE `sale_id` = '{$sale_id}'";
    $result = db_fetch_array($query_string);
    return $result;
}

function get_info_order ($sale_id, $product_id, $label="total") {
    $query_string = "SELECT * FROM orders WHERE `sale_id` = '{$sale_id}' AND `product_id` = '{$product_id}'";
    $order = db_fetch_row($query_string);
    return $order[$label];
}

function delete_order_and_update_cart($sale_id, $product_id, $total, $total_price) {
    // xoa san pham trong bang orders
    // $query_string = "DELETE FROM orders WHERE sale_id = {$sale_id} AND product_id = {$product_id}";
    $where = "sale_id = {$sale_id} AND product_id = {$product_id}";
    db_delete("orders", $where);

    // cap nhat lai gio hang 
    $data = array(
        'total' => $total,
        'total_price' => $total_price,
        'updated_at' => date('Y-m-d H:i:s')
    );
    $where = "sale_id = {$sale_id}";
    db_update("sales", $data, $where);
}

function updateDataOrder($sale_id, $key, $value) {
    // cap nhat san pham trong bang orders
    $price = get_info_product($key, "price");
    $total_price = $value * $price;
    $data = array(
        'total' => $value,
        'total_price' => $total_price,
        'updated_at' => date('Y-m-d H:i:s')
    );
    $where = "sale_id = {$sale_id} AND product_id = {$key}";
    db_update("orders", $data, $where);
    return $total_price;
}

function updateDataCart($sale_id, $total_price) {
    // cap nhat lai gio hang 
    $data = array(
        'total_price' => $total_price,
        'updated_at' => date('Y-m-d H:i:s')
    );
    $where = "sale_id = {$sale_id}";
    db_update("sales", $data, $where);
}

function deleteCart($sale_id) {
    $where = "sale_id = {$sale_id}";
    db_delete("sales", $where);
}

function get_list_cart_orders($status, $user_id) {
    $where = "";
    switch($status) {
        case -1:
            $where = "WHERE user_id = '{$user_id}' AND sales.status = -1";
            break;
        case 1:
            $where = "WHERE user_id = '{$user_id}' AND sales.status = 1";
            break;
        case 2:
            $where = "WHERE user_id = '{$user_id}' AND sales.status = 2";
            break;
        case 3:
            $where = "WHERE user_id = '{$user_id}' AND sales.status = 3";
            break;
        default :
            $where = "WHERE user_id = '{$user_id}' AND sales.status != 0";
            break;
    }

    $result = db_fetch_array("SELECT * FROM sales $where");

    // $result = db_fetch_array("SELECT * FROM sales WHERE user_id = '{$user_id}' AND `status` != 0");
    return $result;
}

function get_sale_by_id($sale_id) {
    $item = db_fetch_row("SELECT sales.*, users.name, users.address, users.phone 
    FROM sales 
    JOIN users ON sales.user_id = users.user_id
    WHERE sales.sale_id = '{$sale_id}'");
    return $item;
}
