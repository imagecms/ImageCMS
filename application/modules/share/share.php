<?php

use CMSFactory\assetManager;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Comments component
 * @link http://api.yandex.ru/share/
 */
class Share extends MY_Controller
{

    /**
     * @var array|mixed
     */
    public $settings = [];

    public static $i;

    /**
     * Share constructor.
     */
    public function __construct() {

        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('share');
        $this->load->module('core');

        $this->db->select('settings');
        $this->settings = unserialize(implode(',', $this->db->get_where('components', ['name' => 'share'])->row_array()));
    }

    /**
     * Default function to access module by URL
     */
    public function index() {

        $this->template->add_array(
            'ss',
            [
             'html' => $this->_make_share_form(),
            ]
        );
    }

    public function _install() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
    }

    public function _deinstall() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
    }

    /**
     * @param string $url
     * @return string
     */
    public function _make_share_form($url = '') {
        $url = $url ?: site_url($this->uri->uri_string());

        $settings = $this->settings;
        $services = '';
        if ($settings['yaru'] == 1) {
            $services .= 'yaru,';
        }
        if ($settings['vkcom'] == 1) {
            $services .= 'vkontakte,';
        }
        if ($settings['facebook'] == 1) {
            $services .= 'facebook,';
        }
        if ($settings['twitter'] == 1) {
            $services .= 'twitter,';
        }
        if ($settings['odnoclass'] == 1) {
            $services .= 'odnoklassniki,';
        }
        if ($settings['myworld'] == 1) {
            $services .= 'moimir,';
        }
        if ($settings['lj'] == 1) {
            $services .= 'lj,';
        }
        if ($settings['ff'] == 1) {
            $services .= 'friendfeed,';
        }
        if ($settings['mc'] == 1) {
            $services .= 'moikrug,';
        }
        if ($settings['gg'] == 1) {
            $services .= 'gplus,';
        }

        if ($settings['type'] == 'counter') {
            $type = ' data-counter=""';
        } elseif ($settings['type'] == 'button') {
            $type = '';
        } elseif ($settings['type'] == 'icon') {
            $type = ' data-limit="3"';
        }

        \CI_Controller::get_instance()
            ->template
            ->registerJsScript('<script async="async" type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>', 'before');
        \CI_Controller::get_instance()
            ->template
            ->registerJsScript('<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>', 'before');

        $html = '<div class="ya-share2" data-lang="ru" data-url="' . $url . '"'
            . $type
            . ' data-services="' . $services . '"></div>';

        return $html;
    }

    /**
     * @param string $url
     * @return string
     */
    public function _make_like_buttons_fb($url = '') {

        $settings = $this->settings;

        if ($settings['facebook_like'] == 1) {
            $fbsrc = '(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/en_EN/all.js#xfbml=1";
                        fjs.parentNode.insertBefore(js, fjs);
                        }(document, "script", "facebook-jssdk"));';
            assetManager::create()->registerJsScript($fbsrc, FALSE, 'before');
            return '<div id="fb-root"></div>
                <div class="fb-like" data-send="false" data-layout="button_count" data-width="60" data-show-faces="true" data-href="' . $url . '"></div>';
        }
    }

    public function _make_like_buttons_vk($url = '') {

        self::$i++;
        $settings = $this->settings;

        if ($settings['vk_like'] == 1 && $settings['vk_apiid']) {
            \CI_Controller::get_instance()->template->registerJsScript(
                "<script type='text/javascript' src='//vk.com/js/api/openapi.js?101'></script>
                        <script type='text/javascript'>
                          VK.init({apiId: '{$settings['vk_apiid']}', onlyWidgets: true});
                        </script>",
                'before'
            );

            return "<!-- Put this div tag to the place, where the Like block will be -->
                        <div id='vk_like" . self::$i . "'></div>
                        <script type='text/javascript'>
                        VK.Widgets.Like('vk_like" . self::$i . "', {
                                                    type: 'mini', 
                                                    height: 18,
                                                    pageUrl: '$url'
                                                    }
                                                );
                        </script>";
        }
    }

    public function _make_like_buttons_google($url = '') {

        $settings = $this->settings;

        if ($settings['gg_like'] == 1) {
            \CI_Controller::get_instance()->template->registerJsScript(
                "<script type='text/javascript' src='https://apis.google.com/js/plusone.js'>
                          {lang: 'ru', parsetags: 'explicit' }
                        </script>",
                'before'
            );
            return "<!-- Place this tag where you want the +1 button to render. -->
                        <div class='g-plusone' data-size='medium' data-href='$url'></div>

                        <!-- Place this render call where appropriate. -->
                        <script type='text/javascript'>gapi.plusone.go();</script>";
        }
    }

    public function _make_like_buttons_twitter($url = '') {

        $settings = $this->settings;

        if ($settings['twitter_like'] == 1) {
            \CI_Controller::get_instance()->template->registerJsScript(
                '<script async="async" defer="defer">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id))
                    {js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>',
                'before'
            );
            return '<a href="https://twitter.com/share" class="twitter-share-button" data-url="' . $url . '">Tweet</a>';
        }
    }

    public function _make_like_buttons($url = '') {

        $html = '<ul class="items items-social">'
            . '<li>' . $this->_make_like_buttons_fb($url) . '</li>'
            . '<li>' . $this->_make_like_buttons_vk($url) . '</li>'
            . '<li>' . $this->_make_like_buttons_google($url) . '</li>'
            . '<li>' . $this->_make_like_buttons_twitter($url) . '</li>' .
            '</ul>';
        return $html;
    }

}