<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class discount_api for Mod_Discount module
 * @uses \MY_Controller
 * @author DevImageCms 
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model $discount_model
 * @property discount_model_front $discount_model_front
 */
class discount_api extends \MY_Controller {

    /**
     * __construct base object loaded
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('mod_discount');
    }

    /**
     * get gift certificate in json format
     * @access public
     * @author DevImageCms
     * @param key optional
     * @return jsoon
     * @copyright (c) 2013, ImageCMS
     */
    public function get_gift_certificate($key = null, $totalPrice = null) {

        $cart = \Cart\BaseCart::getInstance();
        $this->base_discount = \mod_discount\classes\BaseDiscount::create();
        if ($totalPrice === null)
            $totalPrice = $cart->getTotalPrice();

        if (null === $key)
            $key = strip_tags(trim($_GET['key']));
        foreach ($this->base_discount->discount_type['all_order'] as $disc)
            if ($disc['key'] == $key and $disc['is_gift']) {
                $value = $this->base_discount->get_discount_value($disc, $totalPrice);
                return json_encode(array('key' => $disc['key'], 'val_orig' => $value, 'value' => \ShopCore::app()->SCurrencyHelper->convert($value), 'gift_array' => $disc));
                break;
            }
        return json_encode(array('error' => true, 'mes' => lang('Invalid code try again', 'mod_discount')));
    }

    /**
     * get discount in json format
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_api($render = null) {

        $this->base_discount = \mod_discount\classes\BaseDiscount::create();
        if (count($this->base_discount->cart_data) > 0)
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
                $discount['result_sum_discount_convert'] = ShopCore::app()->SCurrencyHelper->convert($discount['result_sum_discount']);
            }

        if ($discount['result_sum_discount']) {
            if ($render === null)
                echo json_encode($discount);
            else
                return $discount;
        }
        else
            echo '';
    }

    /**
     * is in project gift certificate
     * @access public
     * @author DevImageCms
     * @param ---
     * @return boolean
     * @copyright (c) 2013, ImageCMS
     */
    public function is_gift_certificat() {
        $this->base_discount = \mod_discount\classes\BaseDiscount::create();
        foreach ($this->base_discount->discount_type['all_order'] as $disc)
            if ($disc['is_gift']) {
                return true;
                break;
            }
        return false;
    }

    /**
     * render gift input
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function render_gift_input($mes = null) {
        $this->base_discount = \mod_discount\classes\BaseDiscount::create();
        if ($this->base_discount->check_module_install())
            if ($this->is_gift_certificat())
                \CMSFactory\assetManager::create()->setData(array('mes' => $mes))->render('gift', true);
    }

    /**
     * get gift certificate in tpl
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function render_gift_succes() {
        $json = json_decode($_GET['json']);
        \CMSFactory\assetManager::create()->setData(array('gift' => $json))->render('gift_succes', true);
    }

    /**
     * get discount in tpl format from json
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_tpl_from_json_api() {
        $json = json_decode($_GET['json']);

        \CMSFactory\assetManager::create()->setData(array('discount' => $json))->render('discount_order', true);
    }

    /**
     * get discount product
     * @access public
     * @author DevImageCms
     * @param array [pid,vid], tpl optional 
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_product_api($product, $tpl = null, $price = null) {
        $this->base_discount = \mod_discount\classes\BaseDiscount::create();
        if ($this->base_discount->check_module_install()) {
            $DiscProdObj = \mod_discount\Discount_product::create();
            if ($DiscProdObj->get_product_discount($product, $price)) {
                $arr = \CMSFactory\assetManager::create()->discount;
                if (null === $tpl)
                    return $arr;
                elseif (1 === $tpl)
                    \CMSFactory\assetManager::create()->setData(array('discount_product' => $arr))->render('discount_product', true);
                elseif ('json' === $tpl)
                    echo json_encode($arr);
            }
            else
                return false;
        }
        return false;
    }


    /**
     * get all discount information without maximized
     * @access public
     * @author DevImageCms
     * @param tpl optional 
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_user_discount_api($tpl = null) {
        $this->base_discount = \mod_discount\classes\BaseDiscount::create();
        if ($this->base_discount->check_module_install()) {
            $this->base_discount->discount_type['comulativ'] = $this->get_comulativ_discount_api();
            if (null === $tpl)
                return $this->base_discount->discount_type;
            else
                \CMSFactory\assetManager::create()->setData(array('discount' => $this->base_discount->discount_type))->render('discount_info_user', true);
        }
    }

    /**
     * get comulativ discount sorting
     * @access public
     * @author DevImageCms
     * @param --
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_comulativ_discount_api() {

        function cmp($a, $b) {
            return strnatcmp($a["begin_value"], $b["begin_value"]);
        }
        $this->base_discount = \mod_discount\classes\BaseDiscount::create();
        if ($this->base_discount->check_module_install())
            usort($this->base_discount->discount_type['comulativ'], 'cmp');
        return $this->base_discount->discount_type['comulativ'];
    }

}