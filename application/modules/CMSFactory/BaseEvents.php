<?php

namespace CMSFactory;

use Closure;
use Exception;

/**
 * @abstract
 * @version CMS Event system v.1 Beta
 */
abstract class BaseEvents
{

    /**
     * @var array
     */
    public $holder = [];

    /**
     * @var string
     */
    public $key;

    /**
     * @var array
     */
    protected $storage = [];

    final public function ShopAdminPropertiesCreate() {

        $this->key = 'ShopAdminProperties:create';
        return $this;
    }

    final public function ShopAdminPropertiesFastCreate() {

        $this->key = 'ShopAdminProperties:fastCreate';
        return $this;
    }

    final public function ShopAdminPropertiesPreCreate() {

        $this->key = 'ShopAdminProperties:preCreate';
        return $this;
    }

    final public function ShopAdminPropertiesPreFastCreate() {

        $this->key = 'ShopAdminProperties:preFastCreate';
        return $this;
    }

    final public function onShopPropertiesDelete() {

        $this->key = 'ShopAdminProperties::delete';
        return $this;
    }

    final public function onShopPropertiesEdit() {

        $this->key = 'ShopAdminProperties:edit';
        return $this;
    }

    public function get() {

        //var_dumps($this->storage);
    }

    /**
     * @param string $key
     * @return $this
     */
    final public function on($key) {

        $this->key = $key;
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['commentId']</td><td>Comment ID</td></tr>
     * </table>
     * @return BaseEvents
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAddComment() {

        $this->key = 'Commentsapi:newPost';
        return $this;
    }

    public function onAddItemToCart() {

        $this->key = 'Cart:addItem';
        return $this;
    }

    /** */
    public function onAddToCart() {

        $this->key = 'Cart:add';
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
     * @return BaseEvents
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminCategoryCreate() {

        $this->key = 'Categories:create';
        return $this;
    }

    final public function onAdminCategoryDelete() {

        $this->key = 'Categories:delete';
        return $this;
    }

    /**
     * @return $this
     */
    final public function onAdminCategoryPreCreate() {

        $this->key = 'BaseAdminCategory:preCreate';
        return $this;
    }

    final public function onAdminCategoryPreUpdate() {

        $this->key = 'Categories:preUpdate';
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
     * @return BaseEvents
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminCategoryUpdate() {

        $this->key = 'Categories:update';
        return $this;
    }

    final public function onAdminDashboardShow() {

        $this->key = 'Dashboard:show';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * @return BaseEvents
     * @author a.gula
     * @copyright ImageCMS (c) 2014, a.gula <a.gula@imagecms.net>
     */
    public function onAdminModulesTable() {

        $this->key = 'Components:modules_table';
        return $this;
    }

    final public function onAdminOrderUserCreate() {

        $this->key = 'AdminOrder:userCreate';
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
     * @return BaseEvents
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminPageCreate() {

        $this->key = 'Page:create';
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
     * @return BaseEvents
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminPageDelete() {

        $this->key = 'Page:delete';
        return $this;
    }

    final public function onAdminPagePreCreate() {

        $this->key = 'BaseAdminPage:preCreate';
        return $this;
    }

    final public function onAdminPagePreEdit() {

        $this->key = 'BaseAdminPage:preUpdate';
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
     * @return BaseEvents
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onAdminPageUpdate() {

        $this->key = 'Page:update';
        return $this;
    }

    final public function onAuthUserRegister() {

        $this->key = 'AuthUser:register';
        return $this;
    }

    public function onBrandPageLoad() {

        $this->key = 'brand:load';
        return $this;
    }

    public function onBrandsPageLoad() {

        $this->key = 'brands:load';
        return $this;
    }

    final public function onCartInit() {

        $this->key = 'Cart:Init';
        return $this;
    }

    public function onCartShowed() {

        $this->key = 'Cart:index';
        return $this;
    }

    public function onActionTypeSearch() {
        $this->key = 'Action_Type:preSearch';
        return $this;
    }

    public function onCategoryPageLoad() {

        $this->key = 'category:load';
        return $this;
    }

    public function onGalleryLoad() {
        $this->key = 'gallery:load';
        return $this;
    }

    public function onGalleryAlbumLoad() {
        $this->key = 'gallery:album';
        return $this;
    }

    public function onGalleryCategoryLoad() {
        $this->key = 'gallery:category';
        return $this;
    }

    final public function onCorePageLoaded() {

        $this->key = 'Core:pageLoaded';
        return $this;
    }

    final public function onFrontOrderUserCreate() {

        $this->key = 'FrontOrder:userCreate';
        return $this;
    }

    final public function onNotifyingRequest() {

        $this->key = 'Shop:notifyingRequest';
        return $this;
    }

    /**
     * @return $this
     */
    final public function onPageCategoryLoad() {

        $this->key = 'pageCategory:load';
        return $this;
    }

    /**
     * @return $this
     */
    final public function onPageLoad() {

        $this->key = 'page:load';
        return $this;
    }

    final public function onPaimentSystemSuccessPaid() {

        $this->key = 'PaimentSystem:successPaid';
        return $this;
    }

    public function onProductPageLoad() {

        $this->key = 'product:load';
        return $this;
    }

    final public function onProfileApiChangeInfo() {

        $this->key = 'ProfileApi:changeInfo';
        return $this;
    }

    public function onRemoveFromCart() {

        $this->key = 'SCart:removeOne';
        return $this;
    }

    final public function onSearchPageLoad() {

        $this->key = 'search:load';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * @return BaseEvents
     * @author a.gula
     * @copyright ImageCMS (c) 2014, a.gula <a.gula@imagecms.net>
     */
    public function onSeoExpertSave() {

        $this->key = 'SeoExpert:save';
        return $this;
    }

    final public function onShopAdminAjaxChangeOrderPaid() {

        $this->key = 'ShopAdminOrders:ajaxChangeOrdersPaid';
        return $this;
    }

    final public function onShopAdminAjaxChangeOrderStatus() {

        $this->key = 'ShopAdminOrders:ajaxChangeOrdersStatus';
        return $this;
    }

    final public function onShopAdminOrderCreate() {

        $this->key = 'ShopAdminOrder:create';
        return $this;
    }

    final public function onShopAdminOrderDelete() {

        $this->key = 'ShopAdminOrder:ajaxDeleteOrders';
        return $this;
    }

    final public function onShopAdminOrderEdit() {

        $this->key = 'ShopAdminOrders:edit';
        return $this;
    }

    /** */

    final public function onShopAdminOrderUserCreate() {

        $this->key = 'ShopAdminOrder:createUser';
        return $this;
    }

    /** */
    /** */

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['model']</td><td>Brand model</td></tr>
     * <tr valign="top"><td>['userId']</td><td>User Id</td></tr>
     * </table>
     * @return BaseEvents
     * @author Hellmark
     * @copyright ImageCMS (c) 2014, Hellmark <dev@imagecms.net>
     */
    public function onShopBrandCreate() {

        $this->key = 'ShopAdminBrands:create';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['brandId']</td><td>Brand Id</td></tr>
     * <tr valign="top"><td>['url']</td><td>Brand Url</td></tr>
     * </table>
     * @return BaseEvents
     * @author Hellmark
     * @copyright ImageCMS (c) 2014, Hellmark <dev@imagecms.net>
     */
    public function onShopBrandDelete() {

        $this->key = 'ShopAdminBrands:delete';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['model']</td><td>Brand model</td></tr>
     * <tr valign="top"><td>['url']</td><td>Brand Url</td></tr>
     * <tr valign="top"><td>['userId']</td><td>User Id</td></tr>
     * </table>
     * @return BaseEvents
     * @author Hellmark
     * @copyright ImageCMS (c) 2014, Hellmark <dev@imagecms.net>
     */
    public function onShopBrandEdit() {

        $this->key = 'ShopAdminBrands:edit';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * @return BaseEvents
     * @author a.gula
     * @copyright ImageCMS (c) 2014, a.gula <a.gula@imagecms.net>
     */
    public function onShopBrandPreCreate() {

        $this->key = 'ShopAdminBrands:preCreate';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['model']</td><td>Brand model</td></tr>
     * <tr valign="top"><td>['url']</td><td>Brand Url</td></tr>
     * <tr valign="top"><td>['userId']</td><td>User Id</td></tr>
     * </table>
     * @return BaseEvents
     * @author Hellmark
     * @copyright ImageCMS (c) 2014, Hellmark <dev@imagecms.net>
     */
    public function onShopBrandPreEdit() {

        $this->key = 'ShopAdminBrands:preEdit';
        return $this;
    }

    final public function onShopCallback() {

        $this->key = 'Shop:callback';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['ShopCategoryId']</td><td>Category ID</td></tr>
     * </table>
     * @return BaseEvents
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function onShopCategoryCreate() {

        $this->key = 'ShopAdminCategories:create';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['ShopCategoryId']</td><td>Category ID</td></tr>
     * </table>
     * @return BaseEvents
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
     * <tr valign="top"><td>['ShopCategoryId']</td><td>Category ID</td></tr>
     * </table>
     * @return BaseEvents
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function onShopCategoryEdit() {

        $this->key = 'ShopAdminCategories:edit';
        return $this;
    }

    public function onShopCategoryFastCreate() {

        $this->key = 'ShopAdminCategories:fastCreate';
        return $this;
    }

    public function onShopCategoryPreCreate() {

        $this->key = 'ShopAdminCategories:preCreate';
        return $this;
    }

    public function onShopCategoryPreEdit() {

        $this->key = 'ShopAdminCategories:preEdit';
        return $this;
    }

    public function onShopCategoryPreFastCreate() {

        $this->key = 'ShopAdminCategories:preFastCreate';
        return $this;
    }

    final public function onShopCategoryAjaxChangeShowInSite() {

        $this->key = 'ShopAdminCategories:ajaxChangeShowInSite';
        return $this;
    }

    final public function onShopDashboardShow() {

        $this->key = 'ShopDashboard:show';
        return $this;
    }

    final public function onShopMakeOrder() {

        $this->key = 'Cart:MakeOrder';
        return $this;
    }

    final public function onShopOrderView() {

        $this->key = 'Order:view';
        return $this;
    }

    final public function onShopProductAjaxChangeActive() {

        $this->key = 'ShopAdminProducts:ajaxChangeActive';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['userId']</td><td>User ID</td></tr>
     * <tr valign="top"><td>['productId']</td><td>Product ID</td></tr>
     * </table>
     * @return BaseEvents
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onShopProductCreate() {

        $this->key = 'ShopAdminProducts:create';
        return $this;
    }

    /**
     * <p>The possible returned elements from <b>setListener</b> are as follows:</p>
     * <table>
     * <tr valign="top"><td>['userId']</td><td>User ID</td></tr>
     * <tr valign="top"><td>['model']</td><td></td>Instanceof SProducts</tr>
     * </table>
     * @return BaseEvents
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onShopProductDelete() {

        $this->key = 'ShopAdminProducts:delete';
        return $this;
    }

    final public function onShopProductFastProdCreate() {

        $this->key = 'ShopAdminProducts:fastProdCreate';
        return $this;
    }

    final public function onShopProductPreCreate() {

        $this->key = 'ShopAdminProducts:preCreate';
        return $this;
    }

    final public function onShopProductPreFastProdCreate() {

        $this->key = 'ShopAdminProducts:prefastProdCreate';
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
     * @return BaseEvents
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    final public function onShopProductUpdate() {

        $this->key = 'ShopAdminProducts:edit';
        return $this;
    }

    final public function onShopSearchAC() {

        $this->key = 'search:AC';
        return $this;
    }

    final public function onShopUserAfterEdit() {

        $this->key = 'ShopAdminUsers:afterEdit';
        return $this;
    }

    final public function onShopUserBeforeEdit() {

        $this->key = 'ShopAdminUsers:beforeEdit';
        return $this;
    }

    final public function onShopUserCreate() {

        $this->key = 'ShopAdminUser:create';
        return $this;
    }

    final public function onWidgetHTMLPreUpdate() {

        $this->key = 'WidgetHTML:preUpdate';
        return $this;
    }

    final public function onWidgetModulePreUpdate() {

        $this->key = 'WidgetModule:preUpdate';
        return $this;
    }

    /**
     * @return $this
     */
    final public function onMakeCurrencyMain() {

        $this->key = 'ShopAdminCurrencies:makeCurrencyMain';
        return $this;
    }

    /**
     * Run listeners for one event. After running removes listeners.
     * @param array|object $data
     * @param string $eventAlias
     * @return $this
     */
    public function raiseEvent($data, $eventAlias) {

        $this->registerEvent($data, $eventAlias);
        $this->runFactory($eventAlias, false);
        return $this;
    }

    /**
     * Declares a new event. The method adds the general pool of information about the event and sets it as held.
     * The user can call the place where, in his opinion, there is a need.
     * Will be generated key that consists of a pair of "Class: method."
     * @param mixed $data <b>[optional]</b>Fetch some Data and peredaje to user method's
     * @param string $key
     * @access public
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     * @return $this
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
     * Run Behavior factory when controller is completely loaded
     * @param string $eventAlias
     * @param bool $cleanQueue
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public static function runFactory($eventAlias = null, $cleanQueue = false) {

        (defined('BASEPATH')) OR exit('No direct script access allowed');
        foreach (Events::create()->storage as $storageKey => $value) {
            if ($eventAlias != null && $eventAlias != $storageKey) {
                continue;
            }
            if (isset($value['run'])) {
                if ($value['run'] === TRUE && isset($value['collable'])) {
                    foreach ($value['collable'] as $collableKey => $run) {
                        Events::create()->storage[$storageKey]['run'] = false;
                        if ($run['isClosure'] === false) {
                            call_user_func([$run['collClass'], $run['collMethod']], $value['params']);
                        } else {
                            call_user_func($run['collMethod'], $value['params']);
                        }
                        if ($cleanQueue === true) {
                            unset(Events::create()->storage[$storageKey]['collable'][$collableKey]);
                        }
                    }
                }
            }
        }
    }

    /**
     * Removes specified event with all listeners
     * @param string $eventAlias
     */
    public function removeEvent($eventAlias) {

        if (isset($this->storage[$eventAlias])) {
            unset($this->storage[$eventAlias]);
        }
    }

    /**
     * Binds a custom method to the event.
     * <br/><br/><code>
     * public function autoload() {<br/>
     * &emsp;&emsp;\CMSFactory\Events::create()->setListener('myMethod', 'Comments::add');<br/>
     * }
     * </code>
     * @param string|array|Closure $callback Indicates the name of the method that will be called in response to a trigger-event. The method will be matched in the class from which the requested binding.
     * @param string $alias <b>[optional]</b> The second parameter is optional if you make a call type was given an expected event.
     * @throws Exception
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function setListener($callback, $alias = null) {

        if ($alias !== null && $this->key !== null) {
            throw new Exception("Can't declarete both.");
        }
        $alias = ($this->key) ?: $alias;
        if ($alias == null) {
            throw new Exception("Bind value can't not be null.");
        }

        $trace = debug_backtrace();
        $isClosure = false;
        if (is_string($callback)) {
            $method = $callback;
            $class = $trace[1]['class'];
        } elseif (is_array($callback)) {
            $method = $callback[1];
            $class = $callback[0];
        } elseif ($callback instanceof Closure) {
            $method = $callback;
            $class = $trace[1]['class'];
            $isClosure = true;
        } else {
            throw new Exception('Wrong argument type');
        }

        if ($isClosure == false && isset($this->holder[$alias]) && $this->holder[$alias][$method] == $class) {
            return;
        }
        if ($isClosure == false) {
            $this->holder[$alias][$method] = $class;
        }
        $storageData = [
                        'collMethod' => $method,
                        'collClass'  => $class,
                        'isClosure'  => $isClosure,
                       ];
        $this->storage[$alias]['collable'][] = $storageData;
    }

}