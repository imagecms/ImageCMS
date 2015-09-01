<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module ymarket
 * @property Ymarket_model $ymarket_model
 */
class Ymarket extends ShopController {

    const DEFAULT_TYPE = 1;
    const PRICE_UA_TYPE = 2;

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

    private function init($ignoreSettings = false, $type) {
        if ($ignoreSettings) {
            $this->categories = \Category\CategoryApi::getInstance()->getCategory();
            $this->brandIds = [];
        } else {
            $this->settings = $this->ymarket_model->init($type);
            $this->categories = \Category\CategoryApi::getInstance()->getCategory($this->settings['unserCats']);
            $this->brandIds = $this->settings['unserBrands'];
        }
    }

    /**
     * Price.ua & Nadavi.net
     * @url http://price.ua/assets/0123b18f5c083be5/example.xml
     */
    public function priceua() {
        $this->init(false, self::PRICE_UA_TYPE);
        $this->index(false, true);
    }

    /**
     * Generates an array of data to create a body xml
     */
    public function index($ignoreSettings = false, $flagPriceUa = false) {
        if ($flagPriceUa) {
            $this->init($ignoreSettings, self::PRICE_UA_TYPE);
            $this->priceuaCore();
        } else {
            $this->init($ignoreSettings, self::DEFAULT_TYPE);
            $this->ymarketCore();
        }
    }

    private function priceuaCore($ignoreSettings = false) {
        $ci = ShopCore::$ci;

        $currencies = \Currency\Currency::create()->getMainCurrency();
        $this->mainCurr['id'] = $currencies->getId();
        $this->mainCurr['rate'] = number_format($currencies->getRate(), 3);
        $this->mainCurr['code'] = $currencies->getCode();

        //        $params = $this->getProperties($variants);
        $params = [];
        $productFields = [];

        $this->formOffers($ignoreSettings, $productFields, $params);

        $infoXml = [];
        $infoXml['categories'] = $this->categories;
        $infoXml['offers'] = $this->offers;
        $infoXml['site_title'] = $this->settings['site_title'];
        $infoXml['base_url'] = $ci->config->item('base_url');
        $infoXml['mainCurr'] = $this->mainCurr;

        \CMSFactory\assetManager::create()
            ->setData('full', $ignoreSettings)
            ->setData('infoXml', $infoXml)
            ->render('priceua', true);
    }

