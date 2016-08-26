<?php

/**
 * Class SearchController for mod_stats module
 * @uses ControllerBase
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @property search_model $search_model
 * @package ImageCMSModule
 */
class SearchController extends ControllerBase
{

    public function __construct($some) {
        parent::__construct($some);
        $this->controller->import('traits/DateIntervalTrait.php');
        $this->controller->load->model('search_model');
    }

    /**
     * Render template and set data for "keywords"
     */
    public function keywords() {
        $limit = CI::$APP->input->get('swr') ? (int) CI::$APP->input->get('swr') : 200;
        $result = $this->controller->search_model->queryKeywordsByDateRange(
            [
             'dateFrom' => CI::$APP->input->get('from') ?: '2005-05-05',
             'dateTo'   => CI::$APP->input->get('to') ?: date('Y-m-d'),
             'interval' => CI::$APP->input->get('group') ?: 'day',
            ],
            $limit
        );
        $this->renderAdmin('keywords', ['data' => $result]);
    }

    /**
     * Render template for  "brands in search"
     */
    public function brandsInSearch() {
        $this->renderAdmin('brandsInSearch');
    }

    /**
     * Return brands and counts data for chart
     * @return false|null data
     */
    public function getCategoriesInSearchData() {
        echo json_encode($this->getSearchData('Categories'));
    }

    /**
     * Return brands and counts data for chart
     * @return false|null data
     */
    public function getBrandsInSearchData() {
        echo json_encode($this->getSearchData('Brands'));
    }

    /**
     * Render template for "categories in search"
     */
    public function categoriesInSearch() {
        $this->renderAdmin('categoriesInSearch');
    }

    /**
     *
     * @param string $type
     */
    private function getSearchData($type) {
        $dateTo = CI::$APP->input->get('to') ? CI::$APP->input->get('to') : date('Y-m-d');
        $dateTo = date('Y-m-d', strtotime($dateTo));

        $dateFrom = CI::$APP->input->get('from') ? CI::$APP->input->get('from') : date('Y-m-d');
        $dateFrom = date('Y-m-d', strtotime($dateFrom));

        $params = [
                   'dateFrom' => $dateFrom,
                   'dateTo'   => $dateTo,
                   'interval' => CI::$APP->input->get('group') ?: 'day',
                   'swr'      => CI::$APP->input->get('swr') ? (int) CI::$APP->input->get('swr') : 9,
                   'swc'      => CI::$APP->input->get('swc') ? (int) CI::$APP->input->get('swc') : 9,
                  ];

        $keywordsArray = $this->controller->search_model->queryKeywordsByDateRange($params, $params['swc']);

        $queryStringWhere = $this->prepareQueryStringForSearchAnalisis($keywordsArray);

        if ($queryStringWhere != false) {
            $array = $this->controller->search_model->{"analysis$type"}($queryStringWhere, $params);
        } else {
            return FALSE;
        }

        return self::prepareDataForStaticChart($array);
    }

    /**
     * Prepare query string, which will be inserted after WHERE
     * @param array $searchResults
     * @return false|string
     */
    private function prepareQueryStringForSearchAnalisis($searchResults = null) {
        if ($searchResults == null) {
            return FALSE;
        } else {

            $returnResult = '(';
            $isFirst = '';
            foreach ($searchResults as $value) {
                $returnResult .= $isFirst . "`shop_products_i18n`.`name` LIKE '%" . $value['key'] . "%'";
                $isFirst = ' OR ';
            }
            $returnResult .= ')';
            return $returnResult;
        }
    }

    // TO DO

    public function noResults() {

        $this->renderAdmin('noResults');
    }

}