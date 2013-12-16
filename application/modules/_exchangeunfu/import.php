<?php

namespace exchangeunfu;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Import {

    /**
     * Path to upload dir
     * @var string
     */
    private $pass = './application/modules/exchangeunfu/';
    
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
        $this->xml = simplexml_load_file($this->pass . 'export.xml');
        $this->ci = &get_instance();
        $this->locale = 'ru';
    }

    public function index() {
//        $xml = simplexml_load_file($this->pass . 'export.xml');
    }

    /**
     * start import process
     * @return string "success" if success
     */
    public function import() {
        $start = microtime(true);

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
        if (isset($this->xml->СписокНоменклатуры)) {
            $this->importCategories($this->xml->СписокНоменклатуры);
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
        

        $time = microtime(true) - $start;
        printf('Скрипт выполнялся %.4F сек.', $time);
        exit();
    }

    /**
     * import products
     * @return boolean
     */
    public function importProducts() {
        $insert_products_i18n = array();
        $insert_categories = array();
        $insert_product_variants = array();
        $insert_product_variants_i18n = array();

        $update_products_i18n = array();
        $update_product_variants = array();

        foreach ($this->xml->СписокНоменклатуры as $product) {
            if ($product->ЭтоГруппа == 'false') {
                $searchedProduct = is_prod($product->ID, $this->prod);

                if (!$searchedProduct) {
                    //product not found, should be inserted
                    //preparing insert data for shop_products table
                    $data = array();
                    $data['external_id'] = $product->ID . "";

                    if (isset($product->IDРодитель)) {
                        $categ = is_cat($product->IDРодитель, $this->cat);
                        if ($categ)
                            $categoryId = $categ['id'];
                        else
                            return false;
                        $data['category_id'] = $categoryId;
                    }

                    if ($product->Статус == 'Удален')
                        $data['active'] = false;
                    else
                        $data['active'] = true;

                    $data['hit'] = false;
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
                        $this->urls[] .= $data['url'];
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
                    $data['number'] = $product->Код . "";
                    $data['stock'] = 0;
                    $data['position'] = 0;
                    $mainCurrencyId = $this->ci->db->select('id')->where('main', 1)->get('shop_currencies')->row_array();
                    if (!empty($mainCurrencyId))
                        $mainCurrencyId = $mainCurrencyId['id'];
                    $data['currency'] = $mainCurrencyId;
                    $data['price_in_main'] = '0.00000';
                    $insert_product_variants[] = $data;

                    //preparing insert data for shop_product_variants_i18n table
                    $data = array();
                    $data['external_id'] = $product->ID . "";
                    $data['locale'] = $this->locale;
                    $data['name'] = '';
                    $insert_product_variants_i18n[] = $data;
                } else {
                    //product found and should be updated
                    //preparing update data for shop_products table
                    $data = array();

                    if (isset($product->IDРодитель)) {
                        $categ = is_cat($product->IDРодитель, $this->cat);
                        if ($categ)
                            $categoryId = $categ['id'];
                        else
                            return false;
                        $data['category_id'] = $categoryId;
                    }
                    $data['updated'] = time();
                    $data['id'] = $searchedProduct['id'];
                    $this->update[] = $data;

                    //preparing data for shop_products_i18n table
                    $data = array();
                    $data['name'] = $product->Наименование . "";
                    $data['id'] = $searchedProduct['id'];
                    $update_products_i18n[] = $data;

                    //preparing data for shop_products_categories
                    if ($categoryId) {
                        $data = array();
                        $data['product_id'] = $searchedProduct['id'];
                        $data['category_id'] = $categoryId;
                        if ($this->ci->db->where($data)->get('shop_product_categories')->num_rows() == 0) {
                            $data['external_id'] = $product->ID . "";
                            $insert_categories[] = $data;
                        }
                    }

                    //preparing update data for shop_product_variants
                    $data = array();
                    $data['number'] = $product->Код . "";
                    $data['external_id'] = $product->ID . "";
                    $data['product_id'] = $searchedProduct['id'];
                    $update_product_variants[] = $data;
                }
            }
        }

        //update products
        $this->updateData($this->products_table, 'id');
        //update products_i18n
        $this->update = $update_products_i18n;
        $this->updateData($this->products_table . "_i18n", 'id');
        //update products_variants
        $this->update = $update_product_variants;
        $this->updateData($this->product_variants_table, 'product_id');

        //insert products
        $this->insertData($this->products_table);

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

        //insert products_categories
        $this->insert = $insert_categories;
        $this->insertData('shop_product_categories');

        //insert producs variants
        $this->insert = $insert_product_variants;
        $this->insertData($this->product_variants_table);

        $inserted_product_variants = $this->ci->db->get('shop_product_variants')->result_array();

        //prepare insert data
        foreach ($inserted_product_variants as $value) {
            foreach ($insert_product_variants_i18n as $key => $variant_i18n) {
                if ($variant_i18n['external_id'] == $value['external_id']) {
                    $insert_product_variants_i18n[$key]['id'] = $value['id'];
                    unset($insert_product_variants_i18n[$key]['external_id']);
                }
            }
        }

        //insert products_variants_i18n
        $this->insert = $insert_product_variants_i18n;
        $this->insertData($this->product_variants_table . '_i18n');
    }

    /**
     * import categories
     * @param array $categories
     * @param type $parent
     */
    public function importCategories($categories, $parent = null) {
        foreach ($categories as $category) {
            if ($category->ЭтоГруппа == 'true') {
                $searchedCat = is_cat($category->ID, $this->cat);

                if (!$searchedCat) {
                    $this->insertCategory($data, $parent, $category, $searchedCat);
                } else {
                    $this->updateCategory($data, $parent, $category, $searchedCat);
                }
//                if (isset($category->IDРодитель)) {
//
//                    //$parent_cat брати з масиву
//                    $parentCat = is_cat($category->ID, $this->cat);
//                    //$this->ci->db->select("id, url, full_path, full_path_ids")->where('external_id', $category->Ид . "")->get($this->categories_table)->row_array();
//                    $this->importCategories($category->IDРодитель, $parentCat);
//                }
            }
        }
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

        $this->updateData($this->categories_table, 'external_id');

        $this->update = $this->update_categories_i18n;
        $this->updateData($this->categories_table . '_i18n', 'id');
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
        if (!$parent) {
            $data['parent_id'] = 0;
            $data['full_path'] = $translit;
            $ids = array();
            $data['full_path_ids'] = serialize($ids);
        } else {
            $data['parent_id'] = $parent['id'];
            $data['full_path'] = $parent['full_path'] . "/" . $translit;
        }
        $this->insert[] = $data;

        //update full path ids if have parent
//        if ($parent) {
//            $data['full_path_ids'] = unserialize($parent['full_path_ids']);
//            if (empty($data['full_path_ids']))
//                $data['full_path_ids'] = array((int) $parent['id']);
//            else {
//                $data['full_path_ids'][] = (int) $parent['id'];
//            }
//            $this->ci->db
//                    ->where('id', $insert_id)
//                    ->update($this->categories_table, array('full_path_ids' => serialize($data['full_path_ids'])));
//        }
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
        $data['url'] = $translit;
        $data['active'] = TRUE;
        $data['external_id'] = $searchedCat['external_id'];
        if (!$parent) {
            $data['parent_id'] = 0;
            $data['full_path'] = $translit;
            $ids = array();
            $data['full_path_ids'] = serialize($ids);
        } else {
            $data['parent_id'] = $parent['id'];
            $data['full_path'] = $parent['full_path'] . "/" . $translit;
        }
        $this->update[] = $data;

        //preparing data for i18n table update
        $i18n_data['name'] = $category->Наименование . "";
        $i18n_data['id'] = $searchedCat['id'];
        $this->update_categories_i18n[] = $i18n_data;

        //update full path ids if have parent
//        if ($parent) {
//            $data['full_path_ids'] = unserialize($parent['full_path_ids']);
//            if (empty($data['full_path_ids']))
//                $data['full_path_ids'] = array($searchedCat['id']);
//            else {
//                $data['full_path_ids'][] = $searchedCat['id'];
//            }
//            $this->ci->db
//                    ->where('id', $searchedCat['id'])
//                    ->update($this->categories_table, array('full_path_ids' => serialize($data['full_path_ids'])));
//        }
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
            $data['external_id'] = $partner->ID . '';

            if (is_partner($data['external_id'], $this->partners)) {
                $this->update[] = $data;
            } else {
                $this->insert[] = $data;
            }

            $this->insertData($this->partners_table);
            $this->updateData($this->partners_table, 'external_id');
        }
    }

    /**
     * import prices
     * @return boolean
     */
    private function importPrices() {
        $this->prod = load_product();
        $this->partners = load_partners();
         
        foreach ($this->xml->СписокЦен as $offer) {
            //prepare update data
            $data = array();
            $data['price'] = (float) $offer->Цена;
            $data['action'] = (int) $offer->ЭтоАкционнаяЦена;
            $data['product_external_id'] = $offer->IDНоменклатура . '';
            $data['partner_external_id'] = $offer->IDОрганизация . '';

            if (!is_prod($data['product_external_id'], $this->prod)) {
                return FALSE;
            }

            if (!is_partner($data['partner_external_id'], $this->partners)) {
                return FALSE;
            }

            if (is_price($data, $this->prices)) {
                $this->ci->db->where('product_external_id', $data['product_external_id'])
                        ->where('partner_external_id', $data['partner_external_id'])
                        ->update($this->prices_table, $data);
            } else {
                $this->ci->db->insert($this->prices_table, $data);
            }
        }
    }

    /**
     * import users
     */
    public function importUsers() {
        foreach ($this->xml->СписокКонтрагентов as $user) {
            $data = array();
            $data['username'] = $user->Наименование . '';
            $data['password'] = $user->Пароль . '';
            $data['email'] = $user->Емейл . '';
            $data['phone'] = $user->Телефон . '';
            $data['address'] = $user->Адрес . '';
            $data['external_id'] = $user->ID . '';

            if (!is_user($user->ID, $this->users)) {
                $this->insert[] = $data;
            } else {
                $this->update[] = $data;
            }
        }

        $this->insertData($this->users_table);
        $this->updateData($this->users_table, 'external_id');
    }

    /**
     * import orders
     * @return boolean
     */
    public function importOrders() {
        $this->users = load_users();
        $this->products_i18n = load_products_i18n();
        
        foreach ($this->xml->СписокЗаказыПокупателя as $order) {
            $data = array();
            $data['date_created'] = strtotime($order->Дата . '');
            $data['user_deliver_to'] = $order->Адрес . '';
            $data['user_phone'] = $order->КонтактныйТелефон . '';
            $data['paid'] = (int) $order->ПризнакПередоплаты;
            $data['external_id'] = $order->ID . '';
            $data['partner_external_id'] = $order->IDОрганизация . '';
            
            $user = is_user($order->IDКонтрагент, $this->users);
            if ($user) {
                $data['user_id'] = $user['id'];
            } else {
                return false;
            }

            if (!is_order($order->ID, $this->orders)) {
                $this->insertOrder($order, $data);
            } else {
                $this->updateOrder($order, $data);
            }
        }
        
        $this->insertData($this->orders_table);

        $inserted_orders = load_orders();

        foreach ($inserted_orders as $value) {
            foreach ($this->insert_order_products as $key => $order_product) {
                if ($order_product['external_order_id'] == $value['external_id']) {
                    $this->insert_order_products[$key]['order_id'] = $value['id'];
                    unset($this->insert_order_products[$key]['external_order_id']);
                }
            }
        }
        
        $this->insert = $this->insert_order_products;
        $this->insertData($this->orders_products_table);
        
        $this->updateData($this->orders_table, 'external_id');
        
        $this->update = $this->update_order_products;
        $this->updateData($this->orders_products_table, 'external_id');
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

                $product_i18n = is_product_i18n($product->IDНоменклатура . '', $this->products_i18n);
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
    
        $order_id = is_order($order->ID . '', $this->orders);
        if (isset($order->Строки)) {
            foreach ($order->Строки as $product) {
                $data = array();
                $data['quantity'] = (int) $product->Количество;
                $data['price'] = (float) $product->Цена;
                $data['external_id'] = $product->IDДокумента . '';
                $product_i18n = is_product_i18n($product->IDНоменклатура . '', $this->products_i18n);
                if ($product_i18n) {
                    $data['product_id'] = $product_i18n['id'];
                    $data['product_name'] = $product_i18n['name'];
                    $data['variant_name'] = $product_i18n['name'];
                    $data['variant_id'] = $product_i18n['varId'];
                } else {
                    return false;
                }

                if (is_orders_product($product->IDДокумента . '', $this->orders_products)) {
                    $this->update_order_products[] = $data;
                } else {
                    $data['order_id'] = $order_id['id'];
                    $data['external_id'] = $product->IDДокумента . '';
                    $this->insert_order_products[] = $data;
                }

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
     * import productivity
     * @return boolean
     */
    public function importProductivity() {
        foreach ($this->xml->СписокПродуктивность as $productivity) {
            $data = array();
            $data['date'] = strtotime($productivity->Дата . '');
            $data['hour'] = $productivity->Час . '';
            $data['count'] = (int) $productivity->Количество;
            $data['partner_external_id'] = $productivity->IDОрганизация . '';

            if (is_partner($data['partner_external_id'], $this->partners)) {
                if (is_productivity($data, $this->productivity)) {
                    $this->update[] = $data;
                } else {
                    $this->insert[] = $data;
                }
            } else {
                return false;
            }
        }

        $this->insertData($this->productivity_table);
//        $this->updateData($this->productivity_table, '');
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

            return $result;
        }
    }

}

/* End of file sample_module.php */