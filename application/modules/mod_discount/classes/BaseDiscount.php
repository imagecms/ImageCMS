<?php

namespace mod_discount\classes;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class BaseDiscount for Mod_Discount module
 * @uses \MY_Controller
 * @author DevImageCms
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model $discount_model
 * @property discount_model_front $discount_model_front
 */
class BaseDiscount extends \MY_Controller {

    protected static $discount;
    protected $cart_data;
    protected $total_price;
    protected $discount_type;
    protected $user_id;
    protected $user_group_id;
    protected $amout_user;
    public $ci;

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
        if ($this->check_module_install()) {
            $this->load->module('core');
            $this->load->model('discount_model_front');
            $lang = new \MY_Lang();
            $lang->load('mod_discount');
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
        if (count($this->db->where('name', 'mod_discount')->get('components')->result_array()) == 0)
            return false;
        else
            return true;
    }

     /**
     * get user by id
     * @access public
     * @author DevImageCms
     * @param ---
     * @return int
     * @copyright (c) 2013, ImageCMS
     */
    public function get_user_id() {

        $this->user_id = $this->session->userdata('DX_user_id');
        return $this->user_id;
    }

     /**
     * get user group for current user
     * @access public
     * @author DevImageCms
     * @param ---
     * @return int
     * @copyright (c) 2013, ImageCMS
     */
    public function get_user_group_id() {

        $this->user_group_id = $this->session->userdata('DX_role_id');
        return $this->user_group_id;
    }

     /**
     * get Cart items for current session
     * @access public
     * @author DevImageCms
     * @param ---
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_cart_data() {

        $this->cart_data = \ShopCore::app()->SCart->getData();
        return $this->cart_data;
    }

     /**
     * get current user amout
     * @access public
     * @author DevImageCms
     * @param user_id optional
     * @return float
     * @copyright (c) 2013, ImageCMS
     */
    public function get_amout_user($id = null) {

        if (null === $id)
            $id = $this->user_id;
        $this->load->model('discount_model_front');
        $this->amout_user = $this->discount_model_front->get_amout_user($id);
        return $this->amout_user;
    }

     /**
     * get totall origin price for current session
     * @access public
     * @author DevImageCms
     * @param cart_data optional
     * @return float
     * @copyright (c) 2013, ImageCMS
     */
    public function get_total_price($data = null) {

        if (null === $data)
            $data = $this->cart_data;
        $this->total_price = $this->discount_model_front->get_total_price($data);
        return $this->total_price;
    }

     /**
     * get all active discount joined whith his type
     * @access public
     * @author DevImageCms
     * @param --
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_all_discount() {
        
        if (!self::$discount)
            self::$discount = $this->join_discount_settings($this->discount_model_front->get_discount());
        return self::$discount;
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
            $discount[$key] = array_merge($discount[$key], $this->discount_model_front->join_discount($disc['id'], $disc['type_discount']));

        return $discount;
    }


     /**
     * partitioning discounts on their types
     * @access public
     * @author DevImageCms
     * @param optional discount
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function collect_type($discount = null) {

        if (null === $discount)
            $discount = self::$discount;
        $arr = array();
        foreach ($discount as $disc)
            $arr[$disc['type_discount']][] = $disc;
        $this->discount_type = $arr;
        $this->empty_to_array();
        return $this->discount_type;
    }

     /**
     * set empty array for null ellement discount
     * @access private
     * @author DevImageCms
     * @param ---
     * @return ----
     * @copyright (c) 2013, ImageCMS
     */
    private function empty_to_array(){
        if (!$this->discount_type['product'])
            $this->discount_type['product'] = array();

        if (!$this->discount_type['brand'])
            $this->discount_type['brand'] = array();

        if (!$this->discount_type['category'])
            $this->discount_type['category'] = array();

        if (!$this->discount_type['all_order'])
            $this->discount_type['all_order'] = array();

        if (!$this->discount_type['comulativ'])
            $this->discount_type['comulativ'] = array();

        if (!$this->discount_type['group_user'])
            $this->discount_type['group_user'] = array();

        if (!$this->discount_type['user'])
            $this->discount_type['user'] = array();

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
//        var_dumps($discount);
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

        if ($discount['type_value'] == 1)
            $discount_value = $price * $discount['value'] / 100;
        if ($discount['type_value'] == 2)
            $discount_value = $discount['value'];

        return $discount_value;
    }

     /**
     * update discount apply
     * @access public
     * @author DevImageCms
     * @param $key, $gift optional
     * @return -----
     * @copyright (c) 2013, ImageCMS
     */
    public function updatediskapply($key, $gift = null){

        return $this->discount_model_front->updateapply($key, $gift);
    }


}
