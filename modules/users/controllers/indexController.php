<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function indexAction() {
    load('helper','format');
    $list_users = get_list_users();
//    show_array($list_users);
    $data['list_users'] = $list_users;
    load_view('index', $data);
}

function addAction() {
    echo "Thêm dữ liệu";
}

function editAction() {
    $id = (int)$_GET['id'];
    $item = get_user_by_id($id);
    show_array($item);
}

function registerAction() {
    // echo send_mail("ngan.dt184163@sis.hust.edu.vn", "Dinh Thi Ngan", "làm quen nha", "<a href=''>một ngày mát</a>");
    global $error, $name, $email, $password;
    if(isset($_POST['btn'])) {
            
        $error = array();

        // validate username
        if(empty($_POST['name'])){
            $error['name'] = "Vui long nhap truong nay";
        }else {
            if(is_name($_POST['name'])) {
                $name = $_POST['name'];
            }else {
                $error['name'] = "Dinh dang tên chua dung";
            }
        }

        // validate email
        if(empty($_POST['email'])){
            $error['email'] = "Vui long nhap truong nay";
        }else {
            if(is_email($_POST['email'])) {
                $email = $_POST['email'];
            }else {
                $error['email'] = "Dinh dang email chua dung";
            }
        }

        // validate password
        if(empty($_POST['password'])){
            $error['password'] = "Vui long nhap truong nay";
        }else {
            if(is_password($_POST['password'])) {
                $password = md5($_POST['password']);
            }else {
                $error['password'] = "Password chua cac ki tu so, chu, dau gach duoi, dau cham, cac ki tu !@# va co do dai tu 6-8 ki tu";
            }
        }


        // ket luan
        if(empty($error)) {
            if(user_exists($email)){
                $error['account'] = "Email da ton tai trong he thong, vui long chon ten khac.";
            }else{
                $active_token = md5($email.time());
                $data = array(
                    'name' => $name,
                    'email'    => $email,
                    'password' => $password,
                    'active_token' => $active_token,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                add_user($data);
                $link_active = base_url("?mod=users&action=active&active_token={$active_token}");
                $content = "<p>Chao ban {$name}</p>
                <p>Ban vui long click <a href='{$link_active}'>vao day</a> de kich hoat tai khoan</p>
                <p>Neu khong phai la ban dang ki tai khoan thi hay bo qua email nay</p>";
                send_mail($email, $name, "Kich hoat tai khoan tai website cua Soi Xam", $content);

                // chuyen huong den trang login
                // redirect("?mod=users&controller=index&action=login");
                // echo "<h1>Vui long kiem tra email de kich hoat tai khoan!</h1>";
                // chuyển hướng đến trang thông báo đăng ký thành công
                redirect("?mod=users&controller=index&action=register_success");
            }
        }
    }

    load_view('register');
}

function register_successAction() {
    load_view("register_success");
}

function activeAction() {
    $active_token = $_GET['active_token'];
    // echo $active_token;
    
    if(check_active_token($active_token)) {
        active_user($active_token);
        // xoa token sau khi da kich hoat tai khoan
        $data = array(
            'active_token' => ""
        );
        delete_active_token($data, $active_token);

        redirect("?mod=users&controller=index&action=login");
    }else {
        echo "<h1?>Yeu cau kich hoat khong hop le!</h1>";
    }
    
}

function loginAction() {
    global $error, $email, $password;
    if(isset($_POST['btn'])) {
            
        $error = array();

        // validate email
        if(empty($_POST['email'])){
            $error['email'] = "Vui long nhap truong nay";
        }else {
            if(is_email($_POST['email'])) {
                $email = $_POST['email'];
            }else {
                $error['email'] = "Dinh dang email chua dung";
            }
        }

        // validate password
        if(empty($_POST['password'])){
            $error['password'] = "Vui long nhap truong nay";
        }else {
            if(is_password($_POST['password'])) {
                $password = md5($_POST['password']);
            }else {
                $error['password'] = "Password chua cac ki tu so, chu, dau gach duoi, dau cham, cac ki tu !@# va co do dai tu 6-8 ki tu";
            }
        }


        // ket luan
        if(empty($error)) {
            if(check_login($email, $password)){
                // luu phien dang nhap
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $email;
                // neu nguoi dung tich vao nho dang nhap, set nho dang nhap trong vong 1 ngay
                if(!empty($_POST['remember_me'])){
                    setcookie('is_login', true, time() + 122400);
                    setcookie('user_login', $email, time() + 122400);
                } else {
                    if(isset($_COOKIE['is_login'])){
                        setcookie('is_login', true, time() - 122400);
                        setcookie('user_login', $email, time() - 122400);
                    }
                }
                // chuyen huong vao trang web
                redirect();
                // chuyen huong ve trang truoc do khi chua login
                // redirect($_SESSION['request_path']);
                
            }else{
                $error['account'] = "Email hoặc mật khẩu không chính xác! 
                Hoặc tài khoản của bạn chưa được xác thực, vui lòng kiểm tra
                 email đã đăng ký tài khoản để tiến hành xác thực.";
            }
        }
    }

    load_view('login');
}

function logoutAction() {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&controller=index&action=login");
}

function resetPasswordAction() {
    global $error, $email, $password_1, $password_2;
    $reset_password_token = isset($_GET['reset_password_token']) ? $_GET['reset_password_token'] : "";
    if(!empty($reset_password_token)) {
        if(check_reset_password_token($reset_password_token)) {
            if(isset($_POST['btn'])){
                // validate password
                if(empty($_POST['password_1'])){
                    $error['password_1'] = "Vui long nhap truong nay";
                }else {
                    if(is_password($_POST['password_1'])) {
                        $password = md5($_POST['password_1']);
                    }else {
                        $error['password_1'] = "Mat khau moi chua cac ki tu so, chu, dau gach duoi, dau cham, cac ki tu !@# va co do dai tu 6-8 ki tu";
                    }
                }
    
                if(empty($_POST['password_2'])){
                    $error['password_2'] = "Vui long nhap truong nay";
                }else {
                    if(is_password($_POST['password_2'])) {
                        $password = md5($_POST['password_2']);
                    }else {
                        $error['password_2'] = "Xac nhan mat khau moi chua cac ki tu so, chu, dau gach duoi, dau cham, cac ki tu !@# va co do dai tu 6-8 ki tu";
                    }
                }
    
                if(empty($error)) {
                    if($_POST['password_2'] != $_POST['password_1']){
                        $error['password'] = "Xac nhan mat khau moi khong khop voi mat khau moi";
                    }else {
                        $data = array(
                            'password' => md5($_POST['password_1'])
                        );
                        updatePassword($data, $reset_password_token);
                        // xoa token sau khi da doi mat khau
                        $data = array(
                            'reset_password_token' => ""
                        );
                        delete_reset_password_token($data, $reset_password_token);
                        redirect("?mod=users&controller=index&action=login");
                    }
                }
            }
            load_view("resetPass");
        }else {
            echo "<h1>Yeu cau doi mat khau khong hop le!</h1>";
        }
    }else {
        if(isset($_POST['btn'])) {
            
            $error = array();
    
            // validate email
            if(empty($_POST['email'])){
                $error['email'] = "Vui long nhap truong nay";
            }else {
                if(is_email($_POST['email'])) {
                    $email = $_POST['email'];
                }else {
                    $error['email'] = "Dinh dang email chua dung";
                }
            }
    
            
            // ket luan
            if(empty($error)) {
                if(check_email($email)){
                    $reset_password_token = md5($email.time());
                    $data = array(
                        'reset_password_token' => $reset_password_token
                    );
                    update_reset_password_token($data, $email);
                    // db_update('users', $data, "`email`='{$email}'");
                    $link_active = base_url("?mod=users&action=resetPassword&reset_password_token={$reset_password_token}");
                    $content = "<p>Chao ban</p>
                    <p>Ban vui long click <a href='{$link_active}'>vao day</a> de doi mat khau</p>
                    <p>Neu khong phai la ban yeu cau doi mat khau thi hay bo qua email nay</p>";
                    send_mail($email, "", "Doi mat khau tai website cua Soi Xam", $content);
    
                    // chuyen huong den trang login
                    // redirect("?mod=users&controller=index&action=login");
                    echo "<h1>Vui long kiem tra email de doi mat khau!</h1>";
                
                    // chuyen huong vao trang web
                    // redirect();
                }else{
                    $error['account'] = "Email khong ton tai trong he thong!";
                }
            }
        }
        load_view("resetPassword");
    }
    
}

// function postResetPasswordAction() {
//     $reset_password_token = $_GET['reset_password_token'];
    
//     if(check_reset_password_token($reset_password_token)) {
//         global $error, $password_1, $password_2;
//         if(isset($_POST['btn'])){
//             // validate password
//             if(empty($_POST['password_1'])){
//                 $error['password_1'] = "Vui long nhap truong nay";
//             }else {
//                 if(is_password($_POST['password_1'])) {
//                     $password = md5($_POST['password_1']);
//                 }else {
//                     $error['password_1'] = "Mat khau moi chua cac ki tu so, chu, dau gach duoi, dau cham, cac ki tu !@# va co do dai tu 6-8 ki tu";
//                 }
//             }

//             if(empty($_POST['password_2'])){
//                 $error['password_2'] = "Vui long nhap truong nay";
//             }else {
//                 if(is_password($_POST['password_2'])) {
//                     $password = md5($_POST['password_2']);
//                 }else {
//                     $error['password_2'] = "Xac nhan mat khau moi chua cac ki tu so, chu, dau gach duoi, dau cham, cac ki tu !@# va co do dai tu 6-8 ki tu";
//                 }
//             }

//             if(empty($error)) {
//                 if($_POST['password_2'] != $_POST['password_1']){
//                     $error['password'] = "Xac nhan mat khau moi khong khop voi mat khau moi";
//                 }else {
//                     $data = array(
//                         'password' => md5($_POST['password_1'])
//                     );
//                     updatePassword($data, $reset_password_token);
//                     // xoa token sau khi da doi mat khau
//                     delete_reset_password_token(array('reset_password_token' => "", $email));
//                 }
//             }
//         }
//         load_view("resetPass");
//     }else {
//         echo "<h1>Yeu cau kich hoat khong hop le!</h1>";
//     }
// }

function infoAccountAction() {
    // thu nghiem chan trang khi chua login
    if(!is_login()){
        redirect("?mod=users&action=login");
    }
    // =====================================
    global $error, $name, $email, $phone, $address, $gender, $status_update_info_user;
    // lấy dữ liệu từ database đổ lên form
    $email = $_SESSION['user_login'];
    
    if(isset($_POST['btn'])) {
        $error = array();
        // validate name
        if(empty($_POST['name'])){
            $error['name'] = "Vui long nhap truong nay";
        }else {
            if(is_name($_POST['name'])) {
                $name = $_POST['name'];
            }else {
                $error['name'] = "Dinh dang ten chua dung";
            }
        }

        if(!empty($_POST['phone'])){
            if(is_phone($_POST['phone'])) {
                $phone = $_POST['phone'];
            }else {
                $error['phone'] = "Dinh dang so dien thoai chua dung";
            }
        }
        
        if(!empty($_POST['address'])){
            if(is_name($_POST['address'])) {
                $address = $_POST['address'];
            }else {
                $error['address'] = "Dinh dang dia chi chua dung";
            }
        }
        
        if(!empty($_POST['gender'])){
            $gender = $_POST['gender'];
        }

        $data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'gender' => $gender,
            'updated_at' => date('Y-m-d H:i:s')
        );

        // cap nhat vao database
        if(empty($error)){
            if(updateInfo($data, $email)){
                $status_update_info_user=1;
            }else {
                $status_update_info_user=2;
            }
        }
    }else {
        $query_string = "SELECT * FROM `users` WHERE `email` = '{$email}'";
        // SELECT * FROM `users` WHERE `email`='{$user_login}'
        $user=db_fetch_array($query_string);
        
        $data = array(
            'name' => $user[0]['name'],
            'email' => $email,
            'phone' => $user[0]['phone'],
            'address' => $user[0]['address'],
            'gender' => $user[0]['gender']
        );
    }

    $data['status_update_info_user'] = $status_update_info_user;

    load_view("info_account", $data);
}

