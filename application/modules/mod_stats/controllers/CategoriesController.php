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
        
        // Get children categories ids
        $childCategoriesIds = $this->controller->categories_model->getAllChildCategoriesIds($params['categoryId']);
        // Get brands in category 
        $categories = $this->controller->categories_model->getBrandsIdsAndCount($childCategoriesIds);
        
        $chartData = parent::prepareDataForStaticChart($categories);
        echo json_encode($chartData);
    }

}

?>
