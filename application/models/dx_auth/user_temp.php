<?php

class User_Temp extends CI_Model
{

    public function __construct() {
        parent::__construct();

        // Other stuff
        $this->_prefix = $this->config->item('DX_table_prefix');
        $this->_table = $this->_prefix . $this->config->item('DX_user_temp_table');
    }

    public function get_all($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->_table, $row_count, $offset);
        } else {
            $query = $this->db->get($this->_table);
        }

        return $query;
    }

    public function get_user_by_username($email) {
        $this->db->where('email', $email);
        return $this->db->get($this->_table);
    }

    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        return $this->db->get($this->_table);
    }

    public function get_login($email) {
        $this->db->where('email', $email);
        $this->db->or_where('email', email);
        return $this->db->get($this->_table);
    }

    public function check_username($email) {
        $this->db->select('1', FALSE);
        $this->db->where('email', $email);
        return $this->db->get($this->_table);
    }

    public function check_email($email) {
        $this->db->select('1', FALSE);
        $this->db->where('email', $email);
        return $this->db->get($this->_table);
    }

    public function activate_user($email, $key) {
        $this->db->where(['email' => $email, 'activation_key' => $key]);
        return $this->db->get($this->_table);
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

    public function prune_temp() {
        $this->db->where('UNIX_TIMESTAMP(created) <', time() - $this->config->item('DX_email_activation_expire'));
        return $this->db->delete($this->_table);
    }

    public function create_temp($data) {
        $data['created'] = date('Y-m-d H:i:s', time());
        return $this->db->insert($this->_table, $data);
    }

}