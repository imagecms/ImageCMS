<?php

namespace exchangeunfu;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class ImportXML {
    /**
     * Path to upload dir
     * @var string
     */

    /** Arrays for db data storage  */
    private $prod = array();
    private $users = array();
    private $orders = array();
    private $orders_products = array();
    private $products_i18n = array();
    private $productivity = array();
    private $partners = array();
    private $prices = array();
    private $cat = array();
    private $categories_full_puth = array();
    private $categories_full_puth_ids = array();
    private $category_parents = array();

    /** Arrays for insert data storage  */
    private $insert = array();
    private $insert_categories_i18n = array();
    private $insert_order_products = array();

    /** Arrays for update data storage  */
    private $update = array();
    private $update_categories_i18n = array();
    private $update_order_products = array();

    /** DB tables names */
    private $categories_table = 'shop_category';
    private $products_table = 'shop_products';
    private $users_table = 'users';
    private $orders_table = 'shop_orders';
    private $orders_products_table = 'shop_orders_products';
    private $productivity_table = 'mod_exchangeunfu_productivity';
    private $partners_table = 'mod_exchangeunfu_partners';
    private $prices_table = 'mod_exchangeunfu_prices';
    private $product_variants_table = 'shop_product_variants';

    /** xml document for import */
    private $xml;

    /** object instance of ci */
    private $ci;

    /** contains default locale */
    private $locale;

    public function __construct() {
        $this->ci = &get_instance();
        $this->ci->load->helper('translit');
        $this->locale = 'ru';
    }

    public function index() {
        
    }

    public function getXML($file) {
        $this->xml = @new \SimpleXMLElement($file, FALSE, TRUE);

        return $this->xml;
    }

    /**
     * start import process
     * @return string "success" if success
     */
    public function import($file = 'export.xml') {
        $this->getXML($file);
//        $start = microtime(true);
        //load db data
        $this->prod = load_product();
        $this->cat = load_cat();
        $this->users = load_users();
        $this->orders = load_orders();
        $this->orders_products = load_orders_products();
        $this->products_i18n = load_products_i18n();
        $this->productivity = load_productivity();
        $this->partners = load_partners();
        $this->prices = load_prices();

        // Import users
        if (isset($this->xml->СписокКонтрагентов)) {
            $this->importUsers();
        }
        // Import categories
        if (isset($this->xml->СписокГруппНоменклатуры)) {
            $this->importCategories($this->xml->СписокГруппНоменклатуры);
        }
        // Import products
        if (isset($this->xml->СписокНоменклатуры)) {
            $this->importProducts();
        }

        //import partners
        if ($this->xml->СписокОрганизаций) {
            $this->importPartners();
        }
        //import prices
        if (isset($this->xml->СписокЦен)) {
            $this->importPrices();
        }

        //import orders
        if (isset($this->xml->СписокЗаказыПокупателя)) {
            $this->importOrders();
        }

        //import productivity
        if (isset($this->xml->СписокПродуктивность)) {
            $this->importProductivity();
        }

        echo "success";


//        $time = microtime(true) - $start;
//        echo '<br>';
//        printf('Скрипт выполнялся %.4F сек.', $time);
        exit();
    }

