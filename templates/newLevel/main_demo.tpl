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
                                success: function() {
                                    cL++;
                                    if (cL == scriptsL)
                                        if (callback) {
                                            eval(callback)();
                                            setTimeout(function(){
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
    <body class="is{echo $agent[0]} not-js"> 
        {include_tpl('language/jsLangsDefine.tpl')}
        {include_tpl('language/jsLangs.tpl')}
        <!-- Start. shop-->
        <div class="imagecms-top-fixed-header">
            <div class="container">
                <a href="http://www.imagecms.net" onclick="_gaq.push(['_trackEvent', 'demoshop-front', 'imagecms main']);" class="imagecms-logo">
                    <img src="{$THEME}/logo.png"/>
                </a>
                <div class="imagecms-buy-license">
                    <a href="http://www.imagecms.net/shop/prices" onclick="_gaq.push(['_trackEvent', 'demoshop-front', '/shop/prices']);">
                        <span class="imagecms-text-el">Купить лицензицю</span>
                    </a>
                </div>
                <ul class="imagecms-list">
                    <li>
                        <a href="http://www.imagecms.net" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demoshop-front', '/shop/prices']);">Обзор продукта</a>
                    </li>
                    <li>
                        <a href="http://www.imagecms.net/kliuchevye-preimushchestva/vozmozhnosti" class="imagecms-ref" onclick="_gaq.push(['_trackEvent', 'demoshop-front', '/kliuchevye-preimushchestva/vozmozhnosti']);">преимущества</a>
                    </li>
                    <li>
                        <div>
                            <span class="imagecms-phone">
                                <img src="{$THEME}/icon_phone.png" class="imagecms-ico-phone"/>
                                <span class="imagecms-text-el">+7 (499) 703-37-54</span>
                            </span>
                        </div>
                        <div>
                            <a href="skype:imagecms" class="imagecms-ref-skype">
                                <img src="{$THEME}/icon_skype.png" class="imagecms-ico-skype"/>
                                <span class="imagecms-text-el">imagecms</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End. shop-->
        <div class="main-body">
            <div class="fon-header">
                <header>
                    {include_tpl('header')}
                </header>
                <div class="frame-menu-main horizontal-menu">
                    {\Category\RenderMenu::create()->setConfig(array('cache'=>TRUE))->load('category_menu')}
                </div>
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
        <script type="text/javascript" src="{$THEME}js/raphael-min.js"></script>
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
                $(window).load(function(){
                    init();
                    setTimeout(function(){
                        $(document).trigger({type: 'scriptDefer'})
                    }, 0)
                })
            </script>
        {/literal}
        { */}
        {/*}End. delete before upload to server{ */}

        {/*}uncomment before opload to server and combine and minimize scripts (in comment <!-- scripts of development -->...<!-- scripts of development end -->) into united_scripts file{ */}
        
        <script type="text/javascript">
            initDownloadScripts(['raphael-min', 'united_scripts'], 'init', 'scriptDefer');
        </script>
        
        {include_shop_tpl('js_templates')}
    </body>
</html>