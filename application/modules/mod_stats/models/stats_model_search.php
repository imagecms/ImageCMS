<?php

/**

 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Stats_model_search extends CI_Model {
    public $locale;
    /**
     * Default params for method getOrdersByDateRange
     * @var array
     */
    function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }

    /**
     * Orders dynamic for line diagram
     * @param array $params
     * @return array 
     */
    public function getKeywordsByDateRange() {
        $lineDiagramBase = new \mod_stats\classes\LineDiagramBase();

        $result = $this->queryKeywordsByDateRange($lineDiagramBase);

        if ($result === FALSE) {
            return FALSE;
        }


        $keysData = array();
        foreach ($result->result_array() as $row) {
            $keysData[] = $row;
        }

        return $keysData;
    }

    /**
     * Get searched keywords by time interval
     * @param mod_stats\classes\LineDiagramBase $obj
     * @param int $resultsLimit
     * @return query
     */
    public function queryKeywordsByDateRange(mod_stats\classes\LineDiagramBase $obj, $resultsLimit = 100) {
        if (!$obj) {
            return FALSE;
        }
        /*         * Prepare and run query * */
        $query = "
            SELECT  `mod_stats_search`.`key` ,
                    DATE_FORMAT( FROM_UNIXTIME(  `mod_stats_search`.`date` ) , '" . $obj->prepareDatePattern() . "' ) AS  `date_search` , 
                    COUNT(  `mod_stats_search`.`key` ) AS  `key_count` 
            FROM  
                `mod_stats_search` 
            WHERE 1
                " . $obj->prepareDateBetweenCondition('date', 'mod_stats_search') . " 
            GROUP BY  
                `mod_stats_search`.`key` 
            ORDER BY 
                key_count DESC
            LIMIT 0 , " . $resultsLimit;

        return $this->db->query($query);
    }

    /**
     * Get brands in search results
     * @param type $param
     * @return boolean
     */
    public function analysisBrands($whereQuery = '') {
        if (!$whereQuery) {
            return FALSE;
        }
        /** Get params for analysis **/
        $params = mod_stats\classes\Search::create()->prepareParamsFromCookiesForAnalysis();

        /** Prepare and run query * */
        $query = "
            SELECT  `shop_products`.`brand_id` ,`shop_brands_i18n`.`name`, COUNT(`shop_products`.`brand_id` ) as 'count'
            FROM  `shop_products` 
            JOIN  `shop_products_i18n` ON  `shop_products`.`id` =  `shop_products_i18n`.`id` 
            JOIN `shop_brands_i18n` ON `shop_products`.`brand_id` = `shop_brands_i18n`.`id`
            WHERE " . $whereQuery . $params['useLocale'] . "
            AND `shop_brands_i18n`.`locale` = '" . $this->locale . "'
            GROUP BY  `shop_products`.`brand_id` 
            ORDER BY `count` DESC
            LIMIT " . $params['results_quantity']
        ;
        
        $res = $this->db->query($query)->result_array();
        if ($res != null) {
            return $res;
        } else {
            return FALSE;
        }
    }
    
    /**
     * Get categories in search results
     * @param type $param
     * @return boolean
     */
    public function analysisCategories($whereQuery = '') {
        if (!$whereQuery) {
            return FALSE;
        }
        /** Get params for analysis **/
        $params = mod_stats\classes\Search::create()->prepareParamsFromCookiesForAnalysis();

        /** Prepare and run query * */
        $query = "
            SELECT `shop_products`.`category_id` ,`shop_category_i18n`.`name`, COUNT(`shop_products`.`category_id`) as 'count' 
            FROM  `shop_products` 
            JOIN  `shop_products_i18n` ON  `shop_products`.`id` =  `shop_products_i18n`.`id` 
            JOIN `shop_category_i18n` ON `shop_products`.`category_id` = `shop_category_i18n`.`id`
            WHERE " . $whereQuery . $params['useLocale'] . "
            AND `shop_category_i18n`.`locale` = '" . $this->locale . "'
            GROUP BY  `shop_products`.`category_id`
            ORDER BY `count` DESC
            LIMIT " . $params['results_quantity']
        ;
        $res = $this->db->query($query)->result_array();
        if ($res != null) {
            return $res;
        } else {
            return FALSE;
        }
    }

}

?>