    /**
     * import products
     * @return boolean
     */
    public function importProducts() {
        $this->cat = load_cat();
        $insert_products_i18n = array();
        $insert_categories = array();
        $insert_product_variants = array();
        $insert_product_variants_i18n = array();

        $update_products_i18n = array();
        $update_product_variants = array();

        foreach ($this->xml->СписокНоменклатуры as $product) {
//            $searchedProduct = is_prod($product->ID, $this->prod);
            if (!isset($product->IDРодитель)) {
                continue;
            }

//            $is_product = is_prod((string) $product->ID, $this->prod);

            if (!(string) $product->IDWeb) {
                //product not found, should be inserted
                //preparing insert data for shop_products table
                $data = array();
                $data['external_id'] = $product->ID . "";

                $categ = is_cat($product->IDРодитель, $this->cat);
                if ($categ) {
                    $categoryId = $categ['id'];
                    $data['category_id'] = $categoryId;
                } else {
                    $data['category_id'] = 0;
                    $categoryId = 0;
                }


//                $data['category_id'] = 0;
                $data['active'] = false;
                $data['hit'] = false;
                $data['code'] = $product->Код . '';
                $data['measure'] = $product->ЕдиницаИзмерения . '';
                $data['barcode'] = $product->ШтрихКод . '';
                $data['brand_id'] = 0;
                $data['created'] = time();
                $data['updated'] = '';
                $data['old_price'] = '0.00';
                $data['views'] = 0;
                $data['hot'] = false;
                $data['action'] = false;
                $data['added_to_cart_count'] = 0;
                $data['enable_comments'] = true;

                if (in_array(translit_url($product->Наименование), $this->urls)) {
                    $data['url'] = translit_url($product->Наименование) . '-' . $product->Ид;
                } else {
                    $data['url'] = translit_url($product->Наименование);
//                    $this->urls[] .= $data['url'];
                }

                //inserting prepared data to shop_products table
                $this->insert[] = $data;

                //preparing data for shop_products_i18n table
                $data = array();
                $data['external_id'] = $product->ID . "";
                $data['locale'] = $this->locale;
                $data['name'] = $product->Наименование . "";
                $insert_products_i18n[] = $data;

                //preparing data for shop_products_categories
                $data = array();
                if ($categoryId) {
                    $data['external_id'] = $product->ID . "";
                    $data['category_id'] = $categoryId;
                    $insert_categories[] = $data;
                }

                //preparing insert data for shop_product_variants
                $data = array();
                $data['price'] = '0.00000';
                $data['external_id'] = $product->ID . "";
                $data['number'] = $product->Артикул . "";
                $data['stock'] = 0;
                $data['position'] = 0;
                $mainCurrencyId = $this->ci->db->select('id')->where('main', 1)->get('shop_currencies')->row_array();
                if (!empty($mainCurrencyId)) {
                    $mainCurrencyId = $mainCurrencyId['id'];
                }
                $data['currency'] = $mainCurrencyId;
                $data['price_in_main'] = '0.00000';
                $insert_product_variants[] = $data;

                //preparing insert data for shop_product_variants_i18n table
                $data = array();
                $data['external_id'] = $product->ID . "";
                $data['locale'] = $this->locale;
                $data['name'] = $product->Наименование . "";
                $insert_product_variants_i18n[] = $data;
            } else {
                //product found and should be updated
                //preparing update data for shop_products table
                $data = array();

                $data['code'] = $product->Код . '';
                $data['measure'] = $product->ЕдиницаИзмерения . '';
                $data['barcode'] = $product->ШтрихКод . '';

//                if (in_array(translit_url((string) $product->Наименование), $this->urls)) {
//                    $data['url'] = translit_url((string) $product->Наименование) . '-' . $product->Ид;
//                } else {
//                    $data['url'] = translit_url((string) $product->Наименование);
////                    $this->urls[] .= $data['url'];
//                }

                if (isset($product->IDРодитель)) {
                    $categ = is_cat($product->IDРодитель, $this->cat);
                    if ($categ) {
                        $categoryId = $categ['id'];
                        $data['category_id'] = $categoryId;
                    } else {
                        $data['category_id'] = 0;
                    }
                }

                $data['updated'] = time();
                $data['id'] = $product->IDWeb . '';
                $data['external_id'] = $product->ID . "";
                $this->update[] = $data;

                //preparing data for shop_products_i18n table
                $data = array();
                $data['name'] = $product->Наименование . "";
                $data['id'] = $product->IDWeb . '' ? $product->IDWeb . '' : $is_product['id'];
                $update_products_i18n[] = $data;

                //preparing data for shop_products_categories
                if ($categoryId) {
                    $data = array();
                    $data['product_id'] = $product->IDWeb . '';
                    $data['category_id'] = $categoryId;
                    if ($this->ci->db->where($data)->get('shop_product_categories')->num_rows() == 0) {
                        $data['external_id'] = $product->ID . "";
                        $insert_categories[] = $data;
                    }
                }

                //preparing update data for shop_product_variants
                $data = array();
                $data['number'] = $product->Артикул . "";
                $data['external_id'] = $product->ID . "";
                $data['product_id'] = $product->IDWeb . '';
                $update_product_variants[] = $data;
            }
        }

        //update products
        $this->updateData($this->products_table, 'id');
        //update products_i18n
        $this->update = $update_products_i18n;
        $this->updateData($this->products_table . "_i18n", 'id');
//        //update products_variants
        $this->update = $update_product_variants;
        $this->updateData($this->product_variants_table, 'product_id');
//        //insert products
        $this->insertData($this->products_table);
//
        $inserted_products = load_product();

        //prepare insert data
        foreach ($inserted_products as $id => $external_id) {
            foreach ($insert_products_i18n as $key => $product_i18n) {
                if ($product_i18n['external_id'] == $external_id) {
                    $insert_products_i18n[$key]['id'] = $id;
                    unset($insert_products_i18n[$key]['external_id']);
                }
            }

            foreach ($insert_categories as $key => $category) {
                if ($category['external_id'] == $external_id) {
                    $insert_categories[$key]['product_id'] = $id;
                    unset($insert_categories[$key]['external_id']);
                }
            }

            foreach ($insert_product_variants as $key => $variant) {
                if ($variant['external_id'] == $external_id) {
                    $insert_product_variants[$key]['product_id'] = $id;
                }
            }
        }
        //insert products_i18n
        $this->insert = $insert_products_i18n;
        $this->insertData($this->products_table . '_i18n');
//
//        //insert products_categories
        $this->insert = $insert_categories;
        $this->insertData('shop_product_categories');
//
//        //insert producs variants
        $this->insert = $insert_product_variants;
        $this->insertData($this->product_variants_table);

        $inserted_product_variants = $this->ci->db->get('shop_product_variants')->result_array();
//
//        //prepare insert data
        foreach ($inserted_product_variants as $value) {
            foreach ($insert_product_variants_i18n as $key => $variant_i18n) {
                if ($variant_i18n['external_id'] == $value['external_id']) {
                    $insert_product_variants_i18n[$key]['id'] = $value['id'];
                    unset($insert_product_variants_i18n[$key]['external_id']);
                }
            }
        }

//        //insert products_variants_i18n
        $this->insert = $insert_product_variants_i18n;
        $this->insertData($this->product_variants_table . '_i18n');
    }

