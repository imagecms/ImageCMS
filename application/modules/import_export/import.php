<?php

use import_export\classes\ImportBootstrap as Imp;
class Import extends ShopAdminController{
    /**
     * Fields in export that are marked by default
     * @var array
     */
    private $checkedFields = array(
        'name',
        'url',
        'prc',
        'var',
        'cat',
        'num'
    );
    private $languages = null;
    private $uploadDir = './application/modules/import_export/backups/';
    private $csvFileName = 'product_csv_1.csv';
    private $uplaodedFileInfo = array();

    public function __construct() {
        parent::__construct();
        
        \ShopController::checkVar();
        \ShopAdminController::checkVarAdmin();
        $this->languages = $this->db->get('languages')->result();
        $this->load->helper('file');
        ini_set('max_execution_time', 9000000);
        set_time_limit(9000000);
    }

        /**
     * Import products from CSV file
     * @return void
     */
    public function imports() {
        if (count($_FILES)){
            $this->saveCSVFile();
            chmod($this->uploadDir.$this->csvFileName, 0777);
            
            $path = $this->uploadDir .strtr($_FILES['userfile']['name'], array(' '=>'_'));
            if(isset($path)){
                unlink($path);
            }
        }
        
        if (count($_POST['attributes']) && $_POST['csvfile']) {
            $importSettings = $this->cache->fetch('ImportExportCache');
            if (empty($importSettings) || $importSettings['withBackup'] != $this->input->post('withBackup'))
                $this->cache->store('ImportExportCache', array('withBackup' => $this->input->post('withBackup')), '25920000');
            $result = Imp::create()->withBackup()->startProcess()->resultAsString();
            echo(json_encode($result));
        } else {
            if (!$_FILES) {

                $customFields = SPropertiesQuery::create()->orderByPosition()->find();
                $cFieldsTemp = $customFields->toArray();
                $cFields = array();
                foreach ($cFieldsTemp as $f)
                    $cFields[] = $f['CsvName'];

                $importSettings = $this->cache->fetch('ImportExportCache');
                $this->template->assign('withBackup', $importSettings['withBackup']);
                $this->configureImportProcess();
                $this->template->registerJsFile('application/modules/shop/admin/templates/system/importExportAdmin.js', 'after');
                $this->render('import', array(
                    'customFields' => SPropertiesQuery::create()->orderByPosition()->find(),
                    'languages' => $this->languages,
                    'cFields' => $cFields,
                    'currencies' => SCurrenciesQuery::create()->orderByIsDefault()->find(),
                    'attributes' => ImportCSV\BaseImport::create()->makeAttributesList()->possibleAttributes,
                    'checkedFields' => $this->checkedFields
                ));
            }
        }

        $this->cache->delete_all();

        if ($_POST['withResize']) {
            $result[content] = explode('/', trim($result['content'][0]));
            \MediaManager\Image::create()
                    ->resizeById($result['content'])
                    ->resizeByIdAdditional($result['content'], TRUE);
        }

        if ($_POST['withCurUpdate'])
            \Currency\Currency::create()->checkPrices();
    }
    
    /**
     *
     */
    private function saveCSVFile() {
        $this->takeFileName();

        $this->load->library('upload', array(
            'overwrite' => true,
            'upload_path' => $this->uploadDir,
            'allowed_types' => '*',
        ));

        $fileExt = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
        if (!in_array($fileExt, array('csv', 'xls', 'xlsx'))) {
            echo json_encode(array('error' => lang('Wrong file type. Only csv|xls|xlsx')));
            return;
        }

        if ($this->upload->do_upload('userfile')) {
            $data = $this->upload->data();

            if (($data['file_ext'] === '.xls') || ($data['file_ext'] === '.xlsx')) {
                $this->convertXLStoCSV($data['full_path']);
                unlink($this->uploadDir . $data['client_name']);
            } else {
                rename($this->uploadDir . str_replace(' ', '_', $data['client_name']), $this->uploadDir . $this->csvFileName);
            }

            $this->configureImportProcess();
        } else {
            echo json_encode(array('error' => $this->upload->display_errors()));
        }
    }
    
    private function takeFileName() {
        $fileNumber = (in_array($_POST['csvfile'], array(1, 2, 3))) ? intval($_POST['csvfile']) : 1;
        $this->csvFileName = "product_csv_$fileNumber.csv";
    }
    
    private function convertXLStoCSV($excel_file = '') {
        include './application/modules/import_export/PHPExcel/PHPExcel.php';
        include './application/modules/import_export/PHPExcel/PHPExcel/IOFactory.php';
        include './application/modules/import_export/PHPExcel/PHPExcel/Writer/Excel2007.php';
        $objReader = PHPExcel_IOFactory::createReaderForFile($excel_file);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($excel_file);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

        foreach ($sheetData as $i) {
            foreach ($i as $j) {
                $toPrint .= '"' . str_replace('"', '""', $j) . '";';
            }
            $toPrint = rtrim($toPrint, ';') . PHP_EOL;
        }
        $filename = $this->csvFileName;
        fopen($this->uploadDir . $filename, 'w+');
        if (is_writable($this->uploadDir . $filename)) {
            if (!$handle = fopen($this->uploadDir . $filename, 'w+')) {
                echo json_encode(array('error' => \ImportCSV\Factor::ErrorFolderPermission));
                exit;
            }

            write_file($this->uploadDir . $filename, $toPrint);

            fclose($handle);
        } else {
            showMessage(lang("The file {$filename} is not writable", 'admin'));
        }
    }
    
     private function configureImportProcess($vector = true) {
        if (file_exists($this->uploadDir . $this->csvFileName)) {
            $file = fopen($this->uploadDir . $this->csvFileName, 'r');
            $row = array_diff(fgetcsv($file, 10000, ";", '"'), array(null));
            fclose($file);
            $this->getFilesInfo();
            foreach ($this->uplaodedFileInfo as $file)
                $uploadedFiles[str_replace('.', '', $file['name'])] = date('d.m.y H:i', $file['date']);
            if ($vector && $this->input->is_ajax_request() && $_FILES)
                echo json_encode(array(
                    'success' => true,
                    'row' => $row,
                    'attributes' => \ImportCSV\BaseImport::create()->attributes,
                    'filesInfo' => $uploadedFiles
                ));
            else
                $this->template->add_array(array(
                    'rows' => $row,
                    'attributes' => \ImportCSV\BaseImport::create()->makeAttributesList()->possibleAttributes,
                    'filesInfo' => $uploadedFiles
                ));
        }
    }
    private function getFilesInfo($dir = null) {
        $dir = ($dir == null) ? $this->uploadDir : $dir;
        foreach (get_filenames($dir) as $file) {
            if (strpos($file, 'roduct_csv_')) {
                $this->uplaodedFileInfo[] = get_file_info($this->uploadDir . $file);
            }
        }
    }
    public function getAttributes() {
        $this->takeFileName();
        $this->configureImportProcess(false);
        \CMSFactory\assetManager::create()
                ->renderAdmin('import_attributes');
    }
}