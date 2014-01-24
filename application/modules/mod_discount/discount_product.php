<?php

namespace mod_discount;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Discount_product for Mod_Discount module
 * @author DevImageCms
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model $discount_model
 * @property discount_model_front $discount_model_front
 */
class Discount_product {

    private $discount_for_product;
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
        $lang = new \MY_Lang();
        $lang->load('mod_discount');
        require_once __DIR__ . '/models/discount_model_front.php';
        $this->ci->discount_model_front = new \Discount_model_front;
        $this->base_discount = \mod_discount\classes\BaseDiscount::create();
        $this->discount_for_product = array_merge($this->base_discount->discount_type['product'], $this->base_discount->discount_type['brand'], $this->create_child_discount($this->base_discount->discount_type['category']));
    }
    
    /**
     * create child discount
     * @access private
     * @author DevImageCms
     * @param array
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function create_child_discount($discount) {

        if (count($discount) > 0) {
            $result_discount = array();
            foreach ($discount as $disc) {
                $result_discount[] = $disc;
                if ($disc['child']) {
                    $childs = $this->ci->db->like('full_path_ids', ':' . $disc['category_id'] . ';')->get('shop_category')->result_array();
                    if (count($childs) > 0)
                        foreach ($childs as $child) {
                            $disc_aux = $disc;
                            $disc_aux['category_id'] = $child['id'];
                            $result_discount[] = $disc_aux;
                        }
                }
            }

            return $result_discount;
        } else
            return $discount;
    }

    /**
     * get product discount for prouct_id and product_vid
     * @access public
     * @author DevImageCms
     * @param array product [id,vid]
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_product_discount($product, $price = null) {

        $discount_array = $this->get_discount_one_product($product);
        if (count($discount_array) > 0) {
            if (null === $price)
                $price = $this->ci->discount_model_front->get_price($product['vid']);
            $discount_max = $this->base_discount->get_max_discount($discount_array, $price);
            $discount_value = $this->base_discount->get_discount_value($discount_max, $price);
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
     * @access private
     * @author DevImageCms
     * @param array product [product_id,brand_id,category_id]
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function get_discount_one_product($product) {

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
