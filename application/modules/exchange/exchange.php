<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс exchange
 */
class Exchange extends MY_Controller {

    public $tempDir;
    public $xml;
    public $customFieldsCache = array();
    public $settings = array();
    public $count_cats;
    public $sizes = array();

    public function __construct() {
        parent::__construct();
        $this->load->module('core');

        $this->tempDir = PUBPATH . 'application/modules/shop/cmlTemp/';

        $this->sizes = $this->getimagesizes();
        $this->settings = $this->get1CSettings();
        $this->os = $this->getOs();

        $method = 'command_';

//        if (ShopCore::$_GET) {
//            $this->load->helper('file');
//            foreach (ShopCore::$_GET as $key => $value) {
//                $string .= date('c') . " GET - " . $key . ": " . $value . "\n";
//            }
//            write_file($this->tempDir . "log.txt", $string, 'ab');
//        }
//        if (isset(ShopCore::$_GET['type']) && isset(ShopCore::$_GET['mode']))
//            $method .= strtolower(ShopCore::$_GET['type']) . '_' . strtolower(ShopCore::$_GET['mode']);
//        if (method_exists($this, $method))
//            $this->$method();
//        exit;
    }

    public function index() {
        
    }

    public function getOS() {
        $arr = $this->__get('1CSettingsOS');
        if ($arr) {
            $arr = unserialize($arr);
            return $arr;
        }
    }

    public function getimagesizes() {
        $result['mainimage']['width'] = $this->__get('mainImageWidth');
        $result['mainimage']['height'] = $this->__get('mainImageHeight');
        $result['smallimage']['width'] = $this->__get('smallImageWidth');
        $result['smallimage']['height'] = $this->__get('smallImageHeight');
        $result['mainmodimage']['width'] = $this->__get('mainModImageWidth');
        $result['mainmodimage']['height'] = $this->__get('mainModImageHeight');
        $result['smallmodimage']['width'] = $this->__get('smallModImageWidth');
        $result['smallmodimage']['height'] = $this->__get('smallModImageHeight');
        return $result;
    }

    public function get1CSettings() {
        $arr = $this->__get('1CCatSettings');
        $arr = unserialize($arr);
        return $arr;
    }

    public function __get($name) {
        if (array_key_exists($name, $this->settings))
            return $this->settings[$name]->getValue();
        else
            return null;
    }

    private function check_password() {
        if (isset($this->input->get('password')) && ($this->settings['password'] == $this->input->get('password')))
            $this->checkauth();
        else
            echo "failure. wrong password";
    }

    public function command_catalog_checkauth() {
        if ($this->settings['usepassword'] == 'on')
            $this->check_password();
        else
            $this->checkauth();
    }

    public function checkauth() {
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

        if (md5(session_id()) == $string)
            return true;
        else
            die("Ошибка безопасности!!!");
    }

    public function command_catalog_init() {
        if ($this->check_perm() === true) {
            echo $this->settings['zip'] . "\n";
            echo $this->settings['filesize'] . "\n";
        }
    }

    /**
     * Store files
     */
    public function command_catalog_file() {
        if ($this->check_perm() === true) {
            $this->load->helper('file');
            $st = $this->input->get('filename');
            $st = basename($st);
            if (strrchr($st, "/"))
                $st = strrchr($st, "/");
            $filename = explode('.', $st);
            if ($filename[1] != 'xml') {
                if (write_file("./uploads/shop/" . $st, file_get_contents('php://input'), 'wb')) {
                    $this->make_images();
                    echo "success";
                }
            } else {
                if (write_file($this->tempDir . $this->input->get('filename'), file_get_contents('php://input'), 'a+'))
                    echo "success";
            }
        }
    }

    public function make_images() {

        $sizes = $this->sizes;
        $filename = basename($this->input->get('filename'));

        if (strrchr($filename, "/")) {
            $filename = strrchr($filename, "/");
        }

        //creating main image for product
        $config['image_library'] = 'gd2';
        $config['source_image'] = "./uploads/shop/" . $filename;
        $config['new_image'] = "main_" . $filename;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = (int) $sizes['mainimage']['width'];
        $config['height'] = (int) $sizes['mainimage']['height'];
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $this->image_lib->resize();

        //creating small image for product
        $config['image_library'] = 'gd2';
        $config['source_image'] = "./uploads/shop/" . $filename;
        $config['new_image'] = "small_" . $filename;
        $config['width'] = $sizes['smallimage']['width'];
        $config['height'] = $sizes['smallimage']['height'];
        $config['maintain_ratio'] = FALSE;
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $this->image_lib->resize();

        //creating main additionall image for product
        $config['image_library'] = 'gd2';
        $config['source_image'] = "./uploads/shop/" . $filename;
        $config['new_image'] = "mainMod_" . $filename;
        $config['width'] = $sizes['mainmodimage']['width'];
        $config['height'] = $sizes['mainmodimage']['height'];
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $this->image_lib->resize();

        //creating small additional image for product
        $config['image_library'] = 'gd2';
        $config['source_image'] = "./uploads/shop/" . $filename;
        $config['new_image'] = "smallMod_" . $filename;
        $config['width'] = $sizes['smallmodimage']['width'];
        $config['height'] = $sizes['smallmodimage']['height'];
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }

