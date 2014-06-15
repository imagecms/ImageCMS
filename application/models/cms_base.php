<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_DB_active_record $db
 */
class Cms_base extends CI_Model {

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
        $this->db->cache_on();
        $this->db->where('s_name', 'main');
        $query = $this->db->get('settings', 1);

        if ($query->num_rows() == 1) {
            $arr = $query->row_array();
            $lang_arr = get_main_lang();
            $meta = $this->db
                    ->where('lang_ident', $lang_arr['id'])
                    ->limit(1)
                    ->get('settings_i18n')
                    //echo $this->db->_error_message();
                    ->result_array();

            $arr['site_short_title'] = $meta[0]['short_name'];
            $arr['site_title'] = $meta[0]['name'];
            $arr['site_description'] = $meta[0]['description'];
            $arr['site_keywords'] = $meta[0]['keywords'];
            $this->db->cache_off();

            return $arr;
        }
        $this->db->cache_off();

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
                ->get('languages')
                ->result_array();
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
//        $this->db->cache_on();
        $this->db->order_by('position', 'ASC');
        $query = $this->db->get('category');

        if ($query->num_rows() > 0) {
            $categories = $query->result_array();

            ($hook = get_hook('cmsbase_return_categories')) ? eval($hook) : NULL;

            return $categories;
        }

//        $this->db->cache_on();
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

}

/* end of cms_base.php */
