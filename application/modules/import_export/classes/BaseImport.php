<?php

namespace import_export\classes;

use CI_DB_active_record;
use CI_Model;
use Core;
use Exception;
use import_export\classes\CategoryImport as CategoriesHandler;
use import_export\classes\ProductsImport as ProductsHandler;
use import_export\classes\PropertiesImport as PropertiesHandler;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @property Core $core
 * @property CI_DB_active_record $db
 */
class BaseImport extends CI_Model {

    /**
     * Class BaseImport
     * @var BaseImport
     */
    protected static $_instance;

    /**
     * Id currency
     * @var Int
     */
    public $currency = 2;

    /**
     * Charset
     * @var string
     */
    public $encoding = 'utf-8';

    /**
     * language
     * @var string
     */
    public $languages = 'ru';

    /**
     * language
     * @var string
     */
    public $mainLanguages;

    /**
     * Path to file
     * @var string
     */
    public $CSVsource = '';

    /**
     * CSV delimiter
     * @var string
     */
    public $delimiter = ";";

    /**
     * CSV enclosure
     * @var string
     */
    public $enclosure = '"';

    /**
     * Import type
     * @var string
     */
    public $importType = '';

    /**
     * Attributes
     * @var array
     */
    public $attributes = "";

    /**
     * The maximum number of fields
     * @var int
     */
    public $maxRowLength = 0;

    /**
     * Content
     * @var array
     */
    public $content = [];

    /**
     * Settings
     * @var array
     */
    public $settings = [];

    /**
     * Possible attributes
     * @var array
     */
    public $possibleAttributes = [];

    /**
     * Count products in CSV file
     * @var int
     */
    public $countProduct;

    public $allLanguages;

    public function __construct() {
        parent::__construct();
        $this->languages = $this->input->post('language') ? $this->input->post('language') : $this->languages;
        $this->getLangs();
    }

    private function getLangs() {
        $langs = $this->db->get('languages')->result();
        foreach ($langs as $val) {
            $this->allLanguages[] = $val->identif;
            if ($val->default == 1) {
                $this->mainLanguages = $val->identif;
            }
        }
    }

    /**
     * Start CSV Import
     * @param integer $offers The final position
     * @param integer $limit Step
     * @param integer $countProd count products
     * @return null|false
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function makeImport($offers, $limit, $countProd, $EmptyFields) {

        $this->makeAttributesList();
        if ($offers == 0) {
            $this->validateFile($offers, $limit);
        } else {
            $this->parseFile($offers, $limit);
            CategoriesHandler::loadCategories();
            ProductsHandler::create()->make($EmptyFields);
            PropertiesHandler::runProperties();
        }
        if (ImportBootstrap::noErrors()) {
            ImportBootstrap::create()->addMessage(Factor::SuccessImportCompleted . '<b>' . $countProd . '</b>', Factor::MessageTypeSuccess);
        } else {
            return FALSE;
        }
    }

    /**
     * @param string $attribute
     */
    public function attributeExist($attribute) {
        if (!$_POST['attributes']) {
            return TRUE;
        }

        $attributes = $_POST['attributes'];
        $attributes = explode(',', $attributes);
        return in_array($attribute, $attributes) ? TRUE : FALSE;
    }

