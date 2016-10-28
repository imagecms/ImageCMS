<?php

use CMSFactory\Events;
use core\models\Route;
use core\src\CoreFactory;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Sitemap Module
 * @property Sitemap_model $sitemap_model
 * @property Lib_category lib_category
 * @property smart_filter smart_filter
 */
class Sitemap extends MY_Controller
{

    /**
     * Blocked urls array
     * @var array
     */
    public $blocked_urls = [];

    /**
     * Frequency for brands pages
     * @var string
     */
    public $brands_changefreq = 'daily';

    /**
     * Priority for brands pages
     * @var int
     */
    public $brands_priority = '1';

    /**
     * Frequency for categories pages
     * @var string
     */
    public $categories_changefreq = 'daily'; // priority for subcategories pages

    /**
     * Priority for categories
     * @var int
     */
    public $cats_priority = '1';

    /**
     * Default frequency
     * @var string
     */
    public $changefreq = 'daily';

    /**
     * Default lang
     * @var array
     */
    public $default_lang = [];

    /**
     * Gzip level
     * @var int
     */
    public $gzip_level = 0;

    /**
     * Sitemap items
     * @var array
     */
    public $items = [];

    /**
     * Langs array
     * @var array
     */
    public $langs = [];

    /**
     * Frequency for main page
     * @var string
     */
    public $main_page_changefreq = 'daily';

    /**
     * Priority for main page
     * @var int
     */
    public $main_page_priority = '1';

    /**
     * Max url tag count
     * @var int
     */
    private $max_url_count = 30000;

    /**
     * Frequency for pages
     * @var string
     */
    public $pages_changefreq = 'daily';

    /**
     * Priority for pages
     * @var int
     */
    public $pages_priority = '1';

    /**
     * Frequency for products categories pages
     * @var string
     */
    public $products_categories_changefreq = 'daily';

    /**
     * Priority for products categories pages
     * @var int
     */
    public $products_categories_priority = '1';

    /**
     * Frequency for products pages
     * @var string
     */
    public $products_changefreq = 'daily';

    /**
     * Priority for products pages
     * @var int
     */
    public $products_priority = '1';

    /**
     * Frequency for products sub categiries pages
     * @var string
     */
    public $products_sub_categories_changefreq = 'daily';

    /**
     * Priority for products sub categories pages
     * @var int
     */
    public $products_sub_categories_priority = '1';

    /**
     * Sitemap result
     * @var string
     */
    public $result = '';

    /**
     * Path to folder where site_maps files exists
     * @var string
     */
    private $site_map_folder_path = './uploads/sitemaps';

    /**
     * Path to saved sitemap file
     * @var string
     */
    private $sitemap_path = './uploads/sitemaps/sitemap.xml';

    /**
     * Frequency for sub categories pages
     * @var string
     */
    public $sub_categories_changefreq = 'daily';

    /**
     * Priority for subcategories pages
     * @var int
     */
    public $sub_cats_priority = '1';

    /**
     * Sitemap constructor.
     */
    public function __construct() {

        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('sitemap');

        $this->load->module('core');
        $this->load->model('sitemap_model');
        $this->langs = CoreFactory::getConfiguration()->getLanguages();
        $this->default_lang = CoreFactory::getConfiguration()->getDefaultLanguage();
        if (uri_string() == 'sitemap.xml') {
            $this->build_xml_map();
            exit();
        }

        if (uri_string() == 'sitemapRegenerate.xml') {
            $this->build_xml_map_regenerated();
            exit();
        }
    }

    public function build_xml_map_regenerated() {

        $this->build_xml_map(TRUE);
    }

    /**
     * Create and display sitemap xml
     * @param bool $regenerate
     */
    public function build_xml_map($regenerate = FALSE) {

        $settings = $this->sitemap_model->load_settings();

        // Generate new or use saved map
        if ((int) $settings['generateXML'] || $regenerate) {
            $this->_create_map();
        } else {
            if (file_exists($this->sitemap_path)) {
                $this->result = file_get_contents($this->sitemap_path);
            } else {
                $this->_create_map();
            }
        }

        // Show Site Map
        if ($this->result) {
            header('content-type: text/xml');
            echo $this->result;
        }
    }