    /**
     * import categories
     * @param array $categories
     * @param type $parent
     */
    public function importCategories($categories, $parent = null) {
        $categories_ext_id = array();
        foreach ($this->cat as $category) {
            $categories_ext_id[$category['external_id']] = $category['id'];
        }

        foreach ($categories as $category) {
//            $searchedCat = is_cat($category->ID, $this->cat);

            if ($category->IDWeb || $categories_ext_id[(string) $category->ID]) {
                $this->updateCategory($data, $parent, $category, $categories_ext_id[(string) $category->ID]);
            } else {
                $this->insertCategory($data, $parent, $category, $searchedCat);
            }
        }

        $insert = $this->insert;
        $update = $this->update;

        $this->insertData($this->categories_table);


        $inserted_categories = load_cat();

        foreach ($inserted_categories as $value) {
            foreach ($this->insert_categories_i18n as $key => $category_i18n) {
                if ($category_i18n['external_id'] == $value['external_id']) {
                    $this->insert_categories_i18n[$key]['id'] = $value['id'];
                    unset($this->insert_categories_i18n[$key]['external_id']);
                }
            }

            foreach ($this->cat as $category) {
                if ($category['external_id'] == $value['external_id']) {
                    $this->cat[$key]['id'] = $value['id'];
                }
            }
        }

        $this->insert = $this->insert_categories_i18n;
        $this->insertData('shop_category_i18n');

        $this->updateData($this->categories_table, 'id');

        $this->update = $this->update_categories_i18n;
        $this->updateData($this->categories_table . '_i18n', 'id');

        $this->updateCategoryFilds($insert);
        $this->updateCategoryFilds($update);
    }

