<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

use import_export\classes\Logger as LOG;

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
        $export = new \import_export\classes\Export(array(
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
        if ($export->hasErrors() == FALSE) {
            $export->getDataArray();
            if (!$this->input->is_ajax_request()) {
                $this->createFile($_POST['type'], $export);
                $this->downloadFile($_POST['type']);
                return;
            }
            if (FALSE !== $this->createFile($_POST['type'], $export)) {
                echo $_POST['type'];
                return;
            }
            echo "Error!";
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
            $customFields = SPropertiesQuery::create()->orderByPosition()->find();
            $cFieldsTemp = $customFields->toArray();
            $cFields = array();
            foreach ($cFieldsTemp as $f) {
                $cFields[] = $f['CsvName'];
            }
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
    
    /**
     * Start file downloading
     * @param string $type file type csv|xls|xlsx
     */
    protected function downloadFile($type = 'csv') {
        if (!in_array($type, array('csv', 'xls', 'xlsx'))){
            return;
        }
        $file = 'products.' . $type;
        $path = $this->uploadDir . $file;
        if (file_exists($path)) {
            $this->load->helper('download');
            $data = file_get_contents($path);
            if ($type == 'csv') {
                header('Content-type: text/csv');
            }
            force_download($file, $data);
        } else {
            LOG::create()->set('Cannot download file!');
        }
    }
    
    /**
     * Create html box with errors.
     *
     * @param  array $errors Errors array
     * @return string
     */
    protected function processErrors(array $errors) {
        $result = '';
        foreach ($errors as $err) {
            $result .= $err . '<br/>';
        }
        return '<p class="errors">' . $result . '</p>';
    }
}