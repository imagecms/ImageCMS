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
    protected $adult = FALSE;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('ymarket');        
    }
    
/**
 * Generates an array of data to create a body xml  * 
 */
    public function index() {
        $this->currencyCode = SCurrenciesQuery::create()->filterByIsDefault(true)->findOne()->getCode();
        $this->settings = $this->cms_base->get_settings();
        $this->adult = ShopCore::$ci->db->where('name','adult')->select('value')->get('mod_ymarket')->row()->value;
        
        $ci = ShopCore::$ci;
        $pictureBaseUrl = base_url() . "uploads/shop/products/main/";

        /* @var $p SProducts */
        foreach ($this->getProducts() as $p) {
            /* @var $v SProductVariants */
            foreach ($p->getProductVariants() as $v) {
                if (!$v->getPrice()) {
                    continue;
                }
                $unique_id += $p->getId() . '.' . $v->getId();
                $param = ShopCore::app()->SPropertiesRenderer->renderPropertiesArray($p);
                $this->offers[$unique_id]['url'] = ShopCore::$ci->config->item('base_url') . '/shop/product/' . $p->url;
                $this->offers[$unique_id]['price'] = $v->getPrice();
                $this->offers[$unique_id]['currencyId'] = $this->currencyCode;
                $this->offers[$unique_id]['categoryId'] = $p->getCategoryId();
                $this->offers[$unique_id]['picture'] = $pictureBaseUrl . $v->getMainImage();
                $images = null;
                $images = $p->getSProductImagess();
                if (count($images) > 0) {
                    foreach ($images as $key => $image) {
                        $this->offers[$unique_id]['picture' . $key] = productImageUrl('products/additional/' . $image->getImageName());
                    }
                }

                $this->offers[$unique_id]['name'] = $this->forName($p->getName(), $v->getName());
                $this->offers[$unique_id]['vendor'] = $p->getBrand() ? htmlspecialchars($p->getBrand()->getName()) : '';
                $this->offers[$unique_id]['vendorCode'] = $v->getNumber() ? $v->getNumber() : '';
                $this->offers[$unique_id]['description'] = htmlspecialchars($p->getFullDescription());
                if ($this->adult) {
                    $this->offers[$unique_id]['adult'] = 'true';
                }
                $this->offers[$unique_id]['param'] = $param;
            }
        }
        $infoXml['categories'] = $this->renderCategories();
        $infoXml['offers'] = $this->offers;
        $infoXml['site_short_title'] = $this->settings['site_short_title'];
        $infoXml['site_title'] = $this->settings['site_title'];
        $infoXml['base_url'] = $ci->config->item('base_url');
        $infoXml['imagecms_number'] = IMAGECMS_NUMBER;
        $infoXml['siteinfo_adminemail'] = siteinfo('siteinfo_adminemail');
        $infoXml['currencyCode'] = $this->currencyCode;

        header('content-type: text/xml');
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
        if (encode($productName) == encode($variantName)) {
            $name = encode($productName);
        } else {
            $name = encode($productName . ' ' . $variantName);
        }
        return $name;
    }
    
    /**
     * Selects the category assigned by the user
     * @return object Information about the selected category
     *
     */
    public function renderCategories() {
        $unserCats = unserialize(ShopCore::$ci->db->where('name','categories')
                ->select('value')
                ->get('mod_ymarket')
                ->row()
                ->value);
        
        $categories = SCategoryQuery::create()
                ->filterById($unserCats)
                ->find();
        return $categories;
    }
    
    /**
     * Selection of products in the categories specified by the user
     * @return array Product and products variants 
     */
    public function getProducts() {
        $unserCats = unserialize(ShopCore::$ci->db->where('name','categories')
                ->select('value')
                ->get('mod_ymarket')
                ->row()
                ->value);
        
        $Ids = $this->db
                ->select('id')
                ->where_in('category_id', $unserCats)
                ->get('shop_products')
                ->result_array();

        foreach ($Ids as $id) {
            $productsIds[] = $id['id'];
        }

        $products = SProductsQuery::create()
                ->distinct()
                ->filterById($productsIds)
                ->leftJoin('ProductVariant')
                ->useProductVariantQuery()
                ->filterByStock(array('min' => 1))
                ->endUse()
                ->filterByActive(true)
                ->find();

        $products->populateRelation('ProductVariant');
        return $products;
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
          'name' => array('type' => 'TEXT'),
          'value' => array('type' => 'TEXT')
          );
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->add_field($fields);
          $this->dbforge->create_table('mod_ymarket', TRUE);         
        
          $this->db->where('name', 'ymarket')
          ->update('components', array('autoload' => '1', 'enabled' => '1'));
          
          $this->db->insert('mod_ymarket', array('name'=>'categories', 'value' => ''));
          $this->db->insert('mod_ymarket', array('name'=>'adult', 'value' => ''));        
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
