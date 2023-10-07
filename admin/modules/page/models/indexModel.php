<?php
function addPage($data) {
    return db_insert('pages', $data);
}

function get_list_pages() {
    $result = db_fetch_array("SELECT * FROM `pages`");
    return $result;
}

function get_list_pages_search($search) {
    $result = db_fetch_array("SELECT * FROM `pages` WHERE `title` LIKE '%{$search}%'");
    return $result;
}

function updatePage($data, $page_id) {
    return db_update('pages', $data, "`page_id`='{$page_id}'");
}

function deletePage($page_id){
    db_delete('pages', "`page_id`='{$page_id}'");
}

function get_page_by_id($page_id) {
    $item = db_fetch_row("SELECT * FROM `pages` WHERE `page_id` = '{$page_id}'");
    return $item;
}
?>