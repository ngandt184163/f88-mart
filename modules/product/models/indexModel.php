<?php

function get_list_categories() {
    $result = db_fetch_array("SELECT * FROM `categories`");
    return $result;
} 

function get_product_by_id($product_id) {
    $item = db_fetch_row("SELECT * FROM `products` WHERE `product_id` = {$product_id}");
    return $item;
}

function get_list_best_sale() {
    $result = db_fetch_array("SELECT products.*, SUM(orders.total) AS total_sales
    FROM products
    JOIN orders ON products.product_id = orders.product_id
    GROUP BY products.product_id, products.name");
    return $result;
}

function get_cart($user_id) {
    $result = db_fetch_array("SELECT * FROM `sales` WHERE `user_id` = '{$user_id}' AND `status` = 0");
    return $result;
}

// function get_list_orders($sale_id) {
//     $result = db_fetch_array("SELECT * FROM `orders` WHERE `sale_id` = '{$sale_id}'");
//     return $result;
// }

function get_list_orders($sale_id) {
    $query_string = "SELECT orders.*, products.image, products.name, products.price
    FROM `orders` 
    JOIN products ON orders.product_id = products.product_id
    WHERE `sale_id` = '{$sale_id}'";
    $result = db_fetch_array($query_string);
    return $result;
}

function get_list_search($search, $start, $per_page, $option, $filter_from_price, $filter_to_price) {
    $result = db_fetch_array("SELECT * FROM `products` WHERE `name` LIKE '%{$search}%' LIMIT {$start}, {$per_page};");

    // Sắp xếp mảng kết quả dựa trên giá trị $filter_from_price và $filter_to_price
    if (!empty($filter_from_price) && !empty($filter_to_price)) {
        $result = array_filter($result, function($item) use ($filter_from_price, $filter_to_price) {
            return ($item['price'] >= $filter_from_price && $item['price'] <= $filter_to_price);
        });
    } elseif (!empty($filter_from_price)) {
        $result = array_filter($result, function($item) use ($filter_from_price) {
            return ($item['price'] >= $filter_from_price);
        });
    } elseif (!empty($filter_to_price)) {
        $result = array_filter($result, function($item) use ($filter_to_price) {
            return ($item['price'] <= $filter_to_price);
        });
    }

    // Sắp xếp lại mảng kết quả dựa trên tùy chọn $option
    switch ($option) {
        case 1:
            usort($result, function($a, $b) {
                return strcmp($a['name'], $b['name']); // Sắp xếp theo name từ A-Z
            });
            break;
        case 2:
            usort($result, function($a, $b) {
                return strcmp($b['name'], $a['name']); // Sắp xếp theo name từ Z-A
            });
            break;
        case 3:
            usort($result, function($a, $b) {
                return $b['price'] - $a['price']; // Sắp xếp theo price từ cao xuống thấp
            });
            break;
        case 4:
            usort($result, function($a, $b) {
                return $a['price'] - $b['price']; // Sắp xếp theo price từ thấp lên cao
            });
            break;
        default:
            // Không thực hiện sắp xếp nếu không có tùy chọn hợp lệ
            break;
    }

    return $result;
}

// lấy danh sách sản phẩm cùng danh mục hoạc là danh mục con của nó.
function get_list_same_categories($category_id){
    $result = db_fetch_array("WITH RECURSIVE CategoryHierarchy AS (
        SELECT category_id
        FROM categories
        WHERE category_id = '{$category_id}'
        UNION ALL
        SELECT c.category_id
        FROM categories c
        INNER JOIN CategoryHierarchy ch ON c.parent_category_id = ch.category_id
    )
    SELECT p.*
    FROM products p
    INNER JOIN CategoryHierarchy ch ON p.category_id = ch.category_id
    ORDER BY RAND()
    LIMIT 10;");

    // global $conn;
    // $query = "
    //     WITH RECURSIVE CategoryHierarchy AS (
    //         SELECT category_id
    //         FROM categories
    //         WHERE category_id = '{$category_id}'
    //         UNION ALL
    //         SELECT c.category_id
    //         FROM categories c
    //         INNER JOIN CategoryHierarchy ch ON c.parent_category_id = ch.category_id
    //     )
    //     SELECT p.*
    //     FROM products p
    //     INNER JOIN CategoryHierarchy ch ON p.category_id = ch.category_id
    //     ORDER BY RAND()
    //     LIMIT 10;
    // ";
    // $result = [];
    // $mysqli_result = mysqli_query($conn, $query);
    // while ($row = mysqli_fetch_assoc($mysqli_result)) {
    //     $result[] = $row;
    // }
    // show_array($result);
    // die();
    return $result;
}

// function get_list_name_categories($product_id){
    
//     $query = "SELECT products.*, categories.name
//             FROM products JOIN categories ON products.category_id = categories.category_id
//             WHERE product_id = $product_id";

//     // Thực hiện truy vấn SQL để lấy thông tin danh mục của sản phẩm
//     $result = db_fetch_row($query);


//     if ($result) {
//         $productCategories = mysqli_fetch_assoc($result);
//         $categories = [];

//         // Lặp qua danh mục từ danh mục con đến danh mục cha
//         while ($productCategories) {
//             array_unshift($categories, $productCategories);
//             $parentID = $productCategories['parent_category_id'];

//             // Lấy thông tin danh mục cha
//             $query = "SELECT products.*, categories.name
//                     FROM products JOIN categories ON products.category_id = categories.category_id
//                     WHERE product_id = $product_id";

//             $result = db_fetch_row($query);

//             if ($result) {
//                 $productCategories = mysqli_fetch_assoc($result);
//             } else {
//                 $productCategories = false;
//             }
//         }

//         // $categories bây giờ chứa danh sách danh mục theo thứ tự từ lớn nhất đến nhỏ nhất
//         // print_r($categories);
//         return $categories;
//     } else {
//         echo "Lỗi truy vấn SQL";
//     }

// }

function get_list_parent_categories($categor_id) {
    // -- Đoạn code SQL để lấy danh sách danh mục cha ông
    $result = db_fetch_array("WITH RECURSIVE CategoryHierarchy AS (
        SELECT category_id, name, parent_category_id
        FROM categories
        WHERE category_id = '{$categor_id}' -- Thay 5 bằng category_id của danh mục cần tìm
        UNION ALL
        SELECT c.category_id, c.name, c.parent_category_id
        FROM categories c
        INNER JOIN CategoryHierarchy ch ON c.category_id = ch.parent_category_id
    )
    SELECT category_id, name
    FROM CategoryHierarchy");
    
    return $result;
}

// lay danh sach san pham co $category_id
// function get_list_products_by_category_id($category_id, $start, $per_page) {
//     $result = db_fetch_array("WITH RECURSIVE CategoryHierarchy AS (
//         SELECT category_id
//         FROM categories
//         WHERE category_id = '{$category_id}'
//         UNION ALL
//         SELECT c.category_id
//         FROM categories c
//         INNER JOIN CategoryHierarchy ch ON c.parent_category_id = ch.category_id
//     )
//     SELECT p.*
//     FROM products p
//     INNER JOIN CategoryHierarchy ch ON p.category_id = ch.category_id
//     -- ORDER BY RAND()
//     LIMIT {$start}, {$per_page};");
//     return $result;
// }

function get_info_product($product_id, $label="name") {
    $product = db_fetch_array("SELECT * FROM `products` WHERE `product_id`='{$product_id}'");
    // print_r($product) ;
    return $product[0][$label];
}

// tra ve thong tin category bat ki dua vao du lieu
function get_info_category($category_id, $label='name') {
    $category = db_fetch_array("SELECT * FROM `categories` WHERE `category_id`='{$category_id}'");
    // print_r($category) ;
    return $category[0][$label];
}

// function get_list_products_by_option($category_id, $option, $start, $per_page) {
//     $orderBy = '';

//     switch ($option) {
//         case 1:
//             $orderBy = 'ORDER BY p.name ASC';
//             break;
//         case 2:
//             $orderBy = 'ORDER BY p.name DESC';
//             break;
//         case 3:
//             $orderBy = 'ORDER BY p.price DESC';
//             break;
//         case 4:
//             $orderBy = 'ORDER BY p.price ASC';
//             break;
//         default:
//             // Mặc định sắp xếp ngẫu nhiên nếu $option không hợp lệ
//             $orderBy = 'ORDER BY RAND()';
//             break;
//     }

//     $result = db_fetch_array("WITH RECURSIVE CategoryHierarchy AS (
//         SELECT category_id
//         FROM categories
//         WHERE category_id = '{$category_id}'
//         UNION ALL
//         SELECT c.category_id
//         FROM categories c
//         INNER JOIN CategoryHierarchy ch ON c.parent_category_id = ch.category_id
//     )
//     SELECT p.*
//     FROM products p
//     INNER JOIN CategoryHierarchy ch ON p.category_id = ch.category_id
//     $orderBy
//     LIMIT {$start}, {$per_page};");
    
//     return $result;
// }

// function get_list_products_by_price($category_id, $filter_from_price, $filter_to_price, $start, $per_page) {
//     $where = "";
//     if(empty($filter_from_price)) {
//         $where = "WHERE p.price <= '{$filter_to_price}'";
//     } else if(empty($filter_to_price)) {
//         $where = "WHERE p.price >= '{$filter_from_price}'";
//     }
//     else {
//         $where = "WHERE p.price >= '{$filter_from_price}' AND p.price <= '{$filter_to_price}'";
//     }
//     $result = db_fetch_array("WITH RECURSIVE CategoryHierarchy AS (
//         SELECT category_id
//         FROM categories
//         WHERE category_id = '{$category_id}'
//         UNION ALL
//         SELECT c.category_id
//         FROM categories c
//         INNER JOIN CategoryHierarchy ch ON c.parent_category_id = ch.category_id
//     )
//     SELECT p.*
//     FROM products p
//     INNER JOIN CategoryHierarchy ch ON p.category_id = ch.category_id
//     $where
//     -- ORDER BY RAND()
//     LIMIT {$start}, {$per_page};");
//     return $result;
// }

function get_all_products($start, $per_page, $option, $filter_from_price, $filter_to_price) {
    $result = db_fetch_array("SELECT * FROM `products` LIMIT {$start}, {$per_page};");

    // Sắp xếp mảng kết quả dựa trên giá trị $filter_from_price và $filter_to_price
    if (!empty($filter_from_price) && !empty($filter_to_price)) {
        $result = array_filter($result, function($item) use ($filter_from_price, $filter_to_price) {
            return ($item['price'] >= $filter_from_price && $item['price'] <= $filter_to_price);
        });
    } elseif (!empty($filter_from_price)) {
        $result = array_filter($result, function($item) use ($filter_from_price) {
            return ($item['price'] >= $filter_from_price);
        });
    } elseif (!empty($filter_to_price)) {
        $result = array_filter($result, function($item) use ($filter_to_price) {
            return ($item['price'] <= $filter_to_price);
        });
    }

    // Sắp xếp lại mảng kết quả dựa trên tùy chọn $option
    switch ($option) {
        case 1:
            usort($result, function($a, $b) {
                return strcmp($a['name'], $b['name']); // Sắp xếp theo name từ A-Z
            });
            break;
        case 2:
            usort($result, function($a, $b) {
                return strcmp($b['name'], $a['name']); // Sắp xếp theo name từ Z-A
            });
            break;
        case 3:
            usort($result, function($a, $b) {
                return $b['price'] - $a['price']; // Sắp xếp theo price từ cao xuống thấp
            });
            break;
        case 4:
            usort($result, function($a, $b) {
                return $a['price'] - $b['price']; // Sắp xếp theo price từ thấp lên cao
            });
            break;
        default:
            // Không thực hiện sắp xếp nếu không có tùy chọn hợp lệ
            break;
    }

    return $result;
}

// function get_all_products_by_price($filter_from_price, $filter_to_price) {
//     $where = "";
//     if(empty($filter_from_price)) {
//         $where = "WHERE price <= '{$filter_to_price}'";
//     } else if(empty($filter_to_price)) {
//         $where = "WHERE price >= '{$filter_from_price}'";
//     }
//     else {
//         $where = "WHERE price >= '{$filter_from_price}' AND price <= '{$filter_to_price}'";
//     }

//     $result = db_fetch_array("SELECT * FROM `products` $where");
//     return $result;
// }

// function get_all_products_by_option($option) {
//     $orderBy = '';

//     switch ($option) {
//         case 1:
//             $orderBy = 'ORDER BY name ASC';
//             break;
//         case 2:
//             $orderBy = 'ORDER BY name DESC';
//             break;
//         case 3:
//             $orderBy = 'ORDER BY price DESC';
//             break;
//         case 4:
//             $orderBy = 'ORDER BY price ASC';
//             break;
//         default:
//             // Mặc định sắp xếp ngẫu nhiên nếu $option không hợp lệ
//             $orderBy = 'ORDER BY RAND()';
//             break;
//     }

//     $result = db_fetch_array("SELECT * FROM `products` $orderBy");
//     return $result;
// }

// function get_list_search_products_by_price($search, $filter_from_price, $filter_to_price) {
//     $where = "";
//     if(empty($filter_from_price)) {
//         $where = "price <= '{$filter_to_price}'";
//     } else if(empty($filter_to_price)) {
//         $where = "price >= '{$filter_from_price}'";
//     }
//     else {
//         $where = "price >= '{$filter_from_price}' AND price <= '{$filter_to_price}'";
//     }

//     $result = db_fetch_array("SELECT * FROM `products` WHERE `name` LIKE '%{$search}%' AND $where");
//     return $result;
// }

// function get_list_search_products_by_option($search, $option) {
//     $orderBy = '';

//     switch ($option) {
//         case 1:
//             $orderBy = 'ORDER BY name ASC';
//             break;
//         case 2:
//             $orderBy = 'ORDER BY name DESC';
//             break;
//         case 3:
//             $orderBy = 'ORDER BY price DESC';
//             break;
//         case 4:
//             $orderBy = 'ORDER BY price ASC';
//             break;
//         default:
//             // Mặc định sắp xếp ngẫu nhiên nếu $option không hợp lệ
//             $orderBy = 'ORDER BY RAND()';
//             break;
//     }

//     $result = db_fetch_array("SELECT * FROM `products` WHERE `name` LIKE '%{$search}%' $orderBy");
//     return $result;
// }

// lay so luong san pham dua theo danh muc
function get_total_item($category_id) {
    
    $query_string = "WITH RECURSIVE CategoryHierarchy AS (
        SELECT category_id
        FROM categories
        WHERE category_id = '{$category_id}'
        UNION ALL
        SELECT c.category_id
        FROM categories c
        INNER JOIN CategoryHierarchy ch ON c.parent_category_id = ch.category_id
    )
    SELECT p.*
    FROM products p
    INNER JOIN CategoryHierarchy ch ON p.category_id = ch.category_id";

    return db_num_rows($query_string);
}

