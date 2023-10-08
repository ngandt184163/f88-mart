<?php

function get_list_categories() {
    $result = db_fetch_array("SELECT * FROM `categories`");
    return $result;
} 

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

function get_list_phones() {
    $result = db_fetch_array("WITH RECURSIVE CategoryHierarchy AS (
        SELECT category_id
        FROM categories
        WHERE category_id = 10
        UNION ALL
        SELECT c.category_id
        FROM categories c
        INNER JOIN CategoryHierarchy ch ON c.parent_category_id = ch.category_id
    )
    SELECT p.*
    FROM products p
    INNER JOIN CategoryHierarchy ch ON p.category_id = ch.category_id
    ORDER BY RAND()
    LIMIT 10;");
    return $result;
}

function get_list_laptops() {
    $result = db_fetch_array("WITH RECURSIVE CategoryHierarchy AS (
        SELECT category_id
        FROM categories
        WHERE category_id = 19
        UNION ALL
        SELECT c.category_id
        FROM categories c
        INNER JOIN CategoryHierarchy ch ON c.parent_category_id = ch.category_id
    )
    SELECT p.*
    FROM products p
    INNER JOIN CategoryHierarchy ch ON p.category_id = ch.category_id
    ORDER BY RAND()
    LIMIT 10;");
    return $result;
}

function get_cart($user_id) {
    $result = db_fetch_array("SELECT * FROM `sales` WHERE `user_id` = '{$user_id}' AND `status` = 0");
    return $result;
}

function get_list_orders($sale_id) {
    $query_string = "SELECT orders.*, products.image, products.name, products.price
    FROM `orders` 
    JOIN products ON orders.product_id = products.product_id
    WHERE `sale_id` = '{$sale_id}'";
    $result = db_fetch_array($query_string);
    return $result;
}

function get_list_search($search) {
    $result = db_fetch_array("SELECT * FROM `products` WHERE `name` LIKE '%{$search}%'");
    return $result;
}

?>