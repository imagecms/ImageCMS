<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * parce_opencart Admin
 * @property CI_DB_active_record $db_opencart 
 * @link http://opencartforum.ru/topic/5852-opisaniia-failov-shablona-15kh-diagramma-mysql/ опис бази
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('parce_opencart');
        $this->load->helper('translit');
        $this->langs = array();
    }

    public function index() {
        \CMSFactory\assetManager::create()
                ->renderAdmin('main');
    }

    public function run_process() {
//        \libraries\Backup::create()->createBackup("zip", "parce_opencart");
        $db['hostname'] = 'localhost';
        $db['username'] = $this->input->post('username');
        $db['password'] = $this->input->post('password');
        $db['database'] = $this->input->post('database');
        $db['dbdriver'] = 'mysql';
        $db['dbprefix'] = '';
        $db['pconnect'] = FALSE;
        $db['db_debug'] = FALSE;
        $db['cache_on'] = FALSE;
        $db['cachedir'] = 'system/cache';
        $db['char_set'] = 'utf8';
        $db['dbcollat'] = 'utf8_general_ci';
        $db['swap_pre'] = '';
        $db['autoinit'] = TRUE;
        $db['stricton'] = FALSE;

        $this->db_opencart = $this->load->database($db, TRUE, TRUE);

        $this->db->truncate('shop_category');
        $this->db->truncate('shop_category_i18n');

        $this->db->truncate('shop_brands');
        $this->db->truncate('shop_brands_i18n');

        $this->db->truncate('shop_currencies');

        $this->db->truncate('shop_products');
        $this->db->truncate('shop_products_i18n');
        $this->db->truncate('shop_product_variants');
        $this->db->truncate('shop_product_variants_i18n');
        $this->db->truncate('shop_product_categories');

        $this->db->truncate('shop_product_properties');
        $this->db->truncate('shop_product_properties_i18n');
        $this->db->truncate('shop_product_properties_categories');
        $this->db->truncate('shop_product_properties_data');
        $this->db->truncate('shop_product_properties_data_i18n');

        $this->db->truncate('shop_orders');
        $this->db->truncate('shop_orders_products');

        $this->db->truncate('trash');

        $this->insert_lang();
        $this->insert_category();
        $this->insert_brands();
        $this->insert_currency();
        $this->insert_users();
//        $this->insert_properties();
        $this->insert_products();
//        $this->insert_orders();

        $this->cache->delete_all();

        \ShopCore::app()->SCurrencyHelper->checkPrices();

        showMessage(lang('Process completed', 'parce_opencart'));
    }

    public function insert_orders() {
        $array = $this->db_opencart
                ->order_by('order_id')
                ->get('order')
                ->result_array();

        foreach ($array as $value) {
            $orders[$value['order_id']] = $value;
        }

        $array = $this->db_opencart
                ->get('order_product')
                ->result_array();

        foreach ($array as $value) {
            $order_products[$value['order_id']][] = $value;
        }

        foreach ($orders as $order) {
            $orders_insert[] = array(
            );

            foreach ($order_products as $order_product) {
                
            }
        }
    }

    public function insert_properties() {
        $array = $this->db_opencart
                ->join('option_description', 'option_description.option_id=option.option_id')
                ->get('option')
                ->result_array();

//        var_dump($array);
    }

    public function insert_lang() {
        $array = $this->db_opencart
                ->get('language');

        try {
            if ($array) {
                $array = $array->result_array();
            } else {
                throw new Exception(lang('Import languages error', 'parce_opencart'));
            }
        } catch (Exception $exc) {
            showMessage($exc->getMessage(), '', 'r');
            return FALSE;
        }

        foreach ($array as $value) {
            $langs[$value['language_id']] = $value;
        }

        $template = $this->db->get('settings')->row()->site_template;

        foreach ($langs as $lang) {
            $insert[] = array(
                'id' => $lang['language_id'],
                'lang_name' => $lang['name'],
                'identif' => $lang['code'],
                'image' => $lang['image'],
                'folder' => $lang['directory'],
                'template' => $template,
                'default' => $lang['status'],
                'locale' => $lang['locale'],
            );
        }
        $this->db->insert_batch('languages', $insert);

        $array = $this->db->get('languages')->result_array();

        foreach ($array as $lang) {
            $this->langs[$lang['id']] = $lang['identif'];
        }
    }

    public function insert_users() {
        
    }

    public function insert_currency() {
        $data = $this->db_opencart
                ->get('currency');

        try {
            if ($data) {
                $data = $data->result_array();
            } else {
                throw new Exception(lang('Import currencys error', 'parce_opencart'));
            }
        } catch (Exception $exc) {
            showMessage($exc->getMessage(), '', 'r');
            return FALSE;
        }

        foreach ($data as $cur) {
            $insert[] = array(
                'id' => $cur['currency_id'],
                'name' => $cur['title'],
                'main' => $cur['status'],
                'is_default' => $cur['status'],
                'code' => $cur['code'],
                'rate' => $cur['value'],
                'symbol' => $cur['symbol_right'],
                'showOnSite' => 1,
            );
        }

        $this->db->insert_batch('shop_currencies', $insert);
    }

    public function insert_brands() {
        $data = $this->db_opencart
                ->join('manufacturer_description', 'manufacturer.manufacturer_id=manufacturer_description.manufacturer_id')
                ->order_by('manufacturer.manufacturer_id')
                ->get('manufacturer');
        try {
            if ($data) {
                $data = $data->result_array();
            } else {
                throw new Exception(lang('Import brands error', 'parce_opencart'));
            }
        } catch (Exception $exc) {
            showMessage($exc->getMessage(), '', 'r');
            return FALSE;
        }

        foreach ($data as $dd) {
            $manufacturer[$dd['manufacturer_id']] = $dd;
        }

        $u = $this->db_opencart
                ->like('query', 'manufacturer_id')
                ->order_by('url_alias_id')
                ->get('url_alias')
                ->result_array();

        foreach ($u as $url) {
            $id = str_replace('manufacturer_id=', '', $url['query']);
            $manufacturer[$id]['url'] = $url['keyword'];
        }

        foreach ($manufacturer as $brand) {
            $insert[] = array(
                'id' => $brand['manufacturer_id'],
                'url' => $brand['url'],
                'image' => pathinfo($brand['image'], PATHINFO_BASENAME),
                'position' => $brand['manufacturer_id'],
            );

            copy('uploads/' . $brand['image'], 'uploads/shop/brands/' . pathinfo($brand['image'], PATHINFO_BASENAME));

            $insert_i18n[] = array(
                'id' => $brand['manufacturer_id'],
                'locale' => 'ru',
                'name' => htmlspecialchars_decode($brand['name']),
                'description' => $brand['description'],
                'meta_title' => $brand['seo_title'],
                'meta_description' => $brand['meta_description'],
                'meta_keywords' => $brand['meta_keyword'],
            );

            $trash[] = array(
                'trash_url' => $brand['url'],
                'trash_redirect_type' => 'url',
                'trash_redirect' => site_url() . 'shop/brand/' . $brand['url'],
                'trash_type' => 301,
            );
        }

        $this->db->insert_batch('shop_brands', $insert);
        $this->db->insert_batch('shop_brands_i18n', $insert_i18n);
        $this->db->insert_batch('trash', $trash);
    }

    public function insert_products() {
        $data = $this->db_opencart
                ->join('product_description', 'product.product_id=product_description.product_id')
                ->order_by('product.product_id')
                ->get('product');

        try {
            if ($data) {
                $data = $data->result_array();
            } else {
                throw new Exception(lang('Import products error', 'parce_opencart'));
            }
        } catch (Exception $exc) {
            showMessage($exc->getMessage(), '', 'r');
            return FALSE;
        }

        foreach ($data as $d) {
            $array[$d['product_id']] = $d;
        }

        $data = $array;

        $u = $this->db_opencart
                ->like('query', 'product_id')
                ->order_by('url_alias_id')
                ->get('url_alias')
                ->result_array();

        foreach ($u as $key => $url) {
            $id = str_replace('product_id=', '', $url['query']);
            $data[$id]['url'] = $url['keyword'];
        }

        $category = $this->db_opencart
                ->order_by('product_to_category.product_id')
                ->get('product_to_category')
                ->result_array();

        foreach ($category as $value) {
            if ($value['main_category']) {
                $data[$value['product_id']]['categorys']['main_category'] = $value['category_id'];
            } else {
                $data[$value['product_id']]['categorys'][] = $value['category_id'];
            }
        }

        $cur = $this->db->where('main', 1)->get('shop_currencies')->row()->id;

        foreach ($data as $product) {
            $insert[] = array(
                'id' => $product['product_id'],
                'url' => $product['url'],
                'hit' => 0,
                'hot' => 0,
                'action' => 0,
                'active' => 1,
                'brand_id' => $product['manufacturer_id'],
                'category_id' => $product['categorys']['main_category'] ? $product['categorys']['main_category'] : $product['categorys'][0],
                'related_products' => NULL,
                'mainImage' => NULL,
                'smallImage' => NULL,
                'created' => strtotime($product['date_added']),
                'updated' => strtotime($product['date_modified']),
                'old_price' => NULL,
                'views' => $product['viewed'],
                'added_to_cart_count' => 0,
                'enable_comments' => 1,
                'external_id' => NULL,
                'mainModImage' => NULL,
                'smallModImage' => NULL,
                'tpl' => NULL,
                'user_id' => NULL,
            );

            $insert_i18n[] = array(
                'id' => $product['product_id'],
                'locale' => 'ru',
                'name' => htmlspecialchars_decode($product['name']),
                'short_description' => htmlspecialchars_decode($product['description']),
                'full_description' => htmlspecialchars_decode($product['description']),
                'meta_title' => $product['seo_title'],
                'meta_description' => $product['meta_description'],
                'meta_keywords' => $product['meta_keyword'],
            );

            copy('uploads/' . $product['image'], 'uploads/shop/products/origin/' . pathinfo($product['image'], PATHINFO_BASENAME));

            $insert_variant[] = array(
                'product_id' => $product['product_id'],
                'price' => NULL,
                'number' => $product['sku'],
                'stock' => $product['quantity'],
                'position' => 0,
                'mainImage' => pathinfo($product['image'], PATHINFO_BASENAME),
                'smallImage' => NULL,
                'external_id' => NULL,
                'currency' => $cur,
                'price_in_main' => $product['price'],
            );

            foreach ($product['categorys'] as $cat) {
                $insert_categorys[] = array(
                    'product_id' => $product['product_id'],
                    'category_id' => $cat,
                );
            }

            $trash[] = array(
                'trash_url' => ltrim($this->db->where('id', $product['categorys']['main_category'] ? $product['categorys']['main_category'] : $product['categorys'][0])->get('shop_category')->row()->full_path . '/') . $product['url'],
                'trash_redirect_type' => 'url',
                'trash_redirect' => site_url() . 'shop/product/' . $product['url'],
                'trash_type' => 301,
            );
        }

        $this->db->insert_batch('shop_products', $insert);
        $this->db->insert_batch('shop_products_i18n', $insert_i18n);
        $this->db->insert_batch('shop_product_variants', $insert_variant);
        $this->db->insert_batch('shop_product_categories', $insert_categorys);

        foreach ($data as $product) {
            $insert_variant_i18n[] = array(
                'id' => $this->db->where('product_id', $product['product_id'])->get('shop_product_variants')->row()->id,
                'locale' => 'ru',
                'name' => htmlspecialchars_decode($product['name']),
            );
        }
        $this->db->insert_batch('shop_product_variants_i18n', $insert_variant_i18n);
        $this->db->insert_batch('trash', $trash);
    }

    public function insert_category() {
        $data = $this->db_opencart
                ->join('category_description', 'category.category_id=category_description.category_id')
                ->order_by('category.category_id')
                ->get('category');
        try {
            if ($data) {
                $data = $data->result_array();
            } else {
                throw new Exception(lang('Import categorys error', 'parce_opencart'));
            }
        } catch (Exception $exc) {
            showMessage($exc->getMessage(), '', 'r');
            return FALSE;
        }

        $u = $this->db_opencart
                ->like('query', 'category_id')
                ->get('url_alias')
                ->result_array();

        foreach ($u as $url) {
            $id = str_replace('category_id=', '', $url['query']);
            $urls[$id] = $url['keyword'];
        }

        foreach ($data as $d) {
            $array[$d['category_id']] = $d;
        }

        $data = $array;

        foreach ($data as $d) {
            $parentId = $d['parent_id'];
            $fp[$d['category_id']][] = $urls[$d['category_id']];

            while ($parentId != 0) {
                $fpi[$d['category_id']][] = (int) $parentId;
                $fp[$d['category_id']][] = $urls[$parentId];

                $parentId = $data[$parentId]['parent_id'];
            }

            if (count($fpi[$d['category_id']]) == 0) {
                $fpi[$d['category_id']] = array();
            }

            $fp[$d['category_id']] = implode('/', array_reverse($fp[$d['category_id']]));
            $fpi[$d['category_id']] = serialize($fpi[$d['category_id']]);

            $insert[] = array(
                'id' => $d['category_id'],
                'url' => $urls[$d['category_id']],
                'parent_id' => $d['parent_id'],
                'position' => $d['category_id'],
                'full_path' => $fp[$d['category_id']],
                'full_path_ids' => $fpi[$d['category_id']],
                'active' => $d['status'],
                'image' => '',
                'tpl' => '',
                'order_method' => '',
            );
            $insert_i18n[] = array(
                'id' => $d['category_id'],
                'locale' => $this->langs[$d['language_id']],
                'name' => htmlspecialchars_decode($d['name']),
                'h1' => $d['seo_h1'],
                'description' => $d['description'],
                'meta_desc' => $d['meta_description'],
                'meta_title' => $d['seo_title'],
                'meta_keywords' => $d['meta_keyword'],
            );

            $trash[] = array(
                'trash_url' => $fp[$d['category_id']],
                'trash_redirect_type' => 'category',
                'trash_redirect' => site_url() . 'shop/category/' . $fp[$d['category_id']],
                'trash_type' => 301,
            );
        }

        $this->db->insert_batch('shop_category', $insert);
        $this->db->insert_batch('shop_category_i18n', $insert_i18n);
        $this->db->insert_batch('trash', $trash);
    }

}
