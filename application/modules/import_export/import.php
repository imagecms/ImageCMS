<?php

/*
 * Дополнительные фото и фото вариантов.
 * 
 * Фото вариантов должны содержаться в папку /uploads/origin/
 * Если их нет в этой папке, то производится проверка на наличие их в
 * папке /uploads/shop/products/origin/. Если там они присутствуют, то вносятся
 * в базу.
 * 
 * Дополнительные фото продукта должны содержаться в /uploads/origin/additional
 * Если их нет в этой папке, то производится проверка на наличие их в
 * папке /uploads/shop/products/origin/additional. Если там они присутствуют, 
 * то вносятся в базу.
 * 
 * Добавлены новые ошибки Factor.php:
  const ErrorUrlAttribute = "Атрибут 'URL' не указан. Error: EIx011";
  const ErrorPriceAttribute = "Атрибут 'Цена' не указан. Error: EIx012";
  const ErrorNameVariantAttribute = "Атрибут 'Имя варианта' не указан. Error: EIx013";
  const ErrorNameAttribute = "Атрибут 'Имя товара' не указан. Error: EIx010";
 * 
 * Файлы хранятся в /import_export/backups
 * Backup базы остался неизменным в /application/backups 
 * 
 * Сегментная выгрузка при первом запуске использует imports(). Так как 
 * $_POST['offers'], $_POST['limit'], $_POST['countProd'] пусты она просто
 * пересчитывает количество позиций в файле и возвращает об этом информацию.
 * Все последующие этапы используют segmentImport();
 * Количество позиций в сегменте задается в файле importAdmin.js > importSegment() > limit 
 */

use import_export\classes\ImportBootstrap as Imp;
use import_export\classes\Logger as LOG;

class Import extends ShopAdminController {

    /**
     * Folder backup
     * @var string
     * @access private
     */
    private $uploadDir = './application/modules/import_export/backups/';

    /**
     * Default csv file name
     * @var string
     * @access private
     */
    private $csvFileName = 'product_csv_1.csv';

    /**
     * Information about the files
     * @var array 
     * @access private
     */
    private $uplaodedFileInfo = array();

    public function __construct() {
        parent::__construct();
        \ShopController::checkVar();
        \ShopAdminController::checkVarAdmin();
    }

    /**
     * Helper function for unloading segment from ajax
     * @return array Status unloading
     * @access public
     */
    public function segmentImport() {
        $result = Imp::create()->startProcess($_POST['offers'], $_POST['limit'], $_POST['countProd'])->resultAsString();

        if (($_POST['offers'] >= $_POST['countProd']) && $_POST['offers']) {
            $this->resizeAndUpdatePrice($_POST['withResize'], $_POST['withCurUpdate'], $result);
            echo (json_encode($result));
        } else {
            $this->resizeAndUpdatePrice($_POST['withResize'], false, $result);
            return $result;
        }
    }

    /**
     * Import products from CSV file, resize photo, update currency, make backup db
     * @access public
     */
    public function imports() {
        chmod($this->uploadDir, 0777);
        if (count($_FILES)) {
            $this->saveCSVFile();
            chmod($this->uploadDir . $this->csvFileName, 0777);
            $path = $this->uploadDir . strtr($_FILES['userfile']['name'], array(' ' => '_'));
            if (isset($path)) {
                unlink($path);
            }
        }

        if (count($_POST['attributes']) && $_POST['csvfile']) {
            $importSettings = $this->cache->fetch('ImportExportCache');
            if (empty($importSettings) || $importSettings['withBackup'] != $this->input->post('withBackup'))
                $this->cache->store('ImportExportCache', array('withBackup' => $this->input->post('withBackup')), '25920000');
            Imp::create()->withBackup();
            $result = $this->segmentImport();
            /* for ajax */
            if (!$_POST['offers'] && $result['success']) {
                $result['propertiesSegmentImport']['countProductsInFile'] = $_SESSION['countProductsInFile'];
                $result['propertiesSegmentImport']['csvfile'] = trim($_POST['csvfile']);
                $result['propertiesSegmentImport']['delimiter'] = trim($_POST['delimiter']);
                $result['propertiesSegmentImport']['enclosure'] = trim($_POST['enclosure']);
                $result['propertiesSegmentImport']['encoding'] = trim($_POST['encoding']);
                $result['propertiesSegmentImport']['import_type'] = trim($_POST['import_type']);
                $result['propertiesSegmentImport']['language'] = trim($_POST['language']);
                $result['propertiesSegmentImport']['currency'] = trim($_POST['currency']);
                $result['propertiesSegmentImport']['withResize'] = trim($_POST['withResize']);
                $result['propertiesSegmentImport']['withCurUpdate'] = trim($_POST['withCurUpdate']);
                unset($_SESSION['countProductsInFile']);
            }
            echo(json_encode($result));
        }
        $this->cache->delete_all();
    }

