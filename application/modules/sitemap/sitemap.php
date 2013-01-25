<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Sitemap Module
 */
class Sitemap extends MY_Controller {

    public $pages_priority = '0.6'; // priority for pages
    public $cats_priority = '0.8'; // priority for categories
    public $main_page_priority = '1'; // priority for main page
    public $pages_changefreq = 'daily';
    public $categories_changefreq = 'weekly';
    public $main_page_changefreq = 'daily';
    public $changefreq = 'daily';
    public $gzip_level = 0;
    public $result = '';
    public $langs = array();
    public $default_lang = array();
    public $sitemap_ttl = 3600;
    public $sitemap_key = 'sitemap_';
    public $items = array();

    function __construct() {
        parent::__construct();
        $this->robots = $this->replace(file('robots.txt'));
        $this->load->module('core');

// Get langs
        $this->langs = $this->core->langs;
        $this->default_lang = $this->core->def_lang[0];
        if (uri_string() == 'sitemap.xml') {
            $this->build_xml_map();
            exit();
        }
    }

    public function index() {
        $categories = $this->lib_category->build();
//echo $this->sitemap_ul($categories);

        $this->template->assign('content', $this->sitemap_ul($categories));
        $this->template->show();
    }

    public function initialize($settings = array()) {
        if (count($settings) > 0) {
            $this->main_page_priority = $settings['main_page_priority'];
            $this->cats_priority = $settings['cats_priority'];
            $this->pages_priority = $settings['pages_priority'];
            $this->main_page_changefreq = $settings['main_page_changefreq'];
            $this->categories_changefreq = $settings['categories_changefreq'];
            $this->pages_changefreq = $settings['pages_changefreq'];
        }
    }

    /**
     * Display sitemap ul list
     */
    public function sitemap_ul($items = array()) {
        $out .= '<ul id="sitemap">';

        foreach ($items as $item) {
            if (isset($item['path_url'])) {
                $url = $item['path_url'];
            } elseif (isset($item['full_url'])) {
                $url = $item['full_url'];
            }

            $out .= '<li>' . anchor($url, $item['name']) . '</li>';

// Get category pages
            if (isset($item['path_url'])) {
                $pages = $this->_cateogry_pages($item['id']);

                if ($pages->num_rows() > 0) {
                    $out .= $this->sitemap_ul($pages->result_array());
                }
            }

            if (count($item['subtree']) > 0) {
                $out .= $this->sitemap_ul($item['subtree']);
            }
        }

        $out .= '</ul>';

        return $out;
    }

    /**
     * Create and display sitemap xml
     */
    public function build_xml_map() {
        $this->_create_map();
        header("content-type: text/xml");
        echo $this->result;
    }

    public function _create_map() {
//        if (($data = $this->cache->fetch($this->sitemap_key)) !== FALSE)
//        {
//            $this->result = $data;
//        } 
//        else
//      {
        $this->initialize($this->_load_settings());

// Add main page
        if (!$this->robotsCheck(site_url())) {
            $this->items[] = array(
                'loc' => site_url(),
                'changefreq' => $this->main_page_changefreq,
                'priority' => $this->main_page_priority
            );
        }

// Add categories to sitemap urls.
        $categories = $this->lib_category->unsorted();

        foreach ($categories as $category) {
            if (!$this->robotsCheck(site_url($category['path_url']))) {
                $this->items[] = array(
                    'loc' => site_url($category['path_url']),
                    'changefreq' => $this->categories_changefreq,
                    'priority' => $this->cats_priority
                );

// Add links to categories in all langs.
                foreach ($this->langs as $k => $v) {
                    if ($v['id'] != $this->default_lang['id']) {
                        $this->items[] = array(
                            'loc' => site_url($k . '/' . $category['path_url']),
                            'changefreq' => $this->categories_changefreq,
                            'priority' => $this->cats_priority
                        );
                    }
                }
            }
        }

// Get all pages
        $pages = $this->_get_all_pages();

        foreach ($pages->result_array() as $page) {
            if (!$this->robotsCheck($page['full_url'])) {
// create page url
                if ($page['lang'] == $this->default_lang['id']) {
                    $url = site_url($page['full_url']);
                } else {
                    $prefix = $this->_get_lang_prefix($page['lang']);
                    $url = site_url($prefix . '/' . $page['full_url']);
                }

// create date
                if ($page['updated'] > 0) {
                    $date = date('Y-m-d', $page['updated']);
                } else {
                    $date = date('Y-m-d', $page['created']);
                }
                $c_priority = $this->cats_priority;
                if ($page['cat_url'] == '') {
                    $c_priority = $this->cats_priority;
                } else {
                    $c_priority = $this->pages_priority;
                }
                $this->items[] = array(
                    'loc' => $url,
                    'lastmod' => $date,
                    'changefreq' => $this->pages_changefreq,
                    'priority' => $c_priority
                );
            }
        }

        $is_shop = $this->db->where('name =', 'shop')->get('components')->row_array();

        if ($is_shop != NULL) {

            $shop_categories = $this->_shop_category_pages();
            foreach ($shop_categories as $shopcat) {
                $url = site_url('shop/category/' . $shopcat['full_path']);
                if (!$this->robotsCheck($url)) {
                    $this->items[] = array(
                        'loc' => $url,
                        'lastmod' => '',
                        'changefreq' => 'daily',
                        'priority' => $this->cats_priority,
                    );
                }
            }

            $shop_brands = $this->_shop_brands_pages();
            foreach ($shop_brands as $shopbr) {
                $url = site_url('shop/brand/' . $shopbr['url']);
                if (!$this->robotsCheck($url)) {
                    $this->items[] = array(
                        'loc' => $url,
                        'lastmod' => '',
                        'changefreq' => 'daily',
                        'priority' => $this->cats_priority,
                    );
                }
            }

            $shop_products = $this->_shop_products_pages();
            foreach ($shop_products as $shopprod) {
                $url = site_url('shop/product/' . $shopprod['url']);
                if (!$this->robotsCheck($url)) {
                    if ($shopprod['updated'] > 0) {
                        $date = date('Y-m-d', $shopprod['updated']);
                    } else {
                        $date = date('Y-m-d', $shopprod['created']);
                    }
                    $this->items[] = array(
                        'loc' => $url,
                        'lastmod' => $date,
                        'changefreq' => 'daily',
                        'priority' => $this->pages_priority,
                    );
                }
            }
        }
        $this->result = $this->generate_xml($this->items);

//$this->cache->store($this->sitemap_key, $this->result, $this->sitemap_ttl);
// }
    }

