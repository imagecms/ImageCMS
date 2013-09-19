<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class for Mod_Discount module
 * @uses \mod_discount\classes\BaseDiscount
 * @author DevImageCms 
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model $discount_model
 * @property discount_model_front $discount_model_front
 */
class Mod_discount extends \mod_discount\classes\BaseDiscount {

    public static $cnt = 0;
    public $no_install = true;
    protected $result_discount = array();

    /**
     * __construct base object loaded
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     */
    public function __construct() {

        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('mod_discount');
        $this->load->model('discount_model_admin');
    }

    /**
     * autoload execute when get product variant
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function autoload() {
        if ($this->check_module_install()) {
            \CMSFactory\Events::create()->on('getVariantProduct')->setListener('get_discount_for_product');
            \CMSFactory\Events::create()->on('MakeOrder')->setListener('make_order_with_discount');
        }
    }

    /**
     * get discount for product when get product variant
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_for_product($product) {

        $obj = new \mod_discount\discount_product;
        $obj->get_product_discount_event($product);
    }

    /**
     * update order with discount and gift
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function make_order_with_discount($data) {
        if (self::$cnt == 0) {
            $obj = new \mod_discount\discount_order;
            $obj->update_order_discount($data);
            self::$cnt++;
        }
    }

    public function register_script() {
        \CMSFactory\assetManager::create()->registerScript('main', TRUE);
    }

    /**
     * install module and create table
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     */
    public function _install() {

        if (SHOP_INSTALLED) {
            $this->discount_model_admin->moduleInstall();
        }
    }

    /**
     * deinstall module and drop tables
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     */
    public function _deinstall() {

        if ($this->dx_auth->is_admin() == FALSE)
            exit;

        $this->discount_model_admin->moduleDelete();
    }

}

/* End of file mod_discount.php */
