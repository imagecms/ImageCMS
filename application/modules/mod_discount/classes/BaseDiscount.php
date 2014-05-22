<?php

namespace mod_discount\classes;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class BaseDiscount for Mod_Discount module
 * @author DevImageCms
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model_front $discount_model_front
 */
class BaseDiscount {

    private static $object;
    private static $totalPrice;
    private static $reBuild;
    private static $ignoreCart;
    private static $userId;

    /**
     * Information about each product which quantity was more then max applies
     * @var array
     */
    public $aplyOverloadProducts = array();

    /**
     * check_module_install
     * @access public
     * @author DevImageCms
     * @return boolean
     * @copyright (c) 2013, ImageCMS
     */
    public static function checkModuleInstall() {
        $ci = &get_instance();
        return (count($ci->db->where('name', 'mod_discount')->get('components')->result_array()) == 0) ? false : true;
    }

    /**
     * prepareOption
     * @access public
     * @author DevImageCms
     * @param array $option params:
     * - (float) price: 
     * - (int) userId: 
     * - (bool) ignoreCart: ignore cart Data: 
     * - (bool) reBuild: for redeclare singelton:
     * @copyright (c) 2013, ImageCMS
     */
    public static function prepareOption($option) {
        if ($option['price'])
            self::setTotalPrice($option['price']);
        if ($option['userId'])
            self::setUserId($option['userId']);
        if ($option['ignoreCart'])
            self::setIgnoreCart($option['ignoreCart']);
        if ($option['reBuild'])
            self::reBuild();
    }

    /**
     * setTotalPrice
     * @access private
     * @author DevImageCms
     * @param (float) price:
     * @copyright (c) 2013, ImageCMS
     */
    private static function setTotalPrice($price = null) {
        self::$totalPrice = $price;
    }

    /**
     * setTotalPrice
     * @access private
     * @author DevImageCms
     * @param (int) userId:
     * @copyright (c) 2013, ImageCMS
     */
    private static function setUserId($userId = null) {
        self::$userId = $userId;
    }

    /**
     * setIgnoreCart
     * @access private
     * @author DevImageCms
     * @param (bool) ignoreCart
     * @copyright (c) 2013, ImageCMS
     */
    private static function setIgnoreCart($ignoreCart = null) {
        self::$ignoreCart = $ignoreCart;
    }

    /**
     * reBuild
     * @access private
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     */
    private static function reBuild() {
        self::$reBuild = 1;
    }

    /**
     * singelton method
     * @return object BaseDiscount
     */
    public static function create() {
        if (!self::$object || self::$reBuild)
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
        if (\mod_discount\classes\BaseDiscount::checkModuleInstall()) {
            require_once __DIR__ . '/../models/discount_model_front.php';
            $this->ci->discount_model_front = new \discount_model_front;
            $lang = new \MY_Lang();
            $lang->load('mod_discount');
            $this->cart = \Cart\BaseCart::getInstance();
            if (!self::$userId) {
                $this->userGroupId = $this->ci->dx_auth->get_role_id();
                $this->userId = $this->ci->dx_auth->get_user_id();
            } else {
                $this->userId = self::$userId;
                $this->userGroupId = $this->ci->db->where('id', $this->userId)->get('users')->row()->role_id;
            }
            if (!self::$ignoreCart)
                $this->cartData = $this->getCartData();

            $this->amoutUser = $this->ci->discount_model_front->getAmoutUser($this->userId);
            $this->totalPrice = (!self::$totalPrice) ? $this->cart->getOriginTotalPrice() : self::$totalPrice;
            $this->allDiscount = $this->getAllDiscount();
            $this->discountType = $this->collectType($this->allDiscount);
            $this->discountAllOrder = $this->getAllOrderDiscountNotRegister();
            if ($this->userId) {
                $this->discountUser = $this->getUserDiscount();
                $this->discountGroupUser = $this->getUserGroupDiscount();
                $this->discountComul = $this->getComulativDiscount();
                $this->discountAllOrder = $this->getAllOrderDiscountRegister();
            }

            $this->discountProductVal = (self::$ignoreCart) ? null : $this->getDiscountProducts();
            $this->discountMax = $this->getMaxDiscount(array($this->discountUser, $this->discountGroupUser, $this->discountComul, $this->discountAllOrder), $this->totalPrice);
            $this->discountNoProductVal = $this->getDiscountValue($this->discountMax, $this->totalPrice);
        }
    }

    /**
     * get Cart items for current session
     * @access private
     * @author DevImageCms
     * @param ---
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function getCartData() {

        $cart = $this->cart->getItems();
        return $cart['data'];
    }

    /**
     * 
     * @param string $type short type of discount (en)
     * @return string full translated name of discount
     */
    public static function getDiscountsLabels($type = NULL) {
        $discounts = array(
            "all_order" => lang('Order amount of more than', 'mod_discount'),
            "comulativ" => lang('Cumulative discount', 'mod_discount'),
            "user" => lang('User', 'mod_discount'),
            "group_user" => lang('Users group', 'mod_discount'),
            "category" => lang('Category', 'mod_discount'),
            "product" => lang('Product', 'mod_discount'),
            "brand" => lang('Brand', 'mod_discount'),
        );
        if (is_null($type)) {
            return $discounts;
        }
        if (isset($discounts[$type])) {
            return $discounts[$type];
        }
        return false;
    }

