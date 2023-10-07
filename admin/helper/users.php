<?php
// function check_login($username, $password){
//     global $list_users;
//     foreach($list_users as $user) {
//         if($username == $user['username'] && $password == $user['password']) {
//             return true;
//         }
//     }
//     return false;
// }

function is_login() {
    if(isset($_SESSION['is_login']) || isset($_COOKIE['is_login'])){
        $_SESSION['is_login'] = true;
        if(isset($_COOKIE['is_login'])){
            $_SESSION['user_login'] = $_COOKIE['user_login'];
        }
        
        return true;
    }
    return false;
}

function is_login_admin() {
    if(isset($_SESSION['is_login']) || isset($_COOKIE['is_login'])){
        $_SESSION['is_login'] = true;
        if(isset($_COOKIE['is_login'])){
            $_SESSION['user_login'] = $_COOKIE['user_login'];
        }

        $role = info_user("role");

        if($role == 0) {
            return false;
        }
        
        return true;
    }
    return false;
}

// tra ve username cua user dang login
function user_login(){
    if(!empty($_SESSION['user_login'])) {
        return $_SESSION['user_login'];
    }
    return false;
}

// function info_user($field = 'id') {
//     global $list_users;
//     if(isset($_SESSION['is_login'])){
//         foreach($list_users as $user) {
//             if($_SESSION['user_login'] == $user['username']) {
//                 if(array_key_exists($field, $user)) {
//                     return $user[$field];
//                 }
//             }
//         }
//     }
//     return false;
// }

// tra vee thong tin user dang dang nhap
function info_user($label='user_id') {
    $user_login = $_SESSION['user_login'];
    $user = db_fetch_array("SELECT * FROM `users` WHERE `email`='{$user_login}'");
    // print_r($user) ;
    return $user[0][$label];
}

// tra ve thong tin user bat ki dua vao du lieu
function get_info_user($user_id = "", $email = "", $label='name') {
    $user = db_fetch_array("SELECT * FROM `users` WHERE `user_id`='{$user_id}' OR `email`='{$email}'");
    // print_r($user) ;
    return $user[0][$label];
}
?>