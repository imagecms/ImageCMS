<?php

namespace mod_stats\classes;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class BaseStats for mod_stats module
 * @uses \MY_Controller
 * @author DevImageCms
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 */
class BaseStats extends \MY_Controller {

    protected static $_instance;

     /**
     * __construct base object loaded
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function __construct() {
        parent::__construct();
        $lang = new \MY_Lang();
        $lang->load('mod_stats');
        
    }

    /**
     *
     * @return BaseStats
     */
    public static function create() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return self::$_instance;
    }
    
    
    
    
}
