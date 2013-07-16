<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Categories_settings_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
     public function getSettings() {
        $settings = $this->db->select('settings')
                ->where('identif', 'categories_settings')
                ->get('components')
                ->row_array();

        $settings = unserialize($settings['settings']);

        return $settings;
    }
    
    /**
     * 
     * @return type
     */
    public function getCategories() {
       $locale = MY_Controller::getCurrentLocale();
       $categories = ShopCore::app()->SCategoryTree->getTree();
       return $categories;
    }
    
    
     public function getColumnCategories() {
        $query = $this->db->get('mod_categories_additional_settings')->result_array();
        $categories =array();
        foreach($query as $value){
            $categories[$value['column']] = unserialize($value['category_id']);
        }
        return $categories;
    }
    
    
    
    /**
     * Get category column
     * @param type $categoryId
     * @return boolean
     */
    public function getCategoryColumn($categoryId = null) {
         /** If not category id then return false */ 
        if (!$categoryId)
            return false;
        
        /** Get category column from database */
        $query = $this->db->where('category_id',$categoryId)->get('mod_categories_additional_settings')->row_array();
        
        /** Return result */
        if ($query)
            return $query['column'];
        else
            return false;
    }
    /**
     * Save or update column
     * @param int $categoryId
     * @param int $column
     */
    public function saveColumn($categoryId, $column) {
        $query = $this->db->where('category_id', $categoryId)->get('mod_categories_additional_settings')->row_array();
        
        if ($query){
            if ($this->db->where('category_id',$categoryId)->update('mod_categories_additional_settings', array('column' => $column)))
                showMessage('Сохранено');
            else
                showMessage('Ошибка','','r');
        }
        else{
            if ($this->db->insert('mod_categories_additional_settings', array('category_id' => $categoryId,'column' => $column)))
                showMessage('Сохранено');
            else
                showMessage('Ошибка','','r');
        }
    }
    public function saveCategories($categories_ids, $column){
        $this->db->where('column', $column)->update('mod_categories_additional_settings', array('category_id' => serialize($categories_ids)));
        if(!$this->db->affected_rows()){
            return $this->db
                            ->insert('mod_categories_additional_settings', array('category_id' => serialize($categories_ids), 'column' => $column));
        }
    }
}
?>
