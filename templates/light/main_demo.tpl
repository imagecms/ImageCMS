{/*
/**
* @main.tpl - template for displaying shop main page
* Variables
*   $site_title: variable for insert site title
*   $canonical: variable for insert canonical
*   $site_description: variable for insert site description
*   $THEME: variable for template path
*   $site_keywords : variable for insert site keywords
*   $content : variable for insert content of page
*/}
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta name="generator" content="ImageCMS" />
        <meta name = "format-detection" content = "telephone=no" />
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="{$THEME}{$colorScheme}/colorscheme.css" media="all" />

        {if $CI->uri->segment(1) == MY_Controller::getCurrentLocale()}
            {$lang = '/' . \MY_Controller::getCurrentLocale()} 
        {else:}
            {$lang = ''} 
        {/if}
        {if $CI->uri->segment(2) == 'profile' || $CI->uri->segment(1) == 'wishlist'}
            <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
        {/if}
        <script type="text/javascript">
            var locale = "{echo $lang}";
        </script>
        <script type="text/javascript" src="{$THEME}js/jquery-1.8.3.min.js"></script>
        {include_tpl('config.js')}
        {literal}
            <script type="text/javascript">
                function initDownloadScripts(scripts, callback, customEvent) {
                    function downloadJSAtOnload(scripts, callback, customEvent) {
                        var cL = 0,
                                scriptsL = scripts.length;
                        
                        $.map(scripts, function(i, n) {
                            $.ajax({
                                url: theme + 'js/' + i + '.js',
                                dataType: "script",
                                cache: false,
                                complete: function() {
                                    cL++;
                                    if (cL === scriptsL)
                                        if (callback) {
                                            eval(callback)();
                                            setTimeout(function() {
                                                $(document).trigger({'type': customEvent});
                                            }, 0);
                                        }
                                }
                            });
                            
                        })
                    }
                    // Check for browser support of event handling capability
                    if (window.addEventListener)
                        window.addEventListener("load", downloadJSAtOnload(scripts, callback, customEvent), false);
                    else if (window.attachEvent)
                        window.attachEvent("onload", downloadJSAtOnload(scripts, callback, customEvent));
                    else
                        window.onload = downloadJSAtOnload(scripts, callback, customEvent);
                }
            </script>
        {/literal}
        <!--[if lte IE 9]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="{$THEME}css/lte_ie_8.css" /><![endif]-->
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="{$THEME}css/ie_7.css" />
            <script src="{$THEME}js/localStorageJSON.js"></script>
        <![endif]-->

        <link rel="icon" href="{echo siteinfo('siteinfo_favicon_url')}" type="image/x-icon" />
        <link rel="shortcut icon" href="{echo siteinfo('siteinfo_favicon_url')}" type="image/x-icon" />
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
        {/literal}
    </head>
    <body class="is{echo $agent[0]} not-js {$CI->core->core_data['data_type']}">
        {include_tpl('language/jsLangsDefine.tpl')}
        {include_tpl('language/jsLangs.tpl')}
        <!-- Start. shop-->
        <div class="imagecms-top-fixed-header{if $_COOKIE['condPromoToolbar'] == '1' || $_COOKIE['condPromoToolbar'] == NULL} imagecms-active{/if}">
            <div class="container">
                <button type="button" class="imagecms-close" {if $_COOKIE['condPromoToolbar'] == '1' || $_COOKIE['condPromoToolbar'] == NULL}style="display: block;"{/if} onclick="setCookie('condPromoToolbar', '0');
                        $('.imagecms-top-fixed-header').removeClass('imagecms-active');
                        $(this).hide().next().show();
                        $(window).scroll();">
                    <span class="imagecms-toggle-close-text imagecms-bar-close-text"><span style="font-size: 14px;">↑</span> {lang('Скрыть', 'newLevel')}</span>
                </button>
                <button type="button" class="imagecms-close" {if $_COOKIE['condPromoToolbar'] == '0'}style="display: block;"{/if} onclick="setCookie('condPromoToolbar', '1');
                        $('.imagecms-top-fixed-header').addClass('imagecms-active');
                        $(this).hide().prev().show();
                        $(window).scroll();">
                    <span class="imagecms-toggle-close-text imagecms-bar-show-text"><span style="font-size: 14px;">↓</span> {lang('Показать', 'newLevel')}</span>
                </button>
                <div class="imagecms-buy-license">
                    <a href="http://www.imagecms.net/shop/prices" target="_blank" onclick="_gaq.push(['_trackEvent', 'demoshop-front', '/shop/prices']);">
                        <span class="imagecms-text-el">Купить лицензию</span>
                    </a>
                </div>
                <ul class="imagecms-list">
                    <li>
                        <a href="http://www.imagecms.net" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demoshop-front', 'obzor-product-shop']);">{lang('Обзор продукта', 'newLevel')}</a>
                    </li>
                    <li>
                        <a href="http://www.imagecms.net/kliuchevye-preimushchestva/vozmozhnosti" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demoshop-front', '/kliuchevye-preimushchestva/vozmozhnosti']);">{lang('Преимущества продукта', 'newLevel')}</a>
                    </li>
                    <li>
                        <a href="http://www.imagecms.net/store/category/shoptemplates" target="_blank" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demoshop-front', 'shoptemplates']);">{lang('Шаблоны для Shop', 'newLevel')}</a>
                    </li>
                </ul>
                <div class="imagecms-contacts">
                    <span class="imagecms-phone">
                        <img src="{$THEME}/icon_phone.png" class="imagecms-ico-phone"/>
                        <span class="imagecms-text-el">+7 (499) 703-37-51</span>
                    </span>
                </div>
            </div>
        </div>
        <!-- End. shop-->
        <div class="main-body">
            <div class="fon-header">
                <header>
                    {include_tpl('header')}
                </header>

                {if !strpos($CI->uri->uri_string, '/cart')}
                    <div class="frame-menu-main horizontal-menu">
                        {\Category\RenderMenu::create()->setConfig(array('cache'=>TRUE))->load('category_menu')}
                    </div>
                {else:}
                    <div class="container menu-border"></div>
                {/if}
            </div>
            <div class="content">
                {$content}
            </div>
            <div class="h-footer"></div>
        </div>
        <footer>
            {include_tpl('footer')}
        </footer>
        {include_tpl('user_toolbar')}

        {/*}Start. delete before upload to server{ */}
        {/*}
        <!-- scripts -->
        <script type="text/javascript" src="{$THEME}js/_united_side_plugins.js"></script>
        <script type="text/javascript" src="{$THEME}js/_plugins.js"></script>
        <script type="text/javascript" src="{$THEME}js/drop_extend_methods.js"></script>
        <script type="text/javascript" src="{$THEME}js/_shop.js"></script>
        <script type="text/javascript" src="{$THEME}js/_global_vars_objects.js"></script>
        <script type="text/javascript" src="{$THEME}js/_functions.js"></script>
        <script type="text/javascript" src="{$THEME}js/_scripts.js"></script>
        <!-- scripts end -->

        {literal}
            <script type="text/javascript">
                $(window).load(function() {
                    init();
                    setTimeout(function() {
                        $(document).trigger({type: 'scriptDefer'})
                    }, 0)
                })
            </script>
        {/literal}
        { */}
        {/*}End. delete before upload to server{ */}
        {/*fancybox}
        <link rel="stylesheet" type="text/css" href="{$THEME}js/fancybox/jquery.fancybox-1.3.4.css" media="all" />
        <script type="text/javascript" src="{$THEME}js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        {end. fancybox*/}

        {/*}uncomment before opload to server and combine and minimize scripts (in comment <!-- scripts -->...<!-- scripts end -->) into united_scripts file{ */}
        {/*} Start. uncoment before development { */}
        
        <script type="text/javascript">
            initDownloadScripts(['united_scripts'], 'init', 'scriptDefer');
        </script>
        
        {/*} End. uncoment before development { */}
        {include_shop_tpl('js_templates')}
    </body>
</html>