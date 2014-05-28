<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="generator" content="ImageCMS" />
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css" media="all" />
            <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="{$THEME}css/lte_ie_8.css" /><![endif]-->
            <!--[if IE 7]><link rel="stylesheet" type="text/css" href="{$THEME}css/ie_7.css" /><![endif]-->
        <!--[if lt IE 9]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!--[if gte IE 9]>
            <style type="text/css">
              .gradient {
                 filter: none;
              }
            </style>
        <![endif]-->
        <link rel="icon" type="image/vnd.microsoft.icon" href="{echo siteinfo('siteinfo_favicon_url')}" />
        <link rel="SHORTCUT ICON" href="favicon.ico" />
        <script type="text/javascript" src="{$THEME}js/jquery-1.8.3.min.js"></script>
        {literal}
            <style>
                .imagecms-top-fixed-header{min-width: 960px;height: 0;box-shadow: 0 1px 4px rgba(0,0,0,.2);background-color: #fafafa;border-top: 0 solid #0aae85;position: fixed;top: 0;left: 0;width: 100%;z-index: 1000;font-family: Arial, sans-serif;font-size: 12px;color: #223340;vertical-align: baseline;}
                .imagecms-top-fixed-header.imagecms-active + .main-body header{padding-top: 30px;}
                .imagecms-top-fixed-header.imagecms-active{height: 30px;border-top-width: 3px;}
                .imagecms-top-fixed-header .container{position: relative;}
                .imagecms-logo{float: left;}
                .imagecms-ref-skype, .imagecms-phone{font-size: 0;}
                .imagecms-phone{margin-right: 32px;}
                .imagecms-phone .imagecms-text-el{font-size: 11px;color: #333;}
                .imagecms-ref-skype .imagecms-text-el{font-size: 12px;color: #223340;}
                .imagecms-ref-skype{color: #223340;text-decoration: none;}
                .imagecms-list{list-style: none;font-size: 0;border-width: 0 1px;border-style: solid;border-left-color: #ccc;border-right-color: #fff;float: left;display: none;}
                .imagecms-list > li{height: 30px;vertical-align: top;padding: 0 27px;text-align: left;display: inline-block;border-width: 0 1px;border-style: solid;border-left-color: #fff;border-right-color: #ccc;font-size: 12px;}
                .imagecms-list > li > a{line-height: 30px;}
                .imagecms-ref{color: #000;text-decoration: none;}
                .imagecms-ico-phone, .imagecms-ico-skype{width: auto !important;height: auto !important;position: relative !important;vertical-align: baseline;}
                .imagecms-ico-skype{position: relative;top: 2px;margin-right: 5px;}
                .imagecms-ico-phone{position: relative;top: 1px;margin-right: 6px;}
                .imagecms-buy-license > a{text-decoration: none;height: 100%;display: block;padding: 0 20px;font-size: 0;}
                .imagecms-buy-license > a > .imagecms-text-el{color: #fff;font-weight: bold;font-size: 11px;line-height: 30px;text-transform: uppercase;}
                .imagecms-buy-license{
                    float: right;height: 30px;box-shadow: 0 1px 1px rgba(0,0,0,.1);display: none;
                    background: #0eb48e; /* Old browsers */
                    background: -moz-linear-gradient(top,  #0eb48e 0%, #09a77d 100%); /* FF3.6+ */
                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#0eb48e), color-stop(100%,#09a77d)); /* Chrome,Safari4+ */
                    background: -webkit-linear-gradient(top,  #0eb48e 0%,#09a77d 100%); /* Chrome10+,Safari5.1+ */
                    background: -o-linear-gradient(top,  #0eb48e 0%,#09a77d 100%); /* Opera 11.10+ */
                    background: -ms-linear-gradient(top,  #0eb48e 0%,#09a77d 100%); /* IE10+ */
                    background: linear-gradient(to bottom,  #0eb48e 0%,#09a77d 100%); /* W3C */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0eb48e', endColorstr='#09a77d',GradientType=0 ); /* IE6-9 */
                }
                .imagecms-buy-license .imagecms-text-el{vertical-align: middle;}
                .imagecms-buy-license .imagecms-ico-donwload{vertical-align: middle;margin-left: 11px;}
                .imagecms-contacts{text-align: center;padding-top: 6px;display: none;}
                .imagecms-close{cursor: pointer;position: absolute;right: -100px;top: 0;height: 30px;line-height: 30px;background-color: #9adccb;width: 95px;display: none;z-index: 3;}
                .imagecms-toggle-close-text{color: #333;position: relative;top: -1px;}
                .imagecms-active .imagecms-buy-license, .imagecms-active .imagecms-list, .imagecms-active .imagecms-contacts{display: block;}
            </style>
            <script type="text/javascript">
                function setCookie(name, value, expires, path, domain, secure)
                {
                    var today = new Date();
                    today.setTime(today.getTime());
                    if (expires)
                    {
                        expires = expires * 1000 * 60 * 60 * 24;
                    }
                    var expiresDate = new Date(today.getTime() + (expires));
                    document.cookie = name + "=" + encodeURIComponent(value) +
                            ((expires) ? ";expires=" + expiresDate.toGMTString() : "") + ((path) ? ";path=" + path : "") +
                            ((domain) ? ";domain=" + domain : "") +
                            ((secure) ? ";secure" : "");
                }
            </script>
        {/literal}
    </head>
    <body>
        <!-- Start. corporate-->
        <div class="imagecms-top-fixed-header{if $_COOKIE['condPromoToolbar'] == '1' || $_COOKIE['condPromoToolbar'] == NULL} imagecms-active{/if}">
            <div class="container">
                <button type="button" class="imagecms-close" {if $_COOKIE['condPromoToolbar'] == '1' || $_COOKIE['condPromoToolbar'] == NULL}style="display: block;"{/if} onclick="setCookie('condPromoToolbar', '0');
                        $('.imagecms-top-fixed-header').removeClass('imagecms-active');
                        $(this).hide().next().show();
                        $(window).scroll();">
                    <span class="imagecms-toggle-close-text imagecms-bar-close-text"><span style="font-size: 14px;">↑</span> {lang('Скрыть', 'corporate')}</span>
                </button>
                <button type="button" class="imagecms-close" {if $_COOKIE['condPromoToolbar'] == '0'}style="display: block;"{/if} onclick="setCookie('condPromoToolbar', '1');
                        $('.imagecms-top-fixed-header').addClass('imagecms-active');
                        $(this).hide().prev().show();
                        $(window).scroll();">
                    <span class="imagecms-toggle-close-text imagecms-bar-show-text"><span style="font-size: 14px;">↓</span> {lang('Показать', 'corporate')}</span>
                </button>
                <div class="imagecms-buy-license">
                    <a href="http://www.imagecms.net/download/corporate" target="_blank" onclick="_gaq.push(['_trackEvent', 'demo-front', '/download/corporate']);">
                        <span class="imagecms-text-el">{lang('Скачать бесплатно','corporate')}</span>
                    </a>
                </div>
                <ul class="imagecms-list">
                    <li>
                        <a href="http://www.imagecms.net/free-cms-corporate" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demo-front', '/free-cms-corporate']);">{lang('Обзор продукта','corporate')}</a>
                    </li>
                    <li>
                        <a href="http://www.imagecms.net/corporate-bazovye-vozmozhnosti" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demo-front', '/corporate-bazovye-vozmozhnosti']);">{lang('Базовые возможности','corporate')}</a>
                    </li>
                    <li>
                        <a href="http://www.imagecms.net/blog" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demo-front', '/blog']);">{lang('Блог','corporate')}</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End. corporate-->
        <div class="main-body">
            <div class="fon-header">
                <header>
                    <div class="menu-header">
                        <div class="container">
                            <nav class="f_l nav nav-header">
                                {load_menu('top_menu')}
                            </nav>
                            {include_tpl('auth_data')}
                        </div>
                    </div>
                    <div class="content-header">
                        <div class="container">
                            {if $CI->core->core_data['data_type'] == 'main'}
                                <span class="logo f_l">
                                    <img src="{echo siteinfo('siteinfo_logo_url')}" alt="logo.png"/>
                                </span>
                            {else:}
                                <a href="{site_url()}" class="logo f_l">
                                    <img src="{echo siteinfo('siteinfo_logo_url')}" alt="logo.png"/>
                                </a>
                            {/if}
                            <div class="content-cleaner-search f_r">
                                {widget('header')}
                            </div>
                        </div>
                    </div>
                </header>
                {load_menu('main_menu')}
                {if $CI->core->core_data['data_type'] == 'main'}
                    <!-- Start. Show banner on home page. -->
                    {include_tpl('homebanner')}
                    <!-- End. Show banner on home page. -->
                {/if}
            </div>
            {$content}
            <div class="h-footer"></div>
        </div>
        <footer>
            <div class="content-footer">
                <div class="container">
                    <div class="copy-right f_l">
                        {widget('footer')}
                    </div>    
                    <nav class="box-1 f_r nav-footer">
                        {load_menu('bottom_menu')}
                    </nav>    
                </div>
            </div>
        </footer>
        <script type="text/javascript" src="{$THEME}js/jquery.pluginssiteimage.js"></script>
        <script type="text/javascript" src="{$THEME}js/scripts.js"></script>
    </body>
</html>