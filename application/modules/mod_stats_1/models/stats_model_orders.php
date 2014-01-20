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

        $lineDiagramBase = new \mod_stats\classes\LineDiagramBase();

        $query = "
            SELECT
                DATE_FORMAT(FROM_UNIXTIME(`dtable`.`date_created`), '" . $lineDiagramBase->prepareDatePattern() . "') as `date`,
                COUNT(`dtable`.`id`) as `orders_count`,
                SUM(`dtable`.`origin_price`) as `price_sum`,
                SUM(`dtable`.`products_count`) as `products_count`,
                SUM(`dtable`.`quantity`) as `quantity`,
                SUM(`dtable`.`status`) as `delivered`
            FROM 
                (SELECT 
                    `shop_orders`.`id`,
                    `shop_orders`.`date_created`,
                    `shop_orders`.`paid`,
                    -- IF(ISNULL(`shop_orders`.`origin_price`), 0, `shop_orders`.`origin_price`) as `origin_price`,
                    SUM(`shop_orders_products`.`price`) as `origin_price`,
                    IF(`shop_orders`.`status` = 2, 1, 0) as `status`,
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
                 " . $lineDiagramBase->prepareDateBetweenCondition('date_created') . " 
                  " . $this->preparePaidCondition() . " 
            GROUP BY `date`
            ORDER BY FROM_UNIXTIME(`date_created`)
        ";

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

}

?>
