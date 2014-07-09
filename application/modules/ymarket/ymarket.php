<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
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
        $this->currencyCode = SCurrenciesQuery::create()->filterByIsDefault(true)->findOne()->getCode();
        $this->settings = $this->cms_base->get_settings();
        $this->adult = ShopCore::$ci->db->where('name','adult')->select('value')->get('mod_ymarket')->row()->value;
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

    public function index() {
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
        
        
        header('content-type: text/xml');
        echo '<?xml version="1.0" encoding="utf-8"?>
			<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
			<yml_catalog date="' . date('Y-m-d H:i') . '">
			<shop>
			<name>' . $this->settings['site_short_title'] . '</name>
			<company>' . $this->settings['site_title'] . '</company>
			<url>' . $ci->config->item('base_url') . '</url>
                        <platform>ImageCMS</platform>
			<version>' . IMAGECMS_NUMBER . '</version>
			<email>' . siteinfo('siteinfo_adminemail') . '</email>';

        echo "\n\n";

        echo '<currencies>
			<currency id="' . $this->currencyCode . '" rate="1"/>
		</currencies>' . "\n\n";
        echo $this->renderCategories();
        echo $this->renderOffers();
        echo "</shop>\n";
        echo "</yml_catalog>";
    }

    private function forName($productName, $variantName) {
        if (encode($productName) == encode($variantName)) {
            $name = encode($productName);
        } else {
            $name = encode($productName . ' ' . $variantName);
        }
        return $name;
    }

    public function renderCategories() {
        $unserCats = unserialize(ShopCore::$ci->db->where('name','categories')
                ->select('value')
                ->get('mod_ymarket')
                ->row()
                ->value);
        
        $categories = SCategoryQuery::create()->filterById($unserCats)
                ->find();

        echo "<categories>";
        foreach ($categories as $c) {
            $parent = '';
            if ($c->getParentId() > 0) {
                $parent = ' parentId="' . $c->getParentId() . '"';
            }
            echo '<category id="' . $c->getId() . '"' . $parent . '>' . encode($c->getName()) . '</category>' . "\n";
        }
        echo "</categories>";
    }

    protected function renderOffers() {
        echo '<offers>';
        foreach ($this->offers as $id => $offer) {
            echo "\n<offer id=\"$id\" available=\"true\">\n";
            echo "" . $this->arrayToXml($offer);
            echo "</offer>\n\n";
        }
        echo '</offers>';
    }

    protected function arrayToXml($array) {
        foreach ($array as $k => $v) {
            if ($k == 'param') {
                foreach ($v as $prop) {
                    echo "\t" . '<param name="' . str_replace(':', '', $prop['Name']) . '">' . $prop['Value'] . "</param>\n";
                }
            } elseif (strstr($k, 'picture')) {
                echo "\t<picture>" . $v . "</picture>\n";
            } else {
                echo "\t<$k>" . $v . "</$k>\n";
            }
        }
    }

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

    public function autoload() {
        
    }

    public function _install() {
        
        /** We recomend to use http://ellislab.com/codeigniter/user-guide/database/forge.html */
        
          $this->load->dbforge();
          $fields = array(
          'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE,),
          'name' => array('type' => 'TEXT',),
          'value' => array('type' => 'TEXT',)
          );
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->add_field($fields);
          $this->dbforge->create_table('mod_ymarket', TRUE);         
        
          $this->db->where('name', 'ymarket')
          ->update('components', array('enabled' => '1'));
          
          $this->db->insert('mod_ymarket', array('name'=>'categories', 'value' => ''));
          $this->db->insert('mod_ymarket', array('name'=>'adult', 'value' => ''));
        
    }

    public function _deinstall() {        
          $this->load->dbforge();
          $this->dbforge->drop_table('mod_ymarket');          
    }

}

/* End of file sample_module.php */
