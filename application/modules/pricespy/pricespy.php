<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс слежения за ценой
 */
class Pricespy extends MY_Controller {

    public $product;

    public function __construct() {
        parent::__construct();
        $this->load->module('core');

        $this->settings = $this->db
                ->select('settings')
                ->where('identif', 'socauth')
                ->get('components')
                ->row_array();
        $this->settings = unserialize($this->settings[settings]);
    }

    public function sendPassByEmail($email, $pass) {
        $this->load->library('email');

        $this->email->from("noreplay@$_SERVER[HTTP_HOST]");
        $this->email->to($email);
        $this->email->subject('Password');
        $this->email->message("Ваш пароль для входа на сайт $_SERVER[HTTP_HOST] - $pass");
        $this->email->send();
    }

    public static function adminAutoload() {
        parent::adminAutoload();

        \CMSFactory\Events::create()
                ->onShopProductUpdate()
                ->setListener('priceUpdate');
    }

    public function index() {
        $data = array(
            'varId' => 231,
            'Id' => 124
        );

        \CMSFactory\assetManager::create()
                ->registerScript('spy')
                ->setData($data)
                ->render('button');
    }

    public function priceUpdate($product) {
        if (!$product)
            return;
        $CI = &get_instance();

        $spys = $CI->db
                ->from('mod_price_spy')
                ->join('shop_product_variants', 'mod_price_spy.productVariantId=shop_product_variants.id')
                ->join('users', 'mod_price_spy.userId=users.id')
                ->where('mod_price_spy.productId', $product[productId])
                ->get()
                ->result();

        foreach ($spys as $spy) {
            if ($spy->price != $spy->productPrice) {

                $CI->db->set('productPrice', $spy->price);
                $CI->db->where('productVariantId', $spy->productVariantId);
                $CI->db->update('mod_price_spy');
            }
        }
    }

    public function spy($id, $varId) {
        $product = $this->db
                ->where('id', $varId)
                ->get('shop_product_variants')
                ->row();

        $this->db
                ->set('userId', $this->dx_auth->get_user_id())
                ->set('productId', $id)
                ->set('productVariantId', $varId)
                ->set('productPrice', $product->price)
                ->set('oldProductPrice', $product->price)
                ->set('hash', random_string('numeric', 10))
                ->insert('mod_price_spy');
        
        echo json_encode(array(
            'answer' => 'sucesfull',
        ));
    }

    public function unSpy($hash) {
        $this->db->delete('mod_price_spy', array('hash' => $hash));
    }

    public function renderButton($id) {
        $product = $this->db
                ->where('productVariantId', $id)
                ->where('userId', $this->dx_auth->get_user_id())
                ->get('mod_price_spy')
                ->row();

        if (count($product) == 0)
            \CMSFactory\assetManager::create()
                    ->registerScript('spy')
                    ->setData('varId', $id)
                    ->render('button');
        else
            \CMSFactory\assetManager::create()
                    ->registerScript('spy')
                    ->setData('varId', $id)
                    ->render('button');
    }

    public function renderUserSpys() {
        $products = $this->db
                ->where('userId', $this->dx_auth->get_user_id())
                ->get('mod_price_spy')
                ->result_array();

        \CMSFactory\assetManager::create()
                ->registerScript('spy')
                ->setData('products', $products)
                ->render('spys');
    }

    public function _install() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE),
            'userId' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => TRUE),
            'productId' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => TRUE),
            'productVariantId' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => TRUE),
            'productPrice' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => TRUE),
            'oldProductPrice' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => TRUE),
            'hash' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => TRUE)
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_price_spy');

        $this->db->where('name', 'pricespy');
        $this->db->update('components', array(
            'enabled' => 1,
            'autoload' => 1));
    }

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('mod_price_spy');
    }

}

/* End of file pricespy.php */