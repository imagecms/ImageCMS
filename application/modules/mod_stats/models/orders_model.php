<?php

/**

 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Orders_model extends CI_Model {

    use DateIntervalTrait;

    protected function prepareConditions(array $params) {

        $paidCondition = "";
        if (isset($params['paid'])) {
            switch ($params['paid']) {
                case 1:
                    $paidCondition = "AND `paid` = 1";
                    break;
                case 0:
                    $paidCondition = "AND (`paid` <> 1 OR `paid` IS NULL)";
                    break;
            }
        }

        $betweenCondition = "";
        if (isset($params['dateFrom']) || isset($params['dateTo'])) {
            $dateFrom = isset($params['dateFrom']) ? $params['dateFrom'] : '2005-01-01';
            $dateTo = isset($params['dateTo']) ? $params['dateTo'] : date('Y-m-d');
            $betweenCondition = "AND FROM_UNIXTIME(`date_created`) BETWEEN '{$dateFrom} 00:00:00' AND '{$dateTo} 23:59:59'";
        }

        return array($paidCondition, $betweenCondition);
    }

    /**
     * 
     * @param array $params
     * @return boolean|array
     * arrays with fields:
     *  - orders_count
     *  - price_sum
     *  - products_count
     *  - quantity
     *  - delivered
     */
    public function getOrdersInfo(array $params = array()) {
        list($paidCondition, $betweenCondition) = $this->prepareConditions($params);

        $interval = isset($params['interval']) ? $params['interval'] : NULL;

        $query = "
            SELECT
                `dtable`.`date_created` as `unix_date`,
                DATE_FORMAT(FROM_UNIXTIME(`dtable`.`date_created`), '" . $this->getDatePattern($interval) . "') as `date`,
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
                {$betweenCondition}
                {$paidCondition} 
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

}

?>
