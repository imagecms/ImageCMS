<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('next_level_model');
    }

    public function index() {
        $settings = $this->next_level_model->getSettings();
         \CMSFactory\assetManager::create()
                    ->registerScript('script')
                    ->setData('properties', $this->next_level_model->getProperties())
                    ->setData('property_types', $settings['propertiesTypes'])
                    ->renderAdmin('properties');
    }
    
    public function settings() {
        \CMSFactory\assetManager::create()
                ->setData('settings', $this->next_level_model->getSettings())
                ->renderAdmin('settings');
    }
    public function addPropertyType(){
        $type = $this->input->post('type');
        $propertyId = $this->input->post('propertyId');
        if($this->next_level_model->setPropertyType($propertyId, $type)){
            return 'saccess'
        }
    }

}