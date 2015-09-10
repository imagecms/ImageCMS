<?php

use CMSFactory\Events;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * core.php
 * @property Cms_base $cms_base
 */
class Core extends MY_Controller {

    public $langs = []; // Langs array

    public $def_lang = []; // Default language array

    public $page_content = []; // Page data

    public $cat_content = []; // Category data

    public $settings = []; // Site settings

    public $modules = []; // Modules array

    public $action = '';

    public $by_pages = FALSE;

    public $cat_page = 0;

    public $tpl_data = [];

    public $core_data = ['data_type' => null];

    public function __construct() {

        parent::__construct();
        $this->_load_languages();
        Modules::$registry['core'] = $this;
        $lang = new MY_Lang();
        $lang->load('core');
    }

    public function index() {

        $page_found = FALSE;
        $without_cat = FALSE;
        $SLASH = '';
        $mod_segment = 1;
        $data_type = '';
        $com_links = [];

        $cat_path = $this->uri->uri_string();

        $this->settings = $this->cms_base->get_settings();

        // Set site main template
        $this->config->set_item('template', $this->settings['site_template']);

        $this->load->library('template');

        if (($this->input->get() || strstr($this->input->server('REQUEST_URI'), '?')) && $this->uri->uri_string() == '') {
            $this->template->registerCanonical(site_url());
        }

        $last_element = key($this->uri->uri_to_assoc(0));

        if (defined('ICMS_INIT') AND ICMS_INIT === TRUE) {
            $data_type = 'bridge';
        }

        /* Show Analytic codes if some value inserted in admin panel */
        $this->load->library('lib_seo')->init($this->settings);

        // DETECT LANGUAGE
        if ($this->uri->total_segments() >= 1) {
            if (array_key_exists($this->uri->segment(1), $this->langs)) {
                $cat_path = substr($cat_path, strlen($this->uri->segment(1)));

                // Delete first slash
                if (substr($cat_path, 0, 1) == '/') {
                    $cat_path = substr($cat_path, 1);
                }

                $uri_lang = $this->uri->segment(1);

                $this->config->set_item('language', $this->langs[$uri_lang]['folder']);
                $this->lang->load('main', $this->langs[$uri_lang]['folder']);

                $this->config->set_item('cur_lang', $this->langs[$uri_lang]['id']);

                // Set language template
                //                $this->config->set_item('template', $this->langs[$uri_lang]['template']);

                $this->template->set_config_value('tpl_path', TEMPLATES_PATH . $this->settings['site_template'] . '/');

                $this->load_functions_file($this->settings['site_template']);

                // Reload template settings
                $this->template->load();

                // Add language identificator to base_url
                $this->config->set_item('base_url', base_url() . $uri_lang);

                $mod_segment = 2;
            } else {
                $this->use_def_language();
            }
        } else {
            $this->use_def_language();
        }
        // End language detect
        if (!preg_match('/^\/mainsaas/', $this->input->server('PATH_INFO'))) {
            if ($this->settings['site_offline'] == 'yes') {
                if ($this->session->userdata('DX_role_id') != 1) {
                    header('HTTP/1.1 503 Service Unavailable');
                    $this->template->display('offline');
                    exit;
                }
            }
        }

        if ($this->uri->segment(1) == $this->def_lang[0]['identif']) {
            $url = implode('/', array_slice($this->uri->segment_array(), 1));
            //Save GET url
            $getUrl = '';
            if ($this->input->get()) {
                foreach ($this->input->get() as $k => $v) {
                    $getUrl .= $k.'='.$v.'&';
                }
                $getUrl = substr($getUrl, 0, -1);
                $url .= '?'.$getUrl;
            }

            header('Location:/' . $url);
        }

        $this->load->library('lib_category');

        $this->lib_category->setLocaleId(CI::$APP->config->item('cur_lang'));

        $categories = $this->lib_category->build();

        $this->tpl_data['categories'] = $categories;
        $cats_unsorted = $this->lib_category->unsorted();

        // Load modules
        $query = $this->cms_base->get_modules();

        if ($query->num_rows() > 0) {
            $this->modules = $query->result_array();
            foreach ($this->modules as $k) {
                $com_links[$k['name']] = '/' . $k['identif'];
            }

            $this->tpl_data['modules'] = $com_links;
        }
        $this->load->library('DX_Auth');

        // Are we on main page?
        if (($cat_path == '/' OR $cat_path == FALSE) AND $data_type != 'bridge') {
            $data_type = 'main';
        }

        if (is_numeric($last_element) AND is_int($last_element)) {
            $cat_path = $this->_prepCatPath($cat_path);
            $this->by_pages = TRUE;
            $this->cat_page = $last_element;
        }

        if (substr($cat_path, -1) != '/') {
            $SLASH = '/';
        }

        foreach ($cats_unsorted as $cat) {
            if ($cat['path_url'] == $cat_path . $SLASH) {
                $this->cat_content = $cat;
                $data_type = 'category';
                break;
            }
        }

        if ($data_type != 'main' AND $data_type != 'category' AND $data_type != 'bridge') {
            $cat_path_url = substr($cat_path, 0, strripos($cat_path, '/') + 1);

            // Select page permissions and page data
            $this->db->select('content.*, count(comments.id) as comments_count');
            $this->db->select('CONCAT(content.cat_url,content.url ) as full_url');
            $this->db->select('content_permissions.data as roles', FALSE);
            $this->db->where('url', $last_element);
            $this->db->where('post_status', 'publish');
            $this->db->where('publish_date <=', time());
            $this->db->where('lang', $this->config->item('cur_lang'));
            $this->db->join('content_permissions', 'content_permissions.page_id = content.id', 'left');
            $this->db->join('comments', "comments.item_id = content.id AND comments.module='core' AND comments.status=0", 'left');

            // Search page without category
            if ($cat_path == $last_element) {
                $this->db->where('content.category', 0);
                $without_cat = TRUE;
            } else {
                $this->db->where('content.cat_url', $cat_path_url);
            }

            $query = $this->db->get('content', 1);

            $page_info = $query->num_rows() > 0 ? $query->row_array() : NULL;

            if ($page_info['id']) {

                $cat_path = $this->_prepCatPath($cat_path);

                $page_info['roles'] = unserialize($page_info['roles']);
                if ($without_cat == FALSE) {
                    // load page and category
                    foreach ($cats_unsorted as $cat) {
                        if (($cat['path_url'] == $cat_path . $SLASH) AND ( $cat['id'] == $page_info['category'])) {
                            $page_found = TRUE;
                            $data_type = 'page';
                            $this->page_content = $page_info;
                            $this->cat_content = $cat;
                            $this->page_content = $this->load->module('cfcm')->connect_fields($this->page_content, 'page');
                            break;
                        }
                    }
                } else {
                    // display page without category
                    $data_type = 'page';
                    $this->page_content = $page_info;
                    $this->page_content = $this->load->module('cfcm')->connect_fields($this->page_content, 'page');
                }
            } else {
                $data_type = '404';
            }
        }

        $this->core_data = [
            'data_type' => $data_type, // Possible values: page/category/main/404
        ];

        // Assign userdata
        if ($this->dx_auth->is_logged_in() == TRUE) {
            $this->tpl_data['is_logged_in'] = TRUE;
            $this->tpl_data['username'] = $this->dx_auth->get_username();
        }
        $agent = $this->user_browser();

        $this->template->add_array(
            [
                    'agent' => $agent,
                ]
        );

        //Assign captcha type
        if ($this->dx_auth->use_recaptcha) {
            $this->tpl_data['captcha_type'] = 'recaptcha';
        } else {
            $this->tpl_data['captcha_type'] = 'captcha';
        }

        // Assign template variables and load modules
        $this->_process_core_data();

        $fullUrl = explode('?', $this->input->server('HTTP_HOST') . $this->input->server('REQUEST_URI'));
        $urlWithoutGet = $fullUrl[0];
        if (strstr($urlWithoutGet, '//')) {
            $this->error_404();
        }

        // on every page load
        Events::create()->registerEvent(NULL, 'Core:pageLoaded');

        // If module than exit from core and load module
        if ($this->is_module($mod_segment) == TRUE) {
            return TRUE;
        }

        switch ($this->settings['main_type']) {
            case 'page':
                $main_id = $this->settings['main_page_id'];
                break;
            case 'category':
                $main_id = $this->settings['main_page_cat'];
                break;
            case 'module':
                $main_id = $this->settings['main_page_module'];
                break;
        }
        if ($this->core_data['data_type'] == 'main') {
            $this->core->core_data['id'] = $main_id;
            $this->_mainpage();
        } elseif ($this->core_data['data_type'] == 'category') {
            $this->core->core_data['id'] = $this->cat_content['id'];
            $this->_display_category($this->cat_content);
        } elseif ($this->core_data['data_type'] == 'page') {
            $this->check_page_access($this->page_content['roles']);
            $this->core->core_data['id'] = $this->page_content['id'];
            $this->_display_page_and_cat($this->page_content, $this->cat_content);
        } elseif ($this->core_data['data_type'] == '404') {
            $this->error_404();
        } elseif ($this->core_data['data_type'] == 'bridge') {
            log_message('debug', 'Bridge initialized.');
        }
    }