    /**
     * Make resize photo and update price
     * @param bool $resize
     * @param bool $curUpdate
     * @param array $result
     * @access private
     */
    private function resizeAndUpdatePrice($resize = false, $curUpdate = false, $result = null) {
        if ($resize) {
            $result['content'] = explode('/', trim($result['content'][0]));
            \MediaManager\Image::create()
                    ->resizeById($result['content'])
                    ->resizeByIdAdditional($result['content'], TRUE);
        }

        if ($curUpdate){
            \Currency\Currency::create()->checkPrices();
        }
    }

    /**
     * Downloads the file to the backup and starts conversion function convertXLStoCSV()
     * and configureImportProcess()
     * @access public
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

    /**
     * Generate file name
     * @access private
     */
    private function takeFileName() {
        $fileNumber = (in_array($_POST['csvfile'], array(1, 2, 3))) ? intval($_POST['csvfile']) : 1;
        $this->csvFileName = "product_csv_$fileNumber.csv";
    }

    /**
     * Xls and xlsx convert to csv
     * @param string $excel_file Path to the file
     * @access private
     */
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
                echo json_encode(array('error' => import_export\classes\Factor::ErrorFolderPermission));
                exit;
            }

            write_file($this->uploadDir . $filename, $toPrint);

            fclose($handle);
        } else {
            showMessage(lang("The file {$filename} is not writable", 'admin'));
        }
    }

    /**
     * Forms the attributes of the downloaded file
     * @param bool $vector Generates attributes for ajax
     * @access private
     */
    private function configureImportProcess($vector = true) {
        if (file_exists($this->uploadDir . $this->csvFileName)) {
            $file = fopen($this->uploadDir . $this->csvFileName, 'r');
            $row = array_diff(fgetcsv($file, 1000000, ";", '"'), array(null));
            fclose($file);
            $this->getFilesInfo();
            foreach ($this->uplaodedFileInfo as $file)
                $uploadedFiles[str_replace('.', '', $file['name'])] = date('d.m.y H:i', $file['date']);
            if ($vector && $this->input->is_ajax_request() && $_FILES)
                echo json_encode(array(
                    'success' => true,
                    'row' => $row,
                    'attributes' => import_export\classes\BaseImport::create()->attributes,
                    'filesInfo' => $uploadedFiles
                ));
            else
                $this->template->add_array(array(
                    'rows' => $row,
                    'attributes' => import_export\classes\BaseImport::create()->makeAttributesList()->possibleAttributes,
                    'filesInfo' => $uploadedFiles
                ));
        }
    }

    /**
     * Information about the files
     * @param string $dir path to files
     * @access private
     */
    private function getFilesInfo($dir = null) {
        $dir = ($dir == null) ? $this->uploadDir : $dir;
        foreach (get_filenames($dir) as $file) {
            if (strpos($file, 'roduct_csv_')) {
                $this->uplaodedFileInfo[] = get_file_info($this->uploadDir . $file);
            }
        }
    }

    /**
     * Displays the attributes of a file when you select a cell
     * @access public
     */
    public function getAttributes() {
        $this->takeFileName();
        $this->configureImportProcess(false);
        \CMSFactory\assetManager::create()
                ->renderAdmin('import_attributes');
    }

    /**
     * Generates status bar imports from ajax to file
     * @access public
     */
    public function errorLog() {
        LOG::create()->set($_POST['error'] . ' - IMPORT');
    }

}
