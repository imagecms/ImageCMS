<?php

/**

 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Search_model extends CI_Model {

    use DateIntervalTrait;

    public $locale;

    /**
     * Default params for method getOrdersByDateRange
     * @var array
     */
    function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }

    protected function prepareConditions(array $params) {

        $betweenCondition = "";
        if (isset($params['dateFrom']) || isset($params['dateTo'])) {
            $dateFrom = isset($params['dateFrom']) ? $params['dateFrom'] : '2005-01-01';
            $dateTo = isset($params['dateTo']) ? $params['dateTo'] : date('Y-m-d');
            $betweenCondition = "AND FROM_UNIXTIME(`date`) BETWEEN '{$dateFrom} 00:00:00' AND '{$dateTo} 23:59:59'";
        }

        return array($betweenCondition);
    }

    /**
     * Get searched keywords by time interval
     * @return query
     */
    public function queryKeywordsByDateRange(array $params = array(), $resultsLimit = 100) {
        list($betweenCondition) = $this->prepareConditions($params);
        $interval = isset($params['interval']) ? $params['interval'] : NULL;

        $query = "
            SELECT  `mod_stats_search`.`key` ,
                    DATE_FORMAT( FROM_UNIXTIME(  `mod_stats_search`.`date` ) , '" . $this->getDatePattern($interval) . "' ) AS  `date_search` , 
                    COUNT(  `mod_stats_search`.`key` ) AS  `key_count` 
            FROM  
                `mod_stats_search` 
            WHERE 1
                " . $betweenCondition . " 
            GROUP BY  
                `mod_stats_search`.`key` 
            ORDER BY 
                key_count DESC
            LIMIT 0 , " . $resultsLimit;
        
        $result = $this->db->query($query);
        if ($result) {
            return $result->result_array();
        }
        
        return FALSE;
    }

    /**
     * Get brands in search results
     * @param type $param
     * @return boolean
     */
    public function analysisBrands($whereQuery = '', $params) {
        if (!$whereQuery) {
            return FALSE;
        }
        
        /** Prepare and run query * */
        $query = "
            SELECT  `shop_products`.`brand_id` ,`shop_brands_i18n`.`name`, COUNT(`shop_products`.`brand_id` ) as 'count'
            FROM  `shop_products` 
            JOIN  `shop_products_i18n` ON  `shop_products`.`id` =  `shop_products_i18n`.`id` 
            JOIN `shop_brands_i18n` ON `shop_products`.`brand_id` = `shop_brands_i18n`.`id`
            WHERE " . $whereQuery . "
            AND `shop_brands_i18n`.`locale` = '" . $this->locale . "'
            GROUP BY  `shop_products`.`brand_id` 
            ORDER BY `count` DESC
            LIMIT " . $params['swr']
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
    public function analysisCategories($whereQuery = '', $params) {
        if (!$whereQuery) {
            return FALSE;
        }
        
        /** Prepare and run query * */
        $query = "
            SELECT `shop_products`.`category_id` ,`shop_category_i18n`.`name`, COUNT(`shop_products`.`category_id`) as 'count' 
            FROM  `shop_products` 
            JOIN  `shop_products_i18n` ON  `shop_products`.`id` =  `shop_products_i18n`.`id` 
            JOIN `shop_category_i18n` ON `shop_products`.`category_id` = `shop_category_i18n`.`id`
            WHERE " . $whereQuery . "
            AND `shop_category_i18n`.`locale` = '" . $this->locale . "'
            GROUP BY  `shop_products`.`category_id`
            ORDER BY `count` DESC
            LIMIT " . $params['swr']
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