<?php

namespace mod_discount;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Discount_product extends classes\BaseDiscount {

    private $discount_for_product;

    public function __construct() {

        parent::__construct();
        $this->get_all_discount();
        $this->collect_type();
        $this->discount_for_product = array_merge($this->discount_type['product'], $this->discount_type['brand'], $this->discount_type['category']);
    }

    public function get_product_discount_event($product, $render = null) {


        $discount_array = $this->get_discount_one_product($this->discount_model_front->get_product($product['id']));

        if (count($discount_array) > 0) {
            $price = $this->discount_model_front->get_price($product['vid']);
            $discount_max = $this->get_max_discount($discount_array, $price);
            $discount_value = $this->get_discount_value($discount_max, $this->discount_model_front->get_price($product['vid']));
        } else {
            \CMSFactory\assetManager::create()->discount = false;
            return false;
        }

        \CMSFactory\assetManager::create()->discount = array(
            'discoun_all_product' => $discount_array,
            'discount_max' => $discount_max,
            'discount_value' => $discount_value,
            'price' => $price
        );

        return true;
    }

    public function get_discount_one_product($product) {

        $arr_discount = array();

        foreach ($this->discount_for_product as $disc)
            foreach ($product as $key => $value) {
                if ($disc[$key] == $value)
                    $arr_discount[] = $disc;
            }

        return $arr_discount;
    }

}
