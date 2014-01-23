<?php
namespace mod_discount;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Gift for Mod_Discount module
 * @uses \mod_discount\classes\BaseDiscount
 * @author DevImageCms 
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model $discount_model
 * @property discount_model_front $discount_model_front
 */
class Gift extends \MY_Controller {

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
    }

    /**
     * is in project gift certificate
     * @access public
     * @author DevImageCms
     * @param ---
     * @return boolean
     * @copyright (c) 2013, ImageCMS
     */
    public function is_gift_certificat() {
        $this->base_discount = \mod_discount\classes\BaseDiscount::create();
        foreach ($this->base_discount->discount_type['all_order'] as $disc)
            if ($disc['is_gift']) {
                return true;
                break;
            }
        return false;
    }


    /**
     * get gift certificate
     * @access public
     * @author DevImageCms
     * @param key optional
     * @return ----
     * @copyright (c) 2013, ImageCMS
     */
    public function get_gift_certificate($key = null, $totalPrice = null, $order = null) {
        $cart = \Cart\BaseCart::getInstance()->recountOriginTotalPrice()->recountTotalPrice();
        $this->base_discount = \mod_discount\classes\BaseDiscount::create();
        $aplyGift = false;
        if ($totalPrice === null)
            $totalPrice = $cart->getTotalPrice();
        echo '1';
        if (null === $key)
            $key = strip_tags(trim($_GET['key']));
        foreach ($this->base_discount->discount_type['all_order'] as $disc)
            if ($disc['key'] == $key and $disc['is_gift']) {
                $value = $this->base_discount->get_discount_value($disc, $totalPrice);                
                $cart->gift_info = $disc['key'];
                $cart->gift_value = $value;
                $cart->recountOriginTotalPrice();
                $cart->recountTotalPrice();
                $aplyGift = true;
                if ($order)
                    $this->base_discount->updatediskapply($disc['key'], 'gift');

                break;
            }

        if (!$aplyGift)
            $cart->gift_error = TRUE;
            
        

    }

    /**
     * render gift input
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function render_gift_input($mes = null) {
        if ($this->check_module_install())
            if ($this->is_gift_certificat())
                \CMSFactory\assetManager::create()->setData(array('mes' => $mes))->render('gift', true);
    }

    /**
     * get gift certificate in tpl
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function render_gift_succes() {
        $json = json_decode($_GET['json']);
        \CMSFactory\assetManager::create()->setData(array('gift' => $json))->render('gift_succes', true);
    }

}

