<?php

namespace smart_filter\classes;

use CI_DB_active_record;
use Currency\Currency;
use Exception;
use MY_Controller;
use SBrandsQuery;
use ShopCore;
use SProductPropertiesDataQuery;
use SProductsQuery;
use SPropertiesQuery;

/**
 * @property CI_DB_active_record $db
 */
class Filter {

    private $ci;

    private $db;

    private $locale;

    private $model = null;

    private $sortByAdminPropVal = false;

    public function __construct($model, $getParams) {

        $this->ci = &get_instance();
        $this->db = &$this->ci->db;
        $this->locale = MY_Controller::getCurrentLocale();
        $this->get = $getParams;

        $this->filterGetParams();

        $this->formGetFromPhysicalUrl();

        $rateByFilter = Currency::create()->getRateByfilter();

        if ($this->get['lp']) {
            $this->get_lp = (int) $this->get['lp'] / $rateByFilter - 1;
        }

        if ($this->get['rp']) {
            $this->get_rp = (int) $this->get['rp'] / $rateByFilter + 1;
        }

        foreach ($this->get['p'] as $kFirst => $arrProp) {
            foreach ($arrProp as $kLast => $prop) {
                $this->get['p'][$kFirst][$kLast] = htmlspecialchars($prop);
            }
        }

        $this->propGetSelect = $this->getProductIdFromPropGet();

        if (!$model) {
            return false;
        }

        if (in_array(get_class($model), ['SCategory', 'SBrands'])) {
            $this->model = $model;
        }
    }

    /**
     *
     */
    public function formGetFromPhysicalUrl() {
        $segments = $this->ci->uri->segments;

        array_filter(
            $segments,
            function ($segment) {
                if (strstr($segment, 'brand-') || strstr($segment, 'property-')) {
                    if (strstr($segment, 'brand-')) {
                        unset($this->get['brand']);
                    }

                    if (strstr($segment, 'property-')) {
                        unset($this->get['p']);
                    }

                    $exploded = explode(';', $segment);

                    foreach ($exploded as $entity) {

                        if (strstr($entity, 'brand-')) {
                            preg_match('/brand-(.*+)/', $entity, $matches);
                            $brandURL = $matches ? $matches[1] : null;

                            if ($brandURL) {
                                $brand = SBrandsQuery::create()
                                ->filterByUrl($brandURL)
                                ->findOne();

                                if ($brand) {
                                    $this->get['brand'][] = $brand->getId();
                                }
                            }
                        }

                        if (strstr($entity, 'property-')) {
                            $startValue = strpos($entity, '-') + 1;
                            $endValue = strrpos($entity, '-') + 1;
                            $propertyCSV = mb_substr($entity, $startValue, $endValue - mb_strlen($entity) - 1);
                            $propertyValuePosition = substr($entity, $endValue);

                            if ($propertyCSV) {
                                $property = SPropertiesQuery::create()
                                ->findOneByCsvName($propertyCSV);

                                if ($property) {
                                    $propertyValue = SProductPropertiesDataQuery::create()->findOneById($propertyValuePosition);
                                    $this->get['p'][$property->getId()][] = html_entity_decode($propertyValue->getValue());
                                }
                            }
                        }
                    }
                }
            }
        );

        $_GET = $this->get;
        ShopCore::$_GET = $this->get;
    }

    /**
     * Applying all filter conditions to query
     * @param SProductsQuery $productsQuery
     */
    public function applyFilterConditions(SProductsQuery $productsQuery) {

        // Filter product by price in $_GET['lp'] and $_GET['rp']
        $this->makePriceFilter($productsQuery);

        // Filter products by brands in $_GET['brand']
        $this->makeBrandsFilter($productsQuery);

        // Filter products by properties $_GET['p']
        $this->makePropertiesFilter($productsQuery);
    }