    /**
     * Display main page
     */
    public function _mainpage() {

        /** Register event 'Core:_mainpage' */
        Events::create()->registerEvent(NULL, 'Core:_mainPage')->runFactory();

        switch ($this->settings['main_type']) {
            // Load main page
            case 'page':
                $main_page_id = $this->settings['main_page_id'];

                $this->db->where('lang', $this->config->item('cur_lang'));
                $this->db->where('id', $main_page_id);
                $query = $this->db->get('content', 1);

                if ($query->num_rows() == 0) {
                    $this->db->where('lang', $this->config->item('cur_lang'));
                    $this->db->where('lang_alias', $main_page_id);
                    $query = $this->db->get('content', 1);
                }

                if ($query->num_rows() > 0) {
                    $page = $query->row_array();
                } else {
                    $this->error(lang("Home page not found.", "core"));
                }

                // Set page template file
                if ($page['full_tpl'] == NULL) {
                    $page_tpl = 'page_full';
                } else {
                    $page_tpl = $page['full_tpl'];
                }

                if ($page['full_text'] == '') {
                    $page['full_text'] = $page['prev_text'];
                }

                $page = $this->load->module('cfcm')->connect_fields($page, 'page');

                $this->template->assign('content', $this->template->read($page_tpl, ['page' => $page]));

                $this->set_meta_tags($page['meta_title'] == NULL ? $page['title'] : $page['meta_title'], $page['keywords'], $page['description']);

                if (empty($page['main_tpl'])) {
                    $this->template->show();
                } else {
                    $this->template->display($page['main_tpl']);
                }
                break;

            // Category
            case 'category':
                $m_category = $this->lib_category->get_category($this->settings['main_page_cat']);
                $this->_display_category($m_category);
                break;

            // Run module as main page
            case 'module':
                $modName = $this->settings['main_page_module'] . '';
                $module = $this->load->module($modName);
                if (is_object($module) && method_exists($module, 'index')) {
                    $module->index();
                } else {
                    $this->error(lang("Module uploading or loading  error", "core") . $modName);
                }

                break;
        }
    }

