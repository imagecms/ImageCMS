<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

use Monolog\Handler\StreamHandler;
use Propel\Runtime\Propel;
use Propel\Runtime\Connection\ConnectionManagerSingle;

/**
 * Executing custom CMS initialization code
 */
class Lib_init
{

    /**
     *
     * @var MY_Controller
     */
    private $CI;

    /**
     * Lib_init constructor.
     */
    public function __construct() {

        /*
         * include composer autoloader
         */
        include_once APPPATH . 'third_party/autoload.php';

        /*
         * Define DS for Premmerce compatibility
         * TODO: Remove DS usage from all project
         *
         */
        defined('DS') or define('DS', '/');

        try {

            $this->CI = get_instance();

            if (function_exists('date_default_timezone_set')) {
                date_default_timezone_set(config_item('default_time_zone'));
            }

            // Sessions engine should run on cookies to minimize opportunities
            // of session fixation attack
            ini_set('session.use_only_cookies', 1);

            $this->CI->load->library('native_session', '', 'session');

            $this->CI->load->library('cache');

            if (!$this->checkIsInstalled()) { // if not installed then not all bootstrap needed
                return;
            }

            $this->initDatabase();

            $this->initPropel();

            /**
             *  @todo
             *  1. Delete this line
             *  2. Kill all eval && hooks before delete this line
             */
            $this->CI->load->library('cms_hooks');

            $this->CI->load->library('lib_category'); // needs database

            // Redirect to url with out ending slash
            $uri = $this->_detect_uri();

            $first_segment = $this->CI->uri->segment(1);
            if (substr($uri, -1, 1) === '/' && $first_segment !== 'admin' && $uri !== '/') {
                $get_params = '';
                if ($this->CI->input->get()) {
                    $get_params = '?' . http_build_query($this->CI->input->get());
                }
                redirect(substr($uri, 0, -1) . $get_params, 'location', 301);
            }

            $this->initShop();

        } catch (Exception $ex) {
            log_message('error', $ex->getMessage());
            show_error('Init error - ' . $ex->getMessage(), 500);
        }
    }

    private function checkIsInstalled() {
        $isNotInstalledInConfig = !config_item('is_installed');
        $installControllerExists = file_exists(getModulePath('install') . '/install.php');

        if (!$isNotInstalledInConfig && !$installControllerExists) {
            return true;
        }

        // Not installed
        if ($isNotInstalledInConfig && $installControllerExists) {
            if ($this->CI->uri->segment(1) != 'install') {
                redirect('/install');
            }
            return false;
        }

        // Something went bad during installation in past. Both of this variables
        // should be either true (not installed) or false (install was complete)
        if ($isNotInstalledInConfig && !$installControllerExists) {
            show_error('Something went wrong during installation... It could be repaired only manually.');
        }
    }

    /**
     * Load CI_DB_mysqli_driver
     *
     * @throws Exception
     */
    private function initDatabase() {

        // Load DB
        $this->CI->load->database();

        $db = $this->CI->db;

        if ($db == null) {
            throw new \Exception('Database object not initialized');
        }
        $result = $this->CI->db->query("SHOW TABLES FROM `{$db->database}`");

        if (!$result) {
            throw new \Exception('Error on checking database');
        }

        if (!$result->num_rows > 0) {
            throw new \Exception('No tables in database');
        }
    }

    private function initPropel() {
        $serviceContainer = Propel::getServiceContainer();
        $serviceContainer->setAdapterClass('Shop', 'mysql');
        $manager = new ConnectionManagerSingle();

        $manager->setConfiguration(
            [
             'dsn'      => 'mysql:host=' . $this->CI->db->hostname . ';dbname=' . $this->CI->db->database,
             'user'     => $this->CI->db->username,
             'password' => $this->CI->db->password,
             'settings' => ['charset' => 'utf8'],
            ]
        );

        $serviceContainer->setConnectionManager('Shop', $manager);

        Propel::getConnection('Shop')->query('SET NAMES utf8 COLLATE utf8_unicode_ci');

        // log propel queries
        if (ENVIRONMENT == 'development') {
            $con = Propel::getWriteConnection('Shop');
            $con->useDebug(true);
            $logger = new Monolog\Logger('defaultLogger');
            $logger->pushHandler(new StreamHandler(APPPATH . 'logs/propel.log'));
            $serviceContainer->setLogger('defaultLogger', $logger);
        }
    }

    private function initShop() {

        if ($shopPath = getModulePath('shop')) {

            define('SHOP_DIR', $shopPath);

            ShopCore::init();

        }
    }

    public function _detect_uri() {
        if (!$this->CI->input->server('REQUEST_URI')) {
            return '';
        }

        $uri = $this->CI->input->server('REQUEST_URI');
        if (strpos($uri, $this->CI->input->server('SCRIPT_NAME')) === 0) {
            $uri = substr($uri, strlen($this->CI->input->server('SCRIPT_NAME')));
        } elseif (strpos($uri, dirname($this->CI->input->server('SCRIPT_NAME'))) === 0) {
            $uri = substr($uri, strlen(dirname($this->CI->input->server('SCRIPT_NAME'))));
        }

        // This section ensures that even on servers that require the URI to be in the query string (Nginx) a correct
        // URI is found, and also fixes the QUERY_STRING server var and $_GET array.
        if (strncmp($uri, '?/', 2) === 0) {
            $uri = substr($uri, 2);
        }
        $parts = preg_split('#\?#i', $uri, 2);
        $uri = $parts[0];
        if (isset($parts[1])) {
            $_SERVER['QUERY_STRING'] = $parts[1];
            /*  !!!important directly $_GET array is required here to write query string */
            parse_str($this->CI->input->server('QUERY_STRING'), $_GET);
        } else {
            $_SERVER['QUERY_STRING'] = '';
            $_GET = [];
        }

        if ($uri == '/' || empty($uri)) {
            return '/';
        }

        $uri = parse_url($uri, PHP_URL_PATH);
        return $uri;
    }

}