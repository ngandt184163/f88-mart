<?php
function construct() {
    //    echo "DÙng chung, load đầu tiên";
        load_model('index');
        load('lib', 'validation');
        load('lib', 'email');
}

function indexAction(){
    global $role, $search;
    
    if(isset($_POST['btn'])){
        $search = $_POST['search'];
        $data['list_users'] = get_list_users_search($search);
    }else{
        $data['list_users'] = get_list_users();
    }

    $data['role'] = info_user('role');
    load_view("list_admin", $data);
}

function addUserAction(){
    global $error, $name, $email, $password, $role;
    if(isset($_POST['btn'])){
        $error = array();
        // validate
        if(empty($_POST['name'])){
            $error['name'] = "Vui long nhap truong nay";
        }else {
            if(is_name($_POST['name'])) {
                $name = $_POST['name'];
            }else {
                $error['name'] = "Dinh dang ten chua dung";
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

        // validate role
        if(empty($_POST['role'])){
            $error['role'] = "Vui long chon truong nay";
        }else {
            $role = $_POST['role'];
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
                    'role' => $role
                );
                add_user($data);
                $link_active = base_url("?mod=users&action=active&active_token={$active_token}");
                $content = "<p>Chao ban {$name}</p>
                <p>Ban vui long click <a href='{$link_active}'>vao day</a> de kich hoat tai khoan</p>
                <p>Neu khong phai la ban dang ki tai khoan thi hay bo qua email nay</p>";
                send_mail($email, $name, "Kich hoat tai khoan tai website cua Soi Xam", $content);

                // chuyen huong den trang login
                // redirect("?mod=users&controller=index&action=login");
                echo "<h1?>Vui long kiem tra email de kich hoat tai khoan!</h1>";
            }
        }
    }
    load_view("addUser");
}

function updateInfoUserAction(){
    global $email, $status, $role;
    $email = $_GET['email'];
    
    if(isset($_POST['btn'])) {

        $data = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'is_active' => intval($_POST['active']),
            'role' => intval($_POST['role']),
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'gender' => $_POST['gender']
        );

        // show_array($data);

        // var_dump($data['is_active']);
        // var_dump($data['role']);

        // cap nhat vao database
        if(updateInfo($data, $email)){
            $status=1;
        }else {
            $status=-1;
        }

        // chuyen huong ve trang cu
        redirect("?mod=users&controller=team&action=index");
    }else {
        // $query_string = "SELECT * FROM `users` WHERE `email` = '{$email}'";
        // // SELECT * FROM `users` WHERE `email`='{$user_login}'
        // $user=db_fetch_array($query_string);
        
        $user_update = get_user_by_email($email);

        $data = array(
            'name' => $user_update['name'],
            'email' => $user_update['email'],
            'is_active' => $user_update['is_active'],
            'role_' => $user_update['role'],
            'phone' => $user_update['phone'],
            'address' => $user_update['address'],
            'gender' => $user_update['gender']
        );

    }
    if($status) {
        $data['status'] = "<p style='color:#32CD32;'>Cap nhat thanh cong</p>";
    }

    $data['role'] = info_user('role');
    load_view("updateInfoUser", $data);
}

function deleteUserAction(){
    global $email;
    $email = $_GET['email'];
    deleteUser($email);
    // chuyen huong ve trang cu
    redirect("?mod=users&controller=team&action=index");
}
?>