    /**
     * Display page
     */
    public function _display_page_and_cat($page = [], $category = []) {

        /** Register event 'Core:_displayPage' */
        Events::create()->registerEvent($this->page_content, 'Core:_displayPage')->runFactory();

        if (empty($page['full_text'])) {
            $page['full_text'] = $page['prev_text'];
        }

        if (count($category) > 0) {
            // Set page template file
            if ($page['full_tpl'] == NULL) {
                $page_tpl = $category['page_tpl'];
            } else {
                $page_tpl = $page['full_tpl'];
            }

            $tpl_name = $category['main_tpl'];
        } else {
            if ($page['full_tpl']) {
                $page_tpl = $page['full_tpl'];
            }
            $tpl_name = False;
        }

        empty($page_tpl) ? $page_tpl = 'page_full' : TRUE;

        $this->template->add_array(
            [
                    'page' => $page,
                    'category' => $category
                ]
        );

        if ($this->input->get()) {
            $this->template->registerCanonical(site_url());
        }

        $this->template->assign('content', $this->template->read($page_tpl));

        $page['description'] = $this->_makeDescription($page['full_text']);

        $page['keywords'] = $this->_makeKeywords($page['keywords'], $page['full_text']);

        $this->set_meta_tags($page['meta_title'] == NULL ? $page['title'] : $page['meta_title'], $page['keywords'], $page['description']);

        $this->db->set('showed', 'showed + 1', FALSE);
        $this->db->where('id', $page['id']);
        $this->db->limit(1);
        $this->db->update('content');

        Events::create()->registerEvent($this->page_content, 'page:load');
        Events::runFactory();

        if (!empty($page['main_tpl'])) {
            $tpl_name = $page['main_tpl'];
        }

        if (!$tpl_name) {
            $this->core->core_data['id'] = $page['id'];
            $this->template->show();
        } else {
            $this->template->display($tpl_name);
        }
    }