    /**
     * insert category into db
     * @param array $data
     * @param type $parent
     * @param type $category
     * @param array $searchedCat
     */
    public function insertCategory($data = array(), $parent = null, $category, $searchedCat = array()) {

        //preparing data for insert
        $translit = translit_url($category->Наименование) . '';
        $data = array();
        $data['url'] = $translit;
        $data['external_id'] = $category->ID . "";
        $data['active'] = TRUE;
        $data['code'] = $category->Код . '';
        $data['parent_id'] = 0;
        $data['full_path_ids'] = array();

        //preparing full_path_ids, full_path, and parent ids
        if (isset($category->IDРодитель)) {
            $data['parent_id'] = $category->IDРодитель . '';
            $data['full_path'] = $this->categories_full_puth[$category->IDРодитель . ''];
            $data['full_path_ids'] = array($category->IDРодитель . '');

            $cat_by_ext = array();
            foreach ($this->cat as $cat) {
                $cat_by_ext[$cat[external_id]] = $cat;
            }
            $parent_ext = unserialize($cat_by_ext[$category->IDРодитель . '']['full_path_ids']);

            if (!$this->categories_full_puth_ids[$data['external_id']]) {
                $this->categories_full_puth_ids[$data['external_id']] = array();
            }

            $this->categories_full_puth_ids[$data['external_id']] = array_merge($this->categories_full_puth_ids[$data['external_id']], $parent_ext);
            $this->categories_full_puth_ids[$data['external_id']] = array_merge($this->categories_full_puth_ids[$data['external_id']], $data['full_path_ids']);

            if (strstr($this->categories_full_puth[$data['external_id']], $data['url'])) {
                $this->categories_full_puth[$data['external_id']] .= $data['full_path'];
            } else {
                $this->categories_full_puth[$data['external_id']] .= $data['full_path'] . '/' . $data['url'];
            }
            $this->category_parents[$data['external_id']] = $category->IDРодитель . '';
        } else {
            $this->categories_full_puth[$data['external_id']] = $data['url'];
            $this->categories_full_puth_ids[$data['external_id']] = array(0);
        }

        $data['full_path'] = $this->categories_full_puth[$data['external_id']];
        unset($data['full_path_ids']);
        $this->insert[] = $data;

        //preparing data for i18n table insert
        $i18n_data['external_id'] = $category->ID . "";
        $i18n_data['name'] = $category->Наименование . "";
        $i18n_data['locale'] = $this->locale;
        $this->insert_categories_i18n[] = $i18n_data;

        $this->cat[] = array(
            'external_id' => $category->ID . '',
            'full_path_ids' => $data['full_path_ids'],
            'full_path' => $data['full_path'],
            'url' => $data['url'],
            'parent_id' => $data['parent_id']
        );
    }

    /**
     * update category into db
     * @param array $data
     * @param type $parent
     * @param type $category
     * @param array $searchedCat
     */
    public function updateCategory($data = array(), $parent = null, $category, $searchedCat = array()) {
        //preparing data for update
        $translit = translit_url($category->Наименование) . '';
        $data = array();
        $data['id'] = (string) $user->IDWeb ? (string) $user->IDWeb : $id['id'];
        $data['id'] = $category->IDWeb . '' ? $category->IDWeb . '' : $searchedCat;
        $data['url'] = $translit;
        $data['active'] = TRUE;
        $data['code'] = $category->Код . '';
        $data['parent_id'] = 0;
        $data['external_id'] = $category->ID . '';

        //preparing full_path_ids, full_path, and parent ids
        if (isset($category->IDРодитель)) {
            $data['parent_id'] = $category->IDРодитель . '';
            $data['full_path'] = $this->categories_full_puth[$category->IDРодитель . ''];
            $data['full_path_ids'] = array($category->IDРодитель . '');

            $cat_by_ext = array();
            foreach ($this->cat as $cat) {
                $cat_by_ext[$cat[external_id]] = $cat;
            }
            $parent_ext = unserialize($cat_by_ext[$category->IDРодитель . '']['full_path_ids']);

            if (!$this->categories_full_puth_ids[$data['external_id']]) {
                $this->categories_full_puth_ids[$data['external_id']] = array();
            }

            $this->categories_full_puth_ids[$data['external_id']] = array_merge($this->categories_full_puth_ids[$data['external_id']], $parent_ext);
            $this->categories_full_puth_ids[$data['external_id']] = array_merge($this->categories_full_puth_ids[$data['external_id']], $data['full_path_ids']);

            if (strstr($this->categories_full_puth[$data['external_id']], $data['url'])) {
                $this->categories_full_puth[$data['external_id']] .= $data['full_path'];
            } else {
                $this->categories_full_puth[$data['external_id']] .= $data['full_path'] . '/' . $data['url'];
            }
            $this->category_parents[$data['external_id']] = $category->IDРодитель . '';
        } else {
            $this->categories_full_puth[$data['external_id']] = $data['url'];
            $this->categories_full_puth_ids[$data['external_id']] = array(0);
        }
//$this->categories_full_puth_ids[$data['external_id']] = array(0);
        $data['full_path'] = $this->categories_full_puth[$data['external_id']];
        unset($data['full_path_ids']);

        $this->update[] = $data;

        //preparing data for i18n table update
        $i18n_data['name'] = $category->Наименование . "";
        $i18n_data['id'] = $category->IDWeb . '';
        $this->update_categories_i18n[] = $i18n_data;
    }

