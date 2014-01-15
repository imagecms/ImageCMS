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
                body{padding-top: 63px;}
                .imagecms-top-fixed-header{background-color: #fff;height: 60px;border-top: 3px solid #3e92d5;position: fixed;top: 0;left: 0;width: 100%;z-index: 1000;font-family: Arial, sans-serif;font-size: 12px;color: #223340;vertical-align: baseline;}
                .imagecms-top-fixed-header .container{padding-top: 9px;}
                .imagecms-logo{float: left;}
                .imagecms-ref-skype, .imagecms-phone{font-size: 0;}
                .imagecms-phone .imagecms-text-el{font-size: 14px;color: #223340;font-weight: bold;}
                .imagecms-ref-skype .imagecms-text-el{font-size: 12px;color: #223340;}
                .imagecms-ref-skype{color: #223340;text-decoration: none;}
                .imagecms-list{text-align: center;list-style: none;}
                .imagecms-list > li{height: 40px;vertical-align: top;padding: 0 23px;text-align: left;border-right: 1px solid #e4ebf1;display: inline-block;}
                .imagecms-list > li > a{line-height: 40px;}
                .imagecms-list > li:first-child{border-left: 1px solid #e4ebf1;}
                .imagecms-ref{color: #223340;text-decoration: underline;text-transform: uppercase;font-weight: bold;}
                .imagecms-ico-phone, .imagecms-ico-skype{width: auto !important;height: auto !important;position: relative !important;vertical-align: baseline;}
                .imagecms-ico-skype{position: relative;top: 2px;margin-right: 5px;}
                .imagecms-ico-phone{position: relative;top: -1px;margin-right: 6px;}
                .imagecms-buy-license > a{text-decoration: none;height: 100%;display: block;padding: 0 20px;font-size: 0;}
                .imagecms-buy-license > a > .imagecms-text-el{color: #fff;font-weight: bold;font-size: 13px;line-height: 39px;}
                .imagecms-buy-license{
                    float: right;height: 39px;box-shadow: 0 1px 1px rgba(0,0,0,.1);
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
            </style>
        {/literal}
    </head>
    <body>
        <!-- Start. corporate-->
        <div class="imagecms-top-fixed-header">
            <div class="container">
                <a href="http://www.imagecms.net/" class="imagecms-logo">
                    <img src="{$THEME}/logo.png"/>
                </a>
                <div class="imagecms-buy-license">
                    <a href="http://www.imagecms.net/download/corporate">
                        <span class="imagecms-text-el">Скачать бесплатно</span>
                        <img src="{$THEME}/icon_download.png" class="imagecms-ico-donwload"/>
                    </a>
                </div>
                <ul class="imagecms-list">
                    <li>
                        <a href="http://www.imagecms.net/free-cms-corporate" class="imagecms-ref">Обзор продукта</a>
                    </li>
                    <li>
                        <a href="http://www.imagecms.net/corporate-bazovye-vozmozhnosti" class="imagecms-ref">Базовые возможности</a>
                    </li>
                    <li>
                        <a href="http://www.imagecms.net/blog" class="imagecms-ref">Блог</a>
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