    /**
     *
     * @return array|false
     */
    private function getProductIdFromPropGet() {

        if (!is_array($this->get['p'])) {
            return false;
        }

        $resultArray = [];

        $propertiesInGet = $this->get['p'];

        $array_products = [];
        foreach ($propertiesInGet as $pkey => $pvalue) {
            $arr_prod = [];
            foreach ($pvalue as $pv) {

                $this->db->where('property_id', (int) $pkey);
                $this->db->where('value', $pv);
                $this->db->where('locale', $this->locale);

                foreach ($this->db->distinct()->select('product_id')->get('shop_product_properties_data')->result_array() as $prod) {
                    $arr_prod[$prod['product_id']] = 1;
                }
            }
            $array_products[] = $arr_prod;
        }
        if (count($array_products)) {
            foreach ($array_products as $key => $arr) {
                $resultArray = (!$key) ? $arr : array_intersect_key($resultArray, $arr);
            }
        }

        return $resultArray;
    }

    /**
     * filter by price object db
     */
    private function filterProductFromPriceGet() {

        if (isset($this->get_lp) || isset($this->get_rp)) {
            if (isset($this->get_lp) && $this->get_lp > 0) {
                $this->db->where('shop_product_variants.price >= ', (int) ($this->get_lp));
            }

            if (isset($this->get_rp) && $this->get_rp > 0) {
                $this->db->where('shop_product_variants.price <= ', (int) ($this->get_rp));
            }
        }
    }

    /**
     * returns array of stdClass brands objects
     * @return null|array
     */
    public function getBrands() {
        if (!$this->model) {
            return;
        }

        $brands = $this->getBrandsByCategoryId($this->model->getId());

        if (!$brands) {
            return [];
        }

        $brands = $this->getProductsInBrandCount($brands);

        return $brands;
    }

    /**
     * Get brands by category id
     * @param integer $categoryId - category id
     * @return array
     */
    public function getBrandsByCategoryId($categoryId) {
        $brands = $this->db->distinct()->select('shop_brands_i18n.name, shop_brands.id, shop_brands.url')
            ->from('shop_brands')
            ->join('shop_products', 'shop_products.brand_id = shop_brands.id')
            ->join('shop_product_categories', 'shop_product_categories.product_id=shop_products.id')
            ->join('shop_brands_i18n', 'shop_brands_i18n.id=shop_brands.id')
            ->where('shop_products.active', 1)
            ->where('shop_product_categories.category_id', $categoryId)
            ->where('shop_brands_i18n.locale', $this->locale)
            ->order_by('shop_brands_i18n.name')
            ->get();

        if (!$brands) {
            return [];
        }
        return $brands->result();
    }

    /**
     * count products in brands
     * @param array $brands
     * @return array
     */
    private function getProductsInBrandCount($brands = []) {
        if (is_array($brands)) {

            $productIds = [];

            $array_products = $this->propGetSelect;

            $this->db->distinct()->select('shop_products.id as id, shop_products.brand_id as brand_id')
                ->from('shop_products')
                ->join('shop_product_variants', 'shop_product_variants.product_id=shop_products.id')
                ->join('shop_product_categories', 'shop_product_categories.product_id = shop_products.id')
                ->where('shop_products.active', 1)
                ->where('shop_product_categories.category_id', $this->model->getId())
                ->group_by('shop_product_variants.product_id');

            $this->filterProductFromPriceGet();

            if (is_array($array_products)) {

                $product = array_keys($array_products);
                $this->db->where_in('shop_product_categories.product_id', $product);
            }

            $productSelectMain = $this->db->get();
            $productSelectMain = $productSelectMain ? $productSelectMain->result_array() : [];

            if (count($productSelectMain)) {
                foreach ($productSelectMain as $p) {
                    $productIds[] = $p['brand_id'];
                }
            }

            if (count($productIds)) {
                $brandCnt = array_count_values($productIds);
            }
            foreach ($brands as $key => $brand) {
                $brands[$key]->countProducts = ($brandCnt[$brand->id]) ? $brandCnt[$brand->id] : 0;
            }
        }
        return $brands;
    }