    /**
     * Validate Information and parse CSV. As a goal we have $content variable with file information.
     * @param integer $offers The final position
     * @param integer $limit Step
     * @return false|null
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function validateFile($offers, $limit) {

        if (substr(sprintf('%o', fileperms(ImportBootstrap::getUploadDir())), -4) != '0777') {
            ImportBootstrap::addMessage(Factor::ErrorFolderPermission);
            return FALSE;
        }
        if (!$file = @fopen($this->CSVsource, 'r')) {
            ImportBootstrap::addMessage(Factor::ErrorFileReadError);
            return FALSE;
        }

        $row = fgetcsv($file, $this->maxRowLegth, $this->delimiter, $this->enclosure);
        //        if (!in_array('cat', $row) && !$this->attributeExist('cat')) {
        //            ImportBootstrap::addMessage(Factor::ErrorCategoryAttribute);
        //            return FALSE;
        //        }
        //        if (!in_array('name', $row) && !$this->attributeExist('name')) {
        //            ImportBootstrap::addMessage(Factor::ErrorNameAttribute);
        //            return FALSE;
        //        }
        //      Првоерка на url
        //        if (!in_array('url', $row)) {
        //            ImportBootstrap::addMessage(Factor::ErrorUrlAttribute);
        //            return FALSE;
        //        }
        if (!in_array('prc', $row) && !$this->attributeExist('prc')) {
            ImportBootstrap::addMessage(Factor::ErrorPriceAttribute);
            return FALSE;
        }
        //        if (!in_array('var', $row) && !$this->attributeExist('var')) {
        //            ImportBootstrap::addMessage(Factor::ErrorNameVariantAttribute);
        //            return FALSE;
        //        }
        if (!in_array('num', $row) && $this->importType == Factor::ImportProducts) {
            ImportBootstrap::addMessage(Factor::ErrorNumberAttribute);
            return FALSE;
        }
        if ((count($this->possibleAttributes) - count(array_diff($this->possibleAttributes, $row))) == count($this->attributes)) {
            $this->attributes = $row;
        } elseif (count($row) === count($this->attributes))
            rewind($file);
        else {
            ImportBootstrap::addMessage(Factor::ErrorPossibleAttrValues);
            return FALSE;
        }
        $this->parseFile($offers, $limit, $file);
    }

    /**
     * File parsing
     * @param integer $offers The final position
     * @param integer $limit Step
     * @param resurs $file
     * @return boolean
     */
    public function parseFile($offers, $limit, $file = false) {
        if (!$file) {
            $file = @fopen($this->CSVsource, 'r');
        }
        if ($offers > 0) {
            $positionStart = $offers - $limit;
            $cnt = 0;
            $iOffer = 0;
            while (($row = fgetcsv($file, $this->maxRowLegth, $this->delimiter, $this->enclosure)) !== false) {
                //                if ($cnt != 0) {
                //                    if ($iOffer < $positionStart) {
                //                        $iOffer++;
                //                    }else{
                //                        $this->content[] = array_combine($this->attributes, array_map('trim', $row));
                //                    }
                //                }
                //                $cnt = 1;
                //            }
                if ($cnt != 0) {
                    if ($iOffer < $positionStart) {
                        $iOffer++;
                    } else {
                        $this->content[] = array_combine($this->attributes, array_map('trim', $row));
                    }
                }
                if ($cnt >= $offers) {
                    break;
                }
                $cnt++;
            }
            //                var_dump($this->content);
        } else {
            $cnt = 0;
            while (($row = fgetcsv($file, $this->maxRowLegth, $this->delimiter, $this->enclosure)) !== false) {
                if ($cnt != 0) {
                    $this->countProduct++;
                }
                $cnt = 1;
            }
            $_SESSION['countProductsInFile'] = $this->countProduct;
        }
        fclose($file);
        return TRUE;
    }

    /**
     * Set Import Type. Must be setted before import start.
     * @return BaseImport
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function setImportType($type) {
        $this->importType = $type;
        return $this;
    }

    /**
     * Set Import Settings. Must be setted before import start.
     * @return BaseImport
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function setSettings($settings) {
        $this->settings = $settings;
        $this->attributes = array_diff(explode(',', $this->settings['attributes']), [null]);
        return $this;
    }

    /**
     * Set Import file name. Must be setted before import start.
     * @param string $fileName
     * @return BaseImport
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function setFileName($fileName) {
        try {
            if (FALSE === file_exists($fileName)) {
                throw new Exception(Factor::ErrorEmptySlot);
            }
            $this->CSVsource = $fileName;
            return $this;
        } catch (Exception $exc) {
            $result[Factor::MessageTypeSuccess] = FALSE;
            $result[Factor::MessageTypeError] = FALSE;
            $result['message'] = $exc->getMessage();
            echo json_encode($result);
            exit();
        }
    }

    /**
     * BaseImport Singleton
     * @return BaseImport
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public static function create() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * Get attributes list.
     * @return BaseImport
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function makeAttributesList() {
        if (!count($this->possibleAttributes)) {
            $this->possibleAttributes = [
                'skip' => lang('Skip column', 'import_export'),
                'name' => lang('Product Name', 'import_export'),
                'url' => lang('URL', 'import_export'),
                'prc' => lang('Price', 'import_export'),
                'oldprc' => lang('Old Price', 'import_export'),
                'stk' => lang('Amount', 'import_export'),
                'num' => lang('Article', 'import_export'),
                'var' => lang('Variant name', 'import_export'),
                'act' => lang('Active', 'import_export'),
                'hit' => lang('Hit', 'import_export'),
                'hot' => lang('Hot', 'import_export'),
                'action' => lang('Action', 'import_export'),
                'brd' => lang('Brand', 'import_export'),
                'cat' => lang('Category', 'import_export'),
                'addcats' => lang('Additional categories', 'import_export'),
                'relp' => lang('Related products', 'import_export'),
                'vimg' => lang('Main image variant', 'import_export'),
                'cur' => lang('Currencies', 'import_export'),
                'imgs' => lang('Additional images', 'import_export'),
                'shdesc' => lang('Short description', 'import_export'),
                'desc' => lang('Full description', 'import_export'),
                'mett' => lang('Meta Title', 'import_export'),
                'metd' => lang('Meta Description', 'import_export'),
                'metk' => lang('Meta Keywords', 'import_export')
            ];

            $properties = $this->db->query(
                '
                SELECT shop_product_properties.id, shop_product_properties.csv_name, shop_product_properties_i18n.name
                FROM `shop_product_properties`
                LEFT OUTER JOIN `shop_product_properties_i18n` ON shop_product_properties.id = shop_product_properties_i18n.id
                WHERE `csv_name` != "" AND shop_product_properties_i18n.locale = ?
                ',
                $this->languages
            )->result();

            foreach ($properties as $property) {
                $this->possibleAttributes[$property->csv_name] = $property->name;
            }
        }
        return $this;
    }

}