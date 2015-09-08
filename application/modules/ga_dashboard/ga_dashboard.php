<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 * @property Cms_base $cms_base
 */
class Ga_dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('ga_dashboard');
    }

    public function index() {

    }

    public function autoload() {
        $settings = $this->cms_base->get_settings();

        if ($settings['google_analytics_ee'] == 1 and $settings['google_webmaster'] != '') {
            CMSFactory\Events::create()->onProductPageLoad()->setListener('ProductPageLoad');
            //            CMSFactory\Events::create()->onAddItemToCart()->setListener('ProductAddToCart');
            CMSFactory\Events::create()->onCategoryPageLoad()->setListener('CategorySearchPageLoad');
            CMSFactory\Events::create()->onSearchPageLoad()->setListener('CategorySearchPageLoad');
            CMSFactory\Events::create()->onBrandPageLoad()->setListener('CategorySearchPageLoad');
        }
    }

    public static function CategorySearchPageLoad($categoryObj) {
        $products = $categoryObj->data['products']->getData();

        if (count($products) == 0) {
            return;
        }

        if (strstr(CI::$APP->uri->uri_string(), 'shop/search')) {
            $list = 'searchpage';
        } elseif (strstr(CI::$APP->uri->uri_string(), 'shop/category')) {
            $list = 'categorypage';
        } elseif (strstr(CI::$APP->uri->uri_string(), 'shop/brand')) {
            $list = 'brandpage';
        }

        /* @var $product SProducts */
        foreach ($products as $key => $product) {
            $brand = $product->getBrand() ? $product->getBrand()->getName() : '';
            $str .= "{'id':'{$product->getId()}',"
                    . "'name':'{$product->getName()}',"
                    . "'price':'{$product->firstVariant->toCurrency()}',"
                    . "'brand':'$brand',"
                    . "'category':'{$product->getCategories()->getData()[0]->getName()}',"
                    . "'list':'$list',"
                    . "'position':'$key'},";
        }
        $str = 'var arr = [' . rtrim($str, ',') . '];';

        \CMSFactory\assetManager::create()
                ->registerJsScript($str);
    }

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

        \CMSFactory\assetManager::create()
                ->registerJsScript("var id = {$model->getId()};", true, 'before')
                ->registerJsScript("var name = {$model->getName()};", FALSE, 'before')
                ->registerJsScript("var price = {$model->firstVariant->toCurrency()};", FALSE, 'before')
                ->registerJsScript("var brand = {$model->getId()};", FALSE, 'before')
                ->registerJsScript("var category = {$model->getId()};", FALSE, 'before')
                ->registerScript('addToCart', TRUE, 'after');
    }

    public static function ProductPageLoad($data) {
        /* @var $model SProducts */
        $model = $data['model'];
        $brand = $model->getBrand() ? $model->getBrand()->getName() : '';
        $name = SCategoryI18nQuery::create()
                ->filterByLocale(MY_Controller::getCurrentLocale())
                ->findOneById($model->getCategoryId())
                ->getName();

        \CMSFactory\assetManager::create()
                ->registerJsScript("var id = '{$model->getId()}';", FALSE, 'before')
                ->registerJsScript("var name = '{$model->getName()}';", FALSE, 'before')
                ->registerJsScript("var price = '{$model->firstVariant->toCurrency()}';", FALSE, 'before')
                ->registerJsScript("var brand = '$brand';", FALSE, 'before')
                ->registerJsScript("var category = '$name';", FALSE, 'before')
                ->registerScript('product', FALSE, 'after');
    }

    public function _install() {
        /** We recomend to use http://ellislab.com/codeigniter/user-guide/database/forge.html */
        /**
          $this->load->dbforge();

          $fields = array(
          'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE,),
          'name' => array('type' => 'VARCHAR', 'constraint' => 50,),
          'value' => array('type' => 'VARCHAR', 'constraint' => 100,)
          );

          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->add_field($fields);
          $this->dbforge->create_table('mod_empty', TRUE);
         */
        $this->db
            ->where('name', 'ga_dashboard')
            ->update('components', ['autoload' => '1', 'enabled' => '1']);
    }

    public function _deinstall() {
        /**
          $this->load->dbforge();
          $this->dbforge->drop_table('mod_empty');
         *
         */
    }

}

/* End of file sample_module.php */