<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin Class for Banners module
 * @uses BaseAdminController
 * @author L.Andriy <l.andriy@siteimage.com.ua>
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property banner_model $banner_model
 */
class Admin extends BaseAdminController {

    function __construct() {
        parent::__construct();
    }
    public function index() {
        /** Get all Banners from DB */
        /** Show Banners list */
        \CMSFactory\assetManager::create()
                ->renderAdmin('list');
    }
        public function update() {
        //Yandex market settings
        ShopCore::app()->SSettings->set('selectedProductCats', serialize($_POST['displayedCats']));
        ShopCore::app()->SSettings->set('isAdult', $_POST['yandex']['isAdult']);        
    
    }
}


/* End of file admin.php */
