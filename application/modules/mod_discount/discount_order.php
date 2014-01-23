<?php

namespace mod_discount;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Class Discount_product for Mod_Discount module
 * @uses \mod_discount\classes\BaseDiscount
 * @author DevImageCms 
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model $discount_model
 * @property discount_model_front $discount_model_front
 */
class Discount_order extends \MY_Controller {
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
        $lang = new \MY_Lang();
        $lang->load('mod_discount');
        $this->base_discount = \mod_discount\classes\BaseDiscount::create();
        
    }

    
     /**
     * update order table
     * @access public
     * @author DevImageCms
     * @param array
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */        
    public function update_cart_discount(){
        
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


            if ($discount['result_sum_discount']){                
                $this->base_discount->cart->setTotalPrice($this->base_discount->total_price - $discount['result_sum_discount']);
                $this->base_discount->cart->discount_info = $discount;
                $this->base_discount->updatediskapply($discount['max_discount']['key']);
                
            } 
        } 
    }
}