    /**
     * returns all properties for current category
     * @return type
     */
    public function getProperties() {

        if (!$this->model) {
            return;
        }

        $this->db->distinct()->select('shop_product_properties_categories.property_id, shop_product_properties_i18n.name, shop_product_properties.csv_name')
            ->from('shop_product_properties_categories')
            ->join('shop_product_properties', 'shop_product_properties_categories.property_id=shop_product_properties.id')
            ->join('shop_product_properties_i18n', 'shop_product_properties_categories.property_id=shop_product_properties_i18n.id')
            ->where('shop_product_properties_i18n.locale', $this->locale)
            ->where('shop_product_properties.show_in_filter', 1)
            ->where('shop_product_properties.active', 1)
            ->where('shop_product_properties_categories.category_id', $this->model->getId());

        $properties = $this->db
            ->order_by('shop_product_properties.position')
            ->get();

        if (!$properties) {
            throw new Exception("Wrong query");
        }

        $properties = $properties->result();
        if (is_array($properties)) {
            foreach ($properties as $key => $item) {
                // значення властивостей
                $this->db->distinct()
                    ->select('value, shop_product_properties_data.id')
                    ->from('shop_product_properties_data')
                    ->join('shop_product_categories', 'shop_product_categories.product_id=shop_product_properties_data.product_id')
                    ->join('shop_products', 'shop_product_categories.product_id=shop_products.id')
                    ->where('shop_product_properties_data.property_id', $item->property_id)
                    ->where('shop_product_properties_data.locale', $this->locale)
                    ->where("shop_product_properties_data.value <> ''")
                    ->where("shop_products.active = '1'")
                    ->where('shop_product_categories.category_id', $this->model->getId())
                    ->order_by('ABS(shop_product_properties_data.value)');

                $properties[$key]->possibleValues = $this->db
                    ->group_by('shop_product_properties_data.value')
                    ->get();

                if ($properties[$key]->possibleValues) {
                    $properties[$key]->possibleValues = $properties[$key]->possibleValues->result_array();
                    $properties[$key]->possibleValues = user_function_sort($properties[$key]->possibleValues);
                } else {
                    throw new Exception;
                }
            }
        }

        if ($properties) {
            $properties = $this->getProductsInProperties($properties);
            if ($this->sortByAdminPropVal) {
                $properties = $this->setPropValuePos($properties);
            }
        }
        return $properties;
    }

    /**
     * count propucts in each property
     * @param type $properties
     * @return type
     */
    private function getProductsInProperties($properties = []) {

        $this->db->distinct()
            ->select('shop_products.id as id, shop_product_properties_data.value as val, shop_product_properties_data.property_id as propid')
            ->from('shop_products')
            ->join('shop_product_categories', 'shop_product_categories.product_id = shop_products.id')
            ->join('shop_brands', 'shop_products.brand_id = shop_brands.id', 'left')
            ->join('shop_product_variants', 'shop_product_variants.product_id = shop_products.id')
            ->join('shop_product_properties_data', "shop_product_properties_data.product_id = shop_product_categories.product_id and shop_product_properties_data.locale = '" . $this->locale . "'");

        $this->db->where('shop_product_categories.category_id', $this->model->getId());

        $this->filterProductFromPriceGet();

        if (isset($this->get['brand']) && is_array($this->get['brand'])) {
            $brands_ids = [];
            foreach ($this->get['brand'] as $brandId) {
                $brands_ids[] = $brandId;
            }
            $this->db->where_in('shop_products.brand_id', $brands_ids);
        }

        $this->db->where('shop_products.active', 1);

        $productSelectMain = $this->db->get()->result_array();

        foreach ($properties as $key => $item) {
            $array_products = $this->getProductIdFromPropGet();
            $propArr = [];
            if (count($productSelectMain)) {
                foreach ($productSelectMain as $prod) {
                    if (is_array($array_products)) {
                        if (array_key_exists($prod['id'], $array_products)) {
                            $propArr[] = $prod['propid'] . '_' . $prod['val'];
                        }
                    } else {
                        $propArr[] = $prod['propid'] . '_' . $prod['val'];
                    }
                }
            }
            $propCnt = array_count_values($propArr);
            foreach ($properties[$key]->possibleValues as $k => $v) {
                $properties[$key]->possibleValues[$k]['count'] = ($propCnt[$item->property_id . '_' . $v['value']]) ? $propCnt[$item->property_id . '_' . $v['value']] : 0;
                $properties[$key]->productsCount += $properties[$key]->possibleValues[$k]['count'];
            }
        }

        return $properties;
    }

