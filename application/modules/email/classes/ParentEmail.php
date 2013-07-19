<?php

namespace email\classes;

/**
 * Image CMS
 * Module Wishlist
 * @property \Email_model $email_model
 * @property \DX_Auth $dx_auth
 * @property \CI_URI $uri
 * @property \CI_DB_active_record $db
 * @property \CI_Input $input
 * @version 1.0 big start!
 */
class ParentEmail extends \MY_Controller {

    /**
     *
     * @var string
     */
    private $from;

    /**
     *
     * @var string
     */
    private $from_email;

    /**
     *
     * @var string
     */
    private $send_to;

    /**
     *
     * @var string
     */
    private $theme;

    /**
     *
     * @var string
     */
    private $message;

    /**
     * Array of errors
     * @var array
     */
    public $errors = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('email_model');
    }

    /**
     * replace variables in patern and wrap it
     *
     * @param array $variables
     * @param string $patern
     * @return string
     */
    public function replaceVariables($patern = 'sdfsdf %user% asdfsdf, %user% sdfsd, %user_email% fsdfsdfsdfsdf', $variables = array('%user%' => 'Mark', '%user_email%' => 'sheme4ko@mail.ru')) {
        foreach ($variables as $variable => $replase_value) {
            $patern = str_replace($variable, $replase_value, $patern);
        }

        $wraper = $this->email_model->getWraper();

        if ($wraper) {
            $patern = str_replace('$content', $patern, $wraper);
        }
        return $patern;
    }

    /**
     * send email
     *
     * @param string $send_to
     * @param string $patern_name
     * @return bool
     */
    public function sendEmail($send_to = 'send@mail.to', $patern_name = "my_patern") {
        $this->load->library('email');

        $patern_settings = $this->email_model->getPaternSettings($patern_name);
        $default_settings = $this->email_model->getSettings();

        if ($patern_settings) {
            $variables = unserialize($patern_settings['variables']);
            foreach ($patern_settings as $key => $value) {
                if (!$value) {
                    if ($default_settings[$key]) {
                        $patern_settings[$key] = $default_settings[$key];
                    }
                }
            }
        }

        $default_settings['type'] = strtolower($patern_settings['type']);

        $this->set_config($default_settings);

        if ($patern_settings['user_message_active']) {

            $this->from_email = $patern_settings['from_email'];
            $this->from = $patern_settings['from'];
            $this->send_to = $send_to;
            $this->theme = $patern_settings['theme'];
            $this->message = $this->replaceVariables($patern_settings['user_message'], $variables);
            $this->_sendEmail();
        }

        if ($patern_settings['admin_message_active']) {

            $this->from_email = $patern_settings['from_email'];
            $this->from = $patern_settings['from'];

            if ($patern_settings['admin_email']) {
                $this->send_to = $patern_settings['admin_email'];
            } else {
                $this->send_to = $default_settings['admin_email'];
            }

            $this->theme = $patern_settings['theme'];
            $this->message = $this->replaceVariables($patern_settings['admin_message'], $variables);

            $this->_sendEmail();
        }
    }

    public function create() {

        $this->form_validation->set_rules('mail_name', 'Название шаблона', 'required|xss_clean');
        $this->form_validation->set_rules('sender_name', 'От кого', 'xss_clean');
        $this->form_validation->set_rules('from_email', 'От кого(email)', 'xss_clean|valid_email');
        $this->form_validation->set_rules('mail_theme', 'Тема шаблона', 'xss_clean|required');

        if ($_POST['userMailTextRadio'] == 'YES')
            $this->form_validation->set_rules('userMailText', 'Шаблон письма пользователю', 'required|xss_clean');
        else
            $this->form_validation->set_rules('userMailText', 'Шаблон письма пользователю', 'xss_clean');

        if ($_POST['adminMailTextRadio'] == 'YES')
            $this->form_validation->set_rules('adminMailText', 'Шаблон письма администратору', 'required|xss_clean');
        else
            $this->form_validation->set_rules('adminMailText', 'Шаблон письма анминистратору', 'xss_clean');

        $this->form_validation->set_rules('admin_email', 'Адресс администратора', 'xss_clean|valid_email');

        if ($this->form_validation->run($this) == FALSE) {
            $this->errors = validation_errors();
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function edit() {
        $this->form_validation->set_rules('sender_name', 'От кого', 'xss_clean');
        $this->form_validation->set_rules('from_email', 'От кого(email)', 'xss_clean|valid_email');
        $this->form_validation->set_rules('mail_theme', 'Тема шаблона', 'xss_clean|required');

        if ($_POST['userMailTextRadio'] == 'YES')
            $this->form_validation->set_rules('userMailText', 'Шаблон письма пользователю', 'required|xss_clean');
        else
            $this->form_validation->set_rules('userMailText', 'Шаблон письма пользователю', 'xss_clean');

        if ($_POST['adminMailTextRadio'] == 'YES')
            $this->form_validation->set_rules('adminMailText', 'Шаблон письма администратору', 'required|xss_clean');
        else
            $this->form_validation->set_rules('adminMailText', 'Шаблон письма анминистратору', 'xss_clean');

        $this->form_validation->set_rules('admin_email', 'Адресс администратора', 'xss_clean|valid_email');

        if ($this->form_validation->run($this) == FALSE) {
            $this->errors = validation_errors();
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * send email
     *
     * @return bool
     */
    private function _sendEmail() {
        $this->email->from($this->from_email, $this->from);
        $this->email->to($this->send_to);
        $this->email->subject($this->theme);
        $this->email->message($this->message);
        return $this->email->send();
    }

    /**
     * set email config
     *
     * @param array $settings
     * @return bool
     */
    private function set_config($settings) {

        $config['protocol'] = $settings['protocol'];

        if (strtolower($settings['protocol']) == strtolower("SMTP")) {
            $config['smtp_port'] = $settings['port'];
        }

        $config['mailtype'] = strtolower($settings['type']);
        $config['mailpath'] = $settings['mailpath'];

        return $this->email->initialize($config);
    }

    public function mailTest() {
        $this->load->library('email');
        $this->email->clear();

        $from = $this->input->post('from');
        $from_email = $this->input->post('from_email');
        $port = $this->input->post('port');
        $protocol = $this->input->post('protocol');
        $mailpath = $this->input->post('mailpath');
        $send_to = $this->input->post('send_to');
        $theme = $this->input->post('theme');
        $type = 'text';

        $config = array('port' => $port, 'protocol' => $protocol, 'mailpath' => $mailpath, 'type' => $type);
        $this->set_config($config);

        $this->email->initialize($config);

        $this->email->from($from_email, $from);
        $this->email->to($send_to);

        $this->email->subject($theme);
        $this->email->message('Проверка отправки почты.');

        $this->email->send();

        echo $this->email->print_debugger();
    }

    public function autoload() {

    }

    public static function adminAutoload() {
        parent::adminAutoload();
    }

    public function _install() {
        $this->email_model->install();
    }

    public function _deinstall() {
        $this->email_model->deinstall();
    }

}