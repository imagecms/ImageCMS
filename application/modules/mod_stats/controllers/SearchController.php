<?php

/**
 * 
 * @property search_model $search_model
 * @author 
 */
class SearchController extends ControllerBase {

    public function __construct($some) {
        parent::__construct($some);
        $this->controller->load('traits/DateIntervalTrait.php');
        $this->controller->load->model('search_model');
    }

    public function keywords() {

        $result = $this->controller->search_model->queryKeywordsByDateRange(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));
        $this->renderAdmin('keywords', array('data' => $result));
    }

    public function brandsInSearch() {

        $this->renderAdmin('brandsInSearch', array('data' => $result));
    }

    /**
     * Return brands and counts data for chart
     * @return chart data
     */
    public function getBrandsInSearchData() {
        $params = array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
            'swr' => isset($_GET['swr']) ? (int) $_GET['swr'] : 9,
            'swc' => isset($_GET['swc']) ? (int) $_GET['swc'] : 9
        );

        $keywordsArray = $this->controller->search_model->queryKeywordsByDateRange($params, $params['swc']);

        $queryStringWhere = $this->prepareQueryStringForSearchAnalisis($keywordsArray);

        if ($queryStringWhere != false) {
            $arrayWithBrandsInSearch = $this->controller->search_model->analysisBrands($queryStringWhere, $params);
        } else {
            return FALSE;
        }

        if ($arrayWithBrandsInSearch != FALSE) {
            /** Data for pie diagram * */
            $chartData = array();
            foreach ($arrayWithBrandsInSearch as $item) {
                $chartData[] = array(
                    'key' => $item['name'],
                    'y' => (int) $item['count']
                );
            }
            echo json_encode($chartData);
        } else {
            return;
        }
    }

    public function categoriesInSearch() {

        $this->renderAdmin('categoriesInSearch', array('data' => $result));
    }

    /**
     * Return brands and counts data for chart
     * @return chart data
     */
    public function getCategoriesInSearchData() {
        $params = array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
            'swr' => isset($_GET['swr']) ? (int) $_GET['swr'] : 9,
            'swc' => isset($_GET['swc']) ? (int) $_GET['swc'] : 9
        );
        
        $keywordsArray = $this->controller->search_model->queryKeywordsByDateRange($params, $params['swc']);

        $queryStringWhere = $this->prepareQueryStringForSearchAnalisis($keywordsArray);

        if ($queryStringWhere != false) {
            $arrayWithCategoriesInSearch = $this->controller->search_model->analysisCategories($queryStringWhere, $params);
        } else {
            return FALSE;
        }

        if ($arrayWithCategoriesInSearch != FALSE) {
            /** Data for pie diagram * */
            $chartData = array();
            foreach ($arrayWithCategoriesInSearch as $item) {
                $chartData[] = array(
                    'key' => $item['name'],
                    'y' => (int) $item['count']
                );
            }
            echo json_encode($chartData);
        } else {
            return;
        }
    }

    public function noResults() {

        $this->renderAdmin('noResults', array('data' => $result));
    }

    /**
     * Prepare query string, which will be inserted after WHERE
     * @param array $searchResults
     * @return boolean|string
     */
    private function prepareQueryStringForSearchAnalisis($searchResults = null) {
        if ($searchResults == null) {
            return FALSE;
        } else {

            $returnResult = "(";
            $isFirst = "";
            foreach ($searchResults as $value) {
                $returnResult .= $isFirst . "`shop_products_i18n`.`name` LIKE '%" . $value['key'] . "%'";
                $isFirst = " OR ";
            }
            $returnResult.=")";
            return $returnResult;
        }
    }

}
