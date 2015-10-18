<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

use Propel\Runtime\Propel;
use Propel\Runtime\Connection\ConnectionManagerSingle;

/**
 * Executing custom CMS initialication code
 */
class Lib_init {

    /**
     *
     * @var MY_Controller
     */
    private $CI;

    /**
     * TODO: this method is pretty messy... needs refactoring to some eloquent bootstrap logic
     * @return type
     */
    public function __construct() {

        $this->CI = & get_instance();

        log_message('debug', "Lib_init Class Initialized");

        try {

            $this->bootstrapInitAutoloading();

            // Set timezone
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

            // Load DB
            $this->CI->load->database();

            // Cheking database immediately after it init
            $this->checkDatabase();

            $this->bootstrapInitPropel();

            // Load hooks lib
            $this->CI->load->library('cms_hooks');

            // Fake function for hooks (for cms_hooks...)
            if (!function_exists('get_hook')) {

                function get_hook() {
                    return false;
                }

            }

            $this->CI->load->library('lib_category'); // needs database
            //
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

            if (!defined('DS')) {
                define('DS', DIRECTORY_SEPARATOR);
            }

            $this->bootstrapInitShop();
        } catch (Exception $ex) {
            log_message('error', $ex->getMessage());
            show_error('Init error', 500);
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
                redirect("/install");
            }
            return false;
        }

