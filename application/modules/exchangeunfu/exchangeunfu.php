<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Exchangeunfu
 * @link http://v8.1c.ru/edi/edi_stnd/131/
 * @copyright ImageCMS(c) 2013, ImageCMSDev
 */
class Exchangeunfu extends MY_Controller {

    /** Import/export objects */
    private $import;
    private $export;
    private static $return = 0;

    /** array which contains 1c settings  */
    private $config = array();
    private $login;
    private $password;

    /** default directory for saving files from 1c */
    private $tempDir;

    public function __construct() {
        parent::__construct();

        $this->export = new \exchangeunfu\exportXML();
        $this->import = new \exchangeunfu\importXML();

        /* define path to folder for saving files from 1c */
        $this->tempDir = PUBPATH . 'application/modules/shop/cmlTemp/';

        include 'application/modules/exchangeunfu/helpers/ex_helper.php';

        $this->config = $this->get1CSettings();

        if (!$this->config) {
            //default settings if module is not installed yet
            $this->config['zip'] = 'no';
            $this->config['filesize'] = 2048000;
            $this->config['validIP'] = '127.0.0.1';
            $this->config['password'] = '';
            $this->config['usepassword'] = false;
            $this->config['userstatuses'] = array();
            $this->config['autoresize'] = 'off';
            $this->config['debug'] = false;
            $this->config['email'] = false;
        }

        $this->login = trim($_SERVER['PHP_AUTH_USER']);
        $this->password = trim($_SERVER['PHP_AUTH_PW']);
        //saving get requests to log file
        if ($_GET) {
            foreach ($_GET as $key => $value) {
                $string .= date('c') . " GET - " . $key . ": " . $value . "\n";
            }
            write_file($this->tempDir . "log.txt", $string, FOPEN_WRITE_CREATE);
        }

        //define first get command parameter
        $method = 'command_';

        //preparing method and mode name from $_GET variables
        if (isset($_GET['type']) && isset($_GET['mode']))
            $method .= strtolower($_GET['type']) . '_' . strtolower($_GET['mode']);

        //run method if exist
        if (method_exists($this, $method))
            $this->$method();
    }

    public function index() {
        
    }

    /**
     * returns exchange settings to 1c
     * @zip no
     * @file_limit in bytes
     */
    private function command_catalog_init() {
        if ($this->check_perm() === true) {
            echo "zip=no\n";
            echo "file_limit=1000000000";
        }
        exit();
    }

    public function make_import() {

        $this->import->import();
    }

    /**
     * get 1c settings from modules table
     * @return boolean
     */
    private function get1CSettings() {
        $config = $this->db
                ->where('identif', 'exchangeunfu')
                ->get('components')
                ->row_array();
        if (empty($config))
            return false;
        else
            return unserialize($config['settings']);
    }

    /**
     * checking password from $_GET['password'] if use_password option in settings is "On"
     */
    private function check_password() {
        if (($this->config['login'] == $this->login) && ($this->config['password'] == $this->password)) {
            $this->checkauth();
        } else {
            echo "failure. wrong password";
            $this->error_log('Неверно введен пароль', TRUE);
        }
    }

    /**
     * return to 1c session id and success status
     * to initialize import start
     */
    private function command_catalog_checkauth() {
        if ($this->config['usepassword'] == 'on') {
            $this->check_password();
        } else {
            $this->checkauth();
        }
        exit();
    }

    /**
     * checkauth for orders import
     */
    private function command_sale_checkauth() {
        if ($this->config['usepassword'] == 'on') {
            $this->check_password();
        } else {
            $this->checkauth();
        }
        exit();
    }

    /**
     * preparing to import
     * writing session id to txt file in md5
     * deleting old import files
     */
    private function checkauth() {
        echo "success\n";
        echo session_name() . "\n";
        echo session_id() . "\n";
        $string = md5(session_id());
        write_file($this->tempDir . "session.txt", $string, 'w');
        if (file_exists($this->tempDir . 'import.xml'))
            unlink($this->tempDir . 'import.xml');
        if (file_exists($this->tempDir . 'offers.xml'))
            unlink($this->tempDir . 'offers.xml');
    }

