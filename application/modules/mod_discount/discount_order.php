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
class Discount_order extends classes\BaseDiscount {
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
     * update order table
     * @access public
     * @author DevImageCms
     * @param array
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */        
    public function update_order_discount($data){
        if ($this->check_module_install()) {
            $discobj = new \mod_discount\discount;
            $discount = $discobj->init()->get_result_discount(1);
            
            require_once 'gift.php';
            $obkGift = new \Gift();
            
            $gift = json_decode($obkGift->get_gift_certificate($data['key']));

            if (!$gift->error){

                $pricetotal_gift = (float)$data['price'] - (float)$gift->val_orig;
                if ($pricetotal_gift < 0)
                    $pricetotal_gift = 0;
                $data['order']->setgiftcertprice($gift->val_orig);
                $data['order']->setgiftcertkey($gift->key);
                $data['order']->settotalprice($pricetotal_gift);
                $data['order']->setoriginprice($data['price']);
                $data['order']->save();
                $obkGift->updatediskapply($data['key'], 'gift'); // TODO
            }
            
            if ($discount['result_sum_discount']){
                $pricetotal_gift_disc = (float)$data['price'] - (float)$gift->val_orig - (float)$discount['result_sum_discount'];
                if ($pricetotal_gift_disc < 0)
                    $pricetotal_gift_disc = 0;
                $data['order']->setdiscount($discount['result_sum_discount']);
                $data['order']->settotalprice($pricetotal_gift_disc);
                if ($discount['sum_discount_no_product'] > $discount['sum_discount_product'])
                    $data['order']->setdiscountinfo(json_encode($discount['max_discount']));
                $data['order']->setoriginprice($data['price']);
                $data['order']->save();
                $this->updatediskapply($discount['max_discount']['key']); // TODO
            }
            
        }
        
        
            
        
        
    }
}