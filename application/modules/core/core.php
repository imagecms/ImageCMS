<?php

use CMSFactory\Events;
use core\src\CoreFactory;
use core\src\Kernel;
use core\src\RouteSubscriber;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 * Image CMS
 *
 * core.php
 * @property Cms_base $cms_base
 * @property Lib_category $lib_category
 * @property Cfcm $cfcm
 * @property Lib_seo lib_seo
 */
class Core extends MY_Controller
{

    /**
     * @var array
     */
    public $cat_content;

    /**
     * @var int
     */
    public $page_content;

    /**
     * @var array
     */
    public $core_data = ['data_type' => null];

    /**
     * @var array
     */
    public $settings = [];

    /**
     * @var array
     */
    public $def_lang = []; // Modules array

    /**
     * @var array
     */
    public $langs = [];

    public function __construct() {

        parent::__construct();
        Modules::$registry['core'] = $this;
        $lang = new MY_Lang();
        $lang->load('core');
        $this->settings = $this->cms_base->get_settings();
        $this->langs = CoreFactory::getModel()->getLanguages();
        $this->def_lang = [CoreFactory::getModel()->getDefaultLanguage()];

        $this->lib_category->setLocaleId(MY_Controller::getCurrentLanguage('id'));

    }

    public function index() {
        (new Kernel($this, CI::$APP))->run();
    }

    /**
     * Used in other modules
     * todo: move(and simplify) or remove
     * @param $n
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

        $count = count($args);
        for ($i = 0, $cnt = $count; $i < $cnt; $i++) {
            if ($args[$i] === FALSE) {
                unset($args[$i]);
            }
        }

        return $args;
    }

    /**
     * Display error template end exit
     * @param string $text
     * @param bool $back
     */
    public function error($text, $back = TRUE) {

        $this->template->add_array(
            [
             'content' => $this->template->read('error', ['error_text' => $text, 'back_button' => $back]),
            ]
        );

        $this->template->show();
        exit;
    }

    /**
     * Page not found
     * Show 404 error
     */
    public function error_404() {

        header('HTTP/1.1 404 Not Found');
        $this->set_meta_tags(lang('Page not found', 'core'));
        $this->template->assign('error_text', lang('Page not found.', 'core'));
        $this->template->show('404');
        exit;
    }

    /**
     * Set meta tags for pages
     * @param string $title
     * @param string $keywords
     * @param string $description
     * @param string $page_number
     * @param int $showsitename
     * @param string $category
     */
    public function set_meta_tags($title = '', $keywords = '', $description = '', $page_number = '', $showsitename = 0, $category = '') {

        if ($this->core_data['data_type'] == 'main') {
            $this->template->add_array(
                [
                 'site_title'       => empty($this->settings['site_title']) ? $title : $this->settings['site_title'],
                 'site_description' => empty($this->settings['site_description']) ? $description : $this->settings['site_description'],
                 'site_keywords'    => empty($this->settings['site_keywords']) ? $keywords : $this->settings['site_keywords'],
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

            $page_number = $page_number ?: (int) $this->pagination->cur_page;
            $this->template->add_array(
                [
                 'site_title'       => $title,
                 'site_description' => htmlspecialchars($description),
                 'site_keywords'    => htmlspecialchars($keywords),
                 'page_number'      => $page_number,
                ]
            );
        }
    }

    /**
     *
     * @param string $description
     * @param null|string $text
     * @return string
     */
    public function _makeDescription($description, $text = null) {

        if ($this->settings['create_description'] == 'auto' && !$description) {
            $description = $this->lib_seo->get_description($text);
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

    public function robots() {

        $robotsSettings = $this->db->select('robots_settings,robots_settings_status,robots_status')->get('settings');
        if ($robotsSettings) {
            $robotsSettings = $robotsSettings->row();
        }

        header('Content-type: text/plain');
        if ($robotsSettings->robots_status == '1') {
            if ($robotsSettings->robots_settings_status == '1') {
                if (trim($robotsSettings->robots_settings)) {
                    echo $robotsSettings->robots_settings;
                    exit;
                } else {
                    header('Content-type: text/plain');
                    echo "User-agent: * \r\nDisallow: /";
                    echo "\r\nHost: " . $this->input->server('HTTP_HOST');
                    echo "\r\nSitemap: " . site_url('sitemap.xml');
                    exit;
                }
            } else {

                header('Content-type: text/plain');
                echo "User-agent: * \r\nDisallow: ";
                echo "\r\nHost: " . $this->input->server('HTTP_HOST');
                echo "\r\nSitemap: " . site_url('sitemap.xml');
                exit;
            }
        } else {
            header('Content-type: text/plain');
            echo "User-agent: * \r\nDisallow: /";
            echo "\r\nHost: " . $this->input->server('HTTP_HOST');
            echo "\r\nSitemap: " . site_url('sitemap.xml');
            exit;
        }
    }

    /**
     *
     * @param int $LastModified_unix
     * @return void
     */
    public function setLastModified($LastModified_unix) {

        if ($LastModified_unix < time() - 60 * 60 * 24 * 4 or $LastModified_unix > time()) {
            if (in_array(date('D', time()), ['Mon', 'Tue', 'Wen'])) {
                $LastModified_unix = strtotime('last sunday', time());
            } else {
                $LastModified_unix = strtotime('last thursday', time());
            }
        }

        $LastModified = date('D, d M Y H:i:s \G\M\T', $LastModified_unix);
        $IfModifiedSince = false;

        if ($this->input->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($this->input->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            header($this->input->server('SERVER_PROTOCOL') . ' 304 Not Modified');
            return;
        }
        header('Last-Modified: ' . $LastModified);
    }

    public static function adminAutoload() {
        $subscriber = new RouteSubscriber();

        foreach ($subscriber->getHandlers() as $eventName => $callback) {

            Events::create()->on($eventName)->setListener([$subscriber, $callback]);

        }

        $events = [
                   'ShopAdminCategories:create',
                   'ShopAdminCategories:edit',
                   'ShopAdminCategories:delete',
                   'ShopAdminCategories:fastCreate',
                   'ShopAdminCategories:ajaxChangeShowInSite',

                   'ShopAdminProducts:create',
                   'ShopAdminProducts:edit',
                   'ShopAdminProducts:delete',
                   'ShopAdminProducts:fastProdCreate',
                   'ShopAdminProducts:ajaxChangeActive',
                   'ShopAdminProducts:ajaxChangeStatus',

                   'ShopAdminProperties:fastCreate',
                   'ShopAdminProperties:create',
                   'ShopAdminProperties::delete',
                   'ShopAdminProperties:edit',

                  ];

        foreach ($events as $event) {

            Events::create()->on($event)->setListener(
                function () {

                    MY_Controller::dropCache();
                }
            );

        }

    }

}

/* End of file core.php */