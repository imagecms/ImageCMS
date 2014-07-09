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
        $lang->load('module_ymarket');
    }

    public function index() {
        \CMSFactory\assetManager::create()
                ->renderAdmin('list');
    }

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

//            var_dump($_POST);
        }
    }

    public function IsAdult() {
        return $this->db->where('name', 'adult')
                ->select('value')
                ->get('mod_ymarket')
                ->row()
                ->value;
    }

    public function getSelectedCats() {
        return unserialize($this->db->where('name', 'categories')
                        ->select('value')
                        ->get('mod_ymarket')
                        ->row()
                ->value);         
    }

}