    public function _get_all_pages() {
        $this->db->select('id, created, updated, lang,cat_url');
        $this->db->select('CONCAT_WS("", cat_url, url) as full_url', FALSE);
        $this->db->where('post_status', 'publish');
        $this->db->where('publish_date <=', time());
        return $this->db->get('content');
    }

    public function _cateogry_pages($id = 0) {
        $this->db->select('id, created, updated, lang, title as name');
        $this->db->select('CONCAT_WS("", cat_url, url) as full_url', FALSE);
        $this->db->where('lang', $this->config->item('cur_lang'));
        $this->db->where('category', $id);
        $this->db->where('post_status', 'publish');
        $this->db->where('publish_date <=', time());
        return $this->db->get('content');
    }

    private function generate_xml($items = array()) {
        $data = '';

        while ($item = current($items)) {
            $data .= "<url>\n";
            foreach ($item as $k => $v) {
                if ($v != '') {
                    $data .= "\t<$k>$v</$k>\n";
                }
            }
            $data .= "</url>\n";

            next($items);
        }

        return "<\x3Fxml version=\"1.0\" encoding=\"UTF-8\"\x3F>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n" . $data . "\t</urlset>";
    }

    /**
     * Get language prefix by lang id
     */
    private function _get_lang_prefix($id) {
        foreach ($this->langs as $k => $v) {
            if ($v['id'] === $id) {
                return $k;
            }
        }
    }

    public function replace($lines) {
        $array = array();
        foreach ($lines as $line) {
            if ((substr_count($line, 'Disallow:') > 0) && (trim(str_replace('Disallow:', '', $line)) != ''))
                array_push($array, trim(str_replace('Disallow:', '', $line)));
        }
        return $array;
    }

    public function robotsCheck($check) {
        $array = $this->robots;
        foreach ($array as $ar) {
            if ($ar == '/')
                return true;

            if (strstr($check, $ar))
                return true;
        }
        return false;
    }

    /**
     * send xml to google
     * return $code if send (200 = ok) else 'false'
     */
    public function ping_google() {

        $this->db->select('settings');
        $a = unserialize(implode(',', $this->db->get_where('components', array('name' => 'sitemap'))->row_array()));

        if ((time() - $a['lastSend']) / (60 * 60) >= 1) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "http://www.google.com/webmasters/tools/ping?sitemap=" . site_url() . "/sitemap.xml");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $output = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($code == '200') {
                $XMLDataMap = array(
                    'main_page_priority' => $a['main_page_priority'],
                    'cats_priority' => $a['cats_priority'],
                    'pages_priority' => $a['pages_priority'],
                    'main_page_changefreq' => $a['main_page_changefreq'],
                    'categories_changefreq' => $a['categories_changefreq'],
                    'pages_changefreq' => $a['pages_changefreq'],
                    'sendXML' => $a['sendXML'],
                    'lastSend' => time()
                );

                $this->db->limit(1);
                $this->db->where('name', 'sitemap');
                $this->db->update('components', array('settings' => serialize($XMLDataMap)));

                showMessage('Пинг отправлен', 'Google ping');
            }

            return $code;
        }
        return false;
    }

    public function gzip() {
        $this->_create_map();
        echo gzencode($this->result, $this->gzip_level);
    }

    public function _load_settings() {
        $this->db->select('settings');
        $this->db->where('name', 'sitemap');
        $query = $this->db->get('components', 1)->row_array();

        return unserialize($query['settings']);
    }

    function _install() {
        $data = array(
            'main_page_priority' => '1',
            'cats_priority' => '0.8',
            'pages_priority' => '0.6',
            'main_page_changefreq' => 'weekly',
            'pages_changefreq' => 'weekly',
            'sendXML' => 'true',
            'lastSend' => 0
        );

        $this->db->where('name', 'sitemap');
        $this->db->update('components', array('enabled' => '1', 'settings' => serialize($data)));
    }

    public function _shop_category_pages() {
        $this->db->select('full_path');
        $this->db->where('active', 1);
        return $this->db->get('shop_category')->result_array();
    }

    public function _shop_brands_pages() {
        $this->db->select('url');
        return $this->db->get('shop_brands')->result_array();
    }

    public function _shop_products_pages() {
        $this->db->select('url, updated, created');
        return $this->db->get('shop_products')->result_array();
    }

}

/* End of file sitemap.php */
