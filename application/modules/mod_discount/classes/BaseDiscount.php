<?php

namespace mod_discount\classes;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class BaseDiscount for Mod_Discount module
 * @author DevImageCms
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model $discount_model
 * @property discount_model_front $discount_model_front
 */
class BaseDiscount {

    private static $object;

    public static function create() {
        if (!self::$object)
            self::$object = new self;
        return self::$object;
    }

    /**
     * __construct base object loaded
     * @access private
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    private function __construct() {
        $this->ci = & get_instance();
        if ($this->check_module_install()) {
            require_once __DIR__ . '/../models/discount_model_front.php';
            $this->ci->discount_model_front = new \Discount_model_front;
            $lang = new \MY_Lang();
            $lang->load('mod_discount');
            $this->cart = \Cart\BaseCart::getInstance();
            $this->user_group_id = $this->ci->dx_auth->get_role_id();
            $this->user_id = $this->ci->dx_auth->get_user_id();
            $this->cart_data = $this->get_cart_data();
            $this->amout_user = $this->ci->discount_model_front->get_amout_user($id);
            $this->total_price = $this->cart->getOriginTotalPrice();
            $this->discount_type = $this->collect_type($this->get_all_discount());
            $this->discount_all_order = $this->get_all_order_discount_not_register();
            if ($this->user_id) {
                $this->discount_user = $this->get_user_discount();
                $this->discount_group_user = $this->get_user_group_discount();
                $this->discount_comul = $this->get_comulativ_discount();
                $this->discount_all_order = $this->get_all_order_discount_register();
            }
            $this->discount_product_val = $this->get_discount_products();
            $this->discount_max = $this->get_max_discount(array($this->discount_user, $this->discount_group_user, $this->discount_comul, $this->discount_all_order), $this->total_price);
            $this->discount_no_product_val = $this->get_discount_value($this->discount_max, $this->total_price);
        }
    }

    /**
     * check_module_install
     * @access public
     * @author DevImageCms
     * @return boolean
     * @copyright (c) 2013, ImageCMS
     */
    public function check_module_install() {

        return (count($this->ci->db->where('name', 'mod_discount')->get('components')->result_array()) == 0) ? false : true;
    }

    /**
     * get Cart items for current session
     * @access private
     * @author DevImageCms
     * @param ---
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function get_cart_data() {

        $cart = $this->cart->getItems();
        return $cart['data'];
    }


    /**
     * get all active discount joined whith his type
     * @access private
     * @author DevImageCms
     * @param --
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function get_all_discount() {

        return $this->join_discount_settings($this->ci->discount_model_front->get_discount());
    }

    /**
     * joined discount whith his type
     * @access private
     * @author DevImageCms
     * @param discount
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function join_discount_settings($discount) {

        foreach ($discount as $key => $disc)
            $discount[$key] = array_merge($discount[$key], $this->ci->discount_model_front->join_discount($disc['id'], $disc['type_discount']));

        return $discount;
    }

    /**
     * partitioning discounts on their types
     * @access private
     * @author DevImageCms
     * @param optional discount
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function collect_type($discount) {

        $arr = array();
        foreach ($discount as $disc)
            $arr[$disc['type_discount']][] = $disc;

        return $this->empty_to_array($arr);
    }

    /**
     * set empty array for null ellement discount
     * @access private
     * @author DevImageCms
     * @param ---
     * @return ----
     * @copyright (c) 2013, ImageCMS
     */
    private function empty_to_array($discount) {
        if (!isset($discount['product']))
            $discount['product'] = array();

        if (!isset($discount['brand']))
            $discount['brand'] = array();

        if (!isset($discount['category']))
            $discount['category'] = array();

        if (!isset($discount['all_order']))
            $discount['all_order'] = array();

        if (!isset($discount['comulativ']))
            $discount['comulativ'] = array();

        if (!isset($discount['group_user']))
            $discount['group_user'] = array();

        if (!isset($discount['user']))
            $discount['user'] = array();

        return $discount;
    }

