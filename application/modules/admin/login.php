<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Login class for administrator
 * Image CMS
 * login.php
 *
 */
class Login extends BaseAdminController {

    function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        if ($this->dx_auth->is_admin() == TRUE)
            redirect('/admin');

        $this->load->library(array('lib_admin', 'form_validation'));
        $this->lib_admin->init_settings();
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
    }

    function index() {
//        var_dumps($this->session->all_userdata());
        if ($this->dx_auth->is_max_login_attempts_exceeded()) {

            $this->dx_auth->captcha();
            $this->template->assign('use_captcha', '1');
            $this->template->assign('cap_image', $this->dx_auth->get_captcha_image());
        }
        $browser = $this->user_browser($_SERVER['HTTP_USER_AGENT']);

        if (($browser[0] === 'Firefox' && $browser[1] < 16.0) || $browser[0] === 'IE' || ($browser[0] === 'Chrome' && $browser[1] < 17 ) || ($browser[0] === 'Opera' && $browser[1] < 12.11)) {
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
    function do_login() {

        $this->form_validation->set_rules('login', lang("E-mail"), 'trim|required|min_length[3]|max_length[50]|valid_email');
        $this->form_validation->set_rules('password', lang("Password", "admin"), 'trim|required|min_length[5]|max_length[32]');

        if ($_POST['remember'] == 1) {
            $remember = true;
        } else {
            $remember = false;
//				$remember = true;
        }

        if ($this->dx_auth->is_max_login_attempts_exceeded()) {
            $this->form_validation->set_rules('captcha', lang("Protection code", "admin"), 'trim|required|xss_clean|callback_captcha_check');
        }

        if ($this->form_validation->run($this) == FALSE) {
//			    if ($this->form_validation->run($this) == TRUE)
            $err_object = & _get_validation_object();

            foreach ($_POST as $k => $v) {
                $err_text = $err_object->error($k, $prefix, $suffix);
                $this->template->assign($k . '_error', $err_text);
            }
        } else {
            if ($this->check_permissions($this->input->post('login'))) {
                $rezult = $this->dx_auth->login($this->input->post('login'), $this->input->post('password'), $remember);

                if ($rezult == TRUE) {
                    $this->lib_admin->log(lang("Entered the IP control panel", "admin") . " " . $this->input->ip_address());

                    redirect('admin/admin/init', 'refresh');
                } else {
                    $this->template->assign('login_failed', lang("Username and password have not been found", "admin"));
                }
            } else {
                 $this->template->assign('login_failed', lang("Not enough access rights", "admin"));
            }
        }

        $this->template->display('login');
//			$this->template->show('login', TRUE);
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

    function forgot_password() {
        ($hook = get_hook('auth_on_forgot_pass')) ? eval($hook) : NULL;

        $this->load->library('Form_validation');

        $val = $this->form_validation;

        // Set form validation rules
        $val->set_rules('login', lang("Username or Email", "admin"), 'trim|required|xss_clean');

        // Validate rules and call forgot password function
        if ($val->run() AND $this->dx_auth->forgot_password($this->input->post('login'))) {
            $this->template->assign('info_message', '<div class="alert alert-info">' . lang("Please check your email for instructions on how to activate the new password.", "admin") . '</div>');
        }

        if ($this->dx_auth->_auth_error != NULL) {
            $this->template->assign('info_message', '<div class="alert alert-error">' . $this->dx_auth->_auth_error . '</div>');
        }

        ($hook = get_hook('auth_show_forgot_pass_tpl')) ? eval($hook) : NULL;

        $this->template->display('forgot_password');
    }

    function update_captcha() {
        $this->dx_auth->captcha();
        echo $this->dx_auth->get_captcha_image();
    }

    // callbacks
    function captcha_check($code) {
        $result = TRUE;

        if ($this->dx_auth->is_captcha_expired()) {
            $this->form_validation->set_message('captcha_check', lang("Wrong protection code", "admin"));
            $result = FALSE;
//            $result = TRUE;
        } elseif (!$this->dx_auth->is_captcha_match($code)) {
            $this->form_validation->set_message('captcha_check', lang("Wrong protection code", "admin"));
            $result = FALSE;
//            $result = TRUE;
        }

        return $result;
    }

    private function user_browser($agent) {
        preg_match("/(MSIE|Opera|Firefox|Chrome|Version|Opera Mini|Netscape|Konqueror|SeaMonkey|Camino|Minefield|Iceweasel|K-Meleon|Maxthon)(?:\/| )([0-9.]+)/", $agent, $browser_info);
        list(, $browser, $version) = $browser_info;
        if (preg_match("/Opera ([0-9.]+)/i", $agent, $opera))
            return $browserIn = array('0' => 'Opera', '1' => $opera[1]);
        if ($browser == 'MSIE') {
            preg_match("/(Maxthon|Avant Browser|MyIE2)/i", $agent, $ie); // check to see whether the development is based on IE
            if ($ie)
                return $browserIn = array('0' => $ie[1], '1' => $version); // If so, it returns an
            return $browserIn = array('0' => 'IE', '1' => $version); // otherwise just return the IE and the version number
        }
        if ($browser == 'Firefox') {
            preg_match("/(Flock|Navigator|Epiphany)\/([0-9.]+)/", $agent, $ff); // check to see whether the development is based on Firefox
            if ($ff)
                return $browserIn = array('0' => $ff[1], '1' => $ff[2]); // if so, shows the number and version
        }
        if ($browser == 'Opera' && $version == '9.80')
            return $browserIn = array('0' => 'Opera', '1' => substr($agent, -5));
        if ($browser == 'Version')
            return $browserIn = array('0' => 'Safari', '1' => $version); // define Safari
        if (!$browser && strpos($agent, 'Gecko'))
            return 'Browser based on Gecko'; // unrecognized browser check to see if they are on the engine, Gecko, and returns a message about this
        return $browserIn = array('0' => $browser, '1' => $version); // for the rest of the browser and return the version
    }

    function switch_admin_lang($lang) {
        $langs = Array(
            'english',
            'russian',
            'german'
        );

        if (!$lang) {
            $lang = $this->input->get('language');
        }

        if (in_array($lang, $langs) && $this->config->item('language') != $lang) {
            $this->db->set('lang_sel', $lang . '_lang')
                    ->update('settings');

            $this->session->set_userdata('language', $lang);
        }
        redirect($_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : '/admin/login');
    }

}

/* End of login.php */
