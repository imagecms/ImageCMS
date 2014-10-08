<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module ymarket
 */
class Ymarket extends ShopController {

    protected $offers = array();
    protected $categories = array();
    protected $currencyCode;
    protected $settings;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('ymarket');
        $this->load->model('ymarket_model');
    }

    /**
     * Generates an array of data to create a body xml
     */
    public function index() {
        $ci = ShopCore::$ci;

        $this->settings = $this->ymarket_model->init();
        $this->currencyCode = ShopCore::app()->SCurrencyHelper->current->code;
        $categories = \Category\CategoryApi::getInstance()->getCategory($this->settings['unserCats']);

        /* @var $p SProducts */
        foreach ($this->ymarket_model->getProducts($this->settings['unserCats']) as $p)
        {
            $param = ShopCore::app()->SPropertiesRenderer->renderPropertiesArray($p);
            $additionalImages = $this->getAdditionalImages($p);
            /* @var $v SProductVariants */
            foreach ($p->getProductVariants() as $v)
            {
                if (!$v->getPrice())
                {
                    continue;
                }
                $unique_id += $p->getId() . '.' . $v->getId();
                $this->offers[$unique_id]['url'] = $ci->config->item('base_url') . '/shop/product/' . $p->url;
                $this->offers[$unique_id]['price'] = $v->getPrice();
                $this->offers[$unique_id]['currencyId'] = $this->currencyCode;
                $this->offers[$unique_id]['categoryId'] = $p->getCategoryId();
                $this->offers[$unique_id]['picture'] = array_merge(array(productImageUrl('products/main/' . $v->getMainImage())), $additionalImages);
                $this->offers[$unique_id]['name'] = $this->forName($p->getName(), $v->getName());
                $this->offers[$unique_id]['vendor'] = $p->getBrand() ? htmlspecialchars($p->getBrand()->getName()) : '';
                $this->offers[$unique_id]['vendorCode'] = $v->getNumber() ? $v->getNumber() : '';
                $this->offers[$unique_id]['description'] = htmlspecialchars($p->getFullDescription());

                if ($this->settings['adult'])
                {
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
        $infoXml['currencyCode'] = $this->currencyCode;

        \CMSFactory\assetManager::create()
                ->setData('infoXml', $infoXml)
                ->render('main', true);
        exit;
    }

    /**
     * Generates a name of the product depending on the name and version of the product name.
     * @param str $productName product name
     * @param str $variantName variant name
     * @return str name for xml
     */
    private function forName($productName, $variantName) {
        if (encode($productName) == encode($variantName))
        {
            $name = encode($productName);
        }
        else
        {
            $name = encode($productName . ' ' . $variantName);
        }
        return $name;
    }

    /**
     *
     * @param SProducts $product
     * @return array
     */
    private function getAdditionalImages(SProducts $product) {

        $offers = array();
        $images = $iterator = $offers = null;
        $images = $product->getSProductImagess();
        if (count($images) > 0 && ++$iterator < 9)
        {
            foreach ($images as $key => $image)
            {
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

    /**
     * Install
     */
    public function _install() {
        $this->load->dbforge();
        $fields = array(
            'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE),
            'categories' => array('type' => 'TEXT'),
            'adult' => array('type' => 'VARCHAR', 'constraint' => 100)
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_ymarket', TRUE);

        $this->db->where('name', 'ymarket')
                ->update('components', array('enabled' => '1'));

        $this->db->insert('mod_ymarket', array('categories' => '', 'adult' => ''));
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
