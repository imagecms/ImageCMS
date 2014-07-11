<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('ymarket');
        $this->load->model('ymarket_model');
    }
    
    /**
     * Connects the module template in the administrative part of the site
     */
    public function index() {
        \CMSFactory\assetManager::create()
                ->renderAdmin('list');
    }
    
    /**
     * Saves the selected user categories in the table
     * @todo use $this->dx_auth->is_admin()
     * @todo to Model
     */
    public function save() {        
        if ($_POST && $_SESSION['DX_role_id'] == 1) {
            if (count($_POST['displayedCats']) > 0){
                $this->db->where('name', 'categories')
                        ->update('mod_ymarket', array('value' => serialize($_POST['displayedCats'])));
            }
            if ($_POST['adult']){
                $this->db->where('name', 'adult')
                        ->update('mod_ymarket', array('value' => mysql_real_escape_string($_POST['adult'])));
            }
            if (!$_POST['adult']){
                $this->db->where('name', 'adult')
                        ->update('mod_ymarket', array('value' => '0'));
            }
        }
    }   
    
    /**
     * Selecting categories to generate xml
     * @return obj category, check adult and ids selectet category
     */
    public function getSelectedCats() {
        $data->categories = ShopCore::app()->SCategoryTree->getTree();
        $data->ymarket_model = $this->ymarket_model->init();
//        var_dump($data);
        return $data;      
    }

}
