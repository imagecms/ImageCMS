<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

if (!function_exists('load_cat')) {

    function load_cat() {
        $ci = & get_instance();
        return $ci->db->get('shop_category')->result_array();
    }

}

if (!function_exists('load_cat_ids')) {

    function load_cat_ids() {
        $ci = & get_instance();
        $arr = array();
        foreach ($ci->db->get('shop_category')->result_array() as $key => $val) {
            $arr[$val['external_id']] = $val['id'];
        }
        return $arr;
    }

}

if (!function_exists('load_product')) {

    function load_product() {
        $ci = & get_instance();
        $arr = array();
        foreach ($ci->db->get('shop_products')->result_array() as $key => $val) {
            $arr[$val['id']] = $val['external_id'];
        }
        return $arr;
    }

}

if (!function_exists('load_products_i18n')) {

    function load_products_i18n() {
        $ci = & get_instance();
        return $ci->db->select('shop_products.id, shop_products.external_id, shop_product_variants.id as varId , shop_products_i18n.name')
                        ->join('shop_products_i18n', 'shop_products.id = shop_products_i18n.id')
                        ->join(' shop_product_variants', 'shop_products.id =  shop_product_variants.product_id')
                        ->get('shop_products')->result_array();
    }

}

if (!function_exists('load_productivity')) {

    function load_productivity() {
        $ci = & get_instance();

        return $ci->db->get('mod_exchangeunfu_productivity')->result_array();
    }

}

if (!function_exists('load_partners')) {

    function load_partners() {
        $ci = & get_instance();

        return $ci->db->get('mod_exchangeunfu_partners')->result_array();
    }

}

if (!function_exists('load_prices')) {

    function load_prices() {
        $ci = & get_instance();

        return $ci->db->get('mod_exchangeunfu_prices')->result_array();
    }

}


if (!function_exists('is_partner')) {

    function is_partner($partner_ex_id, $partners) {
        foreach ($partners as $val) {
            if ($val['external_id'] == $partner_ex_id)
                return $val;
        }
        return false;
    }

}

if (!function_exists('is_price')) {

    function is_price($price_ext_id, $prices) {
        foreach ($prices as $val) {
            if ($val['external_id'] == $price_ext_id)
                return $val;
        }
        return false;
    }

}

if (!function_exists('is_productivity')) {

    function is_productivity($productivity_ext_id, $productivity_db) {
        foreach ($productivity_db as $val) {
            if ($val['external_id'] == $productivity_ext_id)
                return $val;
        }
        return false;
    }

}

if (!function_exists('is_product_i18n')) {

    function is_product_i18n($product_id, $products) {
        foreach ($products as $val) {
            if ($val['id'] == $product_id)
                return $val;
        }
        return false;
    }

}

if (!function_exists('load_users')) {

    function load_users() {
        $ci = & get_instance();
        $arr = array();
        foreach ($ci->db->get('users')->result_array() as $key => $val) {
            $arr[$val['id']] = $val['external_id'];
        }
        return $arr;
    }

}

if (!function_exists('load_urls')) {

    function load_urls() {
        $ci = & get_instance();
        $arr = array();
        foreach ($ci->db->get('shop_products')->result_array() as $key => $val) {
            $arr[$val['id']] = $val['url'];
        }
        return $arr;
    }

}

if (!function_exists('get_product_category')) {

    function get_product_category($id) {
        $ci = & get_instance();
        $result = $ci->db
                ->join('shop_category', 'shop_category.id=shop_products.category_id')
                ->where('shop_products.id', $id)
                ->get('shop_products')
                ->row_array();
        return $result;
    }

}

if (!function_exists('load_brand')) {

    function load_brand() {
        $ci = & get_instance();
        return $ci->db->get('shop_brands_i18n')->result_array();
    }

}

if (!function_exists('load_orders')) {

    function load_orders() {
        $ci = & get_instance();
        return $ci->db->get('shop_orders')->result_array();
    }

}

if (!function_exists('load_orders_products')) {

    function load_orders_products() {
        $ci = & get_instance();
        return $ci->db->get('shop_orders_products')->result_array();
    }

}

if (!function_exists('load_prop')) {

    function load_prop() {
        $ci = & get_instance();
        return $ci->db->get('shop_product_properties')->result_array();
    }

}

if (!function_exists('load_prop_data')) {

    function load_prop_data() {
        $ci = & get_instance();
        $arr = array();
        foreach ($ci->db->get('shop_product_properties_data')->result_array() as $val) {
            $arr[$val['property_id'] . '_' . $val['product_id']] = $val['value'];
        }
        return $arr;
    }

}
if (!function_exists('load_multiple_prop')) {

    /**
     * Load multiple prop
     * @return type
     */
    function load_multiple_prop() {
        $ci = & get_instance();
        $arr = array();
        $result = $ci->db->get('mod_exchange');
        if ($result)
            foreach ($result->result_array() as $val) {
                $arr[$val['external_id']] = $val['value'];
            }
        return $arr;
    }

}

if (!function_exists('is_cat')) {

    function is_cat($cat_ex_id, $cats) {

        foreach ($cats as $val) {
            if ($val['external_id'] == $cat_ex_id)
                return $val;
        }

        return false;
    }

}

if (!function_exists('is_user')) {

    function is_user($user_ex_id, $users) {
        if (in_array($user_ex_id, $users))
            return array('id' => array_search($user_ex_id, $users));
        else
            return false;
    }

}

if (!function_exists('is_orders_product')) {

    function is_orders_product($order_id, $products, $product_id) {
        foreach ($products as $val) {
            if ($val['product_id'] == $product_id && $val['order_id'] == $order_id){
                return $val;
            }
        }
        return false;
    }

}


if (!function_exists('is_order')) {

    function is_order($order_ex_id, $orders) {

        foreach ($orders as $val) {
            if ($val['external_id'] == $order_ex_id) {
                return $val;
            }
        }

        return false;
    }

}

if (!function_exists('is_prod')) {

    function is_prod($prod_ex_id, $prods) {

        if (in_array($prod_ex_id, $prods))
            return array('id' => array_search($prod_ex_id, $prods));
        else
            return false;
    }

}

if (!function_exists('is_brand')) {

    function is_brand($brand_name, $brands) {

        foreach ($brands as $val) {
            if ($val['name'] == $brand_name)
                return $val['id'];
        }

        return false;
    }

}
if (!function_exists('is_prop')) {

    function is_prop($prop_id, $props) {

        foreach ($props as $val) {
            if ($val['external_id'] == $prop_id)
                return $val;
        }

        return false;
    }

}

if (!function_exists('is_prop_multiple')) {

    /**
     *
     * @param type $prop_id
     * @param type $props all properties
     * @return boolean
     */
    function is_prop_multiple($prop_id, $props) {

        foreach ($props as $val) {
            if ($val[external_id] == $prop_id) {
                if ($val[multiple]) {
                    return TRUE;
                }
            }
        }
        return false;
    }

}

if (!function_exists('is_prop_data')) {

    function is_prop_data($prop_id, $prod_id, $props) {

        return array_key_exists($prop_id . '_' . $prod_id, $props);
    }

}