    /**
     * for sorting
     */
    private function setPropValuePos($properties) {
        $this->db->cache_on();

        $data = $this->db->select('*, shop_product_properties.id as pid')
            ->from('shop_product_properties')
            ->join('shop_product_properties_i18n', 'shop_product_properties_i18n.id = shop_product_properties.id')
            ->where('shop_product_properties_i18n.locale', $this->locale)
            ->get();

        $prop_for_sync = $data->result_array();
        $this->db->cache_off();

        foreach ($properties as $key => $prop) {
            foreach ($prop_for_sync as $p_for_sync) {
                if ($p_for_sync['id'] == $prop->property_id) {
                    $data_origin = $prop->possibleValues;
                    $data_sync = unserialize($p_for_sync['data']);
                    $properties[$key]->possibleValues = $this->syncDataPos($data_origin, $data_sync);
                }
            }
        }

        return $properties;
    }

    /**
     * for sorting
     */
    private function syncDataPos($data_origin, $data_sync) {

        $arr_aux = [];
        foreach ($data_sync as $d_s) {
            foreach ($data_origin as $d_o) {
                if ($d_s == $d_o['value']) {
                    $arr_aux[] = $d_o;
                }
            }
        }
        return $arr_aux;
    }

    /**
     * Returns array with min and max price
     * @return array [minCost => int, maxCost => int]
     */
    public function getPriceRange() {
        if (!$this->model) {
            return;
        }

        $this->db->select('MIN(shop_product_variants.price) AS minCost, MAX(shop_product_variants.price) AS maxCost')
            ->from('shop_product_variants')
            ->where('shop_products.active', 1)
            ->join('shop_products', 'shop_product_variants.product_id=shop_products.id')
            ->join('shop_product_categories', 'shop_product_categories.product_id = shop_products.id');

        $priceRange = $this->db->where('shop_product_categories.category_id', $this->model->getId())
            ->get();

        if ($priceRange) {
            $priceRange = $priceRange->result_array()[0];
            $priceRange['minCost'] = (int) \Currency\Currency::create()->convert($priceRange['minCost']);
            $priceRange['maxCost'] = (int) \Currency\Currency::create()->convert($priceRange['maxCost']);
        } else {
            throw new Exception;
        }

        return $priceRange;
    }

    /**
     *
     * @param SProductsQuery $productsQuery
     * @return SProductsQuery
     */
    public function makePriceFilter(SProductsQuery $productsQuery) {
        if (isset($this->get_lp)) {
            $productsQuery->where('FLOOR(ProductVariant.Price) >= ?', (int) $this->get_lp);
        }

        if (isset($this->get_rp)) {
            $productsQuery->where('FLOOR(ProductVariant.Price) <= ?', (int) $this->get_rp);
        }

        return $productsQuery;
    }

    /**
     * for propel product query object filtration by brands
     * @param SProductsQuery $productsQuery
     * @return SProductsQuery
     */
    public function makeBrandsFilter(SProductsQuery $productsQuery) {
        if (isset($this->get['brand']) && !empty($this->get['brand'])) {
            $productsQuery->filterByBrandId($this->get['brand']);
        }
        return $productsQuery;
    }

    /**
     * for propel product query object filtration by properties
     * @param SProductsQuery $productsQuery
     * @return SProductsQuery
     */
    public function makePropertiesFilter(SProductsQuery $productsQuery) {
        $arr_product = $this->propGetSelect;
        if (is_array($arr_product)) {
            $p = array_keys($arr_product);
            $productsQuery->filterById($p);
        }

        return $productsQuery;
    }

    /**
     * To prevent setting any other variables in get array
     */
    private function filterGetParams() {
        $allowedKeys = $this->ci->config->load('filter');

        foreach (array_keys($this->get) as $key) {
            if (!in_array($key, $allowedKeys)) {
                unset($this->get[$key]);
            }
        }
    }

}