<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Implements public API methods for Auth class
 * All methods return json objects in one format
 * 
 * @author Avgustus
 * @copyright ImageCMS (c) 2013, Avgustus <avgustus@yandex.ru>
 * 
 */
class Authapi extends Auth {

    public function __construct() {
        parent::__construct();
        $this->form_validation->set_error_delimiters(FALSE, FALSE);
    }

    /**
     * Provides user login
     * 
     * requires:
     * @email
     * @password
     */
    public function login() {
        if (!$this->dx_auth->is_logged_in()) {
            $val = $this->form_validation;
            //$val->set_error_delimiters(FALSE);
            // Set form validation rules
            $val->set_rules('email', lang('lang_email'), 'trim|required|min_length[3]|xss_clean|valid_email');
            $val->set_rules('password', lang('lang_password'), 'trim|required|min_length[3]|max_length[30]|xss_clean');
            $val->set_rules('remember', 'Remember me', 'integer');
            // Set captcha rules if login attempts exceed max attempts in config           
            if ($this->dx_auth->is_max_login_attempts_exceeded()) {
                if ($this->dx_auth->use_recaptcha)
                    $val->set_rules('recaptcha_response_field', lang('lang_captcha'), 'trim|xss_clean|required|callback_captcha_check');
                else
                    $val->set_rules('captcha', lang('lang_captcha'), 'trim|required|xss_clean|callback_captcha_check');
            }
            if ($val->run($this) AND $this->dx_auth->login($val->set_value('email'), $val->set_value('password'), $val->set_value('remember'))) {
                $this->template->add_array(array('is_logged_in' => $this->dx_auth->is_logged_in()));
                $template = $this->template->fetch('shop/default/auth_data');
                ShopCore::app()->SCart->transferCartData();
                echo json_encode(
                        array(
                            'msg' => 'User logged in success',
                            'status' => true,
                            'refresh' => true,
                        )
                );
            } else {
                $this->template->assign('info_message', $this->dx_auth->get_auth_error());
                // Check if the user is failed logged in because user is banned user or not
                if ($this->dx_auth->is_banned()) {
                    // Redirect to banned uri
                    //$this->dx_auth->deny_access('banned');
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
                    //return json data for render login form
                    echo json_encode(
                            array(
                                'msg' => validation_errors(),
                                'status' => false,
                                'validations' => array(
                                    'email' => form_error('email'),
                                    'password' => form_error('password'),
                                    'remember' => form_error('remember'),
                                ),
                            )
                    );
                }
            }
        } else {
            $json = array();
            $json['status'] = false;
            $json['msg'] = 'User is already logged in';
            echo json_encode($json);
        }
    }

    /**
     * Provides user logout
     * 
     * To make logout user has to be loggen in
     */
    public function logout() {
        if ($this->dx_auth->is_logged_in()) {
            $this->dx_auth->logout();
            echo json_encode(
                    array(
                        'msg' => 'Logout completed',
                        'status' => true,
                        'refresh' => true,
                    )
            );
        } else {
            echo json_encode(
                    array(
                        'msg' => 'You are not loggin to make loggout',
                        'status' => false,
                    )
            );
        }
    }

    /**
     * Provides user register
     * 
     * required:
     * @email
     * @password
     * @confirm_password
     */
    public function register() {
        if (!$this->dx_auth->is_logged_in() AND $this->dx_auth->allow_registration) {
            $val = $this->form_validation;
            // Set form validation rules
            $val->set_rules('email', lang('lang_email'), 'trim|required|xss_clean|valid_email|callback_email_check');
            $val->set_rules('username', lang('s_fio'), 'trim|xss_clean');
            $val->set_rules('password', lang('lang_password'), 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_password]');
            $val->set_rules('confirm_password', lang('lang_confirm_password'), 'trim|required|xss_clean');
            if ($this->dx_auth->captcha_registration) {
                if ($this->dx_auth->use_recaptcha)
                    $val->set_rules('recaptcha_response_field', lang('lang_captcha'), 'trim|xss_clean|required|callback_captcha_check');
                else
                    $val->set_rules('captcha', lang('lang_captcha'), 'trim|xss_clean|required|callback_captcha_check');
            }
            // Run form validation and register user if it's pass the validation
            $this->load->helper('string');
            $key = random_string('alnum', 5);
            if ($val->run($this) AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email'), '', $key, '')) {
                // Set success message accordingly
                if ($this->dx_auth->email_activation) {
                    $data['auth_message'] = lang('lang_check_mail_acc');
                } else {
                    $data['auth_message'] = lang('lang_reg_success') . anchor(site_url($this->dx_auth->login_uri), lang('lang_login'));
                }
                //create json array for ajax request
                $json = array();
                $json['status'] = true;
                $json['msg'] = 'Register success';
                $json['refresh'] = true;
                echo json_encode($json);
            } else {
                // Is registration using captcha
                if ($this->dx_auth->captcha_registration) {
                    $this->dx_auth->captcha();
                    $this->template->assign('cap_image', $this->dx_auth->get_captcha_image());
                }
                //create json array for ajax requests
                $json = array();
//                $json['additional_info']['allow_registration'] = $this->dx_auth->allow_registration;
//                $json['additional_info']['email_activation'] = $this->dx_auth->email_activation;
                if ($this->dx_auth->captcha_registration) {
                    $data['captcha_required'] = $this->dx_auth->captcha_registration;
                    $data['captcha_image'] = $this->dx_auth->get_captcha_image();
                }
                $json['msg'] = validation_errors();
                $json['validations'] = array(
                    'email' => form_error('email'),
                    'username' => form_error('username'),
                    'password' => form_error('password'),
                    'confirm_password' => form_error('confirm_password'),
                    'captcha' => form_error('captcha'),
                    'recaptcha_response_field' => form_error('recaptcha_response_field'),
                );
                $json['status'] = false;
                echo json_encode($json);
            }
        } elseif (!$this->dx_auth->allow_registration) {
            $json = array();
            //$json['additional_info']['allow_registration'] = false;
            $json['msg'] = 'Registration is not allowed';
            $json['status'] = false;
            echo json_encode($json);
        } else {
            $json = array();
            $json['msg'] = 'User is logged in';
            $json['status'] = false;
            echo json_encode($json);
        }
    }

