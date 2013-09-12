<?php

/**
 * @property CI_DB_active_record $db
 */
class SFilter {

    private $ci;
    private $db;
    private $locale;
    private $priceFilter;
    private $brandsFilter;
    private $model = null;

    public function __construct() {
        $this->ci = &get_instance();
        $this->db = &$this->ci->db;
        $this->locale = MY_Controller::getCurrentLocale();

        if ($_GET['lp'])
            $this->get_lp = (int) $_GET['lp'] / ShopCore::app()->SCurrencyHelper->getRateByfilter() - 1;
        if ($_GET['rp'])
            $this->get_rp = (int) $_GET['rp'] / ShopCore::app()->SCurrencyHelper->getRateByfilter() + 1;
        //get filter by price query string
        $this->priceFilter = $this->createFilterByPriceQueryString();

        //get filter by brand query string
        $this->brandsFilter = $this->createFilterByBrandQueryString();
    }

    /**
     * creating filter by brand query string
     * according to get brand parametr
     * @return string
     */
    private function createFilterByBrandQueryString() {
        if (isset(ShopCore::$_GET['brand']) && is_array(ShopCore::$_GET['brand'])) {
            $brArr = "(";
            foreach (ShopCore::$_GET['brand'] as $key => $brandId) {
                $brArr .= (int) $brandId;
                if (count(ShopCore::$_GET['brand']) - 1 > $key)
                    $brArr .= ", ";
                else
                    $brArr .= ")";
            }
            $filterBr = " AND shop_products.brand_id IN " . $brArr;
        }else {
            $filterBr = '';
        }
        return $filterBr;
    }

    /**
     * creating filter by price query string
     * according to lp and rp get parametr
     */
    private function createFilterByPriceQueryString() {
        $priceFilter = '';
        if (isset(ShopCore::$this->get_lp) || isset(ShopCore::$this->get_rp)) {
            if (isset(ShopCore::$this->get_lp) && ShopCore::$this->get_lp > 0) {
                $LeftriceRangeFilter = " AND shop_product_variants.price >= " . (int) (ShopCore::$this->get_lp);
                $priceFilter .= $LeftriceRangeFilter;
            }

            if (isset(ShopCore::$this->get_rp) && ShopCore::$this->get_rp > 0) {
                $RightPriceInFilter = " AND shop_product_variants.price <= " . (int) (ShopCore::$this->get_rp);
                $priceFilter .= $RightPriceInFilter;
            }
        }
        return $priceFilter;
    }

