<?php
function buildCategoryTree($categories, $parentId = 0)
{
    if($parentId == 0){
        $result = '<ul class="list-item">';
    } else {
        $result = '<ul class="sub-menu">';
    }
    
    foreach ($categories as $category) {
        if ($category['parent_category_id'] == $parentId) {
            $result .= '<li>';
            $result .= '<a href="?mod=product&controller=index&action=categoryProduct&category_id='.$category['category_id'].'" title="">' . $category['name'] . '</a>';
            
            // Gọi đệ quy để xây dựng danh mục con
            $subCategories = buildCategoryTree($categories, $category['category_id']);
            if ($subCategories) {
                $result .= $subCategories;
            }

            $result .= '</li>';
        }
    }

    $result .= '</ul>';
    
    return $result;
}

// function buildCategoryTree($categories, $parentId = 0)
// {
//     $result = '';
    
//     foreach ($categories as $category) {
//         if ($category['parent_category_id'] == $parentId) {
//             if (!empty($result)) {
//                 // Nếu đã có danh sách con, thêm class "sub-menu" cho thẻ ul
//                 $result .= '<ul class="sub-menu">';
//             } else {
//                 // Nếu chưa có danh sách con, thêm class "list-item" cho thẻ ul
//                 $result .= '<ul class="list-item">';
//             }
            
//             $result .= '<li>';
//             $result .= '<a href="?page=category_product" title="">' . $category['name'] . '</a>';
            
//             // Gọi đệ quy để xây dựng danh mục con
//             $subCategories = buildCategoryTree($categories, $category['category_id']);
//             if ($subCategories) {
//                 $result .= $subCategories;
//             }

//             $result .= '</li>';
//             $result .= '</ul>';
//         }
//     }
    
//     return $result;
// }

?>