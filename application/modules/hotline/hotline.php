<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class for Yandex_market
 * @uses ShopController
 * @author a.skavronskiy@imagecms.net <a.skavronskiy@imagecms.net>
 * @copyright (c) 2014, ImageCMS
 * @package ImageCMSModule
 */
class Hotline extends ShopController {

    protected $offers = array();
    protected $categories = array();
    protected $currencyCode;
    protected $settings;

    public function __construct() {
        $this->currencyCode = SCurrenciesQuery::create()->filterByIsDefault(true)->findOne()->getCode();
        $this->settings = $this->cms_base->get_settings();



        parent::__construct();
    }

    public function allCatId($arg) {
        $query = $this->db->get_where('shop_product_categories', array('product_id' => $arg));
        $row = $query->row();

        foreach ($query->result() as $row) {
            $a = $row->category_id;
        }

        return $a;
    }

    public function genreYML($indicator = null) {

        
        
        
        header('content-type: text/xml');
        $ci = ShopCore::$ci;
        $pictureBaseUrl = base_url() . "uploads/shop/products/main/";
        
             /* @var $p SProducts */
            foreach ($this->getProducts() as $p) {
                /* @var $v SProductVariants */
                foreach ($p->getProductVariants() as $v) {
                    if (!$v->getPrice()) {
                        continue;
                    }
                    $unique_id = $p->getId() . $v->getId();
                    $param = ShopCore::app()->SPropertiesRenderer->renderPropertiesArray($p);
                    $this->offers[$unique_id]['url'] = ShopCore::$ci->config->item('base_url') . '/shop/product/' . $p->url;
                    $this->offers[$unique_id]['priceRUAH'] = $v->getPrice();
                    $this->offers[$unique_id]['categoryId'] = $p->getCategoryId();
                    $this->offers[$unique_id]['image'] = $pictureBaseUrl . $v->getMainImage();
                    if ($indicator == null){$this->offers[$unique_id]['name'] = $this->forName($p->getName(), $v->getName());}
                    if ($indicator == 1){
                        $vendor = $p->getBrand() ? htmlspecialchars($p->getBrand()->getName()) : ' ';
                        $name = $this->forName($p->getName(), $v->getName());
                           $query = $this->db->query("
                           SELECT shop_product_properties_data.value  FROM mod_hotline_properties
                           LEFT JOIN shop_product_properties_data ON (mod_hotline_properties.property_id = shop_product_properties_data.property_id)
                           WHERE shop_product_properties_data.product_id = " . $p->getId() ."  and category_id = " . $p->getCategoryId() ." 
                        ");

                        $arr = $query->result_array();
                        $properties ='';
                        foreach ($arr as $value) {
                            $properties .= $value['value']. ' ';
                            
                        }
                    
                        $this->offers[$unique_id]['name'] = $vendor .' '. $p->getName() .' '. $v->getNumber() . ' ' .$properties;
                    }
                    $this->offers[$unique_id]['vendor'] = $p->getBrand() ? htmlspecialchars($p->getBrand()->getName()) : ' ';
                    $this->offers[$unique_id]['code'] = $v->getNumber() ? htmlspecialchars($v->getNumber()) : ' ';
                    $this->offers[$unique_id]['description'] = htmlspecialchars($p->getFullDescription());
                    if((int)$v->getStock() > 0){$this->offers[$unique_id]['stock'] = 'На складе';}
                            

                }
            }

            $model = ShopSettingsQuery::create() ->filterByName('shopNumber') ->findOne();
            $shop = $model->getValue();
            echo '<?xml version="1.0" encoding="utf-8"?>
                            <price>
                            <date>' . date('Y-m-d H:i') . '</date>
                            <firmName>' . $this->settings['site_title'] . '</firmName>
                            <firmId>'. $shop . '</firmId>
                            <rate>8.12</rate>';

            echo "\n\n";
            echo $this->renderCategoriesHotline();
            echo $this->renderOffersHotline();
            echo "</price>\n";

    }

    private function forName($productName, $variantName) {
        if (encode($productName) == encode($variantName)) {
            $name = encode($productName);
        } else {
            $name = encode($productName . ' ' . $variantName);
        }
        return $name;
    }

    public function renderCategoriesHotline() {
        echo "<categories>";
        foreach ($this->categories as $c) {
            $parent = '';
            if ($c['parent_id'] > 0) {
                $parent = '<parentId>' . $c['parent_id'] . '</parentId>';
            }
            echo '<category><id>'  . $c['id'] . '</id>' . $parent . '<name>' . encode($c['name']) . '</name></category>' . "\n";
        }
        echo "</categories>";
    }
    protected function renderOffersHotline() {
        echo '<items>';
        foreach ($this->offers as $id => $offer) {
            echo "<item>\n\n";
            echo "\n<id>$id</id>\n";
            echo "" . $this->arrayToXmlHotline($offer);
            echo "</item>\n\n";
        }
        echo '</items>';
    }
    protected function arrayToXmlHotline($array) {
        foreach ($array as $k => $v) {
                echo "\t<$k>" . $v . "</$k>\n";
       
        }
    }
    public function getProducts() {
        $this->db->select('value');
        $this->db->where('id', 1); 
        $query = $this->db->get('mod_hotline_categories');
        $arr = $query->row_array();
        $arr = unserialize($arr['value']); 
        $names = array(implode($arr, ','));
          
                       $query = $this->db->query("
                           SELECT shop_category.id, shop_category.parent_id, shop_category_i18n.name  FROM shop_category
                           LEFT JOIN shop_category_i18n ON (shop_category_i18n.id = shop_category.id)
                           WHERE shop_category.id IN (" . $names[0] ." ) AND shop_category_i18n.locale = 'ru'
                        ");
                        
                       $this->categories = $query->result_array();
                                       
        $Ids = $this->db
                ->select('id')
                ->where_in('category_id', $arr)
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

    protected static function prep_desc($var, $chars = 0, $end = '...') {
        if ($chars > 0 AND mb_strlen($var, 'utf-8') >= $chars) {
            $result = mb_substr($var, 0, $chars, 'utf-8') . $end;
        } else {
            $result = $var;
        }

        $result = str_replace('&ndash;', '', $result);
        $result = str_replace('&nbsp;', '', $result);
        $result = str_replace('&quot;', '', $result);
        $result = str_replace('&mdash;', '', $result);
        $result = str_replace('&laquo;', '', $result);
        $result = str_replace('&raquo;', '', $result);
        $result = str_replace('&ldquo;', '', $result);
        $result = str_replace('&rdquo;', '', $result);
        return $result;
    }

}

/* End of file banners.php */
