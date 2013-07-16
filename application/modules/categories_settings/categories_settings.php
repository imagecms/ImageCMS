<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Categories additional settings 
 */
class Categories_settings extends \MY_Controller {

    public function __construct() {
        parent::__construct();     
//        $this->load->model('categories_settings_model');
    }
    
    /**
     * Get category column by id
     * @param int $categoryId
     * @return int
     */
    public function getColumn($categoryId) {
       $column = $this->getCategoryColumn($categoryId);
       if ($column)
           return $column;
       else
           return 0;
    }
    
    public static function adminAutoload() {
        \CMSFactory\Events::create()->onShopCategoryPreEdit()->setListener('_extendPageSCategory');
    }
    
    /**
     * Add data on shop category edit page
     * @param type $shopCategoryData
     * @return type
     */
    public function _extendPageSCategory($shopCategoryData) {
        $shopCategoriesSettings = new Categories_settings();
        $CI = &get_instance();

        if (!$shopCategoryData)
            return;
        
        $currentCategoryId = $shopCategoryData['model']->getID();
        $view = $shopCategoriesSettings->prepareInterface($shopCategoryData['model'], $currentCategoryId);
        
        \CMSFactory\assetManager::create()
                ->appendData('moduleAdditions',$view);
    }
    
      /**
     * Prepare and return template for module 
     * @param type $data
     * @param id $categoryId
     * @return template
     */
    public function prepareInterface($data, $categoryId) {
       
        $data = array(
                'column' => $this->getColumn($categoryId),
                'categoryId' => $categoryId
                );
        if (!$data)
            $data = 0;
        return \CMSFactory\assetManager::create()
                        ->setData(array('data' => $data))
                        ->registerScript('scripts')
                        ->fetchTemplate('/admin/adminModuleInterface');
    }
    
    /**
     * Ajax save column
     */
    public function ajaxSaveColumn() {
        $categoryId = $this->input->post('categoryId');
        $column = $this->input->post('column');
        
        if ($categoryId && $column) 
            $this->saveColumn($categoryId, $column);
        else
             showMessage('Ошибка','','r');
    }
    
    /**
     * Install module
     */
    public function _install() {
        /** Create module's table * */
        ($this->dx_auth->is_admin()) OR exit;
        $this->load->dbforge();

        $fields = array(
            'category_id' => array('type' => 'INT', 'constraint' => 11),
            'column' => array('type' => 'INT', 'constraint' => 4, 'default' => 0)
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_categories_additional_settings', TRUE);

        /** Update module settings * */
        $this->db->where('name', 'categories_settings')
                ->update('components', array('autoload' => '1', 'enabled' => '1'));
    }
    
    /**
     * Deinstall module 
     */
    public function _deinstall() {
        $this->load->dbforge();
        $this->dbforge->drop_table('mod_categories_additional_settings');
    }

    
    
    
    
    
    
    
    
    /** To database */
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
    /****** ******/
}

/* End of file categories_additional_settings.php */
