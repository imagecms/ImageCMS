<!DOCTYPE html>
<html>
    <head>
        <title>{lang("Operation panel","admin")} | Image CMS</title>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <meta name="description" content="{lang("Operation panel","admin")} - Image CMS" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="generator" content="ImageCMS">

        <link rel="icon" type="image/x-icon" href="{$THEME}images/favicon.png"/>

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

        <script type="text/javascript">
                    var MAINSITE = "{echo MAINSITE}";
        </script>
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
        {/if}
        <div class="main_body">
            <div id="fixPage"></div>
            <!-- Here be notifications -->
            <div class="notifications top-right"></div>

            <header>
                <section class="container">
                    {if SHOP_INSTALLED}
                        <a href="{base_url('admin/components/run/shop/dashboard')}" class="logo pull-left pjax">
                        {else:}
                            <a href="/admin/dashboard" class="logo pull-left pjax">
                            {/if}
                            <img src="{$THEME}img/logo.png"/>
                        </a>

                        {if $CI->dx_auth->is_logged_in()}
                            <div class="pull-right span4">
                                <div class="clearfix">
                                    <span class="m-r_10">
                                        {lang("Hello","admin")},
                                        {if $CI->dx_auth->get_username()}
                                            <a href="
                                               {if SHOP_INSTALLED}/admin/components/run/shop/users/edit/{echo $CI->dx_auth->get_user_id()}
                                               {else:}/admin/components/cp/user_manager/edit_user/{echo $CI->dx_auth->get_user_id()}
                                               {/if}"
                                               id="user_name">
                                                {echo $CI->dx_auth->get_username()}
                                            </a>
                                            <a href="/admin/logout">
                                                <i class="my_icon exit_ico"></i>
                                            </a>
                                        {else:}
                                            {echo lang("Guest","admin")}
                                        {/if}
                                    </span>
                                    <span class="m-l_10">{lang('Preview','admin')} <a href="{$BASE_URL}" target="_blank">{lang('site','admin')} <span class="f-s_14">→</span></a></span>
                                </div>
                                <form method="get" action="{if $ADMIN_URL}/admin/components/run/shop/search/advanced{else:}/admin/admin_search{/if}" id="adminAdvancedSearch">
                                    <div class="input-append search">
                                        <button id="adminSearchSubmit" type="submit" class="btn pull-right"><i class="icon-search"></i></button>
                                        <div class="o_h">
                                            <input id="{if $ADMIN_URL}shopSearch{else:}baseSearch{/if}" name="q" size="16" type="text"  autocomplete="off" tabindex="1" value="{$_GET['q']}">
                                        </div>
                                    </div>
                                </form>
                            </div>



                            {if SHOP_INSTALLED}
                                <div class="btn-group" id="topPanelNotifications" style="display: block;">
                                    <div class="span4 d-i_b">
                                        <a href="/admin/components/run/shop/orders/index" class=" pjax btn btn-large" data-title="{lang('Orders','admin')}" data-rel="tooltip" data-original-title="{lang('Orders','admin')}">
                                            <i class="icon-bask "></i>
                                        </a>
                                        <a href="#" class="btn btn-large pjax" data-title="{lang("Products without icons","admin")}" data-rel="tooltip" data-original-title="">
                                            <i class="icon-report_exists"></i>
                                        </a>
                                        <a href="#" class="btn btn-large pjax" data-title="Callback" data-rel="tooltip" data-original-title="Callback">
                                            <i class="icon-callback "></i>
                                        </a>
                                        <a href="/admin/components/cp/comments" class="btn btn-large pjax" data-title="{lang("Latest/recent comments","admin")}" data-rel="tooltip" data-original-title="{lang("Latest/recent comments","admin")}">
                                            <i class="icon-comment_head "></i>
                                        </a>
                                    </div>
                                </div>
                            {/if}
                        {/if}


                </section>
            </header>
            {if $CI->dx_auth->is_logged_in()}
                <div class="frame_nav">
                    {if MAINSITE}
                        {include(MAINSITE.'/templates/administrator/inc/menus.php');}
                    {else:}
                        {include('templates/administrator/inc/menus.php');}
                    {/if}
                    {if !SHOP_INSTALLED}
                        <div class="container" id="baseAdminMenu">
                            <nav class="navbar navbar-inverse">
                                <ul class="nav">
                                    {foreach $baseMenu as $li}
                                        <li class="{$li.class} {if $li.subMenu} dropdown{/if}">
                                            {if $li.subMenu}
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="{$li.icon}"></i>{echo (bool)$li.text?$li.text:$li.text}<b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                    {foreach $li.subMenu as $sli}
                                                        {if $sli.menusList}
                                                            {if !$menus}
                                                                {$CI->load->module('menu'); $menus=$CI->menu->get_all_menus()}
                                                            {/if}

                                                            <li><a href="/admin/components/cp/menu/index" class="pjax">{lang("Management","admin")}</a></li>
                                                            <li class="divider"></li>
                                                                {foreach $menus as $menu}
                                                                <li><a href="/admin/components/cp/menu/menu_item/{$menu.name}" class="pjax">{$menu.main_title}</a></li>
                                                                {/foreach}
                                                            {/if}
                                                            {if $sli.modulesList}
                                                                {if !$components}
                                                                    {$CI->load->module('admin/components'); $components = $CI->components->find_components_for_menu_list(TRUE)}
                                                                {/if}
                                                                {foreach $components as $component}
                                                                <li><a href="/admin/components/cp/{echo $component['name']}" class="pjax">{echo $component['menu_name']}</a></li>
                                                                {/foreach}
                                                            {/if}

                                                        <li {if $sli.divider} class="divider"{/if}{if $sli.header} class="nav-header"{/if}>
                                                            {if $sli.link || $sli.id}
                                                                <a 
                                                                    {if $sli.link} href="{site_url($sli.link)}" {/if}
                                                                    {if $sli.id} id="{$sli.id}" {/if}
                                                                    {if $sli.pjax !== FALSE} class="pjax" {/if}
                                                                    >
                                                                    {echo (bool)$sli.text?$sli.text:$sli.text}
                                                                </a>
                                                            {else:}
                                                                {echo (bool)$sli.text ? $sli.text : $sli.text}
                                                            {/if}
                                                        </li>


                                                    {/foreach}
                                                </ul>
                                            {else:}
                                                <a href="{$li.link}" class="pjax">
                                                    <i class="{$li.icon}"></i>
                                                    <span>{$li.text}</span>
                                                </a>
                                            {/if}
                                        </li>
                                    {/foreach}
                                </ul>

                                {//if SHOP_INSTALLED}
                                   <!-- <a class="btn btn-small pull-right btn-info" onclick="loadShopInterface();" href="#">{lang('Manage shop','admin')}<span class="f-s_14">→</span></a>-->
                                {///if}
                                {$CI->lang->load($langDomain)}
                            </nav>
                        </div>
                    {/if}
                    {if SHOP_INSTALLED}
                        <div class="container" >
                            <nav class="navbar navbar-inverse">
                                <ul class="nav">
                                    {foreach $shopMenu as $li}
                                        <li class="{$li.class} {if $li.subMenu} dropdown{/if}">
                                            {if $li.subMenu}
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="{$li.icon}"></i>{echo (bool)$li.text?$li.text:$li.text}<b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                    {foreach $li.subMenu as $sli}
                                                        <li {if $sli.divider} class="divider"{/if}{if $sli.header} class="nav-header"{/if}>
                                                            {if $sli.link || $sli.id}
                                                                <a 
                                                                    {if $sli.link} href="{site_url($sli.link)}" {/if}
                                                                    {if $sli.id} id="{$sli.id}" {/if}
                                                                    {if $sli.pjax !== FALSE} class="pjax" {/if}>
                                                                    {echo (bool)$sli.text?$sli.text:$sli.text}
                                                                </a>
                                                            {else:}
                                                                {echo $sli.text?$sli.text:$sli.text}
                                                            {/if}

                                                        </li>
                                                        {if $sli.modulesList}
                                                            {if !$components}
                                                                {$CI->load->module('admin/components'); $components = $CI->components->find_components_for_menu_list(TRUE)}
                                                            {/if}
                                                            {foreach $components as $component}
                                                                <li><a href="/admin/components/cp/{echo $component['name']}" class="pjax">{echo $component['menu_name']}</a></li>
                                                                {/foreach}
                                                            <li class="divider"></li>
                                                            <li><a href="/admin/components/modules_table" class="pjax">{lang('All modules', 'admin')}</a></li>
                                                            {/if}

                                                    {/foreach}
                                                </ul>
                                            {else:}
                                                <a href="{$li.link}" class="pjax">
                                                    <i class="{$li.icon}"></i>
                                                    <span>{$li.text}</span>
                                                </a>
                                            {/if}
                                        </li>
                                    {/foreach}
                                </ul>
                                <!--<a class="btn btn-small pull-right btn-info" onclick=" loadBaseInterface();"  href="#"><span class="f-s_14">←</span> {lang('Manage site','admin')} </a>-->
                            </nav>
                        </div>
                    {/if}
                </div>
            {/if}
            <div id="loading"></div>
            {$CI->lang->load($langDomain)}
            <div class="container" id="mainContent">
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
                        {lang("Version","admin")}: <b>{echo getCMSNumber()}</b>
                        <div class="muted">{lang('Help us get better','admin')} - <a href="#" id="rep_bug">{lang('report an error','admin')}</a></div>
                    </div>
                    <div class="span4 t-a_r">
                        <div class="muted">Copyright © ImageCMS {echo date('Y')}</div>
                        <a href="http://docs.imagecms.net" target="blank">{lang('Documentation','admin')}</a>
                    </div>
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
    var textEditor = '{$settings.text_editor}';
            {if $CI->dx_auth->is_logged_in()}
    var userLogined = true;
            {else:}
    var userLogined = false;
            {/if}

    var locale = '{echo $this->CI->config->item('language')}';
    var base_url = "{site_url()}";
        </script>

        <script src="{$THEME}js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="{$THEME}js/pjax/jquery.pjax.min.js" type="text/javascript"></script>
        <script src="{$THEME}js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        <script src="{$THEME}js/bootstrap.min.js" type="text/javascript"></script>
        <script async="async" src="{$THEME}js/bootstrap-notify.js" type="text/javascript"></script>
        <script src="{$THEME}js/jquery.form.js" type="text/javascript"></script>

        <script async="async" src="{$THEME}js/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>
        <script async="async" src="{$THEME}js/jquery-validate/jquery.validate.i18n.js" type="text/javascript"></script>

        <script src="{$THEME}js/chosen.js" type="text/javascript"></script>

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

        $(document).ready(function() {

            if (!isShop)
            {
                $('#shopAdminMenu').hide();
                //$('#topPanelNotifications').hide();
            }
            else
                $('#baseAdminMenu').hide();
        })

        function number_tooltip_live() {
            $('.number input').each(function() {
                $(this).attr({
                    'data-placement': 'top',
                    'data-title': lang_only_number
                });
            })
            number_tooltip();
        }
        function prod_on_off() {
            $('.prod-on_off').die('click').live('click', function() {
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
        $(window).load(function() {
            number_tooltip_live();
            prod_on_off();
        })
        base_url = '{/literal}{$BASE_URL}';
            theme_url = '{$THEME}';

            var elfToken = '{echo $CI->lib_csrf->get_token()}';
            </script>
            <div id="jsOutput" style="display: none;"></div>
        </body>
    </html>
