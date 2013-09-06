<?php

namespace mod_stats\classes;

/**
 * Users stats 
 * 
 * @author Igor R.
 * @copyright ImageCMS (c) 2013, Igor R. <dev@imagecms.net>
 */
class Users extends \MY_Controller {

    protected static $instanse;
    
    public function __construct() {
        parent::__construct();
        /** Load users model **/
        $this->load->model('stats_model_users');
    }
    
    /**
     * 
     * @return Users
     */
    public static function create() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return self::$_instance;
    }
    
    
    public function getOnline() {
        
    }
    
    
    
}

?>