    /**
     * checking if current session id matches session id in txt files
     * @return boolean
     */
    private function check_perm() {
        if ($this->config['debug'])
            return true;

        $string = read_file($this->tempDir . 'session.txt');
        if (md5(session_id()) == $string) {
            return true;
        } else {
            $this->error_log("Ошибка безопасности!!!", TRUE);
            die("Ошибка безопасности!!!");
        }
    }

    /**
     * saves exchange files to tempDir
     * xml files will be saved to tempDir/
     * images wil be saved  to tempDir/images as jpg files
     */
    private function command_catalog_file() {
        if ($this->check_perm() === true) {
            $st = $_GET['filename'];
            $st = basename($st);
            if (strrchr($st, "/"))
                $st = strrchr($st, "/");
            $ext = pathinfo($st, PATHINFO_EXTENSION);
            if ($ext == 'xml')
            //saving xml files to cmlTemp
                if (write_file($this->tempDir . $_GET['filename'], file_get_contents('php://input'), 'a+')) {
                    echo "success";
                }
        }
        exit();
    }

    /**
     * loading xml file to $this->xml variable
     * uses simple xml extension
     * @param type $filename
     * @return boolean
     */
    private function _readXmlFile($filename) {
        if (file_exists($this->tempDir . $filename) && is_file($this->tempDir . $filename))
            return simplexml_load_file($this->tempDir . $filename);
        return false;
    }

    /**
     * start import process
     * @return string "success" if success
     */
    private function command_catalog_import() {

        //check if session is up to date
        if ($this->check_perm() === true) {
            if ($this->config['backup'])
                $this->makeDBBackup();
            //start import process
//            $this->import->import($this->input->get('filename'));
            //rename import xml file after import finished
            if (!$this->config['debug'])
                rename($this->tempDir . ShopCore::$_GET['filename'], $this->tempDir . "success_" . ShopCore::$_GET['filename']);
            //returns success status to 1c
            echo "success";
        }
        exit();
    }

    public function make_export($partner_id = null) {
        $this->export->export($partner_id);
    }

    public static function adminAutoload() {
        \CMSFactory\Events::create()
                ->onShopProductPreUpdate()
                ->setListener('_extendPageAdmin');

        \CMSFactory\Events::create()
                ->onShopProductPreCreate()
                ->setListener('_extendPageAdmin');

        \CMSFactory\Events::create()
                ->onShopProductCreate()
                ->setListener('_addProductExternalId');

        \CMSFactory\Events::create()
                ->onShopProductCreate()
                ->setListener('_addProductPartner');

        \CMSFactory\Events::create()
                ->onShopProductUpdate()
                ->setListener('_addProductPartner');

        \CMSFactory\Events::create()
                ->onShopUserCreate()
                ->setListener('_addUserExternalId');

        \CMSFactory\Events::create()
                ->onShopCategoryCreate()
                ->setListener('_addCategoryExternalId');

        \CMSFactory\Events::create()
                ->onShopOrderCreate()
                ->setListener('_addOrderExternalId');
    }

    public static function _extendPageAdmin($data) {
        $ci = &get_instance();
        if ($ci->uri->segment(6) == 'edit') {

            $array = $ci->db
                    ->where('product_external_id', $data['model']->getExternalId())
                    ->join('mod_exchangeunfu_partners', 'mod_exchangeunfu_prices.partner_external_id=mod_exchangeunfu_partners.external_id')
                    ->get('mod_exchangeunfu_prices');
        } else {
            $array = array();
        }
        $partners = $ci->db->get('mod_exchangeunfu_partners');

        if ($partners) {
            $partners = $partners->result_array();
        } else {
            $partners = array();
        }

        if ($array) {
            $array = $array->result_array();
        } else {
            $array = array();
        }


        $partners_exist = array();
        foreach ($array as $key => $price) {
            $partners_exist[] = $price['partner_external_id'];
        }

        $view = \CMSFactory\assetManager::create()
                ->registerScript('exchangeunfu')
                ->setData('info', $array)
                ->setData('partnets_exists', $partners_exist)
                ->setData('partners', $partners)
                ->fetchAdminTemplate('main');
        /**
         * return fix block
         */
        if (self::$return == 0) {
            \CMSFactory\assetManager::create()
                    ->appendData('moduleAdditions', $view);
            self::$return++;
        }
    }

