<?php

class User_Profile extends CI_Model
{

    public function __construct() {
        parent::__construct();

        $this->_prefix = $this->config->item('DX_table_prefix');
        $this->_table = $this->_prefix . $this->config->item('DX_user_profile_table');
    }

    public function create_profile($user_id) {
        // 		$this->db->set('user_id', $user_id);
        // 		return $this->db->insert($this->_table);

        return $user_id;
    }

    public function get_profile_field($fields) {
        $this->db->select($fields);
        return $this->db->get($this->_table);
    }

    public function get_profile($user_id) {
        $this->db->where('id', $user_id);
        return $this->db->get($this->_table);
    }

    public function set_profile($user_id, $data) {
        $this->db->where('id', $user_id);
        return $this->db->update($this->_table, $data);
    }

    public function delete_profile($user_id) {
        $this->db->where('id', $user_id);
        return $this->db->delete($this->_table);
    }

}