<?php

namespace mod_stats\classes;

/**
 * Description of Products
 *
 * @author kolia
 */
class Search extends \MY_Controller {

    protected static $instanse;

    public function __construct() {
        parent::__construct();
        $this->load->model('stats_model_search');
        $lang = new \MY_Lang();
        $lang->load('mod_stats');
    }

    /**
     * 
     * @return Search
     */
    public static function create() {
        (null !== self::$instanse) OR self::$instanse = new self();
        return self::$instanse;
    }

    /**
     * Table representation for keywords searched
     */
    public function templateKeywordsSearched() {
//        $params = \mod_stats\classes\LineDiagramBase::create()->getParamsFromCookies();

        $keywords = $this->stats_model_search->getKeywordsByDateRange();
        return $keywords;
    }

    /**
     * Return brands and counts data for chart
     * @return chart data
     */
    public function getBrandsInSearch() {
        /*         * Prepare params from cookie * */
        $params = $this->prepareParamsFromCookiesForAnalysis();
        /*         * Get keywords from search * */
        $keywords = $this->stats_model_search->queryKeywordsByDateRange(new \mod_stats\classes\LineDiagramBase(), $params['words_quantity']);
        $keywordsArray = $keywords->result_array();

        /*         * Prepare query string, which will be inserted after WHERE  * */
        $queryStringWhere = $this->prepareQueryStringForSearchAnalisis($keywordsArray);

        if ($queryStringWhere != false) {
            /** Run analysis and get array with brands * */
            $arrayWithBrandsInSearch = $this->stats_model_search->analysisBrands($queryStringWhere);
        } else {
            return FALSE;
        }

        if ($arrayWithBrandsInSearch != FALSE) {
            /** Data for pie diagram * */
            $pieData = array();
            foreach ($arrayWithBrandsInSearch as $brand) {
                $pieData[] = array(
                    'key' => $brand['name'],
                    'y' => (int) $brand['count']
                );
            }

            return json_encode(array(
                'type' => 'pie',
                'data' => $pieData
            ));
        } else {
            return;
        }
    }

    /**
     * Return categories and counts data for chart
     * @return chart data
     */
    public function getCategoriesInSearch() {
        /*         * Prepare params from cookie * */
        $params = $this->prepareParamsFromCookiesForAnalysis();
        /*         * Get keywords from search * */
        $keywords = $this->stats_model_search->queryKeywordsByDateRange(new \mod_stats\classes\LineDiagramBase(), $params['words_quantity']);
        $keywordsArray = $keywords->result_array();

        /*         * Prepare query string, which will be inserted after WHERE  * */
        $queryStringWhere = $this->prepareQueryStringForSearchAnalisis($keywordsArray);

        if ($queryStringWhere != false) {
            /** Run analysis and get array with brands * */
            $arrayWithBrandsInSearch = $this->stats_model_search->analysisCategories($queryStringWhere);
        } else {
            return FALSE;
        }

        if ($arrayWithBrandsInSearch != FALSE) {
            /** Data for pie diagram * */
            $pieData = array();
            foreach ($arrayWithBrandsInSearch as $brand) {
                $pieData[] = array(
                    'key' => $brand['name'],
                    'y' => (int) $brand['count']
                );
            }

            return json_encode(array(
                'type' => 'pie',
                'data' => $pieData
            ));
        } else {
            return;
        }
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

    /**
     * Get params for analysis from cookie
     * @return array
     */
    public function prepareParamsFromCookiesForAnalysis() {

        $params = array();
        /** Words quantity **/
        if ($_COOKIE['words_quantity_search_stats'] != null) {
            $params['words_quantity'] = $_COOKIE['words_quantity_search_stats'];
        } else {
            $params['words_quantity'] = '1';
        }
        /** Results quantity * */
        if ($_COOKIE['results_quantity_search_stats'] != null) {
            $params['results_quantity'] = $_COOKIE['results_quantity_search_stats'];
        } else {
            $params['results_quantity'] = '1';
        }
        /** Use locale * */
        if ($_COOKIE['use_locale_search_stats'] == 'true') {
            $params['useLocale'] = "AND`shop_products_i18n`.`locale` =  '" . $this->stats_model_search->locale . "' ";
        } else {
            $params['useLocale'] = "";
        }

        return $params;
    }

}

?>
