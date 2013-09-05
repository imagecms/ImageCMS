<?php

/**
 * Orders model
 * @author Igor R.
 * @copyright ImageCMS (c) 2013, Igor R. <dev@imagecms.net>
 */
class Stats_model_orders extends CI_Model {

    protected $locale;

    public function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }

    /**
     * Get orders by price
     */
    public function getOrdersByPrice() {
        $sql = "SELECT shop_orders.date_created as x, sum(shop_orders_products.price) as y 
            FROM shop_orders 
            join shop_orders_products 
            on shop_orders.id=shop_orders_products.order_id
            group by shop_orders.date_created";

        $res = $this->db->query($sql)->result_array();
        return $res;
    }

}

?>
