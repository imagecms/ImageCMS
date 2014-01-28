<?php

/**
 * 
 *
 * @author 
 */
class CategoriesController extends ControllerBase {

    protected $params;

    public function __construct($some) {
        parent::__construct($some);
        $this->controller->load->model('categories_model');

        $this->params = array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
            'category_id' => isset($_GET['category_id']) ? $_GET['category_id'] : 0,
            'includeChilds' => (bool) isset($_GET['include_childs']) ? 1 : 0,
        );
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
        array_unshift($categories, array('id' => 0, 'name' => lang('First level categories', 'mod_stats'), 'full_path_ids' => array()));
        $data = array_merge(array('categories' => $categories), $this->params);
        $this->renderAdmin('attendance', $data);
    }

    public function getCategoriesAttendanceData() {
        $this->controller->import('traits/DateIntervalTrait.php');
        $this->controller->load->model('attendance_model');

        $this->controller->load->model('categories_model');
        $categoriesLabels = $this->controller->categories_model->getCategoriesList($this->params['category_id']);

        $categoriesIds = array();
        foreach ($categoriesLabels as $categoryData) {
            $categoriesIds[$categoryData['id']] = array($categoryData['id']);
        }

        if ($this->params['includeChilds'] == TRUE) {
            $productsModel = $this->controller->load->model('products_model');
            foreach ($categoriesIds as $categoryId => $categoryIdCopy) {
                $subCaregories = $productsModel->getSubcategoriesIds($categoryId);
                $subCaregories[] = $categoryId;
                $categoriesIds[$categoryId] = $subCaregories;
            }
        }

        $categories = $this->controller->attendance_model->getCategoriesAttendance($this->params, $categoriesIds);

        $labels = array();
        foreach ($categoriesLabels as $categoryData) {
            $labels[$categoryData['id']] = $categoryData['name'];
        }

        $categoriesAttendance = array();
        foreach ($categories as $categoryId => $attendanceData) {
            $oneCategoryAttendanceValues = array();
            foreach ($attendanceData as $attendanceDataDateRow) {
                $oneCategoryAttendanceValues[] = array(
                    'x' => $attendanceDataDateRow['unix_date'] * 1000,
                    'y' => $attendanceDataDateRow['users_count'] * 1,
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
