<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cms_admin extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

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
     * @return array
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
     * @return array
     */
    public function get_page($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('content', 1);

        if ($query->num_rows > 0) {
            return $query->row_array();
        }

        return FALSE;
    }

    public function page_exists($id) {
        $this->db->select('id');
        $this->db->where('id', $id);
        $query = $this->db->get('content', 1);

        if ($query->num_rows == 1) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Updating page by id
     *
     * @return boolean
     */
    public function update_page($id, $data) {
        $lang_id = $this->input->post('lang_id');
        $pageExists = (int) $this->input->post('pageExists');

        if (!$pageExists) {
            unset($data['id']);
            $data['lang_alias'] = $id;
            $data['lang'] = $lang_id;
            $id = $this->add_page($data);
            $inserted = $id ? true : false;
        }

        $page = $this->get_page($id);
        $alias = $page['lang_alias'];

        if ($alias == 0) {
            $this->db->where('lang_alias', $page['id']);
            $this->db->update('content', array('post_status' => $data['post_status'], 'category' => $data['category'], 'cat_url' => $data['cat_url'], 'url' => $data['url']));
        } else {
            $page = $this->get_page($alias);
            $this->db->where('lang_alias', $page['id']);
            $this->db->update('content', array('post_status' => $data['post_status'], 'category' => $data['category'], 'cat_url' => $data['cat_url']));

            $this->db->where('id', $alias);
            $this->db->update('content', array('post_status' => $data['post_status'], 'category' => $data['category'], 'cat_url' => $data['cat_url']));

            $data['url'] = $page['url'];
        }

        // update page
        $this->db->where('id', $id);
        $this->db->update('content', $data);
        // end update page

        $affectedRows = $this->db->affected_rows();
        return $affectedRows || $inserted;
    }

    /*     * ***********************************************************
     * 	Categories
     * ********************************************************** */

    /**
     * Creates new category
     *
     * @return integer
     */
    public function create_category($data) {
        $this->db->insert('category', $data);

        return $this->db->insert_id();
    }

    /*
     * Update category data
     *
     * @access public
     */

    public function update_category($data, $id) {
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

    /*
     * Get category by id
     */

    public function get_category($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('category', 1);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }

        return FALSE;
    }

    /**
     * Check if category is created
     *
     * @access public
     * @return bool
     */
    public function is_category($url) {
        $this->db->where('url', $url);
        $query = $this->db->get('category', 1);

        if ($query->num_rows == 1) {
            return TRUE;
        }

        return FALSE;
    }

    /*     * ***********************************************************
     * 	Settings
     * ********************************************************** */

    /**
     *    Save settings
     *
     * @settings array
     * @access public
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
     * @return integer
     */
    public function insert_lang($data) {
        $this->db->insert('languages', $data);

        return $this->db->insert_id();
    }

    public function get_langs($forShop = false) {
        if ($forShop) {
            if (strpos(getCMSNumber(), 'Pro')) {
                return $this->db
                    ->where('default', true)
                    ->get('languages')
                    ->result_array();
            }
        }

        //		$this->db->order_by('default', 'desc');
        $query = $this->db->get('languages');

        return $query->result_array();
    }

    public function get_lang($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('languages', 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }

        return FALSE;
    }

    public function update_lang($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('languages', $data);
    }

    public function delete_lang($id) {
        $this->db->where('id', $id);
        $this->db->limit(1);
        $this->db->delete('languages');
    }

    public function set_default_lang($id) {
        $this->db->update('languages', array('default' => 0));

        $this->db->where('id', $id);
        $this->db->limit(1);
        $this->db->update('languages', array('default' => 1));
    }

    public function get_default_lang() {
        if ($this->db) {
            $this->db->where('default', 1);
            $query = $this->db->get('languages', 1);
            return $query->row_array();
        }
    }

}