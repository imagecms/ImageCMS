<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Next_level_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getSettings() {
        $settings = $this->db->select('settings')
                ->where('identif', 'next_level')
                ->get('components')
                ->row_array();

        $settings = unserialize($settings['settings']);

        return $settings;
    }
    
     public function setSettings($settings) {
        return $this->db->where('identif', 'next_level')
                        ->update('components', array('settings' => serialize($settings)
        ));
    }

    public function getProperties() {
        return $this->db
                    ->select('shop_product_properties_i18n.id, shop_product_properties_i18n.name, mod_next_level_product_properties_types.type as type')
                    ->join('mod_next_level_product_properties_types','mod_next_level_product_properties_types.property_id=shop_product_properties_i18n.id', 'left')
                    ->get('shop_product_properties_i18n')
                    ->result_array();
    }
    public function setPropertyType($propety_id,$type) {
        $this->db->select('type')
                    ->where('property_id', $propety_id)
                    ->get('mod_next_level_product_properties_types', array('type' => $type));
         $this->db
                    ->where('property_id', $propety_id)
                    ->update('mod_next_level_product_properties_types', array('type' => $type));
         if(!$this->db->affected_rows()){
             return  $this->db
                    ->where('property_id', $propety_id)
                    ->insert('mod_next_level_product_properties_types', array('property_id' => $propety_id, 'type' => $type));
         }
    }
    
     public function deletePropertyType($del_type) {
         $settings = $this->getSettings();
         $newPropertiesTypes = $settings['propertiesTypes'];
         foreach($newPropertiesTypes as $key => $propertyType){
             if($propertyType==$del_type){
                 unset($newPropertiesTypes[$key]);
             }
         }
         
         $settings['propertiesTypes'] = $newPropertiesTypes;
         $this->setSettings($settings);
    }
    
    public function editPropertyType($oldType, $newType) {
         $settings = $this->getSettings();
         $newPropertiesTypes = $settings['propertiesTypes'];
         foreach($newPropertiesTypes as $key => $propertyType){
             if($propertyType==$oldType){
                 $newPropertiesTypes[$key] = $newType;
             }
         }
         
         $settings['propertiesTypes'] = $newPropertiesTypes;
         $this->setSettings($settings);
    }
    
    public function addType($newType){
         $settings = $this->getSettings();
         array_push($settings['propertiesTypes'], $newType);
         $this->setSettings($settings);
    }
}

?>
