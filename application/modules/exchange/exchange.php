<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс exchange
 */
class Exchange {

//class Exchange extends MY_Controller {

    private $config = array();
    private $ci;
    private $tempDir;
    private $locale;
    private $categories_table = 'shop_category';
    private $properties_table = 'shop_product_properties';
    private $products_table = 'shop_products';
    private $product_variants_table = 'shop_product_variants';
    private $settings_table = 'components';

    public function __construct() {
        $this->ci = &get_instance();
        set_time_limit(0);
        $this->ci->load->helper('translit');
        //$this->locale = getDefaultLanguage();
        $this->locale = BaseAdminController::getCurrentLocale();
        $this->locale = $this->locale['identif'];

        if (!$this->get1CSettings()) {
            //default settings
            $this->config['zip'] = 'no';
            $this->config['filesize'] = 2048000;
            $this->config['validIP'] = '127.0.0.1';
            $this->config['password'] = '';
            $this->config['usepassword'] = false;
            $this->config['userstatuses'] = array();
            $this->config['autoresize'] = 'On';
        } else {
            $this->config = $this->get1CSettings();
        }

        $this->tempDir = PUBPATH . 'application/modules/shop/cmlTemp/';
        $method = 'command_';
        if ($_GET) {
            foreach ($_GET as $key => $value) {
                $string .= date('c') . " GET - " . $key . ": " . $value . "\n";
            }
            write_file($this->tempDir . "log.txt", $string, 'ab');
        }
        if (isset($_GET['type']) && isset($_GET['mode']))
            $method .= strtolower($_GET['type']) . '_' . strtolower($_GET['mode']);
        if (method_exists($this, $method))
            $this->$method();
    }

    /**
     * Use this function to make backup before import starts
     */
    protected function makeDBBackup() {
        if (is_really_writable('./application/backups')) {
            $this->load->dbutil();
            $backup = & $this->dbutil->backup(array('format' => 'zip'));
            write_file('./application/backups/' . "sql_" . date("d-m-Y_H.i.s.") . 'zip', $backup);
        }
    }

    private function get1CSettings() {
        $config = $this->ci->db->where('identif', 'exchange')->get('components')->row_array();
        if (empty($config))
            return false;
        else
            return unserialize($config['settings']);
    }

    function _install() {
        if (is_array($this->config)) {
            $for_insert = serialize($this->config);
            $this->ci->db->where('identif', 'exchange')->update($this->settings_table, array('settings' => $for_insert));
        }
    }

    function __autoload() {
        return;
    }

    private function check_password() {
        if (isset($_GET['password']) && ($this->config['password'] == $_GET['password'])) {
            $this->checkauth();
        } else {
            echo "failure. wrong password";
        }
    }

    private function command_catalog_checkauth() {
        if ($this->config['usepassword'] == 'on') {
            $this->check_password();
        } else {
            $this->checkauth();
        }
        exit();
    }

    private function checkauth() {
        echo "success\n";
        echo session_name() . "\n";
        echo session_id() . "\n";
        $string = md5(session_id());
        write_file($this->tempDir . "session.txt", $string, 'w');
        if (file_exists($this->tempDir . 'import.xml'))
            unlink($this->tempDir . 'import.xml');
        if (file_exists($this->tempDir . 'offers.xml'))
            unlink($this->tempDir . 'offers.xml');
    }

    private function check_perm() {
        $string = read_file($this->tempDir . 'session.txt');
        if (md5(session_id()) == $string) {
            return true;
        } else {
            die("Ошибка безопасности!!!");
        }
    }

    private function command_catalog_init() {
        if ($this->check_perm() === true) {
            echo "zip=" . $this->config['zip'] . "\n";
            echo "file_limit=" . $this->config['filesize'] . "\n";
        }
        exit();
    }

