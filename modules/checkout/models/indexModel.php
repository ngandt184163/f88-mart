<?php
function get_user_by_id($user_id) {
    $item = db_fetch_row("SELECT * FROM `users` WHERE `user_id` = '{$user_id}'");
    return $item;
}

function get_cart($user_id) {
    $query_string = "SELECT * FROM sales WHERE `user_id` = '{$user_id}' AND `status` = 0";
    return db_fetch_row($query_string);
}

function get_list_orders($sale_id) {
    $query_string = "SELECT orders.*, products.name
    FROM `orders` 
    JOIN products ON orders.product_id = products.product_id
    WHERE `sale_id` = '{$sale_id}'";
    $result = db_fetch_array($query_string);
    return $result;
}

function updateInfoUser($user, $user_id) {
    $user['updated_at'] = date('Y-m-d H:i:s');
    $where = "user_id = {$user_id}";
    db_update("users", $user, $where);
}

function updateCart($sale_id, $data) {
    $data['updated_at'] = date('Y-m-d H:i:s');
    $where = "sale_id = {$sale_id}";
    db_update("sales", $data, $where);
}