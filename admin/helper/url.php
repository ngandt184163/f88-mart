<?php

function base_url($url = "") {
    global $config;
    return $config['base_url'].$url;
}

function redirect($url=""){
    global $config;
    $path = $config['base_url'].$url;
    // ob_start();
    header("location: {$path}");
}

// function slug($string){
//     // Loại bỏ các ký tự không phải chữ cái, số hoặc dấu gạch ngang
//     $string = preg_replace('/[^a-zA-Z0-9-]/', '-', $string);

//     // Loại bỏ các ký tự gạch ngang lặp
//     $string = preg_replace('/-{2,}/', '-', $string);

//     // Loại bỏ gạch ngang ở đầu và cuối chuỗi
//     $string = trim($string, '-');

//     // Chuyển đổi chuỗi thành chữ thường và trả về kết quả
//     return strtolower($string);
// }

function slug($str) {
    $str = mb_strtolower($str, 'UTF-8');
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);

    // Loại bỏ các ký tự không phải chữ cái, số hoặc khoảng trắng
    $str = preg_replace('/[^a-z0-9\s-]/', '', $str);

    // Thay thế khoảng trắng bằng dấu gạch ngang
    $str = preg_replace('/\s+/', '-', $str);

    // Loại bỏ dấu gạch ngang ở đầu và cuối chuỗi
    $str = trim($str, '-');

    return $str;
}

/*
Sử dụng hàm để loại bỏ dấu tiếng Việt
$inputString = "Thiết bị điện tử";
$noAccentsString = slug($inputString);
echo $noAccentsString; // Kết quả: "dien-thoai"

$str = preg_replace('/[àáạảãâầấậẩẫăằắặẳẵ]/', 'a', $str);
$str = preg_replace('/[èéẹẻẽêềếệểễ]/', 'e', $str);
$str = preg_replace('/[ìíịỉĩ]/', 'i', $str);
$str = preg_replace('/[òóọỏõôồốộổỗơờớợởỡ]/', 'o', $str);
$str = preg_replace('/[ùúụủũưừứựửữ]/', 'u', $str);
$str = preg_replace('/[ỳýỵỷỹ]/', 'y', $str);
$str = preg_replace('/[đ]/', 'd', $str); 
 */

function friendly_url($slug){
    global $config;
    $base_url = $config['base_url'];
    return $base_url."/".$slug.".html";
}
