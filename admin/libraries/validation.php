<?php
function is_username($username) {
    $partten = "/^[a-zA-Z0-9_\.]{3,32}$/";
    if(preg_match($partten, $username, $matchs)){
        return true;
    }
    return false;
}

function is_name($name) {
    // echo $name;
    // die();
    // $partten = "/^[a-zA-Z0-9_\. ]{3,32}$/";
    $pattern = "/^[a-zA-Z0-9_\.\p{L} ]{3,255}$/u";
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

function is_image($file) {
    global $error;
    // kiem tra file co dung dinh dang khong
    $extensions = array("png", "jpg", "gif", "jpeg");

    // lay thong tin duoi file
    $type = pathinfo($file['name'], PATHINFO_EXTENSION);

    if(!in_array($type, $extensions)) {
        $error['file'] = "Vui long chon file co phan mo rong la png, jpg, gif, jpeg";
        return false;
    }
    else{
        // kiem tra kich thuoc file
        $file_size = $file['size'];
        if($file_size > 20000000){
            $error['file'] = "Vui long chon file co kich thuoc <= 20MB";
            return false;
        }
        else{
            $file_base_path = "public/images/{$file['name']}";
        }

        $file_name = $file['name'];
        // kiem tra xem ten file da ton tai chua
        if(file_exists($file_base_path)){
            $name_file = pathinfo($file['name'], PATHINFO_FILENAME);
            $new_file_base_path = "public/images/{$name_file} - Copy.{$type}";
            $file_name = "{$name_file} - Copy.{$type}";
            $k=1;
            while(file_exists($new_file_base_path)){
                // echo "trung";
                // die();
                $new_file_base_path = "public/images/{$name_file} - Copy({$k}).{$type}";
                $file_name = "{$name_file} - Copy({$k}).{$type}";
                $k++;
            }
            $file_base_path = $new_file_base_path;
        }

        move_uploaded_file($file['tmp_name'], $file_base_path);
        return $file_name;
    }
    
}

function form_error($label_field) {
    global $error;
    if(!empty($error[$label_field])){
        return "<p class='error' style='color:red'>{$error[$label_field]}</p>";
    }
}

function set_value($label_field){
    global $$label_field;
    if(!empty($$label_field)){
        return $$label_field;
    }
    return "";
}
?>