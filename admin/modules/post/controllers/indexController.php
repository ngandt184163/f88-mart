<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function indexAction() {
    global $search;
    
    if(isset($_POST['btn'])){
        $search = $_POST['search'];
        $data['list_posts'] = get_list_posts_search($search);
    }else{
        $data['list_posts'] = get_list_posts();
    }

    load_view("list_post", $data);
}

function addPostAction() {
    // lay du lieu danh muc cha
    $list_categories = get_list_categories();
    global $error, $data, $title, $content, $file, $file_name, $category_id;
    if(isset($_POST['btn'])){
        $error = array();

        // show_array($_POST);
        // die();
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
        } else {
            $content = $_POST['content']; 
        }
        
        if(isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
            $file = $_FILES['file'];
            $file_name = is_image($file);
            if(!$file_name){
                $file_name = "";
            }
        }

        if(empty($_POST['category_id'])) {
            $error['category_id'] = "Vui long chon truong nay";
        }else {
            $category_id = $_POST['category_id'];
        }

        if(empty($error)){
            $data = array(
                'title' => $title,
                'slug' => slug($title),
                'content' => $content,
                'image' => $file_name,
                'category_id' => $category_id,
                'user_id' => info_user('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            // show_array($data);
            // die();

            addPost($data);
            redirect("?mod=post&controller=index&action=index");
        }
    }
    
    load_view("add_post", $list_categories);
}

function updatePostAction() {
    // lay du lieu danh muc cha
    $list_categories = get_list_categories();
    global $error, $data, $title, $content, $file, $file_name, $category_id;

    $post_id = $_GET['post_id'];
    $post_update = get_post_by_id($post_id);

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
                $file_name = "";
            }
        }

        if(empty($_POST['category_id'])) {
            $error['category_id'] = "Vui long chon truong nay";
        }else {
            $category_id = $_POST['category_id'];
        }

        if(empty($error)){
            $data = array(
                'title' => $title,
                'slug' => slug($title),
                'content' => $content,
                'image' => isset($file_name)? $file_name :$post_update['image'],
                'category_id' => $category_id,
                'user_id' => info_user('user_id'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            // show_array($data);
            // die();

            updatePost($data, $post_id);
            redirect("?mod=post&controller=index&action=index");
        }
    }else {
        $data = array(
            'title' => $post_update['title'],
            'content' => $post_update['content'],
            'image' => $post_update['image'],
            'category_id' =>  $post_update['category_id']
        );

    }

    $data['list_categories'] = $list_categories;

    load_view("updatePost", $data);
}

function deletePostAction(){
    global $post_id;
    $post_id = $_GET['post_id'];
    deletePost($post_id);
    // chuyen huong ve trang cu
    redirect("?mod=post&controller=index&action=index");
}

function listCatAction() {
    global $search;
    
    if(isset($_POST['btn'])){
        $search = $_POST['search'];
        $data['list_categories'] = get_list_categories_search($search);
    }else{
        $data['list_categories'] = get_list_categories();
    }

    load_view("list_cat", $data);
}

function addCategoryAction() {

    // lay du lieu danh muc cha
    $list_categoriess = get_list_categories();
    global $error, $data, $name, $content, $file, $file_name, $parent_category_id, $type;
    if(isset($_POST['btn'])){
        $error = array();

        // show_array($_POST);
        // die();
        // validate
        if(empty($_POST['name'])){
            $error['name'] = "Vui long nhap truong nay";
        }else {
            if(is_name($_POST['name'])) {
                $name = $_POST['name'];
            }else {
                $error['name'] = "Dinh dang ten danh muc chua dung";
            }
        }

        if(!empty($_POST['content'])){
            $content = $_POST['content'];    
        }
        
        if(isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
            $file = $_FILES['file'];
            $file_name = is_image($file);
            if(!$file_name){
                $file_name = "";
            }
        }

        if(!empty($_POST['parent_category_id'])) {
            $parent_category_id = $_POST['parent_category_id'];
            $type = get_info_category($parent_category_id, "type") + 1;
        }else {
            $type = 1;
            $parent_category_id = 0;
        }

        if(empty($error)){
            $data = array(
                'name' => $name,
                'slug' => slug($name),
                'content' => $content,
                'image' => $file_name,
                'type' => $type,
                'parent_category_id' => $parent_category_id,
                'user_id' => info_user('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            // show_array($data);
            // die();

            addCategory($data);
            redirect("?mod=post&controller=index&action=listCat");
        }
    }
    
    load_view("add_cat", $list_categoriess);
}

function updateCategoryAction() {
    // lay du lieu danh muc cha
    $list_categories = get_list_categories();
    global $error, $data, $name, $content, $file, $file_name, $parent_category_id, $type;

    $category_id = $_GET['category_id'];
    $category_update = get_category_by_id($category_id);

    if(isset($_POST['btn'])) {

        // show_array($_FILES);
        // die();
        $error = array();

        // validate
        if(empty($_POST['name'])){
            $error['name'] = "Vui long nhap truong nay";
        }else {
            if(is_name($_POST['name'])) {
                $name = $_POST['name'];
            }else {
                $error['name'] = "Dinh dang tieu de chua dung";
            }
        }

        if(!empty($_POST['content'])){
            $content = $_POST['content'];
        }

        if(isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
            // echo "ok";
            // die();
            $file = $_FILES['file'];
            
            $file_name = is_image($file);
            if(!$file_name){
                $file_name = "";
            }
        }

        if(!empty($_POST['parent_category_id'])) {
            $parent_category_id = $_POST['parent_category_id'];
            $type = get_info_category($parent_category_id, "type") + 1;
        }else {
            $type = 1;
        }

        if(empty($error)){
            $data = array(
                'name' => $name,
                'slug' => slug($name),
                'content' => $content,
                'image' => isset($file_name)? $file_name :$category_update['image'],
                'type' => $type,
                'parent_category_id' => $parent_category_id,
                'user_id' => info_user('user_id'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            // show_array($data);
            // die();

            updateCategory($data, $category_id);
            redirect("?mod=post&controller=index&action=listCat");
        }
    }else {
        $data = array(
            'name' => $category_update['name'],
            'content' => $category_update['content'],
            'image' => $category_update['image'],
            'parent_category_id' =>  $category_update['parent_category_id']
        );

    }

    $data['list_categories'] = $list_categories;
    $data['category_id'] = $category_id;

    load_view("updateCategory", $data);
}

function deleteCategoryAction(){
    global $category_id;
    $category_id = $_GET['category_id'];
    deleteCategory($category_id);
    // chuyen huong ve trang cu
    redirect("?mod=post&controller=index&action=listCat");
}