<?php

use Category\CategoryApi;
use CMSFactory\assetManager;
use CMSFactory\Events;
use Currency\Currency;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module ymarket
 * @property Ymarket_model $ymarket_model
 * @property Ymarket_products_fields_model ymarket_products_fields_model
 */
class Ymarket extends ShopController
{

    const DEFAULT_TYPE = 1;
    const PRICE_UA_TYPE = 2;
    const NADAVI_UA_TYPE = 3;

    protected $offers = [];

    protected $categories = [];

    protected $brandIds = [];

    protected $mainCurr = [];

    protected $currencies;

    protected $currencyCode;

    protected $settings;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('ymarket');
        $this->load->model('ymarket_model');
        $this->load->model('ymarket_products_fields_model');
    }

    /**
     *
     * @param boolean $ignoreSettings
     * @param integer $type
     */
    private function init($ignoreSettings = false, $type) {
        if ($ignoreSettings) {
            $this->categories = CategoryApi::getInstance()->getCategory();
            $this->brandIds = [];
        } else {
            $this->settings = $this->ymarket_model->init($type);
            $this->categories = CategoryApi::getInstance()->getCategory($this->settings['unserCats']);
            $this->brandIds = $this->settings['unserBrands'];
        }
    }

    /**
     * Generates an array of data to create a body xml
     *
     * @param boolean $ignoreSettings
     * @param integer $type
     */
    public function index($ignoreSettings = false, $type = self::DEFAULT_TYPE) {
        $this->init($ignoreSettings, $type);
        switch ($type) {
            case self::DEFAULT_TYPE:
                $this->ymarketCore();
                break;
            case self::PRICE_UA_TYPE:
                $this->priceuaCore();
                break;
            case self::NADAVI_UA_TYPE:
                $this->priceuaCore();
                break;
        }
    }

    /**
     *
     * @param boolean $ignoreSettings
     */
    private function ymarketCore($ignoreSettings = false) {
        $ci = ShopCore::$ci;

        $productFields = $this->ymarket_products_fields_model->getProductsFields();

        $offers = $this->ymarket_model->formOffers($ignoreSettings, $productFields);

        list($currencies, $mainCurr) = $this->ymarket_model->makeCurrency();

        $infoXml = [];
        $infoXml['categories'] = $this->categories;
        $infoXml['offers'] = $offers;
        $infoXml['site_short_title'] = $this->settings['site_short_title'];
        $infoXml['site_title'] = $this->settings['site_title'];
        $infoXml['base_url'] = $ci->config->item('base_url');
        $infoXml['imagecms_number'] = IMAGECMS_NUMBER;
        $infoXml['siteinfo_adminemail'] = siteinfo('siteinfo_adminemail');
        $infoXml['currencyCode'] = $currencies;
        $infoXml['mainCurr'] = $mainCurr;

        assetManager::create()
                ->setData('full', $ignoreSettings)
                ->setData('infoXml', $infoXml)
                ->render('yandex', true);
    }

    public function all() {
        $this->index(true);
    }

    /**
     * autoload
     */
    public function autoload() {

    }

    public static function adminAutoload() {
        Events::create()
                ->onShopProductPreUpdate()
                ->setListener('_extendYmarketPageAdmin');

        Events::create()
                ->onShopProductUpdate()
                ->setListener('_extendYmarketPageAdmin');
    }

    /**
     * Extend products admin page
     * @param array $data
     */
    public static function _extendYmarketPageAdmin($data) {
        $ci = &get_instance();
        $lang = new MY_Lang();
        $lang->load('ymarket');
        include_once 'models/ymarket_products_fields_model.php';
        $model = new Ymarket_products_fields_model();
        $countries = include_once 'config/countries.php';
        $months = [1, 2, 3, 6, 9, 12, 18, 24, 30, 36, 42, 48];
        if ($ci->input->post()) {
            $post = $ci->input->post('ymarket');
            if ($data['model']) {
                $productId = $data['model']->getId();
                $dataFields = [
                    'country_of_origin' => $post['country_of_origin'] ? $post['country_of_origin'] : null,
                    'manufacturer_warranty' => $post['manufacturer_warranty']['exist'] ? self::toISO8601Time($post['manufacturer_warranty']['time']) : 'false',
                    'seller_warranty' => $post['seller_warranty']['exist'] ? self::toISO8601Time($post['seller_warranty']['time']) : 'false',
                ];
                $model->setFields($productId, $dataFields);
            }
        } else {
            $productId = $data['model']->getId();
            $fields = $model->getFields($productId);
            $fields['manufacturer_warranty'] = self::fromISO8601ToMonths($fields['manufacturer_warranty']);
            $fields['seller_warranty'] = self::fromISO8601ToMonths($fields['seller_warranty']);
            $view = assetManager::create()
                    ->setData(
                        [
                                'countries' => $countries,
                                'months' => $months,
                                'fields' => $fields,
                            ]
                    )
                    ->registerScript('script')
                    ->fetchAdminTemplate('products_extend');
            assetManager::create()
                    ->appendData('moduleAdditions', $view);
        }
    }

    /**
     *
     * @param integer|float $months
     * @return string
     */
    public static function toISO8601Time($months) {
        if (!$months) {
            return 'true';
        }
        $years = (int) ($months / 12);
        $months = $months % 12;
        $time = 'P';
        $time .= $years ? $years . 'Y' : '';
        $time .= $months ? $months . 'M' : '';
        return $time;
    }

    /**
     *
     * @param string $iso
     * @return string
     */
    public static function fromISO8601ToMonths($iso) {
        if (in_array($iso, ['true', 'false'])) {
            return $iso;
        }
        preg_match('/([\d])+Y/', $iso, $matches_years);
        $years = $matches_years[1] ? (int) $matches_years[1] : 0;
        preg_match('/([\d])+M/', $iso, $matches_months);
        $months = $matches_months[1] ? (int) $matches_months[1] : 0;
        $months = $years * 12 + $months;
        return $months;
    }

    /**
     * Install
     */
    public function _install() {
        $this->load->dbforge();
        $fields = [
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE],
            'categories' => ['type' => 'TEXT'],
            'brands' => ['type' => 'TEXT'],
            'adult' => ['type' => 'VARCHAR', 'constraint' => 100]
        ];
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_ymarket', TRUE);

        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'country_of_origin' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'manufacturer_warranty' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'default' => 'false',
            ],
            'seller_warranty' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'default' => 'false',
            ],
        ];
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table(Ymarket_products_fields_model::TABLE, TRUE);

        $this->db->where('name', 'ymarket')
            ->update('components', ['enabled' => '1', 'autoload' => '1']);

        $this->db->insert('mod_ymarket', ['categories' => '', 'adult' => '']);
    }

    /**
     * Deinstall
     */
    public function _deinstall() {
        $this->load->dbforge();
        $this->dbforge->drop_table('mod_ymarket');
    }

}

/* End of file sample_module.php */