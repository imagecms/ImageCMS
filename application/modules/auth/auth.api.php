<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Image CMS
 * api auth.php
 */

class AuthApi extends Auth {

    public function __construct() {
        $this->min_password = ($this->config->item('DX_login_min_length')) ? $this->config->item('DX_login_min_length') : $this->min_password;
        $this->max_password = ($this->config->item('DX_login_max_length')) ? $this->config->item('DX_login_max_length') : $this->max_password;
        $this->load->helper('url');
        $this->load->library('Form_validation');
        $this->load->library('DX_auth');
        $this->load->library('template');
    }

    function login() {
        if (!$this->dx_auth->is_logged_in()) {
            $val = $this->form_validation;
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
                            'message' => 'User logged in success',
                            'action' => 'auth/login',
                            'reload' => true,
                            'reopen' => false,
                            'required_fields' => array()
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
                                'message' => 'Returns array with information concerning login form',
                                'action' => 'auth/login',
                                'reload' => false,
                                'reopen' => false,
                                'required_fields' => array()
                            )
                    );
                }
            }
        } else {
            echo json_encode(
                    array(
                        'message' => 'You are logged in right now.',
                        'action' => 'auth/login',
                        'reload' => false,
                        'reopen' => false,
                        'required_fields' => array()
                    )
            );
        }
    }

    function logout() {
        $this->dx_auth->logout();
        echo json_encode(array('logged_out' => true));
        echo json_encode(
                    array(
                        'message' => 'You are logged in right now.',
                        'action' => 'auth/logout',
                        'reload' => true,
                        'reopen' => false,
                        'required_fields' => array()
                    )
            );
    }

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
                $json['auth_message'] = "Вы успешно зарегистрированы";
                $json['registration_mail'] = $this->dx_auth->email_activation;
                echo json_encode($json);
            } else {
                // Is registration using captcha
                if ($this->dx_auth->captcha_registration) {
                    $this->dx_auth->captcha();
                    $this->template->assign('cap_image', $this->dx_auth->get_captcha_image());
                }
                //create json array for ajax requests
                $json = array();
                $json['allow_registration'] = $this->dx_auth->allow_registration;
                $json['email_activation'] = $this->dx_auth->email_activation;
                if ($this->dx_auth->captcha_registration) {
                    $data['captcha_required'] = $this->dx_auth->captcha_registration;
                    $data['captcha_image'] = $this->dx_auth->get_captcha_image();
                }
                $json['error_message'] = validation_errors();
                $json['required_form_fields'] = array(
                    array(
                        'field_name' => 'email',
                        'field_type' => 'text',
                        'rules' => array('required', 'valid_email')
                    ),
                    array(
                        'field_name' => 'password',
                        'field_type' => 'text',
                        'rules' => array('required')
                    ),
                    array(
                        'field_name' => 'confirm_passwords',
                        'field_type' => 'text',
                        'rules' => array('required')
                    ),
                    array(
                        'field_name' => 'username',
                        'field_type' => 'text',
                        'rules' => array()
                    )
                );
                if ($this->dx_auth->captcha_registration) {
                    if ($this->dx_auth->use_recaptcha)
                        $data['required_form_fields'][] = array(
                            'field_name' => 'recaptcha_response_field',
                            'field_type' => 'text',
                            'rules' => array('required')
                        );
                    else
                        $data['required_form_fields'][] = array(
                            'field_name' => 'captcha',
                            'field_type' => 'text',
                            'rules' => array('required')
                        );
                }
                echo json_encode($json);
            }
        } elseif (!$this->dx_auth->allow_registration) {
            $json = array();
            $json['allow_registration'] = false;
            echo json_encode($json);
        } else {
            $json = array();
            $json['user_logged_in'] = true;
            echo json_encode($json);
        }
    }

    function forgot_password() {
        $val = $this->form_validation;
        // Set form validation rules
        $val->set_rules('email', lang('lang_email'), 'trim|required|xss_clean|valid_email');
        // Validate rules and call forgot password function
        if ($val->run() AND $this->dx_auth->forgot_password($val->set_value('email')))
            $data['auth_message'] = lang('lang_acc_mail_sent');
        if ($this->dx_auth->_auth_error != NULL)
            $data['auth_message'] = $this->dx_auth->_auth_error;
        echo json_encode($data);
    }

    function reset_password() {
        // Get username and key
        $email = $this->uri->segment(3);
        $key = $this->uri->segment(4);
        // Reset password
        if ($this->dx_auth->reset_password($email, $key)) {
            $data['auth_message'] = lang('lang_pass_restored') . anchor(site_url($this->dx_auth->login_uri), lang('s_login_here'));
        } else {
            $data['auth_message'] = lang('lang_reset_failed');
        }
        echo json_encode($data);
    }

    function change_password() {
        // Check if user logged in or not
        if ($this->dx_auth->is_logged_in()) {
            $val = $this->form_validation;

            // Set form validation
            $val->set_rules('old_password', lang('lang_old_password'), 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']');
            $val->set_rules('new_password', lang('lang_new_password'), 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_new_password]');
            $val->set_rules('confirm_new_password', lang('lang_confirm_new_pass'), 'trim|required|xss_clean');

            // Validate rules and change password
            if ($val->run($this) AND $this->dx_auth->change_password($val->set_value('old_password'), $val->set_value('new_password'))) {
                $data['auth_message'] = lang('lang_pass_changed');
                echo json_encode($data);
            } else {
                echo json_encode($data);
            }
        } else {
            
        }
    }

    function cancel_account() {
        // Check if user logged in or not
        if ($this->dx_auth->is_logged_in()) {
            $val = $this->form_validation;
            // Set form validation rules
            $val->set_rules('password', lang('lang_password'), "trim|required|xss_clean");
            // Validate rules and change password
            if ($val->run($this) AND $this->dx_auth->cancel_account($val->set_value('password'))) {
                
            } else {
                
            }
        } else {
            
        }
    }

    function banned() {
        echo json_encode(array('title' => lang('lang_user_banned'), 'msg' => '<br/>' . $this->ban_reason));
    }

}

/* End of file auth.php */
