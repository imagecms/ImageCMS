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
    
    public function getImport($className){
        require 'import.php';
        Import::eccc();
    }
    
    public function getTpl($check){
        if($check == 'import'){
            \CMSFactory\assetManager::create()
                ->renderAdmin('import');
        } else {
            \CMSFactory\assetManager::create()
                ->setData('attributes',ImportCSV\BaseImport::create()->makeAttributesList()->possibleAttributes)     
                ->setData()
                ->renderAdmin('export');
        }
    }
    

}