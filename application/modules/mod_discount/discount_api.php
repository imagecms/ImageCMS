<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class discount_api for Mod_Discount module
 * @uses \mod_discount\classes\BaseDiscount
 * @author DevImageCms 
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model $discount_model
 * @property discount_model_front $discount_model_front
 */
class discount_api extends \mod_discount\discount {

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
    }

    /**
     * get discount in json format
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_api() {
        if (count(ShopCore::app()->SCart->getData()) > 0)
            if ($this->check_module_install())
                $discount = $this->init()->get_result_discount(1);
        if ($discount['result_sum_discount'])
            echo json_encode($discount);
        else
            echo '';
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
        $json = json_decode($_POST['json']);

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
    public function get_discount_product_api($product, $tpl = null) {
        if ($this->check_module_install()) {
            $DiscProdObj = new \mod_discount\Discount_product;
            if ($DiscProdObj->get_product_discount_event($product)) {
                $arr = \CMSFactory\assetManager::create()->discount;
                if (null === $tpl)
                    return $arr;
                else
                    \CMSFactory\assetManager::create()->setData(array('discount_product' => $arr))->render('discount_product', true);
            }
            else
                return false;
        }
        return false;
    }

    /**
     * get all discount information
     * @access public
     * @author DevImageCms
     * @param tpl, price optional 
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_all_discount_information($tpl = null, $price = null) {
        if ($this->check_module_install()) {
            $discount = $this->init()->get_result_discount(1, $price);
            if (null === $tpl)
                return $discount;
            else
                \CMSFactory\assetManager::create()->setData(array('discount' => $discount))->render('discount_info_all', true);
        }
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
        if ($this->check_module_install()) {
            $this->init();
            if (null === $tpl)
                return $this->result_discount;
            else
                \CMSFactory\assetManager::create()->setData(array('discount' => $this->result_discount))->render('discount_info_user', true);
        }
    }

}