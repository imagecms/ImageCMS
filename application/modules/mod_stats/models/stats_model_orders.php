<?php

/**

 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Stats_model_orders extends CI_Model {

    /**
     * Default params for method getOrdersByDateRange
     * @var array
     */
    protected $dateRangeParams = array(
        'interval' => 'day', //  date interval (string: day|month|week|year)
        'start_date' => NULL, // NULL for all or date in format (string: YYYY-MM-DD)
        'end_date' => NULL, // NULL for all or date in format (string: YYYY-MM-DD)
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
    public function getOrdersByDateRange($params = array()) {
        if (is_array($params))
            foreach ($this->dateRangeParams as $key => $value) {
                if (key_exists($key, $params)) {
                    $this->dateRangeParams[$key] = $params[$key];
                }
            }

        $query = "
            SELECT
                COUNT(`dtable`.`id`) as `orders_count`,
                DATE_FORMAT(FROM_UNIXTIME(`dtable`.`date_created`), '" . $this->prepareDatePattern() . "') as `date`,
                SUM(`dtable`.`origin_price`) as `price_sum`,
                SUM(`dtable`.`products_count`) as `products_count`,
                SUM(`dtable`.`quantity`) as `quantity`
            FROM 
                (SELECT 
                    `shop_orders`.`id`,
                    `shop_orders`.`date_created`,
                    `shop_orders`.`paid`,
                    IFNULL(`shop_orders`.`origin_price`, 0) as `origin_price`,
                    COUNT(`shop_orders_products`.`order_id`) as `products_count`,
                    SUM(`shop_orders_products`.`quantity`) as `quantity`
                 FROM 
                    `shop_orders`
                 LEFT JOIN `shop_orders_products` ON `shop_orders_products`.`order_id` = `shop_orders`.`id`
                 WHERE 1
                     AND FROM_UNIXTIME(`shop_orders`.`date_created`) <= NOW() + INTERVAL 1 DAY 
                 GROUP BY 
                    `shop_orders`.`id`
                 ORDER BY 
                    FROM_UNIXTIME(`shop_orders`.`date_created`)
                ) as dtable
            WHERE 1 
                 " . $this->prepareBetweenCondition() . " 
                  " . $this->preparePaidCondition() . " 
            GROUP BY `date`
            ORDER BY FROM_UNIXTIME(`date_created`)
        ";

//        echo "<pre>";
//        print_r($query);
//        echo "</pre>";

        $result = $this->db->query($query);
        if ($result === FALSE) {
            return FALSE;
        }
        $ordersData = array();
        foreach ($result->result_array() as $row) {
            $ordersData[] = $row;
        }

        return $ordersData;
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

    /**
     * Helper function for getOrdersByDateRange()
     * @return string date pattern for mysql
     */
    protected function prepareDatePattern() {
        // date pattern for mysql
        switch ($this->dateRangeParams['interval']) {
            case 'month':
                return '%Y-%m';
            case 'year':
                return '%Y';
            default:
                return '%Y-%m-%d'; // day
        }
    }

    /**
     * Helper function for getOrdersByDateRange()
     * @return string condition of date range
     */
    protected function prepareBetweenCondition() {
        // start date
        $start_date = $this->getBetweenDate($this->dateRangeParams['start_date'], 'start');
        $end_date = $this->getBetweenDate($this->dateRangeParams['end_date'], 'end');

        // where between... for query
        if (!is_null($start_date) || !is_null($end_date)) {
            $start_date = is_null($start_date) == TRUE ? "'2000-01-01 00:00:00'" : "'{$start_date}'";
            $end_date = is_null($end_date) == TRUE ? 'NOW()' : "'{$end_date}'";
            return "AND FROM_UNIXTIME(`dtable`.`date_created`) BETWEEN {$start_date} AND {$end_date}";
        } else {
            return '';
        }
    }

    /**
     * Helper function for prepareBetweenCondition()
     * mysql needs date in format YYYY-MM-DD HH:MM:SS
     * @param type $date
     * @param type $startOrEnd
     * @return boolean
     */
    protected function getBetweenDate($date, $startOrEnd) {
        if ($date === NULL)
            return NULL;

        // detecting what part of date format for mysql is missing
        $datePatterns = array(
            '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/' => 'day',
            '/^[0-9]{4}-[0-9]{2}$/' => 'month',
            '/^[0-9]{4}$/' => 'year',
        );
        $type = NULL;
        foreach ($datePatterns as $pattern => $type_) {
            if (preg_match($pattern, $date)) {
                $type = $type_;
            }
        }
        if ($type == NULL) {
            return NULL;
        }

        // to include specified end month
        switch ($startOrEnd) {
            case "start":
                $lastDay = "01";
                break;
            case "end":
                $lastDay = "31";
                break;
            default:
                $lastDay = "01";
        }
        
        // to include all specified end year 
        if ($type == 'year' & $startOrEnd == 'end') {
            $month = "12";
        } else {
            $month = "01";
        }

        $hour = " 00:00:00";
        
        // filling date format according to wich part is missing
        switch ($type) {
            case "day":
                return $date . $hour;
            case "month":
                return $date .= "-{$lastDay}" . $hour;
            case "year":
                return $date . "-{$month}-{$lastDay}" . $hour;
            default :
                return NULL;
        }
    }

}

?>
