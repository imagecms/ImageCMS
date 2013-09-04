<?php

namespace mod_stats\models;

/**
 * Description of ProductsBase
 *
 * @author kolia
 */
class ProductsBase {

    protected static $instanse;
    protected $locale;
    protected $brands;

    /**
     * 
     * @var ActiveRecord
     */
    protected $db;

    private function __construct() {
        $ci = &get_instance();
        $this->db = $ci->db;
        $this->locale = \MY_Controller::getCurrentLocale();
    }

    private function __clone() {
        
    }

    /**
     * 
     * @return ProductsBase
     */
    public static function getInstance() {
        if (is_null(self::$instanse)) {
            self::$instanse = new ProductsBase();
        }
        return self::$instanse;
    }

    /**
     * Getting data for selecting brands
     * @return array each brand name and id
     */
    public function getAllBrands() {
        $result = $this->db
                ->select('shop_brands.id,name')
                ->from('shop_brands')
                ->join('shop_brands_i18n', 'shop_brands_i18n.id = shop_brands.id')
                ->where('locale', $this->locale)
                ->get();
        $brandsList = array();
        foreach ($result->result_array() as $row) {
            $brandsList[$row['id']] = $row['name'];
        }
        return $brandsList;
    }

    /**
     * Returns counts products in each brand
     * @param array $brands (optional) brandsIds
     * @return array (brandId, brandName, productsCount)
     */
    public function getBrandsData($brandIds = NULL) {
        // if brand ids specified, then leave only them
        $brands = $this->getAllBrands();
        if (is_array($brandIds)) {
            foreach ($brands as $id => $name) {
                if (!key_exists($id, $brandIds))
                    unset($brands[$id]);
            }
        }

        // getting each brand products count
        $brandsInfo = array();
        foreach ($brands as $id => $name) {
            $result = $this->db
                    ->select('stock')
                    ->from('shop_product_variants')
                    ->join('shop_products', 'shop_products.id = shop_product_variants.product_id')
                    ->where('brand_id', $id)
                    ->get();

            $count = 0;
            foreach ($result->result_array() as $row) {
                $count += $row['stock'];
            }

            $brandsInfo[] = array(
                'id' => $id,
                'name' => $name,
                'count' => $count,
            );
        }
        return $brandsInfo;
    }

    public function getAllCategories() {
        
    }

    /**
     * Returns count of products in category
     * @param int $categoryId
     * @return int 
     */
    public function getCategoryCount($categoryId) {
        $result = $this->db
                ->select('stock')
                ->from('shop_product_variants')
                ->join('shop_products', 'shop_products.id = shop_product_variants.product_id')
                ->where('category_id', $categoryId)
                ->get();

        if ($result === FALSE)
            return 0;

        $categoryCount = 0;
        foreach ($result->result_array() as $row) {
            $categoryCount += $row['stock'];
        }
        return $categoryCount;
    }

    /**
     * Returns counts products in each category
     * @param array $categoryIds 
     * @return array (categoryId, categoryName, productsCount)
     */
    public function getCategoryData($categoryIds = NULL) {
        // збудувати дерево категорій, 
        // і тоді по них проходитись - якщо вибрано якусь категорію шо 
        // має підкатегорії, то перевіряти чи is_array, якщо так то рекурсивно 
        // по них тоже пройтись
        
        // також треба зробити вибірки по унікальних продуктах ,
        // тобто скільки є видів продуктів/варіантів
        // (зараз є тільки скільки є всього)
    }

}
?>
