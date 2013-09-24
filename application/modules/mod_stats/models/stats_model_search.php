<?php

/**

 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Stats_model_search extends CI_Model {

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

    
    
    
    
    
    
    
    
    
    
    public function queryKeywordsByDateRange (mod_stats\classes\LineDiagramBase $obj, $resultsLimit = 100 ){
        if (!$obj){
            return FALSE;
        }
        /**Prepare and run query **/
        $query = "
            SELECT  `mod_stats_search`.`key` ,
                    DATE_FORMAT( FROM_UNIXTIME(  `mod_stats_search`.`date` ) , '" . $obj->prepareDatePattern() . "' ) AS  `date_search` , 
                    COUNT(  `mod_stats_search`.`key` ) AS  `key_count` 
            FROM  
                `mod_stats_search` 
            WHERE 1
                " . $obj->prepareDateBetweenCondition('date','mod_stats_search') . " 
            GROUP BY  
                `mod_stats_search`.`key` 
            ORDER BY 
                key_count DESC
            LIMIT 0 , ".$resultsLimit;

        return $this->db->query($query);
    }
}

?>
