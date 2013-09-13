<?php

/**
 * Description of ProductsBase
 *
 * @author kolia
 */
class Stats_model_products extends CI_Model {

    protected $locale;
    protected $brands;
    protected $countTemp = 0;
    protected $catWithSubcats = array();

    public function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }

    /**
     * Returns counts products in each brand
     * @param array $brands (optional) brandsIds
     * @param boolean $uniqueProducts (optional, default FALSE) if TRUE, then method 
     * will return count of unique products. FALSE will give all.
     * @return array (brandId, brandName, productsCount)
     */
    public function getBrandsCountsData($brandIds = NULL, $uniqueProducts = FALSE) {
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
     * Returns counts products in each category
     * @param array $categoryIds (optional, default all root categories)
     * @param boolean $unique (optional, default FALSE)
     * @return array (categoryId, categoryName, productsCount)
     */
    public function getCategoriesCountsData($categoryIds = array(), $unique = FALSE) {
        $categories = $this->getAllCategories();

        // creating array of id and parent_id of each category
        $categoriresRelations = array();
        foreach ($categories as $category) {
            $categoriresRelations[$category['id']] = $category['parent_id'];
        }



        // getting all root categories if $categoryIds in not specified
        if (!is_array($categoryIds) || count($categoryIds) == 0) { // count all categories
            foreach ($categoriresRelations as $id => $pid) {
                if ($pid == 0) {
                    $categoryIds[] = $id;
                }
            }
        }



        // getting counts of category (including subcategories)
        $categoriesCount = array();
        //$categoriesSubCats = array();
        foreach ($categoryIds as $id) {
            $this->catWithSubcats = array();
            $this->getCount($id, $categoriresRelations);
            //$categoriesSubCats[$id] = $this->catWithSubcats;
            $categoriesCount[$id] = $this->getCategoryProductsCount($this->catWithSubcats, $unique);
        }


        // adding names to categories 
        $categoriesCountNew = array();
        foreach ($categoriesCount as $categoryId => $count) {
            foreach ($categories as $num => $categoryInfo) {
                if ($categoryInfo['id'] == $categoryId) {
                    $categoriesCountNew[] = array(
                        'name' => $categoryInfo['name'],
                        'count' => $count
                    );
                    unset($categories[$num]);
                    break;
                }
            }
        }

        return $categoriesCountNew;
    }

    /**
     * Returns id,parent_id,name and full_path_ids of categories
     * @return array 
     */
    protected function getAllCategories() {
        // getting categories info from db
        $result = $this->db
                ->select('shop_category.id,parent_id,name,full_path_ids')
                ->from('shop_category')
                ->join('shop_category_i18n', 'shop_category.id = shop_category_i18n.id')
                ->where('locale', $this->locale)
                ->get();
        $categoriesRelInfo = array();
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
            );
        }

        return $categories;
    }

    /**
     * Getting data for selecting brands
     * @return array each brand name and id
     */
    protected function getAllBrands() {
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
     * Returns count of products in category
     * @param int|array $categoryId
     * @param boolean $uniqueProducts (optional, default FALSE) if TRUE, then method 
     * will return count of unique products. FALSE will give all.
     * @return int 
     */
    protected function getCategoryProductsCount($categoryId, $uniqueProducts = FALSE) {
        $this->db
                ->select('stock')
                ->from('shop_product_variants')
                ->join('shop_products', 'shop_products.id = shop_product_variants.product_id');

        if (is_int($categoryId)) {
            $this->db->where('category_id', $categoryId);
        } elseif (is_array($categoryId)) {
            $this->db->where_in('category_id', $categoryId);
        } else {
            return FALSE;
        }

        $result = $this->db->get();

        if ($result === FALSE)
            return 0;

        $uniqueCount = 0;
        $categoryCount = 0;
        foreach ($result->result_array() as $row) {
            $categoryCount += $row['stock'];
            $uniqueCount++;
        }

        return $uniqueProducts != FALSE ? $uniqueCount : $categoryCount;
    }

    /**
     * Recursive function for gegging count of subcategories
     * @param int $id
     * @param array $categories
     */
    protected function getCount($id, $categories) {
        $this->catWithSubcats[] = $id;
        while (in_array($id, $categories)) {
            $key = array_search($id, $categories);
            unset($categories[$key]);
            $this->getCount($key, $categories);
        }
    }

}

?>
