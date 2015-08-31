<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module ymarket
 * @property Ymarket_model $ymarket_model
 */
class Ymarket extends ShopController {

    protected $offers = [];

    protected $categories = [];

    protected $mainCurr = [];

    protected $currencies;

    protected $currencyCode;

    protected $settings;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('ymarket');
        $this->load->model('ymarket_model');
    }

    /**
     * Price.ua & Nadavi.net
     */
    public function priceua() {
        $this->index(false, true);
    }

    /**
     * Generates an array of data to create a body xml
     */
    public function index($ignoreSettings = false, $flagPriceUa = false) {
        if ($flagPriceUa) {
            $this->priceuaCore($ignoreSettings);
        } else {
            $this->ymarketCore($ignoreSettings);
        }

    }

    private function priceuaCore($ignoreSettings = false) {
        $ci = ShopCore::$ci;

        $this->settings = $this->ymarket_model->initPriceUa();
        $currencies = \Currency\Currency::create()->getMainCurrency();
        $this->mainCurr['id'] = $currencies->getId();
        $this->mainCurr['rate'] = number_format($currencies->getRate(), 3);
        $this->mainCurr['code'] = $currencies->getCode();

        if ($ignoreSettings) {
            $categories = \Category\CategoryApi::getInstance()->getCategory();
            $brandIds = [];
        } else {
            $categories = \Category\CategoryApi::getInstance()->getCategory($this->settings['unserCats']);
            $brandIds = $this->settings['unserBrands'];
        }

        /* @var $p SProducts */
        foreach ($this->ymarket_model->getProducts($this->settings['unserCats'], $ignoreSettings, $brandIds) as $p) {
            /* @var $v SProductVariants */
            $criteria = new \Propel\Runtime\ActiveQuery\Criteria();
            if (!$ignoreSettings) {
                $criteria->add('Stock', 0, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN);
            }

            foreach ($p->getProductVariants($criteria) as $v) {
                if (!$v->getPrice()) {
                    continue;
                }

                $unique_id = $v->getId();
                $this->offers[$unique_id]['url'] = shop_url('product/' . $p->getUrl()); //++++
                $this->offers[$unique_id]['price'] = \Currency\Currency::create()->convertToMain($v->getPriceInMain(), $v->getCurrency());
                $this->offers[$unique_id]['categoryId'] = $p->getCategoryId();
                $this->offers[$unique_id]['vendor'] = $p->getBrand() ? htmlspecialchars($p->getBrand()->getName()) : '';
                $this->offers[$unique_id]['picture'] = $v->getMainImage() ? [productImageUrl('products/main/' . $v->getMainImage())] : []; //++++
                $this->offers[$unique_id]['name'] = $this->forName($p->getName(), $v->getName()); //++++
                $this->offers[$unique_id]['description'] = htmlspecialchars($p->getFullDescription());
            }
        }
        $infoXml['categories'] = $categories;
        $infoXml['offers'] = $this->offers;
        $infoXml['site_title'] = $this->settings['site_title'];
        $infoXml['base_url'] = $ci->config->item('base_url');
        $infoXml['mainCurr'] = $this->mainCurr;

        \CMSFactory\assetManager::create()
                ->setData('full', $ignoreSettings)
                ->setData('infoXml', $infoXml)
                ->render('priceua', true);
    }

    private function ymarketCore() {
        $ci = ShopCore::$ci;

        $this->settings = $this->ymarket_model->init();
        $currencies = \Currency\Currency::create()->getCurrencies();

        $checkRUB = false;
        foreach ($currencies as $value) {
            $isoNEW = $value->getCode() == 'RUB' ? 'RUR' : $value->getCode();
            $rates[$isoNEW]['rate'] = $value->getRate();
            $rates[$isoNEW]['main'] = $value->getMain();
            if ($isoNEW == 'RUR') {
                $checkRUB = true;
                break;
            }
        }

        //Перегонка рейтов чтобы главным был рубль
        if (isset($rates['RUR'])) {
            if (!$rates['RUR']['main'] && (int) $rates['RUR']['rate'] != 1) {
                foreach ($rates as $iso => $data) {
                    //Перегонка
                    $rurRate = $rates['RUR']['rate'];
                    if ($iso != 'RUR') {
                        $rates[$iso]['rate'] = $rurRate / $data['rate'];
                    }
                }
                $rates['RUR']['rate'] = 1;
            }
        }

        foreach ($currencies as $value) {
            if ($checkRUB) {
                if ($value->getCode() == 'RUR' || $value->getCode() == 'RUB') {
                    $this->mainCurr['code'] = 'RUR';
                    $rate = $rates['RUR']['rate'] ? $rates['RUR']['rate'] : 1 / $value->getRate();
                    $this->mainCurr['rate'] = number_format($rate, 3);
                } else {
                    $this->currencies[$value->getId()]['code'] = $value->getCode();
                    $rate = $rates[$value->getCode()]['rate'] ? $rates[$value->getCode()]['rate'] : 1 / $value->getRate();
                    $this->currencies[$value->getId()]['rate'] = number_format($rate, 3);
                }
            } else {
                if ($value->getMain()) {
                    $this->mainCurr['code'] = $value->getCode() == 'RUB' ? 'RUR' : $value->getCode();
                    $rate = $rates[$this->mainCurr['code']]['rate'] ? $rates[$this->mainCurr['code']]['rate'] : 1 / $value->getRate();
                    $this->mainCurr['rate'] = number_format($rate, 3);
                } else {
                    $this->currencies[$value->getId()]['code'] = $value->getCode();
                    $rate = $rates[$value->getCode()]['rate'] ? $rates[$value->getCode()]['rate'] : 1 / $value->getRate();
                    $this->currencies[$value->getId()]['rate'] = number_format($rate, 3);
                }
            }
        }

        if ($ignoreSettings) {
            $categories = \Category\CategoryApi::getInstance()->getCategory();
            $brandIds = [];
        } else {
            $categories = \Category\CategoryApi::getInstance()->getCategory($this->settings['unserCats']);
            $brandIds = $this->settings['unserBrands'];
        }

        /* @var $p SProducts */
        foreach ($this->ymarket_model->getProducts($this->settings['unserCats'], $ignoreSettings, $brandIds) as $p) {
            $param = ShopCore::app()->SPropertiesRenderer->renderPropertiesArray($p);
            $additionalImages = $this->getAdditionalImages($p) ? : [];
            /* @var $v SProductVariants */
            $criteria = new \Propel\Runtime\ActiveQuery\Criteria();
            if (!$ignoreSettings) {
                $criteria->add('Stock', 0, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN);
            }

            foreach ($p->getProductVariants($criteria) as $v) {
                if (!$v->getPrice()) {
                    continue;
                }
                $unique_id = $v->getId();
                $this->offers[$unique_id]['url'] = shop_url('product/' . $p->getUrl());
                $this->offers[$unique_id]['price'] = $v->getPriceInMain();

                if (!$this->currencies[$v->getCurrency()]['code']) {
                    $currencyId = $this->mainCurr['code'];
                } else {
                    $currencyId = $this->currencies[$v->getCurrency()]['code'];
                }

                $this->offers[$unique_id]['currencyId'] = $currencyId;
                $this->offers[$unique_id]['categoryId'] = $p->getCategoryId();
                $this->offers[$unique_id]['picture'] = array_merge([productImageUrl('products/main/' . $v->getMainImage())], $additionalImages);
                $this->offers[$unique_id]['name'] = $this->forName($p->getName(), $v->getName());
                $this->offers[$unique_id]['vendor'] = $p->getBrand() ? htmlspecialchars($p->getBrand()->getName()) : '';
                $this->offers[$unique_id]['vendorCode'] = $v->getNumber() ? $v->getNumber() : '';
                $this->offers[$unique_id]['description'] = htmlspecialchars($p->getFullDescription());
                $this->offers[$unique_id]['cpa'] = $v->getStock() ? 1 : 0;
                $this->offers[$unique_id]['quantity'] = $v->getStock();

                if ($this->settings['adult']) {
                    $this->offers[$unique_id]['adult'] = 'true';
                }

                $this->offers[$unique_id]['param'] = $param;
            }
        }
        $infoXml['categories'] = $categories;
        $infoXml['offers'] = $this->offers;
        $infoXml['site_short_title'] = $this->settings['site_short_title'];
        $infoXml['site_title'] = $this->settings['site_title'];
        $infoXml['base_url'] = $ci->config->item('base_url');
        $infoXml['imagecms_number'] = IMAGECMS_NUMBER;
        $infoXml['siteinfo_adminemail'] = siteinfo('siteinfo_adminemail');
        $infoXml['currencyCode'] = $this->currencies;
        $infoXml['mainCurr'] = $this->mainCurr;

        \CMSFactory\assetManager::create()
                ->setData('full', $ignoreSettings)
                ->setData('infoXml', $infoXml)
                ->render('yandex', true);
    }

    public function all() {
        $this->index(true);
    }

    /**
     * Generates a name of the product depending on the name and version of the product name.
     * @param str $productName product name
     * @param str $variantName variant name
     * @return str name for xml
     */
    private function forName($productName, $variantName) {
        if (encode($productName) == encode($variantName)) {
            $name = htmlspecialchars($productName);
        } else {
            $name = htmlspecialchars($productName . ' ' . $variantName);
        }
        return $name;
    }

    /**
     *
     * @param SProducts $product
     * @return array
     */
    private function getAdditionalImages(SProducts $product) {

        $offers = [];
        $images = $iterator = $offers = null;
        $images = $product->getSProductImagess();
        if (count($images) > 0 && ++$iterator < 9) {
            foreach ($images as $image) {
                $offers[] = productImageUrl('products/additional/' . $image->getImageName());
            }
        }
        return $offers;
    }

    /**
     * autoload
     */
    public function autoload() {

    }

    public static function adminAutoload() {

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
        $this->dbforge->create_table('mod_ymarket_prodcuts_fields', TRUE);

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