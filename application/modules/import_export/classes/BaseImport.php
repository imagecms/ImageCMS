<?php

namespace import_export\classes;

use import_export\classes\CategoryImport as CategoriesHandler;
use import_export\classes\ProductsImport as ProductsHandler;
use import_export\classes\PropertiesImport as PropertiesHandler;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @property Core $core
 * @property CI_DB_active_record $db
 */
class BaseImport extends \CI_Model {

    protected static $_instance;
    public $currency = 2;
    public $encoding = 'utf-8';
    public $languages = 'ru';
    public $CSVsource = '';
    public $delimiter = ";";
    public $enclosure = '"';
    public $importType = '';
    public $attributes = "";
    public $maxRowLength = 1000000;
    public $content = array();
    public $settings = array();
    public $possibleAttributes = array();
    public $exportSuccessfulHandler;
    public $countProduct;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Start CSV Import
     * @return bool
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function makeImport($offers, $limit, $countProd) {

        $this->makeAttributesList();
        if($offers == 0)
            $this->validateFile($offers, $limit);
        else{
            $this->parseFile($offers, $limit);
            CategoriesHandler::loadCategories();
            ProductsHandler::create()->make();
            PropertiesHandler::runProperties();
        }
        if (ImportBootstrap::noErrors())
            ImportBootstrap::create()->addMessage(Factor::SuccessImportCompleted . '<b>' . $countProd . '</b>', Factor::MessageTypeSuccess);
        else
            return FALSE;
    }

    /**
     * Validate Information and parse CSV. As a goal we have $content variable with file information.
     * @return bool
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
        if (!in_array('cat', $row)) {
            ImportBootstrap::addMessage(Factor::ErrorCategoryAttribute);
            return FALSE;
        }
        if (!in_array('name', $row)) {
            ImportBootstrap::addMessage(Factor::ErrorNameAttribute);
            return FALSE;
        }
        if (!in_array('url', $row)) {
            ImportBootstrap::addMessage(Factor::ErrorUrlAttribute);
            return FALSE;
        }
        if (!in_array('prc', $row)) {
            ImportBootstrap::addMessage(Factor::ErrorPriceAttribute);
            return FALSE;
        }
        if (!in_array('var', $row)) {
            ImportBootstrap::addMessage(Factor::ErrorNameVariantAttribute);
            return FALSE;
        }
        if (!in_array('num', $row) && $this->importType == Factor::ImportProducts) {
            ImportBootstrap::addMessage(Factor::ErrorNumberAttribute);
            return FALSE;
        }
        if ((count($this->possibleAttributes) - count(array_diff($this->possibleAttributes, $row))) == count($this->attributes))
            $this->attributes = $row;
        elseif (count($row) === count($this->attributes))
            rewind($file);
        else {
            ImportBootstrap::addMessage(Factor::ErrorPossibleAttrValues);
            return FALSE;
        }
        $this->parseFile($offers, $limit, $file);
    }

    /**
     * 
     * @param type $offers
     * @param type $limit
     * @param resurs $file
     * @return boolean
     */
    public function parseFile($offers, $limit, $file = false) {
        if(!$file){
            $file = @fopen($this->CSVsource, 'r');
        }
        if ($offers > 0) {
            $positionStart = $offers - $limit;
            $this->maxRowLegth = $offers;
            $cnt = 0;
            $iOffer = 0;
            while (($row = fgetcsv($file, $this->maxRowLegth, $this->delimiter, $this->enclosure)) !== false) {
                if ($cnt != 0) {
                    if ($iOffer < $positionStart) {
                        $iOffer++;
                        continue;
                    }
                    $this->content[] = array_combine($this->attributes, array_map('trim', $row));
                }
                $cnt = 1;
            }
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
        $this->attributes = array_diff(explode(',', $this->settings['attributes']), array(null));
        return $this;
    }

    /**
     * Set Import file name. Must be setted before import start.
     * @return BaseImport
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function setFileName($fileName) {
        try {
            if (FALSE === file_exists($fileName))
                throw new \Exception(Factor::ErrorEmptySlot);
            $this->CSVsource = $fileName;
            return $this;
        } catch (\Exception $exc) {
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
            $this->possibleAttributes = array(
                'skip' => 'Пропустить колонку',
                'name' => 'Имя товара',
                'url' => 'URL',
                'prc' => 'Цена',
                'oldprc' => 'Старая Цена',
                'stk' => 'Количество',
                'num' => 'Артикул',
                'var' => 'Имя варианта',
                'act' => 'Активен',
                'hit' => 'Хит',
                'brd' => 'Бренд',
                'cat' => 'Категория',
                'relp' => 'Связанные товары',
//                'mimg' => 'Основное изображение',
                'vimg' => 'Основное изображение варианта',
//                'vsimg' => 'Маленькое изображение варианта',
                'cur' => 'Валюта',
//                'modim' => 'Основное изображение дополнительное',
//                'simg' => 'Маленькое изображение',
//                'modis' => 'Маленькое изображение дополнительное',
                'imgs' => 'Дополнительные изображения',
                'shdesc' => 'Краткое описание',
                'desc' => 'Полное описание',
                'mett' => 'Meta Title',
                'metd' => 'Meta Description',
                'metk' => 'Meta Keywords');

            $properties = $this->db->query('
                SELECT shop_product_properties.id, shop_product_properties.csv_name, shop_product_properties_i18n.name
                FROM `shop_product_properties`
                LEFT OUTER JOIN `shop_product_properties_i18n` ON shop_product_properties.id = shop_product_properties_i18n.id
                WHERE `csv_name` != "" AND shop_product_properties_i18n.locale = ?
                ', $this->languages)->result();

            foreach ($properties as $property) {
                $this->possibleAttributes[$property->csv_name] = $property->name;
            }
        }
        return $this;
    }
}
