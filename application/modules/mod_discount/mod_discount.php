<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class for Mod_Discount module
 * @uses \MY_Controller
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

            $this->base_discount = \mod_discount\classes\BaseDiscount::create();

            if ($this->base_discount->check_module_install()) {
                $discount['max_discount'] = $this->base_discount->discount_max;
                $discount['sum_discount_product'] = $this->base_discount->discount_product_val;
                $discount['sum_discount_no_product'] = $this->base_discount->discount_no_product_val;
                if ($this->base_discount->discount_product_val > $this->base_discount->discount_no_product_val) {
                    $discount['result_sum_discount'] = $this->base_discount->discount_product_val;
                    $discount['type'] = 'product';
                } else {
                    $discount['result_sum_discount'] = $this->base_discount->discount_no_product_val;
                    $discount['type'] = 'user';
                }


                if ($discount['result_sum_discount']) {
                    $this->base_discount->cart->setTotalPrice($this->base_discount->cart->getOriginTotalPrice() - $discount['result_sum_discount']);
                    $this->base_discount->cart->discount_info = $discount;
                    $this->base_discount->updatediskapply($discount['max_discount']['key']);
                }
            }
            /** apply Gift */
            if ($_POST['gift']) {

                $key = $this->input->post('gift');
                $aplyGift = false;
                foreach ($this->base_discount->discount_type['all_order'] as $disc)
                    if ($disc['key'] == $key and $disc['is_gift']) {
                        $value = $this->base_discount->get_discount_value($disc, $this->base_discount->cart->getTotalPrice());
                        $this->base_discount->cart->gift_info = $disc['key'];
                        $this->base_discount->cart->gift_value = $value;
                        $this->base_discount->cart->setTotalPrice($this->base_discount->cart->getTotalPrice() - $value);
                        $aplyGift = true;
                        if ($_POST['gift_ord'])
                            $this->base_discount->updatediskapply($disc['key'], 'gift');

                        break;
                    }

                if (!$aplyGift)
                    $this->base_discount->cart->gift_error = TRUE;
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
