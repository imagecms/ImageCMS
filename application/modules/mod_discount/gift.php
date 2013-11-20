<?php

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
class Gift extends \mod_discount\classes\BaseDiscount {
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
        $this->get_all_discount();
        $this->collect_type();
    }
     /**
     * is in project gift certificate
     * @access public
     * @author DevImageCms
     * @param ---
     * @return boolean
     * @copyright (c) 2013, ImageCMS
     */
    public function is_gift_certificat(){
        foreach ($this->discount_type['all_order'] as $disc) 
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
     * @param key optional
     * @return jsoon
     * @copyright (c) 2013, ImageCMS
     */
    public function get_gift_certificate($key = null, $totalPrice = null) {
        
        $this->get_cart_data();
        if ($totalPrice === null)
            $totalPrice = $this->get_total_price();
        if (null === $key)
            $key = strip_tags(trim($_GET['key']));
        foreach ($this->discount_type['all_order'] as $disc) 
            if ($disc['key'] == $key and $disc['is_gift']) {
                $value = $this->get_discount_value($disc,$totalPrice);
                return json_encode(array('key'=>$disc['key'], 'val_orig'=>$value, 'value'=>\ShopCore::app()->SCurrencyHelper->convert($value), 'gift_array'=>$disc));
                break;
            } 
        
        return json_encode(array('error'=>true, 'mes'=>lang('Invalid code try again', 'mod_discount')));
    }
      /**
     * render gift input
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */   
    public function render_gift_input($mes = null){
        if ($this->check_module_install())
            if ($this->is_gift_certificat())
                \CMSFactory\assetManager::create()->setData(array('mes'=>$mes))->render('gift', true);
        
    }
     /**
     * get gift certificate in tpl
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */      
    public function render_gift_succes(){
        $json = json_decode($_GET['json']);
        \CMSFactory\assetManager::create()->setData(array('gift' => $json))->render('gift_succes', true);
    }

}

