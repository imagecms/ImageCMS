<?php

class User_Profile extends CI_Model {

    function User_Profile() {
        parent::__construct();

        $this->_prefix = $this->config->item('DX_table_prefix');
        $this->_table = $this->_prefix . $this->config->item('DX_user_profile_table');
    }

    function create_profile($user_id) {
// 		$this->db->set('user_id', $user_id);
// 		return $this->db->insert($this->_table);

        return $user_id;
    }

    function get_profile_field($fields) {
        $this->db->select($fields);
        return $this->db->get($this->_table);
    }

    function get_profile($user_id) {
        $this->db->where('id', $user_id);
        return $this->db->get($this->_table);
    }

    function set_profile($user_id, $data) {
        $this->db->where('id', $user_id);
        return $this->db->update($this->_table, $data);
    }

    function delete_profile($user_id) {
        $this->db->where('id', $user_id);
        return $this->db->delete($this->_table);
    }

}

?>