    /**
     * returns array of stdClass brands objects
     * @param SCategory $categoryModel
     * @return type
     */
    public function getBrands() {
        if (!$this->model) {
            return;
        } else {
            //only for SCategory
            if (get_class($this->model)) {
                $this->db->cache_on();
                $brands = $this->db->query(
                        "SELECT * FROM `shop_brands`
                        JOIN `shop_brands_i18n` ON shop_brands.id=shop_brands_i18n.id
                        WHERE locale='" . $this->locale . "' AND shop_brands.id IN
                        (SELECT DISTINCT `brand_id` FROM `shop_products` WHERE shop_products.id IN
                        (SELECT shop_product_categories.product_id FROM `shop_product_categories` WHERE `category_id`=" . (int) $this->model->getId() . ")
                        AND `active`=1
                        AND `brand_id`!=0)");
                if ($brands) {
                    $brands = $brands->result();
                    $brands = $this->getProductsInBrandCount($brands);
                } else {
                    $brands = null;
                }
                $this->db->cache_off();
                return $brands;
            } else {
                return array();
            }
        }
    }

    /**
     * count products in brands
     * @param type $brands
     * @return type
     */
    private function getProductsInBrandCount($brands = array()) {
        if (is_array($brands)) {
            $this->db->cache_on();
            if (ShopCore::$_GET['p'] && !empty(ShopCore::$_GET['p'])) {
                foreach (ShopCore::$_GET['p'] as $key => $value) {
                    $prFQ2 .= " AND `product_id` IN ";
                    $fq = "(";
                    foreach ($value as $k => $v) {
                        $fq .= "'" . ShopCore::encode($v) . "'";
                        if (count($value) - 1 > $k)
                            $fq .= ", ";
                        else
                            $fq .= ")";
                    }
                    $propertyfilterQuery = "(SELECT `product_id` FROM `shop_product_properties_data` WHERE `locale`='" . $this->locale . "' AND `property_id`=" . $key . " AND `value` IN " . $fq . ")";
                    $prFQ2 .= $propertyfilterQuery;
                }
            }

            foreach ($brands as $key => $brand) {
                $this->db->cache_on();
                $brands[$key]->countProducts =
                        $this->db->query(
                        "SELECT DISTINCT shop_products.id FROM `shop_products`
                        LEFT JOIN `shop_product_variants` ON shop_product_variants.product_id=shop_products.id
                        WHERE shop_products.brand_id=" . $brand->id . "
                        AND shop_products.active=1
                        AND shop_products.id IN (
                        SELECT `product_id` FROM `shop_product_categories` WHERE `category_id`=" . (int) $this->model->getId() . " )" . $this->priceFilter . $prFQ2);
                if ($brands[$key]->countProducts) {
                    $brands[$key]->countProducts = $brands[$key]->countProducts
                            ->num_rows();
                }
                $this->db->cache_off();
            }
            $this->db->cache_off();
        }
        return $brands;
    }

    /**
     * returns array of stdClass properties objects
     * @param SCategory $categoryModel
     * @return type
     */
    public function getProperties() {

        if (!$this->model) {
            return;
        } else {
            $this->db->cache_on();
            switch (get_class($this->model)) {
                case 'SCategory':
                    $properties = $this->db->query(
                            "SELECT DISTINCT (`property_id`),`name` FROM `shop_product_properties_categories`
                            JOIN `shop_product_properties` ON shop_product_properties_categories.property_id=shop_product_properties.id
                            JOIN `shop_product_properties_i18n` ON shop_product_properties_categories.property_id=shop_product_properties_i18n.id
                            WHERE locale='" . $this->locale . "'
                            AND shop_product_properties_categories.category_id=" . $this->model->getId() . "
                            AND show_in_filter=1 ORDER BY  shop_product_properties.position ASC");
                    if ($properties) {
                        $properties = $properties->result();
                        if (is_array($properties))
                            foreach ($properties as $key => $item) {
                                $properties[$key]->possibleValues =
                                        $this->db->query(
                                        "SELECT DISTINCT (`value`), `shop_product_properties_data`.`id`, COUNT(shop_product_properties_data.product_id) as productCount
                                                        FROM `shop_product_properties_data`
                                                        LEFT JOIN `shop_products` ON shop_products.id=shop_product_properties_data.product_id
                                                        WHERE `property_id`=" . $item->property_id . "
                                                        AND `locale`='" . $this->locale . "'
                                                        AND shop_products.active=1
                                                        AND shop_product_properties_data.product_id IN (SELECT `product_id` FROM `shop_product_categories` WHERE `category_id`=" . $this->model->getId() . ")
                                                        GROUP BY `value`");
                                if ($properties[$key]->possibleValues)
                                    $properties[$key]->possibleValues = $properties[$key]->possibleValues->result_array();
                                else
                                    throw new Exception;
                            }
                    } else {
                        throw new Exception("Wrong query");
                    }
                    break;
                case 'SBrands':
                    $properties = $this->db->query(
                            "SELECT DISTINCT (`property_id`), `name` FROM `shop_product_properties_data`
                            JOIN `shop_product_properties` ON shop_product_properties.id=shop_product_properties_data.property_id
                            JOIN `shop_product_properties_i18n` ON shop_product_properties_i18n.id=shop_product_properties_data.property_id
                            WHERE shop_product_properties_i18n.locale='" . $this->locale . "'
                            AND shop_product_properties_data.product_id IN(SELECT DISTINCT `id` FROM `shop_products` WHERE `brand_id`=" . $this->model->getId() . " AND `active`=1)
                            AND show_in_filter=1 AND active=1 ORDER BY  shop_product_properties.position ASC");
                    if ($properties) {
                        $properties = $properties->result();
//                        echo $this->db->last_query();
//                        exit();
                        if (is_array($properties) && !empty($properties))
                            foreach ($properties as $key => $item) {
                                $properties[$key]->possibleValues =
                                        $this->db->query(
                                        "SELECT DISTINCT (`value`),  `shop_product_properties_data`.`id`, COUNT(shop_product_properties_data.product_id) as productCount
                                                        FROM `shop_product_properties_data`
                                                        LEFT JOIN `shop_products` ON shop_products.id=shop_product_properties_data.product_id
                                                        WHERE `property_id`=" . $item->property_id . "
                                                        AND `locale`='" . $this->locale . "'
                                                        AND shop_products.active=1
                                                        AND shop_products.brand_id=" . $this->model->getId() .
                                        " GROUP BY `value`");
                                if ($properties[$key]->possibleValues)
                                    $properties[$key]->possibleValues = $properties[$key]->possibleValues->result_array();
                                else
                                    throw new Exception;
                            }
                    } else {
                        throw new Exception("Wrong query");
                    }
                    break;
                default:
                    return false;
                    break;
            }
            $this->db->cache_off();
            $properties = $this->getProductsInProperties($properties);
            //$properties = $this->sync_property_values_positions($properties);
            return $properties;
        }
    }

    public function sync_property_values_positions($properties) {
        $this->db->cache_on();
        $sql = "select *, shop_product_properties.id as pid from shop_product_properties
                    join shop_product_properties_i18n
                            on
                        shop_product_properties_i18n.id = shop_product_properties.id
                where shop_product_properties_i18n.locale = '" . MY_Controller::getCurrentLocale() . "'";
        $prop_for_sync = $this->db->query($sql)->result_array();
        $this->db->cache_off();

        foreach ($properties as $key => $prop) {
            foreach ($prop_for_sync as $p_for_sync) {
                if ($p_for_sync['id'] == $prop->property_id) {
                    $data_origin = $prop->possibleValues;
                    $data_sync = unserialize($p_for_sync['data']);
                    $properties[$key]->possibleValues = $this->sync_data_pos($data_origin, $data_sync);
                }
            }
        }

        return $properties;
    }

    public function sync_data_pos($data_origin, $data_sync) {

        $arr_aux = array();
        foreach ($data_sync as $d_s) {
            foreach ($data_origin as $d_o) {
                if ($d_s == $d_o['value'])
                    $arr_aux[] = $d_o;
            }
        }
        return $arr_aux;
    }

    /**
     * count propucts in each property
     * @param type $properties
     * @return type
     */
    private function getProductsInProperties($properties = array()) {
        $this->db->cache_on();
        foreach ($properties as $key => $item) {
            $properties[$key]->productsCount = 0;
            if (get_class($this->model) == 'SCategory')
                foreach ($properties[$key]->possibleValues as $k => $v) {
                    $productSelect = $this->db->query(
                            "SELECT * FROM
                    (SELECT * FROM shop_product_properties_data WHERE `value` IN " . $this->getPropertyInGet($item->property_id, $v['value']) . " AND product_id IN (SELECT DISTINCT product_id FROM shop_product_properties_data WHERE value='" . $v['value'] . "')
                    AND locale='" . $this->locale . "') TableVal
                    INNER JOIN `shop_products` ON  TableVal.product_id=shop_products.id
                    INNER JOIN `shop_product_variants` ON TableVal.product_id=shop_product_variants.product_id
                    WHERE `active`=1 AND TableVal.product_id IN (SELECT `product_id` FROM `shop_product_categories` WHERE `category_id`=" . $this->model->getId() . ")"
                            . $this->priceFilter . " " . $this->brandsFilter . " GROUP BY shop_product_variants.product_id");

                    if ($productSelect)
                        $properties[$key]->possibleValues[$k]['count'] = $productSelect->num_rows();

                    $properties[$key]->productsCount += $properties[$key]->possibleValues[$k]['count'];
                }
            if (get_class($this->model) == 'SBrands')
                foreach ($properties[$key]->possibleValues as $k => $v) {
                    $productSelect = $this->db->query(
                            "SELECT * FROM
                    (SELECT * FROM shop_product_properties_data WHERE `value` IN " . $this->getPropertyInGet($item->property_id, $v['value']) . " AND product_id IN (SELECT DISTINCT product_id FROM shop_product_properties_data WHERE value='" . $v['value'] . "')
                    AND locale='" . $this->locale . "') TableVal
                    INNER JOIN `shop_products` ON  TableVal.product_id=shop_products.id
                    INNER JOIN `shop_product_variants` ON TableVal.product_id=shop_product_variants.product_id
                    WHERE `active`=1 AND TableVal.product_id IN (SELECT `id` FROM `shop_products` WHERE `brand_id`=" . $this->model->getId() . ")"
                            . $this->priceFilter . " " . $this->brandsFilter . " GROUP BY shop_product_variants.product_id");

                    if ($productSelect)
                        $properties[$key]->possibleValues[$k]['count'] = $productSelect->num_rows();

                    $properties[$key]->productsCount += $properties[$key]->possibleValues[$k]['count'];
                }
        }
        $this->db->cache_off();
        return $properties;
    }

    /**
     * creating properties in get string
     * according to current property
     *
     * @param type $propertyKey
     * @param type $propValue
     * @return type
     */
    private function getPropertyInGet($propertyKey, $propValue) {
        if (is_array(ShopCore::$_GET['p'])) {
            $result = array();
            $propertiesInGet = ShopCore::$_GET['p'];
            unset($propertiesInGet[$propertyKey]);
            foreach ($propertiesInGet as $key => $value) {
                foreach ($value as $k => $v) {
                    $result[] = $v;
                }
            }
        }
        $this->getPropCount = count($result);
        if (count($result) == 0)
            return "('" . $propValue . "')";
        else
            return "('" . implode("', '", $result) . "')";
    }

    /**
     * returns array with min and max price
     */
    public function getPricerange() {
        if (!$this->model) {
            return;
        } else {
            $this->db->cache_on();
            //for SCategory instance
            switch (get_class($this->model)) {
                case 'SCategory':
                    $priceRange = $this->db->query("
                        SELECT  MIN(`price`) AS minCost,
                                MAX(`price`) AS maxCost
                        FROM `shop_product_variants`
                        WHERE `product_id` IN (SELECT `product_id` FROM `shop_product_categories`
                        JOIN `shop_products` ON shop_product_categories.product_id=shop_products.id
                        WHERE shop_product_categories.category_id=" . $this->model->getId() . " AND shop_products.active=1)");
                    break;
                case 'SBrands':
                    $priceRange = $this->db->query("
                        SELECT  MIN(`price`) AS minCost,
                                MAX(`price`) AS maxCost
                        FROM `shop_product_variants`
                        WHERE `product_id` IN (SELECT `id` FROM `shop_products` WHERE `brand_id`=" . $this->model->getId() . " AND active=1)");
                    break;
                default:
                    return false;
            }
            if ($priceRange) {
                $priceRange = $priceRange->result_array();
                $priceRange = $priceRange[0];
                $priceRange['minCost'] = (int) ShopCore::app()->SCurrencyHelper->convert($priceRange['minCost']);
                $priceRange['maxCost'] = (int) ShopCore::app()->SCurrencyHelper->convert($priceRange['maxCost']);
            } else {
                throw new Exception;
            }
            $this->db->cache_off();
            return $priceRange;
        }
    }

    /**
     *
     * @param SProductsQuery $products
     * @return type
     * for propel product query object filtration by price
     *
     */
    public function makePriceFilter(SProductsQuery $products) {
        if (isset(ShopCore::$this->get_lp))
            $products = $products->where('FLOOR(ProductVariant.Price) >= ?', (int) ShopCore::$this->get_lp) ;
        if (isset(ShopCore::$this->get_rp))
            $products = $products->where('FLOOR(ProductVariant.Price) <= ?', (int) ShopCore::$this->get_rp);

        return $products;
    }

    /**
     * for propel product query object filtration by brands
     * @param SProductsQuery $products
     * @return type
     */
    public function makeBrandsFilter(SProductsQuery $products) {
        if (isset(ShopCore::$_GET['brand']) && !empty(ShopCore::$_GET['brand'])) {
            $products = $products->filterByBrandId(ShopCore::$_GET['brand']);
        }
        return $products;
    }

    /**
     * for propel product query object filtration by properties
     * @param SProductsQuery $products
     * @return type
     */
    public function makePropertiesFilter(SProductsQuery $products) {
        if (isset(ShopCore::$_GET['p']) && count(ShopCore::$_GET['p']) > 0) {
            foreach (ShopCore::$_GET['p'] as $key => $value) {
                $prFQ .= " AND shop_products.id IN ";
                $fq = "(";
                foreach ($value as $k => $v) {
                    $fq .= "'" . $v . "'";
                    if (count($value) - 1 > $k)
                        $fq .= ", ";
                    else
                        $fq .= ")";
                }
                $propertyfilterQuery = "(SELECT `product_id` FROM `shop_product_properties_data` WHERE `locale`='" . $this->locale . "' AND `property_id`=" . $key . " AND `value` IN " . $fq . ")";
                $products = $products->where("shop_products.id IN (" . $propertyfilterQuery . ")");
            }
        }
        return $products;
    }

    public function makeCategoriesFilter(SProductsQuery $products) {
        if (isset(ShopCore::$_GET['category']) && !empty(ShopCore::$_GET['category'])) {
            $products = $products->filterByCategoryId(ShopCore::$_GET['category']);
        }
        return $products;
    }

    /**
     * to prevent setting any other variables in get array
     * @param SCategory $categoryModel
     */
    public function filterGet() {
        $allowedKeys = array('p', 'brand', 'lp', 'rp', 'order', 'per_page', 'user_per_page', 'category', 'utm_medium', 'utm_campaign', 'utm_source', 'gclid', 'filtermobile');

        foreach (array_keys(ShopCore::$_GET) as $key) {
            if (!in_array($key, $allowedKeys))
                show_error("$key get parameter is not allowed");
        }

        //price range validation
        if (isset(ShopCore::$this->get_lp)) {
            if (!is_numeric(ShopCore::$this->get_lp))
                show_error("Left price filter parametr must be numeric");
        }

        if (isset(ShopCore::$this->get_rp)) {
            if (!is_numeric(ShopCore::$this->get_rp))
                show_error("Right price filter parametr must be numeric");
        }

        //brands filter variables validation
        if (isset(ShopCore::$_GET['brand']) && get_class($this->model) == 'SCategory') {
            $this->db->cache_on();
            $brands = $this->db->query(
                            "SELECT shop_brands.id
                    FROM `shop_brands`
                    JOIN `shop_brands_i18n` ON shop_brands.id=shop_brands_i18n.id
                    WHERE locale='" . $this->locale . "'
                    AND shop_brands.id IN (SELECT DISTINCT `brand_id` FROM `shop_products`
                        WHERE `id` IN (SELECT `product_id` FROM `shop_product_categories` WHERE `category_id`=" . $this->model->getId() . ")
                        AND `brand_id`!=0)")
                    ->result_array();
            $this->db->cache_off();
            if (is_array($brands))
                foreach ($brands as $br)
                    $brandsIdsArr[] = (int) $br['id'];
            foreach (ShopCore::$_GET['brand'] as $brand) {
                if (!is_numeric($brand) or !in_array($brand, $brandsIdsArr))
                    show_error("Wrong brand id value or there is no such brand in current category (brand id:$brand)");
            }
        }

        //properties filter variables escaping quotes
        if (isset(ShopCore::$_GET['p'])) {
            foreach (ShopCore::$_GET['p'] as $key => $item) {
                foreach ($item as $k => $v) {
                    ShopCore::$_GET['p'][$key][$k] = ShopCore::encode(ShopCore::$_GET['p'][$key][$k]);
                }
            }
        }
        //for user_per_page validation
        if (isset(ShopCore::$_GET['user_per_page']))
            if (!is_numeric(ShopCore::$_GET['user_per_page']) AND ShopCore::$_GET['user_per_page'] != '')
                show_error("Invalid user_per_page value");

        //for per_page validation
        if (isset(ShopCore::$_GET['per_page']))
            if (!is_numeric(ShopCore::$_GET['user_per_page']) AND ShopCore::$_GET['user_per_page'] != '')
                show_error("Invalid per_page value");

        //for order method variable validation
        if (isset(ShopCore::$_GET['order'])) {
            $order_methods = array('price', 'price_desc', 'name', 'name_desc', 'hit', 'hot', 'action', 'rating', 'views', 'topsales', '');
            if (!in_array(ShopCore::$_GET['order'], $order_methods))
                show_error("Invalid order method");
        }
    }

    public function init($model) {
        if (!$model)
            return false;
        else {
            if (in_array(get_class($model), array('SCategory', 'SBrands'))) {
                $this->model = $model;
            }
        }
    }

    public function getCategories() {
        if (!$this->model)
            return;
        else {
            if (get_class($this->model) == 'SBrands') {
                $this->db->cache_on();
                $categories = $this->db->query("SELECT `category_id`, shop_category_i18n.name FROM `shop_products`
                    JOIN `shop_category` ON shop_category.id=shop_products.category_id
                    JOIN `shop_category_i18n` ON shop_category_i18n.id=shop_category.id
                    WHERE shop_products.brand_id=" . $this->model->getId() . "
                     AND `locale`='" . $this->locale . "' GROUP BY shop_products.category_id");
                if ($categories) {
                    $categories = $categories->result();
                    $categories = $this->countCategories($categories);
                    return $categories;
                } else {
                    throw new Exception;
                }
                $this->db->cache_off();
            } else {
                return;
            }
        }
    }

    private function countCategories($categories) {
        if (!$categories)
            return;
        else {
            if (ShopCore::$_GET['p'] && !empty(ShopCore::$_GET['p'])) {
                foreach (ShopCore::$_GET['p'] as $key => $value) {
                    $prFQ2 .= " AND `product_id` IN ";
                    $fq = "(";
                    foreach ($value as $k => $v) {
                        $fq .= "'" . ShopCore::encode($v) . "'";
                        if (count($value) - 1 > $k)
                            $fq .= ", ";
                        else
                            $fq .= ")";
                    }
                    $this->db->cache_on();
                    $propertyfilterQuery = "(SELECT `product_id` FROM `shop_product_properties_data` WHERE `locale`='" . $this->locale . "' AND `property_id`=" . $key . " AND `value` IN " . $fq . ")";
                    $this->db->cache_off();
                    $prFQ2 .= $propertyfilterQuery;
                }
            }

            foreach ($categories as $key => $value) {
                $this->db->cache_on();
                $categories[$key]->countProducts = $this->db->query("SELECT shop_products.id FROM `shop_products`
                    JOIN `shop_product_variants` ON shop_product_variants.product_id=shop_products.id
                    WHERE `category_id`=" . $value->category_id .
                        " AND `brand_id`=" . $this->model->getId() .
                        " AND `active`=1" . $this->priceFilter . $prFQ2);
                $this->db->cache_off();
                if ($categories[$key]->countProducts) {
                    $categories[$key]->countProducts = $categories[$key]->countProducts->num_rows();
                }
            }
            return $categories;
        }
    }

}
