<?php

namespace cmsemail\classes;

/**
 * Image CMS
 * Module cmsemail
 * @property \DX_Auth $dx_auth
 * @property \CI_URI $uri
 * @property \CI_DB_active_record $db
 * @property \CI_Input $input
 */
class BaseEmail extends ParentEmail {

    public function __construct() {
        parent::__construct();
        $lang = new \MY_Lang();
        $lang->load('cmsemail');
    }

    public function create($params = array()) {
        if (parent::create($params = array())) {
            if ($_POST) {
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

                $this->cmsemail_model->create($data);
            } else {
                $this->cmsemail_model->create($this->data_model);
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit($id, $params = array(), $locale) {
        if (parent::edit($id, $params = array())) {
            if ($_POST) {
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
     * @param type $send_to
     * @param type $patern_name
     * @param type $variables
     * @return boolean
     */
    public function sendEmail($send_to, $patern_name, $variables) {
        if (parent::sendEmail($send_to, $patern_name, $variables)) {
            return TRUE;
        } else {
            return $this->errors;
        }
    }

    /**
     * test email sending
     * @return string
     */
    public function mailTest() {
        $this->from = $this->input->post('from');
        $this->from_email = $this->input->post('from_email');
        $this->send_to = $this->input->post('send_to');
        $this->theme = $this->input->post('theme');
        $this->port = $this->input->post('port');
        $this->protocol = $this->input->post('protocol');
        $this->mailpath = $this->input->post('mailpath');
        $this->type = 'text';
        $config = array('port' => $this->port, 'protocol' => $this->protocol, 'mailpath' => $this->mailpath, 'type' => $this->type);

        return parent::mailTest($config);
    }

}

