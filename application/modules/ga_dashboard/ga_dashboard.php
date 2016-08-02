<?php

use CMSFactory\assetManager;
use CMSFactory\Events;
use Propel\Runtime\Exception\PropelException;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 * @property Cms_base $cms_base
 * @link https://enhancedecommerce.appspot.com/
 */
class Ga_dashboard extends MY_Controller
{

    /**
     * Ga_dashboard constructor.
     */
    public function __construct() {

        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('ga_dashboard');
    }

    /**
     * @throws Exception
     */
    public function autoload() {

        $settings = $this->cms_base->get_settings();

        if ($settings['yandex_metric'] != '') {
            assetManager::create()->registerJsScript('window.dataLayer = window.dataLayer || [];', false, 'before');
            Events::create()->onProductPageLoad()->setListener('YMProductPageLoad');
            Events::create()->onShopOrderView()->setListener('YMShopOrderView');
        }

        if ($settings['google_analytics_ee'] == 1 and $settings['google_analytics_id'] != '') {
            Events::create()->onProductPageLoad()->setListener('ProductPageLoad');
            //            Events::create()->onAddItemToCart()->setListener('ProductAddToCart');
            Events::create()->onCategoryPageLoad()->setListener('CategorySearchPageLoad');
            Events::create()->onSearchPageLoad()->setListener('CategorySearchPageLoad');
            Events::create()->onBrandPageLoad()->setListener('CategorySearchPageLoad');
            Events::create()->onShopOrderView()->setListener('ShopOrderView');
        }
    }

    /**
     * @param Search $categoryObj
     * @throws PropelException
     */
    public static function CategorySearchPageLoad($categoryObj) {

        $products = $categoryObj->data['products'] ?: $categoryObj['products'];

        if (count($products) > 0) {

            $url = CI::$APP->uri->uri_string();

            if (false !== strpos($url, 'shop/search')) {
                $list = 'search_page';
            } elseif (false !== strpos($url, 'shop/category')) {
                $list = 'category_page';
            } elseif (false !== strpos($url, 'shop/brand')) {
                $list = 'brand_page';
            }

            /* @var $product SProducts */
            $gaProducts = [];
            foreach ($products as $key => $product) {
                $SBrands = $product->getBrand();
                $brand = $SBrands ? $SBrands->getName() : '';
                $gaProducts[$key]['id'] = $product->getId();
                $gaProducts[$key]['name'] = $product->getName();
                $gaProducts[$key]['price'] = $product->getFirstVariant()->toCurrency();
                $gaProducts[$key]['brand'] = $brand;
                $gaProducts[$key]['category'] = $product->getMainCategory()->getName();
                $gaProducts[$key]['list'] = $list;
                $gaProducts[$key]['position'] = $key;
            }
            assetManager::create()
                ->registerJsScript('var gaProducts = ' . json_encode($gaProducts) . ';', FALSE, 'before')
                ->registerScript('category', TRUE, 'after');
        }
    }

    /**
     * @param $data
     */
    public static function ProductAddToCart($data) {
        return;
        if ($data['instance'] != 'SProducts') {
            return;
        }
        $model = SProductsQuery::create()
            ->joinProductVariant()
            ->useProductVariantQuery()
            ->filterById($data['id'])
            ->endUse()
            ->findOne();

        assetManager::create()
            ->registerJsScript("var id = {$model->getId()};", true, 'before')
            ->registerJsScript("var name = {$model->getName()};", FALSE, 'before')
            ->registerJsScript("var price = {$model->getFirstVariant()->toCurrency()};", FALSE, 'before')
            ->registerJsScript("var brand = {$model->getId()};", FALSE, 'before')
            ->registerJsScript("var category = {$model->getId()};", FALSE, 'before')
            ->registerScript('addToCart', TRUE, 'after');
    }

    public static function ProductPageLoad($data) {
        assetManager::create()
            ->registerJsScript('var gaProduct = ' . self::createProductData($data) . ';', FALSE, 'before')
            ->registerScript('product', FALSE, 'after');
    }

    public static function YMProductPageLoad($data) {

        assetManager::create()
            ->registerJsScript(
                'window.dataLayer.push({
                                    "ecommerce": {
                                        "detail" : {
                                            "products" : [' . self::createProductData($data) . ']
                                        }
                                    }
                                });',
                false,
                'before'
            );
        assetManager::create();
    }

    /**
     * @param array $data
     * @throws PropelException
     */
    public static function YMShopOrderView($data) {

        /** @var $data SOrders */
        if ($data instanceof SOrders && CI::$APP->session->flashdata('makeOrderForGA')) {

            assetManager::create()
                ->registerJsScript(
                    'window.dataLayer.push({
                                    "ecommerce": {
                                        "purchase" : {
                                            "actionField": ' . self::createOrderData($data, true) . ',
                                            "products" : ' . self::createOrderProductsData($data) . '
                                        }
                                    }
                                });',
                    false,
                    'before'
                );
        }
    }

    private static function createProductData($data) {
        /* @var $model SProducts */
        $model = $data['model'];

        $gaProduct = [];
        $gaProduct['id'] = $model->getId();
        $gaProduct['name'] = $model->getName();
        $gaProduct['price'] = $model->getFirstVariant()->toCurrency();
        $SBrands = $model->getBrand();
        $gaProduct['brand'] = $SBrands ? $SBrands->getName() : '';
        $gaProduct['category'] = $model->getMainCategory()->getName();

        return json_encode($gaProduct);
    }

    private static function createOrderData($data, $ym = false) {
        $order['id'] = $data->getKey();
        $order['revenue'] = $data->getTotalPrice();
        if (!$ym) {
            $order['shipping'] = $data->getDeliveryPrice() ?: 0;
        }
        return json_encode($order);
    }

    private static function createOrderProductsData($data) {
        $products = [];
        foreach ($data->getSOrderProductss() as $key => $orderProduct) {
            $productVariant = $orderProduct->getVariant();
            if ($productVariant instanceof SProductVariants) {
                $product = $productVariant->getSProducts();

                $products[$key]['id'] = $productVariant->getId();
                $products[$key]['name'] = $orderProduct->getProductName();
                $products[$key]['price'] = $orderProduct->getPrice();
                $SBrands = $product->getBrand();
                $products[$key]['brand'] = $SBrands ? $SBrands->getName() : '';
                $products[$key]['category'] = $product->getMainCategory()->getName();
                $products[$key]['variant'] = $productVariant->getName();
                $products[$key]['position'] = $key;
                $products[$key]['quantity'] = $orderProduct->getQuantity();
            }

        }

        return json_encode($products);
    }

    /**
     * @param array $data
     * @throws PropelException
     */
    public static function ShopOrderView($data) {

        /** @var $data SOrders */
        if ($data instanceof SOrders && CI::$APP->session->flashdata('makeOrderForGA')) {

            assetManager::create()
                ->registerJsScript('var gaOrderObject = ' . self::createOrderData($data) . ';')
                ->registerJsScript('var gaOrderProductsObject = ' . self::createOrderProductsData($data) . ';')
                ->registerScript('order_view', FALSE, 'after');
        }
    }

    public function index() {
    }

    public function _deinstall() {
    }

    public function _install() {
        $this->db
            ->where('name', 'ga_dashboard')
            ->update('components', ['autoload' => '1', 'enabled' => '1']);
    }

}

/* End of file sample_module.php */