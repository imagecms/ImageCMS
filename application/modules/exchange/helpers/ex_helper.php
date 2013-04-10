<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

if (!function_exists('load_cat')) {

    function load_cat() {
        $ci = & get_instance();
        return $ci->db->get('shop_category')->result_array();
    }

}
if (!function_exists('load_product')) {

    function load_product() {
        $ci = & get_instance();
        $arr = array();
        foreach($ci->db->get('shop_products')->result_array() as $key => $val){
            $arr[$val['id']] = $val['external_id'];
        }
        return $arr;
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

if (!function_exists('is_cat')) {

    function is_cat($cat_ex_id, $cats) {

        foreach ($cats as $val) {
            if ($val['external_id'] == $cat_ex_id)
                return $val;
        }

        return false;
    }

}

if (!function_exists('is_prod')) {

    function is_prod($prod_ex_id, $prods) {

        if(in_array($prod_ex_id, $prods))
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
if (!function_exists('is_prop_data')) {

    function is_prop_data($prop_id, $prod_id, $props) {

        return array_key_exists($prop_id . '_' . $prop_id, $props);
    }

}




