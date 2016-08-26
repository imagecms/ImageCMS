<?php

namespace cmsemail\classes;

use CI_DB_active_record;
use CI_Input;
use CI_URI;
use Cmsemail_model;
use CMSFactory\Events;
use DX_Auth;
use MY_Controller;
use MY_Lang;

/**
 * Image CMS
 * Module Wishlist
 * @property Cmsemail_model $cmsemail_model
 * @property DX_Auth $dx_auth
 * @property CI_URI $uri
 * @property CI_DB_active_record $db
 * @property CI_Input $input
 * @version 1.0 big start!
 */
class ParentEmail extends MY_Controller
{

    /**
     * List of accepted params
     * @var array
     */
    public $accepted_params = [
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
                              ];

    /**
     * Attachment file
     * @var string
     */
    protected $attachment;

    /**
     * Array of data
     * @var array
     */
    public $data_model = [];

    /**
     * Array of errors
     * @var array
     */
    public $errors = [];

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
     * Server path to Sendmail
     * @var string
     */
    protected $mailpath;

    /**
     * Email message
     * @var string
     */
    protected $message;

    /**
     * Mail port
     * @var int
     */
    protected $port;

    /**
     * Mail protocol
     * @var string
     */
    protected $protocol;

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
     * Mail content type
     * @var string
     */
    protected $type;

    public function __construct() {
        parent::__construct();
        $this->load->model('../' . getModContDirName('cmsemail') . '/cmsemail/models/cmsemail_model');
        (new MY_Lang())->load('cmsemail');
    }

