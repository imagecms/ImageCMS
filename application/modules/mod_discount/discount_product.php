<?php

namespace mod_discount;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Discount_product for Mod_Discount module
 * @author DevImageCms
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model_front $discount_model_front
 */
class Discount_product {

    private $discountForProduct;
    private static $object;

    /**
     * singelton method
     * @return object BaseDiscount
     */
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
        $this->ci->discount_model_front = new \discount_model_front;
        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        $this->discountForProduct = array_merge($this->baseDiscount->discountType['product'], $this->baseDiscount->discountType['brand'], $this->createChildDiscount($this->baseDiscount->discountType['category']));
    }

    /**
     * create child discount
     * @access private
     * @author DevImageCms
     * @param array
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function createChildDiscount($discount) {

        if (count($discount) > 0) {
            $resultDiscount = array();
            foreach ($discount as $disc) {
                $resultDiscount[] = $disc;
                if ($disc['child']) {
                    $childs = $this->ci->db->like('full_path_ids', ':' . $disc['category_id'] . ';')->get('shop_category')->result_array();
                    if (count($childs) > 0)
                        foreach ($childs as $child) {
                            $discAux = $disc;
                            $discAux['category_id'] = $child['id'];
                            $resultDiscount[] = $discAux;
                        }
                }
            }

            return $resultDiscount;
        }
        else
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
    public function getProductDiscount($product, $price = null) {

        $discountArray = $this->getDiscountOneProduct($product);

        if (count($discountArray) > 0) {
            if (null === $price)
                $price = $this->ci->discount_model_front->getPrice($product['vid']);
            $discountMax = $this->baseDiscount->getMaxDiscount($discountArray, $price);
            $discountValue = $this->baseDiscount->getDiscountValue($discountMax, $price);
        } else {
            \CMSFactory\assetManager::create()->discount = false;
            return false;
        }

        \CMSFactory\assetManager::create()->discount = array(
            'discoun_all_product' => $discountArray,
            'discount_max' => $discountMax,
            'discount_value' => $discountValue,
            'price' => $price
        );

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
    private function getDiscountOneProduct($product) {

        $arrDiscount = array();

        foreach ($this->discountForProduct as $disc)
            foreach ($product as $key => $value) {
                if ($disc[$key])
                    if ($disc[$key] == $value)
                        $arrDiscount[] = $disc;
            }

        return $arrDiscount;
    }

}
