<?php

/**
 * 
 *
 * @author 
 */
class CategoriesController extends ControllerBase {

    public function __construct($some) {
        parent::__construct($some);
        $this->controller->load->model('categories_model');
    }

    public function brandsInCategories() {
        $this->assetManager
                ->setData('categories', $firstLevelCategories)
                ->renderAdmin('categories/brandsInCategories');
    }

    public function getBrandsInCategoriesCharData() {
        $params = array(
            'categoryId' => isset($_GET['ci']) ? $_GET['ci'] : 20,
        );

        $brands = $this->controller->products_model->getBrandsCountsData($params['topBrandsCount']);

        $chartData = parent::prepareDataForStaticChart($brands);
        echo json_encode($chartData);
    }

}

?>
