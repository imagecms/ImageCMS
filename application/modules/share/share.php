<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Comments component
 * @link http://api.yandex.ru/share/
 */
class Share extends MY_Controller {

    public $settings = array();

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('share');
        $this->load->module('core');

        $this->db->select('settings');
        $this->settings = unserialize(implode(',', $this->db->get_where('components', array('name' => 'share'))->row_array()));
    }

    /**
     * Default function to access module by URL
     */
    public function index() {
//        return false;
        $this->template->add_array('ss', array(
            'html' => $this->_make_share_form(),
        ));
    }

    public function _install() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
    }

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
    }

    public function _make_share_form($url = '') {
        $settings = $this->settings;
        if ($settings['yaru'] == 1) {
            $html .= 'yaru,';
        }
        if ($settings['vkcom'] == 1) {
            $html .= 'vkontakte,';
        }
        if ($settings['facebook'] == 1) {
            $html .= 'facebook,';
        }
        if ($settings['twitter'] == 1) {
            $html .= 'twitter,';
        }
        if ($settings['odnoclass'] == 1) {
            $html .= 'odnoklassniki,';
        }
        if ($settings['myworld'] == 1) {
            $html .= 'moimir,';
        }
        if ($settings['lj'] == 1) {
            $html .= 'lj,';
        }
        if ($settings['ff'] == 1) {
            $html .= 'friendfeed,';
        }
        if ($settings['mc'] == 1) {
            $html .= 'moikrug,';
        }
        if ($settings['gg'] == 1) {
            $html .= 'gplus,';
        }

        if ($settings['type'] == 'counter') {
            $type = ' data-yashareTheme="counter" ';
        } else {
            $type = ' data-yashareType="' . $settings['type'] . '" ';
        }

        $html = '<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
                <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareLink="' . $url . '"'
                . $type . ' data-yashareQuickServices="' . $html . '"></div>';

        return $html;
    }

    public function _make_like_buttons() {
        $settings = $this->settings;
        if ($settings['facebook_like'] == 1) {
            $string['facebook'] = '<li>   <div id="fb-root"></div>
                        <script async="async" defer="defer">(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/en_EN/all.js#xfbml=1";
                        fjs.parentNode.insertBefore(js, fjs);
                        }(document, "script", "facebook-jssdk"));</script>
                        <div class="fb-like" data-send="false" data-layout="button_count" data-width="60" data-show-faces="true"></div></li>';
        }
        if ($settings['vk_like'] == 1 && $settings['vk_apiid']) {
            $string['vk'] = "<li>

                        <!-- Put this script tag to the <head> of your page -->
                        <script type='text/javascript' src='//vk.com/js/api/openapi.js?101'></script>

                        <script type='text/javascript'>
                          VK.init({apiId: '{$settings['vk_apiid']}', onlyWidgets: true});
                        </script>

                        <!-- Put this div tag to the place, where the Like block will be -->
                        <div id='vk_like'></div>
                        <script type='text/javascript'>
                        VK.Widgets.Like('vk_like', {type: 'mini', height: 18});
                        </script>
                        </li>";
        }
        if ($settings['gg_like'] == 1) {
            $string['google'] = "<li><!-- Place this tag in your head or just before your close body tag. -->
                        <script type='text/javascript' src='https://apis.google.com/js/plusone.js'>
                          {lang: 'ru', parsetags: 'explicit'}
                        </script>

                        <!-- Place this tag where you want the +1 button to render. -->
                        <div class='g-plusone' data-size='medium'></div>

                        <!-- Place this render call where appropriate. -->
                        <script type='text/javascript'>gapi.plusone.go();</script></li>";
        }
        if ($settings['twitter_like'] == 1) {
            $string['twitter'] = '<li><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                    <script async="async" defer="defer">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id))
                    {js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>';
        }
        $html = '<ul class="items items-social">'
                . $string['facebook']
                . $string['vk']
                . $string['google']
                . $string['twitter'] .
                '</ul>';
        return $html;
    }

}
