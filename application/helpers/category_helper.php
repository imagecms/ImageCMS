<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

if (!function_exists('get_sub_categories')) {

    /**
     * Short description for function
     *
     * Long description (if any) ...
     *
     * @param integer $category_id Parameter description (if any) ...
     * @return array   Return description (if any) ...
     */
    function get_sub_categories($category_id = 0) {
        $ci = & get_instance();
        $categories = $ci->lib_category->unsorted();

        $result = [];

        foreach ($categories as $category) {
            if ($category['parent_id'] == $category_id) {
                $result[] = $category;
            }
        }

        return $result;
    }

}

if (!function_exists('category_list')) {

    /**
     * @param string $exclude_cats
     * @return array
     */
    function category_list($exclude_cats = '') {
        $ci = & get_instance();
        $ci->load->helper('html');
        $ci->load->module('core');
        $categories = $ci->lib_category->unsorted();

        $exclude_cats = explode(',', $exclude_cats);

        $result = [];

        foreach ($categories as $row) {
            if (!in_array($row['id'], $exclude_cats)) {
                $row['fetch_pages'] = unserialize($row['fetch_pages']);

                $total_pages = _get_category_pages($row, 0, 0, TRUE);
                $result[] = '<a href="' . site_url($row['path_url']) . '">' . $row['name'] . ' (' . $total_pages . ')</a>';
            }
        }

        return ul($result);
    }

}

if (!function_exists('sub_category_list')) {

    /**
     * @param integer $category_id
     * @return mixed
     */
    function sub_category_list($category_id = 0) {
        $ci = & get_instance();
        $ci->load->helper('html');
        $ci->load->module('core');

        if ($category_id > 0) {
            $categories = get_sub_categories($category_id);

            if (count($categories) > 0) {
                foreach ($categories as $row) {
                    $row['fetch_pages'] = unserialize($row['fetch_pages']);

                    $total_pages = _get_category_pages($row, 0, 0, TRUE);
                    $result[] = '<a href="' . site_url($row['path_url']) . '">' . $row['name'] . ' (' . $total_pages . ')</a>';
                }

                return ul($result);
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}

if (!function_exists('get_category_name')) {

    /**
     * @param integer $id
     * @return mixed
     */
    function get_category_name($id) {
        $ci = & get_instance();
        $c = $ci->lib_category->get_category($id);

        if ($c['name'] == '') {
            $c['name'] = lang('No category');
        }

        return $c['name'];
    }

}

if (!function_exists('_get_category_pages')) {

    /**
     * Select or count pages in category
     * @param array $category
     * @param int $row_count
     * @param int $offset
     * @param bool|FALSE $count
     * @return array|string
     */
    function _get_category_pages(array $category = [], $row_count = 0, $offset = 0, $count = FALSE) {
        $ci = & get_instance();

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
        $ci->db->order_by($category['order_by'], $category['sort_order']);
        $ci->db->join('route', 'route.id=content.route_id');

        if ($count === FALSE) {
            if ($row_count > 0) {
                $query = $ci->db->get('content', (int) $row_count, (int) $offset);
            } else {
                $query = $ci->db->get('content');
            }
        } else {
            $ci->db->from('content');
            return $ci->db->count_all_results();
        }
        $pages = $query->result_array();

        if (count($pages) > 0 AND is_array($pages)) {
            $n = 0;
            foreach ($pages as $p) {
                $pages[$n] = $ci->cfcm->connect_fields($p, 'page');
                $n++;
            }
        }
        return $pages;
    }

}

/* End of file category_helper.php */