// lay so luong san pham cua trang wweb
function get_total_item_all_product() {
    $query_string = "SELECT * FROM products";
    return db_num_rows($query_string);
}

function get_total_item_search($search) {
    $query_string = "SELECT * FROM `products` WHERE `name` LIKE '%{$search}%'";
    return db_num_rows($query_string);
}

// function get_total_item_filter_price($category_id, $filter_from_price, $filter_to_price){
//     $where = "";
//     if(empty($filter_from_price)) {
//         $where = "WHERE p.price <= '{$filter_to_price}'";
//     } else if(empty($filter_to_price)) {
//         $where = "WHERE p.price >= '{$filter_from_price}'";
//     }
//     else {
//         $where = "WHERE p.price >= '{$filter_from_price}' AND p.price <= '{$filter_to_price}'";
//     }

//     $query_string = "WITH RECURSIVE CategoryHierarchy AS (
//         SELECT category_id
//         FROM categories
//         WHERE category_id = '{$category_id}'
//         UNION ALL
//         SELECT c.category_id
//         FROM categories c
//         INNER JOIN CategoryHierarchy ch ON c.parent_category_id = ch.category_id
//     )
//     SELECT p.*
//     FROM products p
//     INNER JOIN CategoryHierarchy ch ON p.category_id = ch.category_id
//     $where";

