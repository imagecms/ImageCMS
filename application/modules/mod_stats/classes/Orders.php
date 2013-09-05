<?php

namespace mod_stats\classes;

/**
 * Description of Products
 *
 * @author kolia
 */
class Orders extends \MY_Controller {

    protected static $instanse;

    /**
     * 
     * @return Products
     */
    public static function create() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return self::$_instance;
    }
    
    
    /**
     * Returns json data for line diagram about orders by date
     * @param string $interval year|month|week|day
     * @param string $begin date in format DD-MM-YYYY
     */
    public function date($interval = 'year') {
        
    }

   


}

?>
