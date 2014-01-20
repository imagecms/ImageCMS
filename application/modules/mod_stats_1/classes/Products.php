<?php

namespace mod_stats\classes;

/**
 * Description of Products
 *
 * @author kolia
 */
class Products extends \MY_Controller {

    protected static $instanse;

    public function __construct() {
        parent::__construct();
        $this->load->model('stats_model_products');
        $lang = new \MY_Lang();
        $lang->load('mod_stats');
    }

    /**
     * 
     * @return Products
     */
    public static function create() {
        (null !== self::$instanse) OR self::$instanse = new self();
        return self::$instanse;
    }

    public function getBrands() {
        $brands = $this->stats_model_products->getBrandsCountsData();

        // data for pie diagram
        $pieData = array();
        foreach ($brands as $brand) {
            $pieData[] = array(
                'key' => $brand['name'],
                'y' => (int) $brand['count']
            );
        }

        return json_encode(array(
            'type' => 'pie',
            'data' => $pieData
        ));
    }

    /**
     * Data for template Categories
     * @return array
     */
    public function templateCategories() {
        /** Get selected categories ids from cookie * */
        $data['categoryTree'] = \ShopCore::app()->SCategoryTree->getTree();
        $data['selectedCatIds'] = $this->getSelectedCategoriesIdsFromCookie();
        return $data;
    }

    public function getCategories() {
        $categoryProducts = $this->stats_model_products->getCategoriesCountsData($this->getSelectedCategoriesIdsFromCookie());

        // data for pie diagram
        $pieData = array();
        foreach ($categoryProducts as $category) {
            $pieData[] = array(
                'key' => $category['name'],
                'y' => (int) $category['count']
            );
        }

        return json_encode(array(
            'type' => 'pie',
            'data' => $pieData
        ));
    }

    public function getProductInfo() {
        
    }

    /**
     * Get product info by id (name, count of purchasses, rating, comments count)
     * @param int $id
     * @return json 
     */
    public function getProductInfoById($id = null) {
        $result = $this->stats_model_products->getProductInfoById($id);
        if ($result == false) {
            echo 'false';
            return;
        }
        $result['Rating'] = $this->stats_model_products->getProductRatingById($id);

        echo json_encode($result);
    }
    /**
     * Get selected categories ids from cookie or get default
     * @return array
     */
    public function getSelectedCategoriesIdsFromCookie() {
        $selectedCategoriesIds = $_COOKIE['selected_cat_ids_prod_stat'];
        if ($selectedCategoriesIds != null) {
            return json_decode($selectedCategoriesIds);
        } else {
            /** Default **/
            return $this->stats_model_products->getFirstLevelCategoriesIds();
        }
    }

}

?>
