<!DOCTYPE html>
<html>
    <head>
        <title>{lang("Operation panel","admin")} | {if MAINSITE}Premmerce{else:}Image CMS{/if}</title>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <meta name="description" content="{lang("Operation panel","admin")} - Image CMS" />
        <meta name="generator" content="ImageCMS">

        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap_complete.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap-responsive.css">
        <!--
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap-notify.css">
        -->

        <link rel="stylesheet" type="text/css" href="{$THEME}css/jquery/custom-theme/jquery-ui-1.8.16.custom.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}css/jquery/custom-theme/jquery.ui.1.8.16.ie.css">

        <link rel="stylesheet" type="text/css" href="{$JS_URL}/elfinder-2.0/css/Aristo/css/Aristo/Aristo.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="{$JS_URL}/elrte-1.3/css/elrte.min.css" media="screen" charset="utf-8">

        <link rel="stylesheet" type="text/css" href="{$JS_URL}/elfinder-2.0/css/elfinder.min.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="{$JS_URL}/elfinder-2.0/css/theme.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="{$THEME}js/colorpicker/css/colorpicker.css" media="screen" charset="utf-8">
        <script src="{$THEME}js/jquery-1.8.2.min.js" type="text/javascript"></script>

        <link rel="icon" type="image/x-icon" href="{$THEME}images/{if MAINSITE}premmerce_{/if}favicon.png"/>
    </head>
    <body>
        {literal}
            <style>
                .imagecms-close{cursor: pointer;position: absolute;right: -100px;top: 0;height: 31px;background-color: #4e5a68;width: 95px;display: none;z-index: 3;}
                .imagecms-top-fixed-header.imagecms-active{height: 31px;background-color: #37414d;}
                .imagecms-toggle-close-text{color: #fff;}
                .imagecms-top-fixed-header.imagecms-active + .main_body header{padding-top: 31px;}
                .imagecms-top-fixed-header{height: 0;position: fixed;top: 0;left: 0;width: 100%;font-family: Arial, sans-serif;font-size: 12px;color: #223340;vertical-align: baseline;z-index: 1000}
                .imagecms-top-fixed-header .container{position: relative;}
                .imagecms-logo{float: left;}
                .imagecms-ref-skype, .imagecms-phone{font-size: 0;}
                .imagecms-phone{margin-right: 32px;}
                .imagecms-phone .imagecms-text-el{font-size: 12px;color: #fff;}
                .imagecms-ref-skype .imagecms-text-el{font-size: 12px;color: #fff;}
                .imagecms-ref-skype{color: #223340;text-decoration: none;}
                .imagecms-ref-skype:hover{color: #223340;text-decoration: none;}
                .imagecms-list{list-style: none;margin: 0;float: left;display: none;}
                .imagecms-list > li{height: 31px;vertical-align: top;padding: 0 23px;text-align: left;border-right: 1px solid #525f6f;display: inline-block;}
                .imagecms-list > li > a{line-height: 31px;}
                .imagecms-list > li:first-child{border-left: 1px solid #525f6f;}
                .imagecms-ref{color: #fff;text-decoration: none;text-transform: uppercase;font-size: 11px;}
                .imagecms-ref:hover{color: #fff;text-decoration: none;}
                .imagecms-ico-phone, .imagecms-ico-skype{width: auto !important;height: auto !important;position: relative !important;vertical-align: baseline;}
                .imagecms-ico-skype{position: relative;top: 3px;margin-right: 10px;}
                .imagecms-ico-phone{position: relative;top: 2px;margin-right: 6px;}
                .imagecms-buy-license > a{text-decoration: none;height: 100%;display: block;padding: 0 20px;font-size: 0;}
                .imagecms-buy-license > a > .imagecms-text-el{color: #fff;font-weight: normal;font-size: 11px;line-height: 31px;text-transform: uppercase;}
                .imagecms-buy-license{
                    display: none;float: right;height: 31px;box-shadow: 0 1px 1px rgba(0,0,0,.1);
                    background: #0eb48e; /* Old browsers */
                    background: -moz-linear-gradient(top,  #0eb48e 0%, #09a77d 100%); /* FF3.6+ */
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#0eb48e), color-stop(100%,#09a77d)); /* Chrome,Safari4+ */
                    background: -webkit-linear-gradient(top,  #0eb48e 0%,#09a77d 100%); /* Chrome10+,Safari5.1+ */
                    background: -o-linear-gradient(top,  #0eb48e 0%,#09a77d 100%); /* Opera 11.10+ */
                    background: -ms-linear-gradient(top,  #0eb48e 0%,#09a77d 100%); /* IE10+ */
                    background: linear-gradient(to bottom,  #0eb48e 0%,#09a77d 100%); /* W3C */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0eb48e', endColorstr='#09a77d',GradientType=0 ); /* IE6-9 */
                }
                .imagecms-contacts{text-align: center;padding-top: 6px;display: none;}
                .imagecms-buy-license .imagecms-text-el{vertical-align: middle;}
                .imagecms-buy-license .imagecms-ico-donwload{vertical-align: middle;margin-left: 11px;}

                .imagecms-active .imagecms-buy-license, .imagecms-active .imagecms-list, .imagecms-active .imagecms-contacts{display: block;}
            </style>
        {/literal}
        {include_tpl('inc/javascriptVars')}
        {include_tpl('inc/jsLangs.tpl')}
        {$langDomain = $CI->land->gettext_domain}
        {$CI->lang->load('admin')}
        {if SHOP_INSTALLED && (trim($content) == 'Строк тестовой лицензии истек' OR trim($content) == 'Ошибка проверки лицензии.')}
            <div class="imagecms-top-fixed-header{if $_COOKIE['condPromoToolbar'] == '1' || $_COOKIE['condPromoToolbar'] == NULL} imagecms-active{/if}">
                <div class="imagecms-inside">
                    <div class="container">
                        <button type="button" class="imagecms-close" {if $_COOKIE['condPromoToolbar'] == '1' || $_COOKIE['condPromoToolbar'] == NULL}style="display: block;"{/if} onclick="setCookie('condPromoToolbar', '0');
                                $('.imagecms-top-fixed-header').removeClass('imagecms-active');
                                $(this).hide().next().show();
                                $(window).scroll();">
                            <span class="imagecms-toggle-close-text imagecms-bar-close-text"><span style="font-size: 14px;">↑</span> Скрыть</span>
                        </button>
                        <button type="button" class="imagecms-close" {if $_COOKIE['condPromoToolbar'] == '0'}style="display: block;"{/if} onclick="setCookie('condPromoToolbar', '1');
                                $('.imagecms-top-fixed-header').addClass('imagecms-active');
                                $(this).hide().prev().show();
                                $(window).scroll();">
                            <span class="imagecms-toggle-close-text imagecms-bar-show-text"><span style="font-size: 14px;">↓</span> Показать</span>
                        </button>
                        <div class="imagecms-buy-license">
                            <a href="http://www.imagecms.net/shop/prices" target="_blank" onclick="_gaq.push(['_trackEvent', 'demoshop-admin', '/shop/prices']);">
                                <span class="imagecms-text-el">Купить лицензицю</span>
                            </a>
                        </div>
                        <ul class="imagecms-list">
                            <li>
                                <a href="http://www.imagecms.net" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demoshop-admin', 'obzor-product-shop']);">Обзор продукта</a>
                            </li>
                            <li>
                                <a href="http://www.imagecms.net/kliuchevye-preimushchestva/vozmozhnosti" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demoshop-admin', '/kliuchevye-preimushchestva/vozmozhnosti']);">преимущества продукта</a>
                            </li>
                            <li>
                                <a href="http://www.imagecms.net/store/category/shoptemplates" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demoshop-admin', 'shoptemplates']);">{lang('Шаблоны для Shop', 'newLevel')}</a>
                            </li>
                        </ul>
                        <div class="imagecms-contacts">
                            <span class="imagecms-phone">
                                <img src="{$THEME}icon_phone.png" class="imagecms-ico-phone"/>
                                <span class="imagecms-text-el">+7 (499) 703-37-51</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        {/if}
        {if !SHOP_INSTALLED}
            <div class="imagecms-top-fixed-header{if $_COOKIE['condPromoToolbar'] == '1' || $_COOKIE['condPromoToolbar'] == NULL} imagecms-active{/if}">
                <div class="imagecms-inside">
                    <div class="container">
                        <button type="button" class="imagecms-close" {if $_COOKIE['condPromoToolbar'] == '1' || $_COOKIE['condPromoToolbar'] == NULL}style="display: block;"{/if} onclick="setCookie('condPromoToolbar', '0');
                                $('.imagecms-top-fixed-header').removeClass('imagecms-active');
                                $(this).hide().next().show();
                                $(window).scroll();">
                            <span class="imagecms-toggle-close-text imagecms-bar-close-text"><span style="font-size: 14px;">↑</span> {lang('Hide', 'admin')}</span>
                        </button>
                        <button type="button" class="imagecms-close" {if $_COOKIE['condPromoToolbar'] == '0'}style="display: block;"{/if} onclick="setCookie('condPromoToolbar', '1');
                                $('.imagecms-top-fixed-header').addClass('imagecms-active');
                                $(this).hide().prev().show();
                                $(window).scroll();">
                            <span class="imagecms-toggle-close-text imagecms-bar-show-text"><span style="font-size: 14px;">↓</span> {lang('Show', 'admin')}</span>
                        </button>
                        <div class="imagecms-buy-license">
                            <a href="http://www.imagecms.net/download/corporate" target="_blank" onclick="_gaq.push(['_trackEvent', 'demo-admin', '/download/corporate']);">
                                <span class="imagecms-text-el">Скачать бесплатно</span>
                            </a>
                        </div>
                        <ul class="imagecms-list">
                            <li>
                                <a href="http://www.imagecms.net/free-cms-corporate" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demo-admin', '/free-cms-corporate']);">Обзор продукта</a>
                            </li>
                            <li>
                                <a href="http://www.imagecms.net/corporate-bazovye-vozmozhnosti" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demo-admin', '/corporate-bazovye-vozmozhnosti']);">Базовые возможности</a>
                            </li>
                            <li>
                                <a href="http://www.imagecms.net/blog" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demo-admin', '/blog']);">Блог</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        {/if}
        <div class="main_body">
            <div id="fixPage"></div>
            <!-- Here be notifications -->
            <div class="notifications top-right"></div>
            <header>
                <section class="container">
                    <div class="row-fluid">
                        <div class="span6 left-header">
                            {if SHOP_INSTALLED}
                                <a href="{base_url('admin/components/run/shop/dashboard')}" class="logo pull-left pjax">
                                {else:}
                                    <a href="/admin/dashboard" class="logo pull-left pjax">
                                    {/if}
                                    <span class="helper"></span>
                                    {if MAINSITE}
                                        <img src="{$THEME}img/logo_premmerce.png"/>
                                    {else:}
                                        <img src="{$THEME}img/logo_new.png"/>
                                    {/if}
                                </a>
                                {if MAINSITE}
                                    <span class="helper"></span>
                                    <span class="frame-prem">
                                        {if !$isFree}
                                            <span class="title">{echo lang('Баланс:', 'admin')}</span>
                                            <span class="f-s_0">
                                                <span class="text-el text-c-day">{echo $CI->load->module('mainsaas')->getDaysLeft()} </span>
                                                <span class="text-el text-days"> {echo lang('дней', 'admin')}</span>
                                            </span>
                                            <a href="{echo $CI->load->module('mainsaas')->getDomainBiling()}/saas/orders/payments" class="btn btn-continue">
                                                <span class="text-el">{echo lang('Продлить', 'admin')}</span>
                                            </a>
                                        {else:}
                                            <span class="text-free-tarrif">{lang("Free tarif", "admin")}</span>
                                        {/if}
                                    </span>
                                {/if}
                        </div>

                        {if $CI->dx_auth->is_logged_in()}
                            <div class="pull-right span6 f-s_0 right-header">
                                <span class="helper"></span>
                                <ul class="d_i-b f-s_0">
                                    {if MAINSITE}
                                        <li class="btn_help">
                                            <a href="#" data-drop=".frame-add-info-header">
                                                <span class="icon-help"></span>
                                                <span class="text-el">{lang('Помощь', 'admin')}</span>
                                                {if $support_answers_count}
                                                    <span class="badge-count-ticket">
                                                        {echo $support_answers_count}
                                                    </span>
                                                {/if}
                                            </a>
                                        </li>
                                    {/if}

                                    <li class="dropdown d-i_b v-a_m">
                                        <a data-toggle="dropdown" class="btn_header btn-personal-area">
                                            <span>
                                                <span class="text-el v-a_m">{lang("Profile", "admin")}</span>
                                                <span class="icon_arrow"></span>
                                            </span>
                                        </a>
                                        {if MAINSITE}
                                            {echo $CI->load->module('mainsaas')->getSaasDropMenu()}
                                        {else:}
                                            <ul class="frame-dropdown dropdown-menu">
                                                <li class="head">
                                                    {if $CI->dx_auth->get_username()}
                                                        {echo $CI->dx_auth->get_username()}
                                                    {else:}
                                                        {echo lang("Guest","admin")}
                                                    {/if}
                                                </li>
                                                {if $CI->dx_auth->get_username()}
                                                    <li>
                                                        <a href="
                                                           {if SHOP_INSTALLED}/admin/components/run/shop/users/edit/{echo $CI->dx_auth->get_user_id()}
                                                           {else:}/admin/components/cp/user_manager/edit_user/{echo $CI->dx_auth->get_user_id()}
                                                           {/if}"
                                                           id="user_name">
                                                            {lang("Personal data", "admin")}
                                                        </a>
                                                    </li>
                                                {/if}
                                                <li>
                                                    <a href="/auth/logout">
                                                        {lang("Exit", "admin")}
                                                    </a>
                                                </li>
                                            </ul>
                                        {/if}
                                    </li>
                                    <li class="btn_header">
                                        <a href="{$BASE_URL}" target="_blank">
                                            {if MAINSITE}
                                                <span class="text-el">{lang('Shop','admin')}</span>
                                            {else:}
                                                <span class="text-el">{lang('To the site','admin')}</span>
                                            {/if}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        {/if}
                    </div>
                </section>
            </header>
            {if MAINSITE}
                <div class="frame-add-info-header" style="display: none;">
                    <div class="container">
                        <button type="button" class="icon-close2" data-closed=".frame-add-info-header"></button>
                        <ul class="items items-add-info">
                            {$contacts = $CI->load->module('mainsaas')->getContacts()}
                            <li class="item-manager">
                                <div class="frame-title f-s_0">
                                    <span class="icon-manager"></span>
                                    <span class="title">{lang('Менеджер', 'admin')}</span>
                                </div>
                                <ul class="items-menu-col">
                                    {if $contacts['addphone2']}
                                        <li>
                                            {echo $contacts['addphone2']}
                                        </li>
                                    {/if}

                                    {if $contacts['addphone1']}
                                        <li>
                                            {echo $contacts['addphone1']}
                                        </li>
                                    {/if}

                                    {if $contacts['addphone3']}
                                        <li>
                                            {echo $contacts['addphone3']}
                                        </li>
                                    {/if}

                                    {if $contacts['siteinfo_mainphone'] && !$contacts['addphone2']}
                                        <li>
                                            {echo $contacts['siteinfo_mainphone']}
                                        </li>
                                    {/if}

                                    {if $contacts['Email']}
                                        <li>
                                            {echo $contacts['Email']}
                                        </li>
                                    {/if}
                                </ul>
                            </li>
                            <li class="item-support">
                                <div class="frame-title f-s_0">
                                    <span class="icon-maintain"></span>
                                    <span class="title">{lang('Служба поддержки', 'admin')}</span>
                                </div>
                                <ul class="items-menu-col">
                                    <li class="f-s_0">
                                        <a href="{echo $CI->load->module('mainsaas')->getDomainBiling()}/saas/support" class="text-el">{lang('Ваши вопросы', 'admin')}</a>
                                        {if $support_answers_count}
                                            <span class="badge-new">
                                                {echo $support_answers_count}
                                            </span>
                                        {/if}
                                    </li>
                                    <li>
                                        <a href="{echo $CI->load->module('mainsaas')->getDomainBiling()}/saas/support/#create-ticket">{lang('Задать вопрос', 'admin')}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="item-instruction">
                                {echo $CI->load->module('mainsaas')->getInstruction()}
                            </li>
                        </ul>
                    </div>
                </div>
            {/if}

            <!-- Admin Menu  -->
            {echo $CI->load->module('admin_menu')->show()}

            <div id="loading"></div>
            {$CI->lang->load($langDomain)}
            <div class="container" id="mainContent">
                {literal}<script>setTimeout(function () {
                        $('.mini-layout').css('padding-top', $('.frame_title:not(.no_fixed)').outerHeight());
                    }, 0);</script>{/literal}
                        {$content}
                </div>
                {$CI->lang->load('admin')}
                <div class="hfooter"></div>
            </div>
            <footer>
                <div class="container">
                    <div class="row-fluid">
                        <div class="span4">
                            {lang('Interface','admin')}:
                            {echo create_admin_language_select()}
                        </div>
                        <div class="span4 t-a_c">
                            {if !defined('MAINSITE')}
                                {lang("Version","admin")}: <b>{echo getCMSNumber()}</b>-->
                            {/if}
                            <div class="muted">{lang('Help us get better','admin')} - <a href="#" id="rep_bug">{lang('report an error','admin')}</a></div>
                        </div>
                        {if !MAINSITE}
                            <div class="span4 t-a_r">
                                <div class="muted">Copyright © ImageCMS {echo date('Y')}</div>
                                <a href="{if MAINSITE}http://docs.premmerce.com/{else:}http://docs.imagecms.net{/if}" target="blank">{lang('Documentation','admin')}</a>
                            </div>
                        {else:}
                            <div class="span4 t-a_r">
                                <div class="muted">Copyright © Premmerce {echo date('Y')}</div>
                                <a href="http://docs.premmerce.com" target="blank">{lang('Documentation','admin')}</a>
                            </div>
                        {/if}
                    </div>
                </div>
            </footer>
            <div id="elfinder"></div>
            <div class="standart_form frame_rep_bug">
                <form>
                    <label>
                        {lang('Your Name','admin')}:
                        <input type=text name="name"/>
                    </label>
                    <label>
                        {lang('Your Email','admin')}:
                        <input type=text name="email"/>
                    </label>
                    <label>
                        {lang('Your remark', "admin")}:
                        <textarea name='text'></textarea>
                    </label>
                    <input type="submit" value="{lang("Send","admin")}" class="btn btn-info"/>
                    <input type="button" value="{lang("Cancel","admin")}" class="btn btn-info" style="float:right" name="cancel_button"/>
                    <input type="hidden" name='ip' value="{$_SERVER['REMOTE_ADDR']}" id="ip_address"/>
                </form>
            </div>
            <script>
                {$settings = $CI->cms_admin->get_settings();}
                var textEditor = '{$settings.text_editor}';
                {if $CI->dx_auth->is_logged_in()}
                var userLogined = true;
                {else:}
                var userLogined = false;
                {/if}
                var locale = '{echo $this->CI->config->item('language')}';
                var base_url = "{site_url()}";
            </script>

            <script src="{$THEME}js/pjax/jquery.pjax.min.js" type="text/javascript"></script>
            <script src="{$THEME}js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
            <script src="{$THEME}js/bootstrap.min.js" type="text/javascript"></script>
            <script async="async" src="{$THEME}js/bootstrap-notify.js" type="text/javascript"></script>
            <script src="{$THEME}js/jquery.form.js" type="text/javascript"></script>

            <script async="async" src="{$THEME}js/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>
            <script async="async" src="{$THEME}js/jquery-validate/jquery.validate.i18n.js" type="text/javascript"></script>

            <script src="{$THEME}js/chosen.js" type="text/javascript"></script>
            <script src="{$THEME}js/jquery.synctranslit.min.js" type="text/javascript"></script>

            <script src="{$THEME}js/functions.js" type="text/javascript"></script>
            <script src="{$THEME}js/scripts.js" type="text/javascript"></script>

            <script type="text/javascript" src="{$JS_URL}/elrte-1.3/js/elrte.min.js"></script>
            <script type="text/javascript" src="{$JS_URL}/elfinder-2.0/js/elfinder.min.js"></script>


            {if $this->CI->config->item('language') == 'russian'}
                <script async="async" src="{$THEME}js/jquery-validate/messages_ru.js" type="text/javascript"></script>
                <script type="text/javascript" src="{$JS_URL}/elrte-1.3/js/i18n/elrte.ru.js"></script>
                <script type="text/javascript" src="{$JS_URL}/elfinder-2.0/js/i18n/elfinder.ru.js"></script>
            {/if}

            <script src="{$THEME}js/admin_base_i.js" type="text/javascript"></script>
            <script src="{$THEME}js/admin_base_m.js" type="text/javascript"></script>
            <script src="{$THEME}js/admin_base_r.js" type="text/javascript"></script>
            <script src="{$THEME}js/admin_base_v.js" type="text/javascript"></script>
            <script src="{$THEME}js/admin_base_y.js" type="text/javascript"></script>
            <script type="text/javascript" src="{$JS_URL}/tiny_mce/jquery.tinymce.js"></script>
            <script src="{$THEME}js/autosearch.js" type="text/javascript"></script>
            {if MAINSITE}
                <script src="/application/modules/mainsaas/assets/js/mainsaas.js" type="text/javascript"></script>
            {/if}

            <script>
                {if $CI->uri->segment('4') == 'shop'}
                var isShop = true;
                {else:}
                var isShop = false;
                {/if}
                var lang_only_number = "{lang("numbers only","admin")}";
                var show_tovar_text = "{lang("show","admin")}";
                var hide_tovar_text = "{lang("don't show", 'admin')}";
                {literal}

                    $(document).ready(function () {

                        if (!isShop)
                        {
                            $('#shopAdminMenu').hide();
                            //$('#topPanelNotifications').hide();
                        }
                        else
                            $('#baseAdminMenu').hide();
                    })

                    function number_tooltip_live() {
                        $('.number input').each(function () {
                            $(this).attr({
                                'data-placement': 'top',
                                'data-title': lang_only_number
                            });
                        });
                    }
                    function prod_on_off() {
                        $('.prod-on_off').die('click').live('click', function () {
                            var $this = $(this);
                            if (!$this.hasClass('disabled')) {
                                if ($this.hasClass('disable_tovar')) {
                                    $this.animate({
                                        'left': '0'
                                    }, 200).removeClass('disable_tovar');
                                    if ($this.parent().data('only-original-title') == undefined) {
                                        $this.parent().attr('data-original-title', show_tovar_text)
                                        $('.tooltip-inner').text(show_tovar_text);
                                    }
                                    $this.next().attr('checked', true).end().closest('td').next().children().removeClass('disabled').removeAttr('disabled');
                                    if ($this.attr('data-page') != undefined)
                                        $('.setHit, .setHot, .setAction').removeClass('disabled').removeAttr('disabled');
                                }
                                else {
                                    $this.animate({
                                        'left': '-28px'
                                    }, 200).addClass('disable_tovar');
                                    if ($this.parent().data('only-original-title') == undefined) {
                                        $this.parent().attr('data-original-title', hide_tovar_text)
                                        $('.tooltip-inner').text(hide_tovar_text);
                                    }
                                    $this.next().attr('checked', false).end().closest('td').next().children().addClass('disabled').attr('disabled', 'disabled');
                                    if ($this.attr('data-page') != undefined)
                                        $('.setHit, .setHot, .setAction').addClass('disabled').attr('disabled', 'disabled')
                                }
                            }
                        });
                    }
                    $(window).load(function () {
                        number_tooltip_live();
                        prod_on_off();
                    })
                    base_url = '{/literal}{$BASE_URL}';
                        theme_url = '{$THEME}';

                        var elfToken = '{echo $CI->lib_csrf->get_token()}';
                </script>
                {if MAINSITE}
                    <script id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async" src="https://web.redhelper.ru/service/main.js?c=imagecms"/>
                {/if}
                <div id="jsOutput" style="display: none;"></div>
            </body>
        </html>
