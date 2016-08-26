<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

use CMSFactory\ModuleSettings;
use exchange\classes\Categories;
use exchange\classes\Prices;
use exchange\classes\Products;
use exchange\classes\Properties;
use exchange\classes\VariantCharacteristics;
use libraries\Backup;

/**
 * Exchange Class
 * exchange class handles 1c import/export
 * @package 1C-Exchange
 * @author ImageCMS <dev@imagecms.net>
 * @link  http://docs.imagecms.net/administrirovanie-imagecms-shop/moduli/integratsiia-s-1s
 * @link http://v8.1c.ru/edi/edi_stnd/131/
 */
class Exchange extends \MY_Controller
{

    /**
     * array which contains 1c settings
     * @var array|null
     */
    private $my_config = [];

    /** default directory for saving files from 1c */
    private $tempDir;

    /** contains default locale */
    private $locale;

    /**
     * @var array
     */
    private $allowed_image_extensions = [];

    private $login;

    private $password;

    /**
     * @var array
     */
    private $brand = [];

    /** Runtime variable */
    private $time = 0;

    /**
     *
     * @var VariantCharacteristics
     */
    private $variantCharacteristics;

    public function __construct() {

        parent::__construct();

        $this->time = time();
        set_time_limit(0);

        $lang = new MY_Lang();
        $lang->load('exchange');

        $this->load->helper('translit');
        $this->load->helper('file');
        $this->load->helper('exchange');

        $this->load->config('exchange');
        $this->load->config('exchange_debug');

        /**
         * define path to folder for saving files from 1c
         */
        $this->tempDir = $this->config->item('tempDir');
        if (!is_dir($this->tempDir)) {
            mkdir($this->tempDir);
        }

        $storageFilePath = $this->config->item('characteristicsStorageFilePath');
        $this->variantCharacteristics = new VariantCharacteristics($storageFilePath);

        $this->locale = MY_Controller::getCurrentLocale();    //getting current locale
        $this->my_config = $this->get1CSettings();

        if (!$this->my_config) {
            //default settings if module is not installed yet
            if (class_exists('ZipArchive')) {
                $this->my_config['zip'] = 'yes';
            } else {
                $this->my_config['zip'] = 'no';
            }
            $this->my_config['filesize'] = $this->config->item('filesize');
            $this->my_config['validIP'] = $this->config->item('validIP');
            $this->my_config['password'] = $this->config->item('password');
            $this->my_config['usepassword'] = $this->config->item('usepassword');
            $this->my_config['userstatuses'] = $this->config->item('userstatuses');
            $this->my_config['autoresize'] = $this->config->item('autoresize');
            $this->my_config['debug'] = $this->config->item('debug');
            $this->my_config['email'] = $this->config->item('email');
        }

        if (isset($this->my_config['brand'])) {
            $this->brand = load_brand();
        }

        $this->allowed_image_extensions = [
                                           'jpg',
                                           'jpeg',
                                           'png',
                                           'gif',
                                          ];

        //define first get command parameter
        $method = 'command_';

        $this->login = isset($_SERVER['PHP_AUTH_USER']) ? trim($_SERVER['PHP_AUTH_USER']) : null;
        $this->password = isset($_SERVER['PHP_AUTH_PW']) ? trim($_SERVER['PHP_AUTH_PW']) : null;

        //saving get requests to log file
        if ($_GET) {
            $string = '';
            foreach ($_GET as $key => $value) {
                $string .= date('c') . ' GET - ' . $key . ': ' . $value . "\n";
            }
            write_file($this->tempDir . 'log.txt', $string, 'ab');
        }

        //preparing method and mode name from $_GET variables
        if (isset($_GET['type']) && isset($_GET['mode'])) {
            $method .= strtolower($_GET['type']) . '_' . strtolower($_GET['mode']);
        }

        //run method if exist
        if (method_exists($this, $method)) {
            $this->$method();
        }
    }

