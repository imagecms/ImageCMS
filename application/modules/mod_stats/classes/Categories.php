<?php

namespace mod_stats\classes;

/**
 * Description of Products
 *
 * @author kolia
 */
class Categories extends \MY_Controller {

    protected static $instanse;

    /**
     * 
     * @return Products
     */
    public static function create() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return self::$_instance;
    }

   


}

?>