    private function ymarketCore($ignoreSettings = false) {
        $ci = ShopCore::$ci;

        $currencies = \Currency\Currency::create()->getCurrencies();

        $checkRUB = false;
        $rates = [];
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
                    continue;
                }
            } else {
                if ($value->getMain()) {
                    $this->mainCurr['code'] = $value->getCode() == 'RUB' ? 'RUR' : $value->getCode();
                    $rate = $rates[$this->mainCurr['code']]['rate'] ? $rates[$this->mainCurr['code']]['rate'] : 1 / $value->getRate();
                    $this->mainCurr['rate'] = number_format($rate, 3);
                    continue;
                }
            }

            $this->currencies[$value->getId()]['code'] = $value->getCode();
            $rate = $rates[$value->getCode()]['rate'] ? $rates[$value->getCode()]['rate'] : 1 / $value->getRate();
            $this->currencies[$value->getId()]['rate'] = number_format($rate, 3);
        }

        $productFields = $this->ymarket_products_fields_model->getProductsFields();

        $this->formOffers($ignoreSettings, $productFields);

        $infoXml = [];
        $infoXml['categories'] = $this->categories;
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

    /**
     * Generate offers data
     * @param $ignoreSettings
     * @param $productFields
     */
    private function formOffers($ignoreSettings, $productFields) {
        $variants = $this->ymarket_model->getVariants($this->settings['unserCats'], $ignoreSettings, $this->brandIds);
        $params = $this->getProperties($variants);
        $additionalImages = $this->getAdditionalImagesBYVariants($variants);

        foreach ($variants as $variant) {
            $unique_id = $variant->getId();
            $this->offers[$unique_id]['url'] = CI::$APP->config->item('base_url') . 'shop/product/' . $variant->getSProducts()->url;
            $this->offers[$unique_id]['price'] = $variant->getPriceInMain();
            if (!$this->currencies[$variant->getCurrency()]['code']) {
                $currencyId = $this->mainCurr['code'];
            } else {
                $currencyId = $this->currencies[$variant->getCurrency()]['code'];
            }
            $this->offers[$unique_id]['currencyId'] = $currencyId;
            $this->offers[$unique_id]['categoryId'] = $variant->getSProducts()->getCategoryId();
            $this->offers[$unique_id]['picture'] = array_merge(array(productImageUrl('products/main/' . $variant->getMainImage())), $additionalImages[$variant->getProductId()]);
            $this->offers[$unique_id]['name'] = $this->forName($variant->getSProducts()->getName(), $variant->getName());
            $this->offers[$unique_id]['vendor'] = $variant->getSProducts()->getBrand() ? htmlspecialchars($variant->getSProducts()->getBrand()->getName()) : '';
            $this->offers[$unique_id]['vendorCode'] = $variant->getNumber() ? $variant->getNumber() : '';
            $this->offers[$unique_id]['description'] = htmlspecialchars($variant->getSProducts()->getFullDescription());
            $this->offers[$unique_id]['cpa'] = $variant->getStock() ? 1 : 0;
            $this->offers[$unique_id]['quantity'] = $variant->getStock();

            if ($productFields[$variant->getProductId()]) {
                if ($productFields[$variant->getProductId()]['country_of_origin']) {
                    $this->offers[$unique_id]['country_of_origin'] = $productFields[$variant->getProductId()]['country_of_origin'];
                }
                if ($productFields[$variant->getProductId()]['manufacturer_warranty']) {
                    $this->offers[$unique_id]['manufacturer_warranty'] = $productFields[$variant->getProductId()]['manufacturer_warranty'];
                }
                if ($productFields[$variant->getProductId()]['seller_warranty']) {
                    $this->offers[$unique_id]['seller_warranty'] = $productFields[$variant->getProductId()]['seller_warranty'];
                }
            }

            if ($this->settings['adult']) {
                $this->offers[$unique_id]['adult'] = 'true';
            }

            if ($params[$variant->getProductId()]) {
                $this->offers[$unique_id]['param'] = $params[$variant->getProductId()];
            }
        }
    }

    public function all() {
        $this->index(true);
    }

    /**
     * @param $products - products collection
     * @return array
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProperties($products) {
        $productsIds = [];
        foreach ($products as $product) {
            $productsIds[] = $product->getProductId();
        }
        $properties = SPropertiesQuery::create()
            ->joinSProductPropertiesData()
            ->joinWithI18n(MY_Controller::getCurrentLocale())
            ->select(array('SProductPropertiesData.ProductId', 'SProductPropertiesData.Value', 'SPropertiesI18n.Name'))
            ->where('SProductPropertiesData.ProductId IN ?', $productsIds)
            ->where('SProductPropertiesData.Locale = ?', MY_Controller::getCurrentLocale())
            ->withColumn('SProductPropertiesData.ProductId', 'ProductId')
            ->withColumn('SProductPropertiesData.Value', 'Value')
            ->withColumn('SPropertiesI18n.Name', 'Name')
            ->where('SProperties.Active = ?', 1)
            ->where("SProductPropertiesData.Value != ?", '')
            ->where('SProperties.ShowOnSite = ?', 1)
            ->orderByPosition()
            ->find()
            ->toArray();
        $productsData = [];
        array_map(
            function ($property) use (&$productsData) {
                if (!$productsData[$property['ProductId']][$property['Name']]) {
                    $productsData[$property['ProductId']][$property['Name']] = [
                        'name' => $property['Name'],
                        'value' => [$property['Value']]
                    ];
                } else {
                    $productsData[$property['ProductId']][$property['Name']]['value'][] = $property['Value'];
                }
            },
            $properties
        );
        $productsData = array_map(
            function ($property) {
                return array_map(
                    function ($propertyValues) {
                        $propertyValues['value'] = implode(', ', $propertyValues['value']);
                        return $propertyValues;
                    },
                    $property
                );
            },
            $productsData
        );
        return $productsData;
    }

    /**
     *
     * @return array
     */
    private function getAdditionalImagesBYVariants($variants) {
        $productsIds = [];
        foreach ($variants as $variant) {
            $productsIds[] = $variant->getProductId();
        }
        $images = $this->db->where_in('product_id', $productsIds)->get('shop_product_images');
        $images = $images ? $images->result_array() : [];
        $productsData = [];
        array_map(
            function ($image) use (&$productsData) {
                $productsData[$image['product_id']][] = productImageUrl('products/additional/' . $image['image_name']);
            },
            $images
        );
        return $productsData;
    }

    /**
     * Generates a name of the product depending on the name and version of the product name.
     * @param str $productName product name
     * @param str $variantName variant name
     * @return string
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
     * autoload
     */
    public function autoload() {

    }

    public static function adminAutoload() {
        \CMSFactory\Events::create()
            ->onShopProductPreUpdate()
            ->setListener('_extendYmarketPageAdmin');

        \CMSFactory\Events::create()
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
            $view = \CMSFactory\assetManager::create()
                ->setData(
                    array(
                        'countries' => $countries,
                        'months' => $months,
                        'fields' => $fields,
                    )
                )
                ->registerScript('script')
                ->fetchAdminTemplate('products_extend');
            \CMSFactory\assetManager::create()
                ->appendData('moduleAdditions', $view);
        }
    }

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