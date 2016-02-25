<?php

use CMSFactory\assetManager;
use CMSFactory\Events;

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
     * @param Search $categoryObj
     */
    public static function CategorySearchPageLoad($categoryObj) {

        $products = $categoryObj->data['products'] ? $categoryObj->data['products']->getData() : $categoryObj['products']->getData();

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
                $brand = $product->getBrand() ? $product->getBrand()->getName() : '';
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

        /* @var $model SProducts */
        $model = $data['model'];

        $gaProduct = [];
        $gaProduct['id'] = $model->getId();
        $gaProduct['name'] = $model->getName();
        $gaProduct['price'] = $model->getFirstVariant()->toCurrency();
        $gaProduct['brand'] = $model->getBrand() ? $model->getBrand()->getName() : '';
        $gaProduct['category'] = $model->getMainCategory()->getName();

        assetManager::create()
            ->registerJsScript('var gaProduct = ' . json_encode($gaProduct) . ';', FALSE, 'before')
            ->registerScript('product', FALSE, 'after');
    }

    /**
     * @throws Exception
     */
    public function autoload() {

        $settings = $this->cms_base->get_settings();

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
     * @param array $data
     */
    public static function ShopOrderView($data) {

        /** @var $data SOrders */
        if ($data instanceof SOrders && CI::$APP->session->flashdata('makeOrderForGA')) {

            $order['id'] = $data->getKey();
            $order['revenue'] = $data->getTotalPrice();
            $order['shipping'] = $data->getDeliveryPrice() ?: 0;

            $products = [];
            foreach ($data->getSOrderProductss() as $key => $orderProduct) {
                $productVariant = $orderProduct->getVariant();
                if ($productVariant instanceof SProductVariants) {
                    $product = $productVariant->getSProducts();

                    $products[$key]['id'] = $productVariant->getId();
                    $products[$key]['name'] = $orderProduct->getProductName();
                    $products[$key]['price'] = $orderProduct->getPrice();
                    $products[$key]['brand'] = $product->getBrand() ? $product->getBrand()->getName() : '';
                    $products[$key]['category'] = $product->getMainCategory()->getName();
                    $products[$key]['variant'] = $productVariant->getName();
                    $products[$key]['position'] = $key;
                    $products[$key]['quantity'] = $orderProduct->getQuantity();
                }

            }

            assetManager::create()
                ->registerJsScript('var gaOrderObject = ' . json_encode($order) . ';')
                ->registerJsScript('var gaOrderProductsObject = ' . json_encode($products) . ';')
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