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
    
    
    
    protected function getOrdersAndCounts() {
        $query = "
            SELECT 
                `shop_orders`.`date_created` as x,
                COUNT(`shop_orders_products`.`order_id`) as y
                `shop_orders`.`paid`
            FROM `shop_orders`
            LEFT JOIN `shop_orders_products` ON `shop_orders`.`id` = `shop_orders_products`.`order_id`
            GROUP BY x
            ORDER BY x ASC
        ";
        $result = $this->db->query($query);
        $paid = array();
        
        while($row = $result->result_array()) {
            
        }
    }

}

?>
