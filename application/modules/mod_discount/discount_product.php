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
class Discount_product extends classes\BaseDiscount {

    private $discount_for_product;

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
        $this->get_all_discount();
        $this->collect_type();
        $this->discount_for_product = array_merge($this->discount_type['product'], $this->discount_type['brand'], $this->discount_type['category']);
    }

    /**
     * get product discount for prouct_id and product_vid
     * @access public
     * @author DevImageCms
     * @param array product [id,vid]
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_product_discount_event($product, $price = null) {


        $discount_array = $this->get_discount_one_product($product);


        if (count($discount_array) > 0) {
            if (null === $price)
                $price = $this->discount_model_front->get_price($product['vid']);
            $discount_max = $this->get_max_discount($discount_array, $price);
            $discount_value = $this->get_discount_value($discount_max, $price);
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
        ob_start();
        \CMSFactory\assetManager::create()->setData(array('discount_product' => \CMSFactory\assetManager::create()->discount))->render('discount_product', true);
        $tpl = ob_get_clean();

        \CMSFactory\assetManager::create()->discount_tpl = $tpl;

        return true;
    }

    /**
     * get product discount for one prouct
     * @access public
     * @author DevImageCms
     * @param array product [product_id,brand_id,category_id]
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_one_product($product) {

        $arr_discount = array();

        foreach ($this->discount_for_product as $disc)
            foreach ($product as $key => $value) {
                if ($disc[$key])
                    if ($disc[$key] == $value)
                        $arr_discount[] = $disc;
            }

        return $arr_discount;
    }

}
