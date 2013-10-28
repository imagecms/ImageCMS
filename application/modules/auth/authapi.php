<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Implements public API methods for Auth class
 * All methods return json objects in one format
 *
 * @author Avgustus
 * @copyright ImageCMS (c) 2013, Avgustus <avgustus@yandex.ru>
 *
 */
class Authapi extends MY_Controller {

    private $min_username = null;
    private $max_username = null;
    private $min_password = null;
    private $max_password = null;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('auth');

        $this->initialize();
    }

    /**
     * Provides user login
     * @return json
     * @access public
     * @copyright ImageCMS (c) 2013
     */
    public function login() {
        if (!$this->dx_auth->is_logged_in()) {

            /** Set form validation rules */
            $this->form_validation->set_rules('email', lang('Email', 'auth'), 'trim|required|min_length[3]|xss_clean|valid_email|callback_email_check_for_login');
            $this->form_validation->set_rules('password', lang('Password', 'auth'), 'trim|required|min_length[3]|max_length[30]|xss_clean');
            $this->form_validation->set_rules('remember', lang('Remeber me', 'auth'), 'integer');

            /** Validate rules and change password */
            $validationResult = $this->form_validation->run();
            $doLoginResult = $this->dx_auth->login($this->input->post('email'), $this->input->post('password'), $this->input->post('remember'));

            /** Prepare response */
            if (true === $validationResult AND true === $doLoginResult) {
                if (class_exists('ShopCore') && SHOP_INSTALLED)
                    ShopCore::app()->SCart->transferCartData();
                $jsonResponse['msg'] = lang('User logged in success', 'auth');
                $jsonResponse['status'] = true;
                $jsonResponse['refresh'] = true;
                $jsonResponse['redirect'] = FAlSE;
            } else {

                /** Check if the user is failed logged in because user is banned user or not */
                if ($this->dx_auth->is_banned()) {
                    $this->ban_reason = $this->dx_auth->get_ban_reason();
                    $this->banned();
                    exit;
                } else {

                    $validationResult = validation_errors();
                    if (empty($validationResult)) {
                        $jsonResponse['msg'] = lang('User with this name and password is not found', 'auth');
                        $jsonResponse['validations'] = array('email' => lang('User with this name and password is not found', 'auth'));
                    } else {
                        $jsonResponse['msg'] = $validationResult;
                        $jsonResponse['validations'] = array('email' => form_error('email'), 'password' => form_error('password'), 'remember' => form_error('remember'));
                    }

                    /** Return json data for render login form */
                    $jsonResponse['status'] = false;
                    $jsonResponse['refresh'] = false;
                    $jsonResponse['redirect'] = false;
                }
            }
        } else {
            $jsonResponse['refresh'] = false;
            $jsonResponse['redirect'] = false;
            $jsonResponse['status'] = false;
            $jsonResponse['msg'] = 'User is already logged in';
        }

        /** return JSON Data */
        echo json_encode($jsonResponse);
    }

    /**
     * Provides user logout
     * To make logout user has to be loggen in
     * @return json
     * @access public
     * @copyright ImageCMS (c) 2013
     */
    public function logout() {
        /** Preprate Variables */
        $jsonResponse = array();

        if ($this->dx_auth->is_logged_in()) {
            /** Do logout */
            $this->dx_auth->logout();

            /** Preprate response */
            $jsonResponse['msg'] = lang('Logout completed', 'auth');
            $jsonResponse['status'] = TRUE;
            $jsonResponse['refresh'] = TRUE;
            $jsonResponse['redirect'] = FALSE;
        } else {
            /** Preprate response */
            $jsonResponse['msg'] = 'You are not loggin to make loggout';
            $jsonResponse['status'] = false;
        }

        /** return JSON Data */
        return json_encode($jsonResponse);
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
            $val->set_rules('email', lang("Email"), 'trim|required|xss_clean|valid_email|callback_email_check');
            $val->set_rules('username', lang("Name"), 'trim|xss_clean');
            $val->set_rules('password', lang("Password"), 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_password]');
            $val->set_rules('confirm_password', lang("Repeat Password"), 'trim|required|xss_clean');

            if ($this->dx_auth->captcha_registration) {
                if ($this->dx_auth->use_recaptcha)
                    $val->set_rules('recaptcha_response_field', lang("Code protection"), 'trim|xss_clean|required|callback_captcha_check');
                else
                    $val->set_rules('captcha', lang("Code protection"), 'trim|xss_clean|required|callback_captcha_check');
            }
            // Run form validation and register user if it's pass the validation
            $this->load->helper('string');
            $key = random_string('alnum', 5);

            if ($val->run($this) AND $last_user = $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email'), '', $key, '')) {
                // Set success message accordingly
                if ($this->dx_auth->email_activation) {
                    $data['auth_message'] = lang("You have successfully registered. Please check your email to activate your account.");
                } else {
                    $data['auth_message'] = lang("You have successfully registered. ") . anchor(site_url($this->dx_auth->login_uri), lang("Login"));
                }
                //create json array for ajax request
                $json = array();
                $json['status'] = true;
                $json['msg'] = lang('Register success', 'auth');
                $json['refresh'] = $this->input->post('refresh') ? $this->input->post('refresh') : false;
                $json['redirect'] = $this->input->post('redirect') ? $this->input->post('redirect') : false;

                $user_Prof = SUserProfileQuery::create()->findPk($last_user['id_user']);
                $user_Prof->save();

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
                $json['anotherone'] = false;
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
        $val->set_rules('email', lang("Email"), 'trim|required|xss_clean|valid_email|callback_email_check_for_login');
        // Validate rules and call forgot password function
        if ($val->run($this) AND $this->dx_auth->forgot_password($val->set_value('email'))) {
            echo json_encode(array(
                'msg' => lang('Email with new password send to you email', 'auth'),
                'status' => true,
            ));
        } else {
            if ($this->dx_auth->_auth_error) {
                $error = $this->dx_auth->_auth_error;
            } else {
                $error = form_error('email');
            }
            echo json_encode(array(
                'msg' => validation_errors(),
                'validations' => array(
                    'email' => $error,
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
        if ($this->dx_auth->is_logged_in()) {
            if ($this->dx_auth->reset_password($email, $key)) {
                echo json_encode(array(
                    'msg' => lang("You have successfully zeroed my password. ") . anchor(site_url($this->dx_auth->login_uri), lang("Login Here")),
                    'status' => true,
                ));
            } else {
                echo json_encode(array(
                    'msg' => 'Reset password failed',
                    'status' => false,
                ));
            }
        } else {
            echo json_encode(array(
                'msg' => 'You have to be logged in to reset password',
                'status' => false,
            ));
        }
    }

    /**
     * Provides password change
     * @return json
     * @access public
     * @copyright ImageCMS (c) 2013
     */
    public function change_password() {
        /** Preprate Variables */
        $jsonResponse = array();

        /** Check if user logged in or not */
        if ($this->dx_auth->is_logged_in()) {

            /** Set form validation */
            $this->form_validation->set_rules('old_password', lang('Old password', 'auth'), 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']');
            $this->form_validation->set_rules('new_password', lang('New password', 'auth'), 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_new_password]');
            $this->form_validation->set_rules('confirm_new_password', lang('Repeat new password', 'auth'), 'trim|required|xss_clean');

            /** Validate rules and change password */
            $validationResult = $this->form_validation->run();
            $changePasswordResult = $this->dx_auth->change_password($this->input->post('old_password'), $this->input->post('new_password'));

            /** Prepare response */
            if (TRUE === $validationResult AND TRUE === $changePasswordResult) {
                $jsonResponse['msg'] = lang('Your password was successfully changed.', 'auth');
                $jsonResponse['status'] = TRUE;
            } else {
                $validationErrors = validation_errors();
                if (!empty($validationErrors)) {
                    $jsonResponse['msg'] = $validationErrors;
                    $jsonResponse['validations'] = array('old_password' => form_error('old_password'), 'new_password' => form_error('new_password'), 'confirm_new_password' => form_error('confirm_new_password'));
                    $jsonResponse['status'] = false;
                } else {
                    $jsonResponse['validations'] = array('old_password' => lang('Field Old password is not correct', 'auth'));
                    $jsonResponse['status'] = FALSE;
                }
            }
        } else {
            $jsonResponse['msg'] = lang('You are not logged in to change password', 'auth');
            $jsonResponse['status'] = false;
        }
        $jsonResponse['refresh'] = false;
        $jsonResponse['redirect'] = false;

        /** return JSON Data */
        return json_encode($jsonResponse);
    }

    function email_check($email) {

        $result = $this->dx_auth->is_email_available($email);
        if (!$result) {
            $this->form_validation->set_message('email_check', lang('A user with this email is already registered.', 'auth'));
        }

        return $result;
    }

    /**
     * Provides cancelling account if user is logged in
     */
    public function cancel_account() {
        // Check if user logged in or not
        if ($this->dx_auth->is_logged_in()) {
            $val = $this->form_validation;
            // Set form validation rules
            $val->set_rules('password', lang('Password', 'auth'), "trim|required|xss_clean");
            // Validate rules and change password
            if ($val->run($this) AND $this->dx_auth->cancel_account($val->set_value('password'))) {
                echo json_encode(array(
                    'msg' => lang('Deleting account completed', 'auth'),
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
                'msg' => lang('You are not logged in, you dont have any account to delete', 'auth'),
                'status' => false,
            ));
        }
    }

    /**
     * Returns ban reason if user is banned
     */
    public function banned() {
        echo json_encode(array(
            'msg' => lang('Your account has been blocked.', 'auth') . $this->ban_reason,
            'status' => true,
        ));
    }

    /**
     * Check if user logined
     */
    public function is_logined() {
        if ($this->dx_auth->is_logged_in()) {
            echo json_encode(array(
                'msg' => lang('User is already login in', 'auth'),
                'status' => true,
            ));
        } else {
            echo json_encode(array(
                'msg' => lang('User not logined', 'auth'),
                'status' => false,
            ));
        }
    }

    /**
     * Callback for Form Validation Class
     * @return bool
     * @access public
     * @copyright ImageCMS (c) 2013
     */
    public function email_check_for_login($email) {
        $result = $this->dx_auth->is_email_available($email);
        if ($result) {
            $this->form_validation->set_message('email_check_for_login', lang('A user with such mail is not found in the database', 'auth'));
            return false;
        } else {
            return true;
        }
    }

    /**
     * Class init Method
     */
    private function initialize() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters(false, false);
        $this->load->language('auth');
        $this->load->module('auth');
        $this->min_username = $this->auth->min_username;
        $this->max_username = $this->auth->max_username;
        $this->max_password = $this->auth->max_password;
        $this->min_password = $this->auth->min_password;
    }

}

/* End of file authapi.php */
