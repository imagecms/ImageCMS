<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('get_page')) {

    /**
     * Get page by id
     * @param int $id
     * @return bool|array
     */
    function get_page($id) {

        $lang_id = get_main_lang('id');
        $lang_identif = get_main_lang('identif');

        /* @var $ci MY_Controller */
        $ci = &get_instance();

        $ci->db->limit(1);
        $ci->db->select('IF(route.parent_url <> \'\', concat(route.parent_url, \'/\', route.url), route.url) as full_url, category, content.id, content.title, full_text, prev_text, publish_date, showed, comments_count, author', FALSE);
        $ci->db->join('route', 'route.id=content.route_id');

        if ($lang_identif == $ci->uri->segment(1)) {
            $ci->db->where('lang_alias', $id);
            $ci->db->where('lang', $lang_id);
        } else {
            $ci->db->where('content.id', $id);
        }
        $query = $ci->db->get('content');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }

        return FALSE;
    }

}

if (!function_exists('category_pages')) {

    /**
     * Get pages by category
     * @param int $categoryId
     * @param int $limit
     * @return array
     */
    function category_pages($categoryId, $limit = 0) {
        $ci = &get_instance();

        $category = $ci->lib_category->get_category($categoryId);
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
        $ci->db->select('IF(route.parent_url <> \'\', concat(route.parent_url, \'/\', route.url), route.url) as full_url', FALSE);
        $ci->db->join('route', 'route.id=content.route_id');

        $ci->db->order_by($category['order_by'], $category['sort_order']);

        if ($limit > 0) {
            $ci->db->limit($limit);
        }

        $query = $ci->db->get('content');

        if ($query) {
            return $query->result_array();
        } else {
            return [];
        }
    }

}

if (!function_exists('encode')) {

    /**
     * @param string $string
     * @return string
     */
    function encode($string) {
        if (!is_string($string)) {
            $string = (string) $string;
        }
        return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
    }

}

if (!function_exists('getPageCategoryId')) {

    /**
     * @param int $page_id
     * @return int
     */
    function getPageCategoryId($page_id) {
        $ci = &get_instance();
        $page_category = $ci->db->where('id', $page_id)->get('content');
        return $page_category ? $page_category->row()->category : 0;
    }

}