<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Exchangeunfu
 */
class Exchangeunfu extends MY_Controller {

    /** Import/export objects */
    private $import;
    private $export;
    
    public function __construct() {
        parent::__construct();
        $this->export = new \exchangeunfu\exportXML();
        $this->import = new \exchangeunfu\importXML();
        include 'application/modules/exchangeunfu/helpers/ex_helper.php';

    }

    public function index() {
        
    }
    
    public function make_import(){
        $this->import->import();
    }

    public function make_export($partner_id = null){
        $this->export->export($partner_id);
    }
    
    public static function adminAutoload() {
        \CMSFactory\Events::create()
                ->onShopProductPreUpdate()
                ->setListener('_extendPageAdmin');
    }

    public static function _extendPageAdmin($data) {
        $ci = &get_instance();

        $array = $ci->db
                ->where('product_id', $data['model']->getid())
                ->get('mod_exchangeunfu');
        if($array){
            $array = $array->result_array();
        }else{
            $array = array();
        }

        $view = \CMSFactor\assetManager::create()
                ->setData('data1', $array)
                ->fetchTemplate('main');

        \CMSFactory\assetManager::create()
                ->appendData('moduleAdditions', $view);
    }

    public function _install() {

        $this->load->dbforge();
        
        $this->db->query('ALTER TABLE `users` ADD `external_id` VARCHAR( 250 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_orders_products` ADD `external_id` VARCHAR( 255 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_orders` ADD `partner_external_id` VARCHAR( 255 ) NOT NULL');

        $this->db->query('ALTER TABLE `users` ADD `external_id` VARCHAR( 250 ) NOT NULL');
        $this->db->query('ALTER TABLE `users` ADD `code` VARCHAR( 250 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_orders_products` ADD `external_id` VARCHAR( 255 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_orders` ADD `partner_external_id` VARCHAR( 255 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_orders` ADD `delivery_date` INT( 11 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_orders` ADD `code` VARCHAR( 255 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_orders` ADD `invoice_external_id` VARCHAR( 255 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_orders` ADD `invoice_code` VARCHAR( 255 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_orders` ADD `invoice_date` INT( 11 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_category` ADD `code` VARCHAR( 255 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_products` ADD `code` VARCHAR( 255 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_products` ADD `measure` VARCHAR( 255 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_products` ADD `barcode` VARCHAR( 255 ) NOT NULL');





        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
            ),
            'product_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => FALSE,
            ),
            'variant_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => FALSE,
            ),
            'region' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'price' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_exchangeunfu', TRUE);

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
            ),
            'action' => array(
                'type' => 'TINYINT',
                'constraint' => 1
            ),
            'price' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'product_external_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'partner_external_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'external_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_exchangeunfu_prices', TRUE);

         $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
            ),
            'name' => array(
               'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'prefix' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),            
            'region' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'external_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_exchangeunfu_partners', TRUE);

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
            ),
            'date' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'hour' => array(
                'type' => 'INT',
                'constraint' => 2
            ),
            'count' => array(
                'type' => 'INT',
                'constraint' => 100
            ),
            'partner_external_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_exchangeunfu_productivity', TRUE);
        $this->db->query('INSERT INTO `mod_exchangeunfu` (
                            `id` ,
                            `product_id` ,
                            `variant_id` ,
                            `region`
                        )
                        VALUES (NULL ,  \'892\',  \'873\',  \'lviv\');'
                );

        $this->db->where('name', 'exchangeunfu')
                ->update('components', array('autoload' => '1', 'enabled' => '1'));
    }

    public function _deinstall() {
        $this->db->query('ALTER TABLE `users` DROP `external_id`');
        $this->db->query('ALTER TABLE `users` DROP `code`');
        $this->db->query('ALTER TABLE `shop_orders_products` DROP `external_id`');
        $this->db->query('ALTER TABLE `shop_orders` DROP `partner_external_id`');
        $this->db->query('ALTER TABLE `shop_orders` DROP `delivery_date`');
        $this->db->query('ALTER TABLE `shop_orders` DROP `code`');
        $this->db->query('ALTER TABLE `shop_orders` DROP `invoice_external_id`');
        $this->db->query('ALTER TABLE `shop_orders` DROP `invoice_code`');
        $this->db->query('ALTER TABLE `shop_orders` DROP `invoice_date`');
        $this->db->query('ALTER TABLE `shop_category` DROP `code`');
        $this->db->query('ALTER TABLE `shop_products` DROP `code`');
        $this->db->query('ALTER TABLE `shop_products` DROP `measure`');
        $this->db->query('ALTER TABLE `shop_products` DROP `barcode`');

        $this->load->dbforge();
        $this->dbforge->drop_table('mod_exchangeunfu');
        $this->dbforge->drop_table('mod_exchangeunfu_productivity');
        $this->dbforge->drop_table('mod_exchangeunfu_partners');
    }

    /**
     * Colect ids form model and return prices for current region
     * @param SProducts $model
     */
    public function getPriceForRegion($model) {
//        var_dump(count($model));

        if (count($model) == 1) {
            // product
            $ids[] = $model->getId();
        } elseif (count($model) > 1) {
            // category/brand/search
            foreach ($model as $product) {
                $ids[] = $product->getId();
                var_dump($product->getId());
            }
        } else {
            // an empty model
            return false;
        }

        $array = $this->db
                ->where_in('product_id', $ids)
                ->get('mod_exchangeunfu');

        if ($array) {
//            return $array->result_array();
            $result = array();
            foreach ($array->result_array() as $ar) {
                $result[$ar['variant_id']] = $ar['price'];
            }

            var_dump($result);
        }
    }

    /**
     * Get region name from cookie
     * @return string Name of region or null
     */
    public function getRegion() {
        $this->load->helper('cookie');
        return get_cookie('site_region');
    }

}

/* End of file exchangeunfu.php */
