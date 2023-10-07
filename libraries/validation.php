<?php
function is_username($username) {
    $partten = "/^[a-zA-Z0-9_\.]{3,32}$/";
    if(preg_match($partten, $username, $matchs)){
        return true;
    }
    return false;
}

// function is_name($name) {
//     $partten = "/^[a-zA-Z0-9_\.\, ]{3,64}$/";
//     if(preg_match($partten, $name, $matchs)){
//         return true;
//     }
//     return false;
// }

function is_name($name) {
    // echo $name;
    // die();
    // $partten = "/^[a-zA-Z0-9_\. ]{3,32}$/";
    $pattern = "/^[a-zA-Z0-9_\.\,\p{L} ]{3,255}$/u";
    if(preg_match($pattern, $name, $matchs)){
        return true;
    }
    return false;
}

function is_phone($phone) {
    $partten = "/^[0-9]{10,11}$/";
    if(preg_match($partten, $phone, $matchs)){
        return true;
    }
    return false;
}

function is_password($password) {
    $partten = "/^([\w_\.!@#$%^&*()]+){5,32}$/";
    if(preg_match($partten, $password, $matchs)){
        return true;
    }
    return false;
}

function is_email($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    return false;
}

function form_error($label_field) {
    global $error;
    if(!empty($error[$label_field])){
        return "<p class='error' style='color: red;'>{$error[$label_field]}</p>";
    }
}

function set_value($label_field){
    global $$label_field;
    if(!empty($$label_field)){
        return $$label_field;
    }
}
?>