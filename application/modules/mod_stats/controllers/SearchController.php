<?php

/**
 * Class SearchController for mod_stats module
 * @uses ControllerBase
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @property search_model $search_model
 * @package ImageCMSModule
 */
class SearchController extends ControllerBase {

    public function __construct($some) {
        parent::__construct($some);
        $this->controller->import('traits/DateIntervalTrait.php');
        $this->controller->load->model('search_model');
    }
    
    /**
     * Render template and set data for "keywords"
     */
    public function keywords() {

        $result = $this->controller->search_model->queryKeywordsByDateRange(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));
        $this->renderAdmin('keywords', array('data' => $result));
    }
    
    /**
     * Render template for  "brands in search"
     */
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
        
        $chartData = parent::prepareDataForStaticChart($arrayWithBrandsInSearch);
        echo json_encode($chartData);
    }
    
    /**
     * Render template for "categories in search"
     */
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
        
        $chartData = parent::prepareDataForStaticChart($arrayWithCategoriesInSearch);
        echo json_encode($chartData);
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
    
    // TO DO
    public function noResults() {

        $this->renderAdmin('noResults', array('data' => $result));
    }

}
