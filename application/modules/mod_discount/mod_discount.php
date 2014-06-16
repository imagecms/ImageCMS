<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class for Mod_Discount module
 * @uses \MY_Controller
 * @author DevImageCms 
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model_admin $discount_model_admin
 */
class Mod_discount extends \MY_Controller {

    public static $orderPassOverloadControl = false;
    public static $cnt = 0;
    public $no_install = true;
    protected $result_discount = array();

    /**
     * Discount counts apply - products quantity in 
     * the cart with discount than it is in max apply
     * @var array
     */
    private $appliesControl = array();
    public $overload = 0.0;

    /**
     * __construct base object loaded
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     */
    public function __construct() {

        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('mod_discount');
        $this->load->model('discount_model_admin');
    }

    /**
     * autoload execute when get product variant
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function autoload() {
        if (\mod_discount\classes\BaseDiscount::checkModuleInstall()) {

            $this->applyDiscountCartItems();

            $this->applyResultDiscount();
            /** apply Gift */
            if ($this->input->post('gift')) {
                $this->applyGift();
            }

            $giftKey = \CI::$APP->session->flashdata('makeOrderGiftKey');
            if (!empty($giftKey)) {
                \mod_discount\classes\BaseDiscount::create()->updateDiskApply($giftKey, 'gift');
            }

            \CMSFactory\Events::create()->setListener(array($this, 'updateDiscountsApplies'), 'Cart:OrderValidated');

            $cartItems = \Cart\BaseCart::getInstance()->getItems();
            $diff = 0;
            foreach ($cartItems['data'] as $item) {
                if (is_null($item->discountKey)) {
                    continue;
                }
                $appliesLeft = \mod_discount\classes\BaseDiscount::create()->getAppliesLeft($item->discountKey);
                if ($appliesLeft === null) {
                    continue;
                }
                for ($i = 0; $i < $item->quantity; $i++) {
                    if ($appliesLeft-- > 0) {
                        
                    }
                }
                if ($appliesLeft < 0) {
                    $appliesLeft = abs($appliesLeft);
                    $diff += ($item->originPrice - $item->price) * $appliesLeft;
                }
            }