    public static function _addProductPartner($data) {
        $ci = &get_instance();

        $partners = $ci->input->post('partner');
        $prices = $ci->input->post('partner_price');
        $quantities = $ci->input->post('partner_quantity');
        $product = $ci->db->select('external_id')->where('id', $data['productId'])->get('shop_products')->row_array();

        foreach ($partners as $key => $partner) {
            if ($partner) {
                $ci->db->insert('mod_exchangeunfu_prices', array(
                    'price' => $prices[$key],
                    'quantity' => $quantities[$key],
                    'product_external_id' => $product['external_id'],
                    'partner_external_id' => $partner,
                    'external_id' => md5($prices[$key] . $product['external_id'])
                ));
            }
        }
    }

    public static function _addProductExternalId($data) {
        $ci = &get_instance();
        $external_id = md5($data['productId']);
        $ci->db->update('shop_products', array('external_id' => $external_id));
        $product_variants = $ci->db->where('product_id', $data['productId'])->get('shop_product_variants')->result_array();

        $variant_counter = 0;
        foreach ($product_variants as $variant) {
            $external_var_id = md5($variant['id'] + $variant_counter);
            $ci->db->where('id', $variant['id'])
                    ->update('shop_product_variants', array('external_id' => $external_var_id));
        }
    }

    public static function _addUserExternalId($data) {
        $ci = &get_instance();
        $external_id = md5($data['user']->getId());
        $ci->db->where('id', $data['user']->getId())->update('users', array('external_id' => $external_id));
    }

    public static function _addCategoryExternalId($data) {
        $ci = &get_instance();
        $external_id = md5($data['ShopCategoryId']);
        $ci->db->where('id', $data['ShopCategoryId'])->update('shop_category', array('external_id' => $external_id));
    }

    public static function _addOrderExternalId($data) {
        $ci = &get_instance();
        foreach ($data['products'] as $producst_id) {
            $external_id = md5($producst_id);
            $ci->db->where('id', $producst_id)
                    ->where('order_id', $data['order_id'])
                    ->update('shop_orders_products', array('external_id' => $external_id));
        }
    }

    public function updatePrice() {
        $price = $this->input->post('price');
        $quantity = $this->input->post('quantity');
        $product_external_id = $this->input->post('product_external_id');
        $partner = $this->input->post('partner');

        $this->db
                ->where('product_external_id', $product_external_id)
                ->where('partner_external_id', $partner)
                ->set('price', $price)
                ->set('quantity', $quantity)
                ->update('mod_exchangeunfu_prices');
    }

    public function deletePartner() {
        $product_external_id = $this->input->post('product_external_id');
        $partner = $this->input->post('partner');

        $this->db
                ->where('product_external_id', $product_external_id)
                ->where('partner_external_id', $partner)
                ->delete('mod_exchangeunfu_prices');
    }

    public function setHit() {
        $product_external_id = $this->input->post('product_external_id');
        $partner = $this->input->post('partner');
        $hit = $this->input->post('hit');

        $this->db
                ->where('product_external_id', $product_external_id)
                ->where('partner_external_id', $partner)
                ->set('hit', $hit)
                ->update('mod_exchangeunfu_prices');
    }

    public function setHot() {
        $product_external_id = $this->input->post('product_external_id');
        $partner = $this->input->post('partner');
        $hot = $this->input->post('hot');

        $this->db
                ->where('product_external_id', $product_external_id)
                ->where('partner_external_id', $partner)
                ->set('hot', $hot)
                ->update('mod_exchangeunfu_prices');
    }

