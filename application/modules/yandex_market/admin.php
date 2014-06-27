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

            $model = ShopSettingsQuery::create()
            ->filterByName('selectedProductCatsHotline')
            ->findOne();
                        
            if($model == null){   
            $model = new ShopSettings;
            $model->setName('selectedProductCatsHotline')
            ->setValue(serialize($this->input->post('displayedCatsHotline')))
            ->save();
            }
            $model = ShopSettingsQuery::create()
            ->filterByName('shopNumber')
            ->findOne();
        
           if($model == null){   
            $model = new ShopSettings;
            $model->setName('shopNumber')
            ->setValue($this->input->post('shopNumber'))
            ->save();
            }
            
            /** Get all Banners from DB */
            /** Show Banners list */
            \CMSFactory\assetManager::create()
                    ->registerScript('main')
                    ->renderAdmin('list');
            
            
        }
        public function update() {
           
        //Yandex market settings
        if($_POST['displayedCats']){
            ShopCore::app()->SSettings->set('selectedProductCats',  serialize($this->input->post('displayedCats')), false);
        }
        if($_POST['yandex']['isAdult']){
            ShopCore::app()->SSettings->set('isAdult', 1); 
        }else{
            ShopCore::app()->SSettings->set('isAdult', 0); 
        }
        //Hotline market settings
        if($_POST['displayedCatsHotline']){
                ShopCore::app()->SSettings->set('selectedProductCatsHotline',  serialize($this->input->post('displayedCatsHotline')), false);
        }   
        if($_POST['shopNumber']){
                ShopCore::app()->SSettings->set('shopNumber', $this->input->post('shopNumber'));
        }

      

   }
      public function getCatalogues() {
          $categoryId = $_POST['category'];
          $categoryId = (int)($categoryId[0]);
          
          $categoryModel = SCategoryQuery::create()->findPk((int) $categoryId);
          $properties = SPropertiesQuery::create()->joinWithI18n('ru')->filterByPropertyCategory($categoryModel)->orderByPosition()->find();

          //$properties = ShopProductPropertiesCategoriesQuery::create()->joinWith('SProperties')->joinWithI18n('ru')->filterByPropertyCategory($categoryModel)->orderByPosition()->find();
          //var_dumps_exit($properties);
          var_dump($properties);
          $properties1 = "<ul id='sortable'>";
          
          foreach ($properties as $key => $value) {
              $properties1 .= '<li>' . $value->getName()  .'<i class="icon-remove-circle"></i></li>';
           }
          $properties1 .= "</ul>";        

          return $properties1;
      }
           

}


/* End of file admin.php */
