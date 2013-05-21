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
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['id']</td><td>Page ID</td></tr>
     * <tr valign="top"><td>['title']</td><td>Page title</td></tr>
     * <tr valign="top"><td>['full_text']</td><td>Page full text</td></tr>
     * <tr valign="top"><td>['prev_text']</td><td>Page short text</td></tr>
     * </table>
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminPageCreate() {
        $this->key = 'Page:create';
        return $this;
    }

    final public function onAdminPagePreEdit() {
        $this->key = 'BaseAdminPage:preUpdate';
        return $this;
    }

    final public function onAdminPagePreCreate() {
        $this->key = 'BaseAdminPage:preCreate';
        return $this;
    }

    /*
     * 
     */

    final public function on($key) {
        $this->key = $key;
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['id']</td><td>Page ID</td></tr>
     * <tr valign="top"><td>['title']</td><td>Page title</td></tr>
     * <tr valign="top"><td>['full_text']</td><td>Page full text</td></tr>
     * <tr valign="top"><td>['prev_text']</td><td>Page short text</td></tr>
     * </table>
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminPageUpdate() {
        $this->key = 'Page:update';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['id']</td><td>Page ID</td></tr>
     * <tr valign="top"><td>['title']</td><td>Page title</td></tr>
     * <tr valign="top"><td>['full_text']</td><td>Page full text</td></tr>
     * <tr valign="top"><td>['prev_text']</td><td>Page short text</td></tr>     
     * </table>
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminPageDelete() {
        $this->key = 'Page:delete';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['userId']</td><td>User ID</td></tr>
     * <tr valign="top"><td>['name']</td><td>Category name</td></tr>
     * <tr valign="top"><td>['url']</td><td>Category url</td></tr>
     * <tr valign="top"><td>['short_desc']</td><td>Category short description</td></tr>     
     * </table>
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminCategoryCreate() {
        $this->key = 'Categories:create';
        return $this;
    }

    final public function onAdminCategoryPreCreate() {
        $this->key = 'BaseAdminCategory:preCreate';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['userId']</td><td>User ID</td></tr>
     * <tr valign="top"><td>['name']</td><td>Category name</td></tr>
     * <tr valign="top"><td>['url']</td><td>Category url</td></tr>
     * <tr valign="top"><td>['short_desc']</td><td>Category short description</td></tr>
     * </table>
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminCategoryUpdate() {
        $this->key = 'Categories:update';
        return $this;
    }

    final public function onAdminCategoryPreUpdate() {
        $this->key = 'Categories:preUpdate';
        return $this;
    }

    final public function onWidgetModulePreUpdate() {
        $this->key = 'WidgetModule:preUpdate';
        return $this;
    }

    final public function onWidgetHTMLPreUpdate() {
        $this->key = 'WidgetHTML:preUpdate';
        return $this;
    }

    final public function onAdminDashboardShow() {
        $this->key = 'Dashboard:show';
        return $this;
    }

    final public function onShopDashboardShow() {
        $this->key = 'ShopDashboard:show';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['userId']</td><td>User ID</td></tr>
     * <tr valign="top"><td>['productId']</td><td>Product ID</td></tr>
     * </table>
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onShopProductUpdate() {
        $this->key = 'ShopAdminProducts:edit';
        return $this;
    }

    final public function onShopProductPreUpdate() {
        $this->key = 'ShopAdminProducts:preEdit';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['userId']</td><td>User ID</td></tr>
     * <tr valign="top"><td>['productId']</td><td>Product ID</td></tr>
     * </table>
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onShopProductCreate() {
        $this->key = 'ShopAdminProducts:create';
        return $this;
    }

    final public function onShopProductPreCreate() {
        $this->key = 'ShopAdminProducts:preCreate';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['userId']</td><td>User ID</td></tr>
     * <tr valign="top"><td>['model']</td><td></td>Instanceof SProducts</tr>
     * </table>
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onShopProductDelete() {
        $this->key = 'ShopAdminProducts:delete';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['ShopCategoryId']</td><td>Category ID</td></tr>
     * </table>
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function onShopCategoryCreate() {
        $this->key = 'ShopAdminCategories:create';
        return $this;
    }

    public function onShopCategoryPreCreate() {
        $this->key = 'ShopAdminCategories:preCreate';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['ShopCategoryId']</td><td>Category ID</td></tr>
     * </table>
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function onShopCategoryEdit() {
        $this->key = 'ShopAdminCategories:edit';
        return $this;
    }

    public function onShopCategoryPreEdit() {
        $this->key = 'ShopAdminCategories:preEdit';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['ShopCategoryId']</td><td>Category ID</td></tr>
     * </table>
     * @return BehaviorFactory
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function onShopCategoryDelete() {
        $this->key = 'ShopAdminCategories:delete';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['commentId']</td><td>Comment ID</td></tr>
     * </table>
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

    public function onBrandPageLoad() {
        $this->key = 'brand:load';
        return $this;
    }

    public function onCategoryPageLoad() {
        $this->key = 'category:load';
        return $this;
    }

    public function onProductPageLoad() {
        $this->key = 'product:load';
        return $this;
    }

}

/* End of file /application/modules/CMSFactory/BaseEvents.php */
?>