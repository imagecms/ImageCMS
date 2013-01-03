<?php

namespace behaviorFactory;

abstract class BaseBehaviorFactory {

    /**
     * Singleton realization for BehaviorFactory
     * @access public static
     * @return BehaviorFactory     
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    abstract static function create();

    /**
     * Check in some state for Factory
     * @param mixed $value Fetch some Data and peredaje to user method's
     * @access public
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function registerEvent($value = null) {
        $trace = debug_backtrace();
        $key = sprintf('%s:%s', $trace[1]['class'], $trace[1]['function']);
        $this->storage[$key]['run'] = TRUE;
        $this->storage[$key]['params'] = $value;
    }

    /**
     * 
     * @return BehaviorFactory
     * @access 
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function onItemAdd() {
        $this->key = 'Cart:add';
        return $this;
    }
    public function onItemRemove() {
        $this->key = 'Cart:delete';
        return $this;
    }

    /**
     * Bind new Behavior
     * @return void
     * @access 
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function bind($callMethod, $alias = null) {
        if ($alias !== null && $this->key !== null)
            throw new \Exception("Can't declarete bouth.");
        $alias = ($this->key)? : $alias;
        if ($alias == null)
            throw new \Exception("Bind value can't not be null .");
        $trace = debug_backtrace();
        $this->storage[$alias]['collable'][] = array('collMethod' => $callMethod, 'collClass' => $trace[1]['class']);
    }

    public function get() {
        var_dumps($this->storage);
    }

    /**
     * Run Behavior factory when contoller is comletly loaded
     * @return void
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function runFactory() {
        (defined('BASEPATH')) OR exit('No direct script access allowed');
        foreach (BehaviorFactory::create()->storage as $key => $value) {
            if ($value['run'] === TRUE && count($value['collable']))
                foreach ($value['collable'] as $run)
                    call_user_func(array($run['collClass'], $run['collMethod']), $value['params']);
        }
    }

}

?>