            if ($diff > 0) {
                $cartPrice = \Cart\BaseCart::getInstance()->getTotalPrice();
                $cartPrice += $diff;
                \Cart\BaseCart::getInstance()->setTotalPrice($cartPrice);
            }
        }
    }

    /**
     * apply discount to Cart Items
     * @access private
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    private function applyDiscountCartItems() {
        $cart = \Cart\BaseCart::getInstance();
        $cartItems = $cart->getItems('SProducts');

        if (count($cartItems['data']) == 0) {
            return;
        }

        foreach ($cartItems['data'] as $item) {
            if ($item->originPrice > $item->price) {
                continue;
            }

            $arr_for_discount = array(
                'product_id' => $item->getSProducts()->getId(),
                'category_id' => $item->getSProducts()->getCategoryId(),
                'brand_id' => $item->getSProducts()->getBrandId(),
                'vid' => $item->id,
                'id' => $item->getSProducts()->getId()
            );
            \CMSFactory\assetManager::create()->discount = 0;

            if (\mod_discount\classes\BaseDiscount::checkModuleInstall())
                \mod_discount\discount_product::create()->getProductDiscount($arr_for_discount);

            if ($discount = \CMSFactory\assetManager::create()->discount) {
                $priceNew = ((float) $item->originPrice - (float) $discount['discount_value'] < 0) ? 1 : (float) $item->originPrice - (float) $discount['discount_value'];
                $productData = array('instance' => 'SProducts', 'id' => $item->id);
                $cartItem = $cart->getItem($productData);
                $dkey = $discount['discount_max']['key'];
                if ($cartItem['success'] === TRUE) {
                    $cartItem['data']->discountKey = $dkey;
                }
                $cart->setItemPrice($productData, $priceNew);

                if (!isset($this->appliesControl[$dkey])) {
                    $appliesLeft = \mod_discount\classes\BaseDiscount::create()->getAppliesLeft($item->discountKey);
                    if ($appliesLeft === null) {
                        continue;
                    }
                    $this->appliesControl[$dkey] = array(
                        'appliesLeft' => $appliesLeft,
                        'assumedApplies' => 0,
                        'overloadPrice' => 0.0
                    );
                }

                // gradually gathering overload (if will be)
                for ($i = 0; $i < $item->quantity; $i++) {
                    if (++$this->appliesControl[$dkey]['assumedApplies'] > $this->appliesControl[$dkey]['appliesLeft']) {
                        $this->appliesControl[$dkey]['overloadPrice'] += $discount['discount_value'];
                        $this->overload += $discount['discount_value'];
                    }
                }
            }
        }
    }

    /**
     * apply result discount
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    private function applyResultDiscount() {
        \mod_discount\classes\BaseDiscount::prepareOption(array('reBuild' => 1));
        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();

        if (\mod_discount\classes\BaseDiscount::checkModuleInstall()) {
            $discount['max_discount'] = $this->baseDiscount->discountMax;
            $discount['sum_discount_product'] = $this->baseDiscount->discountProductVal;
            $discount['sum_discount_no_product'] = $this->baseDiscount->discountNoProductVal;
            if ($this->baseDiscount->discountProductVal > $this->baseDiscount->discountNoProductVal) {
                $discount['result_sum_discount'] = $this->baseDiscount->discountProductVal;
                $discount['type'] = 'product';
            } else {
                $discount['result_sum_discount'] = $this->baseDiscount->discountNoProductVal;
                $discount['type'] = 'user';
            }

            if ($discount['result_sum_discount'] > 0) {
                $cartTotalPrice = $this->baseDiscount->cart->getOriginTotalPrice() - $discount['result_sum_discount'];

                $this->baseDiscount->cart->setTotalPrice($cartTotalPrice > 0 ? $cartTotalPrice : \Cart\BaseCart::MIN_ORDER_PRICE);
                $this->baseDiscount->cart->discount_info = $discount;
                $this->baseDiscount->cart->discount_type = $discount['type'];
            }
        }
    }

    public function updateDiscountsApplies() {
        \mod_discount\classes\BaseDiscount::prepareOption(array('reBuild' => 1));
        $baseDiscount = \mod_discount\classes\BaseDiscount::create();

        if (\mod_discount\classes\BaseDiscount::checkModuleInstall()) {
            if ($baseDiscount->discountProductVal > $baseDiscount->discountNoProductVal) {
                $discount['result_sum_discount'] = $baseDiscount->discountProductVal;
                $discount['type'] = 'product';
            } else {
                $discount['result_sum_discount'] = $baseDiscount->discountNoProductVal;
                $discount['type'] = 'user';
            }

            if ($discount['result_sum_discount'] > 0) {

                if ($discount['type'] != 'product') {
                    $baseDiscount->updateDiskApply($baseDiscount->discountMax['key']);
                } else {
                    $cartItems = \Cart\BaseCart::getInstance()->getItems();
                    $diff = 0;
                    foreach ($cartItems['data'] as $item) {
                        if (is_null($item->discountKey)) {
                            continue;
                        }
                        $appliesLeft = \mod_discount\classes\BaseDiscount::create()->getAppliesLeft($item->discountKey);
                        if ($appliesLeft === null) {
                            continue;
                        }
                        for ($i = 0; $i < $item->quantity; $i++) {
                            if ($appliesLeft-- > 0) {
                                \mod_discount\classes\BaseDiscount::create()->updateDiskApply($item->discountKey);
                            }
                        }
                        if ($appliesLeft < 0) {
                            $appliesLeft = abs($appliesLeft);
                            $diff += ($item->originPrice - $item->price) * $appliesLeft;
                        }
                    }
                    if ($diff > 0) {
                        \CMSFactory\Events::create()->setListener(function(\SOrders $order, $price) use ($diff) {
                            if (Mod_discount::$orderPassOverloadControl == false) {
                                $price = $order->getTotalPrice() + $diff;
                                $discount = $order->getDiscount() - $diff;
                                $order
                                        //->setDiscount($discount)
                                        ->setTotalPrice($price)
                                        ->save();
                                Mod_discount::$orderPassOverloadControl = true;
                            }
                        }, 'Cart:MakeOrder');
                    }
                }
            }
        }
    }

    /**
     * apply user gift
     * @access private
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    private function applyGift() {

        $key = $this->input->post('gift');
        $aplyGift = false;
        foreach ($this->baseDiscount->discountType['all_order'] as $disc)
            if ($disc['key'] == $key and $disc['is_gift']) {
                $value = $this->baseDiscount->getDiscountValue($disc, $this->baseDiscount->cart->getTotalPrice());

                $this->baseDiscount->cart->gift_info = $disc['key'];
                $this->baseDiscount->cart->gift_value = $value;
                if (\ShopCore::app()->SSettings->pricePrecision == 0) {
                    $this->baseDiscount->cart->gift_value = floor($value);
                }
                $cartTotalPrice = $this->baseDiscount->cart->getTotalPrice() - $value;
                $this->baseDiscount->cart->setTotalPrice($cartTotalPrice > 0 ? $cartTotalPrice : \Cart\BaseCart::MIN_ORDER_PRICE);
                $aplyGift = true;
                break;
            }

        if (!$aplyGift)
            $this->baseDiscount->cart->gift_error = TRUE;
    }

    /**
     * install module and create table
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     */
    public function _install() {

        if (SHOP_INSTALLED) {
            $this->discount_model_admin->moduleInstall();
        }
    }

    /**
     * deinstall module and drop tables
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     */
    public function _deinstall() {

        if ($this->dx_auth->is_admin() == FALSE)
            exit;

        $this->discount_model_admin->moduleDelete();
    }

    /**
     * register javascript
     * @deprecated since version 4.5.2
     * @copyright (c) 2013, ImageCMS
     */
    public function register_script() {
        \CMSFactory\assetManager::create()->registerScript('main', TRUE);
    }

}

/* End of file mod_discount.php */