function changePassAction() {
    global $error, $email, $password, $password_1, $password_2, $status_update_password;
    $email = $_SESSION['user_login'];

    if(isset($_POST['btn'])) {
        $error = array();
        // validate password
        if(empty($_POST['password_0'])){
            $error['password_0'] = "Vui long nhap truong nay";
        }else {
            $password = md5($_POST['password_0']);
            if(!check_password($email, $password)) {
                $error['password_0'] = "Mat khau cu khong chinh xac";
            }
        }

        if(empty($_POST['password_1'])){
            $error['password_1'] = "Vui long nhap truong nay";
        }else {
            if(is_password($_POST['password_1'])) {
                $password = $_POST['password_1'];
            }else {
                $error['password_1'] = "Mat khau moi chua cac ki tu so, chu, dau gach duoi, dau cham, cac ki tu !@# va co do dai tu 6-8 ki tu";
            }
        }

        if(empty($_POST['password_2'])){
            $error['password_2'] = "Vui long nhap truong nay";
        }else {
            if(is_password($_POST['password_2'])) {
                $password = $_POST['password_2'];
            }else {
                $error['password_2'] = "Xac nhan mat khau moi chua cac ki tu so, chu, dau gach duoi, dau cham, cac ki tu !@# va co do dai tu 6-8 ki tu";
            }
        }

        if(empty($error)) {
            if($_POST['password_2'] != $_POST['password_1']){
                $error['password'] = "Xac nhan mat khau moi khong khop voi mat khau moi";
            }else {
                $data = array(
                    'password' => md5($_POST['password_1'])
                );
                // cap nhat vao database
                if(changePassword($data, $email)){
                    $status=1;
                }else {
                    $status=2;
                }
            }
        }

        
    }

    $data['status_update_password'] = $status_update_password;

    // $data['role'] = info_user('role');

    load_view("change_pass", $data);
}




?>


