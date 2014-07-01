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
    
        protected $installedProperties = false;
        function __construct() {
            parent::__construct();
        }
        public function index() {
            
                if($this->db->get('mod_hotline_categories') == false){
                    $this->install();
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
                $this->db->set('value', serialize($this->input->post('displayedCats')));
                $this->db->where('id', 1);
                $this->db->update('mod_hotline_categories'); 
          
        }else{
                $this->db->set('value', '');
                $this->db->where('id', 1);
                $this->db->update('mod_hotline_categories'); 
        }
   

   }
   
        private function install() {
            $this->load->dbforge();
            $field['value'] = array(
                'type' => 'text',
            );
            $this->dbforge->add_field('id');
            $this->dbforge->add_field($field);
            $this->dbforge->create_table('mod_hotline_categories'); 
            $this->db->set('value', '');
            $this->db->insert('mod_hotline_categories'); 
        } 
        private function installProperties() {
            $this->load->dbforge();
            $field['value'] = array(
                'type' => 'text',
            );
            $field['property_id'] = array(
                'type' => 'int',
            );
            $field['property_value'] = array(
                'type' => 'text',
            );            
            $this->dbforge->add_field('id');
            $this->dbforge->add_field($field);
            $this->dbforge->create_table('mod_hotline_properties'); 
            $this->db->set('value', '');
            $this->db->insert('mod_hotline_properties'); 
        }
        public function getSelectedCats()
        {
            $this->db->select('value');
            $this->db->where('id', 1); 
            $query = $this->db->get('mod_hotline_categories');
            $arr = $query->row_array();
            $arr = unserialize($arr['value']);
                return $arr;
        } 
        public function getProperties($empty = null) {
            if($this->installedProperties == false){
               $this->installProperties();
               $this->installedProperties = true;
            }
            if($empty == null){
                $categoryId = $this->input->post('category');
                $categoryId = (int)($categoryId[0]);
                
                $categoryModel = SCategoryQuery::create()->findPk((int) $categoryId);
                $properties = SPropertiesQuery::create()->joinWithI18n('ru')->filterByPropertyCategory($categoryModel)->orderByPosition()->find();
                if (count($properties)>0){
                    $properties1 = "<div  style='float:left;width:180px;'><input name='name_properties' value='' type='text' class='form-control'></div>";
                    $properties1 .= "<div  style='float:right; width:180px;'>";
                    $properties1 .= "<select  name='displayedProperties'>";
                foreach ($properties as $key => $value) {
                    $properties1 .= "<option value=".  $value->getId(). ">" . $value->getName()  ."</option>";
                      }            
                $properties1 .= "</select></div><div class='but_clear' style='clear:both; height:10px;'></div><button type='button' class='btn btn-small btn-success empty'><i class='icon-plus-sign icon-white'></i> Add property</button><br /><button style='margin-top:5px;' data-form='#settings_form_properties' type='button' class='btn btn-small btn-primary save_btn'><i class='icon-ok'></i>Сохранить</button>"; 
                    return $properties1; 
                }
                else{
                    echo "<p style='margin-left:20px;'>is empty!</p";
                    }
            }else{
                
                $categoryId = $this->input->post('category');
                $categoryModel = SCategoryQuery::create()->findPk((int) $categoryId);
                $properties = SPropertiesQuery::create()->joinWithI18n('ru')->filterByPropertyCategory($categoryModel)->orderByPosition()->find();
                if (count($properties)>0){
                    $properties1 = "<div class='over' style='padding-top:10px; overflow:hidden; clear:both'><div  style='float:left;width:180px;'><input value='' name='name_properties' type='text' class='form-control'></div>";
                    $properties1 .= "<div  style='float:right; width:180px;'>";
                    $properties1 .= "<select  name='displayedProperties'>";
                foreach ($properties as $key => $value) {
                    $properties1 .= "<option value=".  $value->getId(). ">" . $value->getName()  ."</option>";
                      }            
                $properties1 .= "</select></div></div>"; 
                    return $properties1; 
                }
                else{
                    echo "<p style='margin-left:20px;'>is empty!</p";
                    }

            }
        }        
        public function setProperties() {
  
            if($this->input->post('settings_form_properties')){
                           
               $total = explode('&', $this->input->post('settings_form_properties')); 
               $properties_name = array();
               $properties_id = array();
                    foreach ($total as $key => $value) {

                        if(strpos($value, 'name_properties') !== false && substr($value, strpos($value, "=") + 1) != ''){

                            array_push($properties_name, substr($value, strpos($value, "=") + 1));
                        }
                        else{
                            
                            array_push($properties_id, substr($value, strpos($value, "=") + 1));
                        }
                    }
                    var_dump($properties_id); exit;
            }
                                
        }
}
/* End of file admin.php */
