<?php
function addProduct($data) {
    return db_insert('products', $data);
}

function get_list_categories() {
    $result = db_fetch_array("SELECT * FROM `categories`");
    return $result;
} 

// tra ve thong tin category bat ki dua vao du lieu
function get_info_category($category_id, $label='name') {
    $category = db_fetch_array("SELECT * FROM `categories` WHERE `category_id`='{$category_id}'");
    // print_r($category) ;
    return $category[0][$label];
} 

function get_list_products() {
    $result = db_fetch_array("SELECT * FROM `products`");
    return $result;
}

function get_list_products_search($search) {
    $result = db_fetch_array("SELECT * FROM `products` WHERE `name` LIKE '%{$search}%'");
    return $result;
}

function updateProduct($data, $product_id) {
    return db_update('products', $data, "`product_id`='{$product_id}'");
}

function deleteProduct($product_id){
    db_delete('products', "`product_id`='{$product_id}'");
}

function get_product_by_id($product_id) {
    $item = db_fetch_row("SELECT * FROM `products` WHERE `product_id` = '{$product_id}'");
    return $item;
}

function get_prev_product_id() {
    $product = db_fetch_array("SELECT * FROM `products` ORDER BY `product_id` DESC LIMIT 1");
    // print_r($product) ;
    if(empty($product)) {
        return 0;
    }
    return $product[0]['product_id'];
}
?>