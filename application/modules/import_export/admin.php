<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

use CMSFactory\assetManager;
use import_export\classes\BaseImport as Imports;
use import_export\classes\Export;
use import_export\classes\Logger as LOG;
use import_export\classes\PriceExport;
use import_export\classes\PriceImport;

/**
 * Image CMS
 * Import_export Module Admin
 */
class Admin extends BaseAdminController
{

    /**
     * @var array
     */
    private $checkedFields = [
                              'name',
        //'url',
                              'prc',
        //'var',
                              'cat',
                              'num',
                             ];

    /**
     * @var string
     */
    private $uploadDir = './application/backups/';

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('import_export');
    }

    /**
     * Index. Render admin tpl 'settings'
     */
    public function index() {
        redirect('/admin/components/init_window/import_export/getTpl/import');
    }

    /**
     * Controller start classes import
     * @param string $method method
     */
    public function getImport($method) {
        include_once 'import.php';
        $n = new Import();
        $n->$method();

        /**
         * send notifications if changes products quantity
         */
        if (method_exists(Notificator, 'run')) {
            Notificator::run();
        }
    }

    /**
     * @return void
     */
    public function getPriceImport() {

        if (self::isPremiumCMS()) {

            $base_import = new PriceImport();

            try {
                $base_import->upload_file();
                $base_import->startPriceImport();

                showMessage(lang('import price type was success', 'import_export'));

            } catch (Exception $e) {

                showMessage($e->getMessage(), false, 'r');
            }
        }

    }

    public function getExport() {
        $postData = $this->input->post();
        $export = new Export(
            [
             'attributes'   => $postData['attribute'],
             'attributesCF' => $postData['cf'],
             'import_type'  => trim($postData['import_type']),
             'delimiter'    => trim($postData['delimiter']),
             'enclosure'    => trim($postData['enclosure']),
             'encoding'     => trim($postData['encoding']),
             'currency'     => trim($postData['currency']),
             'languages'    => trim($postData['language']),
             'selectedCats' => $postData['selectedCats'],
             'withZip'      => $postData['withZip'],
            ]
        );
        if ($export->hasErrors() == FALSE) {
            $export->getDataArray();
            if (!$this->input->is_ajax_request()) {
                $this->createFile($this->input->post('type'), $export);
                $this->downloadFile($this->input->post('type'));
                return;
            }

            if (FALSE !== $this->createFile($this->input->post('type'), $export)) {

                if ($this->input->post('withZip')) {

                    $export->addToArchive($export->resultArray);
                }

                echo $this->input->post('type');

                LOG::create()->set('Експорт завершен успешно!');
                $this->lib_admin->log(lang('Products was exported', 'import_export') . ' - ' . $this->input->post('type'));
                return;
            }
            LOG::create()->set('Ошибка при експорте!');
            echo 'Ошибка при експорте!';
        } else {
            echo $this->processErrors($export->getErrors());
        }
    }

    /**
     *
     */
    private function getLangs() {
        return $this->db->get('languages')->result();
    }

    /**
     * Select File tpl import or export
     * @param string $check (import | export)
     */
    public function getTpl($check) {
        $languages = $this->getLangs();

        $usePriceType = self::isPremiumCMS();

        switch ($check) {

            case 'import':

                assetManager::create()
                    ->setData(
                        [
                         'languages'    => $languages,
                         'usePriceType' => $usePriceType,
                        ]
                    )
                    ->registerScript('importAdmin')
                    ->renderAdmin('import');
                break;

            case 'price_import':

                assetManager::create()
                    ->setData(
                        [
                         'languages'    => $languages,
                         'usePriceType' => $usePriceType,
                        ]
                    )                    ->registerScript('price_import_export')
                    ->renderAdmin('price_import');
                break;

            case 'export' :

                $cFieldsTemp = SPropertiesQuery::create()->orderByPosition()->find()->toArray();
                $cFields = [];
                foreach ($cFieldsTemp as $f) {
                    $cFields[] = $f['CsvName'];
                }
                assetManager::create()
                    ->registerScript('importExportAdmin')
                    ->setData(
                        [
                         'languages'     => $languages,
                         'usePriceType'  => $usePriceType,
                         'attributes'    => Imports::create()->makeAttributesList()->possibleAttributes,
                         'cFields'       => $cFields,
                         'checkedFields' => $this->checkedFields,
                        ]
                    )
                    ->renderAdmin('export');

                break;
            case 'price_export':

                assetManager::create()
                    ->setData(
                        ['usePriceType' => $usePriceType]
                    )
                    ->registerScript('price_import_export')
                    ->renderAdmin('price_export');
                break;
            case 'archiveList' :

                $dir = $this->uploadDir;
                $files = [];

                if (is_dir($dir)) {

                    if (opendir($dir)) {

                        $arr = scandir($dir);

                        foreach ($arr as $str) {

                            if (strpos($str, '.zip') != FALSE) {
                                $files[] = $str;
                            }
                        }
                    }
                }
                arsort($files);
                assetManager::create()
                    ->registerScript('importExportAdmin')
                    ->setData(
                        [
                         'usePriceType' => $usePriceType,
                         'files'        => $files,
                        ]
                    )
                    ->renderAdmin('list');
                break;
        }
    }

    /**
     * Возвращает файл на скачку
     *
     */
    public function getPriceExport() {

        if (self::isPremiumCMS()) {

            $this->form_validation->set_rules('type', lang('Type', 'import_export'), 'required');

            if ($this->form_validation->run() == false) {

                echo validation_errors();
                return;
            }

            if ($this->input->is_ajax_request()) {
                $path = BACKUPFOLDER . 'product_price.' . $this->input->post('type');
                unlink($path);
            }

            $categories = $this->input->post('selectedCats');

            if ($categories === false) {

                $query = SCategoryQuery::create()
                    ->withColumn(\Map\SCategoryTableMap::COL_ID, 'id')
                    ->select(['id'])
                    ->filterByActive(true)
                    ->find();

                $categories = $query->count() > 0 ? $query->getData() : false;
                unset($query);
            }

            if ($categories == false) {
                echo lang('Categories not selected', 'import_export');
                return;
            }

            $price_export = new PriceExport();
            $price_export->setCategories($categories);
            $price_export->ExportVariantPrices();

            if (!$this->input->is_ajax_request()) {

                $price_export->downloadFile($this->input->post('type'));
                return;
            }

            echo $this->input->post('type');
            return;
        }
    }

    /**
     * File creating
     * @param string $type file type
     * @param Export $export
     * @return string file name
     */
    protected function createFile($type, $export) {
        switch ($type) {
            case 'xls':
                return $export->saveToExcelFile($this->uploadDir, 'Excel5');
                break;
            case 'xlsx':
                return $export->saveToExcelFile($this->uploadDir, 'Excel2007');
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
        if (!in_array($type, ['csv', 'xls', 'xlsx'])) {
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
            LOG::create()->set('Невозможно скачать файл!');
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

    /**
     * Delete archive with origin and additional photos
     *
     * @author Oleh
     * @param string $str
     */
    public function deleteArchive($str) {
        $dir = $this->uploadDir;
        unlink($dir . $str);
        $this->lib_admin->log(lang('Import_export backup photos was deleted', 'import_export') . ' - ' . $str);
        $this->getTpl('archiveList');
    }

    /**
     * Download ZIP with origin and additional photo
     *
     * @author Oleh
     * @param string $str
     */
    public function downloadZIP($str) {
        $path = $this->uploadDir . $str;
        $this->load->helper('download');
        if (file_exists($path)) {
            $data = file_get_contents($path);
            force_download($str, $data);
        } else {
            LOG::create()->set('Невозможно скачать архив ZIP, файт отсутствует!');
        }
    }

}