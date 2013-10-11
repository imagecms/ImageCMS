<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Discount_model_admin extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get discounts List
     * @param string $discountType
     * @param int $rowCount
     * @param int $offset
     * @return array
     */
    public function getDiscountsList($discountType = null, $rowCount = null, $offset = null) {
        $locale = \MY_Controller::getCurrentLocale();
        $query = $this->db->select("*, mod_shop_discounts.id as id")->join('mod_shop_discounts_i18n', "mod_shop_discounts_i18n.id = mod_shop_discounts.id and mod_shop_discounts_i18n.locale = '" . $locale . "'", 'left')
                //->where("mod_shop_discounts_i18n.locale " , $locale )
                ->order_by('mod_shop_discounts.active', 'desc')->order_by('mod_shop_discounts.id', 'desc');
        if ($discountType != null) {
            $query = $query->where('mod_shop_discounts.type_discount', $discountType);
        }
        $query = $query->get('mod_shop_discounts')->result_array();
        
        return $query;
    }

    /**
     * Change discount status active or not
     * @param int $id
     * @return string|boolean
     */
    public function changeActive($id) {
        $discount = $this->db->where('id', $id)->get('mod_shop_discounts')->row();
        $active = $discount->active;
        if ($active == 1)
            $active = 0;
        else
            $active = 1;

        // Check is discount with such id
        if ($discount == null)
            return false;

        // If updated active succes then return TRUE
        if ($this->db->where('id', $id)->update('mod_shop_discounts', array('active' => $active)))
            return true;

        return false;
    }

    /**
     * Get main currency symbol
     * @return boolean
     */
    public function getMainCurrencySymbol() {
        $query = $this->db->select('symbol')->where('main', 1)->get('shop_currencies')->row_array();

        if ($query)
            return $query['symbol'];
        else
            return false;
    }

    /**
     * Check have any discoun with given key
     */
    public function checkDiscountCode($key) {
        $query = $this->db->where('key', $key)->get('mod_shop_discounts')->row_array();

        if ($query)
            return true;
        else
            return false;
    }

    /**
     * get users by id name email
     * @param string $term
     * @param int $limit
     * return boolean|array
     */
    public function getUsersByIdNameEmail($term, $limit = 7) {

        $query = $this->db
                ->like('username', $term)
                ->or_like('email', $term)
                ->or_like('id', $term)
                ->limit($limit)
                ->get('users')
                ->result_array();

        if ($query)
            return $query;
        else
            return false;
    }

    /**
     * Get user groups
     * @param string $locale
     * @return boolean|array
     */
    public function getUserGroups($locale = 'ru') {

        $query = $this->db
                ->select('shop_rbac_roles.id, shop_rbac_roles_i18n.alt_name')
                ->from('shop_rbac_roles')
                ->join('shop_rbac_roles_i18n', 'shop_rbac_roles.id=shop_rbac_roles_i18n.id')
                ->where('locale', $locale)
                ->get()
                ->result_array();

        if ($query)
            return $query;
        else
            return false;
    }

    /**
     * 
     * @param string $term
     * @param int $limit
     * @return boolean|array
     */
    public function getProductsByIdNameNumber($term, $limit = 7) {
        $locale = MY_Controller::getCurrentLocale();
        $query = $this->db
                ->select('id, name')
                ->from('shop_products_i18n')
                ->where('locale', $locale)
                ->like('id', $term)
                ->or_like('name', $term)
                ->limit($limit)
                ->get()
                ->result_array();

        if ($query)
            return $query;
        else
            return false;
    }

    /**
     * Insert data, uses when create discount
     * @param string $tableName 
     * @param array $data 
     * @return boolean|int
     */
    public function insertDataToDB($tableName, $data) {
        try {
            $this->db->insert($tableName, $data);
            return $this->db->insert_id();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Update discount by id.
     * @param int $id
     * @param array $data
     * @return boolean
     */
    public function updateDiscountById($id, $data, $typeDiscountData, $locale) {
        $name = $data['name'];
        unset($data['name']);
        $discountType = $data['type_discount'];
        $previousDiscount = $this->getDiscountAllDataById($id);

        $discountTypeTableNamePrevious = 'mod_discount_' . $previousDiscount['type_discount'];
        $discountTypeTableNameNew = 'mod_discount_' . $discountType;

        try {
            $this->db->where('id', $id)->update('mod_shop_discounts', $data);
            if ($this->db->query("select * from mod_shop_discounts_i18n where id = '$id' and locale = '$locale'")->num_rows())
                $this->db->query("update mod_shop_discounts_i18n set name = '$name' where id = '$id' and locale = '$locale'");
            else
                $this->db->query("insert into mod_shop_discounts_i18n(id,name,locale) values('$id','$name','$locale')");
            
            $this->db->where('discount_id', $id)->delete($discountTypeTableNamePrevious);
            $typeDiscountData['discount_id'] = $id;

            $this->db->insert($discountTypeTableNameNew, $typeDiscountData);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Check have any comulativ discount max endValue. 
     * 
     * @param int $editDiscountId uses in order to not counting edited discount
     * @return boolean
     */
    public function checkHaveAnyComulativDiscountMaxEndValue($editDiscountId = null) {

        $query = $this->db;
        if ($editDiscountId)
            $query = $query->where('discount_id !=', $editDiscountId);

        $query = $query->where('end_value', null)->or_where('end_value', 0)->get('mod_discount_comulativ')->result_array();

        if (count($query))
            return true;
        else
            return false;
    }

    /**
     * Get discount all data by id
     * @param int $id
     * @return boolean|array
     */
    public function getDiscountAllDataById($id, $locale = null) {
        if (null === $locale)
            $locale = MY_Controller::getCurrentLocale();
        $query = $this->db->from('mod_shop_discounts')->where('id', $id)->get()->row_array();
        $query_locale = $this->db->from('mod_shop_discounts_i18n')->where('id', $id)->where('locale', $locale)->get()->row();
        $query['name'] = $query_locale->name;
        $discountType = $query['type_discount'];

        if ($discountType)
            $queryDiscountType = $this->db->from('mod_discount_' . $discountType)->where('discount_id', $id)->get()->row_array();

        if ($queryDiscountType)
            $query[$discountType] = $queryDiscountType;

        if ($query)
            return $query;
        else
            return false;
    }

    /**
     * Get username and email by id
     * @param int $id
     * @return string|boolean
     */
    public function getUserNameAndEmailById($id) {

        $query = $this->db->select('username, email')->from('users')->where('id', $id)->get()->row_array();
        if ($query) {
            $userInfo = $query['username'] . ' - ' . $query['email'];
            return $userInfo;
        }

        return false;
    }

    /**
     * Get product name by id
     * @param int $id
     * @return string|boolean
     */
    public function getProductById($id) {
        $locale = MY_Controller::getCurrentLocale();
        $query = $this->db
                ->select('name')
                ->from('shop_products_i18n')
                ->where('id', $id)
                ->where('locale', $locale)
                ->get()
                ->row_array();

        if ($query)
            return $query['name'];

        return false;
    }

    /**
     * Delete discount by id
     * @param type $id
     * @return boolean
     */
    public function deleteDiscountById($id) {
        $query = $this->db->from('mod_shop_discounts')->where('id', $id)->get()->row_array();
        $discountType = $query['type_discount'];
        if (!$query)
            return false;
        try {
            $this->db->where('id', $id)->delete('mod_shop_discounts');
            $this->db->where('id', $id)->delete('mod_shop_discounts_i18n');
            $this->db->where('discount_id', $id)->delete('mod_discount_' . $discountType);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Install module
     */
    public function moduleInstall() {


        $column = $this->db->query("SHOW COLUMNS FROM `shop_orders` where `Field` = 'discount'")->num_rows();
        if (!$column) {
            $sql = "ALTER TABLE shop_orders ADD discount float(10,2);";
            $this->db->query($sql);
        }

        $column = $this->db->query("SHOW COLUMNS FROM `shop_orders` where `Field` = 'discount_info'")->num_rows();
        if (!$column) {
            $sql = "ALTER TABLE shop_orders ADD discount_info TEXT;";
            $this->db->query($sql);
        }

        $column = $this->db->query("SHOW COLUMNS FROM `shop_orders` where `Field` = 'origin_price'")->num_rows();
        if (!$column) {
            $sql = "ALTER TABLE shop_orders ADD origin_price float(10,2);";
            $this->db->query($sql);
        }


        $sql = "CREATE  TABLE IF NOT EXISTS `mod_shop_discounts` (
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `key` VARCHAR(25) NULL ,
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
        
        $sql = "CREATE  TABLE IF NOT EXISTS `mod_shop_discounts_i18n` (
                  `id` INT NOT NULL ,
                  `locale` VARCHAR(5) NOT NULL ,
                  `name` VARCHAR(150) NULL ,
                  PRIMARY KEY (`id`,`locale`) )
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
        $this->db->update('components', array('enabled' => 1, 'autoload' => 1));
    }

    /**
     * Delete module
     */
    public function moduleDelete() {

        $this->load->dbforge();
        $this->dbforge->drop_table('mod_shop_discounts');
        $this->dbforge->drop_table('mod_shop_discounts_i18n');
        $this->dbforge->drop_table('mod_discount_brand');
        $this->dbforge->drop_table('mod_discount_all_order');
        $this->dbforge->drop_table('mod_discount_comulativ');
        $this->dbforge->drop_table('mod_discount_group_user');
        $this->dbforge->drop_table('mod_discount_user');
        $this->dbforge->drop_table('mod_discount_category');
        $this->dbforge->drop_table('mod_discount_product');
    }

    /**
     * Validation atribute lables
     * @return array
     */
    public function attributeLabels() {
        return array(
            'value' => ShopCore::t(lang('Value', 'mod_discount')),
        );
    }

    /**
     * Validation attribute rules
     * @return array
     */
    public function rules() {
        return array(
            array(
                'field' => 'value',
                'label' => lang('Value', 'mod_discount'),
                'rules' => 'required|integer',
            ),
        );
    }

}
