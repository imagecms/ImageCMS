<?php

namespace import_export\classes;

use CI_DB_active_record;
use CI_DB_result;
use CI_Model;
use Core;
use Exception;
use import_export\classes\ProductsImport as ProductsHandler;
use My_Controller;
use SPropertyValue;
use SPropertyValueQuery;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @property Core $core
 * @property CI_DB_active_record $db
 */
class BaseImport extends CI_Model
{

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
    public $delimiter = ';';

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
    public $attributes = '';

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
        $this->languages = My_Controller::getCurrentLocale();
        $this->languages = $this->input->post('language') ?: $this->languages;
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
     * @param $EmptyFields
     * @return false|null
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
            $this->loadCategories($EmptyFields);
            ProductsHandler::create()->make($EmptyFields);
            $this->runProperties();
        }
        if (ImportBootstrap::noErrors()) {
            ImportBootstrap::create()->addMessage(Factor::SuccessImportCompleted . '<b>' . $countProd . '</b>', Factor::MessageTypeSuccess);
        } else {
            return FALSE;
        }
    }

    /**
     * @param string $attribute
     * @return bool
     */
    public function attributeExist($attribute) {
        $attributes = \CI::$APP->input->post('attributes');
        if (!$attributes) {
            return TRUE;
        }

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
        if (!in_array('num', $row) && !$this->attributeExist('prc') && $this->importType == Factor::ImportProducts) {
            ImportBootstrap::addMessage(Factor::ErrorNumberAttribute);
            return FALSE;
        }
        if ((count($this->possibleAttributes) - count(array_diff($this->possibleAttributes, $row))) == count($this->attributes)) {
            $this->attributes = $row;
        } elseif (count($row) === count($this->attributes)) {
            rewind($file);
        } else {
            ImportBootstrap::addMessage(Factor::ErrorPossibleAttrValues);
            return FALSE;
        }
        $this->parseFile($offers, $limit, $file);
    }

    /**
     * File parsing
     * @param integer $offers The final position
     * @param integer $limit Step
     * @param  $file
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
     * @param $type
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
     * @param $settings
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
                                         'skip'    => lang('Skip column', 'import_export'),
                                         'name'    => lang('Product Name', 'import_export'),
                                         'archive' => lang('Archive', 'import_export'),
                                         'url'     => lang('URL', 'import_export'),
                                         'prc'     => lang('Price', 'import_export'),
                                         'oldprc'  => lang('Old Price', 'import_export'),
                                         'stk'     => lang('Amount', 'import_export'),
                                         'num'     => lang('Article', 'import_export'),
                                         'var'     => lang('Variant name', 'import_export'),
                                         'act'     => lang('Active', 'import_export'),
                                         'hit'     => lang('Hit', 'import_export'),
                                         'hot'     => lang('Hot', 'import_export'),
                                         'action'  => lang('Action', 'import_export'),
                                         'brd'     => lang('Brand', 'import_export'),
                                         'cat'     => lang('Category', 'import_export'),
                                         'addcats' => lang('Additional categories', 'import_export'),
                                         'relp'    => lang('Related products', 'import_export'),
                                         'vimg'    => lang('Main image variant', 'import_export'),
                                         'cur'     => lang('Currencies', 'import_export'),
                                         'imgs'    => lang('Additional images', 'import_export'),
                                         'shdesc'  => lang('Short description', 'import_export'),
                                         'desc'    => lang('Full description', 'import_export'),
                                         'mett'    => lang('Meta Title', 'import_export'),
                                         'metd'    => lang('Meta Description', 'import_export'),
                                         'metk'    => lang('Meta Keywords', 'import_export'),
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

    /**
     * FROM PropertiesImport
     */

    /**
     * Process Properties Handling
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function runProperties() {
        if (ImportBootstrap::hasErrors()) {
            return FALSE;
        }
        $properties = $this->db->query('SELECT `id`, `csv_name` FROM `shop_product_properties`')->result();
        foreach ($properties as $property) {
            $properyAlias[$property->csv_name] = $property->id;
        }

        foreach ($this->content as $node) {
            foreach ($node as $nodeKey => $nodeElement) {

                if (array_key_exists($nodeKey, $properyAlias)) {
                    $result = $this->db->query('SELECT * FROM `shop_product_properties_data` WHERE `product_id` = ? AND `property_id` = ?', [$node['ProductId'], $properyAlias[$nodeKey]])->row();

                    if ($result instanceof \stdClass) {
                        $this->db->delete(
                            'shop_product_properties_data',
                            [
                             'product_id'  => $node['ProductId'],
                             'property_id' => $properyAlias[$nodeKey],
                             'locale'      => $this->languages,
                            ]
                        );
                    }
                    $values = array_map('trim', explode('|', $nodeElement));
                    foreach ($values as $v) {
                        $v = htmlspecialchars($v);
                        if ($v !== '') {

                            $property_value = SPropertyValueQuery::create()
                                ->useSPropertyValueI18nQuery()
                                    ->filterByLocale($this->languages)
                                    ->filterByValue($v)
                                ->endUse()
                                ->findOneByPropertyId($properyAlias[$nodeKey]);

                            if (!$property_value) {

                                $property_value = new SPropertyValue();
                                $property_value->setPropertyId($properyAlias[$nodeKey]);
                                $property_value->setLocale($this->languages);
                                $property_value->setValue($v);
                                $property_value->save();

                            }

                            $this->checkPropertiesData($properyAlias[$nodeKey], $node['ProductId'], $property_value->getId());

                        }
                    }

                    foreach ($node['CategoryIds'] as $categoryId) {
                        $result = $this->db->query('SELECT * FROM `shop_product_properties_categories` WHERE `category_id` = ? AND `property_id` = ?', [$categoryId, $properyAlias[$nodeKey]])->row();
                        if (!($result instanceof \stdClass) && !empty($nodeElement)) {
                            $this->db->insert('shop_product_properties_categories', ['property_id' => $properyAlias[$nodeKey], 'category_id' => $categoryId]);
                        }
                    }

                    $propery = $this->db->query(
                        '
                    SELECT `id`, `data`
                    FROM `shop_product_properties_i18n`
                    WHERE id = ? AND locale = ?',
                        [
                         $properyAlias[$nodeKey],
                         $this->languages,
                        ]
                    )->row();
                    $data = (!empty($propery->data)) ? unserialize($propery->data) : [];
                    $changed = false;
                    foreach ($values as $v) {
                        if (!in_array($v, $data, true)) {
                            $changed = true;
                            $data[] = $v;
                        }
                    }
                    if ($changed) {
                        $this->db->update('shop_product_properties_i18n', ['data' => serialize($data)], ['id' => $properyAlias[$nodeKey], 'locale' => $this->languages]);
                    }
                }
            }
        }

    }

    /**
     * @param int $property_id
     * @param int $product_id
     * @param int $value_id
     * @return bool
     */
    private function checkPropertiesData($property_id, $product_id, $value_id) {

        $import_data = [
                        'property_id' => $property_id,
                        'product_id'  => $product_id,
                        'value_id'    => $value_id,
                       ];

        /** @var CI_DB_result $test */
        $test = $this->db->get_where('shop_product_properties_data', $import_data);

        if ($test->num_rows() > 0) {
            return false;
        }

        $this->db->insert('shop_product_properties_data', $import_data);
    }

    /**
     * Add new value to custom field and save it.
     * @param mixed $name
     * @param mixed $value
     * @access public
     * @return void
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function addCustomFieldValue($name, $value) {
        if (array_key_exists($name, $this->customFieldsCache)) {
            $fieldDataArray = $this->customFieldsCache[$name]->getDataArray();

            if ($fieldDataArray === null) {
                $fieldDataArray = [];
            }

            if (!in_array($value, $fieldDataArray)) {
                array_push($fieldDataArray, $value);
                $newData = implode("\n", $fieldDataArray);
                $this->customFieldsCache[$name]->setData($newData);
                $this->customFieldsCache[$name]->save();
                $this->customFieldsCache[$name]->setVirtualColumn('dataArray', $fieldDataArray);
                $this->customFieldsCache[$name]->setData($newData);
            }
        }
    }

    /**
     * FROM CategoryImport
     */

    /**
     * Process Categories
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function loadCategories() {
        if (ImportBootstrap::hasErrors()) {
            return FALSE;
        }
        $this->load->helper('translit');
        foreach ($this->content as $key => $node) {
            if ($node['cat'] == '') {
                continue;
            }

            if (trim($node['addcats'])) {
                $cats = explode('|', $node['addcats']);
                foreach ($cats as $cat) {
                    $this->content(['cat' => $cat], $key);
                }
            }
            $this->content($node, $key);
        }
    }

    /**
     * @param string $node
     * @param string $key
     */
    private function content($node, $key) {

        $parts = $this->parseCategoryName($node['cat']);
        $pathIds = $pathNames = [];
        $parentId = $line = 0;
        foreach ($parts as $part) {
            $pathNames[] = $part;

            /* Find existing category */
            $binds = [
                      $part,
                      $this->languages,
                      $parentId,
                     ];
            //                $binds = array($part, $this->mainLanguages, $parentId);
            $result = $this->db->query(
                '
                SELECT SCategory.id as CategoryId
                FROM `shop_category_i18n` as SCategoryI18n
                RIGHT OUTER JOIN `shop_category` AS SCategory ON SCategory.id = SCategoryI18n.id
                WHERE SCategoryI18n.name = ? AND SCategoryI18n.locale = ? AND SCategory.parent_id = ?',
                $binds
            );
            if ($result) {
                $result = $result->row();
            } else {
                Logger::create()->set('Error $result in CategoryImport.php - IMPORT');
            }

            if (!($result instanceof \stdClass)) {
                /* Create new category */
                $lastPosition = $this->db->query('SELECT max(position) as maxPos FROM `shop_category`')->row()->maxPos;
                $binds = [
                          'parent_id'     => $parentId,
                          'full_path_ids' => serialize($pathIds),
                          'full_path'     => implode('/', array_map('translit_url', $pathNames)),
                          'url'           => translit_url($part),
                          'active'        => 1,
                          'position'      => $lastPosition + 1,
                         ];
                $this->db->insert('shop_category', $binds);
                $newCategoryId = $this->db->insert_id();
                if (!$newCategoryId) {
                    Logger::create()->set('Error INSERT category or SELECT id new category in CategoryImport.php - IMPORT');
                }

                /* Add translation data for new category  */
                foreach ($this->allLanguages as $val) {
                    $this->db->insert('shop_category_i18n', ['id' => $newCategoryId, 'locale' => $val, 'name' => trim($part)]);
                }

                $this->content[$key]['CategoryId'] = $pathIds[] = $parentId = $newCategoryId;
                $this->content[$key]['CategoryIds'] = $pathIds;
            } else {
                $this->content[$key]['CategoryId'] = $pathIds[] = $parentId = $result->CategoryId;
                $this->content[$key]['CategoryIds'] = $pathIds;
            }
        }
    }

    /**
     * Parse Category Name by slashes
     * @param string $name
     * @return array
     * @access private
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    private function parseCategoryName($name) {
        $result = array_map('trim', array_map('stripcslashes', preg_split('/\\REPLACE((?:[^\\\\\REPLACE]|\\\\.)*)/', $name, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY)));
        return explode('/', $result[0]);
    }

}