    /**
     * Provides sending forgotten password to user email
     * 
     * require:
     * @email
     */
    public function forgot_password() {
        $val = $this->form_validation;
        // Set form validation rules
        $val->set_rules('email', lang('lang_email'), 'trim|required|xss_clean|valid_email');
        // Validate rules and call forgot password function
        if ($val->run($this) AND $this->dx_auth->forgot_password($val->set_value('email'))) {
            echo json_encode(array(
                'msg' => 'Email with new password send to you email',
                'status' => true,
            ));
        } else {
            echo json_encode(array(
                'msg' => validation_errors(),
                'validations' => array(
                    'email' => form_error('email'),
                ),
                'status' => false,
            ));
        }
    }

    /**
     * Provides password reset
     * 
     * require:
     * @email
     */
    public function reset_password() {
        // Get username and key
        $email = $this->input->post('email');
        $key = $this->input->post('key');
        // Reset password
        if ($this->dx_auth->reset_password($email, $key)) {
            echo json_encode(array(
                'msg' => lang('lang_pass_restored') . anchor(site_url($this->dx_auth->login_uri), lang('s_login_here')),
                'status' => true,
            ));
        } else {
            echo json_encode(array(
                'msg' => 'Reset password failed',
                'status' => false,
            ));
        }
    }

    /**
     * Provides password change
     * 
     * required:
     * @old_password
     * @new_password
     * @confirm_new_password
     */
    public function change_password() {
        // Check if user logged in or not
        if ($this->dx_auth->is_logged_in()) {
            $val = $this->form_validation;

            // Set form validation
            $val->set_rules('old_password', lang('lang_old_password'), 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']');
            $val->set_rules('new_password', lang('lang_new_password'), 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_new_password]');
            $val->set_rules('confirm_new_password', lang('lang_confirm_new_pass'), 'trim|required|xss_clean');

            // Validate rules and change password
            if ($val->run($this) AND $this->dx_auth->change_password($val->set_value('old_password'), $val->set_value('new_password'))) {
                echo json_encode(array(
                    'msg' => lang('lang_pass_changed'),
                    'status' => true,
                ));
            } else {
                echo json_encode(array(
                    'msg' => validation_errors(),
                    'validations' => array(
                        'old_password' => form_error('old_password'),
                        'new_password' => form_error('new_password'),
                        'confirm_new_password' => form_error('confirm_new_password'),
                    ),
                    'status' => false,
                ));
            }
        } else {
            echo json_encode(array(
                'msg' => 'You are not logged in to change password',
                'status' => false,
            ));
        }
    }

    /**
     * Provides cancelling account if user is logged in
     */
    public function cancel_account() {
        // Check if user logged in or not
        if ($this->dx_auth->is_logged_in()) {
            $val = $this->form_validation;
            // Set form validation rules
            $val->set_rules('password', lang('lang_password'), "trim|required|xss_clean");
            // Validate rules and change password
            if ($val->run($this) AND $this->dx_auth->cancel_account($val->set_value('password'))) {
                echo json_encode(array(
                    'msg' => 'Deleting account completed',
                    'status' => true,
                ));
            } else {
                echo json_encode(array(
                    'msg' => validation_errors(),
                    'validations' => array(
                        'password' => form_error('password'),
                    ),
                    'status' => false,
                ));
            }
        } else {
            echo json_encode(array(
                'msg' => 'You are not logged in, you dont have any account to delete',
                'status' => false,
            ));
        }
    }

    /**
     * Returns ban reason if user is banned
     */
    public function banned() {
        echo json_encode(array(
            'msg' => lang('lang_user_banned') . $this->ban_reason,
            'status' => true,
        ));
    }

}

/* End of file authapi.php */