    // Select or count pages in category

    public function _get_category_pages($category = [], $row_count = 0, $offset = 0, $count = FALSE) {

        $this->db->where('post_status', 'publish');
        $this->db->where('publish_date <=', time());
        $this->db->where('lang', $this->config->item('cur_lang'));

        if (count($category['fetch_pages']) > 0) {
            $category['fetch_pages'][] = $category['id'];
            $this->db->where_in('category', $category['fetch_pages']);
        } else {
            $this->db->where('category', $category['id']);
        }

        $this->db->select('content.*');
        $this->db->select('CONCAT_WS("", content.cat_url, content.url) as full_url', FALSE);
        $this->db->order_by($category['order_by'], $category['sort_order']);

        if ($count === FALSE) {
            if ($row_count > 0) {
                $query = $this->db->get('content', (int) $row_count, (int) $offset);
            } else {
                $query = $this->db->get('content');
            }
        } else {
            $this->db->from('content');
            return $this->db->count_all_results();
        }

        $pages = $query->result_array();

        if (count($pages) > 0 AND is_array($pages)) {
            $n = 0;
            foreach ($pages as $p) {
                $pages[$n] = $this->load->module('cfcm')->connect_fields($p, 'page');
                $n++;
            }
        }

        return $pages;
    }

    /**
     * Display category
     */
    public function _display_category($category = []) {

        /** Register event 'Core:_displayCategory' */
        Events::create()->registerEvent($this->cat_content, 'Core:_displayCategory')->runFactory();

        $category['fetch_pages'] = unserialize($category['fetch_pages']);

        $content = '';

        preg_match('/^\d+$/', $this->uri->segment($this->uri->total_segments()), $matches);
        if (!empty($matches)) {
            $offset = $this->uri->segment($this->uri->total_segments());
            $segment = $this->uri->total_segments();
        } else {
            $offset = 0;
            $segment = $this->uri->total_segments() + 1;
        }

        $offset == FALSE ? $offset = 0 : TRUE;
        $row_count = $category['per_page'];

        $pages = $this->_get_category_pages($category, $row_count, $offset);

        // Count total pages for pagination
        $category['total_pages'] = $this->_get_category_pages($category, 0, 0, TRUE);

        if ($category['total_pages'] > $category['per_page']) {
            $this->load->library('Pagination');

            if (array_key_exists($this->uri->segment(1), $this->langs)) {
                $paginationConfig['base_url'] = '/' . $this->uri->segment(1) . "/" . $category['path_url'];
            } else {
                $paginationConfig['base_url'] = '/' . $category['path_url'];
            }

            $paginationConfig['total_rows'] = $category['total_pages'];
            $paginationConfig['per_page'] = $category['per_page'];
            $paginationConfig['uri_segment'] = $segment;
            include_once "./templates/{$this->config->item('template')}/paginations.php";
            $paginationConfig['page_query_string'] = false;

            $this->pagination->initialize($paginationConfig);
            $this->template->assign('pagination', $this->pagination->create_links());
        }
        // End pagination

        $this->template->assign('category', $category);

        $cnt = count($pages);

        if ($category['tpl'] == '') {
            $cat_tpl = 'category';
        } else {
            $cat_tpl = $category['tpl'];
        }

        if ($cnt > 0) {
            // Locate category tpl file
            if (!file_exists($this->template->template_dir . $cat_tpl . '.tpl')) {
                show_error(lang("Can't locate category template file."));
            }

            $content = $this->template->read($cat_tpl, ['pages' => $pages]);
        } else {
            $content = $this->template->read($cat_tpl, ['no_pages' => lang("In the category has no pages.", "core")]);
        }

        $category['title'] == NULL ? $category['title'] = $category['name'] : TRUE;

        $category['description'] = $this->_makeDescription($category['short_desc']);

        $category['keywords'] = $this->_makeKeywords($category['keywords'], $category['short_desc']);

        // adding page number for pages with pagination (from second page)
        $curPage = $this->pagination->cur_page;
        if ($curPage > 1) {
            $title = $category['title'] . ' - ' . $curPage;
            $description = $category['description'] . ' - ' . $curPage;

            $this->set_meta_tags($title, $category['keywords'], $description);
        } else {
            $this->set_meta_tags($category['title'], $category['keywords'], $category['description']);
        }

        $this->template->assign('content', $content);

        Events::create()->registerEvent($this->cat_content, 'pageCategory:load');
        Events::runFactory();

        if (!$category['main_tpl']) {
            $this->core->core_data['id'] = $category['id'];
            $this->template->show();
        } else {
            $this->core->core_data['id'] = $category['id'];
            $this->template->display($category['main_tpl']);
        }
    }

