<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class discount_api for Mod_Discount module
 * @uses \MY_Controller
 * @author DevImageCms 
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 */
class discount_api extends \MY_Controller {

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
        $lang = new MY_Lang();
        $lang->load('mod_discount');
    }

    /**
     * is in project gift certificate
     * @deprecated since version 4.5.2
     * @copyright (c) 2013, ImageCMS
     */
    public function isGiftCertificat() {
        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        foreach ($this->baseDiscount->discountType['all_order'] as $disc)
            if ($disc['is_gift']) {
                return true;
                break;
            }
        return false;
    }

    /**
     * get gift certificate in json format
     * @access public
     * @author DevImageCms
     * @param (string) key optional
     * @param (float) totalPrice optional
     * @return jsoon
     * @copyright (c) 2013, ImageCMS
     */
    public function getGiftCertificate($key = null, $totalPrice = null) {
        $cart = \Cart\BaseCart::getInstance();
        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        if ($totalPrice === null)
            $totalPrice = $cart->getTotalPrice();

        if (null === $key)
            $key = strip_tags(trim($_GET['key']));
        foreach ($this->baseDiscount->discountType['all_order'] as $disc)
            if ($disc['key'] == $key and $disc['is_gift']) {
                $value = $this->baseDiscount->getDiscountValue($disc, $totalPrice);
                return json_encode(array('key' => $disc['key'], 'val_orig' => $value, 'value' => \ShopCore::app()->SCurrencyHelper->convert($value), 'gift_array' => $disc));
                break;
            }
        return json_encode(array('error' => true, 'mes' => lang('Invalid code try again', 'mod_discount')));
    }

    /**
     * get discount in json format
     * @access public
     * @author DevImageCms
     * @param (bool) typeReturn optional 
     * @param array $option params:
     * - (float) price: 
     * - (int) userId: 
     * - (bool) ignoreCart: ignore cart Data: 
     * - (bool) new: for redeclare singelton: 
     * @return json
     * @copyright (c) 2013, ImageCMS
     */
    public function getDiscount($option = array(), $typeReturn = null) {

        if (count($option) > 0)
            \mod_discount\classes\BaseDiscount::prepareOption($option);

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
            $discount['result_sum_discount_convert'] = ShopCore::app()->SCurrencyHelper->convert($discount['result_sum_discount']);
        }
        if ($discount['result_sum_discount']) {
            if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && !$typeReturn)
                echo json_encode($discount);
            else
                return $discount;
        }
        else
            echo '';
    }

    /**
     * get discount product
     * @access public
     * @author DevImageCms
     * @param array [pid,vid], (float) price optional 
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function getDiscountProduct($product, $price = null) {
        if (\mod_discount\classes\BaseDiscount::checkModuleInstall()) {
            $DiscProdObj = \mod_discount\Discount_product::create();
            if ($DiscProdObj->getProductDiscount($product, $price)) {
                $arr = \CMSFactory\assetManager::create()->discount;
                if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
                    echo json_encode($arr);
                else
                    return $arr;
            }
        }
        return false;
    }

    /**
     * get all discount information without maximized
     * @access public
     * @author DevImageCms
     * @param array $option params:
     * - (float) price: 
     * - (int) userId: 
     * - (bool) ignoreCart: ignore cart Data: 
     * - (bool) new: for redeclare singelton: 
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function getUserDiscount($option = array()) {
        if (count($option) > 0)
            \mod_discount\classes\BaseDiscount::prepareOption($option);

        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        if (\mod_discount\classes\BaseDiscount::checkModuleInstall()) {
            $this->baseDiscount->discountType['comulativ'] = $this->getComulativDiscount($option);
            return $this->baseDiscount->discountType;
        }
    }

    /**
     * If discount for current user exist or nots
     * @return boolean
     */
    public function discountsExists() {
        $ud = $this->userDiscountExists();
        $gd = $this->groupDiscountExists();
        $userDiscount = $this->getUserDiscount();
        return $ud || $gd || (bool) $userDiscount['comulativ'] ? TRUE : FALSE;
    }

    public function userDiscountExists() {
        return (bool) !\mod_discount\classes\DiscountManager::validateUserDiscount(CI::$APP->dx_auth->get_user_id());
    }

    public function groupDiscountExists() {
        return (bool) !\mod_discount\classes\DiscountManager::validateGroupDiscount(CI::$APP->dx_auth->get_role_id());
    }

    /**
     * get comulativ discount sorting
     * @access private
     * @author DevImageCms
     * @param (float) price optional 
     * @param (float) userId optional 
     * @param (bool) new optional 
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function getComulativDiscount($option) {

        if (count($option) > 0)
            \mod_discount\classes\BaseDiscount::prepareOption($option);

        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        if (\mod_discount\classes\BaseDiscount::checkModuleInstall())
            usort($this->baseDiscount->discountType['comulativ'], function($a, $b) {
                        return strnatcmp($a["begin_value"], $b["begin_value"]);
                    });
        return $this->baseDiscount->discountType['comulativ'];
    }

    /**
     * get one discount
     * @access public
     * @author DevImageCms
     * @param (string) key: criteria 
     * @param (int) id: id discount 
     * @return json
     * @copyright (c) 2013, ImageCMS
     */
    public function getDiscountBy($key, $id) {

        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        foreach ($this->baseDiscount->allDiscount as $disc) {
            switch ($key) {
                case 'key':
                    if ($disc['key'] == $id)
                        return json_encode($disc);
                    break;
                case 'id':
                    if ($disc['ids'] == $id)
                        return json_encode($disc);
                    break;

                default:
                    break;
            }
        }
        return false;
    }

    /**
     * get all active discount
     * @access public
     * @author DevImageCms
     * @param (float) price optional 
     * @param (float) userId optional 
     * @param (bool) new optional 
     * @return json
     * @copyright (c) 2013, ImageCMS
     */
    public function getAllDiscount() {

        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        return json_encode($this->baseDiscount->discountType);
    }

    /**
     * apply discount for all products
     * @access public
     * @author DevImageCms
     * @return (int) cnt: count update products
     * @copyright (c) 2013, ImageCMS
     */
    public function applyProductDiscount() {

        $productVariants = $this->db
                ->select('shop_product_variants.id as var_id, shop_product_variants.price as price, shop_products.id as id, shop_products.brand_id as brand_id, shop_products.category_id as category_id')
                ->from('shop_products')
                ->join('shop_product_variants', 'shop_product_variants.product_id = shop_products.id')
                ->get('shop_product_variants')
                ->result_array();
        foreach ($productVariants as $var) {
            $arr_for_discount = array(
                'product_id' => $var['id'],
                'category_id' => $var['category_id'],
                'brand_id' => $var['brand_id'],
                'vid' => $var['var_id'],
                'id' => $var['id']
            );
            \CMSFactory\assetManager::create()->discount = 0;
            \mod_discount\Discount_product::create()->getProductDiscount($arr_for_discount);

            if ($discount = \CMSFactory\assetManager::create()->discount) {
                $priceNew = ((float) $var['price'] - (float) $discount['discount_value'] < 0) ? 1 : (float) $var['price'] - (float) $discount['discount_value'];
                $dataProductUpdate = array(
                    'price' => ($discount) ? $priceNew : $var['price'],
                    'price_no_disc' => $var['price'],
                    'disc' => $discount['discount_value'],
                );
                $this->db->where('id', $var['var_id'])->update('shop_product_variants', $dataProductUpdate);
                $cnt++;
            }
        }
        return $cnt;
    }

    /**
     * test api DiscountManager
     */
    public function test() {
        /*
         * @param array $postArray input params:
         * - (string) key: discount key optional
         * - (string) name: discount name
         * - (int) max_apply: max apply discount default null - infinity
         * - (int) type_value: 1 - % 2 - float
         * - (int) value: discount value
         * - (string) type_discount: (all_order, comulativ, user, group_user, category, product, brand)
         * - (string) date_begin: data begin discount 
         * - (string) date_end: data end discount default null - infinity
         * - (int) brand_id: id brand
         */
        $data = array(
            'name' => 'discountApi',
            'type_value' => 1,
            'value' => 50,
            'date_begin' => '2014-01-23',
            'date_end' => '2014-01-26',
            'brand_id' => 30454
        );

        $manager = new \mod_discount\classes\DiscountManager();
        var_dump($manager->createBrandDiscount($data));
        //var_dump($manager->deleteDiscount(14));
    }

    /**
     * is in project gift certificate
     * @deprecated since version 4.5.2
     * @copyright (c) 2013, ImageCMS
     */
    public function is_gift_certificat() {
        return $this->isGiftCertificat();
        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        foreach ($this->baseDiscount->discountType['all_order'] as $disc)
            if ($disc['is_gift']) {
                return true;
                break;
            }
        return false;
    }

    /**
     * render gift input
     * @deprecated since version 4.5.2
     * @copyright (c) 2013, ImageCMS
     */
    public function render_gift_input($mes = null) {
        if (\mod_discount\classes\BaseDiscount::checkModuleInstall())
            if ($this->is_gift_certificat())
                \CMSFactory\assetManager::create()->setData(array('mes' => $mes))->render('gift', true);
    }

    /**
     * get gift certificate in tpl
     * @deprecated since version 4.5.2
     * @copyright (c) 2013, ImageCMS
     */
    public function render_gift_succes() {
        $json = json_decode($_GET['json']);
        \CMSFactory\assetManager::create()->setData(array('gift' => $json))->render('gift_succes', true);
    }

    /**
     * get all discount information without maximized
     * @deprecated since version 4.5.2 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_user_discount_api($option = array()) {
        return $this->getUserDiscount($option);
    }

    /**
     * get discount product
     * @deprecated since version 4.5.2 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_product_api($product, $typeReturn = null, $price = null) {
        return $this->getDiscountProduct($product, $typeReturn = null, $price = null);
    }

    /**
     * get discount in tpl format from json
     * @deprecated since version 4.5.2 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_tpl_from_json_api() {
        $json = json_decode($_GET['json']);

        \CMSFactory\assetManager::create()->setData(array('discount' => $json))->render('discount_order', true);
    }

    /**
     * get discount in json format
     * @deprecated since version 4.5.2 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_api($option = array()) {
        return $this->getDiscount($option);
    }

    /**
     * get gift certificate in json format
     * @deprecated since version 4.5.2 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_gift_certificate($key = null, $totalPrice = null) {
        return $this->getGiftCertificate($key = null, $totalPrice = null);
    }

}
