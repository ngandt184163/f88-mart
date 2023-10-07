<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function indexAction() {
    load_view("index");
}

function detailAction() {
    // echo "hihi";
    if($_GET['id'] == 63) {
        echo "bai viet so 63";
    }else if($_GET['id'] == 1){
        load_view("product");
    }
}

function addPageAction(){

    global $conn, $error, $title, $content, $file;
    if(isset($_POST['btn'])){
        $error = array();

        // validate
        if(empty($_POST['title'])){
            $error['title'] = "Vui long nhap truong nay";
        }else {
            if(is_name($_POST['title'])) {
                $title = $_POST['title'];
            }else {
                $error['title'] = "Dinh dang tieu de chua dung";
            }
        }

        if(empty($_POST['content'])){
            $error['content'] = "Vui long nhap truong nay";
        }else {
            $content = $_POST['content'];
            // echo $content;
            // echo mysqli_real_escape_string($conn,$content);
            // die();
        }

        if(isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
            $file = $_FILES['file'];
            $file_name = is_image($file);
            if(!$file_name){
                $file_name = "";
            }
            // }else {
            //     $error['file'] = "Dinh dang anh chua dung, vui long chon tep .png, .jpg, .gif, .jpeg";
            // }
        }

        if(empty($error)){
            $data = array(
                'title' => $title,
                'slug' => slug($title),
                'content' => $content,
                'image' => $file_name,
                'user_id' => info_user('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            addPage($data);
            redirect("?mod=page&controller=index&action=listPage");
        }
    }
    load_view("add_page");
}

function listPageAction(){
    global $search;
    
    if(isset($_POST['btn'])){
        $search = $_POST['search'];
        $data['list_pages'] = get_list_pages_search($search);
    }else{
        $data['list_pages'] = get_list_pages();
    }

    load_view("list_page", $data);
}

function updatePageAction() {
    global $page_id, $status, $data;
    $page_id = $_GET['page_id'];
    $page_update = get_page_by_id($page_id);

    if(isset($_POST['btn'])) {

        // show_array($_FILES);
        // die();
        $error = array();

        // validate
        if(empty($_POST['title'])){
            $error['title'] = "Vui long nhap truong nay";
        }else {
            if(is_name($_POST['title'])) {
                $title = $_POST['title'];
            }else {
                $error['title'] = "Dinh dang tieu de chua dung";
            }
        }

        if(empty($_POST['content'])){
            $error['content'] = "Vui long nhap truong nay";
        }else {
            $content = $_POST['content'];
        }

        if(isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
            // echo "ok";
            // die();
            $file = $_FILES['file'];
            
            $file_name = is_image($file);
            if(!$file_name){
                $file_name = " ";
            }
        }

        if(empty($error)){
            $data = array(
                'title' => $title,
                'slug' => slug($title),
                'content' => $content,
                'image' => isset($file_name)? $file_name :$page_update['image'],
                'user_id' => info_user('user_id'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            updatePage($data, $page_id);
            redirect("?mod=page&controller=index&action=listPage");
        }
    }else {
        // $query_string = "SELECT * FROM `users` WHERE `email` = '{$email}'";
        // // SELECT * FROM `users` WHERE `email`='{$user_login}'
        // $user=db_fetch_array($query_string);
        
        

        $data = array(
            'title' => $page_update['title'],
            'content' => $page_update['content'],
            'image' => $page_update['image']
        );

    }

    load_view("updatePage", $data);
}

function deletePageAction(){
    global $page_id;
    $page_id = $_GET['page_id'];
    deletePage($page_id);
    // chuyen huong ve trang cu
    redirect("?mod=page&controller=index&action=listPage");
}