    /**
     * Create map
     */
    public function _create_map() {

        if ($this->robotsCheck()) {
            $this->initialize();

            // Add main pagez
            $this->items[] = [
                              'loc'        => site_url(),
                              'changefreq' => $this->main_page_changefreq,
                              'priority'   => $this->main_page_priority,
                              'lastmod'    => date('Y-m-d', time()),
                             ];
            $this->getPagesCategories();
            $this->getAllPages();

            if (SHOP_INSTALLED) {

                $this->getShopCategories();
                $this->getShopBrands();
                $this->getShopProducts();

                $this->load->module('smart_filter');
                if (method_exists($this->smart_filter, 'attachPages')) {
                    $this->smart_filter->attachPages($this);
                }
            }
        }
        $this->result = $this->generate_xml($this->items);
        return $this->result;
    }

    /**
     * Initialize module settings
     */
    public function initialize() {

        // Get sitemap values
        $priorities = $this->sitemap_model->getPriorities();
        $changfreq = $this->sitemap_model->getChangefreq();
        $blocked_urls = $this->sitemap_model->getBlockedUrls();

        // Initialize priorities
        if ($priorities) {
            $this->main_page_priority = $priorities['main_page_priority'];
            $this->cats_priority = $priorities['cats_priority'];
            $this->pages_priority = $priorities['pages_priority'];
            $this->sub_cats_priority = $priorities['sub_cats_priority'];
            $this->products_priority = $priorities['products_priority'];
            $this->products_categories_priority = $priorities['products_categories_priority'];
            $this->products_sub_categories_priority = $priorities['products_sub_categories_priority'];
            $this->brands_priority = $priorities['brands_priority'];
        }

        // Initialize changfreq
        if ($changfreq) {
            $this->main_page_changefreq = $changfreq['main_page_changefreq'];
            $this->categories_changefreq = $changfreq['categories_changefreq'];
            $this->products_categories_changefreq = $changfreq['products_categories_changefreq'];
            $this->products_sub_categories_changefreq = $changfreq['products_sub_categories_changefreq'];
            $this->pages_changefreq = $changfreq['pages_changefreq'];
            $this->products_changefreq = $changfreq['product_changefreq'];
            $this->brands_changefreq = $changfreq['brands_changefreq'];
            $this->sub_categories_changefreq = $changfreq['sub_categories_changefreq'];
        }

        // Initialize Blocked urls
        if ($blocked_urls) {
            foreach ($blocked_urls as $url) {
                $this->blocked_urls[] = $url['url'];
            }
        }

        return $this;
    }

    /**
     * Check robots
     * @return boolean
     */
    public function robotsCheck() {

        return (bool) $this->db->get('settings')
            ->row()
            ->robots_status;

    }

    /**
     * Get pages categories
     */
    private function getPagesCategories() {

        // Add categories to sitemap urls.
        $categories = $this->lib_category->unsorted();

        foreach ($categories as $category) {

            if ((int) $category['parent_id']) {
                $changefreq = $this->sub_categories_changefreq;
                $priority = $this->sub_cats_priority;
            } else {
                $changefreq = $this->categories_changefreq;
                $priority = $this->cats_priority;
            }

            // create date
            if ($category['updated'] > 0) {
                $date = date('Y-m-d', $category['updated']);
            } else {
                $date = date('Y-m-d', $category['created']);
            }

            if ($this->not_blocked_url($category['path_url'])) {

                $this->items[] = [
                                  'loc'        => site_url($category['path_url']),
                                  'changefreq' => $changefreq,
                                  'priority'   => $priority,
                                  'lastmod'    => $date,
                                 ];
            }

            // Add links to categories in all langs.
            foreach ($this->langs as $lang_indentif => $lang) {
                if ($lang['id'] != $this->default_lang['id']) {
                    $url = $lang_indentif . '/' . $category['path_url'];
                    if ($this->not_blocked_url($url)) {
                        $this->items[] = [
                                          'loc'        => site_url($url),
                                          'changefreq' => $changefreq,
                                          'priority'   => $priority,
                                          'lastmod'    => $date,
                                         ];
                    }
                }
            }

        }
    }

