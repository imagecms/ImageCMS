<?php

use CMSFactory\assetManager;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 * Star rating admin
 * @property Rating_model rating_model
 */
class Admin extends BaseAdminController
{

    public function __construct() {
        parent::__construct();
        $this->load->library('DX_Auth');
        $this->load->model('rating_model');
        $obj = new MY_Lang();
        $obj->load('star_rating');

    }

    public function index() {

        $get_settings = $this->rating_model->get_settings();
        $settings = json_decode(json_encode($get_settings), FALSE);

        $this->template->add_array(
            [
            'settings' => $settings,
            ]
        );
        assetManager::create()
                ->renderAdmin('settings');
    }

    public function update_settings() {
        $settings = json_encode($this->input->post('sr'));

        $this->rating_model->update_settings($settings);

        if ($this->input->post('action') == 'tomain') {
            pjax('/admin/components/modules_table');
        }
        $this->lib_admin->log(lang('Star rating was edited', 'star_rating'));
        showMessage(lang('Settings saved success', 'star_rating'));
    }

}