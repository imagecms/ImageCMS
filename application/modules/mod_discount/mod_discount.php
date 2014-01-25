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

            $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();

            if ($this->baseDiscount->checkModuleInstall()) {
                $discount['max_discount'] = $this->baseDiscount->discountMax;
                $discount['sum_discount_product'] = $this->baseDiscount->discountProductVal;
                $discount['sum_discount_no_product'] = $this->baseDiscount->discountNoProductVal;
                if ($this->baseDiscount->discount_product_val > $this->baseDiscount->discountNoProductVal) {
                    $discount['result_sum_discount'] = $this->baseDiscount->discountProductVal;
                    $discount['type'] = 'product';
                } else {
                    $discount['result_sum_discount'] = $this->baseDiscount->discountNoProductVal;
                    $discount['type'] = 'user';
                }


                if ($discount['result_sum_discount']) {
                    $this->baseDiscount->cart->setTotalPrice($this->baseDiscount->cart->getOriginTotalPrice() - $discount['result_sum_discount']);
                    $this->baseDiscount->cart->discount_info = $discount;
                    $this->baseDiscount->cart->discount_type = $discount['type'];
                    $this->baseDiscount->updateDiskApply($discount['max_discount']['key']);
                }
            }
            /** apply Gift */
            if ($_POST['gift']) {

                $key = $this->input->post('gift');
                $aplyGift = false;
                foreach ($this->baseDiscount->discountType['all_order'] as $disc)
                    if ($disc['key'] == $key and $disc['is_gift']) {
                        $value = $this->baseDiscount->getDiscountValue($disc, $this->baseDiscount->cart->getTotalPrice());
                        $this->baseDiscount->cart->gift_info = $disc['key'];
                        $this->baseDiscount->cart->gift_value = $value;
                        $this->baseDiscount->cart->setTotalPrice($this->baseDiscount->cart->getTotalPrice() - $value);
                        $aplyGift = true;
                        if ($_POST['gift_ord'])
                            $this->baseDiscount->updateDiskApply($disc['key'], 'gift');

                        break;
                    }

                if (!$aplyGift)
                    $this->baseDiscount->cart->gift_error = TRUE;
            }
        }
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
    
    /**
     * register javascript
     * @deprecated since version 4.5.2
     * @copyright (c) 2013, ImageCMS
     */
    public function register_script() {
        \CMSFactory\assetManager::create()->registerScript('main', TRUE);
    }

}

/* End of file mod_discount.php */