        // Something went bad during installation in past. Both of this variables
        // should be either true (not installed) or false (install was complete)
        if ($isNotInstalledInConfig && !$installControllerExists) {
            show_error('Something went wrong during installation... It could be repaired only mannually.');
        }
    }

    private function checkDatabase() {
        $db = \CI::$APP->db;
        if ($db == null) {
            throw new \Exception('Database object not inited');
        }

        $result = \CI::$APP->db->query("SHOW TABLES FROM `{$db->database}`");
        if (!$result) {
            throw new \Exception('Error on checking database');
        }

        if (!$result->num_rows > 0) {
            throw new \Exception('No tables in database');
        }
    }

    private function bootstrapInitPropel() {
        if (!$this->CI->db) {
            return FALSE;
        }

        $serviceContainer = Propel::getServiceContainer();
        $serviceContainer->setAdapterClass('Shop', 'mysql');
        $manager = new ConnectionManagerSingle();

        $manager->setConfiguration(
            [
                    'dsn' => 'mysql:host=' . $this->CI->db->hostname . ';dbname=' . $this->CI->db->database,
                    'user' => $this->CI->db->username,
                    'password' => $this->CI->db->password,
                    'settings' => [
                        'charset' => 'utf8'
                    ],
                ]
        );

        $serviceContainer->setConnectionManager('Shop', $manager);

        Propel::getConnection('Shop')->query('SET NAMES utf8 COLLATE utf8_unicode_ci');

        //
        //----------MONOLOG-----------------------------------------------------
        //                $con = Propel::getWriteConnection('Shop');
        //                    if (ENVIRONMENT != 'production') {
        //                        $con->useDebug(true);
        //                        $logger = new Monolog\Logger('defaultLogger');
        //                        $logger->pushHandler(new \Monolog\Handler\StreamHandler(APPPATH . 'logs/propel.log'));
        //                        $serviceContainer->setLogger('defaultLogger', $logger);
        //                    }
        //----------MONOLOG-----------------------------------------------------
    }

    private function bootstrapInitAutoloading() {

        include_once APPPATH . 'libraries' . DIRECTORY_SEPARATOR . 'ClassLoader.php';
        ClassLoader::getInstance()
                ->registerNamespacedPath(APPPATH);

        /**
         * @todo Code is from Codeigniter 3 Dev... On updating to 3 version
         * this functionallity will be present in framework, so this shoud
         * be deleted.
         */
        if ($composer_autoload = $this->CI->config->item('composer_autoload')) {
            if ($composer_autoload === TRUE && file_exists(APPPATH . 'vendor/autoload.php')) {
                include_once APPPATH . 'vendor/autoload.php';
            } elseif (file_exists($composer_autoload)) {
                include_once $composer_autoload;
            }
        }

        /*
         * Registeting namespaced paths for each module directory
         */
        foreach ($this->CI->config->item('modules_locations') as $ml) {
            ClassLoader::getInstance()->registerNamespacedPath(APPPATH . $ml);
        }
    }

    private function bootstrapInitShop() {

        if (!$shopPath = getModulePath('shop')) {
            return;
        }

        define('SHOP_DIR', $shopPath);

        ClassLoader::getInstance()
                ->registerNamespacedPath(SHOP_DIR . 'models2/generated-classes')
                ->registerClassesPath(SHOP_DIR . 'models2/generated-classes')
                ->registerClassesPath(SHOP_DIR . 'classes')
                ->registerNamespacedPath(SHOP_DIR . 'classes');

        ShopCore::init();

        // Diable CSRF library form web money service
        $this->CI = & get_instance();
        if ($this->CI->uri->segment(1) == 'shop' && $this->CI->uri->segment(2) == 'cart' && $this->CI->uri->segment(3) == 'view' && $this->CI->input->get('result') == 'true' && $this->CI->input->get('pm') > 0) {
            define('ICMS_DISBALE_CSRF', true);
        }
        // Support for robokassa
        if ($this->CI->uri->segment(1) == 'shop' && $this->CI->uri->segment(2) == 'cart' && $this->CI->uri->segment(3) == 'view' && $this->CI->input->get('getResult') == 'true') {
            define('ICMS_DISBALE_CSRF', true);
        }
        if ($this->CI->uri->segment(1) == 'exchange') {
            define('ICMS_DISBALE_CSRF', true);
        }
        // Support for privat
        if ($this->CI->uri->segment(1) == 'shop' && $this->CI->uri->segment(2) == 'order' && $this->CI->uri->segment(3) == 'view' && $this->CI->input->post()) {
            define('ICMS_DISBALE_CSRF', true);
        }
        if ($this->CI->uri->segment(1) == 'shop' && $this->CI->uri->segment(2) == 'cart' && $this->CI->uri->segment(3) == 'view' && $this->CI->input->get('succes') == 'true') {
            define('ICMS_DISBALE_CSRF', true);
        }
        if ($this->CI->uri->segment(1) == 'shop' && $this->CI->uri->segment(2) == 'cart' && $this->CI->uri->segment(3) == 'view' && $this->CI->input->get('fail') == 'true') {
            define('ICMS_DISBALE_CSRF', true);
        }
        if ($this->CI->input->server('HTTP_REFERER') AND strpos($this->CI->input->server('HTTP_REFERER') . "", 'facebook.com')) {
            define('ICMS_DISBALE_CSRF', true);
        }
        if ($this->CI->input->server('HTTP_REFERER') AND strpos($this->CI->input->server('HTTP_REFERER') . "", 'facebook.com')) {
            define('ICMS_DISBALE_CSRF', true);
        }
        // Support for privat

        if ($this->CI->uri->segment(1) == 'shop' && $this->CI->uri->segment(2) == 'order' && $this->CI->uri->segment(3) == 'view') {
            define('ICMS_DISBALE_CSRF', true);
        }
        //new payment system
        if (preg_match("/payment_method_/i", $this->CI->uri->segment(1)) || preg_match("/payment_method_/i", $this->CI->uri->segment(2))) {
            define('ICMS_DISBALE_CSRF', true);
        }
        if ($this->CI->uri->segment(1) == 'facebook_store' && $this->CI->uri->segment(2) == 'auth_from_fb_store') {
            define('ICMS_DISBALE_CSRF', true);
        }

        if ($this->CI->uri->segment(4) == 'xbanners') {
            define('ICMS_DISBALE_CSRF', true);
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
            parse_str($this->CI->input->server('QUERY_STRING'), $this->CI->input->get());
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