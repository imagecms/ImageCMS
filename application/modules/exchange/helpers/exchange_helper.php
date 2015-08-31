<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

if (!function_exists('load_cat')) {

    function load_cat() {
        $ci = & get_instance();
        return $ci->db->get('shop_category')->result_array();
    }

}
if (!function_exists('test_ex')) {

    function test_ex() {
        exit('1');
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

if (!function_exists('load_main_curr')) {

    function load_main_curr() {
        $ci = & get_instance();
        $mainCurrencyId = $ci->db->select('id')->where('main', 1)->get('shop_currencies')->row_array();
        if (!empty($mainCurrencyId))
            $mainCurrencyId = $mainCurrencyId['id'];
        else
            $mainCurrencyId = 1;

        return $mainCurrencyId;
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

    function is_cat($cat_ex_id, &$cats) {

        foreach ($cats as $val) {
            if ($val['external_id'] == $cat_ex_id)
                return $val;
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




