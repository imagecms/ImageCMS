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
        $firstLevelCategories = $this->controller->products_model->getFirstLevelCategories();
        $this->assetManager
                ->setData('categories', $firstLevelCategories)
                ->renderAdmin('products/categories');
    }

    public function getCategoriesChartData() {
        $params = array(
            'categoryId' => isset($_GET['catId']) ? $_GET['catId'] : 0,
        );
        $catIds = $this->controller->products_model->getSubcategoriesIds($params['categoryId']);
        $categories = $this->controller->products_model->getCategoriesCountsData($catIds);

        $chartData = parent::prepareDataForStaticChart($categories);
        echo json_encode($chartData);
    }

    public function brands() {

        $this->assetManager
                ->renderAdmin('products/brands');
    }

    public function getBrandsChartData() {
        $params = array(
            'topBrandsCount' => isset($_GET['stbc']) ? $_GET['stbc'] : 20,
        );

        $brands = $this->controller->products_model->getBrandsCountsData($params['topBrandsCount']);

        $chartData = parent::prepareDataForStaticChart($brands);
        echo json_encode($chartData);
    }

    public function productInfo() {
        $params = array(
            'productId' => isset($_GET['pi']) ? $_GET['pi'] : NULL,
        );
        
        $product = $this->controller->products_model->getProductInfoById($params['productId']);
        $this->assetManager
                ->setData('product', $product)
                ->renderAdmin('products/productInfo');
    }

    public function attendance_test() {
        
    }

}
