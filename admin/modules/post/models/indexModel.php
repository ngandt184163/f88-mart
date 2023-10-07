<?php
function addCategory($data) {
    return db_insert('categories', $data);
}

function get_list_categories() {
    $result = db_fetch_array("SELECT * FROM `categories`");
    return $result;
}

function get_list_categories_search($search) {
    $result = db_fetch_array("SELECT * FROM `categories` WHERE `name` LIKE '%{$search}%'");
    return $result;
}

function updateCategory($data, $category_id) {
    return db_update('categories', $data, "`category_id`='{$category_id}'");
}

function deleteCategory($category_id){
    db_delete('categories', "`category_id`='{$category_id}'");
}

function get_category_by_id($category_id) {
    $item = db_fetch_row("SELECT * FROM `categories` WHERE `category_id` = '{$category_id}'");
    return $item;
}

// tra ve thong tin category bat ki dua vao du lieu
function get_info_category($category_id, $label='name') {
    $category = db_fetch_array("SELECT * FROM `categories` WHERE `category_id`='{$category_id}'");
    // print_r($category) ;
    return $category[0][$label];
}


// ===============================================================================
// phan cua post
function addPost($data) {
    return db_insert('posts', $data);
}

function get_list_posts() {
    $result = db_fetch_array("SELECT * FROM `posts`");
    return $result;
}

function get_list_posts_search($search) {
    $result = db_fetch_array("SELECT * FROM `posts` WHERE `title` LIKE '%{$search}%'");
    return $result;
}

function updatePost($data, $post_id) {
    return db_update('posts', $data, "`post_id`='{$post_id}'");
}

function deletePost($post_id){
    db_delete('posts', "`post_id`='{$post_id}'");
}

function get_post_by_id($post_id) {
    $item = db_fetch_row("SELECT * FROM `posts` WHERE `post_id` = '{$post_id}'");
    return $item;
}

// tra ve thong tin user bat ki dua vao du lieu
function get_info_post($post_id, $label='name') {
    $post = db_fetch_array("SELECT * FROM `posts` WHERE `post_id`='{$post_id}'");
    // print_r($post) ;
    return $post[0][$label];
}

?>