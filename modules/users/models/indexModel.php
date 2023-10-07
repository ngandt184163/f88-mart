<?php

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `users`");
    return $result;
}

function get_list_users_search($search) {
    $result = db_fetch_array("SELECT * FROM `users` WHERE `name` LIKE '%{$search}%'");
    return $result;
}

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `users` WHERE `id` = '{$id}'");
    return $item;
}

function get_user_by_email($email) {
    $item = db_fetch_row("SELECT * FROM `users` WHERE `email` = '{$email}'");
    return $item;
}


function add_user($data) {
    return db_insert('users', $data);
}

function user_exists($email) {
    $check_user = db_num_rows("SELECT * FROM `users` WHERE `email` = '{$email}'");
    // echo $check_user;
    if($check_user > 0){
        return true;
    }
    return false;
}

function active_user($active_token) {
    return db_update('users', array('is_active' => 1), "`active_token`='{$active_token}'");
}

function check_active_token($active_token) {
    $check = db_num_rows("SELECT * FROM `users` WHERE `active_token` = '{$active_token}' AND `is_active`=0");
    if($check > 0){
        return true;
    }
    return false;
}

function check_reset_password_token($reset_password_token){
    $check = db_num_rows("SELECT * FROM `users` WHERE `reset_password_token` = '{$reset_password_token}'");
    if($check > 0){
        return true;
    }
    return false;
}

function check_login($email, $password) {
    $check_user = db_num_rows("SELECT * FROM `users` WHERE `email`='{$email}' AND `password`='{$password}' AND `is_active`=1");
    if($check_user > 0){
        return true;
    }
    return false;
}

// function info_user($label='id') {
//     $user_login = $_SESSION['user_login'];
//     $user = db_fetch_array("SELECT * FROM `users` WHERE `email`='{$user_login}'");
//     return $user[$label];
// }

function check_email($email){
    $check_email = db_num_rows("SELECT * FROM `users` WHERE `email`='{$email}'");
    if($check_email > 0){
        return true;
    }
    return false;
}

function check_password($email, $password){
    $check_password = db_num_rows("SELECT * FROM `users` WHERE `email`='{$email}' AND `password`='{$password}'");
    if($check_password > 0){
        return true;
    }
    return false;
}

function update_reset_password_token($data, $email) {
    db_update('users', $data, "`email`='{$email}'");

}

function updatePassword($data, $reset_password_token){
    db_update('users', $data, "`reset_password_token`='{$reset_password_token}'");
}

function changePassword($data, $email){
    return db_update('users', $data, "`email`='{$email}'");
}

function delete_reset_password_token($data, $reset_password_token){
    db_update('users', $data, "`reset_password_token`='{$reset_password_token}'");
}

function delete_active_token($data, $active_token) {
    db_update('users', $data, "`active_token`='{$active_token}'");
}

function updateInfo($data, $email){
    return db_update('users', $data, "`email`='{$email}'");
}

function deleteUser($email){
    db_delete('users', "`email`='{$email}'");
}

