<?php

/**
 * 
 *
 * @author 
 */
class ProductsController extends ControllerBase {

    public function __construct($some) {
        parent::__construct($some);
        $this->controller->load->model('products_model');
    }

    public function categories() {

        $this->assetManager
                ->setData('data', 123)
                ->renderAdmin('products/categories');
    }

    public function getCategoriesData() {

        $brands = $this->controller->products_model->getBrandsCountsData();

        // data for pie diagram
        $pieData = array();
        foreach ($brands as $brand) {
            $pieData[] = array(
                'key' => $brand['name'],
                'y' => (int) $brand['count']
            );
        }

        echo json_encode($pieData);
    }

    public function attendance_test() {
        
    }

}