    /**
     * get all active discount joined whith his type
     * @access private
     * @author DevImageCms
     * @param --
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function getAllDiscount() {

        return $this->joinDiscountSettings($this->ci->discount_model_front->getDiscount());
    }

    /**
     * joined discount whith his type
     * @access private
     * @author DevImageCms
     * @param discount
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function joinDiscountSettings($discount) {

        foreach ($discount as $key => $disc)
            $discount[$key] = array_merge($discount[$key], $this->ci->discount_model_front->joinDiscount($disc['id'], $disc['type_discount']));

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
    private function collectType($discount) {

        $arr = array();
        foreach ($discount as $disc)
            $arr[$disc['type_discount']][] = $disc;

        return $this->emptyToArray($arr);
    }

    /**
     * set empty array for null ellement discount
     * @access private
     * @author DevImageCms
     * @param ---
     * @return ----
     * @copyright (c) 2013, ImageCMS
     */
    private function emptyToArray($discount) {
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
    public function getMaxDiscount($discount, $price) {
        $discount = array_filter(
                $discount, function($el) {
                    return !empty($el);
                });
        $maxDiscount = 0;
        foreach ($discount as $key => $disc) {
            $discountValue = $this->getDiscountValue($disc, $price);
            if ($maxDiscount <= $discountValue) {
                $maxDiscount = $discountValue;
                $keyMax = $key;
            }
        }
        return $discount[$keyMax];
    }

    /**
     * get value discount considering type value and price
     * @access public
     * @author DevImageCms
     * @param discount, price
     * @return float
     * @copyright (c) 2013, ImageCMS
     */
    public function getDiscountValue($discount, $price) {

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
    public function updateDiskApply($key, $gift = null) {

        return $this->ci->discount_model_front->updateApply($key, $gift);
    }

    /**
     * get max discount for current user
     * @access private
     * @author DevImageCms
     * @param ----
     * @return array 
     * @copyright (c) 2013, ImageCMS
     */
    private function getUserDiscount() {

        $discountUser = array();
        foreach ($this->discountType['user'] as $key => $userDisc)
            if ($userDisc['user_id'] == $this->userId)
                $discountUser[] = $userDisc;

        return (count($discountUser) > 0) ? $this->getMaxDiscount($discountUser, $this->totalPrice) : false;
    }

    /**
     * get max discount for current user_group
     * @access private
     * @author DevImageCms
     * @param ----
     * @return array 
     * @copyright (c) 2013, ImageCMS
     */
    private function getUserGroupDiscount() {

        $discountUserGr = array();
        foreach ($this->discountType['group_user'] as $userGrDisc)
            if ($userGrDisc['group_id'] == $this->userGroupId)
                $discountUserGr[] = $userGrDisc;

        return (count($discountUserGr) > 0) ? $this->getMaxDiscount($discountUserGr, $this->totalPrice) : false;
    }

    /**
     * get max comulativ discount for current user with current amout
     * @access private
     * @author DevImageCms
     * @param ----
     * @return array 
     * @copyright (c) 2013, ImageCMS
     */
    private function getComulativDiscount() {

        $discountComulativ = array();
        foreach ($this->discountType['comulativ'] as $disc)
            if (($disc['begin_value'] <= (float) $this->amoutUser and $disc['end_value'] > (float) $this->amoutUser ) or ($disc['begin_value'] <= (float) $this->amoutUser and !$disc['end_value']))
                $discountComulativ[] = $disc;

        return (count($discountComulativ) > 0) ? $this->getMaxDiscount($discountComulativ, $this->totalPrice) : false;
    }

    /**
     * get discount for product in cart with his discount
     * @access private
     * @author DevImageCms
     * @param ----
     * @return float 
     * @copyright (c) 2013, ImageCMS
     */
    private function getDiscountProducts() {
        foreach ($this->cartData as $item) {
            $priceOrigin = number_format($item->originPrice, \ShopCore::app()->SSettings->pricePrecision, '.', ''); // new Cart
            if (abs($priceOrigin - $item->price) > 1)
                $discountValue += ($priceOrigin - $item->price) * $item->quantity;
        }

        return $discountValue;
    }

    /**
     * get max discount for all order for register and not register user
     * @access private
     * @author DevImageCms
     * @param ----
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function getAllOrderDiscountRegister() {

        $allOrderArrReg = array();
        foreach ($this->discountType['all_order'] as $disc)
            if (!$disc['is_gift'])
                if ($disc['begin_value'] <= (int) $this->totalPrice)
                    $allOrderArrReg[] = $disc;

        return (count($allOrderArrReg) > 0) ? $this->getMaxDiscount($allOrderArrReg, $this->totalPrice) : false;
    }

    /**
     * get max discount for all order for not register user
     * @access private
     * @author DevImageCms
     * @param ----
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function getAllOrderDiscountNotRegister() {
        $allOrderArrNotReg = array();
        foreach ($this->discountType['all_order'] as $disc)
            if (!$disc['is_gift'])
                if ($disc['begin_value'] <= $this->totalPrice and !$disc['for_autorized'])
                    $allOrderArrNotReg[] = $disc;

        return (count($allOrderArrNotReg) > 0) ? $this->getMaxDiscount($allOrderArrNotReg, $this->totalPrice) : false;
    }

   

}