    /**
     * update category full_path, full_path_ids and parent_id fields
     * @param array $insert
     */
    public function updateCategoryFilds($insert) {
        $cat_ids = load_cat_ids();
        foreach ($this->categories_full_puth_ids as $key => $category_full_puth_id) {
            foreach ($category_full_puth_id as $key1 => $ids) {
                if ($cat_ids[$ids]) {
                    $this->categories_full_puth_ids[$key][$key1] = (int) $cat_ids[$ids];
                }
            }
        }

        $parents = array();
        foreach ($this->category_parents as $key => $parent) {
            $parents[$key] = $cat_ids[$parent];
        }

        foreach ($insert as $key => $category) {
            if ($this->categories_full_puth_ids[$category['external_id']]) {
                $insert[$key]['full_path_ids'] = serialize($this->categories_full_puth_ids[$category['external_id']]);
            }
            if ($this->category_parents[$insert[$key]['external_id']]) {
                $insert[$key]['parent_id'] = $parents[$insert[$key]['external_id']];
            }
        }

        $this->update = $insert;
        $this->updateData($this->categories_table, 'external_id');
    }

    /**
     * import partners
     */
    public function importPartners() {
        foreach ($this->xml->СписокОрганизаций as $partner) {
            $data = array();
            $data['name'] = $partner->Наименование . '';
            $data['prefix'] = $partner->Префикс . '';
            $data['code'] = $partner->Код . '';
            $data['region'] = $partner->Регион . '';
            $data['external_id'] = $partner->ID . '';
            $partner_exsist = is_partner_code($data['code'], $this->partners);
            if (((string) $partner->IDWeb) || $partner_exsist) {
                $data['id'] = $partner->IDWeb . '' ? $partner->IDWeb . '' : $partner_exsist['id'];
                $this->update[] = $data;
            } else {
                $this->insert[] = $data;
            }
        }
        $this->insertData($this->partners_table);
        $this->updateData($this->partners_table, 'id');
    }

    /**
     * import prices
     * @return boolean
     */
    private function importPrices() {
        $this->prod = load_product();
        $this->partners = load_partners();
        $partners_external = array();

        foreach ($this->partners as $partner) {
            $partners_external[$partner['external_id']] = $partner['code'];
        }

        foreach ($this->xml->СписокЦен as $offer) {
            //prepare update data
            $data = array();
            $data['external_id'] = $offer->ID . '';
            $data['price'] = number_format((float) $offer->Цена, 2, '.', '');
            $data['action'] = (int) $offer->ЭтоАкционнаяЦена;
            if ($offer->IDWebНоменклатура . '') {
                $data['product_id'] = $offer->IDWebНоменклатура . '';
            } else {
                foreach ($this->prod as $key => $product) {
                    if ($product == $offer->IDНоменклатура . '') {
                        $data['product_id'] = $key;
                        break;
                    }
                }
            }

            $data['partner_external_id'] = $offer->IDОрганизация . '';

            if (!is_partner($data['partner_external_id'], $this->partners)) {
                return FALSE;
            }
            $data['partner_code'] = $partners_external[$data['partner_external_id']];

            $price_exist = is_price($data['external_id'], $this->prices);
            if ($offer->IDWeb || $price_exist) {
                $data['id'] = $offer->IDWeb . '' ? $offer->IDWeb . '' : $price_exist['id'];
                $this->update[] = $data;
            } else {
                $this->insert[] = $data;
            }
        }
        $this->insertData($this->prices_table);
        $this->updateData($this->prices_table, 'external_id');
    }

    /**
     * import users
     */
    public function importUsers() {
        foreach ($this->xml->СписокКонтрагентов as $user) {
            $data = array();

            $data['username'] = $user->Наименование . '';
            if ($user->Пароль . '') {
                $data['password'] = $user->Пароль . '';
            }

            if ($user->Емейл . '') {
                $data['email'] = $user->Емейл . '';
            }

            $data['phone'] = $user->Телефон . '';
            $data['code'] = $user->Код . '';
            $data['address'] = $user->Адрес . '';
            $data['external_id'] = $user->ID . '';

            if ((string) $user->IDWeb != '') {
                $data['id'] = (string) $user->IDWeb;
                $this->update[] = $data;
            } else {
                $this->insert[] = $data;
            }
        }

        $this->insertData($this->users_table);
        $this->updateData($this->users_table, 'id');
    }