    public function setAction() {
        $product_external_id = $this->input->post('product_external_id');
        $partner = $this->input->post('partner');
        $action = $this->input->post('action');

        $this->db
                ->where('product_external_id', $product_external_id)
                ->where('partner_external_id', $partner)
                ->set('action', $action)
                ->update('mod_exchangeunfu_prices');
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
                'auto_increment' => TRUE
            ),
            'action' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'hit' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'hot' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'quantity' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
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
            ),
            'external_id' => array(
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
        $this->dbforge->drop_table('mod_exchangeunfu_prices');
    }

    /**
     * Colect ids form model and return prices for current region
     * @param SProducts $model
     */
    public function getPriceForRegion($model) {
        // TEST SET COOKIE
        set_cookie('site_region', 'asdfasdfsdsdfsdf', 10000);
        $partner_external_id = get_cookie('site_region');
        $external_ids = array();
        
        if (count($model) == 1) {
            // product
            if ($model->getExternalId()) {
                $ids[] = $model->getExternalId();
                $external_ids[$model->getExternalId()] = $model->getId();
            }
        } elseif (count($model) > 1) {
            // category/brand/search
            foreach ($model as $product) {
                if ($product->getExternalId()) {
                    $ids[] = $product->getExternalId();
                    $external_ids[$product->getExternalId()] = $product->getId();
                }
            }
        } else {
            // an empty model
            return false;
        }
        
        $products_by_region = $this->db
                ->where('partner_external_id', $partner_external_id)
                ->where_in('product_external_id', $ids)
                ->get('mod_exchangeunfu_prices');

        $region_prices = array();
        foreach ($products_by_region->result_array() as $product) {
            $product_id = $external_ids[$product['product_external_id']];
            $price = $product['price'];
            $discount = $this->load->module('mod_discount/discount_api')
                    ->get_discount_product_api(array('id' => $product_id, 'vid'=> null), null, $price);
            
            if($discount){
                $region_prices[$product_id] = $price - $discount['discount_value'];
            }else{
                $region_prices[$product_id] = $price;
            }
            
        }
        
        if($region_prices){
            return $region_prices;
        }else{
            return 0;
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

    function error_log($error, $send_email = FALSE) {
        $intIp = $_SERVER ["REMOTE_ADDR"];
        if (isset($_SERVER ["HTTP_X_FORWARDED_FOR"])) {
            if (isset($_SERVER ["HTTP_X_REAL_IP"]))
                $intIp = $_SERVER ["HTTP_X_REAL_IP"];
            else
                $intIp = $_SERVER ["HTTP_X_FORWARDED_FOR"];
        }

        if ($this->config[debug])
            write_file($this->tempDir . "error_log.txt", $intIp . ' - ' . date('c') . ' - ' . $error . PHP_EOL, 'ab');

        if ($send_email) {
            $this->load->library('email');

            $this->email->from("noreplay@{$_SERVER['HTTP_HOST']}");
            $this->email->to($this->config['email']);

            $this->email->subject('1C exchange');
            $this->email->message($intIp . ' - ' . date('c') . ' - ' . $error . PHP_EOL);

            $this->email->send();
        }
    }

    /**
     * creating xml document with orders to make possible for 1c to grab it
     */
    private function command_sale_query() {
        if ($this->check_perm() === true) {
            $this->export->export($partner_id);
        }
        exit();
    }

    /**
     * runs when orders from site succesfully uploaded to 1c server
     * and sets some status for imported orders "waiting" for example
     */
    private function command_sale_success() {
        /**
         * @todo доробити. Потрібно щоб тут був гет з вказання партнера
         */
//        if ($this->check_perm() === true) {
//            $model = SOrdersQuery::create()->findByStatus($this->config['userstatuses']);
//            foreach ($model as $order) {
//                $order->SetStatus($this->config['userstatuses_after']);
//                $order->save();
//            }
//        }
        exit();
    }

}

/* End of file exchangeunfu.php */
