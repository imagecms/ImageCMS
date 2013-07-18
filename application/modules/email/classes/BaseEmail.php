<?php

namespace email\classes;

/**
 * Image CMS
 * Module Wishlist
 * @property \Wishlist_model $wishlist_model
 * @property \DX_Auth $dx_auth
 * @property \CI_URI $uri
 * @property \CI_DB_active_record $db
 * @property \CI_Input $input
 */
class BaseEmail extends \email\classes\ParentEmail {

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        if (parent::create()) {
            $data['name'] = $this->input->post('mail_name');
            $data['from'] = $this->input->post('sender_name');
            $data['from_email'] = $this->input->post('from_email');
            $data['theme'] = $this->input->post('mail_theme');
            $data['type'] = $this->input->post('mail_type');
            $data['user_message'] = $this->input->post('userMailText');
            $data['user_message_active'] = $this->input->post('userMailTextRadio');
            $data['admin_message'] = $this->input->post('adminMailText');
            $data['admin_message_active'] = $this->input->post('adminMailTextRadio');
            $data['description'] = $this->input->post('mail_desc');

            $this->email_model->create($data);
        } else {
            showMessage($this->errors);
        }
    }

    public function edit($id) {
        if (parent::edit()) {
            $data['from'] = $this->input->post('sender_name');
            $data['from_email'] = $this->input->post('from_email');
            $data['theme'] = $this->input->post('mail_theme');
            $data['type'] = $this->input->post('mail_type');
            $data['user_message'] = $this->input->post('userMailText');
            $data['user_message_active'] = $this->input->post('userMailTextRadio');
            $data['admin_message'] = $this->input->post('adminMailText');
            $data['admin_message_active'] = $this->input->post('adminMailTextRadio');
            $data['description'] = $this->input->post('mail_desc');

            $this->email_model->edit($id, $data);
        } else {
            showMessage($this->errors);
        }
    }

}