    private function command_catalog_file() {
        if ($this->check_perm() === true) {
            $st = $_GET['filename'];
            $st = basename($st);
            if (strrchr($st, "/"))
                $st = strrchr($st, "/");
            $filename = explode('.', $st);
            if ($filename[1] != 'xml') {
                //saving images to cmlTemp/images folder
                if (write_file($this->tempDir . "images/" . basename($st, $filename[1]) . "jpg", file_get_contents('php://input'), 'wb')) {
                    echo "success";
                }
            } else {
                //saving xml files to cmlTemp
                if (write_file($this->tempDir . $_GET['filename'], file_get_contents('php://input'), 'a+')) {
                    echo "success";
                }
            }
        }
        exit();
    }

    private function _readXmlFile($filename) {
        if (file_exists($this->tempDir . $filename) && is_file($this->tempDir . $filename))
            return simplexml_load_file($this->tempDir . $filename);
        return false;
    }

    private function command_catalog_import() {

        if ($this->check_perm() === true) {
            echo "start:" . memory_get_usage() . "</br>";
            $this->xml = $this->_readXmlFile($_GET['filename']);
            if (!$this->xml)
                return "failure";

            // Import categories
            if (isset($this->xml->Классификатор->Группы)) {
                $this->importCategories($this->xml->Классификатор->Группы);
            }
            // Import properties
            if (isset($this->xml->Классификатор->Свойства)) {
                $this->importProperties();
            }
            //import products
            if (isset($this->xml->Каталог->Товары)) {
                $this->importProducts();
            }

            //import prices
            if (isset($this->xml->ПакетПредложений->Предложения)) {
                $this->importPrices();
            }

            //auto resize images if option is on
            if ($this->config['autoresize'] == 'on')
                $this->startImagesResize();

            if (file_exists($this->tempDir . "success_" . ShopCore::$_GET['filename'])) {
                unlink($this->tempDir . "success_" . ShopCore::$_GET['filename']);
            }
            rename($this->tempDir . ShopCore::$_GET['filename'], $this->tempDir . "success_" . ShopCore::$_GET['filename']);

            echo "success";
        }
        exit();
    }

    private function importCategories($data, $parent = null) {
        foreach ($data->Группа as $category) {
            //search category by external id
            $searchedCat = array();
            $searchedCat = $this->ci->db->select("id, external_id")->where('external_id', $category->Ид . "")->get('shop_category')->row_array();

            if (empty($searchedCat)) {
                //category not found, it should be inserted
                $translit = '';
                $translit = translit_url($category->Наименование);
                //preparing data for insert
                $data = array();
                $data['url'] = $translit;
                $data['external_id'] = $category->Ид . "";
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
                $insert_id = null;
                $this->ci->db->insert('shop_category', $data);
                $insert_id = $this->ci->db->insert_id();


                //update full path ids if have parent
                if ($parent) {
                    $data['full_path_ids'] = unserialize($parent['full_path_ids']);
                    if (empty($data['full_path_ids']))
                        $data['full_path_ids'] = array((int) $parent['id']);
                    else {
                        $data['full_path_ids'][] = (int) $parent['id'];
                    }
                    $this->ci->db->where('id', $insert_id)->update('shop_category', array('full_path_ids' => serialize($data['full_path_ids'])));
                }

                //preparing data for i18n table insert
                $i18n_data['id'] = $insert_id;
                $i18n_data['name'] = $category->Наименование . "";
                $i18n_data['locale'] = $this->locale;

                //inserting data to i18n table
                $this->ci->db->insert('shop_category_i18n', $i18n_data);
            } else {
                //category found - we'll update it
                $translit = '';
                $translit = translit_url($category->Наименование);
                //preparing data for update
                $data = array();
                $data['url'] = $translit;
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
                $this->ci->db->where('external_id', $searchedCat['external_id'])->update('shop_category', $data);

                //preparing data for i18n table update
                $i18n_data['name'] = $category->Наименование . "";

                //update data in i18n table
                $this->ci->db->where('id', $searchedCat['id'])->update('shop_category_i18n', $i18n_data);

                //update full path ids if have parent
                if ($parent) {
                    $data['full_path_ids'] = unserialize($parent['full_path_ids']);
                    if (empty($data['full_path_ids']))
                        $data['full_path_ids'] = array($searchedCat['id']);
                    else {
                        $data['full_path_ids'][] = $searchedCat['id'];
                    }
                    $this->ci->db->where('id', $searchedCat['id'])->update('shop_category', array('full_path_ids' => serialize($data['full_path_ids'])));
                }
            }
            //process subcategories
            if (isset($category->Группы)) {
                $parentCat = $this->ci->db->select("id, url, full_path, full_path_ids")->where('external_id', $category->Ид . "")->get('shop_category')->row_array();
                $this->importCategories($category->Группы, $parentCat);
            }
        }
    }

