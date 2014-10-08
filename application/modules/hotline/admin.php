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
            
                if($this->installedProperties == false){
                $this->install(); 
                $this->installProperties();
                $this->installedProperties = true;}
            
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
       
        pjax( site_url() . 'admin/components/cp/hotline');
   

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
            $field['property_order'] = array(
                'type' => 'int',
            );     
            $field['category_id'] = array(
                'type' => 'int',
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

            if($empty == null){
                $categoryId = $this->input->post('category');
                $categoryId = (int)($categoryId[0]);
                
                $categoryModel = SCategoryQuery::create()->findPk((int) $categoryId);
                $properties = SPropertiesQuery::create()->joinWithI18n('ru')->filterByPropertyCategory($categoryModel)->orderByPosition()->find();
                
                $this->db->select('property_id, value');
                $this->db->where('category_id',$categoryId); 
                $this->db->order_by('property_order', 'asc'); 
                $query = $this->db->get('mod_hotline_properties');
                $arr = $query->result_array();
                
                if (count($properties) == 0){ echo "<p style='margin-left:20px;'>".lang('no properties','hotline')."</p>"; exit;}              
                if (count($arr)>0){
                    $properties1 = '';
                    foreach ($arr as $key => $value1) {
                        $properties1 .= "<div class='over' style='padding-bottom:10px; overflow:hidden; clear:both'><div  style='float:left;width:180px;'><input name='name_properties' value='" .  $value1['value'] . "' type='text' class='form-control'></div>";
                        $properties1 .= "<div  style='float:right; width:280px;'>";
                        $properties1 .= "<select style='width:200px; margin-right:10px;' name='displayedProperties'>";
                            $selected = '';
                           
                                foreach ($properties as $key => $value) {
                                    if( $value1['property_id'] == $value->getId() ){
                                        $selected='selected' ;
                                    }
                                    $properties1 .= "<option " . $selected . " value=".  $value->getId(). ">" . $value->getName()  ."</option>";
                                    $selected = '';
                                    }            
                        $properties1 .= "</select><button   type='button' class='btn btn-small btn-danger del_item'><i class='icon-trash icon-white'></i></button></div></div>"; 
                    }
                    $properties1 .= "<div class='but_clear' style='clear:both; height:10px;'></div><button type='button' class='btn btn-small btn-success empty'><i class='icon-plus-sign icon-white'></i> ".lang('Add property','hotline')."</button><br /><button style='margin-top:5px;' data-form='#settings_form_properties' type='button' class='btn btn-small btn-primary save_btn'><i class='icon-ok'></i> Сохранить</button>";
                
                    return $properties1; 
                }else{
                    $properties1 = "<div class='over' style='padding-bottom:10px; overflow:hidden; clear:both'><div  style='float:left;width:180px;'><input name='name_properties' value='' type='text' class='form-control'></div>";
                    $properties1 .= "<div  style='float:right; width:280px;'>";
                    $properties1 .= "<select style='width:200px; margin-right:10px;' name='displayedProperties'>";
                    foreach ($properties as $key => $value) {
                        $properties1 .= "<option value=".  $value->getId(). ">" . $value->getName()  ."</option>";
                    }            
                    $properties1 .= "</select><button   type='button' class='btn btn-small btn-danger del_item'><i class='icon-trash icon-white'></i></button></div></div>"; 
                    $properties1 .= "<div class='but_clear' style='clear:both; height:10px;'></div><button type='button' class='btn btn-small btn-success empty'><i class='icon-plus-sign icon-white'></i> ".lang('Add property','hotline')."</button><br /><button style='margin-top:5px;' data-form='#settings_form_properties' type='button' class='btn btn-small btn-primary save_btn'><i class='icon-ok'></i> Сохранить</button>";
                return $properties1; 
                }

            }else{
                
                $categoryId = $this->input->post('category');
                $categoryModel = SCategoryQuery::create()->findPk((int) $categoryId);
                $properties = SPropertiesQuery::create()->joinWithI18n('ru')->filterByPropertyCategory($categoryModel)->orderByPosition()->find();
            
                if (count($properties)>0){
                    $properties1 = "<div class='over' style='padding-bottom:10px; overflow:hidden; clear:both'><div  style='float:left;width:180px;'><input value='' name='name_properties' type='text' class='form-control'></div>";
                    $properties1 .= "<div  style='float:right; width:280px;'>";
                    $properties1 .= "<select style='width:200px; margin-right:10px;' name='displayedProperties'>";
                foreach ($properties as $key => $value) {
                    $properties1 .= "<option value=".  $value->getId(). ">" . $value->getName()  ."</option>";
                      }            
                $properties1 .= "</select><button   type='button' class='btn btn-small btn-danger del_item'><i class='icon-trash icon-white'></i></button></div></div>"; 
                    return $properties1; 
                }
                else{
                    echo "<p style='margin-left:20px;'>".lang('is empty!','hotline')."</p";
                }
            }
        }        
        public function setProperties() {
            
            if($this->input->post('settings_form_properties') == ''){
                  $this->db->where('category_id', $this->input->post('category'));
                  $this->db->delete('mod_hotline_properties'); 
                  return;
            }
  
            if($this->input->post('settings_form_properties')){
                           
               $total = explode('&', $this->input->post('settings_form_properties')); 
               $properties_name = array();
               $properties_id = array();
                    foreach ($total as $key => $value) {

                        if(strpos($value, 'name_properties') !== false){

                            array_push($properties_name, substr($value, strpos($value, "=") + 1));
                            
                        }
                        else{
                            
                            array_push($properties_id, substr($value, strpos($value, "=") + 1));
                        }
                    }
                    $category = $this->input->post('category');
                    $total_array = array();
                    foreach ($properties_name as $key => $value) {
                        $total_array[$key] = array(
                          'property_order' => $key , 
                          'value' => urldecode($properties_name[$key]),
                          'property_id' => $properties_id[$key],
                          'category_id' => $category,  
                        );
                        $i++;                        
                    }

                  $this->db->where('category_id', $this->input->post('category'));
                  $this->db->delete('mod_hotline_properties'); 
                  $this->db->insert_batch('mod_hotline_properties', $total_array); 

            }
                                
        }
}
/* End of file admin.php */
