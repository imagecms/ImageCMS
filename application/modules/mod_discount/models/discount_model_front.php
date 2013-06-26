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
        
        ///echo $sql . '   ';

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
            $price += $this->get_price($item['variantId']) * $item['quantity'];

        return $price;
    }

    public function get_amout_user($id) {

        $sql = "select amout from users where id = '$id'";
        $result = $this->db->query($sql)->row();
        return $result->amout;
    }
    
    public function updateapply($key){
        
        $sql = "update mod_shop_discounts set count_apply = count_apply + 1 where `key` = '$key' and max_apply IS NOT NULL";

        $this->db->query($sql);
        
    }
    
    /**
     * Install module
     */
    public function moduleInstall (){
        
        $sql = "CREATE  TABLE IF NOT EXISTS `mod_shop_discounts` (
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `key` VARCHAR(25) NULL ,
                  `name` VARCHAR(150) NULL ,
                  `active` TINYINT NULL ,
                  `max_apply` INT NULL ,
                  `count_apply` INT NULL ,
                  `date_begin` INT(11) NULL ,
                  `date_end` INT(11) NULL ,
                  `type_value` TINYINT NULL ,
                  `value` INT NULL ,
                  `type_discount` VARCHAR(15) NULL ,
                  PRIMARY KEY (`id`) ,
                  UNIQUE INDEX `key_UNIQUE` (`key` ASC) )
                ENGINE = MyISAM
                DEFAULT CHARACTER SET = utf8
                COLLATE = utf8_general_ci;";
            $this->db->query($sql);

            $sql = "CREATE  TABLE IF NOT EXISTS `mod_discount_product` (
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `product_id` INT NULL ,
                  `discount_id` INT NULL ,                 
                  PRIMARY KEY (`id`),
                  INDEX(`discount_id`),
                  INDEX(`product_id`))
                ENGINE = MyISAM
                DEFAULT CHARACTER SET = utf8
                COLLATE = utf8_general_ci;";
            $this->db->query($sql);

            $sql = "CREATE  TABLE IF NOT EXISTS `mod_discount_category` (
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `category_id` INT NULL ,
                  `discount_id` INT NULL ,
                  PRIMARY KEY (`id`),
                  INDEX(`discount_id`),
                  INDEX(`category_id`))
                ENGINE = MyISAM
                DEFAULT CHARACTER SET = utf8
                COLLATE = utf8_general_ci;";
            $this->db->query($sql);

            $sql = "CREATE  TABLE IF NOT EXISTS `mod_discount_user` (
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `user_id` INT NULL ,
                  `discount_id` INT NULL ,                 
                  PRIMARY KEY (`id`),
                  INDEX(`discount_id`),
                  INDEX(`user_id`))
                ENGINE = MyISAM
                DEFAULT CHARACTER SET = utf8
                COLLATE = utf8_general_ci;";
            $this->db->query($sql);

            $sql = "CREATE  TABLE IF NOT EXISTS `mod_discount_group_user` (
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `group_id` INT NULL ,
                  `discount_id` INT NULL ,                  
                  PRIMARY KEY (`id`),
                  INDEX(`discount_id`),
                  INDEX(`group_id`))
                ENGINE = MyISAM
                DEFAULT CHARACTER SET = utf8
                COLLATE = utf8_general_ci;";
            $this->db->query($sql);

            $sql = "CREATE  TABLE IF NOT EXISTS `mod_discount_comulativ` (
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `discount_id` INT NULL ,
                  `begin_value` INT NULL ,
                  `end_value` INT NULL ,                  
                  PRIMARY KEY (`id`),
                  INDEX(`discount_id`))
                ENGINE = MyISAM
                DEFAULT CHARACTER SET = utf8
                COLLATE = utf8_general_ci;";
            $this->db->query($sql);

            $sql = "CREATE  TABLE IF NOT EXISTS `mod_discount_all_order` (
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `for_autorized` TINYINT NULL ,
                  `discount_id` INT NULL ,
                  `is_gift` TINYINT NULL ,
                  `begin_value` FLOAT NULL ,
                  PRIMARY KEY (`id`),
                  INDEX(`discount_id`))
                ENGINE = MyISAM
                DEFAULT CHARACTER SET = utf8
                COLLATE = utf8_general_ci;";
            $this->db->query($sql);

            $sql = "CREATE  TABLE IF NOT EXISTS `mod_discount_brand` (
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `brand_id` INT NULL ,
                  `discount_id` INT NULL ,                  
                  PRIMARY KEY (`id`),
                  INDEX(`discount_id`),
                  INDEX(`brand_id`))
                ENGINE = MyISAM
                DEFAULT CHARACTER SET = utf8
                COLLATE = utf8_general_ci;";
            $this->db->query($sql);



            $this->db->where('name', 'mod_discount');
            $this->db->update('components', array('enabled' => 1));
    }
    /**
     * Delete module
     */
    public function moduleDelete() {
        
        $this->load->dbforge();
        $this->dbforge->drop_table('mod_shop_discounts');
        $this->dbforge->drop_table('mod_discount_brand');
        $this->dbforge->drop_table('mod_discount_all_order');
        $this->dbforge->drop_table('mod_discount_comulativ');
        $this->dbforge->drop_table('mod_discount_group_user');
        $this->dbforge->drop_table('mod_discount_user');
        $this->dbforge->drop_table('mod_discount_category');
        $this->dbforge->drop_table('mod_discount_product');
    }

}