    private function importProperties() {
        if (isset($this->xml->Классификатор->Свойства->СвойствоНоменклатуры))
            $properties = $this->xml->Классификатор->Свойства->СвойствоНоменклатуры;
        elseif (isset($this->xml->Классификатор->Свойства->Свойство))
            $properties = $this->xml->Классификатор->Свойства->Свойство;
        foreach ($properties as $property) {
            //searching property by external id
            $searchedProperty = $this->ci->db->select('id, external_id')->where('external_id', $property->Ид . "")->get('shop_product_properties')->row_array();
            if (empty($searchedProperty)) {
                //property not found, it should be inserted
                //preparing insert data array
                $data = array();
                $data['external_id'] = $property->Ид . "";
                $data['csv_name'] = translit_url($property->Наименование);
                if ($property->Обязательное . "" == 'true')
                    $data['main_property'] = true;
                elseif ($property->Обязательное . "" == 'false')
                    $data['main_property'] = false;
                if ($property->Множественное . "" == 'true')
                    $data['multiple'] = true;
                elseif ($property->Множественное . "" == 'false')
                    $data['multiple'] = false;
                if ($property->ИспользованиеСвойства . "" == 'true')
                    $data['active'] = true;
                elseif ($property->ИспользованиеСвойства . "" == 'false')
                    $data['active'] = false;
                $data['show_in_compare'] = false;
                $data['show_on_site'] = true;
                $data['show_in_filter'] = false;
                //insert new property to properties table
                $this->ci->db->insert($this->properties_table, $data);

                $insert_id = null;
                $insert_id = $this->ci->db->insert_id();

                //preparing data for insert to i18n table
                $i18n_data = array();
                $i18n_data['id'] = $insert_id;
                $i18n_data['name'] = $property->Наименование . "";
                $i18n_data['locale'] = $this->locale;
                $i18n_data['data'] = '';

                //inserting data to i18n table
                $this->ci->db->insert($this->properties_table . "_i18n", $i18n_data);
            } else {
                //property found, it sould be updated
                //preparing data for update
                $data = array();
                $data['csv_name'] = translit_url($property->Наименование);
                if ($property->Обязательное . "" == 'true')
                    $data['main_property'] = true;
                elseif ($property->Обязательное . "" == 'false')
                    $data['main_property'] = false;
                if ($property->Множественное . "" == 'true')
                    $data['multiple'] = true;
                elseif ($property->Множественное . "" == 'false')
                    $data['multiple'] = false;
                if ($property->ИспользованиеСвойства . "" == 'true')
                    $data['active'] = true;
                elseif ($property->ИспользованиеСвойства . "" == 'false')
                    $data['active'] = false;

                //updating property
                $this->ci->db->where(array('id' => $searchedProperty['id'], 'external_id' => $searchedProperty['external_id']))->update($this->properties_table, $data);

                //preparing update data for i18n table
                $i18n_data = array();
                $i18n_data['name'] = $property->Наименование . "";

                //updating i18n property table
                $this->ci->db->where(array('id' => $searchedProperty['id'], 'locale' => $this->locale))->update($this->properties_table . "_i18n", $i18n_data);
            }
        }
    }

