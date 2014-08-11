<?php

/**
 * Клас призначений для експорту даних в файл форматів: csv,xlsx,xls.
 */

namespace import_export\classes;
use import_export\classes\Logger as LOG;
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Export {
    public $delimiter = ";";
    public $maxRowLength = 10000;
    public $language = 'ru';
    public $attributes = array();
    protected $attributesCF = array();
    protected $enclosure = '"';
    public $encoding = 'utf8';
    protected $selectedCats = array();
    protected $customFields = array();
    protected $completeFields = array();
    protected $errors = array();
    protected $db;
    protected $tablesFields = array();
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
    public $resultArray = NULL;
    protected $resultString = NULL;
    protected $skipErrors = FALSE;
    protected $categoriesData = NULL;
    protected $categories = NULL;
    protected $withZip = false;
    
    
    public function __construct(array $settings = array()){
        $ci = &get_instance();
        $this->db = $ci->db;
        if (sizeof($settings) > 0) {
            foreach ($settings as $key => $value) {
                if (isset($this->$key)){
                    $this->$key = $value;
                }
            }
        }
        
        $this->withZip = (bool)$settings['withZip'];
        if($this->withZip == true && $this->attributes['vimg'] != '1' && $this->attributes['imgs'] != '1'){
            $this->addError('Укажите колонки фотографий для экспорта.');
            LOG::create()->set('Укажите колонки фотографий для экспорта.');
        } 
        
        if($this->attributes['name'] != '1'){
            $this->addError('Атрибут \'Имя\' обязательний для експорта!');
            LOG::create()->set('Атрибут \'Имя\' обязательний для експорта!');
        } elseif($this->attributes['url'] != '1'){
            $this->addError('Атрибут \'URL\' обязательний для експорта!');
            LOG::create()->set('Атрибут \'URL\' обязательний для експорта!');
        } elseif($this->attributes['prc'] != '1'){
            $this->addError('Атрибут \'Цена\' обязательний для експорта!');
            LOG::create()->set('Атрибут \'Цена\' обязательний для експорта!');
        } elseif($this->attributes['var'] != '1'){
            $this->addError('Атрибут \'Имя варианта\' обязательний для експорта!');
            LOG::create()->set('Атрибут \'Имя варианта\' обязательний для експорта!');
        } elseif($this->attributes['cat'] != '1'){
            $this->addError('Атрибут \'Категория\' обязательний для експорта!');
            LOG::create()->set('Атрибут \'Категория\' обязательний для експорта!');
        } elseif($this->attributes['num'] != '1'){
            $this->addError('Атрибут \'Артикул\' обязательний для експорта!');
            LOG::create()->set('Атрибут \'Артикул\' обязательний для експорта!');
        }
        
        if (!count($this->attributes) > 0) {
            $this->addError('Укажите колонки для экспорта.');
            LOG::create()->set('No select collums for export');
        } else {
            $this->customFields = $this->getCustomFields();
            $this->completeFields = $this->getCompleteFields();
        }
        $this->getTablesFields($this->productsDataTables);
        $this->categoriesData = $this->getCategoriesFromBase();
        if (key_exists('cat', $this->attributes)) {
            $this->categories = $this->getCategoriesPaths();
        }
        ini_set('max_execution_time', 900);
        set_time_limit(900); 
    }    
    
    /**
     * Saving csv-file
     * @return string filename
     */
    public function saveToCsvFile($pathToFile) {
        $path = $pathToFile . 'products.csv';
        $this->getDataCsv();
        if (!file_exists($path)){
            LOG::create()->set('File export not exists (csv)!');
        }
        $f = fopen($path, 'w+');
        $writeResult = fwrite($f, $this->resultString);
        fclose($f);
        return $writeResult == FALSE ? FALSE : basename($path);
    }
    

    /**
     * Saving excel-file
     * @param string $type format version (Excel2007|Excel5)
     * @return string filename
     */
    public function saveToExcelFile($pathToFile, $type = "Excel5") {
        switch ($type) {
            case "Excel5":
                $path = $pathToFile . 'products.xls';
                break;
            case "Excel2007":
                $path = $pathToFile . 'products.xlsx';
                break;
            default:
                return FALSE;
        }
        if(!file_exists($path)){
            LOG::create()->set('File export not exists (xls)!');
        }
        include './application/modules/import_export/PHPExcel/PHPExcel.php';
        include './application/modules/import_export/PHPExcel/PHPExcel/IOFactory.php';
        include './application/modules/import_export/PHPExcel/PHPExcel/Writer/Excel2007.php';
        $objPHPExcel = new \PHPExcel();
        $someProductData = current($this->resultArray);
        $headerArray = array();
        $columnNumber = 0;
        foreach ($someProductData as $field => $junk) {
            if (FALSE == $abbr = $this->getAbbreviation($field)) {
                $this->addError("Error. Abbreviation not found.");
                LOG::create()->set('Error. Abbreviation not found.');
            }
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($columnNumber++, 1, $abbr);
        }
        $rowNumber = 2;
        foreach ($this->resultArray as $productData) {
            $columnNumber = 0;
            foreach ($productData as $value) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($columnNumber++, $rowNumber, $value);    //запис даних в файл рядками
            }
            $rowNumber++;
        }
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, $type);
        $objWriter->save($path);
        return basename($path);
    }

    /**
     * Getting data from DB
     * (filing $this->resultArray)
     */
    protected function getDataFromBase() {
        $query = $this->createQuery();
        $result = $this->db->query($query);
        $list = array();
        foreach ($result->result_array() as $row) {
            if ($this->categories !== NULL) {
                $row['category_name'] = $this->categories[$row['category_name']];
            }
            $list[] = $row;
        }
        if($this->attributes['imgs'] == '1'){
            foreach ($list as $key => $val) {
                $list[$key]['additional_images'] = $this->addImg($val);
            }
        }
        $this->resultArray = $list;
    }
    
    /**
     * Getting additional images
     * @param array $list
     * @return array 
     * @author Oleh
     */
    public function addImg($v) {
        $number = $v['number'];
        $productID = $this->db->where('number', $number)->get('shop_product_variants')->row()->product_id;
        $imgsAdd = $this->db->where('product_id', $productID)->get('shop_product_images')->result_array();        
        if (count($imgsAdd) > 0) {
            $imgString = '';
            foreach ($imgsAdd as $img) {
                $imgString .= $img['image_name'] . '|';
            }
            $imgString = trim($imgString, '|');
            $imgString = str_replace('||','|',$imgString);
            return $imgString;
        }
    }

    /**
     * Getting products data
     * @return array
     */
    public function getDataArray() {
        if (is_null($this->resultArray)) {
            $this->getDataFromBase();
        }
        return $this->resultArray;
    }

    /**
     * Creating csv text view
     * @return string
     */
    public function getDataCsv() {
        if (is_null($this->resultString)) {
            $fileContents = "";
            $someProductData = current($this->resultArray);
            $headerArray = array();
            foreach ($someProductData as $field => $junk) {
                if (FALSE == $abbr = $this->getAbbreviation($field)) {
                    $this->addError("Error. Abbreviation not found.");
                    LOG::create()->set('Error. Abbreviation not found.');
                }
                $headerArray[] = $abbr;
            }
            $fileContents .= $this->getCsvLine($headerArray);
            foreach ($this->resultArray as $row) {
                $fileContents .= $this->getCsvLine($row);
            }
            $this->resultString = $fileContents;
        }
        return $this->resultString;
    }

    /**
     * CSV line creating
     * @param array $dataArray
     * @return string data in quotes and separated by a comma
     */
    protected function getCsvLine($dataArray) {
        $row = "";
        foreach ($dataArray as $value) {
            $row .= $this->enclosure . str_replace($this->enclosure, $this->enclosure . $this->enclosure, $value) . $this->enclosure . $this->delimiter;
        }
        return rtrim($row, ';') . PHP_EOL;
    }

    /**
     * Creating SQL-query
     * @return string SQL-query
     */
    protected function createQuery() {
        $fieldsArray = array(); // tables and fields
        $fields = "";
        $joins = "";
        foreach ($this->completeFields as $field) {
            if (in_array(trim($field), $this->customFields)) {// this is property of product
                // mysql has no pivot, but max(if... construction helps :
                $fieldsArray[] = $this->getPropertyField(trim($field));
            } else { // this is field
                $fieldsArray[] = $this->getFullField(trim($field));
            }
        }
        foreach ($fieldsArray as $field) {
            if ($field == FALSE && $this->skipErrors == TRUE) {
                $this->addError('Error while creating query. Field missing.'); 
                LOG::create()->set('Error while creating query. Field missing.');
            }
            $fields .= $field != FALSE ? " \n {$field}, " : "";
        }
        // last comma removing
        $fields = substr($fields, 0, strlen($fields) - 2);
        $this->fields = $fields;
        // if categories are selected adding condition to query
        if (is_array($this->selectedCats) && count($this->selectedCats) > 0) {
            // to avoid query error checking if category exists
            for ($i = 0; $i < count($this->selectedCats); $i++) {
                if (!key_exists($this->selectedCats[$i], $this->categoriesData)) {
                    unset($this->selectedCats[$i]);
                }
            }
            $catIds = implode(",", $this->selectedCats);
            $selCatsCondition = " AND `shop_products`.`category_id` IN ({$catIds}) ";
        } else {
            $selCatsCondition = " ";
        }
        $query = "
            SELECT
                {$fields}
            FROM
                `shop_product_variants`
            LEFT JOIN `shop_products` ON `shop_product_variants`.`product_id` = `shop_products`.`id`
            LEFT JOIN `shop_product_variants_i18n` ON `shop_product_variants`.`id` = `shop_product_variants_i18n`.`id`
            LEFT JOIN `shop_products_i18n` ON `shop_products_i18n`.`id` = `shop_products`.`id` AND `shop_product_variants_i18n`.`locale` = `shop_products_i18n`.`locale`

            LEFT JOIN `shop_category` ON `shop_products`.`category_id` = `shop_category`.`id`
            LEFT JOIN `shop_category_i18n` ON `shop_category_i18n`.`id` = `shop_category`.`id` AND `shop_product_variants_i18n`.`locale` = `shop_category_i18n`.`locale`

            LEFT JOIN `shop_product_properties_data` ON `shop_product_properties_data`.`product_id` = `shop_product_variants`.`product_id`
            LEFT JOIN `shop_product_properties` ON `shop_product_properties`.`id` = `shop_product_properties_data`.`property_id`
            LEFT JOIN `shop_product_properties_i18n` ON `shop_product_properties_i18n`.`id` = `shop_product_properties`.`id` AND `shop_product_variants_i18n`.`locale` = `shop_product_properties_i18n`.`locale`

            LEFT JOIN `shop_brands` ON `shop_brands`.`id` = `shop_products`.`brand_id`
            LEFT JOIN `shop_brands_i18n` ON `shop_brands_i18n`.`id` = `shop_brands`.`id` AND `shop_product_variants_i18n`.`locale` = `shop_brands_i18n`.`locale`

            LEFT JOIN `shop_currencies` ON `shop_currencies`.`id` = `shop_product_variants`.`currency`

            LEFT JOIN `shop_product_images` ON `shop_product_variants`.`product_id` = `shop_product_images`.`product_id`

            WHERE  1
                AND `shop_product_variants_i18n`.`locale` = '{$this->language}'
                {$selCatsCondition}
            GROUP BY `shop_product_variants`.`id`
            ORDER BY `shop_products`.`category_id`
        ";
        return $query;
    }

    /**
     * Returns a field in a database table with him.
     * (The field can be on the table is in the format `table`. `Field` - if there are field with the same name in a different tables).
     * @param string $fieldName
     * @return FALSE|string FALSE if error or field with it table
     */
    protected function getFullField($fieldName) {
        if (preg_match("/^\`[0-9a-zA-Z\_]+\`\.\`[0-9a-zA-Z\_]+\`/i", $fieldName)) {
            return $fieldName;
        } elseif (preg_match("/^[0-9a-zA-Z\_]+$/i", $fieldName)) {
            // тільки поле
            foreach ($this->tablesFields as $table => $fieldsArray) {
                if (in_array(trim($fieldName), $fieldsArray)) {
                    return "`{$table}`.`{$fieldName}`";
                }
            }
        }
        return FALSE;
    }

    /**
     * Returns product attribute like it is field (pivot)
     * @param string $propertyName
     * @return string
     */
    protected function getPropertyField($propertyName) {
        return "GROUP_CONCAT(DISTINCT IF(`shop_product_properties_data`.`property_id` = " . array_search($propertyName, $this->customFields) . ", `shop_product_properties_data`.`value`, NULL) SEPARATOR '|') AS `{$propertyName}`";
    }

    /**
     * Returns all product properties
     * @return array
     */
    protected function getCustomFields() {
        $result = $this->db->query("SELECT `id`,`csv_name` FROM shop_product_properties");
        $customFields = array();
        foreach ($result->result() as $row) {
            $customFields[$row->id] = $row->csv_name;
        }
        return $customFields;
    }

    /**
     * Gets and merge fields and properties
     * (via constructor arrive reduction)
     * @return array
     */
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
                    LOG::create()->set('Unknown column: ' . $field);
                }
            }
        }
        return $completeFields;
    }

    /**
     * Returns field abbreviation
     * @param string $field (optional) if empty returns array of abbreviations
     */
    protected function getAbbreviation($field = NULL) {
        $abbreviationsArray = array(
            'name' => '`shop_products_i18n`.`name` as product_name', //
            'url' => 'url', //
            'oldprc' => 'old_price', //
            'prc' => 'price_in_main', //
            'stk' => 'stock', //
            'num' => 'number', //
            'var' => '`shop_product_variants_i18n`.`name` as variant_name',
            'act' => 'active', //
            'hit' => 'hit', //
            'brd' => '`shop_brands_i18n`.`name` as brand_name', //
            'modim' => 'mainModImage',
            'modis' => 'smallModImage',
            'cat' => '`shop_category_i18n`.`name` as category_name',
            'relp' => 'related_products',
            'vimg' => 'mainImage',
            'cur' => 'currency',
            'imgs' => '`shop_product_images`.`image_name` as additional_images',
            'shdesc' => 'short_description',
            'desc' => 'full_description',
            'mett' => 'meta_title',
            'metd' => 'meta_description',
            'metk' => 'meta_keywords',
            'skip' => 'skip',
        );
        if (is_null($field)) {
            return $abbreviationsArray;
        } else {
            if (in_array($field, $this->customFields)) { // properties just returns
                return $field;
            }
            foreach ($abbreviationsArray as $abbreviation => $field_) {
                if (strpos(trim($field_), trim($field)) !== FALSE) {
                    return $abbreviation;
                }
            }
        }
        return FALSE; //
    }

    /**
     * Get categories data from DB
     * @return array 
     */
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
        if(!$result){
            LOG::create()->set('Empty result for select categories!');
            return;
        }
        foreach ($result->result_array() as $row) {
            $categoriesData[$row['id']] = array(
                'parent_id' => $row['parent_id'],
                'name' => $row['name'],
                'full_path_ids' => unserialize($row['full_path_ids']),
            );
        }
        return $categoriesData;
    }

    /**
     * Gets categories pathes
     * @return string $categoriesPathes
     */
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

    /**
     * Gets filds of tables
     * @param array $tables
     */
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

    /**
     * addError
     *
     * @param mixed $msg
     * @access protected
     * @return void
     */
    protected function addError($msg) {
        $this->errors[] = $msg;
    }

    /**
     * Check for errors
     *
     * @access public
     * @return boolean
     */
    public function hasErrors() {
        if (count($this->errors) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get errors array
     *
     * @access public
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }
    
    /**
     * Add photos to ZIP
     * @access public
     * @author Oleh
     */
    
    public function addToArchive($arr){
        $zip = new \ZipArchive();
        $date = date('m_d_y');
        $time = date('G_i_s');
        $zipName = "archive_" . $date . "_" . $time . ".zip"; 
        if($zip->open('./application/modules/import_export/backups/' . $zipName, \ZipArchive::CREATE) !== TRUE){      
            LOG::create()->set("Невозможно создать zip-архив.");
        }
        foreach($arr as $key => $val){
            //вигрузка основних фотографій варіанту
            if($this->attributes['vimg'] == '1'){
                if(file_exists('./uploads/shop/products/origin/' . $val['mainImage']) && $val['mainImage'] != ""){
                    $fN = "./uploads/shop/products/origin/" . $val['mainImage'];
                    $zFN ='origin/' . $val['mainImage'];
                    $zip->addFile($fN, $zFN);
                } else {
                    LOG::create()->set("Невозможна архивация основного изображения: " . $val['mainImage']);
                }
            }
            //вигрузка додаткових фотографій продуктів
            if($this->attributes['imgs'] == '1'){
                $number = $val['number'];
                $prodId = $this->db->where('number',$number)->get('shop_product_variants')->row()->product_id;
                $imgsAdd = $this->db->where('product_id',$prodId)->get('shop_product_images')->result_array();
                if(count($imgsAdd) > 0){
                    foreach($imgsAdd as $img){
                        if(file_exists('./uploads/shop/products/origin/additional/' . $img['image_name'])){
                            $filename = "./uploads/shop/products/origin/additional/" . $img['image_name'];
                            $zipname = "origin/additional/" . $img['image_name'];
                            $zip->addFile($filename,$zipname);
                        } else {
                            LOG::create()->set("Невозможна архивация дополнительного изображения: " . $img['image_name']);
                        }
                    }
                }
            }
        }
        $zip->close();
    }
    
}