    /**
     * Chech is url blocked
     * @param string $url
     * @return boolean
     */
    public function not_blocked_url($url) {

        if (!in_array($url, $this->blocked_urls) && !in_array(substr($url, 0, -1), $this->blocked_urls)) {
            foreach ($this->blocked_urls as $blocked_url) {
                $url = str_replace(site_url(), '', $url);

                if (mb_strpos($url, '/') === 0) {
                    $url = substr($url, 1);
                }

                if (mb_strrpos($url, '/') === (mb_strlen($url) - 1)) {
                    $url = substr($url, 0, -1);
                }

                $url_length = mb_strlen($blocked_url);
                $last_symbol = substr($blocked_url, $url_length - 1);
                $first_symbol = substr($blocked_url, 0, 1);
                $blocked_url_tpm = str_replace('*', '', $blocked_url);

                if ($last_symbol == '*') {
                    $url_position = mb_strpos($url, $blocked_url_tpm);
                    if ($url_position === 0) {
                        return FALSE;
                    }
                }

                if ($first_symbol == '*') {
                    $must_be_in_pos = (int) mb_strlen($url) - (int) mb_strlen($blocked_url_tpm);
                    $url_position = mb_strrpos($url, $blocked_url_tpm);
                    if ($must_be_in_pos == $url_position) {
                        return FALSE;
                    }
                }
            }

            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Get all content pages
     */
    private function getAllPages() {

        // Get all pages
        $pages = $this->sitemap_model->get_all_pages();

        foreach ($pages as $page) {

            // create page url
            if ($page['lang'] == $this->default_lang['id']) {
                $url = site_url($page['full_url']);
                $url_page = $page['full_url'];
            } else {
                $prefix = $this->_get_lang_prefix($page['lang']);
                $url_page = $prefix . '/' . $page['full_url'];
                $url = site_url($url_page);
            }

            // create date
            if ($page['updated'] > 0) {
                $date = date('Y-m-d', $page['updated']);
            } else {
                $date = date('Y-m-d', $page['created']);
            }

            if ($page['cat_url'] == '') {
                $c_priority = $this->cats_priority;
            } else {
                $c_priority = $this->pages_priority;
            }

            if ($this->not_blocked_url($url_page)) {
                $this->items[] = [
                                  'loc'        => $url,
                                  'changefreq' => $this->pages_changefreq,
                                  'priority'   => $c_priority,
                                  'lastmod'    => $date,
                                 ];
            }

        }
    }

    /**
     * Get language prefix by lang id
     * @param int $id
     * @return int|string
     */
    private function _get_lang_prefix($id) {

        foreach ($this->langs as $k => $v) {
            if ($v['id'] === $id) {
                return $k;
            }
        }
    }

    /**
     * Get products categories
     */
    private function getShopCategories() {

        // Get Shop Categories
        $shop_categories = $this->sitemap_model->get_shop_categories();

        // Add categories to Site Map
        foreach ($shop_categories as $shopCategory) {

            if ($this->sitemap_model->categoryIsActive($shopCategory['id'])) {

                $localeSegment = $shopCategory['locale'] == self::defaultLocale() ? '' : $shopCategory['locale'] . '/';

                $url = $localeSegment . Route::createRouteUrl($shopCategory['url'], $shopCategory['parent_url'], Route::TYPE_SHOP_CATEGORY);
                if ($this->not_blocked_url($url)) {

                    // Check if category is subcategory
                    if ((int) $shopCategory['parent_id']) {
                        $changefreq = $this->products_sub_categories_changefreq;
                        $priority = $this->products_sub_categories_priority;
                    } else {
                        $changefreq = $this->products_categories_changefreq;
                        $priority = $this->products_categories_priority;
                    }

                    // create date
                    if ($shopCategory['updated'] > 0) {
                        $date = date('Y-m-d', $shopCategory['updated']);
                    } else {
                        $date = date('Y-m-d', $shopCategory['created']);
                    }

                    $this->items[] = [
                                      'loc'        => site_url($url),
                                      'changefreq' => $changefreq,
                                      'priority'   => $priority,
                                      'lastmod'    => $date,
                                     ];

                }
            }
        }
    }

    /**
     * Get products brands
     */
    private function getShopBrands() {

        // Get Shop Brands
        $shop_brands = $this->sitemap_model->get_shop_brands();

        // Add Shop Brand to Site Map
        foreach ($shop_brands as $shopbr) {

            $localeSegment = $shopbr['locale'] == self::defaultLocale() ? '' : $shopbr['locale'] . '/';

            $url = site_url($localeSegment . 'shop/brand/' . $shopbr['url']);
            if ($this->not_blocked_url($localeSegment . 'shop/brand/' . $shopbr['url'])) {
                // create date
                if ($shopbr['updated'] > 0) {
                    $date = date('Y-m-d', $shopbr['updated']);
                } else {
                    $date = date('Y-m-d', $shopbr['created']);
                }
                $this->items[] = [
                                  'loc'        => $url,
                                  'changefreq' => $this->brands_changefreq,
                                  'priority'   => $this->brands_priority,
                                  'lastmod'    => $date,
                                 ];

            }
        }
    }

    /**
     * Get products
     */
    private function getShopProducts() {

        // Get Shop products
        $shop_products = $this->sitemap_model->get_shop_products();

        // Add Shop products to Site Map
        foreach ($shop_products as $shopprod) {
            if ($this->sitemap_model->categoryIsActive($shopprod['category_id'])) {

                $localeSegment = $shopprod['locale'] == self::defaultLocale() ? '' : $shopprod['locale'] . '/';
                $url = site_url($localeSegment . Route::createRouteUrl($shopprod['url'], $shopprod['parent_url'], Route::TYPE_PRODUCT));

                if ($this->not_blocked_url($localeSegment . Route::createRouteUrl($shopprod['url'], $shopprod['parent_url'], Route::TYPE_PRODUCT))) {

                    if ($shopprod['updated'] > 0) {
                        $date = date('Y-m-d', $shopprod['updated']);
                    } else {
                        $date = date('Y-m-d', $shopprod['created']);
                    }
                    $this->items[] = [
                                      'loc'        => $url,
                                      'changefreq' => $this->products_changefreq,
                                      'priority'   => $this->products_priority,
                                      'lastmod'    => $date,
                                     ];

                }
            }
        }
    }

    /**
     * Generate xml
     * @param array $items
     * @return string
     */
    private function generate_xml(array $items = []) {

        $data = '';

        $site_maps = [];
        $url_count = 0;

        while ($item = current($items)) {
            if ($url_count < $this->max_url_count) {
                $data .= "<url>\n";
                foreach ($item as $k => $v) {
                    if ($v != '') {
                        $data .= "\t<$k>" . htmlspecialchars($v) . "</$k>\n";
                    }
                }
                $data .= "</url>\n";

                next($items);
            } else {
                $site_maps[] = "<\x3Fxml version=\"1.0\" encoding=\"UTF-8\"\x3F>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n" . $data . "\t</urlset>";
                $url_count = 0;
                $data = '';
            }
            $url_count++;
        }

        if ($data && $site_maps) {
            $site_maps[] = "<\x3Fxml version=\"1.0\" encoding=\"UTF-8\"\x3F>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n" . $data . "\t</urlset>";
        }

        if ($site_maps) {
            $this->saveSiteMaps($site_maps);
            $result = $this->createMainSitemap($site_maps);
        } else {
            $result = "<\x3Fxml version=\"1.0\" encoding=\"UTF-8\"\x3F>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n" . $data . "\t</urlset>";
        }

        return $result;
    }

    /**
     * Save several sitemaps files
     * @param array $site_maps - array of sitemaps data
     */
    private function saveSiteMaps($site_maps) {

        if (!is_dir($this->site_map_folder_path)) {
            mkdir($this->site_map_folder_path, 0777);
        }

        foreach (glob($this->site_map_folder_path . '/sitemap*') as $site_map_file) {
            chmod($site_map_file, 0777);
            unlink($site_map_file);
        }

        foreach ($site_maps as $number => $site_map) {
            if ($site_map) {
                $number++;
                $site_map_path = $this->site_map_folder_path . "/sitemap{$number}.xml";
                file_put_contents($site_map_path, $site_map);
                chmod($site_map_path, 0777);
            }
        }
    }

    /**
     * Create main sitemap file
     * @param array $site_maps - array of sitemaps data
     * @return string
     */
    private function createMainSitemap($site_maps) {

        foreach ($site_maps as $number => $site_map) {
            $number++;
            $site_map_url = site_url(str_replace('./', '', $this->site_map_folder_path . "/sitemap{$number}.xml"));
            $data .= '<sitemap><loc>' . $site_map_url . '</loc></sitemap>';
        }

        $result = '<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . $data . '</sitemapindex>';

        file_put_contents($this->site_map_folder_path . '/sitemap.xml', $result);
        chmod($this->site_map_folder_path . '/sitemap.xml', 0777);
        return $result;
    }

    /**
     * Deinstall module
     */
    public function _deinstall() {

        return $this->sitemap_model->deinstallModule();
    }

    /**
     * Install module
     */
    public function _install() {

        $robotsCheck = $this->robotsCheck() ? 1 : 0;
        return $this->sitemap_model->installModule($robotsCheck);
    }

    public static function adminAutoload() {

        parent::adminAutoload();

        // Set listeners on page pre update to set url
        Events::create()->setListener('setUpdatedUrl', 'ShopAdminProducts:preEdit');
        Events::create()->onAdminPagePreEdit()->setListener('setUpdatedUrl');
        Events::create()->onAdminCategoryPreUpdate()->setListener('setUpdatedUrl');
        Events::create()->onShopCategoryPreEdit()->setListener('setUpdatedUrl');
        Events::create()->onShopBrandPreEdit()->setListener('setUpdatedUrl');

        Events::create()->onShopProductCreate()->setListener('ping_google');
        Events::create()->onShopProductUpdate()->setListener('ping_google');
        Events::create()->onShopProductDelete()->setListener('ping_google');

        Events::create()->onShopCategoryCreate()->setListener('ping_google');
        Events::create()->onShopCategoryEdit()->setListener('ping_google');
        Events::create()->onShopCategoryDelete()->setListener('ping_google');

        Events::create()->onShopBrandCreate()->setListener('ping_google');
        Events::create()->onShopBrandEdit()->setListener('ping_google');
        Events::create()->onShopBrandDelete()->setListener('ping_google');

        Events::create()->onAdminPageCreate()->setListener('ping_google');
        Events::create()->onAdminPageUpdate()->setListener('ping_google');
        Events::create()->onAdminPageDelete()->setListener('ping_google');

        Events::create()->onAdminCategoryCreate()->setListener('ping_google');
        Events::create()->onAdminCategoryUpdate()->setListener('ping_google');
    }

    /**
     * Gzip generate
     */
    public function gzip() {

        $this->_create_map();
        echo gzencode($this->result, $this->gzip_level);
    }

    /**
     * Show sitemap for categories
     */
    public function index() {

        $this->template->registerMeta('ROBOTS', 'NOINDEX, NOFOLLOW');
        $categories = $this->lib_category->_build();

        $pages = $this->db
            ->get_where(
                'content',
                [
                 'category'        => 0,
                 'lang'            => $this->config->item('cur_lang'),
                 'publish_date <=' => time(),
                 'post_status'     => 'publish',
                ]
            )
            ->result_array();

        $this->template->assign('content', $this->sitemap_ul($categories, $pages));
        $this->template->show();
    }

    /**
     * Display sitemap ul list
     * @param array $items - site map items
     * @param array $pages_without_category
     * @return string
     */
    public function sitemap_ul($items = [], $pages_without_category = []) {

        $out = '<ul class="sitemap">';

        foreach ($items as $item) {
            if (isset($item['path_url'])) {
                $url = $item['path_url'];
            } elseif (isset($item['full_url'])) {
                $url = $item['full_url'];
            }

            $out .= '<li>' . anchor($url, $item['name']) . '</li>';

            // Get category pages
            if (isset($item['path_url'])) {
                $pages = $this->sitemap_model->get_cateogry_pages($item['id']);

                if ($pages) {
                    $out .= $this->sitemap_ul($pages);
                }
            }

            if (count($item['subtree']) > 0) {
                $out .= $this->sitemap_ul($item['subtree']);
            }
        }

        foreach ($pages_without_category as $page) {
            $out .= '<li>' . anchor($page['url'], $page['title']) . '</li>';
        }

        $out .= '</ul>';

        return $out;
    }

    /**
     * Send xml to google
     * return $code if send (200 = ok) else 'false'
     * @return bool|mixed
     */
    public static function ping_google() {

        // Checking is used server is local

        $ci = &get_instance();
        if (strstr($ci->input->server('SERVER_NAME'), '.loc')) {
            return FALSE;
        }

        $ci->db->select('settings');
        $ci->db->where('name', 'sitemap');
        $query = $ci->db->get('components', 1)->row_array();

        $settings = unserialize($query['settings']);

        // Check if turn off sending site map
        if (!$settings['sendSiteMap']) {
            return FALSE;
        }

        // Checking time permission(1 hour passed from last send) to send ping
        if ((time() - $settings['lastSend']) / (60 * 60) >= 1) {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'http://www.google.com/webmasters/tools/ping?sitemap=' . site_url() . '/sitemap.xml');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($code == '200') {
                // Update settings, set lastSend time
                $settings['lastSend'] = time();
                $ci->db->limit(1);
                $ci->db->where('name', 'sitemap');
                $ci->db->update('components', ['settings' => serialize($settings)]);

            }

            return $code;
        }
        return false;
    }

}

/* End of file sitemap.php */