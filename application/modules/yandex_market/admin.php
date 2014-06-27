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
           $total_catalogues = array();
        }
        public function index() {

            $model = ShopSettingsQuery::create()
            ->filterByName('selectedProductCatsHotline')
            ->findOne();
                        
            if($model == null){   
            $model = new ShopSettings;
            $model->setName('selectedProductCatsHotline')
            ->save();
            }
            
            $model = ShopSettingsQuery::create()
            ->filterByName('shopNumber')
            ->findOne();
        
           if($model == null){   
            $model = new ShopSettings;
            $model->setName('shopNumber')
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
          $categoryId = $this->input->post('category');
          $categoryId = (int)($categoryId[0]);
          
          $categoryModel = SCategoryQuery::create()->findPk((int) $categoryId);
          $properties = SPropertiesQuery::create()->joinWithI18n('ru')->filterByPropertyCategory($categoryModel)->orderByPosition()->find();
         // var_dump($properties); exit;
          if (count($properties)>0){
          $properties1 = "<ul id='sortable'>";
          $i = 0;
          foreach ($properties as $key => $value) {
              $properties1 .= '<li id= \''. $value->getName() .'\'>' . $value->getName()  .' <i class="icon-remove-circle"></i></li>';
              $i++;
          }
          $properties1 .= "</ul><button style='margin-left:10px;' type='button' class='btn btn-small btn-primary action_on  mmm' ><i class='icon-ok'></i>Save</button>
            ";
              return $properties1; 
          }
          else{
              echo "<p style='margin-left:20px;'>is empty!</p";
              }
         
      }
      public function setCatalogues() {
            
          
            $model = ShopSettingsQuery::create()
            ->filterByName('selectedCatsHotline')
            ->findOne();
                        
            if($model == null){   
            $model1 = new ShopSettings;
            $model1->setName('selectedCatsHotline')
            ->save();
            }
            
            if($model->getValue() != null){
               
               // $total_catalogues = unserialize($model->getValue());
                
               // array_push($total_catalogues, $this->input->post('data1'));
                
                
            }
            
            
            ShopCore::app()->SSettings->set('selectedCatsHotline',  serialize(array_push($total_catalogues, $this->input->post('data1'))), false);
            
         
          
      }     

}


/* End of file admin.php */