    /**
     * Load site languages
     */
    public function _load_languages() {

        // Load languages

        if (($langs = $this->cache->fetch('main_site_langs')) === FALSE) {
            $langs = $this->cms_base->get_langs();
            $this->cache->store('main_site_langs', $langs);
        }

        foreach ($langs as $lang) {
            $this->langs[$lang['identif']] = [
                'id' => $lang['id'],
                'name' => $lang['lang_name'],
                'folder' => $lang['folder'],
                'template' => $lang['template'],
                'image' => $lang['image']
            ];

            if ($lang['default'] == 1) {
                $this->def_lang = [$lang];
            }
        }
    }

    /**
     * Load and run modules
     */
    private function load_modules() {

        foreach ($this->modules as $module) {
            if ($module['autoload'] == 1) {
                $mod_name = $module['name'];

                $this->load->module($mod_name);
                if (method_exists($mod_name, 'autoload') === TRUE) {
                    $this->core_data['module'] = $mod_name;
                    $this->$mod_name->autoload();
                    /** @todo why? */
                    self::$detect_load[$mod_name] = 1;
                }
            }
        }

        // Check url segments
        $this->_check_url();
    }

    /**
     * Deny access to modules install/deinstall/rules/etc/ methods
     */
    private function _check_url() {

        $CI = &get_instance();

        $error_text = $this->lang->line('uri_access_deny');

        $not_permitted = ['_install', '_deinstall', '_install_rules', 'autoload', '__construct'];

        $url_segs = $CI->uri->segment_array();

        // Deny uri access to all methods like _somename
        if (count(explode('/_', $CI->uri->uri_string())) > 1) {
            $this->error($error_text, FALSE);
        }

        if (count($url_segs) > 0) {
            foreach ($url_segs as $segment) {
                if (in_array($segment, $not_permitted) == TRUE) {
                    $this->error($error_text, FALSE);
                }
            }
        }
    }

    private function _process_core_data() {
        class_exists('ShopCore') && ShopCore::initEnviroment();
        $this->template->add_array($this->tpl_data);
        $this->load_modules();
    }

    /**
     * htmlspecialchars_decode text
     *
     * @return string
     */
    public function _prepare_content($text = '') {

        return htmlspecialchars_decode($text);
    }

    /**
     * Page not found
     * Show 404 error
     */
    public function error_404() {

        header('HTTP/1.1 404 Not Found');
        $this->set_meta_tags(lang("Page not found", "core"));
        $this->template->assign('error_text', lang("Page not found.", "core"));
        $this->template->show('404');
        exit;
    }

    /**
     * Display error template end exit
     */
    public function error($text, $back = TRUE) {

        $this->template->add_array(
            [
                    'content' => $this->template->read('error', ['error_text' => $text, 'back_button' => $back])
                ]
        );

        $this->template->show();
        exit;
    }

    /**
     *  Language detection in url segments
     */
    public function segment($n) {

        if (array_key_exists($this->uri->segment(1), $this->langs)) {
            $n++;
            return $this->uri->segment($n);
        }

        return $this->uri->segment($n);
    }

