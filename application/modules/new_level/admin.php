<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('new_level_model');
    }

    public function index() {
        $settings = $this->new_level_model->getSettings();
         \CMSFactory\assetManager::create()
                    ->registerScript('script')
                    ->registerStyle('style')
                    ->setData('properties', $this->new_level_model->getProperties())
                    ->setData('property_types', $settings['propertiesTypes'])
                    ->renderAdmin('properties');
    }
    public function columns() {
        $settings = $this->new_level_model->getSettings();
        $categories = $this->new_level_model->getCategories();
        \CMSFactory\assetManager::create()
                ->registerStyle('style')
                 ->registerScript('script')
                ->setData('categories', $categories)
                ->setData('columnCategories', $this->new_level_model->getColumnCategories())
                ->setData('columns', $settings['columns'])
                ->renderAdmin('columns');
    }
    
    public function saveCategories(){
        $categories_ids = $this->input->post('categories_ids');
        $column = $this->input->post('column');
        $this->new_level_model->saveCategories($categories_ids, $column);
    }
    
    public function settings() {
        \CMSFactory\assetManager::create()
                  ->registerScript('script')
                ->setData('settings', $this->new_level_model->getSettings())
                ->renderAdmin('settings');
    }
    public function addPropertyType(){
        $type = $this->input->post('type');
        $propertyId = $this->input->post('propertyId');
        if($this->new_level_model->setPropertyType($propertyId, $type)){
            return 'success';
        }else{
            return 'error';
        }
    }
    
    public function deletePropertyType(){
        $type = $this->input->post('type');
        
        return $this->new_level_model->deletePropertyTypeFromSettings($type);
        
        
    }
    
    public function editPropertyType(){
        $oldType = $this->input->post('oldType');
        $newType = $this->input->post('newType');
        
        if($this->new_level_model->editPropertyType($oldType, $newType)){
            return 'success';
        }else{
            return 'error';
        }
    }
    
    public function addType(){
        $newType = $this->input->post('newType');        
        $this->new_level_model->addType($newType);
        return $this->renderNewPropertyType($newType);
    }
    
    public function renderNewPropertyType($type){
        return \CMSFactory\assetManager::create()
                    ->setData('type', $type)
                    ->render('newPropertyType',true);       
    }
    public function removePropertyType(){
        $type = $this->input->post('type');
        $propertyId = $this->input->post('propertyId');
        if($this->new_level_model->removePropertyType($propertyId, $type)){
            return 'success';
        }else{
            return 'error';
        }
    }
}