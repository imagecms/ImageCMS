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

    public function getCategories() {
        $categoryProducts = $this->stats_model_products->getCategoriesCountsData();
        
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
    
    
    public function getProductInfo(){
        
    }
    
    /**
     * Get product info by id (name, count of purchasses, rating, comments count)
     * @param int $id
     * @return json 
     */
    public function getProductInfoById($id = null){
        $result = $this->stats_model_products->getProductInfoById($id);
        if ($result == false){
            echo 'false';
            return;
        }
        $result['Rating'] = $this->stats_model_products->getProductRatingById($id);
        
        echo json_encode($result);
    }
    
}

?>
