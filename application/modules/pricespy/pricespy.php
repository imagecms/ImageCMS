<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс слежения за ценой
 * @property pricespy_model $pricespy_model
 */
class Pricespy extends MY_Controller {

    public $product;
    public $isInSpy;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('pricespy');
        $this->load->module('core');
        $this->load->model('pricespy_model');
    }

    /**
     * send email to user
     * @param type $email
     * @param type $name
     * @param type $hash
     */
    private static function sendNotificationByEmail($email, $name, $hash) {
        
        /*
         * use module cms email
         * you need create new letter 'pricespy' in database "admin/components/cp/cmsemail/index" with next variables and other information 
         */
        /*
        // variables
        //
        $data = array(
            'name' => $name,
            'server' => $_SERVER[HTTP_HOST],
            'list_url_look' => site_url('pricespy'),
            'delete_url_list_look' => site_url("pricespy/$hash")
        );
        // comand for send letter use module cms email
        \cmsemail\email::getInstance()->sendEmail($email, 'pricespy', $data);
        */
        
        $CI = &get_instance();
        $CI->load->library('email');

        $CI->email->from("noreplay@$_SERVER[HTTP_HOST]");
        $CI->email->to($email);
        $CI->email->set_mailtype('html');
        $CI->email->subject(lang('Price changing', 'pricespy'));
        $CI->email->message(lang('Price on', 'pricespy') . $name . lang('for which you watch on site', 'pricespy') . $_SERVER[HTTP_HOST] .  lang('changed', 'pricespy') . ".<br>
                <a href='" . site_url('pricespy') . "' title='" . lang('View watch list', 'pricespy') . "'>" . lang('View watch list', 'pricespy') . "</a><br>
                <a href='" . site_url("pricespy/$hash") . "' title='" . lang('Unsubscribe tracking', 'pricespy') . "'>" . lang('Unsubscribe tracking', 'pricespy') . "</a><br>");
        $CI->email->send();
    }

    public static function adminAutoload() {
        parent::adminAutoload();

        \CMSFactory\Events::create()->onShopProductUpdate()->setListener('priceUpdate');
        \CMSFactory\Events::create()->onShopProductDelete()->setListener('priceDelete');
    }

    /**
     *
     */
    public function index() {
        if ($this->dx_auth->is_logged_in()) {
            \CMSFactory\assetManager::create()
                    ->registerScript('spy');
            $this->renderUserSpys();
        }
        else
            $this->core->error_404();
    }

    /**
     * deleting from spy if product deleted
     * @param type $product
     */
    public function priceDelete($product) {
        if (!$product)
            return;

        $CI = &get_instance();

        $product = $product[model];
        $ids = array();
        foreach ($product as $key => $p)
            $ids[$key] = $p->id;

        $CI->db->where_in('productId', $ids);
        $CI->db->delete('mod_price_spy');
    }

    /**
     * updating price
     * @param type $product
     */
    public function priceUpdate($product) {
        if (!$product)
            return;

        $CI = &get_instance();
        $spys = $CI->db
                ->from('mod_price_spy')
                ->join('shop_product_variants', 'mod_price_spy.productVariantId=shop_product_variants.id')
                ->join('users', 'mod_price_spy.userId=users.id')
                ->join('shop_products_i18n', 'shop_products_i18n.id=mod_price_spy.productId')
                ->where('mod_price_spy.productId', $product[productId])
                ->get()
                ->result();

        foreach ($spys as $spy) {
            if ($spy->price != $spy->productPrice) {

                $CI->db->set('productPrice', $spy->price);
                $CI->db->where('productVariantId', $spy->productVariantId);
                $CI->db->update('mod_price_spy');

                if ($spy->price < $spy->productPrice)
                    self::sendNotificationByEmail($spy->email, $spy->name, $spy->hash);
            }
        }
    }

    /**
     * set spy for product
     * @param type $id product ID
     * @param type $varId variant ID
     */
    public function spy($id, $varId) {
        $product = $this->pricespy_model->getProductById($varId);

        if ($this->pricespy_model->setSpy($id, $varId, $product->price))
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
    }

    /**
     *
     * @param type $hash
     */
    public function unSpy($hash) {
        if ($this->pricespy_model->delSpyByHash($hash))
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
    }

    public function init($model) {
        if ($this->dx_auth->is_logged_in()) {
            if (!$model instanceof SProducts) {
                foreach ($model as $key => $m) {
                    $id[$key] = $m->getid();
                    $varId[$key] = $m->firstVariant->getid();
                }
            } else {
                $id = $model->getid();
                $varId = $model->firstVariant->getid();
            }

            $products = $this->db
                    ->where_in('productVariantId', $varId)
                    ->where('userId', $this->dx_auth->get_user_id())
                    ->get('mod_price_spy')
                    ->result_array();

            foreach ($products as $p)
                $this->isInSpy[$p[productVariantId]] = $p;

            \CMSFactory\assetManager::create()
                    ->registerScript('spy');
        }
    }

    /**
     * render spy buttons
     * @param type $id product ID
     * @param type $varId variant ID
     */
    public function renderButton($id, $varId) {
        if ($this->dx_auth->is_logged_in()) {

            $data = array(
                'Id' => $id,
                'varId' => $varId,
            );

            if ($this->isInSpy[$varId] == '')
                \CMSFactory\assetManager::create()
                        ->setData('data', $data)
                        ->setData('value', lang('Notify about price cut', 'pricespy'))
                        ->setData('class', 'btn')
                        ->render('button', true);
            else
                \CMSFactory\assetManager::create()
                        ->setData('data', $data)
                        ->setData('value', lang('Already in tracking', 'pricespy'))
                        ->setData('class', 'btn inSpy')
                        ->render('button', true);
        }
    }

    /**
     * render spys for user
     */
    private function renderUserSpys() {
        $products = $this->db
                ->where('userId', $this->dx_auth->get_user_id())
                ->join('shop_product_variants', 'shop_product_variants.id=mod_price_spy.productVariantId')
                ->join('shop_products_i18n', 'shop_products_i18n.id=mod_price_spy.productId')
                ->join('shop_products', 'shop_products.id=mod_price_spy.productId')
                ->get('mod_price_spy')
                ->result_array();

        \CMSFactory\assetManager::create()
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