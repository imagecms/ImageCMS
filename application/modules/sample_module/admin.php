<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $settings = $this->db->get('mod_sample_settings')->result();
        foreach ($settings as $item)
            $data[$item->name] = $item->value;
        $template = \CMSFactory\assetManager::create()
                ->setData($data)
                ->renderAdmin('index');
    }

    public function settings() {
        $this->db->update('mod_sample_settings', array('value' => $this->input->post('mailTo')), array('name' => 'mailTo'));
        $this->db->update('mod_sample_settings', array('value' => $this->input->post('useEmailNotification')), array('name' => 'useEmailNotification'));
        $this->db->update('mod_sample_settings', array('value' => $this->input->post('key')), array('name' => 'key'));
    }

}