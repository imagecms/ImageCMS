<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @property Cms_base $cms_base
 */
class Cms_admin extends CI_Model
{

    /*     * ***********************************************************
     * 	Pages
     * ********************************************************** */

    /**
     * Add page into content table
     *
     * @param array $data
     * @return integer
     */
    public function add_page($data) {
        unset($data['url'], $data['cat_url']);
        $this->db->limit(1);
        if (!$data['comments_count']) {
            $data['comments_count'] = 0;
        }
        if (!$data['position']) {
            $data['position'] = 0;
        }
        if (!$data['updated']) {
            $data['updated'] = 0;
        }
        if (!$data['showed']) {
            $data['showed'] = 0;
        }
        if (!$data['lang_alias']) {
            $data['lang_alias'] = 0;
        }

        $this->db->insert('content', $data);

        return $this->db->insert_id();
    }

    /**
     * Select page by id and lang_id
     *
     * @param int $id
     * @param int $lang
     * @return array|bool
     */
    public function get_page_by_lang($id, $lang = 0) {

        $this->db->where('id', $id);
        $this->db->where('lang', $lang);
        $query = $this->db->get('content', 1);

        if ($query->num_rows == 1) {
            return $query->row_array();
        }

        return FALSE;
    }

    /**
     * Select page by id
     *
     * @param integer $id
     * @return array|bool
     */
    public function get_page($id) {

        $this->db
            ->select('content.*, route.url')
            ->where('content.id', $id)
            ->join('route', 'route.id = content.route_id');
        $query = $this->db->get('content', 1);

        if ($query->num_rows > 0) {
            return $query->row_array();
        }

        return FALSE;
    }

    /**
     * @param integer $id
     * @return bool
     */
    public function page_exists($id) {

        $this->db->select('id');
        $this->db->where('id', $id);
        $query = $this->db->get('content', 1);

        return $query->num_rows == 1;
    }

    /**
     * @param int $id
     * @param array $data
     * @param bool $exists
     * @return bool
     */
    public function update_page($id, $data, $exists = false) {

        unset($data['url'], $data['cat_url']);
        $lang_id = $this->input->post('lang_id');
        $pageExists = (int) $this->input->post('pageExists');

        if (!$pageExists && $exists == false) {
            unset($data['id']);
            $data['lang_alias'] = $id;
            $data['lang'] = $lang_id;
            $id = $this->add_page($data);
            $inserted = $id ? true : false;

        }

        $this->db->where('id', $id);
        $this->db->update('content', $data);

        $affectedRows = $this->db->affected_rows();
        return ($affectedRows || $inserted) ? $id : false;
    }

    /**
     * Creates new category
     *
     * @param array $data
     * @return int
     */
    public function create_category($data) {

        unset($data['url']);
        $this->db->insert('category', $data);

        return $this->db->insert_id();
    }

    /**
     * Update category data
     *
     * @access public
     * @param array $data
     * @param int $id
     */
    public function update_category($data, $id) {

        unset($data['url']);
        $this->db->where('id', $id);
        $this->db->update('category', $data);
    }

    /**
     * Select all categories
     *
     * @access public
     * @return array
     */
    public function get_categories() {

        return $this->cms_base->get_categories();
    }

    /**
     * Get category by id
     * @param int $id
     * @return bool|array
     */
    public function get_category($id) {

        $query = $this->db
            ->select('category.*, route.url')
            ->where('category.id', $id)
            ->join('route', 'route.id = category.route_id')->get('category', 1);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }

        return FALSE;
    }

    /**
     * Check if category is created
     *
     * @access public
     * @param string $url
     * @return bool
     */
    public function is_category($url) {

        $this->db->where('url', $url);
        $query = $this->db->get('category', 1);

        return $query->num_rows == 1;
    }

    /*     * ***********************************************************
     * 	Settings
     * ********************************************************** */

    /**
     *    Save settings
     *
     * @settings array
     * @access public
     * @param array $settings
     */
    public function save_settings($settings) {

        $this->db->where('s_name', 'main');
        $this->db->update('settings', $settings);
    }

    /**
     * Selecting main settings
     *
     * @access public
     * @return array
     */
    public function get_settings() {

        return $this->cms_base->get_settings();
    }

    /**
     * Get editor theme
     *
     * @access public
     * @return string
     */
    public function editor_theme() {

        $this->db->select('editor_theme');
        $this->db->where('s_name', 'main');
        $query = $this->db->get('settings', 1);

        return $query->row_array();
    }

    /*     * ***********************************************************
     * 	Languages
     * ********************************************************** */

    /**
     * Add page into content table
     *
     * @param array $data
     * @return int
     */
    public function insert_lang($data) {

        $this->db->insert('languages', $data);

        return $this->db->insert_id();
    }

    /**
     * @param bool|false $forShop
     * @return array
     */
    public function get_langs($forShop = false) {

        if ($forShop) {
            if (strpos(getCMSNumber(), 'Pro')) {
                return $this->db
                    ->where('default', true)
                    ->get('languages')
                    ->result_array();
            }
        }

        $query = $this->db->get('languages');

        return $query->result_array();
    }

    /**
     * @param $id
     * @return bool|array
     */
    public function get_lang($id) {

        $this->db->where('id', $id);
        $query = $this->db->get('languages', 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }

        return FALSE;
    }

    /**
     * @param array $data
     * @param int $id
     */
    public function update_lang($data, $id) {

        $this->db->where('id', $id);
        $this->db->update('languages', $data);
    }

    /**
     * @param integer $id
     */
    public function delete_lang($id) {

        $this->db->where('id', $id);
        $this->db->limit(1);
        $this->db->delete('languages');
    }

    /**
     * @param integer $id
     */
    public function set_default_lang($id) {

        $this->db->update('languages', ['default' => 0]);

        $this->db->where('id', $id);
        $this->db->limit(1);
        $this->db->update('languages', ['default' => 1, 'active' => 1]);
    }

    /**
     * @return array
     */
    public function get_default_lang() {

        if ($this->db) {
            $this->db->where('default', 1);
            $query = $this->db->get('languages', 1);
            return $query->row_array();
        }
    }

}