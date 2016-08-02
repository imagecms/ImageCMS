<?php

use cmsemail\email;
use CMSFactory\assetManager;
use CMSFactory\Events;
use Propel\Runtime\Collection\ObjectCollection;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 *
 * Вывоз метода на товаре {module('pricespy')->init($model)->renderButton($model->getId() , $variant->getId())}
 *
 *
 * Класс слежения за ценой
 * @property pricespy_model $pricespy_model
 */
class Pricespy extends MY_Controller
{

    public $product;

    public $isInSpy;

    public function __construct() {
        parent::__construct();
        $this->load->module('core');
        $this->load->model('pricespy_model');
        $lang = new MY_Lang();
        $lang->load('pricespy');
    }

    /**
     * send email to user
     * @param $spy
     * @return bool
     */
    private static function sendNotificationByEmail($spy) {

        $data = [
                 'hash'        => $spy->hash,
                 'productName' => $spy->name,
                 'userName'    => $spy->username,
                 'siteUrl'     => site_url('/'),
                 'linkModule'  => site_url('/pricespy/'),
                 'unlinkSpy'   => site_url('/pricespy/unspy/'. $spy->hash),
                ];

        return email::getInstance()->sendEmail($spy->email, 'pricespy', $data);
    }

    public static function adminAutoload() {
        parent::adminAutoload();

        Events::create()->onShopProductUpdate()->setListener('priceUpdate');
        Events::create()->onShopProductDelete()->setListener('priceDelete');
    }

    /**
     *
     */
    public function index() {
        if ($this->dx_auth->is_logged_in()) {
            assetManager::create()
                    ->registerScript('spy');
            $this->renderUserSpys();
        } else {
            $this->core->error_404();
        }
    }

    /**
     * deleting from spy if product deleted
     * @param array $product
     */
    public static function priceDelete($product) {
        if (!$product) {
            return;
        }

        $CI = &get_instance();

        $product = $product['model'];
        $ids = [];
        foreach ($product as $key => $p) {
            $ids[$key] = $p->id;
        }

        $CI->db->where_in('productId', $ids);
        $CI->db->delete('mod_price_spy');
    }

    /**
     * updating price
     * @param array $product
     */
    public static function priceUpdate($product) {

        if (!$product) {
            return;
        }

        $CI = &get_instance();

        /** @var CI_DB_result $spys */
        $spys = $CI->db
            ->from('mod_price_spy')
            ->join('shop_product_variants', 'mod_price_spy.productVariantId=shop_product_variants.id')
            ->join('users', 'mod_price_spy.userId=users.id')
            ->join('shop_products_i18n', 'shop_products_i18n.id=mod_price_spy.productId')
            ->where('mod_price_spy.productId', $product['productId'])
            ->get();

        if ($spys->num_rows() > 0) {

            $spys = $spys->result();

            foreach ($spys as $spy) {

                if ($spy->price != $spy->productPrice && $spy->price < $spy->productPrice) {

                    $CI->db->set('productPrice', $spy->price);
                    $CI->db->where('productVariantId', $spy->productVariantId);
                    $CI->db->update('mod_price_spy');

                    self::sendNotificationByEmail($spy);
                }
            }
        }

    }

    /**
     * set spy for product
     * @param int $id product ID
     * @param int $varId variant ID
     */
    public function spy($id, $varId) {

        $product = SProductVariantsQuery::create()
            ->findPk($varId);

        if ($this->pricespy_model->setSpy($id, $varId, $product->getPrice())) {
            echo json_encode(
                ['answer' => 'sucesfull']
            );
        } else {
            echo json_encode(
                ['answer' => 'error']
            );
        }
    }

    /**
     *
     * @param string $hash
     */
    public function unSpy($hash) {
        if ($this->pricespy_model->delSpyByHash($hash)) {
            echo json_encode(
                ['answer' => 'sucesfull']
            );
        } else {
            echo json_encode(
                ['answer' => 'error']
            );
        }
    }