    /**
     * import orders
     * @return boolean
     */
    public function importOrders() {
        $this->users = load_users();
        $this->products_i18n = load_products_i18n();
        if (isset($this->xml->СписокРасходныеНакладные)) {
            $statuses = array();
            foreach ($this->xml->СписокРасходныеНакладные as $status) {
                if ($status->IDЗаказПокупателя . '') {
                    $statuses[$status->IDЗаказПокупателя . ''] = array(
                        'id' => $status->ID . '',
                        'code' => $status->Номер . '',
                        'date' => strtotime($status->Дата . '')
                    );
                }
            }
        }

        foreach ($this->xml->СписокЗаказыПокупателя as $order) {
            $data = array();
            $data['date_created'] = strtotime($order->Дата . '');
            $data['user_deliver_to'] = $order->Адрес . '';
            $data['user_phone'] = $order->КонтактныйТелефон . '';
            $data['paid'] = (int) $order->ПризнакПередоплаты;
            $data['external_id'] = $order->ID . '';
            $data['code'] = $order->Номер . '';
            $data['delivery_date'] = strtotime($order->СрокДоставки . '');
            $data['partner_external_id'] = $order->IDОрганизация . '';

            $data['status'] = 1;
            if ($statuses[$data['external_id']]) {
                $data['status'] = 2;
                $data['invoice_external_id'] = $statuses[$data['external_id']]['id'];
                $data['invoice_code'] = $statuses[$data['external_id']]['code'];
                $data['invoice_date'] = $statuses[$data['external_id']]['date'];
            }

            $user = is_user($order->IDКонтрагент, $this->users);

            if ($user) {
                $userInfo = $this->ci->db
                        ->where('id', $user['id'])
                        ->get('users')
                        ->row_array();
                $data['user_id'] = $user['id'];
                $data['user_full_name'] = $userInfo['username'];
                $data['user_email'] = $userInfo['email'];
            } else {
                return;
            }
            $order_exist = is_order($data['external_id'], $this->orders);

            if ((string) $order->IDWeb) {
                $data['id'] = (string) $order->IDWeb . '' ? (string) $order->IDWeb . '' : $order_exist['id'];

                foreach ($this->xml->СписокРасходныеНакладные as $status) {
                    if ((string) $status->IDЗаказПокупателя == $order->ID) {
                        $this->updateOrder($status, $data);
//                        var_dumps($status);
                        break;
                    }
                }

//                $this->updateOrder($order, $data);
            } else {
                $this->insertOrder($order, $data);
            }
        }

        $this->insertData($this->orders_table);
        $this->updateData($this->orders_table, 'id');

        $inserted_orders = load_orders();

        foreach ($inserted_orders as $value) {
            foreach ($this->insert_order_products as $key => $order_product) {
                if ($order_product['external_order_id'] == $value['external_id'] && $order_product['external_order_id'] != NULL) {
                    $this->insert_order_products[$key]['order_id'] = $value['id'];
                    unset($this->insert_order_products[$key]['external_order_id']);
                }
            }
        }
        $this->insert = $this->insert_order_products;
        $this->insertData($this->orders_products_table);

        $this->updateData($this->orders_table, 'id');

        $this->update = $this->update_order_products;
        $this->updateData($this->orders_products_table, 'id');
    }

    /**
     * insert orders into db
     * @param object $order
     * @param array $data
     * @return boolean
     */
    public function insertOrder($order, $data) {
        $total_price = 0;
        $this->insert[] = $data;

        if (isset($order->Строки)) {
            foreach ($order->Строки as $product) {
                $data = array();
                $data['external_order_id'] = $order->ID . '';
                $data['quantity'] = $product->Количество . '';
                $data['price'] = $product->Цена . '';
                $data['external_id'] = $product->IDДокумента . '';

                $product_i18n = is_product_i18n($product->IDWebНоменклатура . '', $this->products_i18n);
                if ($product_i18n) {
                    $data['product_id'] = $product_i18n['id'];
                    $data['product_name'] = $product_i18n['name'];
                    $data['variant_name'] = $product_i18n['name'];
                    $data['variant_id'] = $product_i18n['varId'];
                } else {
                    return false;
                }
                $this->insert_order_products[] = $data;

                $total_price += (int) $product->Сумма;
            }

            //update order total price
            $data = array();
            $data['total_price'] = $total_price;
            $data['external_id'] = $order->ID . '';
            $this->update[] = $data;
        }
    }

