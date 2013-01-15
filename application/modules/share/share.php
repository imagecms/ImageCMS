<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Comments component
 */
class Share extends MY_Controller {

    public $settings = array();

    public function __construct() {
        parent::__construct();
        $this->load->module('core');

        $this->db->select('settings');
        $this->settings = unserialize(implode(',', $this->db->get_where('components', array('name' => 'share'))->row_array()));
    }

    /**
     * Default function to access module by URL
     */
    public function index() {
        return false;
//        $this->template->add_array('ss', array(
//            'html' => $this->_make_share_form(),
//        ));
    }

    public function _install() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

    }

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
    }

    public function _make_share_form() {
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
        $type = $settings['type'];
        $html = '<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
                 <span class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="' . $type . '" data-yashareQuickServices="' . $html . '"></span> ';
        return $html;
    }

    public function _make_like_buttons() {
        $settings = $this->settings;
        if ($settings['facebook_like'] == 1) {
            $string['facebook'] = '<td>   <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
                        fjs.parentNode.insertBefore(js, fjs);
                        }(document, "script", "facebook-jssdk"));</script>
                        <div class="fb-like" data-send="false" data-layout="button_count" data-width="60" data-show-faces="true"></div></td>';
        }
        if ($settings['vk_like'] == 1) {
            $string['vk'] = '<td> <html>
                <head>
                <!-- Put this script tag to the <head> of your page -->
                <script type="text/javascript" src="http://userapi.com/js/api/openapi.js"></script>
                <script type="text/javascript">
                    VK.init({apiId: ' . $settings['vk_apiid'] . ', onlyWidgets: true});
                </script>
                </head>
                <body>
                <!-- Put this div tag to the place, where the Like block will be -->
                <div id="vk_like"></div>
                <script type="text/javascript">
                    VK.Widgets.Like("vk_like", {type: "mini"});
                </script>
                </body>
                </html></td>';
        }
        if ($settings['gg_like'] == 1) {
            $string['google'] = '<td>     <!-- Place this tag where you want the +1 button to render. -->
                        <div class="g-plusone"></div>
                        <!-- Place this tag after the last +1 button tag. -->
                        <script type="text/javascript">
                        (function() {
                        var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
                        po.src = "https://apis.google.com/js/plusone.js";
                        var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
                        })();
                        </script></td>';
        }
        if ($settings['twitter_like'] == 1) {
            $string['twitter'] = '<td><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id))
                    {js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></td>';
        }
        $html = '<table>
                    <tr>'
                . $string['facebook']
                . $string['vk']
                . $string['google']
                . $string['twitter'] .
                '</tr>
                </table>';
        return $html;
    }

}

