<?php

class Categories_settings_model extends CI_Model {

    function __construct(){
        parent::__construct();
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
}
?>
