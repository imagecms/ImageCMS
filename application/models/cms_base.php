<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @property CI_DB_active_record $db
 */
class Cms_base extends CI_Model
{

    public $locale_id;

    /**
     * @var array
     */
    private static $settings;

    /**
     * @var array
     */
    private static $language;

    public function __construct() {

        parent::__construct();
    }

    /**
     * Select main settings
     *
     * @access public
     * @param string|null $key
     * @return array
     */
    public function get_settings($key = null) {

        if (self::$settings) {
            return $key === null ? self::$settings : self::$settings[$key];
        }

        $this->db->where('s_name', 'main');
        $query = $this->db->get('settings', 1);

        if ($query and $query->num_rows() == 1) {
            $settings = $query->row_array();
            $lang_arr = get_main_lang();
            $meta = $this->db
                ->where('lang_ident', $lang_arr['id'])
                ->limit(1)
                ->get('settings_i18n')
                ->result_array();

            $settings['site_short_title'] = $meta[0]['short_name'];
            $settings['site_title'] = $meta[0]['name'];
            $settings['site_description'] = $meta[0]['description'];
            $settings['site_keywords'] = $meta[0]['keywords'];
            $this->db->cache_off();
            self::$settings = $settings;
            return $key === null ? $settings : $settings[$key];
        } else {
            show_error($this->db->_error_message());
        }

        return FALSE;
    }

    /**
     * Select site languages
     * @access public
     * @param bool $active
     * @return array
     */
    public function get_langs($active = FALSE) {

        if (self::$language[(int) $active]) {
            return self::$language[(int) $active];
        }
        if ($active) {
            $this->db->where('active', 1);
        }

        $query = $this->db->get('languages');

        if ($query) {
            $query = $query->result_array();
            self::$language[(int) $active] = $query;
        } else {
            show_error($this->db->_error_message());
        }

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

    /**
     * @param int $cat_id
     * @return bool|object
     */
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

    /**
     * @param bool|int $page_id
     * @return bool|object
     */
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

    /**
     * @param bool|int $page_id
     * @return bool|object
     */
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
        $query = $this->db
            ->select('category.*, route.url')
            ->join('route', 'route.id = category.route_id')
            ->get('category');

        if ($query->num_rows() > 0) {
            $categories = $query->result_array();

            $n = 0;
            $ci = &get_instance();
            $ci->load->library('DX_Auth');
            foreach ($categories as $c) {
                $categories[$n] = $ci->load->module('cfcm')->connect_fields($c, 'category');
                $n++;
            }

            return $categories;
        }

        return FALSE;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function get_category_by_id($id) {

        $query = $this->db
            ->select('category.*, route.url, route.parent_url')
            ->order_by('category.position', 'ASC')
            ->where('category.id', $id)
            ->join('route', 'category.route_id = route.id')
            ->get('category');

        if ($query->num_rows() > 0) {
            $categories = $query->row_array();

            return $categories;
        }

        return FALSE;
    }

    /**
     * @param int $id
     * @return string
     */
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

    /**
     * @return array
     */
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

        $categoriesPagesCounts = [];
        $count = count($result);
        for ($i = 0; $i < $count; $i++) {
            $categoriesPagesCounts[$result[$i]['id']] = [
                                                         'parent_id'   => $result[$i]['parent_id'],
                                                         'pages_count' => $result[$i]['pages_count'],
                                                        ];
        }

        return $categoriesPagesCounts;
    }

    /**
     * @return mixed
     */
    public function getLocaleId() {

        return $this->locale_id;
    }

    /**
     * @param mixed $locale_id
     */
    public function setLocaleId($locale_id) {

        if ($locale_id != MY_Controller::getDefaultLanguage()['id']) {

            $this->locale_id = $locale_id;

        }

    }

}

/* end of cms_base.php */