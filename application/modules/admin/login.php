<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Login class for administrator
 * Image CMS
 * login.php
 *
 */
class Login extends BaseAdminController
{

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        if ($this->dx_auth->is_admin() == TRUE) {
            redirect('/admin');
        }

        $this->load->library('lib_admin');
        $this->load->library('form_validation');

        $this->lib_admin->init_settings();
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
    }

    public function index() {
        if ($this->dx_auth->is_max_login_attempts_exceeded()) {

            $this->dx_auth->captcha();
            $this->template->assign('use_captcha', '1');
            $this->template->assign('cap_image', $this->dx_auth->get_captcha_image());
        }

        $this->load->library('user_agent');

        if (($this->agent->browser() === 'Firefox' && $this->agent->version() < 16.0) || $this->agent->browser() === 'IE' || ($this->agent->browser() === 'Chrome' && $this->agent->version() < 17) || ($this->agent->browser() === 'Opera' && $this->agent->version() < 12.11)) {
            $this->template->display('old_browser');
        } else {
            $this->do_login();
        }
    }

    /**
     * Login
     *
     * @access public
     */
    public function do_login() {

        $this->form_validation->set_rules('login', lang('E-mail', 'admin'), 'trim|required|min_length[3]|max_length[50]|valid_email');
        $this->form_validation->set_rules('password', lang('Password', 'admin'), 'trim|required|min_length[5]|max_length[32]');

        if ($this->input->post('remember')) {
            $remember = true;
        } else {
            $remember = false;
        }

        if ($this->dx_auth->is_max_login_attempts_exceeded()) {
            $this->form_validation->set_rules('captcha', lang('Protection code', 'admin'), 'trim|required|xss_clean|callback_captcha_check');
        }

        if ($this->form_validation->run($this) == FALSE) {
            $err_object = &_get_validation_object();

            foreach ($this->input->post() as $k => $v) {
                $err_text = $err_object->error($k);
                $this->template->assign($k . '_error', $err_text);
            }
        } else {
            $result = $this->dx_auth->login($this->input->post('login'), $this->input->post('password'), $remember);

            if ($result == TRUE) {

                if ($this->check_permissions($this->input->post('login'))) {
                    $this->lib_admin->log(lang('Entered the IP control panel', 'admin') . ' ' . $this->input->ip_address());
                    redirect('admin/admin/init');
                } else {
                    $this->template->assign('login_failed', lang('Not enough access rights', 'admin'));
                    $this->dx_auth->logout();
                }
            } else {
                $this->template->assign('login_failed', lang('Username and password have not been found', 'admin'));
            }
        }

        $this->template->display('login_page');
    }

    /**
     * Check has user access to admin panel
     * @param string $login
     * @return boolean
     */
    public function check_permissions($login) {
        $query = $this->db->where('email', $login)->get('users')->row_array();

        if ($query['role_id'] == null) {
            //            $this->form_validation->set_message('check_permissions', lang("Not enough access rights", "admin"));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function forgot_password() {
        $this->load->library('Form_validation');

        $val = $this->form_validation;

        // Set form validation rules
        $val->set_rules('login', lang('E-mail', 'admin'), 'trim|required|xss_clean');

        // Validate rules and call forgot password function
        if ($val->run() AND $this->dx_auth->forgot_password($this->input->post('login'))) {
            $this->template->assign('info_message', '<div class="alert alert-info">' . lang('Please check your email for instructions on how to activate the new password.', 'admin') . '</div>');
        }

        if ($this->dx_auth->_auth_error != NULL) {
            $this->template->assign('info_message', '<div class="alert alert-error">' . $this->dx_auth->_auth_error . '</div>');
        }

        $this->template->display('forgot_password');
    }

    public function update_captcha() {
        $this->dx_auth->captcha();
        echo $this->dx_auth->get_captcha_image();
    }

    // callbacks

    public function captcha_check($code) {
        $result = TRUE;

        if ($this->dx_auth->is_captcha_expired()) {
            $this->form_validation->set_message('captcha_check', lang('Wrong protection code', 'admin'));
            $result = FALSE;
            //            $result = TRUE;
        } elseif (!$this->dx_auth->is_captcha_match($code)) {
            $this->form_validation->set_message('captcha_check', lang('Wrong protection code', 'admin'));
            $result = FALSE;
            //            $result = TRUE;
        }

        return $result;
    }

    public function switch_admin_lang($lang) {
        $langs = [
            'english',
            'russian',
            'german'
        ];

        if (!$lang) {
            $lang = $this->input->get('language');
        }

        if (in_array($lang, $langs) && $this->config->item('language') != $lang) {
            $this->db->set('lang_sel', $lang . '_lang')
                ->update('settings');

            $this->session->set_userdata('language', $lang);
        }
        redirect($this->input->server('HTTP_REFERER') ? : '/admin/login');
    }

}

/* End of login.php */