    /**
     * @param int $template_id
     * @param string $variable
     * @param string $variableValue
     * @param string $locale
     * @return object
     */
    public function addVariable($template_id, $variable, $variableValue, $locale) {
        return $this->cmsemail_model->addVariable($template_id, $variable, $variableValue, $locale);
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
    public function create($data = []) {
        if ($this->input->post()) {
            $this->form_validation->set_rules('mail_name', lang('Template name', 'cmsemail'), 'required|alpha_dash');
            $this->form_validation->set_rules('from_email', lang('From email', 'cmsemail'), 'valid_email');
            $this->form_validation->set_rules('mail_theme', lang('Template theme', 'cmsemail'), 'required');

            if ($this->input->post('userMailTextRadio')) {
                $this->form_validation->set_rules('userMailText', lang('Template user mail', 'cmsemail'), 'required');
            }

            if ($this->input->post('adminMailTextRadio')) {
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
     * @param array $ids
     * @return bool
     */
    public function delete(array $ids) {
        return $this->cmsemail_model->deleteTemplateByID($ids);
    }

    /**
     * @param int $template_id
     * @param string $variable
     * @param string $locale
     * @return bool|object
     */
    public function deleteVariable($template_id, $variable, $locale) {
        return $this->cmsemail_model->deleteVariable($template_id, $variable, $locale);
    }

    /**
     *
     * @param integer $id ID of element
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
    public function edit($id, $data = []) {
        if ($this->input->post()) {
            $this->form_validation->set_rules('from_email', lang('From email', 'cmsemail'), 'valid_email');
            $this->form_validation->set_rules('mail_theme', lang('Template theme', 'cmsemail'), 'required');

            if ($this->input->post('userMailTextRadio')) {
                $this->form_validation->set_rules('userMailText', lang('Template user mail', 'cmsemail'), 'required');
            }

            if ($this->input->post('adminMailTextRadio')) {
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
     * @return array|string
     */
    public function getAllTemplates() {
        return $this->cmsemail_model->getAllTemplates();
    }

    /**
     * @param bool|string $locale
     * @return array
     */
    public function getSettings($locale = FALSE) {
        return $this->cmsemail_model->getSettings($locale);
    }

    /**
     * @param int $id
     * @param string $locale
     * @return mixed
     */
    public function getTemplateById($id, $locale) {
        return $this->cmsemail_model->getTemplateById($id, $locale);
    }

    /**
     * @param string $template_id
     * @param string $locale
     * @return bool|mixed
     */
    public function getTemplateVariables($template_id, $locale) {
        return $this->cmsemail_model->getTemplateVariables($template_id, $locale);
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

    /**
     * send email
     *
     * @param string $send_to - recepient email
     * @param string $pattern_name - email patern  name
     * @param array $variables - variables to raplase in message:
     *   $variables = array('$user$' => 'UserName')
     * @param bool|string $attachment
     * @return bool
     */
    public function sendEmail($send_to, $pattern_name, $variables, $attachment = FALSE) {
        //loading CodeIgniter Email library
        $this->load->library('email');
        $locale = MY_Controller::getCurrentLocale();

        //Getting settings
        $pattern_settings = $this->cmsemail_model->getPaternSettings($pattern_name);
        $default_settings = $this->cmsemail_model->getSettings($locale);

        //Prepare settings into correct array for initialize library
        if ($pattern_settings) {
            foreach ($pattern_settings as $key => $value) {
                if (!$value) {
                    if ($default_settings[$key]) {
                        $pattern_settings[$key] = $default_settings[$key];
                    }
                }
            }
        }
        $default_settings['type'] = strtolower($pattern_settings['type']);
        $pattern_settings['protocol'] = $default_settings['protocol'];
        if (strtolower($default_settings['protocol']) == strtolower('SMTP')) {
            $pattern_settings['smtp_port'] = $default_settings['port'];
            $pattern_settings['smtp_host'] = $default_settings['smtp_host'];
            $pattern_settings['smtp_user'] = $default_settings['smtp_user'];
            $pattern_settings['smtp_pass'] = $default_settings['smtp_pass'];
            $pattern_settings['smtp_crypto'] = $default_settings['encryption'];
            $this->email->set_newline("\r\n");
        }

        //Initializing library settings
        $this->_set_config($pattern_settings);

        //Sending user email if active in options
        if ($pattern_settings['user_message_active']) {
            $this->from_email = $pattern_settings['from_email'];
            $this->from = $pattern_settings['from'];
            $this->send_to = $send_to;
            $this->theme = $pattern_settings['theme'];
            $this->message = $this->replaceVariables($pattern_settings['user_message'], $variables);

            if (!$this->_sendEmail()) {
                $this->errors[] = lang('User message doesnt send', 'cmsemail');
            } else {
                //Registering event is success
                Events::create()->registerEvent(
                    [
                     'from'       => $this->from,
                     'from_email' => $this->from_email,
                     'send_to'    => $this->send_to,
                     'theme'      => $this->theme,
                     'message'    => $this->message,
                    ],
                    'ParentEmail:userSend'
                );
                Events::runFactory();
            }
        }
        //Sending administrator email if active in options
        if ($pattern_settings['admin_message_active']) {
            $this->from_email = $pattern_settings['from_email'];
            $this->from = $pattern_settings['from'];

            if ($pattern_settings['admin_email']) {
                $this->send_to = $pattern_settings['admin_email'];
            } else {
                $this->send_to = $default_settings['admin_email'];
            }

            $this->theme = $pattern_settings['theme'];
            $this->message = $this->replaceVariables($pattern_settings['admin_message'], $variables);
            $this->attachment = $attachment;

            if (!$this->_sendEmail()) {
                $this->errors[] = lang('User message doesnt send', 'cmsemail');
            } else {
                //Registering event is success
                Events::create()->registerEvent(
                    [
                     'from'       => $this->from,
                     'from_email' => $this->from_email,
                     'send_to'    => $this->send_to,
                     'theme'      => $this->theme,
                     'message'    => $this->message,
                    ],
                    'ParentEmail:adminSend'
                );
                Events::runFactory();
            }
        }

        //Returning status
        return $this->errors ? FALSE : TRUE;
    }

    /**
     * set email config
     *
     * @param array $settings
     */
    private function _set_config($settings) {
        $config['protocol'] = $settings['protocol'];
        if (strtolower($settings['protocol']) == strtolower('SMTP')) {
            $config['protocol'] = strtolower($settings['protocol']);
            $config['smtp_port'] = $settings['smtp_port'];
            $config['smtp_host'] = $settings['smtp_host'];
            $config['smtp_user'] = $settings['smtp_user'];
            $config['smtp_pass'] = $settings['smtp_pass'];
            $config['smtp_crypto'] = $settings['smtp_crypto'];
        }

        $config['mailtype'] = strtolower($settings['type']);
        $config['mailpath'] = $settings['mailpath'];

        return $this->email->initialize($config);
    }

    /**
     * replace variables in patern and wrap it
     *
     * @param array $variables
     * @param string $pattern
     * @return string
     */
    public function replaceVariables($pattern, $variables) {
        foreach ($variables as $variable => $replace_value) {
            $pattern = str_replace('$' . $variable . '$', $replace_value, $pattern);
        }

        $wrapper = $this->cmsemail_model->getWraper();

        if ($wrapper) {
            $pattern = str_replace('$content', $pattern, $wrapper);
        }
        return $pattern;
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

        if ($this->attachment && file_exists($this->attachment)) {
            $this->email->attach($this->attachment);
        }

        return $this->email->send();
    }

    /**
     * @param array $settings
     * @return bool
     */
    public function setSettings($settings) {
        return $this->cmsemail_model->setSettings($settings);
    }

    /**
     * @param int $template_id
     * @param string $variable
     * @param string $variableNewValue
     * @param string $oldVariable
     * @param string $locale
     * @return bool|object
     */
    public function updateVariable($template_id, $variable, $variableNewValue, $oldVariable, $locale) {
        return $this->cmsemail_model->updateVariable($template_id, $variable, $variableNewValue, $oldVariable, $locale);
    }

}