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
     * @param (bool) optional
     * @return json
     * @copyright (c) 2013, ImageCMS
     */
    public function getDiscount($render = null) {

        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        if (count($this->baseDiscount->cartData) > 0)
            if ($this->baseDiscount->checkModuleInstall()) {


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
            if ($render === null)
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
     * @param array [pid,vid], (bool) tpl optional, (float) price optional 
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function getDiscountProduct($product, $tpl = null, $price = null) {
        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        if ($this->baseDiscount->checkModuleInstall()) {
            $DiscProdObj = \mod_discount\Discount_product::create();
            if ($DiscProdObj->getProductDiscount($product, $price)) {
                $arr = \CMSFactory\assetManager::create()->discount;
                if (null === $tpl)
                    return $arr;
                elseif (1 === $tpl)
                    \CMSFactory\assetManager::create()->setData(array('discount_product' => $arr))->render('discount_product', true);
                elseif ('json' === $tpl)
                    echo json_encode($arr);
            }
            else
                return false;
        }
        return false;
    }
    

    /**
     * get all discount information without maximized
     * @access public
     * @author DevImageCms
     * @param (bool) tpl optional 
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function getUserDiscountApi($tpl = null) {
        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        if ($this->baseDiscount->checkModuleInstall()) {
            $this->baseDiscount->discountType['comulativ'] = $this->getComulativDiscountApi();
            if (null === $tpl)
                return $this->baseDiscount->discountType;
            else
                \CMSFactory\assetManager::create()->setData(array('discount' => $this->baseDiscount->discountType))->render('discount_info_user', true);
        }
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
    public function getDiscountBy($key, $id){
        
        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        foreach ($this->baseDiscount->allDiscount as $disc){
            switch ($key) {
                case 'key':
                    if ($disc['key'] == $id)
                        return json_encode ($disc);
                    break;
                case 'id':
                    if ($disc['ids'] == $id)
                        return json_encode ($disc);
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
     * @return json
     * @copyright (c) 2013, ImageCMS
     */    
    public function getAllDiscount(){
        
        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        return json_encode($this->baseDiscount->discountType);
        
    }
    
    /**
     * get comulativ discount sorting
     * @access private
     * @author DevImageCms
     * @param --
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    private function getComulativDiscountApi() {

        function cmp($a, $b) {
            return strnatcmp($a["begin_value"], $b["begin_value"]);
        }
        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        if ($this->baseDiscount->checkModuleInstall())
            usort($this->baseDiscount->discountType['comulativ'], 'cmp');
        return $this->baseDiscount->discountType['comulativ'];
    }
    
    
    /**
     * test api DiscountManager
     */
    public function test (){
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
        $this->baseDiscount = \mod_discount\classes\BaseDiscount::create();
        if ($this->baseDiscount->checkModuleInstall())
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
    public function get_user_discount_api($tpl = null) {
        return $this->getUserDiscountApi($tpl = null);
    }
    
    /**
     * get discount product
     * @deprecated since version 4.5.2 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_product_api($product, $tpl = null, $price = null){
        return $this->getDiscountProduct($product, $tpl = null, $price = null);
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
    public function get_discount_api($render = null) {
        return $this->getDiscount($render = null);
    }
    
    /**
     * get gift certificate in json format
     * @deprecated since version 4.5.2 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_gift_certificate($key = null, $totalPrice = null){
        return $this->getGiftCertificate($key = null, $totalPrice = null);
    }

}