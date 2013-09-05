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
        (null !== self::$_instance) OR self::$_instance = new self();
        return self::$_instance;
    }

    public function getProductsInBrands() {
        $brands = $this->model->stats_model_products->getProductsInBrands();
        // data for pie diagram
        $pieData = array();
        foreach ($brands as $brand) {
            $pieData[] = array(
                'key' => $brand['name'],
                'y' => $brand['count']
            );
        }
        return json_encode(array(
            'type' => 'pie',
            'data' => $pieData
        ));
    }

}

?>
