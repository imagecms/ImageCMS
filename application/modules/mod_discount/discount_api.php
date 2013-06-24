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

        \CMSFactory\assetManager::create()->setData(array('discount' => $json))->render('discount', true);
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
            $this->get_all_discount();
            $this->collect_type();
            $this->discount_for_product = array_merge($this->discount_type['product'], $this->discount_type['brand'], $this->discount_type['category']);


            $arr_discount = array();

            foreach ($this->discount_for_product as $disc)
                foreach ($this->discount_model_front->get_product($product['id']) as $key => $value) {
                    if ($disc[$key] == $value)
                        $arr_discount[] = $disc;
                }


            if (count($arr_discount) > 0) {
                $price = $this->discount_model_front->get_price($product['vid']);
                $discount_max = $this->get_max_discount($arr_discount, $price);
                $discount_value = $this->get_discount_value($discount_max, $this->discount_model_front->get_price($product['vid']));
            }
            else
                return false;


            $arr = array(
                'discoun_all_product' => $arr_discount,
                'discount_max' => $discount_max,
                'discount_value' => $discount_value,
                'price' => $price
            );
            if (null === $tpl)
                return $arr;
            else
                \CMSFactory\assetManager::create()->setData(array('discount_product' => $arr))->render('discount_product', true);
        }
    }
    /**
     * get all discount information
     * @access public
     * @author DevImageCms
     * @param tpl optional 
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_all_discount_information( $tpl = null) {
        if ($this->check_module_install()) {
            $discount = $this->init()->get_result_discount(1);
            if (null === $tpl)
                return $discount;
            else
                \CMSFactory\assetManager::create()->setData(array('discount' => $discount))->render('discount_info', true);
            
        }
    }

}