    /**
     * update order into db
     * @param object $order
     * @param array $data
     * @return boolean
     */
    public function updateOrder($order, $data) {
        $total_price = 0;
        $this->update[] = $data;
        if (isset($order->IDЗаказПокупателя)) {
            $order_id['external_id'] = (string) $order->IDЗаказПокупателя;
            $order_id['id'] = (string) $order->IDWebЗаказПокупателя;
        } else {
            $order_id['external_id'] = (string) $order->ID;
            $order_id['id'] = (string) $order->IDWeb;
        }
        if (isset($order->Строки)) {
            $this->ci->db->where('order_id', $order_id['id'])->delete('shop_orders_products');
            foreach ($order->Строки as $key => $product) {
                $data = array();
                $data['quantity'] = (int) $product->Количество;
                $data['price'] = (float) $product->Цена;
                $data['external_id'] = $product->IDДокумента . '';
                $product_i18n = is_product_i18n($product->IDWebНоменклатура . '', $this->products_i18n);
                if ($product_i18n) {
                    $data['product_id'] = $product_i18n['id'];
                    $data['product_name'] = $product_i18n['name'];
                    $data['variant_name'] = $product_i18n['name'];
                    $data['variant_id'] = $product_i18n['varId'];
                } else {
                    return false;
                }

//                if (is_orders_product($product->IDWebДокумента . '', $this->orders_products, $product_i18n['id'])) {
//                    $data['id'] = $product->IDWebДокумента . '';
//                    $this->update_order_products[] = $data;
//                } else {
                $data['order_id'] = $order_id['id'];
                $data['external_order_id'] = $order_id['external_id'];
                $data['external_id'] = $product->IDДокумента . '';
                $this->insert_order_products[] = $data;
//                }

                $total_price += (int) $product->Сумма;
            }
            //update order total price
            $data = array();
            $data['total_price'] = $total_price;
            $data['external_id'] = $order->ID . '';
            $data['id'] = $order_id['id'];
            $this->update[] = $data;
        }
    }

    /**
     * import productivity
     * @return boolean
     */
    public function importProductivity() {
        foreach ($this->xml->СписокПродуктивность as $productivity) {
            $data = array();
            $data['external_id'] = $productivity->ID . '';
            $data['date'] = strtotime($productivity->Дата . '');
            $data['hour'] = $productivity->Час . '';
            $data['count'] = (int) $productivity->Количество;
            $data['partner_external_id'] = $productivity->IDОрганизация . '';

            if (is_partner($data['partner_external_id'], $this->partners)) {
                $is_productivity = is_productivity($data['external_id'], $data['partner_external_id'], $this->productivity);
                if ($productivity->IDWeb || $is_productivity) {
                    $data['id'] = $productivity->IDWeb . '' ? $productivity->IDWeb . '' : $is_productivity['id'];
                    $this->update[] = $data;
                } else {
                    $this->insert[] = $data;
                }
            } else {
                return false;
            }
        }

        $this->insertData($this->productivity_table);
        $this->updateData($this->productivity_table, 'id');
    }

    /**
     * insert data into db tables
     * @param string $table
     * @return boolean
     */
    private function insertData($table) {
        if (!empty($this->insert)) {
            $result = $this->ci->db->insert_batch($table, $this->insert);
            $this->insert = array();

            if (!$result && !empty($this->insert)) {
                echo 'Ошибка при вставке данных в таблицу: ' . $table . ' !!!';
                exit();
            }

            return $result;
        }
    }

    /**
     * update data into db tables
     * @param string $table
     * @param string $where - where condition, can contains only one column name
     * @return boolean
     */
    private function updateData($table, $where = '') {
        if (!empty($this->update)) {
            $result = $this->ci->db->update_batch($table, $this->update, $where);
            $this->update = array();

            if (!$result && !empty($this->update)) {
                echo 'Ошибка при обновлении данных в таблице: ' . $table . ' !!!';
                exit();
            }

            return $result;
        }
    }

}

/* End of file sample_module.php */