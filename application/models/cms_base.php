<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @property CI_DB_active_record $db
 */
class Cms_base extends CI_Model {

    private static $arr;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Select main settings
     *
     * @access public
     * @return array
     */
    public function get_settings() {
        if (self::$arr) {
            return self::$arr;
        }

        //$this->db->cache_on();         //!!! Відключив через кешування запитів і повернення неправильних даних
        $this->db->where('s_name', 'main');
        $query = $this->db->get('settings', 1);

        if ($query and $query->num_rows() == 1) {
            $arr = $query->row_array();
            $lang_arr = get_main_lang();
            $meta = $this->db
                    ->where('lang_ident', $lang_arr['id'])
                    ->limit(1)
                    ->get('settings_i18n')
                    ->result_array();

            $arr['site_short_title'] = $meta[0]['short_name'];
            $arr['site_title'] = $meta[0]['name'];
            $arr['site_description'] = $meta[0]['description'];
            $arr['site_keywords'] = $meta[0]['keywords'];
            $this->db->cache_off();
            self::$arr = $arr;
            return $arr;
        } else {
            show_error($this->db->_error_message());
        }

        return FALSE;
    }

    /**
     * Select site languages
     *
     * @access public
     * @return array
     */
    public function get_langs() {
        $this->db->cache_on();
        $query = $this->db
                ->get('languages');
        if ($query) {
            $query = $query->result_array();
        } else {
            show_error($this->db->_error_message());
        }

        $this->db->cache_off();

        return $query;
    }

    /**
     * Load modules
     */
    public function get_modules() {
        $this->db->cache_on();
        $query = $this->db
                ->select('id, name, identif, autoload, enabled')
                ->order_by('position')
                ->get('components');
        $this->db->cache_off();

        return $query;
    }

    public function get_category_pages($cat_id) {
        $this->db->cache_on();
        $this->db->where('category', $cat_id);
        $this->db->where('post_status', 'publish');
        $this->db->where('publish_date <=', time());
        $this->db->where('lang_alias', 0);
        $this->db->where('lang', $this->config->item('cur_lang'));
        $this->db->order_by('created', 'desc');
        $query = $this->db->get('content');

        if ($query->num_rows() > 0) {
            $query = $query->result_array();
            $this->db->cache_off();
            return $query;
        } else {
            $this->db->cache_off();
            return FALSE;
        }
    }

    public function get_page_by_id($page_id = FALSE) {
        if ($page_id != FALSE) {
            $this->db->cache_on();
            $this->db->where('post_status', 'publish');
            $this->db->where('publish_date <=', time());
            $this->db->where('id', $page_id);

            $query = $this->db->get('content', 1);

            if ($query->num_rows() == 1) {
                $query = $query->row_array();
                $this->db->cache_off();
                return $query;
            }
            $this->db->cache_off();
        }

        return FALSE;
    }

    public function get_page($page_id = FALSE) {
        return $this->get_page_by_id($page_id);
    }

    /**
     * Select all categories
     *
     * @access public
     * @return array
     */
    public function get_categories() {
        $this->db->order_by('position', 'ASC');
        $query = $this->db->get('category');

        if ($query->num_rows() > 0) {
            $categories = $query->result_array();

            $n = 0;
            $ci = & get_instance();
            $ci->load->library('DX_Auth');
            foreach ($categories as $c) {
                $categories[$n] = $ci->load->module('cfcm')->connect_fields($c, 'category');
                $n++;
            }

            return $categories;
        }

        return FALSE;
    }

    public function get_category_by_id($id) {

        $query = $this->db
                ->order_by('position', 'ASC')
                ->where('id', $id)
                ->get('category');

        if ($query->num_rows() > 0) {
            $categories = $query->row_array();

            return $categories;
        }

        return FALSE;
    }

    public function get_category_full_path($id) {
        $cats = $this->get_category_by_id($id);
        $url = $cats['url'];

        if ($cats['parent_id']) {
            $url = $this->get_category_full_path($cats['parent_id']) . '/' . $url;
        } else {
            return $cats['url'];
        }

        return $url;
    }

    public function getCategoriesPagesCounts() {
        // getting counts
        $result = $this->db
                ->select(['category.id', 'category.parent_id', 'count(content.id) as pages_count'])
                ->from('category')
                ->join('content', 'category.id=content.category')
                ->where('lang_alias', 0)
                ->group_by('category.id')
                ->get();

        if (!$result) {
            return [];
        }

        $result = $result->result_array();

        $categoriesPagesCounts = array();
        $count = count($result);
        for ($i = 0; $i < $count; $i++) {
            $categoriesPagesCounts[$result[$i]['id']] = array(
                'parent_id' => $result[$i]['parent_id'],
                'pages_count' => $result[$i]['pages_count'],
            );
        }

        return $categoriesPagesCounts;
    }

}

/* end of cms_base.php */