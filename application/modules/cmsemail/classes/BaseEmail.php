<?php

namespace cmsemail\classes;

use CI_DB_active_record;
use CI_Input;
use CI_URI;
use DX_Auth;
use MY_Lang;

/**
 * Image CMS
 * Module cmsemail
 * @property DX_Auth $dx_auth
 * @property CI_URI $uri
 * @property CI_DB_active_record $db
 * @property CI_Input $input
 */
class BaseEmail extends ParentEmail
{

    /**
     * BaseEmail constructor.
     */
    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('cmsemail');
    }

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function create($params = []) {
        if (parent::create($params = [])) {
            if ($this->input->post()) {
                $data['name'] = $this->input->post('mail_name');
                $data['from'] = $this->input->post('sender_name');
                $data['from_email'] = $this->input->post('from_email');
                $data['theme'] = $this->input->post('mail_theme');
                $data['type'] = $this->input->post('mail_type');
                $data['user_message'] = $this->input->post('userMailText');
                $data['user_message_active'] = $this->input->post('userMailTextRadio');
                $data['admin_message'] = $this->input->post('adminMailText');
                $data['admin_message_active'] = $this->input->post('adminMailTextRadio');
                $data['admin_email'] = $this->input->post('admin_email');
                $data['description'] = $this->input->post('mail_desc');

                $id = $this->cmsemail_model->create($data);
            } else {
                $id = $this->cmsemail_model->create($this->data_model);
            }
            return $id;
        } else {
            return FALSE;
        }
    }

    /**
     * @param int $id
     * @param array $params
     * @param string $locale
     * @return bool
     */
    public function edit($id, $params = [], $locale) {
        if (parent::edit($id, $params = [])) {
            if ($this->input->post()) {
                $data['from'] = $this->input->post('sender_name');
                $data['from_email'] = $this->input->post('from_email');
                $data['theme'] = $this->input->post('mail_theme');
                $data['type'] = $this->input->post('mail_type');
                $data['user_message'] = $this->input->post('userMailText');
                $data['user_message_active'] = $this->input->post('userMailTextRadio');
                $data['admin_message'] = $this->input->post('adminMailText');
                $data['admin_message_active'] = $this->input->post('adminMailTextRadio');
                $data['admin_email'] = $this->input->post('admin_email');
                $data['description'] = $this->input->post('mail_desc');

                $this->cmsemail_model->edit($id, $data, $locale);
            } else {
                $this->cmsemail_model->edit($id, $this->data_model, $locale);
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * send email
     * @param string $send_to
     * @param string $pattern_name
     * @param array $variables
     * @param bool $attachment
     * @return bool
     */
    public function sendEmail($send_to, $pattern_name, array $variables, $attachment = FALSE) {
        return parent::sendEmail($send_to, $pattern_name, $variables, $attachment) ? TRUE : $this->errors;
    }

    /**
     * test email sending
     * @return string
     */
    public function mailTest() {
        if ('smtp' == strtolower($this->input->post('protocol'))) {
            $this->smtpMailTest();

            return;
        } else {
            $this->from = $this->input->post('from');
            $this->from_email = $this->input->post('from_email');
            $this->send_to = $this->input->post('send_to');
            $this->theme = $this->input->post('theme');
            $this->port = $this->input->post('port');
            $this->protocol = $this->input->post('protocol');
            $this->mailpath = $this->input->post('mailpath');
            $this->type = 'text';
            $config = ['port' => $this->port, 'protocol' => $this->protocol, 'mailpath' => $this->mailpath, 'type' => $this->type];

            return parent::mailTest($config);
        }
    }

    public function smtpMailTest() {
        $config = [
            'protocol' => 'smtp', //smtp
            'smtp_host' => $this->input->post('smtp_host'), //'smtp.gmail.com',
            'smtp_port' => $this->input->post('smtp_port'), // 587, 465
            'smtp_crypto' => $this->input->post('smtp_crypto'), //tls||ssl
            'smtp_user' => $this->input->post('smtp_user'),
            'smtp_pass' => $this->input->post('smtp_pass'),
        ];
        $this->load->library('email', $config);
        $this->email->from($this->input->post('from_email'), $this->input->post('from'));
        $this->email->to($this->input->post('send_to'));
        $this->email->subject($this->input->post('theme'));
        $this->email->message(lang('Check email sending', 'cmsemail'));
        $this->email->set_newline("\r\n");
        $this->email->send();
        echo $this->email->print_debugger();
    }

}