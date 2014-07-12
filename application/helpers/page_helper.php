<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('get_page')) {

    // Get page by id
    function get_page($id) {

        $lang_id = get_main_lang('id');
        $lang_identif = get_main_lang('identif');

        /* @var $ci MY_Controller */
        $ci = & get_instance();

        $ci->db->limit(1);
        $ci->db->select('CONCAT_WS("", content.cat_url, content.url) as full_url, content.id, content.title, prev_text, publish_date, showed, comments_count, author', FALSE);

        if ($lang_identif == $ci->uri->segment(1)) {
            $ci->db->where('lang_alias', $id);
            $ci->db->where('lang', $lang_id);
        }
        else
            $ci->db->where('id', $id);
        $query = $ci->db->get('content');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }

        return FALSE;
    }

}

if (!function_exists('category_pages')) {

    // Get pages by category
    function category_pages($category, $limit = 0) {
        $ci = & get_instance();

        $category = $ci->lib_category->get_category($category);
        $category['fetch_pages'] = unserialize($category['fetch_pages']);

        $ci->db->where('post_status', 'publish');
        $ci->db->where('publish_date <=', time());
        $ci->db->where('lang', $ci->config->item('cur_lang'));

        if (count($category['fetch_pages']) > 0) {
            $category['fetch_pages'][] = $category['id'];
            $ci->db->where_in('category', $category['fetch_pages']);
        } else {
            $ci->db->where('category', $category['id']);
        }

        $ci->db->select('content.*');
        $ci->db->select('CONCAT_WS("", content.cat_url, content.url) as full_url', FALSE);
        $ci->db->order_by($category['order_by'], $category['sort_order']);

        if ($limit > 0) {
            $ci->db->limit($limit);
        }

        $query = $ci->db->get('content');

        if ($query->num_rows()) {
            return $query->result_array();
        } else {
            return array();
        }
    }

}

if (!function_exists('encode')) {

    function encode($string) {
        if (!is_string($string))
            $string = (string) $string;
        return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
    }

}
