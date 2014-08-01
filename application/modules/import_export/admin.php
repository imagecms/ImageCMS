<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends BaseAdminController {
    
    private $languages = null;

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
    
    public function getExport($className){
        require_once 'export.php';
        /*$ex = new Export(array(
                    'attributes' => $_POST['attribute'],
                    'attributesCF' => $_POST['cf'],
                    'import_type' => trim($_POST['import_type']),
                    'delimiter' => trim($_POST['delimiter']),
                    'enclosure' => trim($_POST['enclosure']),
                    'encoding' => trim($_POST['encoding']),
                    'currency' => trim($_POST['currency']),
                    'languages' => trim($_POST['language']),
                    'selectedCats' => $_POST['selectedCats'],
                ));
        
        */
    }
    
    public function getTpl($check){
        if($check == 'import'){
            \CMSFactory\assetManager::create()
                ->renderAdmin('import');
        } else {
            $this->template->registerJsFile('application/modules/shop/admin/templates/system/importExportAdmin.js', 'after');
            \CMSFactory\assetManager::create()
                ->setData('attributes',ImportCSV\BaseImport::create()->makeAttributesList()->possibleAttributes)     
                ->setData('languages',$this->languages)
                ->setData('cFields',$cFields)
                ->renderAdmin('export');
        }
    }
    

}