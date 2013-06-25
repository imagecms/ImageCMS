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
        \CMSFactory\Events::create()->on('MakeOrder')->setListener('make_order_with_discount');
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
     * update order with discount and gift
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */   
    public function make_order_with_discount($data){
        $obj = new \mod_discount\discount_order;
        $obj->update_order_discount($data);
    }
    
    public function register_script(){
        \CMSFactory\assetManager::create()->registerScript('main');
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
