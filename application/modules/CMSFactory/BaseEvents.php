<?php

namespace CMSFactory;

abstract class BaseEvents {

    public $holder = array();

    /**
     * Returns or creates and returns an BaseEvents instance.
     * Is a static method. Chaining method allows you to simplify your syntax by connecting multiple functions.
     * @return Events
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    abstract static function create();

    /**
     * Declares a new event. The method adds the general pool of information about the event and sets it as held. The user can call the place where, in his opinion, there is a need. Will be generated key that consists of a pair of "Class: method."
     * @param mixed $data <b>[optional]</b>Fetch some Data and peredaje to user method's
     * @access public
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerEvent($data = null) {
        $trace = debug_backtrace();
        $key = sprintf('%s:%s', $trace[1]['class'], $trace[1]['function']);
        $this->storage[$key]['run'] = TRUE;
        $this->storage[$key]['params'] = $data;
        return $this;
    }

    /**
     *
     * @return BehaviorFactory
     * @access
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function onAddToCart() {
        $this->key = 'Cart:add';
        return $this;
    }

    public function onCartShowed() {
        $this->key = 'Cart:index';
        return $this;
    }

    public function onСategoryCreate() {
        $this->key = 'Categories:сreate';
        return $this;
    }

    public function onRemoveFromCart() {
        $this->key = 'SCart:removeOne';
        return $this;
    }

    public function onShopCategoryCreate() {
        $this->key = 'ShopAdminCategories:create';
        return $this;
    }

    public function onShopCategoryEdit() {
        $this->key = 'ShopAdminCategories:edit';
        return $this;
    }

    /**
     * Binds a custom method to the event.
     * <br/><br/><code>
     * public function autoload() {<br/>
     * &emsp;&emsp;\CMSFactory\Events::create()->addСorrelation('myMethod', 'Comments::add');<br/>
     * }
     * </code>
     * @param string $methodName Indicates the name of the method that will be called in response to a trigger-event. The method will be matched in the class from which the requested binding.
     * @param string $alias <b>[optional]</b> The second parameter is optional if you make a call type was given an expected event.
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function addСorrelation($methodName, $alias = null) {
        if ($alias !== null && $this->key !== null)
            throw new \Exception("Can't declarete bouth.");
        $alias = ($this->key)? : $alias;
        if ($alias == null)
            throw new \Exception("Bind value can't not be null .");
        $trace = debug_backtrace();
        if ($this->holder[$methodName] != $trace[1]['class']) {
            $this->holder[$methodName] = $trace[1]['class'];
            $this->storage[$alias]['collable'][] = array('collMethod' => $methodName, 'collClass' => $trace[1]['class']);
        }
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
        foreach (Events::create()->storage as $key => $value) {
            if ($value['run'] === TRUE && count($value['collable']))
                foreach ($value['collable'] as $run)
                    call_user_func(array($run['collClass'], $run['collMethod']), $value['params']);
        }
        //\CMSFactory\Events::create()->get();
    }

    public function get() {
        var_dumps($this->storage);
    }

}

?>