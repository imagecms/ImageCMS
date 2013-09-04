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
     * @param boolean $uniqueProducts (optional, default FALSE) if TRUE, then method 
     * will return count of unique products. FALSE will give all.
     * @return array (brandId, brandName, productsCount)
     */
    public function getBrandsData($brandIds = NULL, $uniqueProducts = FALSE) {
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

            $countUnique = 0;
            $countAll = 0;
            foreach ($result->result_array() as $row) {
                $countAll += $row['stock'];
                $countUnique++;
            }

            $brandsInfo[] = array(
                'id' => $id,
                'name' => $name,
                'count' => $uniqueProducts === FALSE ? $countAll : $countUnique,
            );
        }
        return $brandsInfo;
    }

    /**
     * 
     */
    public function getAllCategories() {
        // getting categories info from db
        $result = $this->db
                ->select('id,parent_id')
                ->from('shop_category')
                //->join('shop_category_i18n', 'shop_category.id = shop_category_i18n.id')
                //->where('locale', $this->locale)
                ->get();

        $categories = array();
        foreach ($result->result_array() as $row) {
            $path = array();
            $path_ = unserialize($row['full_path_ids']);
            if (is_array($path_)) {
                $path = $path_;
            }
            $categories[] = array(
                'id' => $row['id'],
                'parent_id' => $row['parent_id'],
                'name' => $row['name'],
                'full_path_ids' => $path,
            );
        }

        // creating categories tree of ids
        $categoryTree = array();
        $level = 0;

        foreach ($categories as $category) {
            foreach ($categories as $category_) {
                if ($category['parent_id'] == $category_['id']) {
                    $categoryTree[$category_['id']][$category['id']] = NULL;
                }
            }
        }
        
        
        echo "<pre>";
        print_r($categoryTree);
        echo "</pre>";
        exit;
    }

    /**
     * Returns count of products in category
     * @param int $categoryId
     * @param boolean $uniqueProducts (optional, default FALSE) if TRUE, then method 
     * will return count of unique products. FALSE will give all.
     * @return int 
     */
    public function getCategoryCount($categoryId, $uniqueProducts = FALSE) {
        $result = $this->db
                ->select('stock')
                ->from('shop_product_variants')
                ->join('shop_products', 'shop_products.id = shop_product_variants.product_id')
                ->where('category_id', $categoryId)
                ->get();

        if ($result === FALSE)
            return 0;

        $uniqueCount = 0;
        $categoryCount = 0;
        foreach ($result->result_array() as $row) {
            $categoryCount += $row['stock'];
            $uniqueCount++;
        }
        return $uniqueProducts === FALSE ? $categoryCount : $uniqueCount;
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
    }

}

?>
