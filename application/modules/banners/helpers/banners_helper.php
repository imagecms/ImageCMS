<?php

if (!function_exists('get_entity_mod')) {

    function get_entity_mod($w) {
        $ci = & get_instance();
        switch ($w) {
            case $w == 'product_0':
                return 'product - all';
                break;
            case $w == 'shop_category_0':
                return 'shop_category - all';
                break;
            case $w == 'brand_0':
                return 'brand - all';
                break;
            case $w == 'category_0':
                return 'category - all';
                break;
            case $w == 'page_0':
                return 'page - all';
                break;
            case strstr($w, 'product'):
                $id = (int) str_replace('product_', '', $w);
                $prod = SProductsQuery::create()->findPk($id);
                if ($prod)
                    return 'product - ' . $prod->getName();
                break;
            case strstr($w, 'shop_category'):
                $id = (int) str_replace('shop_category_', '', $w);
                $cat = SCategoryQuery::create()->findPk($id);
                if ($cat)
                    return 'shop_category - ' . $cat->getName();
                break;
            case strstr($w, 'brand'):
                $id = (int) str_replace('brand_', '', $w);
                $br = SBrandsQuery::create()->findPk($id);
                if ($br)
                    return 'brand - ' . $br->getName();
                break;
            case strstr($w, 'page'):
                $id = (int) str_replace('page_', '', $w);
                $page = $ci->db->where('id', $id)->get('content')->result_array();
                if (count($page) > 0)
                    return 'page - ' . $page[0]['title'];
                break;
            case strstr($w, 'category'):
                $id = (int) str_replace('category_', '', $w);
                $page = $ci->db->where('id', $id)->get('category')->result_array();
                if (count($page) > 0)
                    return 'category - ' . $page[0]['name'];
                break;
            case strstr($w, 'main'):
                return 'main - ' . lang('Main', 'banners');
                break;

            default:
                break;
        }
    }

}
?>
