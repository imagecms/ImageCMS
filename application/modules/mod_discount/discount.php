<?php

namespace mod_discount;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class discount for Mod_Discount module
 * @uses \mod_discount\classes\BaseDiscount
 * @author DevImageCms 
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model $discount_model
 * @property discount_model_front $discount_model_front
 */
class discount extends classes\BaseDiscount {
    
    public $result_discount;
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
    }
    
   /**
     * initializing all method for getting discount
     * @access public
     * @author DevImageCms
     * @param ---
     * @return Mod_discount
     * @copyright (c) 2013, ImageCMS
     */
    public function init() {

        $this->get_user_id();
        
        $this->get_user_group_id();
        
        $this->get_cart_data();
        
        if ($this->cart_data)
            $this->get_total_price();
        
        $this->get_all_discount();
        
        $this->collect_type();
        
        $discount_all_order = $this->get_all_order_discount_not_register();
        
        if ($this->user_id) {
            
            $this->get_amout_user();
            
            $discount_user = $this->get_user_discount();            

            $discount_group_user = $this->get_user_group_discount();

            $discount_comulativ = $this->get_comulativ_discount();

            $discount_all_order = $this->get_all_order_discount_register();
            
        }
   
        $this->result_discount = array(
                                'all_order'=>$discount_all_order, 
                                'comulative' => $discount_comulativ, 
                                'user' => $discount_user, 
                                'user_group' => $discount_group_user);
        
        return $this;
    }

    /**
     * get final discount for order
     * @access public
     * @author DevImageCms
     * @param $render for getting result as array or discount value only, totalPrice
     * @return discount array discount with key: all_active_discount, all_max_type_discount, max_discount, sum_discount_product, sum_discount_no_product, result_sum_discount or only value discount
     * @copyright (c) 2013, ImageCMS
     */
    public function get_result_discount($render = null, $totalPrice = null) {
        if (null === $totalPrice)
            $totalPrice = $this->total_price;
        
        $discount_max = $this->get_max_discount($this->result_discount, $totalPrice);        
        
        $discount_value_no_product = $this->get_discount_value($discount_max, $totalPrice);

        $discount_product_value = $this->get_discount_products();

        if ($discount_value_no_product > $discount_product_value)
            $result = $discount_value_no_product;
        else
            $result = $discount_product_value;
        
        if (null === $render)
            return $result;
        else
            return array(
                'all_active_discount' => $this->discount_type,
                'all_max_type_discount' => $this->result_discount,
                'max_discount' => $discount_max,
                'sum_discount_product' => $discount_product_value,
                'sum_discount_no_product' => $discount_value_no_product,
                'result_sum_discount' => $result,
                'result_sum_discount_convert' => \ShopCore::app()->SCurrencyHelper->convert($result)
            );
    }

    /**
     * get max discount for current user
     * @access public
     * @author DevImageCms
     * @param ----
     * @return array 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_user_discount() {       

        $discount_user = array();
        foreach ($this->discount_type['user'] as $user_disc)
            if ($user_disc['user_id'] == $this->user_id)
                $discount_user[] = $user_disc;

        if (count($discount_user) > 0)
            return $this->get_max_discount($discount_user, $this->total_price);
        else
            return false;
    }

     /**
     * get max discount for current user_group
     * @access public
     * @author DevImageCms
     * @param ----
     * @return array 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_user_group_discount() {

        $discount_user_gr = array();
        foreach ($this->discount_type['group_user'] as $user_gr_disc)
            if ($user_gr_disc['group_id'] == $this->user_group_id)
                $discount_user_gr[] = $user_gr_disc;

        if (count($discount_user_gr) > 0)
            return $this->get_max_discount($discount_user_gr, $this->total_price);
        else
            return false;
    }

     /**
     * get max comulativ discount for current user with current amout
     * @access public
     * @author DevImageCms
     * @param ----
     * @return array 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_comulativ_discount() {

        $discount_comulativ = array();
        foreach ($this->discount_type['comulativ'] as $disc)
            if (($disc['begin_value'] <= (float)$this->amout_user and $disc['end_value'] > (float)$this->amout_user ) or ($disc['begin_value'] <= (float)$this->amout_user and !$disc['end_value']))
                $discount_comulativ[] = $disc;
        if (count($discount_comulativ) > 0)
            return $this->get_max_discount($discount_comulativ, $this->total_price);
        else
            return false;
    }


     /**
     * get discount for product in cart with his discount
     * @access public
     * @author DevImageCms
     * @param ----
     * @return float 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_products() {
        foreach ($this->cart_data as $item) {
            if ($item['instance'] == 'SProducts') {
                $price_origin = $this->discount_model_front->get_price($item['variantId']);
                if (abs($price_origin - $item['price']) > 1)
                    $discount_value += ($price_origin - $item['price']) * $item['quantity'];
            }
        }

        return $discount_value;
    }
    
     /**
     * get max discount for all order for register and not register user
     * @access public
     * @author DevImageCms
     * @param ----
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_all_order_discount_register() {

        $all_order_arr_reg = array();
        foreach ($this->discount_type['all_order'] as $disc)
            if (!$disc['is_gift'])
                if ($disc['begin_value'] <= (int)$this->total_price)
                    $all_order_arr_reg[] = $disc;
                
        if (count($all_order_arr_reg) > 0)
            return $this->get_max_discount($all_order_arr_reg, $this->total_price);
        else
            return false;
    }

     /**
     * get max discount for all order for not register user
     * @access public
     * @author DevImageCms
     * @param ----
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_all_order_discount_not_register() {

        $all_order_arr_not_reg = array();
        foreach ($this->discount_type['all_order'] as $disc)
            if (!$disc['is_gift'])
                if ($disc['begin_value'] <= $this->total_price and !$disc['for_autorized'])
                    $all_order_arr_not_reg[] = $disc;

        if (count($all_order_arr_not_reg) > 0)
            return $this->get_max_discount($all_order_arr_not_reg, $this->total_price);
        else
            return false;
    }
}