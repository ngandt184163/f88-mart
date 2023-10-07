<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'validation');
    load('helper', 'format');
}

function indexAction() {
    load_view("index");
}

function addProductAction() {
    // lay du lieu danh muc cha
    $list_categories = get_list_categories();
    global $error, $data, $name, $price, $desc, $content, $total, $file, $file_name, $category_id;
    if(isset($_POST['btn'])){
        $product_id = get_prev_product_id()+1;
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
                $error['name'] = "Dinh dang ten san pham chua dung";
            }
        }

        if(empty($_POST['price'])){
            $error['price'] = "Vui long nhap truong nay";
        }else {
            // if(is_number($_POST['price'])) {
                $price = $_POST['price'];
            // }else {
            //     $error['price'] = "Gia chi chua cac ki tu tu 0-9";
            // }
        }

        if(empty($_POST['total'])){
            $error['total'] = "Vui long nhap truong nay";
        }else {
            // if(is_number($_POST['total'])) {
                $total = $_POST['total'];
            // }else {
            //     $error['total'] = "So luong chi chua cac ki tu tu 0-9";
            // }
        }

        if(!empty($_POST['desc'])){
            $desc = $_POST['desc'];
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

        if(empty($_POST['category_id'])) {
            $error['category_id'] = "Vui long chon truong nay";
        }else {
            $category_id = $_POST['category_id'];
        }

        if(empty($error)){
            $data = array(
                'name' => $name,
                'code' => $category_id."-".$product_id,
                'price' => $price,
                'des_c' => $desc,
                'content' => $content,
                'image' => $file_name,
                'total' => $total,
                'category_id' => $category_id,
                'user_id' => info_user('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            // show_array($data);
            // die();

            addProduct($data);
            redirect("?mod=product&controller=index&action=listProduct");
        }
    }
    
    load_view("add_product", $list_categories);
}

function listProductAction() {
    global $search;
    
    if(isset($_POST['btn'])){
        $search = $_POST['search'];
        $data['list_products'] = get_list_products_search($search);
    }else{
        $data['list_products'] = get_list_products();
    }

    load_view("list_product", $data);
}

function updateProductAction() {
    // lay du lieu danh muc cha
    $list_categories = get_list_categories();
    global $error, $data, $name, $price, $desc, $content, $total, $file, $file_name, $category_id;

    $product_id = $_GET['product_id'];
    $product_update = get_product_by_id($product_id);

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
                $error['name'] = "Dinh dang ten san pham chua dung";
            }
        }

        if(empty($_POST['price'])){
            $error['price'] = "Vui long nhap truong nay";
        }else {
            // if(is_number($_POST['price'])) {
                $price = $_POST['price'];
            // }else {
            //     $error['price'] = "Gia chi chua cac ki tu tu 0-9";
            // }
        }

        if(empty($_POST['total'])){
            $error['total'] = "Vui long nhap truong nay";
        }else {
            // if(is_number($_POST['total'])) {
                $total = $product_update['total'] + $_POST['total'];
            // }else {
            //     $error['total'] = "So luong chi chua cac ki tu tu 0-9";
            // }
        }

        if(!empty($_POST['desc'])){
            $desc = $_POST['desc'];
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

        if(empty($_POST['category_id'])) {
            $error['category_id'] = "Vui long chon truong nay";
        }else {
            $category_id = $_POST['category_id'];
        }

        if(empty($error)){
            $data = array(
                'name' => $name,
                'code' => $category_id."-".$product_id,
                'price' => $price,
                'des_c' => $desc,
                'content' => $content,
                'image' => isset($file_name)? $file_name :$product_update['image'],
                'total' => $total,
                'category_id' => $category_id,
                'user_id' => info_user('user_id'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            // show_array($data);
            // die();

            updateProduct($data, $product_id);
            redirect("?mod=product&controller=index&action=listProduct");
        }
    }else {
        
        $data = array(
            'name' => $product_update['name'],
            'price' => $product_update['price'],
            'desc' => $product_update['des_c'],
            'content' => $product_update['content'],
            'image' => $product_update['image'],
            'total' => $product_update['total'],
            'category_id' => $product_update['category_id']
        );

    }

    $data['list_categories'] = $list_categories;

    load_view("updateProduct", $data);
}

function deleteProductAction(){
    global $product_id;
    $product_id = $_GET['product_id'];
    deleteProduct($product_id);
    // chuyen huong ve trang cu
    redirect("?mod=product&controller=index&action=listProduct");
}

function listCatAction() {
    load_view("list_cat");
}

function addCatAction() {
    load_view("add_cat");
}