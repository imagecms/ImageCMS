<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

//namespace Export;

class Export extends \ShopAdminController {
    
    // constructor params
    public $delimiter = ";";
    public $maxRowLength = 10000;
    public $file = null;
    public $currency = null;
    public $language = 'ru';
    protected $attributes = array();
    protected $attributesCF = array();
    protected $enclosure = '"';
    protected $tree = null;
    public $encoding = 'utf8';
    protected $selectedCats = array();
    protected $errors = array();
    protected $customFields = array();
    protected $completeFields = array();
    protected $productsDataTables = array(
        'shop_product_variants',
        'shop_product_variants_i18n',
        'shop_products',
        'shop_products_i18n',
        'shop_category',
        'shop_category_i18n',
        'shop_product_properties',
        'shop_product_properties_data',
        'shop_product_properties_i18n',
        'shop_brands',
        'shop_brands_i18n',
        'shop_product_images',
    );
    protected $categoriesData = NULL;
    protected $categories = NULL;
    
    
    
    public function __construct(array $settings = array()) {
        parent::__construct();
        
        $ci = &get_instance();
        $this->db = $ci->db;

        if (sizeof($settings) > 0) {
            foreach ($settings as $key => $value) {
                if (isset($this->$key))
                    $this->$key = $value;
            }
        }

        // getting attributes
        if (!count($this->attributes) > 0) {
            $this->addError('Укажите колонки для экспорта.');
        } else {
            $this->customFields = $this->getCustomFields();
            $this->completeFields = $this->getCompleteFields();
        }

        // getting tables and their fields
        $this->getTablesFields($this->productsDataTables);

        $this->categoriesData = $this->getCategoriesFromBase();

        if (key_exists('cat', $this->attributes)) {
            $this->categories = $this->getCategoriesPaths();
        }

        ini_set('max_execution_time', 900);
        set_time_limit(900);
        
    }
    
    protected function addError($msg) {
        $this->errors[] = $msg;
    }
    
    protected function getCustomFields() {
        $result = $this->db->query("SELECT `id`,`csv_name` FROM shop_product_properties");
        $customFields = array();
        foreach ($result->result() as $row) {
            $customFields[$row->id] = $row->csv_name;
        }
        return $customFields;
    }
    
    protected function getCompleteFields() {
        $abbreviations = $this->getAbbreviation();
        $completeFields = array();
        // the parameters of the products that can be transmitted through the settings designer
        if (sizeof($this->attributesCF) > 0)
            $attr = array_merge($this->attributes, $this->attributesCF);

        //a reduction of the field names and field attributes
        foreach ($this->attributes as $field => $justNumber1) {
            if (key_exists($field, $abbreviations)) {
                $completeFields[] = $abbreviations[$field];
            } elseif (in_array($field, $this->customFields)) {
                $completeFields[] = $field;
            } else {
                if ($this->skipErrors == FALSE) {
                    $this->addError('Unknown column: ' . $field);
                }
            }
        }
        return $completeFields;
    }
    
    protected function getTablesFields($tables) {
        if (!is_array($tables))
            return;
        foreach ($tables as $table) {
            $query = "DESCRIBE `{$table}`";
            $result = $this->db->query($query);
            foreach ($result->result() as $row) {
                $this->tablesFields[$table][] = $row->Field;
            }
        }
    }
    
    protected function getCategoriesFromBase() {
        $query = "
            SELECT 
                `shop_category`.`id`, 
                `shop_category`.`parent_id`, 
                `shop_category`.`full_path_ids`, 
                `shop_category_i18n`.`name`
            FROM 
                `shop_category`
            LEFT JOIN `shop_category_i18n` ON `shop_category_i18n`.`id` = `shop_category`.`id`
            WHERE 
                `shop_category_i18n`.`locale` = '{$this->language}'
        ";

        $categoriesData = array();
        $result = $this->db->query($query);
        foreach ($result->result_array() as $row) {
            $categoriesData[$row['id']] = array(
                'parent_id' => $row['parent_id'],
                'name' => $row['name'],
                'full_path_ids' => unserialize($row['full_path_ids']),
            );
        }
        return $categoriesData;
    }
    
    protected function getCategoriesPaths() {
        $categoriesPathes = array();
        foreach ($this->categoriesData as $id => $data) {
            if (is_array($data['full_path_ids']) & $data['full_path_ids'] !== FALSE) {
                $pathNames = array();
                foreach ($data['full_path_ids'] as $parentId) {
                    $pathNames[] = $this->categoriesData[$parentId]['name'];
                }
                $pathNames[] = $data['name'];
                $categoriesPathes[$data['name']] = implode("/", $pathNames);
            }
        }
        $this->categories = $categoriesPathes;
        return $categoriesPathes;
    }
    
    
    
    
    
    
    
    public function test(){
        echo "test string";
        
    }
    
    
    
}