    /**
     * Run module
     *
     * @access private
     * @param integer $n
     * @return bool
     */
    private function is_module($n) {

        $segment = $this->uri->segment($n);
        $found = FALSE;

        foreach ($this->modules as $k) {
            if ($k['identif'] === $segment AND $k['enabled'] == 1) {
                $found = TRUE;
                $mod_name = $k['identif'];
            }
        }

        if ($found == TRUE) {
            $mod_function = $this->uri->segment($n + 1);

            if ($mod_function == FALSE) {
                $mod_function = 'index';
            }

            $file = getModulePath($mod_name) . $mod_function . EXT;

            $this->core_data['module'] = $mod_name;

            if (file_exists($file)) {
                // Run module
                $func = $this->uri->segment($n + 2);
                if ($func == FALSE) {
                    $func = 'index';
                }

                $args = $this->grab_variables($n + 3);

                $this->load->module($mod_name . '/' . $mod_function);

                if (method_exists($mod_function, $func)) {
                    echo modules::run($mod_name . '/' . $mod_function . '/' . $func, $args);
                } else {
                    $this->error_404();
                }
            } else {
                $args = $this->grab_variables($n + 2);
                $this->load->module($mod_name);
                if (method_exists($mod_name, $mod_function)) {
                    echo modules::run($mod_name . '/' . $mod_name . '/' . $mod_function, $args);
                } else {
                    // If method not found display 404 error.
                    $this->error_404();
                }
            }

            return TRUE;
        }
        return FALSE;
    }

    /*
     * Check user access for page
     */

    public function check_page_access($roles) {

        if ($roles == FALSE OR count($roles) == 0) {
            return TRUE;
        }

        $access = FALSE;
        $logged = $this->dx_auth->is_logged_in();
        $my_role = $this->dx_auth->get_role_id();

        if ($this->dx_auth->is_admin() === TRUE) {
            $access = TRUE;
        }

        // Check roles access
        if ($access != TRUE) {
            foreach ($roles as $role) {
                if ($role['role_id'] == $my_role) {
                    $access = TRUE;
                }

                if ($role['role_id'] == 1 AND $logged == TRUE) {
                    $access = TRUE;
                }

                if ($role['role_id'] == '0') {
                    $access = TRUE;
                }
            }
        }

        if ($access == FALSE) {
            $this->dx_auth->deny_access('deny');
            exit;
        }
    }

    /**
     * Grab uri segments to args array
     *
     * @access public
     * @param integer $n
     * @return array
     */
    public function grab_variables($n) {

        $args = [];

        foreach ($this->uri->uri_to_assoc($n) as $k => $v) {
            if (isset($k)) {
                array_push($args, $k);
            }
            if (isset($v)) {
                array_push($args, $v);
            }
        }

        for ($i = 0, $cnt = count($args); $i < $cnt; $i++) {
            if ($args[$i] === FALSE) {
                unset($args[$i]);
            }
        }

        return $args;
    }

    /*
     * Use default language
     */

    private function use_def_language() {

        $this->load_functions_file($this->settings['site_template']);

        // Set config item
        $this->config->set_item('language', $this->def_lang[0]['folder']);

        // Load Language
        $this->lang->load('main', $this->def_lang[0]['folder']);

        // Set current language variable
        $this->config->set_item('cur_lang', $this->def_lang[0]['id']);
    }

    private function load_functions_file($tpl_name) {

        $full_path = './templates/' . $tpl_name . '/functions.php';

        if (file_exists($full_path)) {
            include $full_path;
        }
    }

