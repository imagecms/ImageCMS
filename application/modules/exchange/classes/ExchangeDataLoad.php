<?php

namespace exchange\classes;

use Exception;

/**
 *
 * PROPERTIES OF OBJECT THAT CAN BE RETURN:
 *  - categories
 *  - products
 *  - variantsIds
 *  - mainCurrencyId
 *  - productCategoryData
 *  - brands
 *  - properties
 *  - propertiesData
 *  - propertiesMultipleData
 * @property-read array $categories
 * @property-read array $products
 * @property-read array $variantsIds
 * @property-read integer $mainCurrencyId
 * @property-read array $productCategoryData
 * @property-read array $brands
 * @property-read array $properties
 * @property-read array $propertiesData
 * @property-read array $propertiesMultipleData
 * @author kolia
 */
class ExchangeDataLoad
{

    /**
     *
     * @var array
     */
    private $data = [];

    /**
     *
     * @var \CI_DB_active_record
     */
    private $db;

    /**
     *
     * @var ExchangeDataLoad
     */
    private static $instance;

    protected function __construct() {

        $ci = &get_instance();
        $this->db = $ci->db;
    }

    private function __clone() {

    }

    /**
     *
     * @param string $name
     * @return array|bool|\SplFixedArray
     * @throws Exception
     */
    public function __get($name) {

        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        $methodName = 'get' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            return $this->data[$name] = $this->$methodName();
        }

        throw new Exception('Class ' . __CLASS__ . " doesn`t has property '{$name}'");
    }

    private function getBrands() {

        return $this->db->get('shop_brands_i18n')->result_array();
    }

    private function getBrandsData() {

        return $this->db->get('shop_brands')->result_array();
    }

    private function getCategories() {

        $result = $this->db->get('shop_category');
        $categories = [];
        foreach ($result->result_array() as $category) {
            $categories[$category['id']] = $category;
        }
        return $categories;
    }

    /**
     *
     * @return ExchangeDataLoad
     */
    public static function getInstance() {

        if (null === self::$instance) {
            self::$instance = new ExchangeDataLoad;
        }
        return self::$instance;
    }

    private function getMainCurrencyId() {

        $mainCurrencyId = $this->db->select('id')->where('main', 1)->get('shop_currencies')->row_array();
        if (!empty($mainCurrencyId)) {
            $mainCurrencyId = $mainCurrencyId['id'];
        } else {
            $mainCurrencyId = 1;
        }

        return $mainCurrencyId;
    }

    /**
     * Updates data If in DB was changes
     * (drops existing data and gets new from db again)
     * @param string $name
     * @return array
     */
    public function getNewData($name = NULL) {

        if (array_key_exists($name, $this->data)) {
            unset($this->data[$name]);
        }
        return $this->$name ?: []; //selecting data from db and returning it
    }

    /**
     * Returns data of category by productId
     * @param integer $productId
     * @return array category data
     */
    public function getProductCategoryData($productId) {

        $products = &$this->products;
        if (!array_key_exists($productId, $products)) {
            return FALSE;
        }
        $categoryId = $products[$productId]['category_id'];
        $categories = &$this->categories;
        if (!array_key_exists($categoryId, $categories)) {
            return FALSE;
        }
        return $categories[$categoryId];
    }

    private function getProductIds() {

        $result = $this->db->select(['id', 'external_id'])->get('shop_products');
        $products = [];
        foreach ($result->result_array() as $product) {
            if (!empty($product['external_id'])) {
                $products[$product['external_id']] = $product['id'];
            }
        }
        return $products;
    }

    private function getProducts() {

        $result = $this->db->get('shop_products');
        $products = [];
        foreach ($result->result_array() as $product) {
            if (!empty($product['external_id'])) {
                $products[$product['external_id']] = $product;
            }
        }
        return $products;
    }

    private function getProperties() {

        return $this->db->get('shop_product_properties')->result_array();
    }

    private function getPropertiesData() {

        $productTableProperties = $this->db->select('shop_product_properties_data.property_id, shop_product_property_value_i18n.value, shop_product_property_value_i18n.locale')
            ->from('shop_product_properties_data')
            ->join('shop_product_property_value', 'shop_product_properties_data.value_id = shop_product_property_value.id')
            ->join('shop_product_property_value_i18n', 'shop_product_property_value.id = shop_product_property_value_i18n.id')
            ->get()->result_array();

        $arr = [];
        foreach ($productTableProperties as $val) {
            $arr[$val['property_id'] . '_' . $val['product_id']] = $val['value'];
        }
        return $arr;
    }

    private function getVariantImages() {

        $result = $this->db->select('external_id, mainImage')->get('shop_product_variants')->result_array();
        $array = [];
        foreach ($result as $variant) {
            if (!empty($variant['external_id']) & !empty($variant['mainImage'])) {
                $array[$variant['external_id']] = $variant['mainImage'];
            }
        }
        return $array;
    }

    private function getVariantsIds() {

        $result = $this->db->select('external_id, id')->get('shop_product_variants')->result_array();
        $array = [];
        foreach ($result as $variant) {
            if (!empty($variant['external_id'])) {
                $array[$variant['external_id']] = $variant['id'];
            }
        }
        return $array;
    }

}