<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class discount_model_front for Mod_Discount module
 * @uses CI_Model
 * @author DevImageCms
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 */
class discount_model_front extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * get all activ discount
     * @return array discount
     */
    public function getDiscount() {

        $locale = \MY_Controller::getCurrentLocale();
        $time = time();
        $sql = "select *, mod_shop_discounts.id as ids, mod_shop_discounts.id as id
                from mod_shop_discounts
                left join mod_shop_discounts_i18n on mod_shop_discounts_i18n.id = mod_shop_discounts.id and mod_shop_discounts_i18n.locale = '$locale'
                where (max_apply > count_apply 
                        or max_apply is null 
                        or (max_apply is null and count_apply is null)
                        or (count_apply is null and max_apply > 0))
                      and 
                      (date_begin < '$time' and date_end > '$time' 
                          or date_begin < '$time' and date_end is Null 
                           or date_begin is Null and date_end is Null
                           or date_begin < '$time' and date_end = '0'
                           or date_begin is null and date_end = '0')
                      and 
                       active = 1";
        
         
        return $this->db->query($sql)->result_array();
    }

    /**
     * get current type discount
     * @param (int) $id
     * @param (string) $type
     * @return array discount
     */
    public function joinDiscount($id, $type) {

        $sql = "select * from mod_discount_$type where discount_id = '$id'";
        return $this->db->query($sql)->row_array();
    }

    /**
     * get product for id
     * @param (int) $id
     * @return StdClass product
     */
    public function getProduct($id) {

        $sql = "select id as product_id, category_id, brand_id from shop_products where id = '$id' limit 1";
        return $this->db->query($sql)->row();
    }

    /**
     * get origin product price for id variant
     * @param (int) $id
     * @return (float) price
     */
    public function getPrice($id) {

        $priceProd = $this->db->query("select price from shop_product_variants where id = '$id'")->row();
        return number_format($priceProd->price, ShopCore::app()->SSettings->pricePrecision,'.', '');
    }

    /**
     * get sum orders paid users
     * @param (int) $id
     * @return (float) price
     */
    public function getAmoutUser($id) {

        $sql = "select amout from users where id = '$id'";
        $result = $this->db->query($sql)->row();
        return $result->amout;
    }
    
    /**
     * update apply for discount
     * @param (int) $key
     * @param (boll) $gift
     * @return (float) price
     */
    public function updateApply($key, $gift = null){
        
        $sql = "UPDATE mod_shop_discounts SET count_apply = 0 WHERE `key` = '$key' AND max_apply IS NOT NULL AND count_apply IS NULL";
        $this->db->query($sql);
        
        $sql = "UPDATE mod_shop_discounts SET count_apply = count_apply + 1 WHERE `key` = '$key' AND max_apply IS NOT NULL AND count_apply < max_apply";
        $this->db->query($sql);
        
        
        if ($gift !== Null)
            $this->db->query("update mod_shop_discounts set active = 0 where `key` = '$key'");
        
        return true;
        
    }
    
    
   

}
