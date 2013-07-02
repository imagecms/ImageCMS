<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Discount_model_front extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_discount() {

        $time = time();
        $sql = "select *, id as ids
                from mod_shop_discounts
                where (max_apply > count_apply 
                        or max_apply is null 
                        or (max_apply is null and count_apply is null)) 
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

    public function join_discount($id, $type) {

        $sql = "select * from mod_discount_$type where discount_id = '$id'";
        return $this->db->query($sql)->row_array();
    }

    public function get_product($id) {

        $sql = "select id as product_id, category_id, brand_id from shop_products where id = '$id' limit 1";
        return $this->db->query($sql)->row();
    }

    public function get_price($id) {


        $price_prod = $this->db->query("select price from shop_product_variants where id = '$id'")->row();
        return $price_prod->price;
    }

    public function get_total_price($data) {

        $price = 0;
        foreach ($data as $item)
            if ($item['instance'] == 'SProducts')
                $price += $this->get_price($item['variantId']) * $item['quantity'];
            else
                $price += $item['price'] * $item['quantity'];

        return $price;
    }

    public function get_amout_user($id) {

        $sql = "select amout from users where id = '$id'";
        $result = $this->db->query($sql)->row();
        return $result->amout;
    }
    
    public function updateapply($key){
        
        $sql = "update mod_shop_discounts set count_apply = count_apply + 1 where `key` = '$key' and max_apply IS NOT NULL";

        return $this->db->query($sql);
        
    }
    
   

}
