<?php
//Triệu gọi đến file xử lý thông qua request

$request_path = MODULESPATH . DIRECTORY_SEPARATOR . get_module() . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . get_controller().'Controller.php';

if (file_exists($request_path)) {
    require $request_path;
    $action_name = get_action().'Action';
    if($action_name != "loginAction" && $action_name != "registerAction") {
        // Kiểm tra xem có query string (phần bắt đầu từ dấu ?) trong URL không
        if (isset($_SERVER['QUERY_STRING'])) {
            // Lấy query string từ URL
            $query_string = $_SERVER['QUERY_STRING'];

            // Lưu query string vào biến $request_path
            $request_path = '?' . $query_string;

            // Lưu biến $request_path vào session
            $_SESSION['request_path'] = $request_path;
        } 
    }

    call_function(array('construct', $action_name));
} else {
    // echo "Không tìm thấy:$request_path ";
    require "./layout/404.php";
}

// $action_name = get_action().'Action';

// call_function(array('construct', $action_name));

// if(!is_login() && get_action() != 'login' && get_action() != 'register' && get_action() != 'active' && get_action() != 'resetPassword' && get_action() != 'postResetPassword'){
//     redirect("?mod=users&action=login");
// }
