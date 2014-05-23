<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Feedback module
 */
class Feedback extends MY_Controller {

    public $username_max_len = 30;
    public $message_max_len = 600;
    public $theme_max_len = 150;
    public $admin_mail = 'admin@localhost';
    public $message = '';
    protected $formErrors = array();

    public function __construct() {
        parent::__construct();
        $this->load->module('core');
        $this->load_settings();

        $this->formErrors = array(
            'required' => lang('Field is required'),
            'min_length' => lang('Length is less than the minimum'),
            'valid_email' => lang('Email is not valid'),
            'max_length' => lang('Length greater than the maximum')
        );
        $lang = new MY_Lang();
        $lang->load('feedback');
    }

    public function autoload() {
        
    }

    function captcha_check($code) {
        if (!$this->dx_auth->captcha_check($code)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function recaptcha_check() {
        $result = $this->dx_auth->is_recaptcha_match();
        if (!$result) {
            $this->form_validation->set_message('recaptcha_check', lang("Improper protection code", 'feedback'));
        }

        return $result;
    }

    // Index function
    public function index() {
        $this->template->registerMeta("ROBOTS", "NOINDEX, NOFOLLOW");

        $this->core->set_meta_tags(lang('Feedback', 'feedback'));

        $this->load->library('form_validation');

        // Create captcha
        $this->dx_auth->captcha();
        $tpl_data['cap_image'] = $this->dx_auth->get_captcha_image();

        $this->template->add_array($tpl_data);

        if (count($_POST) > 0) {
            $this->form_validation->set_rules('name', lang('Your name', 'feedback'), 'trim|required|min_length[3]|max_length[' . $this->username_max_len . ']|xss_clean');
            $this->form_validation->set_rules('email', lang('Email', 'feedback'), 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('theme', lang('Subject', 'feedback'), 'trim|required|max_length[' . $this->theme_max_len . ']|xss_clean');
            $this->form_validation->set_rules('message', lang('Message', 'feedback'), 'trim|required|max_length[' . $this->message_max_len . ']|xss_clean');

            if ($this->dx_auth->use_recaptcha)
                $this->form_validation->set_rules('recaptcha_response_field', lang("Protection code", 'feedback'), 'trim|xss_clean|required|callback_recaptcha_check');
            else
                $this->form_validation->set_rules('captcha', lang("Protection code", 'feedback'), 'trim|required|xss_clean|callback_captcha_check');

            if ($this->form_validation->run($this) == FALSE) { // there are errors
                $this->form_validation->set_error_delimiters("", "");
                CMSFactory\assetManager::create()->setData('validation', $this->form_validation);
            } else { // form is validate
                $this->message = strip_tags(nl2br(
                                lang('Theme', 'feedback') . ' : ' . $this->input->post('theme') .
                                lang('Name', 'feedback') . ' : ' . $this->input->post('name') .
                                lang('E-mail', 'feedback') . ' : ' . $this->input->post('email') .
                                lang('Message', 'feedback') . ' : ' . $this->input->post('message')
                ));
                $this->_send_message();
            }
        }

        CMSFactory\assetManager::create()->render('feedback');
    }

    // Send e-mail
    private function _send_message() {
        $config['charset'] = 'UTF-8';
        $config['wordwrap'] = FALSE;

        $this->load->library('email');
        $this->email->initialize($config);

        $this->email->from($this->input->post('email'), $this->input->post('name'));
        $this->email->to($this->admin_mail);

        $this->email->subject($this->input->post('theme'));
        $this->email->message($this->message);

        $this->email->send();

        CMSFactory\assetManager::create()->appendData('message_sent', TRUE);
    }

    private function load_settings() {
        $this->db->limit(1);
        $this->db->where('name', 'feedback');
        $query = $this->db->get('components')->row_array();

        $settings = unserialize($query['settings']);

        if (is_int($settings['message_max_len'])) {
            $this->message_max_len = $settings['message_max_len'];
        }

        if ($settings['email']) {
            $this->admin_mail = $settings['email'];
        }
    }

}

/* End of file sample_module.php */
