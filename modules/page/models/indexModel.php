<?php

// function get_list_best_sale() {
//     $result = db_fetch_array("SELECT products.*, SUM(orders.total) AS total_sales
//     FROM products
//     JOIN orders ON products.product_id = orders.product_id
//     GROUP BY products.product_id, products.name");
//     return $result;
// }

function get_list_best_sale() {
    $result = db_fetch_array("SELECT products.*, SUM(orders.total) AS total_sales
    FROM products
    JOIN orders ON products.product_id = orders.product_id
    JOIN sales ON orders.sale_id = sales.sale_id
    WHERE sales.status = 3
    GROUP BY products.product_id, products.name
    ORDER BY total_sales DESC
    LIMIT 10");
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

function get_page_by_id($page_id) {
    $result = db_fetch_array("SELECT * FROM `pages` WHERE `page_id` = '{$page_id}'");
    return $result[0];
}