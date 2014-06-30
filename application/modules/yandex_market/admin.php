<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin Class for Yandex.Market module
 * @uses BaseAdminController
 * @author L.Andriy <a.skavronskiy@imagecms.net>
 * @copyright (c) 2014, ImageCMS
 * @package ImageCMSModule
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
        if($_POST['displayedCats']){
            ShopCore::app()->SSettings->set('selectedProductCats',  serialize($this->input->post('displayedCats')));
        }else{
             ShopCore::app()->SSettings->set('selectedProductCats',  null );
        }
        
        if($_POST['yandex']['isAdult']){
            ShopCore::app()->SSettings->set('isAdult', 1); 
        }else{
            ShopCore::app()->SSettings->set('isAdult', 0); 
        }
   }
}
/* End of file admin.php */
