<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin Class for Mod_Discount module
 * @uses BaseAdminController
 * @author DevImageCms
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule

 */
class Admin extends BaseAdminController {

    function __construct() {
        parent::__construct();
        $this->load->model('discount_model_admin');

    }
    
    /**
    * For displaing list of discounts
    */
    public function index() {
        $data = array('discountsList' => $this->discount_model_admin->getDiscountsList());
                
        CMSFactory\assetManager::create()
                   ->setData($data)
                   ->registerStyle('style')
                   ->registerScript('adminScripts')
                   ->renderAdmin('list', true);
    }
    
    
    /**
     * Create discount
     */
    public function create() {
        $data = array('data' => 111111, 'CS' => $this->discount_model_admin->getMainCurrencySymbol());
        
        CMSFactory\assetManager::create()
                   ->setData($data)
                   ->registerStyle('style')
                   ->registerScript('adminScripts')
                   ->renderAdmin('create', true);
    }
    
    
    /**
    * Edit discount   
    */
    public function edit() {
        
    }
    
    
    /**
     * Change status(active or not)
     */
    public function ajaxChangeActive() {
       $id = $this->input->post('id');

       return $this->discount_model_admin->changeActive($id);
    }
    
}

/* End of file admin.php */
