<?php

namespace mod_discount\classes;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BaseWishlist extends \MY_Controller {



    public function __construct() {
        parent::__construct();

        $this->load->module('core');
        $this->load->model('discount_model_front');
    }

    public function get_user_id() {

        $this->user_id = $this->session->userdata('DX_user_id');
        return $this->user_id;
    }

    public function get_user_group_id() {

        $this->user_group_id = $this->session->userdata('DX_role_id');
        return $this->user_group_id;
    }

    public function get_cart_data() {

        $this->cart_data = \ShopCore::app()->SCart->getData();
        return $this->cart_data;
    }

    public function get_amout_user($id = null) {

        if (null === $id)
            $id = $this->user_id;
        $this->load->model('discount_model_front');
        $this->amout_user = $this->discount_model_front->get_amout_user($id);
        return $this->amout_user;
    }

    public function get_total_price($data = null) {

        if (null === $data)
            $data = $this->cart_data;
        $this->total_price = $this->discount_model_front->get_total_price($data);
        return $this->total_price;
    }

    public function get_all_discount() {

        $this->discount = $this->join_discount_settings($this->discount_model_front->get_discount());
        return $this->discount;
    }

    private function join_discount_settings($discount) {

        foreach ($discount as $key => $disc)
            $discount[$key] = array_merge($discount[$key], $this->discount_model_front->join_discount($disc['id'], $disc['type_discount']));

        return $discount;
    }

    public function collect_type($discount = null) {

        if (null === $discount)
            $discount = $this->discount;
        $arr = array();
        foreach ($discount as $disc)
            $arr[$disc['type_discount']][] = $disc;
        $this->discount_type = $arr;
        return $this->discount_type;
    }

    public function get_max_discount($discount, $price) {

        $discount = array_filter(
                        $discount, function($el) {
                            return !empty($el);
                        });

        $max_discount = 0;
        foreach ($discount as $key => $disc) {
            if ($disc['type_value'] == 1)
                $discount_value = $price * $disc['value'] / 100;
            if ($disc['type_value'] == 2)
                $discount_value = $disc['value'];
            if ($max_discount <= $discount_value) {
                $max_discount = $discount_value;
                $key_max = $key;
            }
        }
        return $discount[$key_max];
    }

    public function get_discount_value($discount, $price) {

        if ($discount['type_value'] == 1)
            $discount_value = $price * $discount['value'] / 100;
        if ($discount['type_value'] == 2)
            $discount_value = $discount['value'];

        return $discount_value;
    }

}
