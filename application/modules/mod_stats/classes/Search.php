<?php

namespace mod_stats\classes;

/**
 * Description of Products
 *
 * @author kolia
 */
class Search extends \MY_Controller {

    protected static $instanse;

    /**
     * 
     * @return Search
     */
    public static function create() {
        (null !== self::$instanse) OR self::$instanse = new self();
        return self::$instanse;
    }

    
   /**
     * Table representation for keywords searched
     */
    public function templateKeywordsSearched() {
        $params = $this->getParamsFromCookies();
        $orders = $this->stats_model_orders->getOrdersByDateRange($params);
        return $orders;
    }


}

?>