    /**
     * get max discount considering type value and price
     * @access public
     * @author DevImageCms
     * @param discount, price
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_max_discount($discount, $price) {

        $discount = array_filter(
                $discount, function($el) {
                    return !empty($el);
                });
        $max_discount = 0;
        foreach ($discount as $key => $disc) {
            $discount_value = $this->get_discount_value($disc, $price);
            if ($max_discount <= $discount_value) {
                $max_discount = $discount_value;
                $key_max = $key;
            }
        }
        return $discount[$key_max];
    }

    /**
     * get value discount considering type value and price
     * @access public
     * @author DevImageCms
     * @param discount, price
     * @return float
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_value($discount, $price) {

        return ($discount['type_value'] == 1) ? $price * $discount['value'] / 100 : $discount['value'];
    }

    /**
     * update discount apply
     * @access public
     * @author DevImageCms
     * @param $key, $gift optional
     * @return -----
     * @copyright (c) 2013, ImageCMS
     */
    public function updatediskapply($key, $gift = null) {

        return $this->ci->discount_model_front->updateapply($key, $gift);
    }

    /**
     * get max discount for current user
     * @access private
     * @author DevImageCms
     * @param ----
     * @return array 
     * @copyright (c) 2013, ImageCMS
     */
    private function get_user_discount() {

        $discount_user = array();
        foreach ($this->discount_type['user'] as $key => $user_disc)
            if ($user_disc['user_id'] == $this->user_id)
                $discount_user[] = $user_disc;

        return (count($discount_user) > 0) ? $this->get_max_discount($discount_user, $this->total_price) : false;
    }

    /**
     * get max discount for current user_group
     * @access private
     * @author DevImageCms
     * @param ----
     * @return array 
     * @copyright (c) 2013, ImageCMS
     */
    private function get_user_group_discount() {

        $discount_user_gr = array();
        foreach ($this->discount_type['group_user'] as $user_gr_disc)
            if ($user_gr_disc['group_id'] == $this->user_group_id)
                $discount_user_gr[] = $user_gr_disc;

        return (count($discount_user_gr) > 0) ? $this->get_max_discount($discount_user_gr, $this->total_price) : false;
    }

    /**
     * get max comulativ discount for current user with current amout
     * @access private
     * @author DevImageCms
     * @param ----
     * @return array 
     * @copyright (c) 2013, ImageCMS
     */
    private function get_comulativ_discount() {

        $discount_comulativ = array();
        foreach ($this->discount_type['comulativ'] as $disc)
            if (($disc['begin_value'] <= (float) $this->amout_user and $disc['end_value'] > (float) $this->amout_user ) or ($disc['begin_value'] <= (float) $this->amout_user and !$disc['end_value']))
                $discount_comulativ[] = $disc;

        return (count($discount_comulativ) > 0) ? $this->get_max_discount($discount_comulativ, $this->total_price) : false;
    }

    /**
     * get discount for product in cart with his discount
     * @access private
     * @author DevImageCms
     * @param ----
     * @return float 
     * @copyright (c) 2013, ImageCMS
     */
    private function get_discount_products() {

        foreach ($this->cart_data as $item) {
            $price_origin = number_format($item->originPrice, \ShopCore::app()->SSettings->pricePrecision, '.', ''); // new Cart
            if (abs($price_origin - $item->price) > 1)
                $discount_value += ($price_origin - $item->price) * $item->quantity;
        }



        return $discount_value;
    }

    /**
     * get max discount for all order for register and not register user
     * @access private
     * @author DevImageCms
     * @param ----
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function get_all_order_discount_register() {

        $all_order_arr_reg = array();
        foreach ($this->discount_type['all_order'] as $disc)
            if (!$disc['is_gift'])
                if ($disc['begin_value'] <= (int) $this->total_price)
                    $all_order_arr_reg[] = $disc;

        return (count($all_order_arr_reg) > 0) ? $this->get_max_discount($all_order_arr_reg, $this->total_price) : false;
    }

    /**
     * get max discount for all order for not register user
     * @access private
     * @author DevImageCms
     * @param ----
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function get_all_order_discount_not_register() {

        $all_order_arr_not_reg = array();
        foreach ($this->discount_type['all_order'] as $disc)
            if (!$disc['is_gift'])
                if ($disc['begin_value'] <= $this->total_price and !$disc['for_autorized'])
                    $all_order_arr_not_reg[] = $disc;

        return (count($all_order_arr_not_reg) > 0) ? $this->get_max_discount($all_order_arr_not_reg, $this->total_price) : false;
    }

}
