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
    public static $hourCount = 0;

    /** array which contains 1c settings  */
    private $config = array();
    private $login;
    private $password;

    /** default directory for saving files from 1c */
    private $tempDir;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('exchangeunfu');

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

        $this->login = trim($this->input->server('PHP_AUTH_USER'));
        $this->password = trim($this->input->server('PHP_AUTH_PW'));
        //saving get requests to log file
        /*
          if ($_GET) {
          foreach ($_GET as $key => $value) {
          $string .= date('c') . " GET - " . $key . ": " . $value . "\n";
          }
          write_file($this->tempDir . "log.txt", $string, FOPEN_WRITE_CREATE);
          }
         */

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

    public static function adminAutoload() {
        \CMSFactory\Events::create()
                ->onShopProductPreUpdate()
                ->setListener('_extendPageAdmin');

        \CMSFactory\Events::create()
                ->onShopProductPreCreate()
                ->setListener('_extendPageAdmin');

        \CMSFactory\Events::create()
                ->onShopProductCreate()
                ->setListener('_addProductPartner');

        \CMSFactory\Events::create()
                ->onShopProductUpdate()
                ->setListener('_addProductPartner');
    }

    public function autoload() {

        \CMSFactory\Events::create()
                ->on('MakeOrder')
                ->setListener('_setHour');

        \CMSFactory\Events::create()
                ->on('MakeOrder')
                ->setListener('_setPartnerId');
    }

    public static function _setHour($date) {
        $ci = &get_instance();
        $extId = self::getDefaultRegionIds();
        $parter = $ci->db->where('external_id', $extId["external_id"])->get('mod_exchangeunfu_partners');
        if ($parter) {
            $parter = $parter->row_array();

            $ci->db
                    ->where('external_id', $parter['external_id'])
                    ->set('send_cat', 1)
                    ->set('send_users', 1)
                    ->set('send_prod', 1)
                    ->update('mod_exchangeunfu_partners');
        }

        preg_match_all('/\d+/', $_POST['timedilivery'], $hours);
        $i = $hours[0][0];
        while ($hours[0][1] > $i) {

            $count = self::getCountHours($i, $_POST['datedilivery']);

            if (count($count)) {
                if ($count[0]->count != 0) {
                    self::recountProductivityHour($count[0]->count, $count[0]->id);
                    self::updateOrderHour($_POST['datedilivery'], $i, $date["order"]->id);
                    break;
                }
            }

            $i++;
        }
    }

    public static function _setPartnerId($date) {
        $ci = & get_instance();
        $orderId = $date['order']->id;

        $region = self::getDefaultRegionIds();
        if (!is_array($region))
            return false;

        $data = array(
            'partner_external_id' => $region['external_id'],
            'partner_internal_id' => $region['id'],
        );

        $ci->db->where('id', $orderId);
        $ci->db->update('shop_orders', $data);
    }

    private function recountProductivityHour($count, $id) {
        $ci = & get_instance();
        $data = array(
            'count' => $count - 1,
        );

        $ci->db->where('id', $id);
        $ci->db->update('mod_exchangeunfu_productivity', $data);
    }

    private function updateOrderHour($date, $hour, $id) {

        $ci = & get_instance();
        $data = array(
            'delivery_hour' => $hour,
            'delivery_date' => strtotime($date),
        );

        $ci->db->where('id', $id);
        $ci->db->update('shop_orders', $data);
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
            $this->error_log(lang('Incorrect password', 'exchangeunfu'), TRUE);
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
            $this->error_log(lang('Security error!!!', 'exchangeunfu'), TRUE);
            die(lang('Security error!!!', 'exchangeunfu'));
        }
    }

    /**
     * saves exchange files to tempDir
     * xml files will be saved to tempDir/
     * images wil be saved  to tempDir/images as jpg files
     */
    private function command_catalog_file() {
        if ($this->check_perm() === true) {
            $st = $this->input->get('filename');
            $st = basename($st);

            if (strrchr($st, "/"))
                $st = strrchr($st, "/");
            $ext = pathinfo($st, PATHINFO_EXTENSION);
            if ($ext == 'xml') {
                if (file_exists($this->tempDir . $this->input->get('filename')))
                    rename($this->tempDir . $this->input->get('filename'), $this->tempDir . $this->input->get('filename') . time());
                //saving xml files to cmlTemp
                if (write_file($this->tempDir . $this->input->get('filename'), file_get_contents('php://input'), FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
                    echo "success";
                } else {
                    echo 'Ошибка при сохранении файла';
                }
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

            $this->import = new \exchangeunfu\importXML();

            $this->import->import($this->tempDir . $this->input->get('filename'));
            //rename import xml file after import finished
            if (!$this->config['debug'])
                rename($this->tempDir . $this->input->get('filename'), $this->tempDir . "success_" . $this->input->get('filename'));
            //returns success status to 1c
            echo "success";
        }
        exit();
    }

    /**
     * render module additional region prices tab for products
     * @param array $data
     */
    public static function _extendPageAdmin($data) {

        $lang = new MY_Lang();
        $lang->load('exchangeunfu');
        $ci = &get_instance();
        if ($ci->uri->segment(6) == 'edit') {
            $array = $ci->db
                    ->where('product_id', $data['model']->getId())
                    ->join('mod_exchangeunfu_partners', 'mod_exchangeunfu_prices.partner_code=mod_exchangeunfu_partners.code')
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

        \CMSFactory\assetManager::create()
                ->appendData('moduleAdditions', $view);
    }

    /**
     * add product partner
     * @param array $data
     */
    public static function _addProductPartner($data) {
        $ci = &get_instance();

        $partners = $ci->input->post('partner');
        $prices = $ci->input->post('partner_price');
        $quantities = $ci->input->post('partner_quantity');
        $product = $ci->db->select('external_id')->where('id', $data['productId'])->get('shop_products')->row_array();

        foreach ($partners as $key => $partner_code) {
            if ($partner_code != 'false') {
                $partner_external_id = $ci->db->select('external_id')->where('code', $partner_code)->get('mod_exchangeunfu_partners')->row_array();

                $ci->db->insert('mod_exchangeunfu_prices', array(
                    'price' => $prices[$key],
                    'quantity' => $quantities[$key],
                    'product_id' => $data['productId'],
                    'partner_code' => $partner_code,
                    'partner_external_id' => $partner_external_id['external_id'],
                    'external_id' => md5($prices[$key] . $product['external_id'])
                ));
            }
        }
    }

    public function getRegionPeriod() {
        $regionId = $this->getDefaultRegionId();
        $periods = $this->db
                ->where('partner_id', $regionId)
                ->order_by("hour_from", "asc")
                ->get('mod_exchangeunfu_partners_periods')
                ->result_array();

        return $periods;
    }

    /**
     * update price for products region partners
     */
    public function updatePrice() {
        $price = $this->input->post('price');
        $quantity = $this->input->post('quantity');
        $product_external_id = $this->input->post('product_external_id');
        $partnercode = $this->input->post('partnercode');

        $this->db
                ->where('product_id', $product_external_id)
                ->where('partner_code', $partnercode)
                ->set('price', $price)
                ->set('quantity', $quantity)
                ->update('mod_exchangeunfu_prices');
    }

    public function deletePartner() {
        $product_external_id = $this->input->post('product_external_id');
        $partnercode = $this->input->post('partnercode');

        $this->db
                ->where('product_id', $product_external_id)
                ->where('partner_code', $partnercode)
                ->delete('mod_exchangeunfu_prices');
    }

    public function setHit() {
        $product_external_id = $this->input->post('product_external_id');
        $partnercode = $this->input->post('partnercode');
        $hit = $this->input->post('hit');

        $this->db
                ->where('product_id', $product_external_id)
                ->where('partner_code', $partnercode)
                ->set('hit', $hit)
                ->update('mod_exchangeunfu_prices');
    }

    public function setHot() {
        $product_external_id = $this->input->post('product_external_id');
        $partnercode = $this->input->post('partnercode');
        $hot = $this->input->post('hot');

        $this->db
                ->where('product_id', $product_external_id)
                ->where('partner_code', $partnercode)
                ->set('hot', $hot)
                ->update('mod_exchangeunfu_prices');
    }

    public function setAction() {
        $product_external_id = $this->input->post('product_external_id');
        $partnercode = $this->input->post('partnercode');
        $action = $this->input->post('action');

        $this->db
                ->where('product_id', $product_external_id)
                ->where('partner_code', $partnercode)
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
        $this->db->query('ALTER TABLE `shop_orders` ADD `delivery_hour` VARCHAR( 20 )');
        $this->db->query('ALTER TABLE `shop_orders` ADD `invoice_date` INT( 11 ) NOT NULL');
        $this->db->query('ALTER TABLE `shop_orders` ADD `partner_internal_id` INT( 11 ) NOT NULL');
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
            'product_id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'partner_code' => array(
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
            'hour_from' => array(
                'type' => 'INT',
                'constraint' => 4
            ),
            'hour_to' => array(
                'type' => 'INT',
                'constraint' => 4
            ),
            'partner_id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => 10
            ),
        );



        $this->dbforge->add_key('partner_id', TRUE);
        $this->dbforge->add_key('type', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_exchangeunfu_partners_periods', TRUE);

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
        $this->db->query('ALTER TABLE `shop_orders` DROP `partner_internal_id`');
        $this->db->query('ALTER TABLE `shop_category` DROP `code`');
        $this->db->query('ALTER TABLE `shop_products` DROP `code`');
        $this->db->query('ALTER TABLE `shop_products` DROP `measure`');
        $this->db->query('ALTER TABLE `shop_products` DROP `barcode`');

        $this->load->dbforge();
        $this->dbforge->drop_table('mod_exchangeunfu');
        $this->dbforge->drop_table('mod_exchangeunfu_productivity');
        $this->dbforge->drop_table('mod_exchangeunfu_partners');
        $this->dbforge->drop_table('mod_exchangeunfu_prices');
        $this->dbforge->drop_table('mod_exchangeunfu_partners_periods');
    }

    /**
     * Colect ids form model and return prices for current region
     * @param SProducts $model
     */
    public function getPriceForRegion($model) {
        $region = get_cookie('region');
        $external_ids = array();

        if (count($model) == 1) {
            // product
            if ($model->getId()) {
                $ids[] = $model->getId();
                $external_ids[$model->getExternalId()] = $model->getId();
            }
        } elseif (count($model) > 1) {
            // category/brand/search
            foreach ($model as $product) {
                if ($product->getId()) {
                    $ids[] = $product->getId();
                    $external_ids[$product->getExternalId()] = $product->getId();
                }
            }
        } else {
            // an empty model
            return false;
        }
        $regions = $this->db
                ->select('external_id')
                ->where('region', $region)
                ->get('mod_exchangeunfu_partners');

        if ($regions) {
            $regions = $regions->result_array();
        } else {
            $regions = array();
        }

        $partners_external_ids = array();
        foreach ($regions as $region) {
            $partners_external_ids[] = $region['external_id'];
        }

        $products_by_region = $this->db
                ->where_in('partner_external_id', $partners_external_ids)
                ->where_in('product_id', $ids)
                ->get('mod_exchangeunfu_prices');

        $region_prices = array();

        if ($products_by_region) {
            $products_by_region = $products_by_region->result_array();
        } else {
            $products_by_region = array();
        }

        foreach ($products_by_region->result_array() as $product) {
            $product_id = $product['product_id'];
            $price = $product['price'];
            $discount = $this->load->module('mod_discount/discount_api')
                    ->get_discount_product_api(array('id' => $product_id, 'vid' => null), null, $price);

            if ($discount) {
                if ((int) $region_prices[$product_id] - $discount < $price) {
                    $region_prices[$product_id] = $price - $discount['discount_value'];
                } else {
                    $region_prices[$product_id] = $price - $discount['discount_value'];
                }
            } else {
                if ((int) $region_prices[$product_id] < $price) {
                    $region_prices[$product_id] = $price;
                } else {
                    if (!$region_prices[$product_id]) {
                        $region_prices[$product_id] = $price;
                    }
                }
            }
        }

        if ($region_prices) {
            return $region_prices;
        } else {
            return 0;
        }
    }

    /**
     * get regions names 
     * @return array
     */
    public function getRegions() {

        $regions = $this->db
                ->select(array('region', 'id'))
                ->get('mod_exchangeunfu_partners');

        if ($regions) {
            return $regions->result_array();
        } else {
            return $regions = array();
        }
    }

    public function getDefaultRegion() {
        $ci = & get_instance();

        if (isset($_COOKIE['region']) AND !empty($_COOKIE['region']) AND $ci->dx_auth->is_admin()) {
            $region = $ci->db
                            ->where('id', $_COOKIE['region'])
                            ->select(array('region'))
                            ->get('mod_exchangeunfu_partners')->result_array();

            if (count($region))
                return $region[0]['region'];
            else {
                $region = $ci->db
                                ->limit(1)
                                ->select(array('region'))
                                ->get('mod_exchangeunfu_partners')->result_array();
                return $region[0]['region'];
            }
        } else {
            $region = $ci->db
                            ->limit(1)
                            ->select(array('region'))
                            ->get('mod_exchangeunfu_partners')->result_array();
            return $region[0]['region'];
        }
    }

    public function getDefaultRegionId() {
        $ci = & get_instance();
        if (isset($_COOKIE['region']) AND !empty($_COOKIE['region']) AND $ci->dx_auth->is_admin() ) {

            return $_COOKIE['region'];
        } else {
            $region = $ci->db
                    ->limit(1)
                    ->select(array('id'))
                    ->get('mod_exchangeunfu_partners')
                    ->row();

            return $region->id;
        }
    }

    public function getDefaultRegionExternalId() {
 $ci = & get_instance();
        if (isset($_COOKIE['region']) AND !empty($_COOKIE['region']) AND $ci->dx_auth->is_admin() ) {
            $region = $this->db->limit(1)->select(array('external_id'))->where('id', $_COOKIE['region'])->get('mod_exchangeunfu_partners')->result_array();

     if(count($region) > 0)             
            return $region[0]['external_id'];
        else {
             $region = $this->db
                            ->limit(1)
                            ->select(array('external_id'))
                            ->get('mod_exchangeunfu_partners')->result_array();
            return $region[0]['external_id'];
        }
        } else {
            $region = $this->db
                            ->limit(1)
                            ->select(array('external_id'))
                            ->get('mod_exchangeunfu_partners')->result_array();
            return $region[0]['external_id'];
        }
    }

    public function getDefaultRegionIds() {

        $ci = & get_instance();
        $defID = self::getDefaultRegionId();
        if (isset($_COOKIE['region']) AND !empty($_COOKIE['region']) AND $ci->dx_auth->is_admin()) {
            $region = $ci->db
                    ->limit(1)
                    ->where('id = ', $_COOKIE['region'])
                    ->select(array('id', 'external_id'))
                    ->get('mod_exchangeunfu_partners')
                    ->result_array();
        } else {
            $region = $ci->db
                    ->limit(1)
                    ->where('id = ', $defID)
                    ->select(array('id', 'external_id'))
                    ->get('mod_exchangeunfu_partners')
                    ->result_array();
        }
        return $region['0'];
    }

    public function getCountPeriodOrders($hfrom, $hto, $date = null) {
        if (!$date)
            $date = mktime(0, 0, 0, date("m"), date("d"), date("Y"));

        $regionId = $this->getDefaultRegionId();
        $count = $this->db
                ->select_sum('count')
                ->join('mod_exchangeunfu_partners', 'mod_exchangeunfu_partners.external_id = mod_exchangeunfu_productivity.partner_external_id', 'left')
                ->where('date =', $date)
                ->where('hour >=', $hfrom)
                ->where('hour <', $hto)
                ->where('mod_exchangeunfu_partners.id', $regionId)
                ->get('mod_exchangeunfu_productivity')
                ->result();

        return $count;
    }

    public function getCountHours($hour, $date) {
        if (!$date)
            die('date is undefined');
        $date = strtotime($date);
        $ci = get_instance();


        $defaultRegionId = self::getDefaultRegionId();

        $count = $ci->db
                ->select(array('mod_exchangeunfu_productivity.id', 'mod_exchangeunfu_productivity.count'))
                ->join('mod_exchangeunfu_partners', 'mod_exchangeunfu_partners.external_id = mod_exchangeunfu_productivity.partner_external_id', 'left')
                ->where('date =', $date)
                ->where('hour =', $hour)
                ->where('mod_exchangeunfu_partners.id', $defaultRegionId)
                ->get('mod_exchangeunfu_productivity')
                ->result();


        return $count;
    }

    public function getCountPeriodOrdersApi($date = '2013-10-10') {
        $date = strtotime($date . ' 00:00:00');
        $periods = $this->getRegionPeriod();
        $regionId = $this->getDefaultRegionId();



        foreach ($periods as $key => $period) {
            $c = $this->db
                    ->select_sum('count')
                    ->join('mod_exchangeunfu_partners', 'mod_exchangeunfu_partners.external_id = mod_exchangeunfu_productivity.partner_external_id', 'left')
                    ->where('date =', $date)
                    ->where('hour >=', $period['hour_from'])
                    ->where('hour <', $period['hour_to'])
                    ->where('mod_exchangeunfu_partners.id', $regionId)
                    ->get('mod_exchangeunfu_productivity')
                    ->result();



            if ($c[0]->count)
                $count[] = true;
            else
                $count[] = false;;
        }
        return json_encode($count);
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
            $this->export = new \exchangeunfu\exportXML();
            if ($this->input->get('partner')) {
                $parter = $this->db->where('code', $this->input->get('partner'))->get('mod_exchangeunfu_partners');
                if ($parter) {
                    $parter = $parter->row_array();

                    if ($this->input->get('full') != 'full') {
                        $this->export->export($parter['external_id'], $parter['send_cat'], $parter['send_prod'], $parter['send_users']);
                    } else {
                        $this->export->export($parter['external_id'], 1, 1, 1, true);
                    }
                }
            } else {
                $this->export->export();
            }
        }

        exit();
    }

    /**
     * runs when orders from site succesfully uploaded to 1c server
     * and sets some status for imported orders "waiting" for example
     */
     private function command_sale_success() {
        if ($this->check_perm() === true) {
            if ($this->input->get('partner')) {
                $partner = $this->db->where('code', $this->input->get('partner'))->get('mod_exchangeunfu_partners');
                if ($partner) {
                    $partner = $partner->row_array();
                    $this->db
                            ->where('external_id', $partner['external_id'])
                            ->set('send_cat', 0)
                            ->set('send_users', 0)
                            ->set('send_prod', 0)
                            ->update('mod_exchangeunfu_partners');
                    
                    $model = $this->db
                            ->where('partner_internal_id', $partner['id'])
                            ->where_in('status', $this->config['userstatuses'])
                            ->get('shop_orders')
                            ->result_array();
                }
            }

            foreach ($model as $order) {
                $this->db
                        ->where('id',$order['id'])
                        ->set('status',$this->config['userstatuses_after'])
                        ->update('shop_orders');
            }
            echo "success";
        }
        exit();
    }

    /**
     * Use this function to make backup before import starts
     */
    protected function makeDBBackup() {
        if (is_really_writable('./application/backups')) {
            \libraries\Backup::create()->createBackup("zip", "exchange");
        } else {
            $this->error_log(lang('Can not create a database snapshot, check the folder', 'exchange') . ' /application/backups ' . lang('on writing possibility', 'exchange'));
        }
    }

}

/* End of file exchangeunfu.php */