<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Install extends MY_Controller {

    public $host = '';
    public $useSqlFile = 'sql.sql'; // sqlShop.sql
    private $exts = FALSE;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('install');
//        $this->host = 'http://' . str_replace('index.php', '', $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']) . 'index.php/';
        $this->load->helper('string');
        $this->load->helper('form_csrf');
        $this->host = reduce_multiples($this->host);
    }

    public function index() {
        if (file_exists('./application/modules/shop')) {
            $data = array(
                'content' => $this->load->view('license_shop', array('next_link' => $this->host . '/install/step_1'), TRUE),
            );
        } else {
            $data = array(
                'content' => $this->load->view('license', array('next_link' => $this->host . '/install/step_1'), TRUE),
            );
        }
        $this->load->view('main', $data);
    }

    public function step_1() {
        $result = TRUE;

        // Check folders permissions
        $dir_array = array(
            './application/config/config.php' => 'ok',
            './system/cache' => 'ok',
            './captcha/' => 'ok',
            './system/cache/templates_c' => 'ok',
            './uploads/' => 'ok',
            './uploads/images' => 'ok',
            './uploads/files' => 'ok',
            './uploads/media' => 'ok',
        );

        foreach ($dir_array as $k => $v) {
            if (is_really_writable($k) === TRUE) {
                $dir_array[$k] = 'ok';
            } else {
                $dir_array[$k] = 'err';
                $result = FALSE;
            }
        }

        // Check server params

        $allow_params = array(
            'register_globals' => 'ok',
            'safe_mode' => 'ok',
        );

        foreach ($allow_params as $k => $v) {
            if (ini_get($k) == 1) {
                $allow_params[$k] = 'warning';
            } else {
                $allow_params[$k] = 'ok';
            }
        }

        if (strnatcmp(phpversion(), '5.3.4') != -1) {
            $allow_params['PHP version >= 5.3.4'] = 'ok';
        } else {
            $allow_params['PHP version >= 5.3.4'] = 'err';
            $result = false;
        }

        // Check installed php exts.
        $exts = array(
            'curl' => 'ok',
            'json' => 'ok',
            'mbstring' => 'ok',
            'iconv' => 'ok',
            'gd' => 'ok',
            'zlib' => 'ok',
            'gettext' => 'ok',
            'soap' => 'ok'
        );

        foreach ($exts as $k => $v) {
            if ($this->_get_ext($k) === FALSE) {
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
            }
        }

        $locales = array(
            'en_US' => 'ok',
            'ru_RU' => 'ok'
        );

        foreach ($locales as $locale => $v) {
            if (!setlocale(LC_ALL, $locale . '.utf8', $locale . '.utf-8', $locale . '.UTF8', $locale . '.UTF-8', $locale . '.utf-8', $locale . '.UTF-8', $locale)) {
                if (!setlocale(LC_ALL, '')) {
                    $locales[$locale] = 'warning';
                }
            } 
        }

        $data = array(
            'dirs' => $dir_array,
            'need_params' => $need_params,
            'allow_params' => $allow_params,
            'exts' => $exts,
            'locales' => $locales,
            'next_link' => $this->_get_next_link($result, 1),
        );
        $this->_display($this->load->view('step_1', $data, TRUE));
    }

    private function _get_ext($name = '') {
        if ($this->exts === FALSE) {
            ob_start();
            phpinfo(INFO_MODULES);
            $this->exts = ob_get_contents();
            ob_end_clean();
            $this->exts = strip_tags($this->exts, '<h2><th><td>');
        }

        $result = preg_match("/<h2>.*$name.*<\/h2>/", $this->exts, $m);

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

        if (count($_POST) > 0) {
            $this->form_validation->set_rules('site_title', lang('Site name', 'install'), 'required');
            $this->form_validation->set_rules('db_host', lang('Host', 'install'), 'required');
            $this->form_validation->set_rules('db_user', lang('Database username', 'install'), 'required');
            //$this->form_validation->set_rules('db_pass', 'Пароль БД', 'required');
            $this->form_validation->set_rules('db_name', lang('Database name', 'install'), 'required');
//            $this->form_validation->set_rules('admin_login', 'Логин администратора', 'required|min_length[4]');
            $this->form_validation->set_rules('admin_pass', lang('Administrator name', 'install'), 'required|min_length[5]');
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

        $data = array(
            'next_link' => $this->_get_next_link($result, 2),
            'other_errors' => $other_errors,
            'host' => $this->host,
            'sqlFileName' => $this->useSqlFile,
        );
        $this->_display($this->load->view('step_2', $data, TRUE));
    }

    private function make_install() {
        $this->load->helper('file');
        $this->load->helper('url');

        $db_server = $this->input->post('db_host');
        $db_user = $this->input->post('db_user');
        $db_pass = $this->input->post('db_pass');
        $db_name = $this->input->post('db_name');

        $link = mysql_connect($db_server, $db_user, $db_pass);
        $db_sel = mysql_select_db($db_name);

        // Drop all tables in DB
        $tables = array();
        $sql = "SHOW TABLES FROM $db_name";
        if ($result = mysql_query($sql, $link)) {
            while ($row = mysql_fetch_row($result)) {
                $tables[] = $row[0];
            }
        }

        if (count($tables) > 0) {
            foreach ($tables as $t) {
                $sql = "DROP TABLE $db_name.$t";
                if (!mysql_query($sql, $link)) {
                    die("MySQL error. Can\'t delete $db_name.$t");
                }
            }
        }

        mysql_query('SET NAMES `utf8`;', $link);
        $sqlFileData = read_file(dirname(__FILE__) . '/' . $this->useSqlFile);

        $queries = explode(";\n", $sqlFileData);

        foreach ($queries as $q) {
            $q = trim($q);

            if ($q != '') {
                mysql_query($q . ';', $link);
            }
        }


        // Update site title
        mysql_query('UPDATE `settings_i18n` SET `name`=\'' . mysql_real_escape_string($this->input->post('site_title')) . '\' ', $link);
        mysql_query('UPDATE `settings_i18n` SET `short_name`=\'' . mysql_real_escape_string($this->input->post('site_title')) . '\' ', $link);
        mysql_query('UPDATE `settings` SET `lang_sel`=\'' . mysql_real_escape_string($this->input->post('lang_sel')) . '\' ', $link);

        // TRUNCATE if user want (product_samples not chacked)
        if ($this->input->post('product_samples') != "on") {
            mysql_query('TRUNCATE `category`;', $link);
            mysql_query('INSERT INTO `category` (`id`, `name`, `url`, `per_page`, `order_by`) VALUES (\'1\', \'test\', \'test\', \'1\', \'publish_date\');', $link);
            mysql_query('UPDATE `settings` SET `main_type`=\'category\', `main_page_cat`=\'1\';', $link);
            mysql_query('TRUNCATE `comments`;', $link);
            mysql_query('TRUNCATE `content`;', $link);
            mysql_query('TRUNCATE `content_fields`;', $link);
            mysql_query('TRUNCATE `content_fields_data`;', $link);
            mysql_query('TRUNCATE `content_fields_groups_relations`;', $link);
            mysql_query('TRUNCATE `content_field_groups`;', $link);
            mysql_query('TRUNCATE `gallery_albums`;', $link);
            mysql_query('TRUNCATE `gallery_category`;', $link);
            mysql_query('TRUNCATE `gallery_images`;', $link);
            mysql_query('TRUNCATE `menus`;', $link);
            mysql_query('TRUNCATE `menus_data`;', $link);
            mysql_query('TRUNCATE `support_comments`;', $link);
            mysql_query('TRUNCATE `support_departments`;', $link);
            mysql_query('TRUNCATE `support_tickets`;', $link);
            mysql_query('TRUNCATE `tags`;', $link);
            mysql_query('TRUNCATE `content_permissions`;', $link);
            mysql_query('TRUNCATE `content_tags`;', $link);
            mysql_query('TRUNCATE `logs`;', $link);

            $this->load->helper("file");

            if (file_exists('./application/modules/shop')) {
                delete_files('./uploads/shop', TRUE);

                mysql_query('UPDATE `settings` SET `main_type`=\'module\', `main_page_module`=\'shop\';', $link);
                mysql_query('TRUNCATE `shop_category`;', $link);
                mysql_query('TRUNCATE `shop_category_i18n`;', $link);
                mysql_query('TRUNCATE `shop_comulativ_discount`;', $link);
                mysql_query('TRUNCATE `shop_discounts`;', $link);
                mysql_query('TRUNCATE `shop_gifts`;', $link);
                mysql_query('TRUNCATE `shop_kit`;', $link);
                mysql_query('TRUNCATE `shop_kit_product`;', $link);
                mysql_query('TRUNCATE `shop_notifications`;', $link);
                mysql_query('TRUNCATE `shop_notification_statuses`;', $link);
                mysql_query('TRUNCATE `shop_notification_statuses_i18n`;', $link);
                mysql_query('TRUNCATE `shop_orders`;', $link);
                mysql_query('TRUNCATE `shop_orders_products`;', $link);
                mysql_query('TRUNCATE `shop_orders_status_history`;', $link);
                mysql_query('TRUNCATE `shop_products`;', $link);
                mysql_query('TRUNCATE `shop_products_i18n`;', $link);
                mysql_query('TRUNCATE `shop_product_categories`;', $link);
                mysql_query('TRUNCATE `shop_product_images`;', $link);
                mysql_query('TRUNCATE `shop_product_properties`;', $link);
                mysql_query('TRUNCATE `shop_product_properties`;', $link);
                mysql_query('TRUNCATE `shop_product_properties_categories`;', $link);
                mysql_query('TRUNCATE `shop_product_properties_data`;', $link);
                mysql_query('TRUNCATE `shop_product_properties_data_i18n`;', $link);
                mysql_query('TRUNCATE `shop_product_properties_i18n`;', $link);
                mysql_query('TRUNCATE `shop_product_variants`;', $link);
                mysql_query('TRUNCATE `shop_product_variants_i18n`;', $link);
                mysql_query('TRUNCATE `shop_banners`;', $link);
                mysql_query('TRUNCATE `shop_banners_i18n`;', $link);
                mysql_query('TRUNCATE `shop_brands`;', $link);
                mysql_query('TRUNCATE `shop_brands_i18n`;', $link);
                mysql_query('TRUNCATE `shop_spy`;', $link);
                mysql_query('TRUNCATE `shop_warehouse`;', $link);
                mysql_query('TRUNCATE `shop_warehouse_data`;', $link);
            }

            delete_files('./uploads/gallery', TRUE);
            delete_files('./uploads/images', TRUE);
        }

        // Create admin account
        $this->load->helper('cookie');
        delete_cookie('autologin');
        $this->load->library('DX_Auth');
        $admin_pass = crypt($this->dx_auth->_encode($this->input->post('admin_pass')));
        $admin_login = mysql_real_escape_string($this->input->post('admin_login'));
        $admin_mail = mysql_real_escape_string($this->input->post('admin_mail'));

        $admin_created = date('Y-m-d H:i:s', time());

        $sql = "INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `banned`, `ban_reason`, `newpass`, `newpass_key`, `newpass_time`, `last_ip`, `last_login`, `created`, `modified`)
                        VALUES (1, 1, 'Administrator', '$admin_pass', '$admin_mail', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '$admin_created', '0000-00-00 00:00:00'); ";

        mysql_query($sql, $link);

        $this->cache->delete_all();
        // Rewrite config file
        $this->write_config_file();

        //redirect('install/done','refresh');
        header("Location: " . $this->host . "/install/done");
    }

    public function done() {
        $this->_display($this->load->view('done', '', TRUE));
    }

    private function write_config_file() {
        $config_file = APPPATH . 'config/config.php';
        $config_file_copy = APPPATH . 'modules/install/config.php';

        $this->load->helper('file');
        $config = read_file($config_file_copy);

        $db_server = $this->input->post('db_host');
        $db_user = $this->input->post('db_user');
        $db_pass = $this->input->post('db_pass');
        $db_name = $this->input->post('db_name');

        $db_settings = "\$db['default']['hostname'] = '$db_server';
            \$db['default']['username'] = '$db_user';
            \$db['default']['password'] = '$db_pass';
            \$db['default']['database'] = '$db_name';
            \$db['default']['dbdriver'] = 'mysql';
            \$db['default']['dbprefix'] = '';
            \$db['default']['pconnect'] = FALSE;
            \$db['default']['db_debug'] = FALSE;
            \$db['default']['cache_on'] = FALSE;
            \$db['default']['cachedir'] = 'system/cache';
            \$db['default']['char_set'] = 'utf8';
            \$db['default']['dbcollat'] = 'utf8_general_ci';
            \$db['default']['swap_pre'] = '';
            \$db['default']['autoinit'] = TRUE;
            \$db['default']['stricton'] = FALSE;
            ";

        $config = str_replace('{DB_SETTINGS}', $db_settings, $config);

        if (!write_file($config_file, $config)) {
            die(lang('Error writing file config.php', 'install'));
        }
    }

    private function _get_next_link($result = FALSE, $step = 1) {
        if ($result === TRUE) {
            $next_link = $this->host . '/install/step_' . ($step + 1);
        } else {
            $next_link = $this->host . '/install/step_' . $step;
        }

        return $next_link;
    }

    public function _display($content) {
        $data = array(
            'content' => $content,
        );

        $this->load->view('main', $data);
    }

    private function test_db() {
        $result = TRUE;

        $db_server = $this->input->post('db_host');
        $db_user = $this->input->post('db_user');
        $db_pass = $this->input->post('db_pass');
        $db_name = $this->input->post('db_name');

        $link = mysql_connect($db_server, $db_user, $db_pass);
        $db_sel = mysql_select_db($db_name);

        if ($link == FALSE OR $db_sel == FALSE) {
            $result = FALSE;
        }

        mysql_close($link);

        return $result;
    }

    public function change_language() {
        $language = $this->input->post('language');
        if ($language) {
            $this->session->set_userdata('language', $language);

            redirect($_SERVER['HTTP_REFERER']);
        }
    }

}

/* End of file install.php */
