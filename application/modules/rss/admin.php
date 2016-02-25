<?php

use CMSFactory\assetManager;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Rss Module Admin
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
                'cats' => $cats,
                'settings' => $this->get_settings()
            ];
        assetManager::create()->setData($data)->renderAdmin('settings');
    }

    /**
     *
     */
    public function settings_update() {

        $data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'categories' => $this->input->post('categories'),
            'cache_ttl' => (int) $this->input->post('cache_ttl'),
            'pages_count' => (int) $this->input->post('pages_count'),
        ];

        $this->db->where('name', 'rss');
        $this->db->update('components', ['settings' => serialize($data)]);

        $this->lib_admin->log(lang('RSS was edited', 'rss'));
        showMessage(lang('Changes have been saved', 'rss'));
    }

    /**
     * @return mixed
     */
    private function get_settings() {

        return $this->load->module('rss')->_load_settings();
    }

}

/* End of file admin.php */