<?php

use core\models\Route;
use core\models\RouteQuery;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Menu_model extends CI_Model
{

    /**
     *
     * @param integer $id
     */
    public function delete_menu_item($id) {

        $this->db->where('id', $id);
        $this->db->delete('menus_data');
    }

    /**
     *
     * @param string $name
     */
    public function delete_menu($name) {

        $this->db->limit(1);
        $this->db->delete('menus', ['name' => $name]);
    }

    /**
     *
     * @param integer $id
     * @return false|array
     */
    public function get_parent_items($id) {

        $this->db->where('parent_id', $id);
        $query = $this->db->get('menus_data');

        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    /**
     *
     * @param integer $id
     * @return array
     */
    public function get_item($id) {

        return $this->db->get_where('menus_data', ['id' => $id])->row_array();
    }

    /**
     *
     * @param integer $id
     * @param array $data
     * @return boolean
     */
    public function update_item($id, $data) {

        $this->db->where('id', $id);
        $this->db->update('menus_data', $data);

        return TRUE;
    }

    /**
     *
     * @param array $data
     */
    public function insert_item($data = []) {

        if (is_array($data)) {
            $this->db->insert('menus_data', $data);
        }
    }

    /**
     *
     * @param integer $id
     * @return array
     */
    public function get_menu($id) {

        $this->db->where('id', $id);
        $query = $this->db->get('menus');

        return $query->row_array();
    }

    /**
     *
     * @param array $data
     * @return int
     */
    public function insert_menu($data) {

        if (is_array($data)) {
            $this->db->insert('menus', $data);
            return $this->db->insert_id();
        }
        return 0;
    }

    /**
     *
     * @param bool|int $item_id
     * @param bool|int $pos
     * @return bool
     */
    public function set_item_position($item_id = FALSE, $pos = FALSE) {

        if ($item_id != FALSE AND $pos != FALSE) {
            $this->db->where('id', $item_id);
            $this->db->update('menus_data', ['position' => $pos]);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     *
     * @param integer $id
     * @return false|array
     */
    public function get_item_position($id) {

        $this->db->select('position');
        $this->db->where('id', $id);
        $query = $this->db->get('menus_data', 1);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    /**
     * Return url to page
     * @param integer $page_id
     * @return false|array
     */
    public function get_page_url($page_id) {

        $this->db->select('route.url, route.parent_url as cat_url');
        $this->db->join('route', 'route.id = content.route_id');
        $this->db->where('content.id', $page_id);
        $query = $this->db->get('content', 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    /**
     * Return link to module
     * @param string $name
     * @return false|array
     */
    public function get_module_link($name) {

        $this->db->select('identif');
        $this->db->where('name', $name);
        $query = $this->db->get('components', 1);

        if ($query->num_rows() == 1) {
            $data = $query->row_array();
            return $data['identif'];
        } else {
            return FALSE;
        }
    }

}

/* End of Menu_model.php */