//     return db_num_rows($query_string);
// }

function get_list_products_by_category_id($category_id, $start, $per_page, $option, $filter_from_price, $filter_to_price) {
    $result = db_fetch_array("WITH RECURSIVE CategoryHierarchy AS (
        SELECT category_id
        FROM categories
        WHERE category_id = '{$category_id}'
        UNION ALL
        SELECT c.category_id
        FROM categories c
        INNER JOIN CategoryHierarchy ch ON c.parent_category_id = ch.category_id
    )
    SELECT p.*
    FROM products p
    INNER JOIN CategoryHierarchy ch ON p.category_id = ch.category_id
    LIMIT {$start}, {$per_page};");

    // Sắp xếp mảng kết quả dựa trên giá trị $filter_from_price và $filter_to_price
    if (!empty($filter_from_price) && !empty($filter_to_price)) {
        $result = array_filter($result, function($item) use ($filter_from_price, $filter_to_price) {
            return ($item['price'] >= $filter_from_price && $item['price'] <= $filter_to_price);
        });
    } elseif (!empty($filter_from_price)) {
        $result = array_filter($result, function($item) use ($filter_from_price) {
            return ($item['price'] >= $filter_from_price);
        });
    } elseif (!empty($filter_to_price)) {
        $result = array_filter($result, function($item) use ($filter_to_price) {
            return ($item['price'] <= $filter_to_price);
        });
    }

    // Sắp xếp lại mảng kết quả dựa trên tùy chọn $option
    switch ($option) {
        case 1:
            usort($result, function($a, $b) {
                return strcmp($a['name'], $b['name']); // Sắp xếp theo name từ A-Z
            });
            break;
        case 2:
            usort($result, function($a, $b) {
                return strcmp($b['name'], $a['name']); // Sắp xếp theo name từ Z-A
            });
            break;
        case 3:
            usort($result, function($a, $b) {
                return $b['price'] - $a['price']; // Sắp xếp theo price từ cao xuống thấp
            });
            break;
        case 4:
            usort($result, function($a, $b) {
                return $a['price'] - $b['price']; // Sắp xếp theo price từ thấp lên cao
            });
            break;
        default:
            // Không thực hiện sắp xếp nếu không có tùy chọn hợp lệ
            break;
    }

    return $result;
}

?>