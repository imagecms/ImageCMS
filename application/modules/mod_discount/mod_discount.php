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
class Mod_discount extends \MY_Controller {

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
        
        if (count($this->db->where('name', 'mod_discount')->get('components')->result_array()) != 0) {
            
            \CMSFactory\Events::create()->on('Cart:Operation')->setListener('changeCart');
            /** apply Gift */
            if ($_POST['gift']) {

                $gift = $this->input->post('gift');
                require_once __DIR__ . '/gift.php';
                $obkGift = new \mod_discount\Gift();
                if ($_POST['gift_ord'])
                    $obkGift->get_gift_certificate($gift, null, true);
                else
                    $obkGift->get_gift_certificate($gift);
            }
        }
    }

    /**
     * change price cart
     * @access public
     * @author DevImageCms
     * @param cart
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public static function changeCart($cart) {
        $obj = new \mod_discount\discount_order($cart['object']);
        $obj->update_cart_discount($cart['object']);
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
