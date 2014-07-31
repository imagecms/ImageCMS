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
        $lang->load('import_export');
        
    }

    public function index() {
        \CMSFactory\assetManager::create()
                ->renderAdmin('settings');
    }
    
    public function getClass($param){
        if($param == 'import')
            require 'import.php';
    }
    
    public function getTpl($check){
        if($check == 'import'){
            \CMSFactory\assetManager::create()
                ->renderAdmin('import');
        } else {
            \CMSFactory\assetManager::create()
                ->renderAdmin('export');
        }
    }

}