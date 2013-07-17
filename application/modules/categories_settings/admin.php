<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('categories_settings_model');
    }

    public function index() {
        $settings = $this->categories_settings_model->getSettings();
        $categories = $this->categories_settings_model->getCategories();
        \CMSFactory\assetManager::create()
                 ->registerScript('scripts')
                ->setData('categories', $categories)
                ->setData('columnCategories', $this->categories_settings_model->getColumnCategories())
                ->setData('columns', $settings['columns'])
                ->renderAdmin('adminModuleInterface');
        
    }
    public function saveCategories(){
        $categories_ids = $this->input->post('categories_ids');
        $column = $this->input->post('column');
        $this->categories_settings_model->saveCategories($categories_ids, $column);
    }

        public function settings() {
//        \CMSFactory\assetManager::create()
//                  ->registerScript('script')
//                ->setData('settings', $this->new_level_model->getSettings())
//                ->renderAdmin('settings');
    }
    
}