    /**
     * Catalog import
     */
    public function command_catalog_import() {
        if ($this->check_perm() === true) {
            //set_time_limit(0);
            $this->xml = $this->_readXmlFile($this->input->get('filename'));
            if (!$this->xml)
                return "failure";

            // Import categories
            if (isset($this->xml->Классификатор->Группы)) {
                $this->importCategories($this->xml->Классификатор->Группы);
                $this->update_urls();
            }

            // Import properties
            if (isset($this->xml->Классификатор->Свойства)) {
                $this->importProperties();
            }

            // Import products
            if (isset($this->xml->Каталог->Товары)) {
                $this->importProducts();
            }

            // Prices
            if (isset($this->xml->ПакетПредложений->Предложения)) {
                foreach ($this->xml->ПакетПредложений->Предложения->Предложение as $offer) {
                    $variant = SProductVariantsQuery::create()->findOneByExternalId($offer->Ид);

                    // Try to search by number
                    if (!$variant)
                        SProductVariantsQuery::create()->findOneByExternalId($offer->Артикул);

                    if ($variant) {
                        $variant->setPrice($offer->Цены->Цена->ЦенаЗаЕдиницу);
                        $variant->setStock($offer->Количество);
                        $variant->save();
                    }
                }
            }
            rename($this->tempDir . $this->input->get('filename'), $this->tempDir . "success_" . $this->input->get('filename'));
            echo "success";
        }
    }

    /**
     * Base categories import
     * @param $data
     * @param null $parent xml data
     */
    public function importCategories($data, $parent = null) {
        //set_time_limit(0);
        foreach ($data->Группа as $category) {
            $model = $this->db->get_where('shop_category', array('external_id' => $category->Ид), 1);

            if (!$model) {
//                $model = new SCategory;
//                $model->setExternalId($category->Ид);
//                $model->setActive(true);
                $this->db->set('external_id', $category->Ид);
                $this->db->set('active', 1);
            }

            $model->setName($category->Наименование);
//            $model = $this->db->get_where('shop_category', array('external_id' => $category->Наименование), 1);

            if ($parent instanceof SCategory)
                $model->setParentId($parent->getId());

            $model->save();
            $this->db->insert('shop_category');

            // Process subcategories
            if (isset($category->Группы))
                $this->importCategories($category->Группы, $model);
        }
    }

    public function autoload() {
//        \behaviorFactory\BehaviorFactory::get();
    }

    public function _install() {
//        $this->load->dbforge();
//        ($this->dx_auth->is_admin()) OR exit;
//        $fields = array(
//            'id' => array(
//                'type' => 'INT',
//                'auto_increment' => TRUE
//            ),
//            'trash_id' => array(
//                'type' => 'VARCHAR',
//                'constraint' => '255',
//                'null' => TRUE,
//            ),
//            'trash_url' => array(
//                'type' => 'VARCHAR',
//                'constraint' => '255',
//                'null' => TRUE,
//            ),
//            'trash_redirect_type' => array(
//                'type' => 'VARCHAR',
//                'constraint' => '20',
//                'null' => TRUE,
//            ),
//            'trash_redirect' => array(
//                'type' => 'VARCHAR',
//                'constraint' => '255',
//                'null' => TRUE,
//            ),
//            'trash_type' => array(
//                'type' => 'VARCHAR',
//                'constraint' => '3',
//                'null' => TRUE,
//            ),
//        );
//
//        $this->dbforge->add_field($fields);
//        $this->dbforge->add_key('id', TRUE);
//        $this->dbforge->create_table('trash');
//
//        $this->db->where('name', 'trash');
//        $this->db->update('components', array('enabled' => 0, 'autoload' => 1));
    }

    public function _deinstall() {
        ($this->dx_auth->is_admin()) OR exit;
    }

}

/* End of file exchange.php */