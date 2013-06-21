<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class for Mod_Discount module
 * @uses \mod_discount\classes\BaseDiscount
 * @author DevImageCms 
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property discount_model $discount_model
 * @property discount_model_front $discount_model_front
 */
class Mod_discount extends \mod_discount\classes\BaseDiscount{

    public $no_install = true;
    protected $result_discount = array();
    
    /**
     * __construct base object loaded
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     */
    public function __construct() {

        parent::__construct();        
        if (count($this->db->where('name', 'mod_discount')->get('components')->result_array()) == 0)
            $this->no_install = false;

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
        \CMSFactory\Events::create()->on('getVariantProduct')->setListener('get_discount_for_product');
    }
    
    /**
     * get discount for product when get product variant
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_for_product($product) {
        
        $obj = new \mod_discount\discount_product;
        $obj->get_product_discount_event($product);

    }
      
    /**
     * initializing all method for getting discount
     * @access public
     * @author DevImageCms
     * @param ---
     * @return Mod_discount
     * @copyright (c) 2013, ImageCMS
     */
    public function init() {

        $this->get_user_id();
        
        $this->get_user_group_id();
        
        $this->get_cart_data();
        
        if ($this->cart_data)
            $this->get_total_price();
        
        $this->get_all_discount();
        
        $this->collect_type();
        
        $discount_all_order = $this->get_all_order_discount_not_register();
        
        if ($this->user_id) {
            
            $this->get_amout_user();
            
            $discount_user = $this->get_user_discount();

            $discount_group_user = $this->get_user_group_discount();

            $discount_comulativ = $this->get_comulativ_discount();

            $discount_all_order = $this->get_all_order_discount_register();
            
        }
        
        $this->result_discount = array(
                                'all_order'=>$discount_all_order, 
                                'comulative' => $discount_comulativ, 
                                'user' => $discount_group_user, 
                                'user_group' => $discount_user);
        
        return $this;
    }

    /**
     * get final discount for order
     * @access public
     * @author DevImageCms
     * @param $render for getting result as array or discount value only
     * @return discount array discount with key: all_active_discount, all_max_type_discount, max_discount, sum_discount_product, sum_discount_no_product, result_sum_discount or only value discount
     * @copyright (c) 2013, ImageCMS
     */
    public function get_result_discount($render = null) {

        $discount_max = $this->get_max_discount($this->result_discount, $this->total_price);        

        $discount_value_no_product = $this->get_discount_value($discount_max, $this->total_price);

        $discount_product_value = $this->get_discount_products();

        if ($discount_value_no_product > $discount_product_value)
            $result = $discount_value_no_product;
        else
            $result = $discount_product_value;
        
        if (null === $render)
            return $result;
        else
            return array(
                'all_active_discount' => $this->discount_type,
                'all_max_type_discount' => $this->result_discount,
                'max_discount' => $discount_max,
                'sum_discount_product' => $discount_product_value,
                'sum_discount_no_product' => $discount_value_no_product,
                'result_sum_discount' => $result
            );
    }

    /**
     * get max discount for current user
     * @access public
     * @author DevImageCms
     * @param ----
     * @return array 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_user_discount() {       

        $discount_user = array();
        foreach ($this->discount_type['user'] as $user_disc)
            if ($user_disc['user_id'] == $this->user_id)
                $discount_user[] = $user_disc;

        if (count($discount_user) > 0)
            return $this->get_max_discount($discount_user, $this->total_price);
        else
            return false;
    }

     /**
     * get max discount for current user_group
     * @access public
     * @author DevImageCms
     * @param ----
     * @return array 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_user_group_discount() {

        $discount_user_gr = array();
        foreach ($this->discount_type['group_user'] as $user_gr_disc)
            if ($user_gr_disc['group_id'] == $this->user_group_id)
                $discount_user_gr[] = $user_gr_disc;

        if (count($discount_user_gr) > 0)
            return $this->get_max_discount($discount_user_gr, $this->total_price);
        else
            return false;
    }

     /**
     * get max comulativ discount for current user with current amout
     * @access public
     * @author DevImageCms
     * @param ----
     * @return array 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_comulativ_discount() {

        $discount_comulativ = array();
        foreach ($this->discount_type['comulativ'] as $disc)
            if (($disc['begin_value'] <= $this->amout_user and $disc['end_value'] > $this->amout_user and $disc['end_value'] !== NULL) or ($disc['begin_value'] <= $this->amout_user and $disc['end_value'] !== NULL))
                $discount_comulativ[] = $disc;
        if (count($discount_comulativ) > 0)
            return $this->get_max_discount($discount_comulativ, $this->total_price);
        else
            return false;
    }


     /**
     * get discount for product in cart with his discount
     * @access public
     * @author DevImageCms
     * @param ----
     * @return float 
     * @copyright (c) 2013, ImageCMS
     */
    public function get_discount_products() {

        foreach ($this->cart_data as $item) {
            if ($item['instance'] == 'SProducts') {
                $price_origin = $this->discount_model_front->get_price($item['variantId']);
                if ($price_origin != $item['price'])
                    $discount_value += $price_origin - $item['price'];
            }
        }

        return $discount_value;
    }
    
     /**
     * get max discount for all order for register and not register user
     * @access public
     * @author DevImageCms
     * @param ----
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_all_order_discount_register() {

        $all_order_arr_reg = array();
        foreach ($this->discount_type['all_order'] as $disc)
            if (!$disc['is_gift'])
                if ($disc['begin_value'] <= $this->total_price)
                    $all_order_arr_reg[] = $disc;

        if (count($all_order_arr_reg) > 0)
            return $this->get_max_discount($all_order_arr_reg, $this->total_price);
        else
            return false;
    }

     /**
     * get max discount for all order for not register user
     * @access public
     * @author DevImageCms
     * @param ----
     * @return array
     * @copyright (c) 2013, ImageCMS
     */
    public function get_all_order_discount_not_register() {

        $all_order_arr_not_reg = array();
        foreach ($this->discount_type['all_order'] as $disc)
            if (!$disc['is_gift'])
                if ($disc['begin_value'] <= $this->total_price and $disc['for_autorized'] === NULL)
                    $all_order_arr_not_reg[] = $disc;

        if (count($all_order_arr_not_reg) > 0)
            return $this->get_max_discount($all_order_arr_not_reg, $this->total_price);
        else
            return false;
    }




    /**
     * install module and create table
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     */
    public function _install() {

        if (SHOP_INSTALLED) {

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
                  `begin_value` FLOAT NULL ,
                  `end_value` FLOAT NULL ,                  
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

/* End of file mod_discount.php */
