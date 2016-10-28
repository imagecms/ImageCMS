<?php

use CMSFactory\Events;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * Image CMS
 * auth.php
 */

class Auth extends MY_Controller
{

    // Used for registering and changing password form validation
    public $min_username = 4;

    public $max_username = 150;

    public $min_password = 5;

    public $max_password = 20;

    public $ban_reason = NULL;

    public function __construct() {
        parent::__construct();

        $this->min_password = ($this->config->item('DX_login_min_length')) ? $this->config->item('DX_login_min_length') : $this->min_password;
        $this->max_password = ($this->config->item('DX_login_max_length')) ? $this->config->item('DX_login_max_length') : $this->max_password;

        $this->load->language('auth');
        $this->load->helper('url');
        $this->load->library('Form_validation');

        $lang = new MY_Lang();
        $lang->load('auth');
    }

    public function index() {
        $this->login();
    }

    /* Callback functions */

    public function username_check($username) {
        //         ($hook = get_hook('auth_username_check')) ? eval($hook) : NULL;
        //         $result = $this->dx_auth->is_username_available($username);
        //         if (!$result) {
        //             $this->form_validation->set_message('username_check', lang("This username is already registered."));
        //         }
        //         if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
        //             return $result;
        //         else
        //             return $result;
        // //            return json_encode(array('result' => $result));
        return true;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function email_check($email) {
        $result = $this->dx_auth->is_email_available($email);
        if (!$result) {
            $this->form_validation->set_message('email_check', lang('A user with this email is already registered.', 'auth'));
        }

        return $result;
    }

    /**
     * @param string $code
     * @return bool
     */
    public function captcha_check($code) {
        if (!$this->dx_auth->captcha_check($code)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function validate_username($str) {
        //         $result = (!preg_match("/^([@.-a-z0-9_-])+$/i", $str)) ? false : true;
        //         if ($result === false)
        //             $this->form_validation->set_message('validate_username',  lang('Login field can only contain letters, numbers, underscores, dashes, or e-mail address'). '.');
        //         return $result;
    }

    public function recaptcha_check() {
        $result = $this->dx_auth->is_recaptcha_match();
        if (!$result) {
            $this->form_validation->set_message('recaptcha_check', lang('Improper protection code'));
        }

        return $result;
    }

    /* End of Callback functions */

    /*
     * Login function
     */

    public function login() {
        $this->template->registerMeta('ROBOTS', 'NOINDEX, NOFOLLOW');
        $this->core->set_meta_tags(lang('Authorization', 'auth'));
        if (!$this->dx_auth->is_logged_in()) {
            $val = $this->form_validation;

            // Set form validation rules
            $val->set_rules('email', lang('Email'), 'trim|required|min_length[3]|xss_clean|valid_email');
            $val->set_rules('password', lang('Password'), 'trim|required|min_length[3]|max_length[30]|xss_clean');
            $val->set_rules('remember', 'Remember me', 'integer');

            // Set captcha rules if login attempts exceed max attempts in config
            if ($this->dx_auth->is_max_login_attempts_exceeded()) {
                if ($this->dx_auth->use_recaptcha) {
                    $val->set_rules('recaptcha_response_field', lang('Code protection', 'auth'), 'trim|xss_clean|required|callback_captcha_check');
                } else {
                    $val->set_rules('captcha', lang('Code protection', 'auth'), 'trim|required|xss_clean|callback_captcha_check');
                }
            }

            if ($val->run() AND $this->dx_auth->login($val->set_value('email'), $val->set_value('password'), $val->set_value('remember'))) {
                // Redirect to homepage
                if (class_exists('ShopCore') && SHOP_INSTALLED) {
                    ShopCore::app()->SCart->transferCartData();
                }
                if ($this->input->server('HTTP_X_REQUESTED_WITH') != 'XMLHttpRequest') {
                    redirect('', 'location');
                } else {
                    $this->template->add_array(
                        [
                         'is_logged_in' => $this->dx_auth->is_logged_in(),
                         'success'      => true,
                        ]
                    );

                    $this->template->display('login_popup');

                }
            } else {
                $this->template->assign('info_message', $this->dx_auth->get_auth_error());

                // Check if the user is failed logged in because user is banned user or not
                if ($this->dx_auth->is_banned()) {

                    // Redirect to banned uri
                    $this->ban_reason = $this->dx_auth->get_ban_reason();
                    $this->banned();
                    exit;
                } else {
                    // Default is we don't show captcha until max login attempts eceeded
                    $data['show_captcha'] = FALSE;

                    // Show captcha if login attempts exceed max attempts in config
                    if ($this->dx_auth->is_max_login_attempts_exceeded()) {
                        // Create catpcha
                        $this->dx_auth->captcha();
                        $this->template->assign('cap_image', $this->dx_auth->get_captcha_image());
                        // Set view data to show captcha on view file
                        $data['show_captcha'] = TRUE;
                    }

                    // Load login page view
                    if ($this->input->server('HTTP_X_REQUESTED_WITH') != 'XMLHttpRequest') {
                        $this->template->show('login');
                    } else {
                        $this->template->display('login_popup');
                    }
                }
            }
        } else {
            redirect(site_url(), 301);

            $this->template->assign('content', lang('You are already logged.', 'auth'));
            $this->template->show();
        }
    }

    public function render_min($name, $data = []) {
        $this->template->add_array($data);
        return $this->template->display($name . '.tpl');
    }

    public function logout() {
        $this->dx_auth->logout();

        redirect('', 'location');
    }

    public function register() {
        $this->core->set_meta_tags(lang('Registration', 'auth'));
        $this->template->registerMeta('ROBOTS', 'NOINDEX, NOFOLLOW');

        $this->load->library('Form_validation');
        if (!$this->dx_auth->is_logged_in() AND $this->dx_auth->allow_registration) {
            $val = $this->form_validation;

            // Set form validation rules
            $val->set_rules('email', lang('Email', 'auth'), 'trim|required|xss_clean|valid_email|callback_email_check');
            $val->set_rules('username', lang('Name'), 'trim|xss_clean');
            $val->set_rules('password', lang('Password'), 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_password]');
            $val->set_rules('confirm_password', lang('Repeat Password'), 'trim|required|xss_clean');

            if (SHOP_INSTALLED) {
                /** Проверка по кастомным полям */
                foreach (ShopCore::app()->CustomFieldsHelper->getCustomFielsdAsArray('user') as $item) {

                    if ($item['is_active'] == 1) {
                        if ($item['is_required'] == 1) {
                            $val->set_rules('custom_field[' . $item['id'] . ']', lang($item['field_name']), 'trim|xss_clean|required');
                        } else {
                            $val->set_rules('custom_field[' . $item['id'] . ']', lang($item['field_name']), 'trim|xss_clean');
                        }
                    }
                }
            }

            if ($this->dx_auth->captcha_registration) {
                if ($this->dx_auth->use_recaptcha) {
                    $val->set_rules('recaptcha_response_field', lang('Code protection', 'auth'), 'trim|xss_clean|required|callback_captcha_check');
                } else {
                    $val->set_rules('captcha', lang('Code protection', 'auth'), 'trim|xss_clean|required|callback_captcha_check');
                }
            }

            // Run form validation and register user if it's pass the validation
            $this->load->helper('string');
            $key = random_string('alnum', 5);
            if ($val->run($this) AND $last_user = $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email'), '', $key, '')) {
                // Set success message accordingly
                if ($this->dx_auth->email_activation) {
                    $data['auth_message'] = lang('You have successfully registered. Please check your email to activate your account.', 'auth');
                } else {
                    $data['auth_message'] = lang('You have successfully registered. ', 'auth') . anchor(site_url($this->dx_auth->login_uri), lang('Login', 'auth'));
                }

                Events::create()->registerEvent($last_user, 'AuthUser:register');
                Events::create()->runFactory();

                // Load registration success page
                if ($this->input->server('HTTP_X_REQUESTED_WITH') != 'XMLHttpRequest') {
                    $this->template->show('register_success');
                    exit;
                } else {
                    $this->template->display('register_popup', ['succes' => TRUE]);
                }
            } else {

                $this->template->assign('info_message', $this->dx_auth->get_auth_error());

                // Is registration using captcha
                if ($this->dx_auth->captcha_registration) {
                    $this->dx_auth->captcha();
                    $this->template->assign('cap_image', $this->dx_auth->get_captcha_image());
                }
                if ($this->input->server('HTTP_X_REQUESTED_WITH') != 'XMLHttpRequest') {
                    $this->template->show('register');
                } else {
                    $this->template->display('register_popup');
                }
            }
        } elseif (!$this->dx_auth->allow_registration) {
            $data['auth_message'] = lang('Registration is prohibited.', 'auth');

            $this->template->assign('content', $data['auth_message']);
            $this->template->show();
        } else {
            redirect(site_url(), 301);
        }
    }

    public function activate() {
        // Get username and key
        $email = $this->uri->segment(3);
        $key = $this->uri->segment(4);

        // Activate user
        if ($this->dx_auth->activate($email, $key)) {
            $data['auth_message'] = lang('Your account has been successfully activated. ', 'auth') . anchor(site_url($this->dx_auth->login_uri), lang('Login', 'auth'));

            $this->template->assign('content', $data['auth_message']);
            $this->template->show();
        } else {
            $data['auth_message'] = lang('You have provided an incorrect activation code.', 'auth');

            $this->template->assign('content', $data['auth_message']);
            $this->template->show();
        }
    }

    public function forgot_password() {
        $this->core->set_meta_tags(lang('Forgot password', 'auth'));
        $this->template->registerMeta('ROBOTS', 'NOINDEX, NOFOLLOW');
        $this->load->library('Form_validation');

        $val = $this->form_validation;

        // Set form validation rules
        $val->set_rules('email', lang('Email'), 'trim|required|xss_clean|valid_email');

        // Validate rules and call forgot password function
        if ($val->run() AND $this->dx_auth->forgot_password($val->set_value('email'))) {
            $data['auth_message'] = lang('Please check your email for instructions on how to activate the new password.', 'auth');
            $this->template->assign('info_message', $data['auth_message']);
            $this->template->assign('success', $data['auth_message']);
        }

        if ($this->dx_auth->_auth_error != NULL) {
            $this->template->assign('errors', $this->dx_auth->_auth_error);
            $this->template->assign('info_message', $this->dx_auth->_auth_error);
        }

        if ($this->input->server('HTTP_X_REQUESTED_WITH') != 'XMLHttpRequest') {
            $this->template->show('forgot_password');
        } else {
            $this->template->display('forgot_password');
        }
    }

    /**
     * @return void
     */
    public function reset_password() {

        if ($this->dx_auth->is_logged_in()) {
            redirect(site_url('/'));
        }

        // Get username and key
        $email = $this->uri->segment(3);
        $key = $this->uri->segment(4);

        // Reset password
        if ($this->dx_auth->reset_password($email, $key)) {
            $data['auth_message'] = lang('You have successfully zeroed my password. ', 'auth');

            $this->template->assign('auth_message', $data['auth_message']);
            if ($this->input->server('HTTP_X_REQUESTED_WITH') != 'XMLHttpRequest') {
                $this->template->show('reset_password');
            } else {
                $this->template->display('reset_password');
            }
        } else {
            $data['auth_message'] = lang('Reset failed. Possible reasons: wrong email, wrong restore url, used restore url', 'auth');

            $this->template->assign('auth_message', $data['auth_message']);
            if ($this->input->server('HTTP_X_REQUESTED_WITH') != 'XMLHttpRequest') {
                $this->template->show('reset_password');
            } else {
                $this->template->display('reset_password');
            }
        }
    }

    public function change_password() {
        $this->load->library('Form_validation');

        // Check if user logged in or not
        if ($this->dx_auth->is_logged_in()) {
            $val = $this->form_validation;

            // Set form validation
            $val->set_rules('old_password', lang('Old Password', 'auth'), 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']');
            $val->set_rules('new_password', lang('The new password', 'auth'), 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_new_password]');
            $val->set_rules('confirm_new_password', lang('Repeat new password', 'auth'), 'trim|required|xss_clean');

            // Validate rules and change password
            if ($val->run() AND $res = $this->dx_auth->change_password($val->set_value('old_password'), $val->set_value('new_password'))) {
                $data['auth_message'] = lang('Your password was successfully changed.', 'auth');
                $this->template->assign('content', $data['auth_message']);
                $this->template->show();
            } else {
                if ($this->input->post() && !$res) {
                    $this->template->assign('info_message', lang('Field Old password is not correct', 'auth'));
                }
                $this->core->set_meta_tags(lang('Change password', 'auth'));
                $this->template->show('change_password');
            }
        } else {
            // Redirect to login page
            $this->dx_auth->deny_access('login');
        }
    }

    public function cancel_account() {
        $this->load->library('Form_validation');

        // Check if user logged in or not
        if ($this->dx_auth->is_logged_in()) {
            $val = $this->form_validation;

            // Set form validation rules
            $val->set_rules('password', lang('Password', 'auth'), 'trim|required|xss_clean');

            // Validate rules and change password
            if ($val->run() AND $this->dx_auth->cancel_account($val->set_value('password'))) {
                // Redirect to homepage
                redirect('', 'location');
            }
        } else {
            // Redirect to login page
            $this->dx_auth->deny_access('login');
        }
    }

    /*
     * Deny access
     */

    public function deny() {
        \CMSFactory\assetManager::create()
            ->setData('content', lang('You are not allowed to view the page.', 'auth'))
            ->render('deny', FALSE);

    }

    public function banned() {
        echo lang('Your account has been blocked.', 'auth');

        if ($this->ban_reason != NULL) {
            echo '<br/>' . $this->ban_reason;
        }
    }

}

/* End of file auth.php */