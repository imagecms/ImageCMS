<?php

use CMSFactory\assetManager;
use CMSFactory\ModuleSettings;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Rss Module Admin
 * @property Lib_category lib_category
 */
class Admin extends BaseAdminController
{

    public function __construct() {

        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('rss');

        $this->load->library('DX_Auth');
    }

    public function index() {

        $this->load->library('lib_category');
        $cats = $this->lib_category->build();

        $data = [
                 'cats'     => $cats,
                 'settings' => ModuleSettings::ofModule('rss')->get(),
                ];
        assetManager::create()->setData($data)->renderAdmin('settings');
    }

    /**
     *
     */
    public function settings_update() {

        ModuleSettings::ofModule('rss')->set(
            [
             'title'       => $this->input->post('title'),
             'description' => $this->input->post('description'),
             'categories'  => $this->input->post('categories'),
             'cache_ttl'   => (int) $this->input->post('cache_ttl'),
             'pages_count' => (int) $this->input->post('pages_count'),
            ]
        );

        $this->lib_admin->log(lang('RSS was edited', 'rss'));
        showMessage(lang('Changes have been saved', 'rss'));
    }

}

/* End of file admin.php */