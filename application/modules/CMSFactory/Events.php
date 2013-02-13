<?php

namespace CMSFactory;

class Events extends BaseEvents {

    protected static $_BehaviorInstance;
    public $storage = array();
    public $key = null;

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    public static function create() {
        (null !== self::$_BehaviorInstance) OR self::$_BehaviorInstance = new self();
        return self::$_BehaviorInstance;
    }

}

?>