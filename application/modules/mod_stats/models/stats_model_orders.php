<?php

/**

 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Stats_model_orders extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }

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
        foreach($result->result_array() as $row)  {
            $orders[] = $row;
        }
        return $orders;
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
