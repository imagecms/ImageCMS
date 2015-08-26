<?php

// DX_Auth class to work with users table
/**
 * @property CI_DB_active_record $db
 */
class Users extends CI_Model {

    public function __construct() {
        parent::__construct();

        // Other stuff
        $this->_prefix = $this->config->item('DX_table_prefix');
        $this->_table = $this->_prefix . $this->config->item('DX_users_table');
        $this->_roles_table = $this->_prefix . $this->config->item('DX_roles_table');
    }

    // General function

    public function get_all($offset = 0, $row_count = 0) {
        $users_table = $this->_table;
        $roles_table = $this->_roles_table;

        if ($offset >= 0 AND $row_count > 0) {
            $locale = MY_Controller::getCurrentLocale();
            $this->db->select("$users_table.*", FALSE);
            $this->db->select("$roles_table.name AS role_name", FALSE);
            $this->db->select("shop_rbac_roles_i18n.alt_name AS role_alt_name", FALSE);
            $this->db->join($roles_table, "$roles_table.id = $users_table.role_id", "left");
            $this->db->join("shop_rbac_roles_i18n", "shop_rbac_roles_i18n.id = shop_rbac_roles.id AND shop_rbac_roles_i18n.locale ='$locale'", "left");
            //$this->db->where('shop_rbac_roles_i18n.locale', MY_Controller::getCurrentLocale());
            $this->db->order_by("$users_table.id", "ASC");

            $query = $this->db->get($this->_table, $row_count, $offset);
        } else {
            $query = $this->db->get($this->_table);
        }

        return $query;
    }

    public function get_user_by_id($user_id) {
        $this->db->where('id', $user_id);
        return $this->db->get($this->_table);
    }

    public function get_user_by_username($username) {
        // 		$this->db->where('username', $username);
        // 		return $this->db->get($this->_table);
        return false;
    }

    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        return $this->db->get($this->_table);
    }

    public function get_login($login) {
        $this->db->where('email', $login);
        return $this->db->get($this->_table);
    }

    public function check_ban($user_id) {
        $this->db->select('1', FALSE);
        $this->db->where('id', $user_id);
        $this->db->where('banned', '1');
        return $this->db->get($this->_table);
    }

    public function check_username($username) {
        // 		$this->db->select('1', FALSE);
        // 		$this->db->where('LOWER(username)=', strtolower($username));
        // 		return $this->db->get($this->_table);
        return true;
    }

    public function check_email($email) {
        $this->db->select('1', FALSE);
        $this->db->where('LOWER(email)=', strtolower($email));
        return $this->db->get($this->_table);
    }

    public function ban_user($user_id, $reason = NULL) {
        $data = array(
            'banned' => 1,
            'ban_reason' => $reason
        );
        return $this->set_user($user_id, $data);
    }

    public function unban_user($user_id) {
        $data = array(
            'banned' => 0,
            'ban_reason' => NULL
        );
        return $this->set_user($user_id, $data);
    }

    public function set_role($user_id, $role_id) {
        $data = array(
            'role_id' => $role_id
        );
        return $this->set_user($user_id, $data);
    }

    // User table function

    public function create_user($data) {
        $data['created'] = date('U');
        return $this->db->insert($this->_table, $data);
    }

    public function get_user_field($user_id, $fields) {
        $this->db->select($fields);
        $this->db->where('id', $user_id);
        return $this->db->get($this->_table);
    }

    public function set_user($user_id, $data) {
        $this->db->where('id', $user_id);
        return $this->db->update($this->_table, $data);
    }

    public function delete_user($user_id) {
        $this->db->where('id', $user_id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows() > 0;
    }

    // Forgot password function

    public function newpass($user_id, $pass, $key) {
        $data = array(
            'newpass' => $pass,
            'newpass_key' => $key,
            'newpass_time' => date('Y-m-d h:i:s', time() + $this->config->item('DX_forgot_password_expire'))
        );
        return $this->set_user($user_id, $data);
    }

    public function activate_newpass($user_id, $key) {
        $this->db->set('password', 'newpass', FALSE);
        $this->db->set('newpass', NULL);
        $this->db->set('newpass_key', NULL);
        $this->db->set('newpass_time', NULL);
        $this->db->where('id', $user_id);
        $this->db->where('newpass_key', $key);

        return $this->db->update($this->_table);
    }

    public function clear_newpass($user_id) {
        $data = array(
            'newpass' => NULL,
            'newpass_key' => NULL,
            'newpass_time' => NULL
        );
        return $this->set_user($user_id, $data);
    }

    // Change password function

    public function change_password($user_id, $new_pass) {
        $this->db->set('password', $new_pass);
        $this->db->where('id', $user_id);
        return $this->db->update($this->_table);
    }

}

?>