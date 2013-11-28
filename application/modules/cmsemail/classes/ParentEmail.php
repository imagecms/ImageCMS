<?php

namespace cmsemail\classes;

/**
 * Image CMS
 * Module Wishlist
 * @property \Cmsemail_model $cmsemail_model
 * @property \DX_Auth $dx_auth
 * @property \CI_URI $uri
 * @property \CI_DB_active_record $db
 * @property \CI_Input $input
 * @version 1.0 big start!
 */
class ParentEmail extends \MY_Controller {

    /**
     * Email sender name
     * @var string
     */
    protected $from;

    /**
     * Email sender email address
     * @var string
     */
    protected $from_email;

    /**
     * Receiver email
     * @var string
     */
    protected $send_to;

    /**
     * Email theme
     * @var string
     */
    protected $theme;

    /**
     * Email message
     * @var string
     */
    protected $message;

    /**
     * Mail protocol
     * @var string
     */
    protected $protocol;

    /**
     * Mail port
     * @var int
     */
    protected $port;

    /**
     * Mail content type
     * @var string
     */
    protected $type;

    /**
     * Server path to Sendmail
     * @var string
     */
    protected $mailpath;

    /**
     * Array of errors
     * @var array
     */
    public $errors = array();

    /**
     * Array of data
     * @var array
     */
    public $data_model = array();

    /**
     * List of accepted params
     * @var array
     */
    public $accepted_params = array(
        'name',
        'from',
        'from_email',
        'theme',
        'type',
        'user_message',
        'user_message_active',
        'admin_message',
        'admin_message_active',
        'admin_email',
        'description',
    );

    public function __construct() {
        parent::__construct();

        $this->load->model('../modules/cmsemail/models/cmsemail_model');
        $lang = new \MY_Lang();
        $lang->load('cmsemail');
    }

    /**
     * replace variables in patern and wrap it
     *
     * @param array $variables
     * @param string $patern
     * @return string
     */
    public function replaceVariables($patern, $variables) {
        foreach ($variables as $variable => $replase_value) {
            $patern = str_replace('$' . $variable . '$', $replase_value, $patern);
        }

        $wraper = $this->cmsemail_model->getWraper();

        if ($wraper) {
            $patern = str_replace('$content', $patern, $wraper);
        }
        return $patern;
    }

    /**
     * send email
     *
     * @param string $send_to - recepient email
     * @param string $patern_name - email patern  name
     * @param array $variables - variables to raplase in message:
     *   $variables = array('$user$' => 'UserName')
     * @return bool
     */
    public function sendEmail($send_to, $patern_name, $variables) {
        //loading CodeIgniter Email library 
        $this->load->library('email');

        //Getting settings 
        $patern_settings = $this->cmsemail_model->getPaternSettings($patern_name);
        $default_settings = $this->cmsemail_model->getSettings();

        //Prepare settings into correct array for initialize library
        if ($patern_settings) {
            foreach ($patern_settings as $key => $value) {
                if (!$value) {
                    if ($default_settings[$key]) {
                        $patern_settings[$key] = $default_settings[$key];
                    }
                }
            }
        }
        $default_settings['type'] = strtolower($patern_settings['type']);

        //Initializing library settings
        $this->_set_config($patern_settings);

        //Sending user email if active in options
        if ($patern_settings['user_message_active']) {
            $this->from_email = $patern_settings['from_email'];
            $this->from = $patern_settings['from'];
            $this->send_to = $send_to;
            $this->theme = $patern_settings['theme'];
            $this->message = $this->replaceVariables($patern_settings['user_message'], $variables);
            if (!$this->_sendEmail()) {
                $this->errors[] = lang('User message doesnt send', 'cmsemail');
            } else {
                //Registering event is success
                \CMSFactory\Events::create()->registerEvent(
                        array(
                    'from' => $this->from,
                    'from_email' => $this->from_email,
                    'send_to' => $this->send_to,
                    'theme' => $this->theme,
                    'message' => $this->message
                        ), 'ParentEmail:userSend');
                \CMSFactory\Events::runFactory();
            }
        }

        //Sending administrator email if active in options
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

            if (!$this->_sendEmail()) {
                $this->errors[] = lang('User message doesnt send', 'cmsemail');
            } else {
                //Registering event is success
                \CMSFactory\Events::create()->registerEvent(
                        array(
                    'from' => $this->from,
                    'from_email' => $this->from_email,
                    'send_to' => $this->send_to,
                    'theme' => $this->theme,
                    'message' => $this->message
                        ), 'ParentEmail:adminSend');
                \CMSFactory\Events::runFactory();
            }
        }

