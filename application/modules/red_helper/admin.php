<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 * @property red_helper_model $red_helper_model
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('red_helper_model');
        $lang = new MY_Lang();
        $lang->load('red_helper');
    }

    public function index() {
        $settings = $this->red_helper_model->getSettings();
        \CMSFactory\assetManager::create()
                ->registerScript('red_helper_admin')
                ->registerStyle('red_hepler')
                ->setData($settings)
                ->renderAdmin('main');
    }

    function saveSettings() {
        $this->red_helper_model->setSettings($this->input->post());
        showMessage(lang('Settings saved', 'red_helper'));
    }

}