    /**
     * @param SProducts $model
     * @return $this|bool
     */
    public function init($model) {

        if ($this->dx_auth->is_logged_in()) {

            if (!$model instanceof SProducts) {
                return false;
            }

            $this->setAllVariantModel($model->getProductVariants());

            assetManager::create()
                ->registerScript('spy');

            return $this;
        }
    }

    /**
     * @param ObjectCollection $model
     * @return void
     */
    private function setAllVariantModel(ObjectCollection $model) {

        if ($model->count() > 0) {
            /** @var SProductVariants $item */
            foreach ($model as $item) {

                $this->checkVariants($item->getId());

            }
        }

    }

    /**
     * @param int $variant_id
     * @return void
     */
    private function checkVariants($variant_id) {

        /** @var CI_DB_result $products */
        $products = $this->db
            ->where_in('productVariantId', $variant_id)
            ->where('userId', $this->dx_auth->get_user_id())
            ->get('mod_price_spy');

        if ($products->num_rows() > 0) {

            $products = $products->result_array();
            $this->setIsInSpy($products);

        }

    }

    /**
     * @param array $products
     * @return void
     */
    private function setIsInSpy(array $products) {

        foreach ($products as $product) {

            $this->isInSpy[$product['productVariantId']] = $product;
        }

    }

    /**
     * render spy buttons
     * @param int $id product ID
     * @param int $varId variant ID
     */
    public function renderButton($id, $varId) {
        if ($this->dx_auth->is_logged_in()) {

            $data = [
                     'Id'    => $id,
                     'varId' => $varId,
                    ];

            if ($this->isInSpy[$varId] == '') {
                assetManager::create()
                        ->setData('data', $data)
                        ->setData('value', lang('Notify about price cut', 'pricespy'))
                        ->setData('class', 'btn btn-info')
                        ->render('button', true);
            } else {
                assetManager::create()
                        ->setData('data', $data)
                        ->setData('value', lang('Already in tracking', 'pricespy'))
                        ->setData('class', 'btn inSpy btn-success')
                        ->render('button', true);
            }
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

        assetManager::create()
                ->setData('products', $products)
                ->render('spys');
    }

    public function _install() {
        $pattern = $this->pricespy_model->getEmailPattern();

        $this->db->insert('mod_email_paterns', $pattern);

        $pattern_i18n = $this->pricespy_model->getEmailPatternI18n();

        $this->db->insert('mod_email_paterns_i18n', $pattern_i18n);

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $fields = [
                   'id'               => [
                                          'type'           => 'INT',
                                          'auto_increment' => TRUE,
                                         ],
                   'userId'           => [
                                          'type'       => 'VARCHAR',
                                          'constraint' => '30',
                                          'null'       => TRUE,
                                         ],
                   'productId'        => [
                                          'type'       => 'VARCHAR',
                                          'constraint' => '30',
                                          'null'       => TRUE,
                                         ],
                   'productVariantId' => [
                                          'type'       => 'VARCHAR',
                                          'constraint' => '30',
                                          'null'       => TRUE,
                                         ],
                   'productPrice'     => [
                                          'type'       => 'VARCHAR',
                                          'constraint' => '30',
                                          'null'       => TRUE,
                                         ],
                   'oldProductPrice'  => [
                                          'type'       => 'VARCHAR',
                                          'constraint' => '30',
                                          'null'       => TRUE,
                                         ],
                   'hash'             => [
                                          'type'       => 'VARCHAR',
                                          'constraint' => '30',
                                          'null'       => TRUE,
                                         ],
                  ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_price_spy');

        $this->db->where('name', 'pricespy');
        $this->db->update(
            'components',
            [
             'enabled'  => 1,
             'autoload' => 1,
            ]
        );
    }

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('mod_price_spy');
    }

}

/* End of file pricespy.php */