<?php
function get_list_blog($start, $per_page) {
    $result = db_fetch_array("SELECT * FROM `posts` LIMIT {$start}, {$per_page}");
    return $result;
}

function get_list_best_sale() {
    $result = db_fetch_array("SELECT products.*, SUM(orders.total) AS total_sales
    FROM products
    JOIN orders ON products.product_id = orders.product_id
    GROUP BY products.product_id, products.name");
    return $result;
}

function get_cart($user_id) {
    $result = db_fetch_array("SELECT * FROM `sales` WHERE `user_id` = '{$user_id}' AND `status` = 0");
    // if(empty($result)){
    //     return $result;
    // }
    return $result;
}

// function get_list_orders($sale_id) {
//     $result = db_fetch_array("SELECT * FROM `orders` WHERE `sale_id` = '{$sale_id}'");
//     return $result;
// }

function get_list_orders($sale_id) {
    $query_string = "SELECT orders.*, products.image, products.name, products.price
    FROM `orders` 
    JOIN products ON orders.product_id = products.product_id
    WHERE `sale_id` = '{$sale_id}'";
    $result = db_fetch_array($query_string);
    return $result;
}

function get_post_by_id($post_id) {
    $result = db_fetch_array("SELECT * FROM `posts` WHERE `post_id` = '{$post_id}'");
    return $result[0];
}

function get_total_item_blog() {
    $string_query = "SELECT * FROM posts";
    return db_num_rows($string_query);
}