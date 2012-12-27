<?php

namespace behaviorFactory;

class BehaviorFactory {

    protected static $_BehaviorInstance;
    public $toCall = array();

    public function __construct() {
        
    }

    private function __clone() {
        
    }

    public static function getInstance() {
        if (null === self::$_BehaviorInstance)
            self::$_BehaviorInstance = new self();
        return self::$_BehaviorInstance;
    }

    public function call() {
        $instance = self::getInstance();
        $trace = debug_backtrace();
        array_push($instance->toCall, array($trace[1]['function'], $trace[1]['class']));
    }

    public function get() {
        $instance = self::getInstance();
        var_dumps($instance->toCall);
    }

    /**
     *      
     * @access 
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public static function create($methodName, $method, $className) {
        $instance = self::getInstance();
        $trace = debug_backtrace();
        $instance->toCall['key_test'] = array('callMethod' => $methodName, 'callClass' => $trace[1]['class'], 'ifClass' => $className, 'ifMethod' => $method);
//        foreach ($instance->toCall as $key => $callable)
//            if (in_array($method, $callable) AND in_array($className, $callable)) {
//                $instance->toCall[$key]['run']['class'] = 'sda';
//                $instance->toCall[$key]['run']['method'] = 'sda';
//            }
//        call_user_func(array($trace[1]['class'], $methodName));
        var_dumps($instance->toCall);
    }

    public function runFactory() {
        $instance = self::getInstance();
        $trace = debug_backtrace();
        foreach ($instance->toCall as $temp) {
            call_user_func(array($temp['callClass'], $temp['callMethod']));
        }
    }

}

?>