<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * DX Auth Class
 *
 * Authentication library for Code Igniter.
 *
 * @author        Dexcell
 * @version        1.0.4
 * @based on    CL Auth by Jason Ashdown (http://http://www.jasonashdown.co.uk/)
 * @link            http://dexcell.shinsengumiteam.com/dx_auth
 * @license        MIT License Copyright (c) 2008 Erick Hartanto
 * @credits        http://dexcell.shinsengumiteam.com/dx_auth/general/credits.html
 */
class DX_Auth {

    // Private
    var $_banned;

    var $_ban_reason;

    var $_auth_error; // Contain user error when login

    var $_captcha_image;

    public function __construct() {
        $this->ci = &get_instance();

        log_message('debug', 'DX Auth Initialized');

        // Load required library
        //$this->ci->load->library('Session');
        //$this->ci->load->database();
        // Load DX Auth config
        $this->ci->load->config('auth');

        // Load DX Auth language
        //        $this->ci->lang->load('dx_auth');
        // Load DX Auth event
        $this->ci->load->library('DX_Auth_Event');

        // Initialize
        $this->_init();
    }

    /* Private function */

    public function _init() {
        // When we load this library, auto Login any returning users
        $this->autologin();

        // Init helper config variable
        $this->email_activation = $this->ci->config->item('DX_email_activation');

        $this->allow_registration = $this->ci->config->item('DX_allow_registration');
        $this->captcha_registration = $this->ci->config->item('DX_captcha_registration');

        $this->captcha_login = $this->ci->config->item('DX_captcha_login');

        //Use recaptcha
        $this->use_recaptcha = $this->ci->config->item('DX_use_recaptcha');
        $this->use_audio_recaptcha = $this->ci->config->item('DX_use_audio_recaptcha');

        // URIs
        $this->banned_uri = $this->ci->config->item('DX_banned_uri');
        $this->deny_uri = $this->ci->config->item('DX_deny_uri');
        $this->login_uri = $this->ci->config->item('DX_login_uri');
        $this->logout_uri = $this->ci->config->item('DX_logout_uri');
        $this->register_uri = $this->ci->config->item('DX_register_uri');
        $this->activate_uri = $this->ci->config->item('DX_activate_uri');
        $this->forgot_password_uri = $this->ci->config->item('DX_forgot_password_uri');
        $this->reset_password_uri = $this->ci->config->item('DX_reset_password_uri');
        $this->change_password_uri = $this->ci->config->item('DX_change_password_uri');
        $this->cancel_account_uri = $this->ci->config->item('DX_cancel_account_uri');

        // Forms view
        $this->login_view = $this->ci->config->item('DX_login_view');
        $this->register_view = $this->ci->config->item('DX_register_view');
        $this->forgot_password_view = $this->ci->config->item('DX_forgot_password_view');
        $this->change_password_view = $this->ci->config->item('DX_change_password_view');
        $this->cancel_account_view = $this->ci->config->item('DX_cancel_account_view');

        // Pages view
        $this->deny_view = $this->ci->config->item('DX_deny_view');
        $this->banned_view = $this->ci->config->item('DX_banned_view');
        $this->logged_in_view = $this->ci->config->item('DX_logged_in_view');
        $this->logout_view = $this->ci->config->item('DX_logout_view');

        $this->register_success_view = $this->ci->config->item('DX_register_success_view');
        $this->activate_success_view = $this->ci->config->item('DX_activate_success_view');
        $this->forgot_password_success_view = $this->ci->config->item('DX_forgot_password_success_view');
        $this->reset_password_success_view = $this->ci->config->item('DX_reset_password_success_view');
        $this->change_password_success_view = $this->ci->config->item('DX_change_password_success_view');

        $this->register_disabled_view = $this->ci->config->item('DX_register_disabled_view');
        $this->activate_failed_view = $this->ci->config->item('DX_activate_failed_view');
        $this->reset_password_failed_view = $this->ci->config->item('DX_reset_password_failed_view');
    }

    public function _gen_pass($len = 8) {
        // No Zero (for user clarity);
        $pool = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $str = '';
        for ($i = 0; $i < $len; $i++) {
            $str .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
        }

        return $str;
    }

    /*
     * Function: _encode
     * Modified for DX_Auth
     * Original Author: FreakAuth_light 1.1
     */

    public function _encode($password) {
        $majorsalt = '';

        // if you set your encryption key let's use it
        if ($this->ci->config->item('encryption_key') != '') {
            // concatenates the encryption key and the password
            $_password = $this->ci->config->item('encryption_key') . $password;
        } else {
            $_password = $password;
        }

        // if PHP5
        if (function_exists('str_split')) {
            $_pass = str_split($_password);
        } // if PHP4
        else {
            $_pass = array();
            if (is_string($_password)) {
                for ($i = 0; $i < strlen($_password); $i++) {
                    array_push($_pass, $_password[$i]);
                }
            }
        }

        // encrypts every single letter of the password
        foreach ($_pass as $_hashpass) {
            $majorsalt .= md5($_hashpass);
        }

        // encrypts the string combinations of every single encrypted letter
        // and finally returns the encrypted password
        return md5($majorsalt);
    }

    public function _array_in_array($needle, $haystack) {
        //Make sure $needle is an array for foreach
        if (!is_array($needle)) {
            $needle = array($needle);
        }

        //For each value in $needle, return TRUE if in $haystack
        foreach ($needle as $pin) {
            if (in_array($pin, $haystack)) {
                return TRUE;
            }
        }
        //Return FALSE if none of the values from $needle are found in $haystack
        return FALSE;
    }

    public function _email($to, $from, $subject, $message) {
        $this->ci->load->library('Email');
        $email = $this->ci->email;

        $email->from($from);
        $email->to($to);
        $email->subject($subject);
        $email->message($message);

        return $email->send();
    }

    // Set last ip and last login function when user login

    public function _set_last_ip_and_last_login($user_id) {
        $data = array();

        if ($this->ci->config->item('DX_login_record_ip')) {
            $data['last_ip'] = $this->ci->input->ip_address();
        }

        if ($this->ci->config->item('DX_login_record_time')) {
            $data['last_login'] = date('Y-m-d H:i:s', time());
        }

        if (!empty($data)) {
            // Load model
            $this->ci->load->model('dx_auth/users', 'users');
            // Update record
            $this->ci->users->set_user($user_id, $data);
        }
    }

    // Increase login attempt

    public function _increase_login_attempt() {
        if ($this->ci->config->item('DX_count_login_attempts') AND ! $this->is_max_login_attempts_exceeded()) {
            // Load model
            $this->ci->load->model('dx_auth/login_attempts', 'login_attempts');
            // Increase login attempts for current IP
            $this->ci->login_attempts->increase_attempt($this->ci->input->ip_address());
        }
    }

    // Clear login attempts

    public function _clear_login_attempts() {
        if ($this->ci->config->item('DX_count_login_attempts')) {
            // Load model
            $this->ci->load->model('dx_auth/login_attempts', 'login_attempts');
            // Clear login attempts for current IP
            $this->ci->login_attempts->clear_attempts($this->ci->input->ip_address());
        }
    }

    // Get role data from database by id, used in _set_session() function
    // $parent_roles_id, $parent_roles_name is an array.

    public function _get_role_data($role_id) {
        // Load models
        $this->ci->load->model('dx_auth/roles', 'roles');
        $this->ci->load->model('dx_auth/permissions', 'permissions');

        // Clear return value
        $role_name = '';
        $parent_roles_id = array();
        $parent_roles_name = array();
        $permission = array();
        $parent_permissions = array();

        /* Get role_name, parent_roles_id and parent_roles_name */

        // Get role query from role id
        $query = $this->ci->roles->get_role_by_id($role_id);

        // Check if role exist
        if ($query->num_rows() > 0) {
            // Get row
            $role = $query->row();

            // Get role name
            $role_name = $role->name;

            /*
              Code below will search if user role_id have parent_id > 0 (which mean role_id have parent role_id)
              and do it recursively until parent_id reach 0 (no parent) or parent_id not found.

              If anyone have better approach than this code, please let me know.
             */

            // Check if role has parent id

            if (isset($role->parent_id) && $role->parent_id > 0) {
                // Add to result array
                $parent_roles_id[] = $role->parent_id;

                // Set variable used in looping
                $finished = FALSE;
                $parent_id = $role->parent_id;

                // Get all parent id
                while ($finished == FALSE) {
                    $i_query = $this->ci->roles->get_role_by_id($parent_id);

                    // If role exist
                    if ($i_query->num_rows() > 0) {
                        // Get row
                        $i_role = $i_query->row();

                        // Check if role doesn't have parent
                        if ($i_role->parent_id == 0) {
                            // Get latest parent name
                            $parent_roles_name[] = $i_role->name;
                            // Stop looping
                            $finished = TRUE;
                        } else {
                            // Change parent id for next looping
                            $parent_id = $i_role->parent_id;

                            // Add to result array
                            $parent_roles_id[] = $parent_id;
                            $parent_roles_name[] = $i_role->name;
                        }
                    } else {
                        // Remove latest parent_roles_id since parent_id not found
                        array_pop($parent_roles_id);
                        // Stop looping
                        $finished = TRUE;
                    }
                }
            }
        }

        /* End of Get role_name, parent_roles_id and parent_roles_name */

        /* Get user and parents permission */

        // Get user role permission
        $permission = $this->ci->permissions->get_permission_data($role_id);

        // Get user role parent permissions
        if (!empty($parent_roles_id)) {
            $parent_permissions = $this->ci->permissions->get_permissions_data($parent_roles_id);
        }

        /* End of Get user and parents permission */
        if ($role_id) {
            $data['role_name'] = Permitions::checkControlPanelAccess($role_id);
        }

        // Set return value
        //$data['role_name'] = $role_name;
        $data['parent_roles_id'] = $parent_roles_id;
        $data['parent_roles_name'] = $parent_roles_name;
        $data['permission'] = $permission;
        $data['parent_permissions'] = $parent_permissions;

        return $data;
    }

    /* Autologin related function */

    public function _create_autologin($user_id) {
        $result = FALSE;

        // User wants to be remembered
        $user = array(
            'key_id' => substr(md5(uniqid(rand() . $this->ci->input->cookie($this->ci->config->item('sess_cookie_name')))), 0, 16),
            'user_id' => $user_id
        );

        // Load Models
        $this->ci->load->model('dx_auth/user_autologin', 'user_autologin');

        // Prune keys
        $this->ci->user_autologin->prune_keys($user['user_id']);

        if ($this->ci->user_autologin->store_key($user['key_id'], $user['user_id'])) {
            // Set Users AutoLogin cookie
            $this->_auto_cookie($user);

            $result = TRUE;
        }

        return $result;
    }

    public function autologin() {
        $result = FALSE;

        //if ($auto = $this->ci->input->cookie($this->ci->config->item('DX_autologin_cookie_name')) AND ! $this->ci->session->userdata('DX_logged_in'))
        if ($auto = $this->ci->input->cookie($this->ci->config->item('DX_autologin_cookie_name'))) {
            // Extract data
            $auto = unserialize($auto);

            if (isset($auto['key_id']) AND $auto['key_id'] AND $auto['user_id']) {
                // Load Models
                $this->ci->load->model('dx_auth/user_autologin', 'user_autologin');

                // Get key
                $query = $this->ci->user_autologin->get_key($auto['key_id'], $auto['user_id']);

                if ($result = $query->row()) {
                    // User verified, log them in
                    $this->_set_session($result);
                    // Renew users cookie to prevent it from expiring
                    $this->_auto_cookie($auto);

                    // Set last ip and last login
                    $this->_set_last_ip_and_last_login($auto['user_id']);

                    $result = TRUE;
                }
            }
        }

        return $result;
    }

    public function _delete_autologin() {
        if ($auto = $this->ci->input->cookie($this->ci->config->item('DX_autologin_cookie_name'))) {
            // Load Cookie Helper
            $this->ci->load->helper('cookie');

            // Load Models
            $this->ci->load->model('dx_auth/user_autologin', 'user_autologin');

            // Extract data
            $auto = unserialize($auto);

            // Delete db entry
            $this->ci->user_autologin->delete_key($auto['key_id'], $auto['user_id']);

            // Make cookie expired
            set_cookie($this->ci->config->item('DX_autologin_cookie_name'), '', -1);
        }
    }

    public function _set_session($data) {
        // Get role data
        $role_data = $this->_get_role_data($data->role_id);

        // Set session data array
        $user = array(
            'DX_user_id' => $data->id,
            'DX_username' => $data->username,
            'DX_role_id' => $data->role_id,
            'DX_role_name' => $role_data['role_name'],
            'DX_parent_roles_id' => $role_data['parent_roles_id'], // Array of parent role_id
            'DX_parent_roles_name' => $role_data['parent_roles_name'], // Array of parent role_name
            'DX_permission' => $role_data['permission'],
            'DX_parent_permissions' => $role_data['parent_permissions'],
            'DX_logged_in' => TRUE
        );

        $this->ci->session->set_userdata($user);
    }

    public function _auto_cookie($data) {
        // Load Cookie Helper
        $this->ci->load->helper('cookie');

        $cookie = array(
            'name' => $this->ci->config->item('DX_autologin_cookie_name'),
            'value' => serialize($data),
            'expire' => $this->ci->config->item('DX_autologin_cookie_life')
        );

        set_cookie($cookie);
    }

    /* End of Auto login related function */

    /* Helper function */

    public function check_uri_permissions() {
        // First check if user already logged in or not
        if ($this->is_logged_in()) {
            // If user is not admin
            if (!$this->is_admin()) {
                // Get variable from current URI
                $controller = '/' . $this->ci->uri->rsegment(1) . '/';
                if ($this->ci->uri->rsegment(2) != '') {
                    $action = $controller . $this->ci->uri->rsegment(2) . '/';
                } else {
                    $action = $controller . 'index/';
                }

                // Get URI permissions from role and all parents
                // Note: URI permissions is saved in 'uri' key
                $roles_allowed_uris = $this->get_permissions_value('uri');

                // Variable to determine if URI found
                $found = FALSE;
                // Loop each roles URI permissions
                foreach ($roles_allowed_uris as $allowed_uris) {
                    // Check if user allowed to access URI
                    if ($this->_array_in_array(array('/', $controller, $action), $allowed_uris)) {
                        $found = TRUE;
                        // Stop loop
                        break;
                    }
                }

                // Trigger event
                $this->ci->dx_auth_event->checked_uri_permissions($this->get_user_id(), $found);

                if (!$found) {
                    // User didn't have previlege to access current URI, so we show user 403 forbidden access
                    $this->deny_access();
                }
            }
        } else {
            // User haven't logged in, so just redirect user to login page
            $this->deny_access('login');
        }
    }

    /*
      Obsolete in 1.0.2 and above, do not use this function.
      Use check_uri_permisisons() instead

      public function check_role_uri()
      {
      }
     */

    /*
      Get permission value from specified key.
      Call this function only when user is logged in already.
      $key is permission array key (Note: permissions is saved as array in table).
      If $check_parent is TRUE means if permission value not found in user role, it will try to get permission value from parent role.
      Returning value if permission found, otherwise returning NULL
     */

    public function get_permission_value($key, $check_parent = TRUE) {
        // Default return value
        $result = NULL;

        // Get current user permission
        $permission = $this->ci->session->userdata('DX_permission');

        // Check if key is in user permission array
        if (array_key_exists($key, $permission)) {
            $result = $permission[$key];
        } // Key not found
        else {
            if ($check_parent) {
                // Get current user parent permissions
                $parent_permissions = $this->ci->session->userdata('DX_parent_permissions');

                // Check parent permissions array
                foreach ($parent_permissions as $permission) {
                    if (array_key_exists($key, $permission)) {
                        $result = $permission[$key];
                        break;
                    }
                }
            }
        }

        // Trigger event
        $this->ci->dx_auth_event->got_permission_value($this->get_user_id(), $key);

        return $result;
    }

    /*
      Get permissions value from specified key.
      Call this function only when user is logged in already.
      This will get user permission, and it's parents permissions.

      $array_key = 'default'. Array ordered using 0, 1, 2 as array key.
      $array_key = 'role_id'. Array ordered using role_id as array key.
      $array_key = 'role_name'. Array ordered using role_name as array key.

      Returning array of value if permission found, otherwise returning NULL.
     */

    public function get_permissions_value($key, $array_key = 'default') {
        $result = array();

        $role_id = $this->ci->session->userdata('DX_role_id');
        $role_name = $this->ci->session->userdata('DX_role_name');

        $parent_roles_id = $this->ci->session->userdata('DX_parent_roles_id');
        $parent_roles_name = $this->ci->session->userdata('DX_parent_roles_name');

        // Get current user permission
        $value = $this->get_permission_value($key, FALSE);

        if ($array_key == 'role_id') {
            $result[$role_id] = $value;
        } elseif ($array_key == 'role_name') {
            $result[$role_name] = $value;
        } else {
            array_push($result, $value);
        }

        // Get current user parent permissions
        $parent_permissions = $this->ci->session->userdata('DX_parent_permissions');

        $i = 0;
        foreach ($parent_permissions as $permission) {
            if (array_key_exists($key, $permission)) {
                $value = $permission[$key];
            }

            if ($array_key == 'role_id') {
                // It's safe to use $parents_roles_id[$i] because array order is same with permission array
                $result[$parent_roles_id[$i]] = $value;
            } elseif ($array_key == 'role_name') {
                // It's safe to use $parents_roles_name[$i] because array order is same with permission array
                $result[$parent_roles_name[$i]] = $value;
            } else {
                array_push($result, $value);
            }

            $i++;
        }

        // Trigger event
        $this->ci->dx_auth_event->got_permissions_value($this->get_user_id(), $key);

        return $result;
    }

    public function deny_access($uri = 'deny') {
        $this->ci->load->helper('url');

        if ($uri == 'login') {
            redirect($this->ci->config->item('DX_login_uri'), 'location');
        } else if ($uri == 'banned') {
            redirect($this->ci->config->item('DX_banned_uri'), 'location');
        } else {
            redirect($this->ci->config->item('DX_deny_uri'), 'location');
        }
        exit;
    }

    // Get user id

    public function get_user_id() {
        return $this->ci->session->userdata('DX_user_id');
    }

    // Get username string

    public function get_username() {
        return $this->ci->session->userdata('DX_username');
    }

    // Get useremail string

    public function get_user_email() {
        $user = $this->ci->db
            ->where('id', $this->get_user_id())
            ->get('users');
        if ($user) {
            $user = $user->row_array();
            return $user['email'];
        } else {
            return '';
        }
    }

    // Get user role id

    public function get_role_id() {
        return $this->ci->session->userdata('DX_role_id');
    }

    // Get user role name

    public function get_role_name() {
        return $this->ci->session->userdata('DX_role_name');
    }

    // Check is user is has admin privilege

    public function is_admin() {
        if (php_sapi_name() == 'cli') {
            return true;
        }
        return strtolower($this->ci->session->userdata('DX_role_name')) == 'admin';
    }

    // Check if user has $roles privilege
    // If $use_role_name TRUE then $roles is name such as 'admin', 'editor', 'etc'
    // else $roles is role_id such as 0, 1, 2
    // If $check_parent is TRUE means if roles not found in user role, it will check if user role parent has that roles

    public function is_role($roles = array(), $use_role_name = TRUE, $check_parent = TRUE) {
        // Default return value
        $result = FALSE;

        // Build checking array
        $check_array = array();

        if ($check_parent) {
            // Add parent roles into check array
            if ($use_role_name) {
                $check_array = $this->ci->session->userdata('DX_parent_roles_name');
            } else {
                $check_array = $this->ci->session->userdata('DX_parent_roles_id');
            }
        }

        // Add current role into check array
        if ($use_role_name) {
            array_push($check_array, $this->ci->session->userdata('DX_role_name'));
        } else {
            array_push($check_array, $this->ci->session->userdata('DX_role_id'));
        }

        // If $roles not array then we add it into an array
        if (!is_array($roles)) {
            $roles = array($roles);
        }

        if ($use_role_name) {
            // Convert check array into lowercase since we want case insensitive checking
            for ($i = 0; $i < count($check_array); $i++) {
                $check_array[$i] = strtolower($check_array[$i]);
            }

            // Convert roles into lowercase since we want insensitive checking
            for ($i = 0; $i < count($roles); $i++) {
                $roles[$i] = strtolower($roles[$i]);
            }
        }

        // Check if roles exist in check_array
        if ($this->_array_in_array($roles, $check_array)) {
            $result = TRUE;
        }

        return $result;
    }

    // Check if user is logged in

    public function is_logged_in() {
        return $this->ci->session->userdata('DX_logged_in');
    }

    // Check if user is a banned user, call this only after calling login() and returning FALSE

    public function is_banned() {
        return $this->_banned;
    }

    // Get ban reason, call this only after calling login() and returning FALSE

    public function get_ban_reason() {
        return $this->_ban_reason;
    }

    // Check if username is available to use, by making sure there is no same username in the database

    public function is_username_available($username) {
        // Load Models
        $this->ci->load->model('dx_auth/users', 'users');
        $this->ci->load->model('dx_auth/user_temp', 'user_temp');

        $users = $this->ci->users->check_username($username);
        $temp = $this->ci->user_temp->check_username($username);

        return $users->num_rows() + $temp->num_rows() == 0;
    }

    // Check if email is available to use, by making sure there is no same email in the database

    public function is_email_available($email) {
        // Load Models
        $this->ci->load->model('dx_auth/users', 'users');
        $this->ci->load->model('dx_auth/user_temp', 'user_temp');

        $users = $this->ci->users->check_email($email);
        $temp = $this->ci->user_temp->check_email($email);

        return $users->num_rows() + $temp->num_rows() == 0;
    }

    // Check if login attempts bigger than max login attempts specified in config

    public function is_max_login_attempts_exceeded() {
        $this->ci->load->model('dx_auth/login_attempts', 'login_attempts');

        return ($this->ci->login_attempts->check_attempts($this->ci->input->ip_address())->num_rows() >= $this->ci->config->item('DX_max_login_attempts'));
    }

    public function get_auth_error() {
        return $this->_auth_error;
    }

    /* End of Helper function */

    /* Main function */

    // $login is username or email or both depending on setting in config file

    public function login($login, $password, $remember = TRUE) {
        // Load Models
        $this->ci->load->model('dx_auth/users', 'users');
        $this->ci->load->model('dx_auth/user_temp', 'user_temp');
        $this->ci->load->model('dx_auth/login_attempts', 'login_attempts');

        // Default return value
        $result = FALSE;

        if (!empty($login) AND ! empty($password)) {
            // Get which function to use based on config
            if ($this->ci->config->item('DX_login_using_username') AND $this->ci->config->item('DX_login_using_email')) {
                $get_user_function = 'get_login';
            } else if ($this->ci->config->item('DX_login_using_email')) {
                $get_user_function = 'get_user_by_email';
            } else {
                $get_user_function = 'get_user_by_username';
            }

            // Get user query
            if ($query = $this->ci->users->$get_user_function($login) AND $query->num_rows() == 1) {
                // Get user record
                $row = $query->row();

                // Check if user is banned or not
                if ($row->banned > 0) {
                    // Set user as banned
                    $this->_banned = TRUE;
                    // Set ban reason
                    $this->_ban_reason = $row->ban_reason;
                } else {
                    // If it's not a banned user then try to login
                    $password = $this->_encode($password);
                    $stored_hash = $row->password;

                    // Is password matched with hash in database ?
                    if (crypt($password, $stored_hash) === $stored_hash) {
                        // Log in user
                        $this->_set_session($row);

                        if ($row->newpass) {
                            // Clear any Reset Passwords
                            $this->ci->users->clear_newpass($row->id);
                        }

                        if ($remember) {
                            // Create auto login if user want to be remembered
                            $this->_create_autologin($row->id);
                        }

                        // Set last ip and last login
                        $this->_set_last_ip_and_last_login($row->id);
                        // Clear login attempts
                        $this->_clear_login_attempts();

                        // Trigger event
                        $this->ci->dx_auth_event->user_logged_in($row->id);

                        // Set return value
                        $result = TRUE;
                    } else {
                        // Increase login attempts
                        $this->_increase_login_attempt();
                        // Set error message
                        $this->_auth_error = lang('auth login incorrect password');
                    }
                }
            } elseif ($query = $this->ci->user_temp->$get_user_function($login) AND $query->num_rows() == 1) {
                // Check if login is still not activated
                // Set error message
                $this->_auth_error = lang('auth not activated');
            } else {
                // Increase login attempts
                $this->_increase_login_attempt();
                // Set error message
                $this->_auth_error = lang('auth login username not exist');
            }
        }

        return $result;
    }

    public function logout() {
        // Trigger event
        $this->ci->dx_auth_event->user_logging_out($this->ci->session->userdata('DX_user_id'));

        // Delete auto login
        if ($this->ci->input->cookie($this->ci->config->item('DX_autologin_cookie_name'))) {
            $this->_delete_autologin();
        }

        // Destroy session
        $this->ci->session->sess_destroy();
    }

    public function register($username, $password, $email, $address = '', $key, $phone = '', $login_user = TRUE) {

        // Load Models
        $this->ci->load->model('dx_auth/users', 'users');
        $this->ci->load->model('dx_auth/user_temp', 'user_temp');
        $this->ci->load->helper('url');

        // Default return value
        $result = FALSE;

        $new_user = array(
            'username' => $username,
            'password' => crypt($this->_encode($password)),
            'address' => $address,
            'email' => $email,
            'key' => $key,
            'phone' => $phone,
            'last_ip' => $this->ci->input->ip_address()
        );

        // Do we need to send email to activate user

        if ($this->ci->config->item('DX_email_activation')) {
            // Add activation key to user array
            $new_user['activation_key'] = md5(rand() . microtime());

            // Create temporary user in database which means the user still unactivated.
            $insert = $this->ci->user_temp->create_temp($new_user);

            $from = $this->ci->config->item('DX_webmaster_email');
            $subject = sprintf(lang('auth activate subject'), $this->ci->config->item('DX_website_name'));

            // Activation Link
            $new_user['activate_url'] = site_url($this->ci->config->item('DX_activate_uri') . "{$new_user['email']}/{$new_user['activation_key']}");
            // Trigger event and get email content
            $this->ci->dx_auth_event->sending_activation_email($new_user, $message);

            // Send email with activation link
            //            $this->_email($email, $from, $subject, $message);
        } else {
            // Create user
            $insert = $this->ci->users->create_user($new_user);
            $last_user_id = $this->ci->db->insert_id();
            // Trigger event
            $this->ci->dx_auth_event->user_activated($last_user_id);
        }

        if ($insert) {

            // Replace password with plain for email
            $new_user['password'] = $password;
            $new_user['id_user'] = $last_user_id;

            $result = $new_user;

            // Send email based on config
            // Check if user need to activate it's account using email
            if ($this->ci->config->item('DX_email_activation')) {
                // Create email
                $from = $this->ci->config->item('DX_webmaster_email');
                $subject = sprintf(lang('auth activate subject'), $this->ci->config->item('DX_website_name'));

                // Activation Link
                $new_user['activate_url'] = site_url();

                // Trigger event and get email content
                $this->ci->dx_auth_event->sending_account_email($new_user, $message);

                // Send email with activation link
                //                $this->_email($email, $from, $subject, $message);
            } else {
                // Check if need to email account details
                if ($this->ci->config->item('DX_email_account_details')) {
                    // Create email
                    $from = $this->ci->config->item('DX_webmaster_email');
                    $subject = sprintf(lang('auth account subject'), $this->ci->config->item('DX_website_name'));

                    // Trigger event and get email content
                    $this->ci->dx_auth_event->sending_account_email($new_user, $message);

                    // Send email with account details
                    //                    $this->_email($email, $from, $subject, $message);
                }

                $user_variables = array(
                    'user_name' => $username,
                    'user_password' => $password,
                    'user_address' => $address,
                    'user_email' => $email,
                    'user_phone' => $phone
                );

                \cmsemail\email::getInstance()->sendEmail($email, 'create_user', $user_variables);

                if ($login_user) {
                    if ($this->login($email, $password)) {
                        if (class_exists('ShopCore')) {
                            ShopCore::app()->SCart->transferCartData();
                        }
                        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
                            redirect('', 'location');
                        }
                        //                    if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
                    }
                }
            }
        }

        return $result;
    }

    public function forgot_password($login) {
        // Default return value
        $result = FALSE;

        if ($login) {
            // Load Model
            $this->ci->load->model('dx_auth/users', 'users');
            // Load Helper
            $this->ci->load->helper('url');

            // Get login and check if it's exist
            if ($query = $this->ci->users->get_login($login) AND $query->num_rows() == 1) {
                // Get User data
                $row = $query->row();

                // Check if there is already new password created but waiting to be activated for this login
                if (strtotime($row->newpass_time) < time()) {
                    // Appearantly there is no password created yet for this login, so we create new password
                    $data['password'] = $this->_gen_pass();

                    // Encode & Crypt password
                    $encode = crypt($this->_encode($data['password']));

                    // Create key
                    $data['key'] = md5(rand() . microtime());

                    // Create new password (but it haven't activated yet)
                    $this->ci->users->newpass($row->id, $encode, $data['key']);

                    // Create reset password link to be included in email
                    $data['reset_password_uri'] = site_url($this->ci->config->item('DX_reset_password_uri') . "{$row->email}/{$data['key']}");

                    // Trigger event and get email content
                    // $this->ci->dx_auth_event->sending_forgot_password_email($data, $message);

                    $settings = $this->ci->cms_base->get_settings();
                    $replaceData = array(
                        'webSiteName' => $settings['site_title'] ? $settings['site_title'] : $this->ci->config->item('DX_website_name'),
                        'resetPasswordUri' => $data['reset_password_uri'],
                        'password' => $data['password'],
                        'key' => $data['key'],
                        'webMasterEmail' => $this->ci->config->item('DX_webmaster_email')
                    );

                    \cmsemail\email::getInstance()->sendEmail($row->email, 'forgot_password', $replaceData);

                    // Send instruction email
                    //$this->_email($row->email, $from, $subject, $message);

                    $result = TRUE;
                } else {
                    // There is already new password waiting to be activated
                    $this->_auth_error = lang('auth request sent');
                }
            } else {
                $this->_auth_error = lang('auth username or email not exist');
            }
        }
        return $result;
    }

    public function reset_password($email, $key = '') {
        // Load Models
        $this->ci->load->model('dx_auth/users', 'users');
        $this->ci->load->model('dx_auth/user_autologin', 'user_autologin');

        // Default return value
        $result = FALSE;

        // Default user_id set to none
        $user_id = 0;

        // Get user id
        if ($query = $this->ci->users->get_user_by_email($email) AND $query->num_rows() == 1) {
            $user_id = $query->row()->id;

            // Try to activate new password
            if (!empty($email) AND ! empty($key) AND $this->ci->users->activate_newpass($user_id, $key) AND $this->ci->db->affected_rows() > 0) {
                // Clear previously setup new password and keys
                $this->ci->user_autologin->clear_keys($user_id);

                $result = TRUE;
            }
        }
        return $result;
    }

    public function activate($email, $key = '') {
        // Load Models
        $this->ci->load->model('dx_auth/users', 'users');
        $this->ci->load->model('dx_auth/user_temp', 'user_temp');

        // Default return value
        $result = FALSE;

        if ($this->ci->config->item('DX_email_activation')) {
            // Delete user whose account expired (not activated until expired time)
            $this->ci->user_temp->prune_temp();
        }

        // Activate user
        if ($query = $this->ci->user_temp->activate_user($email, $key) AND $query->num_rows() > 0) {
            // Get user
            $row = $query->row_array();

            $del = $row['id'];

            // Unset any unwanted fields
            unset($row['id']); // We don't want to copy the id across
            unset($row['activation_key']);

            // Create user
            if ($this->ci->users->create_user($row)) {
                // Trigger event
                $this->ci->dx_auth_event->user_activated($this->ci->db->insert_id());

                // Delete user from temp
                $this->ci->user_temp->delete_user($del);

                $result = TRUE;
            }
        }

        return $result;
    }

    public function change_password($old_pass, $new_pass) {
        // Load Models
        $this->ci->load->model('dx_auth/users', 'users');

        // Default return value
        $result = FAlSE;

        // Search current logged in user in database
        if ($query = $this->ci->users->get_user_by_id($this->ci->session->userdata('DX_user_id')) AND $query->num_rows() > 0) {
            // Get current logged in user
            $row = $query->row();
            $pass = $this->_encode($old_pass);

            // Check if old password correct
            if (crypt($pass, $row->password) === $row->password) {
                // Crypt and encode new password
                $new_pass_for_user = $new_pass;
                $new_pass = crypt($this->_encode($new_pass));

                // Replace old password with new password
                $this->ci->users->change_password($this->ci->session->userdata('DX_user_id'), $new_pass);

                // Trigger event
                $this->ci->dx_auth_event->user_changed_password($this->ci->session->userdata('DX_user_id'), $new_pass);

                $replaceData = array(
                    'user_name' => $row->username,
                    'password' => $new_pass_for_user
                );

                \cmsemail\email::getInstance()->sendEmail($row->email, 'change_password', $replaceData);

                $result = TRUE;
            } else {
                $this->_auth_error = lang('auth incorrect old password');
            }
        }

        return $result;
    }

    public function cancel_account($password) {
        // Load Models
        $this->ci->load->model('dx_auth/users', 'users');

        // Default return value
        $result = FAlSE;

        // Search current logged in user in database
        if ($query = $this->ci->users->get_user_by_id($this->ci->session->userdata('DX_user_id')) AND $query->num_rows() > 0) {
            // Get current logged in user
            $row = $query->row();

            $pass = $this->_encode($password);

            // Check if password correct
            if (crypt($pass, $row->password) === $row->password) {
                // Trigger event
                $this->ci->dx_auth_event->user_canceling_account($this->ci->session->userdata('DX_user_id'));

                // Delete user
                $result = $this->ci->users->delete_user($this->ci->session->userdata('DX_user_id'));

                // Force logout
                $this->logout();
            } else {
                $this->_auth_error = lang('auth incorrect password');
            }
        }

        return $result;
    }

    /* End of main function */

    /* Captcha related function */

    public function captcha() {
        $this->ci->load->helper('dx_captcha');
        // Load library SESSION

        $vals = array(
            'img_path' => $this->ci->config->item('DX_captcha_path'),
            'img_url' => media_url() . 'captcha/',
            'font_path' => $this->ci->config->item('DX_captcha_fonts_path'),
            'font_size' => $this->ci->config->item('DX_captcha_font_size'),
            'img_width' => $this->ci->config->item('DX_captcha_width'),
            'img_height' => $this->ci->config->item('DX_captcha_height'),
            'show_grid' => $this->ci->config->item('DX_captcha_grid'),
            'expiration' => $this->ci->config->item('DX_captcha_expire')
        );

        $cap = create_captcha($vals);

        $store = array(
            'captcha_word' => $cap['word'],
            'captcha_time' => $cap['time']
        );

        // Plain, simple but effective
        $this->ci->session->set_flashdata($store);

        // Set our captcha
        $this->_captcha_image = $cap['image'];
    }

    public function get_captcha_image() {
        if ($this->use_recaptcha) {
            return $this->_get_recaptcha_data();
        } else {
            return $this->_captcha_image;
        }
    }

    // Check if captcha already expired
    // Use this in callback function in your form validation

    public function is_captcha_expired() {
        // Captcha Expired
        list($usec, $sec) = explode(" ", microtime());
        $now = ((float) $usec + (float) $sec);

        // Check if captcha already expired

        return (($this->ci->session->flashdata('captcha_time') + $this->ci->config->item('DX_captcha_expire')) < $now);
    }

    // Check is captcha match with code
    // Use this in callback function in your form validation

    public function is_captcha_match($code) {
        // Just check if code is the same value with flash data captcha_word which created in captcha() function
        if ($this->ci->config->item('DX_captcha_case_sensetive')) {
            return ($code == $this->ci->session->flashdata('captcha_word'));
        } else {
            return (strtolower($code) == strtolower($this->ci->session->flashdata('captcha_word')));
        }
    }

    /* End of captcha related function */

    public function captcha_check($code) {
        $CI = get_instance();
        $result = TRUE;

        if ($this->use_recaptcha) {
            $result = $this->is_recaptcha_match();
            if (!$result) {
                $CI->form_validation->set_message('captcha_check', lang("Improper protection code"));
            }
        } else {
            if ($this->is_captcha_expired()) {
                // Will replace this error msg with $lang
                $CI->form_validation->set_message('captcha_check', lang("Improper protection code"));
                $result = FALSE;
            } elseif (!$this->is_captcha_match($code)) {
                $CI->form_validation->set_message('captcha_check', lang("Improper protection code"));
                $result = FALSE;
            }
        }
        return $result;
    }

    /* Recaptcha function */

    public function get_recaptcha_reload_link($text = 'Get another CAPTCHA') {
        return '<a href="javascript:Recaptcha.reload()">' . $text . '</a>';
    }

    public function get_recaptcha_switch_image_audio_link($switch_image_text = 'Get an image CAPTCHA', $switch_audio_text = 'Get an audio CAPTCHA') {
        return '<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type(\'audio\')">' . $switch_audio_text . '</a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type(\'image\')">' . $switch_image_text . '</a></div>';
    }

    public function get_recaptcha_label($image_text = 'Enter the words above', $audio_text = 'Enter the numbers you hear') {
        return '<span class="recaptcha_only_if_image">' . $image_text . '</span>
			<span class="recaptcha_only_if_audio">' . $audio_text . '</span>';
    }

    // Get captcha image

    public function get_recaptcha_image() {
        return '<div id="recaptcha_image"></div>';
    }

    // Get captcha input box
    // IMPORTANT: You should at least use this function when showing captcha even for testing, otherwise reCAPTCHA image won't show up
    // because reCAPTCHA javascript will try to find input type with id="recaptcha_response_field" and name="recaptcha_response_field"

    public function get_recaptcha_input() {
        return '<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />';
    }

    // Get recaptcha javascript and non javasript html
    // IMPORTANT: you should put call this function the last, after you are using some of get_recaptcha_xxx function above.

    public function get_recaptcha_html() {
        // Load reCAPTCHA helper function
        $this->ci->load->helper('recaptcha');

        // Add custom theme so we can get only image
        $options = "<script>
			var RecaptchaOptions = {
				 theme: 'clean',
				 custom_theme_widget: 'recaptcha_widget'
			};
			</script>";

        // Get reCAPTCHA javascript and non javascript HTML
        $html = recaptcha_get_html($this->ci->config->item('DX_recaptcha_public_key'));

        return $options . $html;
    }

    // Check if entered captcha code match with the image.
    // Use this in callback function in your form validation

    public function is_recaptcha_match() {
        $this->ci->load->helper('recaptcha');

        $resp = recaptcha_check_answer($this->ci->config->item('DX_recaptcha_private_key'), $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

        return $resp->is_valid;
    }

    private function _get_recaptcha_data() {
        return $this->get_recaptcha_html();
    }

    /* End of Recaptcha function */
}

?>