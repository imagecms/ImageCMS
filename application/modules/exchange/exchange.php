<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс exchange
 */
class Exchange {

    private $config = array();
    private $ci;
    private $tempDir;
    private $locale;

    public function __construct() {
        $this->ci = &get_instance();
        $this->ci->load->helper('translit');
        $this->locale = getDefaultLanguage();
        $this->locale = $this->locale['identif'];

        if (!$this->get1CSettings()) {
            //default settings
            $this->config['zip'] = 'no';
            $this->config['filesize'] = 2048000;
            $this->config['validIP'] = '127.0.0.1';
            $this->config['password'] = '';
            $this->config['usepassword'] = false;
            $this->config['userstatuses'] = array();
        } else {
            $this->config = $this->get1CSettings();
        }

        $this->tempDir = PUBPATH . 'application/modules/shop/cmlTemp/';
        $method = 'command_';
        if (ShopCore::$_GET) {
            foreach (ShopCore::$_GET as $key => $value) {
                $string .= date('c') . " GET - " . $key . ": " . $value . "\n";
            }
            write_file($this->tempDir . "log.txt", $string, 'ab');
        }
        if (isset(ShopCore::$_GET['type']) && isset(ShopCore::$_GET['mode']))
            $method .= strtolower(ShopCore::$_GET['type']) . '_' . strtolower(ShopCore::$_GET['mode']);
        if (method_exists($this, $method))
            $this->$method();
        exit;
    }

    private function get1CSettings() {
        $config = $this->ci->db->where('identif', 'exchange')->get('components')->row_array();
        if (empty($config))
            return false;
        else
            return unserialize($config['settings']);
    }

    public function install() {
        if (is_array($this->config)) {
            $for_insert = serialize($this->config);
            $this->ci->db->insert($this->settings_table, array('name' => $this->row_name, 'value' => $for_insert));
        }
    }

    public function index() {
        
    }

    private function command_catalog_test() {
        echo "test";
    }

    private function check_password() {
        if (isset(ShopCore::$_GET['password']) && ($this->config['password'] == ShopCore::$_GET['password'])) {
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
    }

    private function command_catalog_file() {
        if ($this->check_perm() === true) {
            $st = ShopCore::$_GET['filename'];
            $st = basename($st);
            if (strrchr($st, "/"))
                $st = strrchr($st, "/");
            $filename = explode('.', $st);
            if ($filename[1] != 'xml')
            //saving images to cmlTemp/images folder
                if (write_file($this->tempDir . "images/" . $st, file_get_contents('php://input'), 'wb'))
                    echo "this is image";

                else
                //saving xml files to cmlTemp
                if (write_file($this->tempDir . ShopCore::$_GET['filename'], file_get_contents('php://input'), 'a+'))
                    echo "success";
        }
    }

    private function _readXmlFile($filename) {
        if (file_exists($this->tempDir . $filename) && is_file($this->tempDir . $filename))
            return simplexml_load_file($this->tempDir . $filename);
        return false;
    }

    private function command_catalog_import() {
        //if ($this->check_perm() === true) {
        echo "start:" . memory_get_usage() . "</br>";
        $this->xml = $this->_readXmlFile(ShopCore::$_GET['filename']);
        if (!$this->xml)
            return "failure";
        echo "reading xml file:" . memory_get_usage() . "</br>";
        // Import categories
        if (isset($this->xml->Классификатор->Группы)) {
            $this->importCategories($this->xml->Классификатор->Группы);
        }
        echo "finish:" . memory_get_usage() . "</br>";
        //}
    }

    private function importCategories($data, $parent = null) {
        foreach ($data->Группа as $category) {
            //search category by external id
            $searchedCat = array();
            $searchedCat = $this->ci->db->select("id, external_id")->where('external_id', $category->Ид . "")->get('shop_category')->row_array();

            if (empty($searchedCat)) {
                $operation = 'insert';
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
                        $data['full_path_ids'] = array($insert_id);
                    else {
                        $data['full_path_ids'][] = $insert_id;
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
                $operation = 'update';
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

}

/* End of file exchange.php */