    public function __destruct() {

        $this->time = time() - $this->time;
        foreach ($this->input->get() as $get) {
            write_file($this->tempDir . '/time.txt', date('Y-m-d h:i:s') . ': ' . $get . PHP_EOL, FOPEN_WRITE_CREATE);
        }
        write_file($this->tempDir . '/time.txt', date('Y-m-d h:i:s') . ': time - ' . $this->time . PHP_EOL, FOPEN_WRITE_CREATE);
        write_file($this->tempDir . '/time.txt', '-----------------------------------------' . PHP_EOL, FOPEN_WRITE_CREATE);
    }

    /**
     * Use this function to make backup before import starts
     */
    protected function makeDBBackup() {

        if (is_really_writable(BACKUPFOLDER)) {
            Backup::create()->createBackup('zip', 'exchange');
        } else {
            $this->error_log(langf('Can not create a database snapshot, check the folder {0} on writing possibility', 'exchange', [BACKUPFOLDER]));
        }
    }

    /**
     * get 1c settings from modules table
     * @return array|null
     */
    private function get1CSettings() {

        return ModuleSettings::ofModule('exchange')->get();
    }

    /**
     * module install function
     */
    public function _install() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) or exit;
        $fields = [
                   'id'          => [
                                     'type'           => 'INT',
                                     'auto_increment' => true,
                                    ],
                   'external_id' => [
                                     'type'       => 'VARCHAR',
                                     'constraint' => '255',
                                     'null'       => true,
                                    ],
                   'property_id' => [
                                     'type'       => 'VARCHAR',
                                     'constraint' => '255',
                                     'null'       => true,
                                    ],
                   'value'       => [
                                     'type'       => 'VARCHAR',
                                     'constraint' => '20',
                                     'null'       => true,
                                    ],
                  ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('mod_exchange');
        ModuleSettings::ofModule('exchange')->set($this->my_config);
    }

    public function _deinstall() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) or exit;
        $this->dbforge->drop_table('mod_exchange');
    }

    /**
     * Error loging methods
     * @param string $error
     * @param bool|string $send_email
     */
    public function error_log($error, $send_email = false) {

        $intIp = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            if (isset($_SERVER['HTTP_X_REAL_IP'])) {
                $intIp = $_SERVER['HTTP_X_REAL_IP'];
            } else {
                $intIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }

        if ($this->my_config['debug']) {
            write_file($this->tempDir . 'error_log.txt', $intIp . ' - ' . date('c') . ' - ' . $error . PHP_EOL, 'ab');
        }

        if ($send_email and $this->my_config['email']) {
            $this->load->library('email');

            $this->email->from("noreplay@{$_SERVER['HTTP_HOST']}");
            $this->email->to($this->my_config['email']);

            $this->email->subject('1C exchange');
            $this->email->message($intIp . ' - ' . date('c') . ' - ' . $error . PHP_EOL);

            $this->email->send();
        }
    }

    public function __autoload() {

        return;
    }

    /**
     * checking password from $_GET['password'] if use_password option in settings is "On"
     */
    private function check_password() {

        if (($this->my_config['login'] == $this->login) && ($this->my_config['password'] == $this->password)) {
            $this->checkauth();
        } else {
            echo 'failure. wrong password';
            $this->error_log(lang('Wrong password', 'exchange'), true);
        }
    }

    /**
     * return to 1c session id and success status
     * to initialize import start
     */
    private function command_catalog_checkauth() {

        if ($this->my_config['usepassword'] == 'on') {
            $this->check_password();
        } else {
            $this->checkauth();
        }
        exit();
    }

    /**
     * preparing to import
     * writing session id to txt file in md5
     * deleting old import files
     */
    private function checkauth() {

        echo "success\n";
        echo session_name() . "\n";
        echo session_id() . "\n";
        $string = md5(session_id());
        write_file($this->tempDir . 'session.txt', $string, 'w');
    }

    /**
     * checking if current session id matches session id in txt files
     * @return boolean|null
     */
    private function check_perm() {

        if ($this->my_config['debug']) {
            return true;
        }

        $string = read_file($this->tempDir . 'session.txt');
        if (md5(session_id()) == $string) {
            return true;
        } else {
            $this->error_log(lang('Security Error!!!', 'exchange'), true);
            die(lang('Security Error!!!', 'exchange'));
        }
    }

    /**
     * returns exchange settings to 1c
     * @zip no
     * @file_limit in bytes
     */
    private function command_catalog_init() {

        if ($this->check_perm() === true) {
            echo 'zip=' . $this->my_config['zip'] . "\n";
            echo 'file_limit=' . $this->my_config['filesize'] . "\n";
        }
        exit();
    }

    /**
     * saves exchange files to tempDir
     * xml files will be saved to tempDir/
     * images wil be saved  to tempDir/images as jpg files
     */
    private function command_catalog_file() {

        if ($this->check_perm() === true) {
            $file_info = pathinfo($this->input->get('filename'));
            $file_extension = $file_info['extension'];
            $path = $file_info['dirname'];

            if ($file_extension != 'zip' && $file_extension != 'xml' && in_array($file_extension, $this->allowed_image_extensions)) {
                //saving images to cmlTemp/images folder
                @mkdir($this->tempDir . $path, 0777, true);
                if (write_file($this->tempDir . $this->input->get('filename'), file_get_contents('php://input'), 'w+')) {
                    echo 'success';
                }
            } else {
                //saving xml files to cmlTemp
                if (write_file($this->tempDir . $this->input->get('filename'), file_get_contents('php://input'), 'w+')) {
                    echo 'success';
                }
            }
            //extracting filles
            if ($file_extension == 'zip' && class_exists('ZipArchive')) {
                $zip = new ZipArchive();
                $zip->open($this->tempDir . $this->input->get('filename'));
                if ($res > 0 && $res != true) {
                    switch ($res) {
                        case ZipArchive::ER_NOZIP:
                            $this->error_log('Not a zip archive.');
                            break;
                        case ZipArchive::ER_INCONS:
                            $this->error_log('Zip archive inconsistent.');
                            break;
                        case ZipArchive::ER_CRC:
                            $this->error_log('checksum failed');
                            break;
                        case ZipArchive::ER_EXISTS:
                            $this->error_log('File already exists.');
                            break;
                        case ZipArchive::ER_INVAL:
                            $this->error_log('Invalid argument.');
                            break;
                        case ZipArchive::ER_MEMORY:
                            $this->error_log('Malloc failure.');
                            break;
                        case ZipArchive::ER_NOENT:
                            $this->error_log('No such file.');
                            break;
                        case ZipArchive::ER_OPEN:
                            $this->error_log("Can't open file.");
                            break;
                        case ZipArchive::ER_READ:
                            $this->error_log('Read error.');
                            break;
                        case ZipArchive::ER_SEEK:
                            $this->error_log('Seek error.');
                            break;
                    }
                    echo 'failure';
                    exit();
                } else {
                    $zip->extractTo($this->tempDir);
                }
                $zip->close();
            }
        }
        exit();
    }

    /**
     * loading xml file to $this->xml variable
     * uses simple xml extension
     * @param string $file
     * @return null|SimpleXMLElement
     */
    private function _readXmlFile($file) {

        $path = $this->tempDir . $file;
        if (!file_exists($path) || !is_file($path)) {
            exit('Error opening file: ' . $path);
        }
        return simplexml_load_file($path);
    }

    public function command_catalog_import() {

        if ($this->check_perm() === true) {
            if ($this->my_config['backup']) {
                $this->makeDBBackup();
            }
            // getting xml
            $xml = $this->_readXmlFile($_GET['filename']);

            try {
                // IMPORT PROPERTIES
                if (isset($xml->Классификатор->Свойства)) {
                    $props = $xml->Классификатор->Свойства;
                    $propertiesData = isset($props->СвойствоНоменклатуры) ? $props->СвойствоНоменклатуры : $props->Свойство;
                    Properties::getInstance()
                        ->setBrandIdentif($this->my_config['brand'])
                        ->import($propertiesData);
                }

                // IMPORT CATEGORIES
                if (isset($xml->Классификатор->Группы)) {
                    Categories::getInstance()->import($xml->Классификатор->Группы->Группа);
                }

                // IMPORT PRODUCTS
                if (isset($xml->Каталог->Товары)) {
                    if ($this->my_config['autoresize'] == 'on') {
                        $res = true;
                    } else {
                        $res = false;
                    }

                    Products::getInstance()
                        ->setTempDir($this->tempDir)
                        ->setResize($res)
                        ->import($xml->Каталог->Товары->Товар);
                }

                // IMPORT PRICES (IF THERE ARE ANY)
                Prices::getInstance()->setXml($xml);
                if (isset($xml->ПакетПредложений->Предложения)) {
                    Prices::getInstance()
                        ->import($xml->ПакетПредложений->Предложения->Предложение);
                }

                /**
                 * send notifications if changes products quantity
                 */
                Notificator::run();
            } catch (Exception $e) {
                $this->error_log(lang('Import error', 'exchange') . ': ' . $e->getMessage() . $e->getFile() . $e->getLine());
                echo $e->getMessage() . $e->getFile() . $e->getLine();
                echo 'failure';
                exit;
            }
            $this->cache->delete_all();
            exit('success');
        }
    }

    /**
     * checkauth for orders import
     */
    private function command_sale_checkauth() {

        if ($this->my_config['usepassword'] == 'on') {
            $this->check_password();
        } else {
            $this->checkauth();
        }
        exit();
    }

    /**
     * returns exchange settings to 1c
     * @zip no
     * @file_limit in bytes
     */
    private function command_sale_init() {

        if ($this->check_perm() === true) {
            $this->command_catalog_init();
        }
        exit();
    }

    /**
     * saving xml files with orders from 1c
     * and runs orders import
     */
    private function command_sale_file() {

        if ($this->check_perm() === true) {
            $this->load->helper('file');
            if (write_file($this->tempDir . $_GET['filename'], file_get_contents('php://input'), 'a+')) {
                echo 'success';
            }
            $this->command_sale_import();
        }
        exit();
    }

    /**
     * procced orders import
     * @return string
     */
    private function command_sale_import() {

        if ($this->check_perm() != true) {
            exit();
        }

        $this->xml = $this->_readXmlFile($_GET['filename']);
        if (!$this->xml) {
            return 'failure';
        }
        foreach ($this->xml->Документ as $order) {
            $orderId = (string) $order->Номер;
            $model = SOrdersQuery::create()->setComment(__METHOD__)->findOneById($orderId);
            if ($model) {
                $model->setExternalId((string) $order->Ид);
                $usr = SUserProfileQuery::create()->setComment(__METHOD__)->findById((string) $order->Контрагенты->Контрагент->Ид);
                $model->setTotalPrice((string) $order->Сумма);
                $model->setDateUpdated(date('U'));
                foreach ($order->ЗначенияРеквизитов->ЗначениеРеквизита as $item) {
                    if ((string) $item->Наименование == 'ПометкаУдаления') {
                        if ($item->Значение == true) {
                            $model->setStatus(1);
                        }
                    }
                    if ((string) $item->Наименование . '' == 'Проведен') {
                        if ((string) $item->Значение == true) {
                            $model->setStatus(10);
                        }
                    }

                    if ((string) $item->Наименование . '' == 'Дата оплаты по 1С') {
                        if (strtotime((string) $item->Значение)) {
                            if ((string) $item->Значение . '' != 'Т') {
                                $model->setPaid(1);
                                echo 'success</br>';
                            }
                        }
                    }
                    /* if ($item->Наименование == 'Номер отгрузки по 1С') {
                      $model->setStatus(3);
                      } */
                }
                $model->save();
            } else {
                echo sprintf('Error - order with id [%s] not found', $orderId);
            }
        }

        if (!$this->my_config['debug']) {
            rename($this->tempDir . $_GET['filename'], $this->tempDir . 'success_' . $_GET['filename']);
        }

        exit('success');
    }

    /**
     * runs when orders from site succesfully uploaded to 1c server
     * and sets some status for imported orders "waiting" for example
     */
    private function command_sale_success() {

        if ($this->check_perm() === true) {
            $model = SOrdersQuery::create()->setComment(__METHOD__)->findByStatus($this->my_config['userstatuses']);
            foreach ($model as $order) {
                $order->SetStatus($this->my_config['userstatuses_after']);
                $order->save();
            }
        }
        exit();
    }

    /**
     *
     * @param string $variantName
     * @return string part of xml
     */
    private function getVariantCharacteristicsXML($variantName) {

        $characteristics = $this->variantCharacteristics->getVariantCharacteristics($variantName);
        if (count($characteristics) == 0) {
            return '';
        }
        $characteristicsXml = '';
        foreach ($characteristics as $name => $value) {
            $nameTag = create_tag('Наименование', $name);
            $valueTag = create_tag('Значение', $value);
            $characteristicTag = create_tag('ХарактеристикаТовара', $nameTag . $valueTag);
            $characteristicsXml .= $characteristicTag;
        }
        return create_tag('ХарактеристикиТовара', $characteristicsXml);
    }

    /**
     * creating xml document with orders to make possible for 1c to grab it
     */
    private function command_sale_query() {

        $xml_order = '';

        if ($this->check_perm() === true) {
            $this->load->helper('html');
            $model = SOrdersQuery::create()->setComment(__METHOD__)->findByStatus($this->my_config['userstatuses']);
            header('content-type: text/xml; charset=utf-8');
            $xml_order .= "<?xml version='1.0' encoding='UTF-8'?>" . "\n" .
                "<КоммерческаяИнформация ВерсияСхемы='2.03' ДатаФормирования='" . date('Y-m-d') . "'>" . "\n";
            foreach ($model as $order) {
                $xml_order .= "<Документ>\n" .
                    '<Ид>' . $order->Id . "</Ид>\n" .
                    '<Номер>' . $order->Id . "</Номер>\n" .
                    '<Дата>' . date('Y-m-d', $order->date_created) . "</Дата>\n" .
                    "<ХозОперация>Заказ товара</ХозОперация>\n" .
                    "<Роль>Продавец</Роль>\n" .
                    '<Валюта>' . \Currency\Currency::create()->main->getCode() . "</Валюта>\n" .
                    "<Курс>1</Курс>\n" .
                    '<Сумма>' . $order->totalprice . "</Сумма>\n" .
                    "<Контрагенты>\n" .
                    "<Контрагент>\n" .
                    '<Ид>' . $order->user_id . "</Ид>\n" .
                    '<Наименование>' . $order->UserFullName . "</Наименование>\n" .
                    '<Роль>Покупатель</Роль>' .
                    '<ПолноеНаименование>' . $order->UserFullName . "</ПолноеНаименование>\n" .
                    '<Фамилия>' . $order->UserFullName . '</Фамилия>' .
                    '<Имя>' . $order->UserFullName . '</Имя>' .
                    '<АдресРегистрации>' .
                    '<Представление>' . $order->user_deliver_to . '</Представление>' .
                    '<Комментарий></Комментарий>'
                    . '</АдресРегистрации>' .
                    '<Контакты>' .
                    '<Контакт>' .
                    '<Тип>ТелефонРабочий</Тип>' .
                    '<Значение>' . $order->user_phone . '</Значение>' .
                    '<Комментарий></Комментарий>' .
                    '</Контакт>' .
                    '<Контакт>' .
                    '<Тип>Почта</Тип>' .
                    '<Значение>' . $order->user_email . '</Значение>' .
                    '<Комментарий>Пользовательская почта</Комментарий>' .
                    '</Контакт>' .
                    '</Контакты>' .
                    "</Контрагент>\n" .
                    "</Контрагенты>\n" .
                    '<Время>' . date('G:i:s', $order->date_created) . "</Время>\n" .
                    '<Комментарий>' . $order->user_comment . "</Комментарий>\n" .
                    "<Товары>\n";
                $ordered_products = SOrderProductsQuery::create()
                    ->joinSProducts()
                    ->findByOrderId($order->Id);
                if ($order->deliverymethod != null) {
                    $xml_order .= "<Товар>\n" .
                        "<Ид>ORDER_DELIVERY</Ид>\n" .
                        "<Наименование>Доставка заказа</Наименование>\n" .
                        '<БазоваяЕдиница Код="2009" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>' . "\n" .
                        '<ЦенаЗаЕдиницу>' . $order->deliveryprice . "</ЦенаЗаЕдиницу>\n" .
                        "<Количество>1</Количество>\n" .
                        '<Сумма>' . $order->deliveryprice . "</Сумма>\n" .
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
                /* @var $product SOrderProducts */
                foreach ($ordered_products as $product) {
                    $category = get_product_category($product->product_id);

                    if ($this->config->item('salesQuery:exportCharacteristics') == true) {
                        $variantCharacteristicsXmlPart = $this->getVariantCharacteristicsXML($product->variant_name);
                    } else {
                        $variantCharacteristicsXmlPart = '';
                    }

                    $xml_order .= "<Товар>\n" .
                        '<Ид>' . $product->getSProducts()->getExternalId() . "</Ид>\n" .
                        "<ИдКаталога>{$category['external_id']}</ИдКаталога>\n" .
                        '<Наименование>' . ShopCore::encode($product->product_name) . "</Наименование>\n" .
                        '<БазоваяЕдиница Код="2009" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>' . "\n" .
                        '<ЦенаЗаЕдиницу>' . $product->price . "</ЦенаЗаЕдиницу>\n" .
                        "<Количество>$product->quantity</Количество>\n" .
                        '<Сумма>' . ($product->price) * ($product->quantity) . "</Сумма>\n" .
                        $variantCharacteristicsXmlPart .
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
                $status = SOrders::getStatusName('Id', $order->getStatus());
                $xml_order .= "<ЗначенияРеквизитов>\n" .
                    "<ЗначениеРеквизита>\n" .
                    "<Наименование>Метод оплаты</Наименование>\n" .
                    '<Значение>' . $order->getpaymentMethodName() . "</Значение>\n" .
                    "</ЗначениеРеквизита>\n" .
                    "<ЗначениеРеквизита>\n" .
                    "<Наименование>Заказ оплачен</Наименование>\n" .
                    '<Значение>' . $paid_status . "</Значение>\n" .
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
                    '<Значение>' . $status . "</Значение>\n" .
                    "</ЗначениеРеквизита>\n" .
                    "<ЗначениеРеквизита>\n" .
                    "<Наименование>Дата изменения статуса</Наименование>\n" .
                    '<Значение>' . date('Y-m-d H:i:s', $order->date_updated) . "</Значение>\n" .
                    "</ЗначениеРеквизита>\n" .
                    "</ЗначенияРеквизитов>\n";
                $xml_order .= "</Документ>\n";
            }
            $xml_order .= '</КоммерческаяИнформация>';

            $xml_order = iconv('UTF-8', 'Windows-1251', $xml_order);

            echo $xml_order;
        }
        exit();
    }

}