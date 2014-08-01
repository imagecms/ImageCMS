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
        require_once 'import.php';    
        $n = new Import();
        $n->$className();
    }
    
    public function getExport(){
        require_once ('export.php');
        $export = new Export(array(
            'attributes' => $_POST['attribute'],
            'attributesCF' => $_POST['cf'],
            'import_type' => trim($_POST['import_type']),
            'delimiter' => trim($_POST['delimiter']),
            'enclosure' => trim($_POST['enclosure']),
            'encoding' => trim($_POST['encoding']),
            'currency' => trim($_POST['currency']),
            'languages' => trim($_POST['language']),
            'selectedCats' => $_POST['selectedCats']
        ));
        $export->getDataArray();
        if ($export->hasErrors() == FALSE) {
            if (!$this->input->is_ajax_request()) {
                if (trim($_POST['formed_file_type']) != "0") {
                    $this->downloadFile($_POST['formed_file_type']);
                    return;
                }
                $this->createFile($_POST['type'], $export);
                $this->downloadFile($_POST['type']);
                return;
            }
            if (FALSE !== $this->createFile($_POST['type'], $export)) {
                echo $_POST['type'];
                return;
            }
            echo "Error";
        } else {
            echo $this->processErrors($export->getErrors());
        }
    }
    
    
    public function getTpl($check){
        if($check == 'import'){
            \CMSFactory\assetManager::create()
                ->registerScript('importAdmin')
                ->renderAdmin('import');
        } 
        if($check == 'export') {
            \CMSFactory\assetManager::create()
                ->registerScript('importExportAdmin')
                ->setData('attributes',ImportCSV\BaseImport::create()->makeAttributesList()->possibleAttributes)     
                ->setData('languages',$this->languages)
                ->setData('cFields',$cFields)
                ->renderAdmin('export');
        }
    }
    
    /**
     * File creating
     * @param string $type file type
     * @param ShopExportDataBase $export
     * @return string file name
     */
    protected function createFile($type, $export) {
        switch ($type) {
            case "xls":
                return $export->saveToExcelFile($this->uploadDir, "Excel5");
                break;
            case "xlsx":
                return $export->saveToExcelFile($this->uploadDir, "Excel2007");
                break;
            default: // csv
                return $export->saveToCsvFile($this->uploadDir);
        }
    }
    
    
    public function test(){
        echo json_encode('test');
    }
}