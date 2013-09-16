<?php

/**
 * Description of ProductsBase
 *
 * @author kolia
 */
class Stats_model_users extends CI_Model {

    protected $locale;

    /**
     * Default params for method getOrdersByDateRange
     * @var array
     */
    protected $params = array(
        'interval' => 'day', //  date interval (string: day|month|week|year)
        'start_date' => NULL, // NULL for all or date in format (string: YYYY-MM-DD)
        'end_date' => NULL, // NULL for all or date in format (string: YYYY-MM-DD)
    );

    public function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }

    public function getUsersOnline() {
        
    }

    public function getRegister($params) {
        if (is_array($params)) {
            foreach ($this->params as $key => $value) {
                if (key_exists($key, $params)) {
                    $this->params[$key] = $params[$key];
                }
            }
        }

        $lineDiagramBase = new \mod_stats\classes\LineDiagramBase();

        $query = "
            SELECT
                DATE_FORMAT(FROM_UNIXTIME(`created`), '" . $lineDiagramBase->prepareDatePattern() . "') as `date`,
                COUNT(`id`) as `count`
            FROM 
                (SELECT 
                    `users`.`id`,
                    `users`.`created`
                 FROM 
                    `users`
                 WHERE 1
                     AND FROM_UNIXTIME(`users`.`created`) <= NOW() + INTERVAL 1 DAY 
                 GROUP BY 
                    `users`.`id`
                 ORDER BY 
                    FROM_UNIXTIME(`users`.`created`)
                ) as dtable
            WHERE 1 
                 " . $lineDiagramBase->prepareDateBetweenCondition('created') . " 
            GROUP BY `date`
            ORDER BY FROM_UNIXTIME(`created`)
        ";

        $result = $this->db->query($query);
        if ($result === FALSE) {
            return FALSE;
        }
        $data = array();
        foreach ($result->result_array() as $row) {
            $data[] = $row;
        }

        return $data;
    }

    public function getInformation() {
        $lineDiagramBase = new \mod_stats\classes\LineDiagramBase();

        $params = $lineDiagramBase->getParamsFromCookies();

        $query = "
            SELECT
                DATE_FORMAT(FROM_UNIXTIME(`date_created`), '" . $lineDiagramBase->prepareDatePattern() . "') as `date`,
                COUNT(`order_id`) as `orders_count`,
                SUM(`paid`) as `paid`,
                SUM(`status`) as `delivered`,
                SUM(`origin_price`) as `price_sum`,
                SUM(`products_count`) as `products_count`,
                SUM(`quantity`) as `quantity`,
                GROUP_CONCAT(`order_id` SEPARATOR ', ') as `orders_ids`,
                `username`,
                `user_id`
            FROM 
                (SELECT 
                    `shop_orders`.`id` as `order_id`,
                    `shop_orders`.`date_created`,
                    IFNULL(`shop_orders`.`paid`, 0) as `paid`,
                    SUM(`shop_orders_products`.`price`) as `origin_price`,
                    IF(`shop_orders`.`status` = 2, 1, 0) as `status`,
                    COUNT(`shop_orders_products`.`order_id`) as `products_count`,
                    SUM(`shop_orders_products`.`quantity`) as `quantity`,
                    IFNULL(`users`.`id`,'-') as `user_id`, 
                    IFNULL(`users`.`username`,'-') as `username`
                 FROM 
                    `shop_orders`
                 LEFT JOIN `shop_orders_products` ON `shop_orders_products`.`order_id` = `shop_orders`.`id`
                 LEFT JOIN `users` ON `shop_orders`.`user_id` = `users`.`id`
                 WHERE 1
                    AND FROM_UNIXTIME(`shop_orders`.`date_created`) <= NOW() + INTERVAL 1 DAY 
                    " . $lineDiagramBase->prepareDateBetweenCondition('date_created') . "
                 GROUP BY 
                   `shop_orders`.`id`
                 ORDER BY 
                   FROM_UNIXTIME(`shop_orders`.`date_created`)
                ) as dtable                  
            GROUP BY `username`
            ORDER BY `orders_count` DESC
        ";
        
        $result = $this->db->query($query);
        if ($result === FALSE) {
            return FALSE;
        }
        $data = array();
        foreach ($result->result_array() as $row) {
            $data[] = $row;
        }

        return $data;
    }

}

?>
