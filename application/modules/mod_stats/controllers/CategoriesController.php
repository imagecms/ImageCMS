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

    /**
     * Render template and set data
     */
    public function brandsInCategories() {
        $this->assetManager
                ->setData('categories', $firstLevelCategories)
                ->renderAdmin('categories/brandsInCategories');
    }

    public function attendance() {
        $this->controller->load->model('categories_model');
        $categories = $this->controller->categories_model->getCategoriesList();

        $this->renderAdmin('mostVisited', array(
            'categories' => $categories
        ));
    }

    public function getCategoriesAttendanceData() {
        $parentCategoryId = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
        $includeChilds = (bool) isset($_GET['include_childs']) ? $_GET['include_childs'] : 0;

        $this->controller->import('traits/DateIntervalTrait.php');
        $this->controller->load->model('attendance_model');

        $this->controller->load->model('categories_model');
        $categoriesLabels = $this->controller->categories_model->getCategoriesList($parentCategoryId);

        $params = array();
        $categoriesIds = array();

        foreach ($categoriesLabels as $categoryData) {
            $categoriesIds[$categoryData['id']] = array($categoryData['id']);
        }

        $includeChilds = TRUE;

        if ($includeChilds == TRUE) {
            $productsModel = $this->controller->load->model('products_model');
            foreach ($categoriesIds as $categoryId => $categoryIdCopy) {
                $subCaregories = $productsModel->getSubcategoriesIds($categoryId);
                $subCaregories[] = $categoryId;
                $categoriesIds[$categoryId] = $subCaregories;
            }
        }

        $categories = $this->controller->attendance_model->getCategoriesAttendance($params, $categoriesIds);

        $labels = array();
        foreach ($categoriesLabels as $categoryData) {
            $labels[$categoryData['id']] = $categoryData['name'];
        }

        $categoriesAttendance = array();
        foreach ($categories as $categoryId => $attendanceData) {
            $oneCategoryAttendanceValues = array();
            foreach ($attendanceData as $attendanceDataDateRow) {
                $oneCategoryAttendanceValues[] = array(
                    $attendanceDataDateRow['unix_date'],
                    $attendanceDataDateRow['users_count'],
                );
            }
            $categoriesAttendance[] = array(
                'key' => $labels[$categoryId],
                'values' => $oneCategoryAttendanceValues
            );
        }

        echo json_encode($categoriesAttendance);
    }

    /**
     * Prepare and return data for chart "brands in categories"
     */
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
