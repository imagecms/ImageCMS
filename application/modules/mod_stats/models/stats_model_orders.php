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
        'range' => 'day', //  date interval (string: day|month|week|year)
        'start_date' => NULL, // NULL or date in format (string: YYYY-MM-DD)
        'end_date' => NULL, // NULL or date in format (string: YYYY-MM-DD)
        'fill_empty' => TRUE, // fill empty date ranges by 0 (boolean)
        'paid' => NULL, // TRUE|FALSE|NULL (paid, unpaid, all)
    );

    function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }

    /**
     * 
     * @return array
     */
    public function getOrdersAndCounts() {
        $query = "
            SELECT 
                `shop_orders`.`date_created` as date_created,
                COUNT(`shop_orders_products`.`order_id`) as products_count,
                IF (`shop_orders`.`paid` = 1, 1, 0) as paid
            FROM 
                `shop_orders`
            LEFT JOIN 
                `shop_orders_products` ON `shop_orders`.`id` = `shop_orders_products`.`order_id`
            GROUP BY date_created
            ORDER BY date_created ASC
        ";
        $result = $this->db->query($query);
        $orders = array();
        foreach ($result->result_array() as $row) {
            $orders[] = $row;
        }
        return $orders;
    }

    /**
     * Orders dynamic for line diagram
     * @param array $params
     * @return array 
     */
    public function getOrdersByDateRange($params = array()) {
        foreach ($this->dateRangeParams as $key => $value) {
            if (key_exists($key, $params)) {
                $this->dateRangeParams[$key] = $params[$key];
            }
        }

        $this->prepareDatePattern();
        $this->getPaidStatus();

        $query = "
            SELECT
                COUNT(`dtable`.`id`) as `orders_count`,
                DATE_FORMAT(FROM_UNIXTIME(`dtable`.`date_created`), '" . $this->dateRangeParams['date_pattern_mysql'] . "') as `date`
            FROM 
                (SELECT 
                    `id`,
                    `date_created`,
                    `paid`
                 FROM 
                    `shop_orders`
                 WHERE 1
                     AND FROM_UNIXTIME(`date_created`) <= NOW() + INTERVAL 1 DAY 
                 ORDER BY 
                    FROM_UNIXTIME(`date_created`)
                ) as dtable
            WHERE 1 
                 " . $this->prepareBetweenCondition() . " 
                  " . $this->getPaidStatus() . " 
            GROUP BY `date`
            ORDER BY FROM_UNIXTIME(`date_created`)
        ";

        $result = $this->db->query($query);
        if ($result === FALSE) {
            return FALSE;
        }
        $ordersData = array();
        foreach ($result->result_array() as $row) {
            $ordersData[$row['date']] = $row['orders_count'];
        }

        return $this->dateRangeParams['fill_empty'] !== TRUE ? $ordersData : $this->fillZero($ordersData);
    }

    protected function getPaidStatus() {
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
        switch ($this->dateRangeParams['range']) {
            case 'day':
                $this->dateRangeParams['date_pattern_mysql'] = '%Y-%m-%d';
                $this->dateRangeParams['date_pattern_php'] = "Y-m-d";
                $this->dateRangeParams['date_step'] = 60 * 60 * 24;
                break;
            /* case 'week': 
              $this->dateRangeParams['mysql_pattern'] = '%Y-%v';
              $this->dateRangeParams['date_pattern_php'] = "Y-m-d";
              $this->dateRangeParams['date_step'] = 60 * 60 * 24;
              break;
              case 'month':// як бути з тим шо в місяці може бути 30/31 днів????
              $this->dateRangeParams['mysql_pattern'] = '%Y-%m';
              $this->dateRangeParams['date_pattern_php'] = "Y-m-d";
              $this->dateRangeParams['date_step'] = 60 * 60 * 24;
              break;
              case 'year': // високосний...
              $this->dateRangeParams['mysql_pattern'] = '%Y';
              $this->dateRangeParams['date_pattern_php'] = "Y-m-d";
              $this->dateRangeParams['date_step'] = 60 * 60 * 24;
              break; */
            default:
                $this->dateRangeParams['mysql_pattern'] = '%Y-%m-%d'; // day
                $this->dateRangeParams['date_pattern_php'] = "Y-m-d";
                $this->dateRangeParams['date_step'] = 60 * 60 * 24;
                break;
        }
    }

    /**
     * Helper function for getOrdersByDateRange()
     * @return string condition of date range
     */
    protected function prepareBetweenCondition() {
        // start date
        if ($this->dateRangeParams['start_date'] != NULL) {
            if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', trim($params['start_date']))) {
                $start_date = $this->dateRangeParams['start_date'] . ' 00:00:00';
            }
        }

        // end date
        if ($this->dateRangeParams['end_date'] != NULL) {
            if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', trim($params['end_date']))) {
                $end_date = $this->dateRangeParams['end_date'] . ' 00:00:00';
            }
        }

        // where between... for query
        if (!is_null($start_date) || !is_null($end_date)) {
            $start_date = is_null($start_date) == TRUE ? "'1970-01-01 00:00:00'" : "'{$start_date}'";
            $end_date = is_null($end_date) == TRUE ? 'NOW()' : "'{$end_date}'";
            return "AND FROM_UNIXTIME(`dtable`.`date_created`) BETWEEN {$start_date} AND {$end_date}";
        } else {
            return '';
        }
    }

    /**
     * 
     * @param array $ordersData
     * @return array identical to $ordersData, but with zeros
     */
    protected function fillZero($ordersData) {
        reset($ordersData);
        $start = strtotime(key($ordersData));
        end($ordersData);
        $end = strtotime(key($ordersData));
        reset($ordersData);

        for ($i = $start; $i <= $end; $i += $this->dateRangeParams['date_step']) {
            $date = date($this->dateRangeParams['date_pattern_php'], $i);
            if (!key_exists($date, $ordersData)) {
                $ordersData[$date] = 0;
            }
        }
        return $ordersData;
    }

    /**
     * Get orders by price
     */
    public function getOrdersByPrice() {
        $sql = "SELECT shop_orders.date_created as x, sum(shop_orders_products.price) as y 
            FROM shop_orders 
            join shop_orders_products 
            on shop_orders.id=shop_orders_products.order_id
            group by shop_orders.date_created
            order by shop_orders.date_created";
        $res = $this->db->query($sql)->result_array();
        return $res;
    }

}

?>