        //Returning status 
        if ($this->errors) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     *
     * @param array $data keys from list:
     * 'name',
     * 'from',
     * 'from_email',
     * 'theme',
     * 'type',
     * 'user_message',
     * 'user_message_active',
     * 'admin_message',
     * 'admin_message_active',
     * 'admin_email',
     * 'description'
     * @return boolean
     */
    public function create($data = array()) {
        if ($_POST) {
            $this->form_validation->set_rules('mail_name', lang('Template name', 'cmsemail'), 'required|');
            $this->form_validation->set_rules('from_email', lang('From email', 'cmsemail'), 'valid_email');
            $this->form_validation->set_rules('mail_theme', lang('Template theme', 'cmsemail'), 'required');

            if ($_POST['userMailTextRadio']) {
                $this->form_validation->set_rules('userMailText', lang('Template user mail', 'cmsemail'), 'required');
            }

            if ($_POST['adminMailTextRadio']) {
                $this->form_validation->set_rules('adminMailText', lang('Template admin mail', 'cmsemail'), 'required');
            }

            $this->form_validation->set_rules('admin_email', lang('Admin address', 'cmsemail'), 'valid_email');

            if ($this->form_validation->run($this) == FALSE) {
                $this->errors = validation_errors();
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            if (is_array($data) && !empty($data)) {
                foreach ($data as $key => $d) {
                    if (!in_array($key, $this->accepted_params)) {
                        unset($data[$key]);
                    }
                }

                $this->data_model = $data;
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    /**
     *
     * @param array $data keys from list:
     * 'name',
     * 'from',
     * 'from_email',
     * 'theme',
     * 'type',
     * 'user_message',
     * 'user_message_active',
     * 'admin_message',
     * 'admin_message_active',
     * 'admin_email',
     * 'description'
     * @param int $id ID of element
     * @return boolean
     */
    public function edit($id, $data = array()) {
        if ($_POST) {
            $this->form_validation->set_rules('from_email', lang('From email', 'cmsemail'), 'valid_email');
            $this->form_validation->set_rules('mail_theme', lang('Template theme', 'cmsemail'), 'required');

            if ($_POST['userMailTextRadio']) {
                $this->form_validation->set_rules('userMailText', lang('Template user mail', 'cmsemail'), 'required');
            }

            if ($_POST['adminMailTextRadio']) {
                $this->form_validation->set_rules('adminMailText', lang('Template admin mail', 'cmsemail'), 'required');
            }

            $this->form_validation->set_rules('admin_email', lang('Admin address', 'cmsemail'), 'valid_email');

            if ($this->form_validation->run($this) == FALSE) {
                $this->errors = validation_errors();
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            if (is_array($data) && !empty($data)) {
                foreach ($data as $key => $d) {
                    if (!in_array($key, $this->accepted_params)) {
                        unset($data[$key]);
                    }
                }

                $this->data_model = $data;
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function delete($ids) {
        $this->cmsemail_model->deleteTemplateByID($ids);
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
    private function _set_config($settings) {
        $config['protocol'] = $settings['protocol'];

        if (strtolower($settings['protocol']) == strtolower("SMTP")) {
            $config['smtp_port'] = $settings['port'];
        }

        $config['mailtype'] = strtolower($settings['type']);
        $config['mailpath'] = $settings['mailpath'];

        return $this->email->initialize($config);
    }

    /**
     * test mail sending
     *
     * @param array $config cohfiguration options for sending email:
     * 'protocol',
     * 'smtp_port',
     * 'type',
     * 'mailpath'
     */
    public function mailTest($config) {
        $this->load->library('email');
        $this->email->clear();

        $this->_set_config($config);
        $this->email->initialize($config);

        $this->email->from($this->from_email, $this->from);
        $this->email->to($this->send_to);
        $this->email->subject($this->theme);
        $this->email->message(lang('Check email sending', 'cmsemail'));

        $this->email->send();

        echo $this->email->print_debugger();
    }

    public function getAllTemplates() {
        return $this->cmsemail_model->getAllTemplates();
    }

    public function getSettings() {
        return $this->cmsemail_model->getSettings();
    }

    public function getTemplateById($id, $locale) {
        return $this->cmsemail_model->getTemplateById($id, $locale);
    }

    public function setSettings($settings) {
        return $this->cmsemail_model->setSettings($settings);
    }

    public function deleteVariable($template_id, $variable, $locale) {
        return $this->cmsemail_model->deleteVariable($template_id, $variable, $locale);
    }

    public function updateVariable($template_id, $variable, $variableNewValue, $oldVariable, $locale) {
        return $this->cmsemail_model->updateVariable($template_id, $variable, $variableNewValue, $oldVariable, $locale);
    }

    public function addVariable($template_id, $variable, $variableValue, $locale) {
        return $this->cmsemail_model->addVariable($template_id, $variable, $variableValue, $locale);
    }

    public function getTemplateVariables($template_id, $locale) {
        return $this->cmsemail_model->getTemplateVariables($template_id, $locale);
    }

}
