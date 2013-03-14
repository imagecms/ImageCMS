<?php

namespace CMSFactory;

/**
 * @abstract
 * @version CMS Event system v.1 Beta
 */
abstract class BaseEvents {

    public $holder = array();

    /**
     * Returns or creates and returns an BaseEvents instance.
     * Is a static method. Chaining method allows you to simplify your syntax by connecting multiple functions.
     * @return Events
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    abstract static function create();

    /**
     * Declares a new event. The method adds the general pool of information about the event and sets it as held. The user can call the place where, in his opinion, there is a need. Will be generated key that consists of a pair of "Class: method."
     * @param mixed $data <b>[optional]</b>Fetch some Data and peredaje to user method's
     * @access public
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerEvent($data = null, $key = null) {
        if (NULL == $key) {
            $trace = debug_backtrace();
            $key = $trace[1]['class'] . ':' . $trace[1]['function'];
        }
        $this->storage[$key]['run'] = TRUE;
        $this->storage[$key]['params'] = $data;
        return $this;
    }

    /**
     * Binds a custom method to the event.
     * <br/><br/><code>
     * public function autoload() {<br/>
     * &emsp;&emsp;\CMSFactory\Events::create()->setListener('myMethod', 'Comments::add');<br/>
     * }
     * </code>
     * @param string $methodName Indicates the name of the method that will be called in response to a trigger-event. The method will be matched in the class from which the requested binding.
     * @param string $alias <b>[optional]</b> The second parameter is optional if you make a call type was given an expected event.
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function setListener($methodName, $alias = null) {
        if ($alias !== null && $this->key !== null)
            throw new \Exception("Can't declarete bouth.");
        $alias = ($this->key)? : $alias;
        if ($alias == null)
            throw new \Exception("Bind value can't not be null.");
        $trace = debug_backtrace();
        if ($this->holder[$alias][$methodName] != $trace[1]['class']) {
            $this->holder[$alias][$methodName] = $trace[1]['class'];
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
//        \CMSFactory\Events::create()->get();
    }

    public function get() {
        var_dumps($this->storage);
    }

    /**
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminPageCreate() {
        $this->key = 'Page:create';
        return $this;
    }

    /**
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminPageUpdate() {
        $this->key = 'Page:update';
        return $this;
    }

    /**
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminPageDelete() {
        $this->key = 'Page:delete';
        return $this;
    }

    /**
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminСategoryCreate() {
        $this->key = 'Categories:create';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['name']</td><td>Category name</td></tr>
     * <tr valign="top"><td>['url']</td><td></td></tr>
     * <tr valign="top"><td>['short_desc']</td><td></td></tr>
     * <tr valign="top"><td>['parent_id']</td><td></td></tr>
     * <tr valign="top"><td>['description']</td><td></td></tr>
     * <tr valign="top"><td>['userId']</td><td></td></tr>
     * </table>
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminСategoryUpdate() {
        $this->key = 'Categories:update';
        return $this;
    }

    /**
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onShopProductUpdate() {
        $this->key = 'ShopAdminProducts:edit';
        return $this;
    }

    /**
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onShopProductCreate() {
        $this->key = 'ShopAdminProducts:create';
        return $this;
    }

    /**
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onShopProductDelete() {
        $this->key = 'ShopAdminProducts:delete';
        return $this;
    }

    /**
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function onShopCategoryCreate() {
        $this->key = 'ShopAdminCategories:create';
        return $this;
    }

    /**
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function onShopCategoryEdit() {
        $this->key = 'ShopAdminCategories:edit';
        return $this;
    }

    /**
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAddComment() {
        $this->key = 'Commentsapi:newPost';
        return $this;
    }

    /** */
    /** */
    /** */

    /** */
    public function onAddToCart() {
        $this->key = 'Cart:add';
        return $this;
    }

    public function onCartShowed() {
        $this->key = 'Cart:index';
        return $this;
    }

    public function onRemoveFromCart() {
        $this->key = 'SCart:removeOne';
        return $this;
    }

}

/* End of file /application/modules/CMSFactory/BaseEvents.php */
?>