    private function importProducts() {
        //property data array for serialize and unserialize
        $temp_properties = $this->ci->db->select('id, data')->where('locale', $this->locale)->get('shop_product_properties_i18n')->result_array();
        if (is_array($temp_properties)) {
            foreach ($temp_properties as $key => $item) {
                $properties_data[$item['id']] = unserialize($item['data']);
            }
        }
        unset($temp_properties);

        foreach ($this->xml->Каталог->Товары->Товар as $product) {
            $searchedProduct = array();

            //search product by external id
            $searchedProduct = $this->ci->db->select('id')->where('external_id', $product->Ид . "")->get($this->products_table)->row_array();
            if (empty($searchedProduct)) {

                //product not found, should be inserted
                //preparing insert data for shop_products table
                $data = array();
                $data['external_id'] = $product->Ид . "";

                //check if product belongs to any category
                if (isset($product->Группы)) {
                    $categoryId = $this->ci->db->select('id')->where('external_id', $product->Группы->Ид . "")->get($this->categories_table)->row_array();
                    if (empty($categoryId))
                        return false;
                    $categoryId = $categoryId['id'];
                    $data['category_id'] = $categoryId;
                }
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

                //inserting prepared data to shop_products table
                $this->ci->db->insert($this->products_table, $data);

                //preparing after insert updating
                $insert_id = null;
                $insert_id = $this->ci->db->insert_id();
                $data = array();
                $data['url'] = $insert_id . "_" . translit_url($product->Наименование);

                //setting images if $product->Картинка not empty
                if ($product->Картинка . "" != '' OR $product->Картинка != null) {
                    $data['mainImage'] = $insert_id . '_main.jpg';
                    $data['smallImage'] = $insert_id . '_small.jpg';
                    $data['mainModImage'] = $insert_id . '_mainMod.jpg';
                    $data['smallModImage'] = $insert_id . '_smallMod.jpg';
                }
                $this->ci->db->where('id', $insert_id)->update($this->products_table, $data);

                //preparing data for shop_products_i18n table
                $data = array();
                $data['id'] = $insert_id;
                $data['locale'] = $this->locale;
                $data['name'] = $product->Наименование . "";

                //inserting prepared data into shop_products_i18n
                $this->ci->db->insert($this->products_table . "_i18n", $data);

                //preparing data for shop_products_categories
                $data = array();
                if ($categoryId) {
                    $data['product_id'] = $insert_id;
                    $data['category_id'] = $categoryId;
                    //inserting data into shop_products_categories
                    $this->ci->db->insert("shop_product_categories", $data);
                }

                //preparing insert data for shop_product_variants
                $data = array();
                $data['product_id'] = $insert_id;
                $data['price'] = '0.00000';
                $data['external_id'] = $product->Ид . "";
                $data['number'] = $product->Артикул . "";
                $data['stock'] = 0;
                $data['position'] = 0;
                $mainCurrencyId = $this->ci->db->select('id')->where('main', 1)->get('shop_currencies')->row_array();
                if (!empty($mainCurrencyId))
                    $mainCurrencyId = $mainCurrencyId['id'];
                $data['currency'] = $mainCurrencyId;
                $data['price_in_main'] = '0.00000';

                //inserting prepared data to shop_product_variants
                $this->ci->db->insert($this->product_variants_table, $data);

                //preparing insert data for shop_product_variants_i18n table
                $variant_insert_id = null;
                $variant_insert_id = $this->ci->db->insert_id();
                $data = array();
                $data['locale'] = $this->locale;
                $data['id'] = $variant_insert_id;
                $data['name'] = '';

                //inserting prepared data into shop_product_variants_i18n
                $this->ci->db->insert($this->product_variants_table . "_i18n", $data);

                //process properties
                if ($product->ЗначенияСвойств) {
                    foreach ($product->ЗначенияСвойств->ЗначенияСвойства as $property) {
                        if ($property->Значение . "" == '')
                            continue;
                        //search property by external id
                        $searchedProperty = null;
                        $searchedProperty = $this->ci->db->select('shop_product_properties.id, multiple, data')
                                ->join('shop_product_properties_i18n', 'shop_product_properties_i18n.id=shop_product_properties.id')
                                ->where(array('external_id' => $property->Ид . "", 'locale' => $this->locale))
                                ->get($this->properties_table)
                                ->row_array();
                        if (!empty($searchedProperty)) {

                            //prepare insert data for shop_product_properties_data
                            $data = array();
                            $data['property_id'] = $searchedProperty['id'];
                            $data['product_id'] = $insert_id;
                            $data['value'] = $property->Значение . "";
                            $data['locale'] = $this->locale;

                            //insert prepared data into shop_product_properties_data
                            $this->ci->db->insert($this->properties_table . "_data", $data);

                            if (!in_array($property->Значение . "", $properties_data[$searchedProperty['id']])) {
                                $properties_data[$searchedProperty['id']][] = $property->Значение . "";
                            }

                            //update shop_product_properties_categories
                            //search if relation not exists and insert record to base
                            if ($categoryId) {
                                if ($this->ci->db->where(array('property_id' => $searchedProperty['id'], 'category_id' => $categoryId))->get('shop_product_properties_categories')->num_rows() == 0) {
                                    $this->ci->db->insert('shop_product_properties_categories', array('property_id' => $searchedProperty['id'], 'category_id' => $categoryId));
                                }
                            }
                        }
                    }
                }
            } else {
                //product found and should be updated
                //preparing update data for shop_products table
                $data = array();


                //check if product belongs to any category
                if (isset($product->Группы)) {
                    $categoryId = $this->ci->db->select('id')->where('external_id', $product->Группы->Ид . "")->get($this->categories_table)->row_array();
                    if (empty($categoryId))
                        return false;
                    $categoryId = $categoryId['id'];
                    $data['category_id'] = $categoryId;
                }
                $data['updated'] = time();
                $data['url'] = $searchedProduct['id'] . "_" . translit_url($product->Наименование . "");

                //updating prepared data in shop_products table
                $this->ci->db->where('id', $searchedProduct['id'])->update($this->products_table, $data);

                //setting images if $product->Картинка not empty
                if ($product->Картинка . "" != '' OR $product->Картинка != null) {
                    $data = array();
                    $data['mainImage'] = $insert_id . '_main.jpg';
                    $data['smallImage'] = $insert_id . '_small.jpg';
                    $data['mainModImage'] = $insert_id . '_mainMod.jpg';
                    $data['smallModImage'] = $insert_id . '_smallMod.jpg';
                }
                $this->ci->db->where('id', $searchedProduct['id'])->update($this->products_table, $data);

                //preparing data for shop_products_i18n table
                $data = array();
                $data['name'] = $product->Наименование . "";

                //updating prepared data in shop_products_i18n
                $this->ci->db->where('id', $searchedProduct['id'])->update($this->products_table . "_i18n", $data);

                //preparing data for shop_products_categories
                if ($categoryId) {
                    $data = array();
                    $data['product_id'] = $searchedProduct['id'];
                    $data['category_id'] = $categoryId;
                    if ($this->ci->db->where($data)->get('shop_product_categories')->num_rows() == 0)
                    //inserting data into shop_products_categories
                        $this->ci->db->insert("shop_product_categories", $data);
                }

                //preparing update data for shop_product_variants
                $data = array();
                $data['number'] = $product->Артикул . "";
                $data['external_id'] = $product->Ид . "";

                //updating prepared data in shop_product_variants
                $this->ci->db->where(array('product_id' => $searchedProduct['id'], 'position' => 0))->update($this->product_variants_table, $data);

                //process properties
                if ($product->ЗначенияСвойств) {
                    foreach ($product->ЗначенияСвойств->ЗначенияСвойства as $property) {
                        if ($property->Значение . "" == '')
                            continue;
                        //search property by external id
                        $searchedProperty = null;
                        $searchedProperty = $this->ci->db->select('shop_product_properties.id, multiple, data')
                                ->join('shop_product_properties_i18n', 'shop_product_properties_i18n.id=shop_product_properties.id')
                                ->where(array('external_id' => $property->Ид . "", 'locale' => $this->locale))
                                ->get($this->properties_table)
                                ->row_array();
                        if (!empty($searchedProperty)) {
                            //prepare insert data for shop_product_properties_data
                            $data = array();
                            $data['value'] = $property->Значение . "";
                            //check if product property exists
                            if ($this->ci->db->where(array('property_id' => $searchedProperty['id'], 'product_id' => $searchedProduct['id']))->get('shop_product_properties_data')->num_rows() > 0)
                            //update prepared data into shop_product_properties_data
                                $this->ci->db->where(array('product_id' => $searchedProduct['id'], 'property_id' => $searchedProperty['id']))->update($this->properties_table . "_data", $data);
                            else
                            //insert new row
                                $this->ci->db->insert($this->properties_table . "_data", array(
                                    'property_id' => $searchedProperty['id'],
                                    'product_id' => $searchedProduct['id'],
                                    'value' => $property->Значение . "",
                                    'locale' => $this->locale
                                ));

                            if (!in_array($property->Значение . "", $properties_data[$searchedProperty['id']])) {
                                $properties_data[$searchedProperty['id']][] = $property->Значение . "";
                            }

                            //update shop_product_properties_categories
                            //search if relation not exists and insert record to base
                            if ($categoryId) {
                                if ($this->ci->db->where(array('property_id' => $searchedProperty['id'], 'category_id' => $categoryId))->get('shop_product_properties_categories')->num_rows() == 0) {
                                    $this->ci->db->insert('shop_product_properties_categories', array('property_id' => $searchedProperty['id'], 'category_id' => $categoryId));
                                }
                            }
                        }
                    }
                }
            }
        }
        foreach ($properties_data as $key => $item) {
            $data = array();
            $data = array('data' => serialize($item));
            $this->ci->db->where(array('id' => $key, 'locale' => $this->locale))->update('shop_product_properties_i18n', $data);
        }
    }

