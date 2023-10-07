<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    // load("helper", "format");
    load("lib", "validation");
}

function indexAction() {
    load_view("index");
}

function checkoutAction() {
    global $error, $name, $address, $phone, $note, $type_payment;

    $user_id = info_user();
    $user = get_user_by_id($user_id);
    $cart = get_cart($user_id);
    $list_orders = get_list_orders($cart['sale_id']);

    if(isset($_POST['btn-order'])) {
        $error = array();
        $user = array();

        if(empty($_POST['name'])) {
            $error['name'] = "Vui lòng nhập trường này";
            $user['name'] = "";
        }else {
            if(is_name($_POST['name'])) {
                $user['name'] = $_POST['name'];
            }else {
                $error['name'] = "Định dạng tên chưa đúng";
                $user['name'] = "";
            }
        }

        $user['email'] = $_POST['email'];

        if(empty($_POST['address'])) {
            $error['address'] = "Vui lòng nhập trường này";
            $user['address'] = "";
        }else {
            if(is_name($_POST['address'])) {
                $user['address'] = $_POST['address'];
            }else {
                $error['address'] = "Định dạng địa chỉ chưa đúng";
                $user['address'] = "";
            }
        }

        if(empty($_POST['phone'])) {
            $error['phone'] = "Vui lòng nhập trường này";
            $user['phone'] = "";
        }else {
            if(is_phone($_POST['phone'])) {
                $user['phone'] = $_POST['phone'];
            }else {
                $error['phone'] = "Định dạng địa chỉ chưa đúng";
                $user['phone'] = "";
            }
        }

        if(!empty($_POST['note'])) {
            $note = $_POST['note'];
        }

        if(empty($_POST['type_payment'])) {
            $error['type_payment'] = "Vui lòng chọn trường này";
        } else {
            $type_payment = $_POST['type_payment'];
        }

        if(empty($error)) {
            updateInfoUser($user, $user_id);

            $data['type_payment'] = $type_payment;
            $data['note'] = $note;
            $data['status'] = 1;
            updateCart($cart['sale_id'], $data);

            // chuyen huong ve trang chu
            // redirect();
            // chuyen huong ve danh sach don hang dang cho duyet
            redirect("?mod=cart&controller=index&action=listCartOders&status=1");
        }else {
            $data['user'] = $user;
        }
    } else {
        $data['user'] = $user;
    }

    $data['cart'] = $cart;
    $data['list_orders'] = $list_orders;

    load_view("checkout", $data);
}

function repurchaseAction() {
    $sale_id = $_GET['sale_id'];
    $data['status'] = 1;
    updateCart($sale_id, $data);

    redirect("?mod=cart&controller=index&action=listCartOders&status=1");
}