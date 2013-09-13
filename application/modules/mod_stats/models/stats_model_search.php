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
    protected $dateRangeParams = array(
        'paid' => NULL, // TRUE|FALSE|NULL (paid, unpaid, all)
    );

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

        $query = "
            SELECT  `mod_stats_search`.`key` ,
                    DATE_FORMAT( FROM_UNIXTIME(  `mod_stats_search`.`date` ) , '" . $lineDiagramBase->prepareDatePattern() . "' ) AS  `date_search` , 
                    COUNT(  `mod_stats_search`.`key` ) AS  `key_count` 
            FROM  
                `mod_stats_search` 
            WHERE 1
                " . $lineDiagramBase->prepareDateBetweenCondition('date','mod_stats_search') . " 
            GROUP BY  
                `mod_stats_search`.`key` 
            ORDER BY 
                key_count DESC
            LIMIT 0 , 100";

        $result = $this->db->query($query);
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
     * Helper function for getOrdersByDateRange()
     * @return string
     */
    protected function preparePaidCondition() {
        if ($this->dateRangeParams['paid'] === TRUE)
            return "AND `paid` = 1";

        if ($this->dateRangeParams['paid'] === FALSE)
            return "AND (`paid` <> 1 OR `paid` IS NULL)";

        return "";
    }

}

?>