    private function importPrices() {
        foreach ($this->xml->ПакетПредложений->Предложения->Предложение as $offer) {
            //prepare update data
            $data = array();
            $data['price'] = $offer->Цены->Цена->ЦенаЗаЕдиницу;
            $data['price_in_main'] = $offer->Цены->Цена->ЦенаЗаЕдиницу;
            $data['stock'] = $offer->Количество;
            $this->ci->db->where('external_id', $offer->Ид . "")->or_where('number', $offer->Артикул . "")->update($this->product_variants_table, $data);
        }
    }

    private function startImagesResize() {
        ShopCore::app()->SWatermark->updateWatermarks(true);
    }

    private function command_sale_checkauth() {
        if ($this->config['usepassword'] == 'on') {
            $this->check_password();
        } else {
            $this->checkauth();
        }
        exit();
    }

    private function command_sale_init() {
        if ($this->check_perm() === true) {
            $this->command_catalog_init();
        }
        exit();
    }

    private function command_sale_file() {
        if ($this->check_perm() === true) {
            $this->load->helper('file');
            if (write_file($this->tempDir . $_GET['filename'], file_get_contents('php://input'), 'a+'))
                echo "success";
            $this->command_sale_import();
        }
        exit();
    }

    private function command_sale_import() {
        if ($this->check_perm() === true) {
            $this->xml = $this->_readXmlFile($_GET['filename']);
            if (!$this->xml)
                return "failure";
            foreach ($this->xml->Документ as $order) {
                $model = SOrdersQuery::create()->findOneById($order->Номер);
                if ($model) {
                    $model->setExternalId($order->Ид);
                    $usr = SUserProfileQuery::create()->findByUserExternalId($order->Контрагенты->Контрагент->Ид);
                    if (!$usr) {
                        $usr->setUserExternalId($order->Контрагенты->Контрагент->Ид);
                    }
                    $model->setTotalPrice($order->Сумма);
                    $model->setDateUpdated(date('U'));
                    foreach ($order->ЗначенияРеквизитов->ЗначениеРеквизита as $item) {
                        //echo $item->Наименование;
                        if ($item->Наименование == 'ПометкаУдаления') {
                            if ($item->Значение == true) {
                                $model->setStatus(1);
                            }
                        }
                        if ($item->Наименование . "" == 'Проведен') {
                            if ($item->Значение == true) {
                                $model->setStatus(10);
                            }
                        }
                        if ($item->Наименование . "" == 'Дата оплаты по 1С') {
                            if (strtotime($item->Значение)) {
                                if ($item->Значение . "" != "Т") {
                                    $model->setPaid(1);
                                    echo "success</br>";
                                }
                            }
                        }
                        /* if ($item->Наименование == 'Номер отгрузки по 1С') {
                          $model->setStatus(3);
                          } */
                    }
                    $model->save();
                } else {
                    echo "fail. order not found";
                }
            }
            rename($this->tempDir . $_GET['filename'], $this->tempDir . "success_" . $_GET['filename']);
        }
        exit();
    }