    /**
     * Set meta tags for pages
     */
    public function set_meta_tags($title = '', $keywords = '', $description = '', $page_number = '', $showsitename = 0, $category = '') {

        if ($this->core_data['data_type'] == 'main') {
            $this->template->add_array(
                [
                        'site_title' => empty($this->settings['site_title']) ? $title : $this->settings['site_title'],
                        'site_description' => empty($this->settings['site_description']) ? $description : $this->settings['site_description'],
                        'site_keywords' => empty($this->settings['site_keywords']) ? $keywords : $this->settings['site_keywords']
                    ]
            );
        } else {
            if (($page_number > 1) && ($page_number != '')) {
                $title = lang('Page', 'core') . ' №' . $page_number . ' - ' . $title;
            }

            if ($description != '') {
                if ($page_number > 1 && $page_number != '') {
                    $description = "$page_number - $description {$this->settings['delimiter']} {$this->settings['site_short_title']}";
                } else {
                    $description = "$description {$this->settings['delimiter']} {$this->settings['site_short_title']}";
                }
            }

            if ($this->settings['add_site_name_to_cat']) {
                if ($category != '') {
                    $title .= ' - ' . $category;
                }
            }

            if ($this->core_data['data_type'] == 'page' AND $this->page_content['category'] != 0 AND $this->settings['add_site_name_to_cat']) {
                $title .= ' ' . $this->settings['delimiter'] . ' ' . $this->cat_content['name'];
            }

            if (is_array($title)) {
                $n_title = '';
                foreach ($title as $k => $v) {
                    $n_title .= $v;

                    if ($k < count($title) - 1) {
                        $n_title .= ' ' . $this->settings['delimiter'] . ' ';
                    }
                }
                $title = $n_title;
            }

            if ($this->settings['add_site_name'] == 1 && $showsitename != 1) {
                $title .= ' ' . $this->settings['delimiter'] . ' ' . $this->settings['site_short_title'];
            }

            if ($this->settings['create_description'] == 'empty') {
                $description = '';
            }
            if ($this->settings['create_keywords'] == 'empty') {
                $keywords = '';
            }

            $page_number = $page_number ? : (int) $this->pagination->cur_page;
            $this->template->add_array(
                [
                        'site_title' => $title,
                        'site_description' => htmlspecialchars($description),
                        'site_keywords' => htmlspecialchars($keywords),
                        'page_number' => $page_number
                    ]
            );
        }
    }

    private function user_browser() {

        $this->load->library('user_agent');
        $browserIn = [
            '0' => $this->agent->browser(),
            '1' => $this->agent->version()
        ];
        return $browserIn;
    }

    public function robots() {

        $robotsSettings = $this->db->select('robots_settings,robots_settings_status,robots_status')->get('settings');
        if ($robotsSettings) {
            $robotsSettings = $robotsSettings->row();
        }
        //$robotTxt = file_get_contents('robots.txt');
        header("Content-type: text/plain");
        if ($robotsSettings->robots_status == '1') {
            if ($robotsSettings->robots_settings_status == '1') {
                if (trim($robotsSettings->robots_settings)) {
                    echo $robotsSettings->robots_settings;
                    exit;
                } else {
                    header("Content-type: text/plain");
                    echo "User-agent: * \r\nDisallow: /";
                    echo "\r\nHost: " . $this->input->server('HTTP_HOST');
                    echo "\r\nSitemap: " . site_url('sitemap.xml');
                    exit;
                }
            } else {

                header("Content-type: text/plain");
                echo "User-agent: * \r\nDisallow: ";
                echo "\r\nHost: " . $this->input->server('HTTP_HOST');
                echo "\r\nSitemap: " . site_url('sitemap.xml');
                exit;
            }
        } else {
            header("Content-type: text/plain");
            echo "User-agent: * \r\nDisallow: /";
            echo "\r\nHost: " . $this->input->server('HTTP_HOST');
            echo "\r\nSitemap: " . site_url('sitemap.xml');
            exit;
        }
    }

    /**
     *
     * @param string $cat_path
     * @return string
     */
    public function _prepCatPath($cat_path) {
        if (substr($cat_path, -1) == '/') {
            $cat_path = substr($cat_path, 0, -1);
        }

        // Delete page number from path
        $cat_path = substr($cat_path, 0, strripos($cat_path, '/'));

        return $cat_path;
    }

    /**
     *
     * @param string $description
     * @return string
     */
    public function _makeDescription($description) {
        if ($this->settings['create_description'] == 'auto' && !$description) {
            $description = $this->lib_seo->get_description($description);
        }

        return $description;
    }

    /**
     *
     * @param string $keywords
     * @param string $text
     * @return string
     */
    public function _makeKeywords($keywords, $text) {
        if ($this->settings['create_keywords'] == 'auto' && !$keywords) {
            $keywords = $this->lib_seo->get_keywords($text, TRUE);

            $keywords = implode(', ', array_keys($keywords));
        }

        return $keywords;
    }

}

/* End of file core.php */