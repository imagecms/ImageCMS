<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Install extends MY_Controller
{

    public $host = '';

    public $useSqlFile = 'sql.sql';

    private $exts = FALSE;

    private $loadedExt = FALSE;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('install');
        $lang->load('main');
        //        $this->host = 'http://' . str_replace('index.php', '', $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']) . 'index.php/';
        $this->load->helper('string');
        $this->load->helper('form_csrf');
        $this->host = reduce_multiples($this->host);
        $this->loadedExt = get_loaded_extensions();
    }

    public function index() {

        if (moduleExists('shop')) {
            $data = [
                     'content' => $this->load->view('license_shop', ['next_link' => $this->host . '/install/step_1'], TRUE),
                    ];
        } else {
            $data = [
                     'content' => $this->load->view('license', ['next_link' => $this->host . '/install/step_1'], TRUE),
                    ];
        }
        $this->load->view('main', $data);
    }

    public function step_1() {
        $result = TRUE;

        // Check folders permissions
        $dir_array = [
                      './application/config/config.php' => 'ok',
                      './system/cache'                  => 'ok',
                      './captcha/'                      => 'ok',
                      './system/cache/templates_c'      => 'ok',
                      './uploads/'                      => 'ok',
                      './uploads/images'                => 'ok',
                      './uploads/files'                 => 'ok',
                     ];

        foreach ($dir_array as $k => $v) {
            if (!is_really_writable($k)) {
                $dir_array[$k] = 'err';
                $result = FALSE;
            }
        }

        // Check server params

        $allow_params = [
                         'register_globals' => 'ok',
                         'safe_mode'        => 'ok',
                        ];

        foreach ($allow_params as $k => $v) {
            if (ini_get($k) == 1) {
                $allow_params[$k] = 'warning';
            } else {
                $allow_params[$k] = 'ok';
            }
        }

        if (version_compare(PHP_VERSION, '5.5.0') >= 0) {
            $allow_params['PHP version >= 5.5'] = 'ok';
        } else {
            $allow_params['PHP version >= 5.5'] = 'err';
            $result = false;
        }

        // Check installed php exts.
        $exts = [
                 'curl'     => 'ok',
                 'json'     => 'ok',
                 'mbstring' => 'ok',
                 'iconv'    => 'ok',
                 'gd'       => 'ok',
                 'zlib'     => 'ok',
                 'gettext'  => 'ok',
                 'soap'     => 'ok',
                ];

        if (moduleExists('shop') && end(explode('.', $this->input->server('HTTP_HOST'))) != 'loc') {
            $exts['ionCube Loader'] = 'ok';
        }

        foreach ($exts as $k => $v) {
            //if ($this->_get_ext($k) === FALSE) {
            if ($this->checkExtensions($k) === FALSE) {
                $exts[$k] = 'warning';
                if ($k == 'json') {
                    $exts[$k] = 'err';
                    $result = FALSE;
                }

                if ($k == 'mbstring') {
                    $exts[$k] = 'err';
                    $result = FALSE;
                }

                if ($k == 'gettext') {
                    $exts[$k] = 'err';
                    $result = FALSE;
                }

                if ($k == 'curl') {
                    $exts[$k] = 'err';
                    $result = FALSE;
                }
                if ($k == 'ionCube Loader') {
                    $exts[$k] = 'err';
                    $result = FALSE;
                }
            }
        }

        $locales = [
                    'en_US' => 'ok',
                    'ru_RU' => 'ok',
                   ];

        foreach ($locales as $locale => $v) {
            if (!setlocale(LC_ALL, $locale . '.utf8', $locale . '.utf-8', $locale . '.UTF8', $locale . '.UTF-8', $locale . '.utf-8', $locale . '.UTF-8', $locale)) {
                if (!setlocale(LC_ALL, '')) {
                    $locales[$locale] = 'warning';
                }
            }
        }

        $data = [
                 'dirs'         => $dir_array,
            //            'need_params' => $need_params,
                 'allow_params' => $allow_params,
                 'exts'         => $exts,
                 'locales'      => $locales,
                 'next_link'    => $this->_get_next_link($result, 1),
                ];
        $this->_display($this->load->view('step_1', $data, TRUE));
    }

    /**
     * Check is extension loaded
     * @param string $name extension name
     * @return bool
     */
    private function checkExtensions($name = '') {
        if (in_array($name, $this->loadedExt)) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @deprecated since version 4.6
     * @param string $name
     * @return boolean
     */
    protected function _get_ext($name = '') {
        if ($this->exts === FALSE) {
            ob_start();
            phpinfo(INFO_MODULES);
            $this->exts = ob_get_contents();
            ob_end_clean();
            $this->exts = strip_tags($this->exts, '<h2><th><td>');
        }

        preg_match("/<h2>.*$name.*<\/h2>/", $this->exts, $m);

        if (count($m) == 0) {
            return FALSE;
        }

        return TRUE;
    }

    public function step_2() {
        $this->load->library('Form_validation');
        $this->form_validation->set_error_delimiters('', '');

        $result = TRUE;
        $other_errors = '';

        if ($this->input->post()) {
            $this->form_validation->set_rules('site_title', lang('Site name', 'install'), 'required');
            $this->form_validation->set_rules('db_host', lang('Host', 'install'), 'required');
            $this->form_validation->set_rules('db_user', lang('Database username', 'install'), 'required');
            //$this->form_validation->set_rules('db_pass', 'Пароль БД', 'required');
            $this->form_validation->set_rules('db_name', lang('Database name', 'install'), 'required');
            //            $this->form_validation->set_rules('admin_login', 'Логин администратора', 'required|min_length[4]');
            $this->form_validation->set_rules('admin_pass', lang('Administrator password', 'install'), 'required|min_length[5]');
            $this->form_validation->set_rules('admin_mail', lang('Administrator E-mail', 'install'), 'required|valid_email');
            $this->form_validation->set_rules('lang_sel', lang('Language', 'install'), 'required');

            if ($this->form_validation->run() == FALSE) {
                $result = FALSE;
            } else {
                // Test database conn.
                if ($this->test_db() == FALSE) {
                    $other_errors .= lang('Database connection error', 'install') . '.<br/>';
                    $result = FALSE;
                }
            }

            if ($result == TRUE) {
                $this->make_install();
            }
        }

        $data = [
                 'next_link'    => $this->_get_next_link($result, 2),
                 'other_errors' => $other_errors,
                 'host'         => $this->host,
                 'sqlFileName'  => $this->useSqlFile,
                ];
        $this->_display($this->load->view('step_2', $data, TRUE));
    }

    private function make_install() {
        $this->load->helper('file');
        $this->load->helper('url');

        $db_server = $this->input->post('db_host');
        $db_user = $this->input->post('db_user');
        $db_pass = $this->input->post('db_pass');
        $db_name = $this->input->post('db_name');

        $link = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

        // Drop all tables in DB
        $tables = [];
        $sql = "SHOW TABLES FROM $db_name";
        if ($result = mysqli_query($link, $sql)) {
            while ($row = mysqli_fetch_row($result)) {
                $tables[] = $row[0];
            }
        }

        if (count($tables) > 0) {
            foreach ($tables as $t) {
                $sql = "DROP TABLE `{$db_name}`.`{$t}`";
                if (!mysqli_query($link, $sql)) {
                    die("MySQL error. Can\'t delete `{$db_name}`.`{$t}`");
                }
            }
        }

        mysqli_query($link, 'SET NAMES `utf8`');
        $sqlFileData = read_file(__DIR__ . '/' . $this->useSqlFile);

        $queries = explode(";\n", str_replace(';\r\n', ';\n', $sqlFileData));

        foreach ($queries as $q) {
            $q = trim($q);

            if (!empty($q)) {
                mysqli_query($link, $q);
            }
        }

        // Update site title
        mysqli_query($link, 'UPDATE `settings_i18n` SET `name`=\'' . mysqli_escape_string($link, $this->input->post('site_title')) . '\' ');
        mysqli_query($link, 'UPDATE `settings_i18n` SET `short_name`=\'' . mysqli_escape_string($link, $this->input->post('site_title')) . '\' ');
        mysqli_query($link, 'UPDATE `settings` SET `lang_sel`=\'' . mysqli_escape_string($link, $this->input->post('lang_sel')) . '\' ');

        // TRUNCATE if "no demodata" checked
        if ($this->input->post('product_samples') != 'on') {
            mysqli_query($link, 'TRUNCATE `category`;');
            mysqli_query('INSERT INTO `category` (`id`, `name`, `url`, `per_page`, `order_by`) VALUES (\'1\', \'test\', \'test\', \'1\', \'publish_date\');', $link);
            mysqli_query('UPDATE `settings` SET `main_type`=\'category\', `main_page_cat`=\'1\';', $link);
            mysqli_query($link, 'TRUNCATE `comments`;');
            mysqli_query($link, 'TRUNCATE `content`;');
            mysqli_query($link, 'TRUNCATE `content_fields`;');
            mysqli_query($link, 'TRUNCATE `content_fields_data`;');
            mysqli_query($link, 'TRUNCATE `content_fields_groups_relations`;');
            mysqli_query($link, 'TRUNCATE `content_field_groups`;');
            mysqli_query($link, 'TRUNCATE `gallery_albums`;');
            mysqli_query($link, 'TRUNCATE `gallery_category`;');
            mysqli_query($link, 'TRUNCATE `gallery_images`;');
            mysqli_query($link, 'TRUNCATE `menus`;');
            mysqli_query($link, 'TRUNCATE `menus_data`;');
            mysqli_query($link, 'TRUNCATE `support_comments`;');
            mysqli_query($link, 'TRUNCATE `support_departments`;');
            mysqli_query($link, 'TRUNCATE `support_tickets`;');
            mysqli_query($link, 'TRUNCATE `tags`;');
            mysqli_query($link, 'TRUNCATE `content_permissions`;');
            mysqli_query($link, 'TRUNCATE `content_tags`;');
            mysqli_query($link, 'TRUNCATE `logs`;');

            $this->load->helper('file');

            if (moduleExists('shop')) {
                delete_files('./uploads/shop', TRUE);

                mysqli_query('UPDATE `settings` SET `main_type`=\'module\', `main_page_module`=\'shop\';', $link);
                mysqli_query($link, 'TRUNCATE `shop_category`;');
                mysqli_query($link, 'TRUNCATE `shop_category_i18n`;');
                mysqli_query($link, 'TRUNCATE `shop_comulativ_discount`;');
                mysqli_query($link, 'TRUNCATE `shop_discounts`;');
                mysqli_query($link, 'TRUNCATE `shop_gifts`;');
                mysqli_query($link, 'TRUNCATE `shop_kit`;');
                mysqli_query($link, 'TRUNCATE `shop_kit_product`;');
                mysqli_query($link, 'TRUNCATE `shop_notifications`;');
                mysqli_query($link, 'TRUNCATE `shop_notification_statuses`;');
                mysqli_query($link, 'TRUNCATE `shop_notification_statuses_i18n`;');
                mysqli_query($link, 'TRUNCATE `shop_orders`;');
                mysqli_query($link, 'TRUNCATE `shop_orders_products`;');
                mysqli_query($link, 'TRUNCATE `shop_orders_status_history`;');
                mysqli_query($link, 'TRUNCATE `shop_products`;');
                mysqli_query($link, 'TRUNCATE `shop_products_i18n`;');
                mysqli_query($link, 'TRUNCATE `shop_product_categories`;');
                mysqli_query($link, 'TRUNCATE `shop_product_images`;');
                mysqli_query($link, 'TRUNCATE `shop_product_properties`;');
                mysqli_query($link, 'TRUNCATE `shop_product_properties`;');
                mysqli_query($link, 'TRUNCATE `shop_product_properties_categories`;');
                mysqli_query($link, 'TRUNCATE `shop_product_properties_data`;');
                mysqli_query($link, 'TRUNCATE `shop_product_properties_data_i18n`;');
                mysqli_query($link, 'TRUNCATE `shop_product_properties_i18n`;');
                mysqli_query($link, 'TRUNCATE `shop_product_variants`;');
                mysqli_query($link, 'TRUNCATE `shop_product_variants_i18n`;');
                mysqli_query($link, 'TRUNCATE `shop_banners`;');
                mysqli_query($link, 'TRUNCATE `shop_banners_i18n`;');
                mysqli_query($link, 'TRUNCATE `shop_brands`;');
                mysqli_query($link, 'TRUNCATE `shop_brands_i18n`;');
                mysqli_query($link, 'TRUNCATE `shop_spy`;');
                mysqli_query($link, 'TRUNCATE `shop_warehouse`;');
                mysqli_query($link, 'TRUNCATE `shop_warehouse_data`;');
            }

            delete_files('./uploads/gallery', TRUE);
            delete_files('./uploads/images', TRUE);
        }

        $this->writeDatabaseConfig(
            [
             'hostname' => $this->input->post('db_host'),
             'username' => $this->input->post('db_user'),
             'password' => $this->input->post('db_pass'),
             'database' => $this->input->post('db_name'),
            ]
        );

        $this->writeCmsConfig(
            ['is_installed' => 'TRUE']
        );

        $this->load->database();

        // Create admin account
        $this->load->helper('cookie');
        delete_cookie('autologin');
        $this->load->library('DX_Auth');
        $admin_pass = crypt($this->dx_auth->_encode($this->input->post('admin_pass')));

        //        $admin_login = $this->input->post('admin_login');
        $admin_mail = $this->input->post('admin_mail');

        $admin_created = date('Y-m-d H:i:s', time());

        $sql = "INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `banned`, `ban_reason`, `newpass`, `newpass_key`, `newpass_time`, `last_ip`, `last_login`, `created`, `modified`)
                        VALUES (1, 1, 'Administrator', '$admin_pass', '$admin_mail', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '$admin_created', '0000-00-00 00:00:00'); ";

        mysqli_query($link, $sql);

        $this->cache->delete_all();

        $this->writeDatabaseConfig(
            [
             'hostname' => $this->input->post('db_host'),
             'username' => $this->input->post('db_user'),
             'password' => $this->input->post('db_pass'),
             'database' => $this->input->post('db_name'),
            ]
        );

        // login admin
        $this->dx_auth->login($this->input->post('admin_login'), $this->input->post('admin_pass'), true);

        //redirect('install/done','refresh');
        header('Location: ' . $this->host . '/install/done');
    }

    public function done() {
        chmod(getModulePath('install') . '/install.php', 0777);
        rename(getModulePath('install') . '/install.php', getModulePath('install') . '/_install.php');
        chmod(getModulePath('install') . '/install.php', 0755);
        $this->_display($this->load->view('done', '', TRUE));
    }

    /**
     *
     * @param array $data
     *  - hostname
     *  - username
     *  - password
     *  - database
     */
    public function writeDatabaseConfig($data) {
        $configFile = APPPATH . 'config/database.php';

        $this->load->helper('file');
        $configContent = read_file($configFile);

        $basePattern = "/db\['default'\]\['__KEY__'\] = '([a-zA-Z0-9\-\_]*)';/";
        $baseReplacement = "db['default']['__KEY__'] = '__VALUE__';";

        foreach ($data as $key => $value) {
            $keyPattern = str_replace('__KEY__', $key, $basePattern);
            $replacement = str_replace(['__KEY__', '__VALUE__'], [$key, $value], $baseReplacement);
            $configContent = preg_replace($keyPattern, $replacement, $configContent);
        }

        if (!write_file($configFile, $configContent)) {
            die(lang('Error writing file config.php', 'install'));
        }
    }

    /**
     * @param bool $result
     * @param int $step
     * @return string
     */
    private function _get_next_link($result = FALSE, $step = 1) {
        if ($result === TRUE) {
            $next_link = $this->host . '/install/step_' . ($step + 1);
        } else {
            $next_link = $this->host . '/install/step_' . $step;
        }

        return $next_link;
    }

    public function _display($content) {
        $data = ['content' => $content];

        $this->load->view('main', $data);
    }

    private function test_db() {
        $result = TRUE;

        $db_server = $this->input->post('db_host');
        $db_user = $this->input->post('db_user');
        $db_pass = $this->input->post('db_pass');
        $db_name = $this->input->post('db_name');

        $link = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

        if ($link == FALSE) {
            $result = FALSE;
        }

        mysqli_close($link);

        return $result;
    }

    public function writeCmsConfig($data) {
        $configFile = APPPATH . 'config/cms.php';

        $this->load->helper('file');
        $configContent = read_file($configFile);

        $basePattern = "/config\[[\'\"]{1}__KEY__[\'\"]{1}\][\s]*=[\s]*([a-zA-Z0-9\-\_]*);/";
        $baseReplacement = "config['__KEY__'] = __VALUE__;";

        foreach ($data as $key => $value) {
            $keyPattern = str_replace('__KEY__', $key, $basePattern);
            $replacement = str_replace(['__KEY__', '__VALUE__'], [$key, $value], $baseReplacement);
            $configContent = preg_replace($keyPattern, $replacement, $configContent);
        }

        if (!file_put_contents($configFile, $configContent)) {
            die(lang('Error writing file config.php', 'install'));
        }
    }

    public function change_language() {
        $language = $this->input->post('language');
        if ($language) {
            $this->session->set_userdata('language', $language);

            redirect($this->input->server('HTTP_REFERER'));
        }
    }

}