    private function command_sale_success() {
        if ($this->check_perm() === true) {
            $model = SOrdersQuery::create()->findByStatus(1);
            foreach ($model as $order) {
                $order->SetStatus(9);
                $order->save();
            }
        }
        exit();
    }

    private function command_sale_query() {
        if ($this->check_perm() === true) {
            $model = SOrdersQuery::create()->findByStatus($this->config['userstatuses']);
            header('content-type: text/xml');
            $xml_order .= "<?xml version='1.0' encoding='UTF-8'?>" . "\n" .
                    "<КоммерческаяИнформация ВерсияСхемы='2.03' ДатаФормирования='" . date('Y-m-d') . "'>" . "\n";
            foreach ($model as $order) {
                if ($order->user_id != Null) {
                    $user_prof = SUserProfileQuery::create()->findById($order->user_id);
                    if ($user_prof->user_external_id != '')
                        $ext_id = $row['external_id'];
                }
                $xml_order.="<Документ>\n" .
                        "<Ид>" . $order->external_id . "</Ид>\n" .
                        "<Номер>" . $order->Id . "</Номер>\n" .
                        "<Дата>" . date('Y-m-d', $order->date_created) . "</Дата>\n" .
                        "<ХозОперация>Заказ товара</ХозОперация>\n" .
                        "<Роль>Продавец</Роль>\n" .
                        "<Валюта>" . app()->SCurrencyHelper->main->getCode() . "</Валюта>\n" .
                        "<Курс>1</Курс>\n" .
                        "<Сумма>" . $order->totalprice . "</Сумма>\n" .
                        "<Контрагенты>\n" .
                        "<Контрагент>\n" .
                        "<Ид>" . $ext_id . "</Ид>\n" .
                        "<Наименование>" . $order->UserFullName . "</Наименование>\n" .
                        "<Роль>Покупатель</Роль>\n" .
                        "<ПолноеНаименование>" . $order->UserFullName . "</ПолноеНаименование>\n" .
                        "<Фамилия/>\n" .
                        "<Имя>" . $order->UserFullName . "</Имя>\n" .
                        "<АдресРегистрации>\n" .
                        "<Представление></Представление>\n" .
                        "<АдресноеПоле>\n" .
                        "<Тип>Электронная почта</Тип>\n" .
                        "<Значение>" . $order->user_email . "</Значение>\n" .
                        "</АдресноеПоле>\n" .
                        "<АдресноеПоле>\n" .
                        "<Тип>Телефон</Тип>\n" .
                        "<Значение>" . $order->user_phone . "</Значение>\n" .
                        "</АдресноеПоле>\n" .
                        "<АдресноеПоле>\n" .
                        "<Тип>Адрес доставки</Тип>\n" .
                        "<Значение>" . $order->user_deliver_to . "</Значение>\n" .
                        "</АдресноеПоле>\n" .
                        "</АдресРегистрации>\n" .
                        "</Контрагент>\n" .
                        "</Контрагенты>\n" .
                        "<Время>" . date('G:i:s', $order->date_created) . "</Время>\n" .
                        "<Комментарий>" . $order->user_comment . "</Комментарий>\n" .
                        "<Товары>\n";
                $ordered_products = SOrderProductsQuery::create()->findByOrderId($order->Id);
                if ($order->deliverymethod != null) {
                    $xml_order .= "<Товар>\n" .
                            "<Ид>ORDER_DELIVERY</Ид>\n" .
                            "<Наименование>Доставка заказа</Наименование>\n" .
                            '<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>' . "\n" .
                            "<ЦенаЗаЕдиницу>" . $order->deliveryprice . "</ЦенаЗаЕдиницу>\n" .
                            "<Количество>1</Количество>\n" .
                            "<Сумма>" . $order->deliveryprice . "</Сумма>\n" .
                            "<ЗначенияРеквизитов>\n" .
                            "<ЗначениеРеквизита>\n" .
                            "<Наименование>ВидНоменклатуры</Наименование>\n" .
                            "<Значение>Услуга</Значение>\n" .
                            "</ЗначениеРеквизита>\n" .
                            "<ЗначениеРеквизита>\n" .
                            "<Наименование>ТипНоменклатуры</Наименование>\n" .
                            "<Значение>Услуга</Значение>\n" .
                            "</ЗначениеРеквизита>\n" .
                            "</ЗначенияРеквизитов>\n" .
                            "</Товар>\n";
                }
                foreach ($ordered_products as $product) {
                    $xml_order .= "<Товар>\n" .
                            "<Ид>" . $product->external_id . "</Ид>\n" .
                            "<ИдКаталога></ИдКаталога>\n" .
                            "<Наименование>" . $product->product_name . "</Наименование>\n" .
                            '<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>' . "\n" .
                            "<ЦенаЗаЕдиницу>" . $product->price . "</ЦенаЗаЕдиницу>\n" .
                            "<Количество>$product->quantity</Количество>\n" .
                            "<Сумма>" . ($product->price) * ($product->quantity) . "</Сумма>\n" .
                            "<ЗначенияРеквизитов>\n" .
                            "<ЗначениеРеквизита>\n" .
                            "<Наименование>ВидНоменклатуры</Наименование>\n" .
                            "<Значение>Товар</Значение>\n" .
                            "</ЗначениеРеквизита>\n" .
                            "<ЗначениеРеквизита>\n" .
                            "<Наименование>ТипНоменклатуры</Наименование>\n" .
                            "<Значение>Товар</Значение>\n" .
                            "</ЗначениеРеквизита>\n" .
                            "</ЗначенияРеквизитов>\n" .
                            "</Товар>\n";
                }
                $xml_order .= "</Товары>\n";
                if ($order->paid == 0) {
                    $paid_status = 'false';
                } else {
                    $paid_status = 'true';
                }
                $xml_order .= "<ЗначенияРеквизитов>\n" .
                        "<ЗначениеРеквизита>\n" .
                        "<Наименование>Метод оплаты</Наименование>\n" .
                        "<Значение>" . $order->getpaymentMethodName() . "</Значение>\n" .
                        "</ЗначениеРеквизита>\n" .
                        "<ЗначениеРеквизита>\n" .
                        "<Наименование>Заказ оплачен</Наименование>\n" .
                        "<Значение>" . $paid_status . "</Значение>\n" .
                        "</ЗначениеРеквизита>\n" .
                        "<ЗначениеРеквизита>\n" .
                        "<Наименование>Доставка разрешена</Наименование>\n" .
                        "<Значение>true</Значение>\n" .
                        "</ЗначениеРеквизита>\n" .
                        "<ЗначениеРеквизита>\n" .
                        "<Наименование>Отменен</Наименование>\n" .
                        "<Значение>false</Значение>\n" .
                        "</ЗначениеРеквизита>\n" .
                        "<ЗначениеРеквизита>\n" .
                        "<Наименование>Финальный статус</Наименование>\n" .
                        "<Значение>false</Значение>\n" .
                        "</ЗначениеРеквизита>\n" .
                        "<ЗначениеРеквизита>\n" .
                        "<Наименование>Статус заказа</Наименование>\n" .
                        "<Значение>В обработке</Значение>\n" .
                        "</ЗначениеРеквизита>\n" .
                        "<ЗначениеРеквизита>\n" .
                        "<Наименование>Дата изменения статуса</Наименование>\n" .
                        "<Значение>" . date('Y-m-d H:i:s', $order->date_updated) . "</Значение>\n" .
                        "</ЗначениеРеквизита>\n" .
                        "</ЗначенияРеквизитов>\n";
                $xml_order .= "</Документ>\n";
            }
            $xml_order .= "</КоммерческаяИнформация>";
            echo $xml_order;
        }
        exit();
    }

}

/* End of file exchange.php */