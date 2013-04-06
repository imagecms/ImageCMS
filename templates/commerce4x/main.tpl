{#
/**
* @main.tpl - template for displaying shop main page
* Variables
*   $site_title: variable for insert site title
*   $meta_noindex: variable for insert meta noindex
*   $canonical: variable for insert canonical
*   $site_description: variable for insert site description
*   $THEME: variable for template path
*   $site_keywords : variable for insert site keywords
*   $content : variable for insert content of page
*/
#}
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta name="generator" content="ImageCMS" />
        <link rel="icon" type="image/x-icon" href="{$THEME}images/favicon.png"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css"/>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <script src="{$THEME}js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <!--[if lt IE 9]>
            <link rel="stylesheet" type="text/css" href="{$THEME}css/lt_ie8.css" />
            <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script src="js/css3-mediaqueries.js"></script>
            <script src="/js/localStorageIE.js"></script>
        <![endif]-->
        <!--[if IE 7]><link rel="stylesheet" type="text/css" href="{$THEME}css/ie_7.css" /><![endif]-->
        {literal}
            <style>
                /*!
                * Bootstrap Responsive v2.1.1
                *
                * Copyright 2012 Twitter, Inc
                * Licensed under the Apache License v2.0
                * http://www.apache.org/licenses/LICENSE-2.0
                *
                * Designed and built with all the love in the world @twitter by @mdo and @fat.
                */.clearfix{*zoom:1}.clearfix:before,.clearfix:after{display:table;line-height:0;content:""}.clearfix:after{clear:both}.hide-text{font:0/0 a;color:transparent;text-shadow:none;background-color:transparent;border:0}.input-block-level{display:block;width:100%;min-height:30px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.hidden{display:none;visibility:hidden}.visible-phone{display:none!important}.visible-tablet{display:none!important}.hidden-desktop{display:none!important}.visible-desktop{display:inherit!important}@media screen and (max-width:320px){.items_catalog>.span9>.description{margin-left:0;clear:both}}@media screen and (max-width:380px){.frameHeaderMenu{overflow:visible}}@media screen and (min-width:768px) and (max-width:979px){.hidden-desktop{display:inherit!important}.visible-desktop{display:none!important}.visible-tablet{display:inherit!important}.hidden-tablet{display:none!important}}@media screen and (max-width:767px){.hidden-desktop{display:inherit!important}.visible-desktop{display:none!important}.visible-phone{display:inherit!important}.hidden-phone{display:none!important}.items_catalog{margin:0 15px}}@media screen and (min-width:1200px){.row{margin-left:-30px;*zoom:1}.row:before,.row:after{display:table;line-height:0;content:""}.row:after{clear:both}[class*="span"]{float:left;min-height:1px;margin-left:30px}.container,.navbar-static-top .container,.navbar-fixed-top .container,.navbar-fixed-bottom .container{width:1170px}.span12{width:1170px}.span11{width:1070px}.span10{width:970px}.span9{width:870px}.span8{width:770px}.span7{width:670px}.span6{width:570px}.span5{width:470px}.span4{width:370px}.span3{width:270px}.span2{width:170px}.span1{width:70px}.offset12{margin-left:1230px}.offset11{margin-left:1130px}.offset10{margin-left:1030px}.offset9{margin-left:930px}.offset8{margin-left:830px}.offset7{margin-left:730px}.offset6{margin-left:630px}.offset5{margin-left:530px}.offset4{margin-left:430px}.offset3{margin-left:330px}.offset2{margin-left:230px}.offset1{margin-left:130px}.row-fluid{width:100%;*zoom:1}.row-fluid:before,.row-fluid:after{display:table;line-height:0;content:""}.row-fluid:after{clear:both}.row-fluid [class*="span"]{display:block;float:left;width:100%;min-height:30px;margin-left:2.564102564102564%;*margin-left:2.5109110747408616%;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.row-fluid [class*="span"]:first-child{margin-left:0}.row-fluid .span12{width:100%;*width:99.94680851063829%}.row-fluid .span11{width:91.45299145299145%;*width:91.39979996362975%}.row-fluid .span10{width:82.90598290598291%;*width:82.8527914166212%}.row-fluid .span9{width:74.35897435897436%;*width:74.30578286961266%}.row-fluid .span8{width:65.81196581196582%;*width:65.75877432260411%}.row-fluid .span7{width:57.26495726495726%;*width:57.21176577559556%}.row-fluid .span6{width:48.717948717948715%;*width:48.664757228587014%}.row-fluid .span5{width:40.17094017094017%;*width:40.11774868157847%}.row-fluid .span4{width:31.623931623931625%;*width:31.570740134569924%}.row-fluid .span3{width:23.076923076923077%;*width:23.023731587561375%}.row-fluid .span2{width:14.52991452991453%;*width:14.476723040552828%}.row-fluid .span1{width:5.982905982905983%;*width:5.929714493544281%}.row-fluid .offset12{margin-left:105.12820512820512%;*margin-left:105.02182214948171%}.row-fluid .offset12:first-child{margin-left:102.56410256410257%;*margin-left:102.45771958537915%}.row-fluid .offset11{margin-left:96.58119658119658%;*margin-left:96.47481360247316%}.row-fluid .offset11:first-child{margin-left:94.01709401709402%;*margin-left:93.91071103837061%}.row-fluid .offset10{margin-left:88.03418803418803%;*margin-left:87.92780505546462%}.row-fluid .offset10:first-child{margin-left:85.47008547008548%;*margin-left:85.36370249136206%}.row-fluid .offset9{margin-left:79.48717948717949%;*margin-left:79.38079650845607%}.row-fluid .offset9:first-child{margin-left:76.92307692307693%;*margin-left:76.81669394435352%}.row-fluid .offset8{margin-left:70.94017094017094%;*margin-left:70.83378796144753%}.row-fluid .offset8:first-child{margin-left:68.37606837606839%;*margin-left:68.26968539734497%}.row-fluid .offset7{margin-left:62.393162393162385%;*margin-left:62.28677941443899%}.row-fluid .offset7:first-child{margin-left:59.82905982905982%;*margin-left:59.72267685033642%}.row-fluid .offset6{margin-left:53.84615384615384%;*margin-left:53.739770867430444%}.row-fluid .offset6:first-child{margin-left:51.28205128205128%;*margin-left:51.175668303327875%}.row-fluid .offset5{margin-left:45.299145299145295%;*margin-left:45.1927623204219%}.row-fluid .offset5:first-child{margin-left:42.73504273504273%;*margin-left:42.62865975631933%}.row-fluid .offset4{margin-left:36.75213675213675%;*margin-left:36.645753773413354%}.row-fluid .offset4:first-child{margin-left:34.18803418803419%;*margin-left:34.081651209310785%}.row-fluid .offset3{margin-left:28.205128205128204%;*margin-left:28.0987452264048%}.row-fluid .offset3:first-child{margin-left:25.641025641025642%;*margin-left:25.53464266230224%}.row-fluid .offset2{margin-left:19.65811965811966%;*margin-left:19.551736679396257%}.row-fluid .offset2:first-child{margin-left:17.094017094017094%;*margin-left:16.98763411529369%}.row-fluid .offset1{margin-left:11.11111111111111%;*margin-left:11.004728132387708%}.row-fluid .offset1:first-child{margin-left:8.547008547008547%;*margin-left:8.440625568285142%}.thumbnails{margin-left:-30px}.thumbnails>li{margin-left:30px}.row-fluid .thumbnails{margin-left:0}}@media screen and (min-width:768px) and (max-width:979px){.row{margin-left:-20px;*zoom:1}.row:before,.row:after{display:table;line-height:0;content:""}.row:after{clear:both}[class*="span"]{float:left;min-height:1px;margin-left:20px}.container,.navbar-static-top .container,.navbar-fixed-top .container,.navbar-fixed-bottom .container{width:724px}.span12{width:724px}.span11{width:662px}.span10{width:600px}.span9{width:538px}.span8{width:476px}.span7{width:414px}.span6{width:352px}.span5{width:290px}.span4{width:228px}.span3{width:166px}.span2{width:104px}.span1{width:42px}.offset12{margin-left:764px}.offset11{margin-left:702px}.offset10{margin-left:640px}.offset9{margin-left:578px}.offset8{margin-left:516px}.offset7{margin-left:454px}.offset6{margin-left:392px}.offset5{margin-left:330px}.offset4{margin-left:268px}.offset3{margin-left:206px}.offset2{margin-left:144px}.offset1{margin-left:82px}.row-fluid{width:100%;*zoom:1}.row-fluid:before,.row-fluid:after{display:table;line-height:0;content:""}.row-fluid:after{clear:both}.row-fluid [class*="span"]{display:block;float:left;width:100%;min-height:30px;margin-left:2.7624309392265194%;*margin-left:2.709239449864817%;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.row-fluid [class*="span"]:first-child{margin-left:0}.row-fluid .span12{width:100%;*width:99.94680851063829%}.row-fluid .span11{width:91.43646408839778%;*width:91.38327259903608%}.row-fluid .span10{width:82.87292817679558%;*width:82.81973668743387%}.row-fluid .span9{width:74.30939226519337%;*width:74.25620077583166%}.row-fluid .span8{width:65.74585635359117%;*width:65.69266486422946%}.row-fluid .span7{width:57.18232044198895%;*width:57.12912895262725%}.row-fluid .span6{width:48.61878453038674%;*width:48.56559304102504%}.row-fluid .span5{width:40.05524861878453%;*width:40.00205712942283%}.row-fluid .span4{width:31.491712707182323%;*width:31.43852121782062%}.row-fluid .span3{width:22.92817679558011%;*width:22.87498530621841%}.row-fluid .span2{width:14.3646408839779%;*width:14.311449394616199%}.row-fluid .span1{width:5.801104972375691%;*width:5.747913483013988%}.row-fluid .offset12{margin-left:105.52486187845304%;*margin-left:105.41847889972962%}.row-fluid .offset12:first-child{margin-left:102.76243093922652%;*margin-left:102.6560479605031%}.row-fluid .offset11{margin-left:96.96132596685082%;*margin-left:96.8549429881274%}.row-fluid .offset11:first-child{margin-left:94.1988950276243%;*margin-left:94.09251204890089%}.row-fluid .offset10{margin-left:88.39779005524862%;*margin-left:88.2914070765252%}.row-fluid .offset10:first-child{margin-left:85.6353591160221%;*margin-left:85.52897613729868%}.row-fluid .offset9{margin-left:79.8342541436464%;*margin-left:79.72787116492299%}.row-fluid .offset9:first-child{margin-left:77.07182320441989%;*margin-left:76.96544022569647%}.row-fluid .offset8{margin-left:71.2707182320442%;*margin-left:71.16433525332079%}.row-fluid .offset8:first-child{margin-left:68.50828729281768%;*margin-left:68.40190431409427%}.row-fluid .offset7{margin-left:62.70718232044199%;*margin-left:62.600799341718584%}.row-fluid .offset7:first-child{margin-left:59.94475138121547%;*margin-left:59.838368402492065%}.row-fluid .offset6{margin-left:54.14364640883978%;*margin-left:54.037263430116376%}.row-fluid .offset6:first-child{margin-left:51.38121546961326%;*margin-left:51.27483249088986%}.row-fluid .offset5{margin-left:45.58011049723757%;*margin-left:45.47372751851417%}.row-fluid .offset5:first-child{margin-left:42.81767955801105%;*margin-left:42.71129657928765%}.row-fluid .offset4{margin-left:37.01657458563536%;*margin-left:36.91019160691196%}.row-fluid .offset4:first-child{margin-left:34.25414364640884%;*margin-left:34.14776066768544%}.row-fluid .offset3{margin-left:28.45303867403315%;*margin-left:28.346655695309746%}.row-fluid .offset3:first-child{margin-left:25.69060773480663%;*margin-left:25.584224756083227%}.row-fluid .offset2{margin-left:19.88950276243094%;*margin-left:19.783119783707537%}.row-fluid .offset2:first-child{margin-left:17.12707182320442%;*margin-left:17.02068884448102%}.row-fluid .offset1{margin-left:11.32596685082873%;*margin-left:11.219583872105325%}.row-fluid .offset1:first-child{margin-left:8.56353591160221%;*margin-left:8.457152932878806%}}@media screen and (max-width:767px){.navbar-fixed-top,.navbar-fixed-bottom,.navbar-static-top{margin-right:-20px;margin-left:-20px}.container-fluid{padding:0}.dl-horizontal dt{float:none;width:auto;clear:none;text-align:left}.dl-horizontal dd{margin-left:0}.container{width:auto}.row-fluid{width:100%}.row,.thumbnails{margin-left:0}.thumbnails>li{float:none;margin-left:0}[class*="span"],.row-fluid [class*="span"]{display:block;float:none;width:100%;margin-left:0;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.span12,.row-fluid .span12{width:100%;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}}@media screen and (max-width:350px){.horizontal_form .title{float: none;}.horizontal_form .frame_form_field{margin-left: 0;}}
            </style>
        {/literal}
        {$meta_noindex}
        {$canonical}
        <script type="text/javascript" src="{$THEME}js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/underscore-min.js"></script>
    </head>
    <body>
        <div class="mainBody">
            <div class="header">
                <header>
                    <div class="container">
                        <section class="row-fluid">
                            <div class="f_r m-l_25">
                                <nav class="f_l">
                                    <ul class="nav navHorizontal frameEnterReg">
                                        <!--Start. If not logged in then show links for registration and enter to the system-->
                                        {if !$CI->dx_auth->is_logged_in()}
                                            <li>
                                                <span class="f-s_0">
                                                    <span class="helper"></span>
                                                    <button type="button"
                                                            id="loginButton"
                                                            data-drop=".drop-enter"
                                                            data-effect-on="fadeIn"
                                                            data-effect-off="fadeOut"
                                                            data-duration="300"
                                                            data-place="noinherit"
                                                            data-placement="top right">
                                                        <span class="icon-enter"></span>
                                                        <span class="d_l_g">Вход</span>
                                                    </button>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="f-s_0">
                                                    <span class="helper"></span>
                                                    <span>
                                                        <a href="/auth/register" class="t-d_n c_5c f-s_0 register">
                                                            <span class="icon-registration"></span>
                                                            <span class="text-el">Регистрация</span>
                                                        </a>
                                                    </span>
                                                </span>
                                            </li>
                                            <!--Else show link for personal cabinet -->
                                        {else:}
                                            <li>
                                                <span class="f-s_0">
                                                    <span class="helper"></span>
                                                    <span>
                                                        <a href="/shop/profile" class="t-d_u c_5c">
                                                            <span class="text-el">Личный кабинет</span>
                                                        </a>
                                                    </span>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="f-s_0">
                                                    <span class="helper"></span>
                                                    <button type="button" onclick="ImageCMSApi.formAction('/auth/authapi/logout', '')">
                                                        <span class="icon-exit"></span>
                                                        <span class="d_l_g">Выход</span>
                                                    </button>
                                                </span>
                                            </li>
                                        {/if}
                                        <!--End. ***-->
                                    </ul>
                                </nav>
                                <!-- Start. Block with link for basket with count of products -->
                                <div class="cleaner f_l f-s_0 isAvail">
                                    <span class="helper"></span>
                                    <span class="f-s_0">
                                        <span class="icon-bask"></span>
                                        <span>Корзина</span>
                                        <span id="topCartCount">&nbsp;(0)</span>
                                    </span>
                                </div>
                                <!--End-->
                            </div>
                            <!--Start. Top menu block-->
                            <nav class="frameHeaderMenu">
                                <button type="button" class="btn btn-navbar f_l">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <div class="f_l">
                                    <div class="frame-navbar">
                                        {load_menu('top_menu')}
                                    </div>
                                </div>
                            </nav>
                            <!--End-->
                        </section>
                    </div>
                </header>
                <section class="container">
                    <section class="headerContent row-fluid">
                        <div class="span3">
                            <a href="{site_url()}" class="logo">
                                <img src="{$THEME}images/logo.png" alt="logo"/>
                            </a>
                        </div>
                        <div class="span9 f-s_0">
                            <span class="helper"></span
                            ><div class="w_100 f-s_0 frameUndef_1">
                                <div class="span6">
                                    <div class="frameSearch">
                                        <form name="search"
                                              class="clearfix"
                                              action="{shop_url('search')}"
                                              method="get"
                                              id="autocomlete">
                                            <button class="f_r btn" type="submit">
                                                <span class="icon-search"></span>
                                                <span class="text-el">{lang('search_find')}</span>
                                            </button>
                                            <div class="o_h">
                                                <input type="text"
                                                       name="text"
                                                       value=""
                                                       placeholder="{lang('s_se_thi_sit')}"
                                                       autocomplete="off"
                                                       class="place_hold"
                                                       id="inputString"/>
                                            </div>
                                            <div id="suggestions" class="drop-search"></div>
                                        </form>
                                    </div>
                                </div>
                                <div class="span3">
                                    {include_shop_tpl('compare_data')}
                                    {include_shop_tpl('wish_list_data')}
                                </div>
                                <!-- Start. Block order call -->
                                <div class="span3">
                                    <div class="headerPhone">
                                        +8 (090)<span class="d_n">&minus;</span> 500-50-50
                                    </div>
                                    <div style="margin-top: 7px;">
                                        <ul class="tabs">
                                            <li>
                                                <a class="t-d_n d_b"
                                                   href="#ordercall"
                                                   data-drop=".drop-order-call"
                                                   data-effect-on="fadeIn"
                                                   data-effect-off="fadeOut"
                                                   data-duration="300"
                                                   data-place="center"
                                                   data-simple="yes">
                                                    <span class="icon-order-call"></span>
                                                    <span class="d_l_b">
                                                        {lang('s_coll_order')}
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End. Block order call-->
                            </div>
                        </div>
                    </section>
                </section>
            </div>

            <div
                <!-- Start. Render Category Tree. Menu frame -->
                <div class="mainFrameMenu">
                    {\Category\RenderMenu::create()->load('category_menu')}
                </div>
                <!-- End. Render Category Tree. Menu frame -->

                <!-- Start. Show content -->
                <div>
                    {$content}
                </div>
                <!-- End. Show content -->
            </div>
            {$exists_brands = !$CI->uri->segment(1) || $CI->uri->segment(1) == 'shop';}
            <div class="{if !$exists_brands}without_brand{/if} hFooter"></div>
        </div>
        <footer class="{if !$exists_brands}without_brand{/if}">
            <!-- Start Brands widget for Shop -->
            {if $exists_brands}
                {widget('brands')}
            {/if}
            <!-- End. Brands widget for Shop -->
            <div class="frame_footer">
                <div class="container">
                    <div class="row-fluid">
                        <div class="span5">
                            <nav>
                                {load_menu('footer_menu')}<!-- footer menu-->
                            </nav>
                        </div>
                        <!-- Start. Block with contacts -->
                        <div class="span4">
                            <ul class="contacts_info">
                                <li>
                                    <span class="icon-foot-phone"></span>
                                    <span class="f-w_b">{lang('s_tel')}:</span>
                                    +8 (090) <span class="d_n">&minus;</span> 500-50-50,
                                    +8 (100)<span class="d_n">&minus;</span> 500-50-50
                                </li>
                                <li>
                                    <span class="icon-foot-email"></span>
                                    <span class="f-w_b">{lang('s_email')}:</span> Info@imagecms.net
                                </li>
                                <li>
                                    <span class="icon-foot-skype"></span>
                                    <span class="f-w_b">{lang('s_skype')}:</span> ImageCMS
                                </li>
                                <!--Load star rating-->
                                {$CI->load->module('star_rating')->show_star_rating()}
                            </ul>
                        </div>
                        <!-- End. Block with contacts -->

                        <!-- Start. Social buttons-->
                        <div class="span3 t-a_r">
                            <div class="copy_right">© ImageCMS, 2013</div>
                            <div class="footer_social">
                                <div class="social">
                                    <a href="#" class="mail"></a>
                                    <a href="#" class="g_plus"></a>
                                    <a href="#" class="facebook"></a>
                                    <a href="#" class="vkontakte"></a>
                                    <a href="#" class="twitter"></a>
                                    <a href="#" class="odnoklasniki"></a>
                                </div>
                            </div>
                            <a href="http://imagecms.net" target="_blank">{lang('s_footer_create')}</a><br/>
                            {lang('s_footer_seo')}
                        </div>
                        <!--End-->

                    </div>
                </div>
            </div>
        </footer>
        <div class="headerFon"></div>

        <!-- php vars to js -->
        <script type="text/javascript">
                                                        var curr = '{$CS}';
                                                        var pricePrecision = parseInt('{echo ShopCore::app()->SSettings->pricePrecision}');
                                                        var checkProdStock = "{echo ShopCore::app()->SSettings->ordersCheckStocks}";
                                                        var inCart = '{lang('already_in_basket')}';
                                                        var toCart = '{lang('s_buy')}';
                                                        var pcs = 'шт.';
                                                        var kits = 'компл.';
        </script>

        <!--        Syncronization data for cart, wishlist  and comparelist     -->
        <script>
            var inServerCart = parseInt("{echo ShopCore::app()->SCart->totalItems()}");
            var inServerWish = parseInt("{echo ShopCore::app()->SWishList->totalItems()}");
            var inServerCompare = parseInt("{count($CI->session->userdata('shopForCompare'))}");
        </script>

        <script type="text/javascript" src="{$THEME}js/jquery.imagecms.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.cycle.all.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.ui-slider.js"></script>
        <script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>
        <script type="text/javascript" src="{$THEME}js/fancybox/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.form.js"></script>
        <script type="text/javascript" src="{$THEME}js/scripts.js"></script>
        <!-- Dev. scripts -->
        <script type="text/javascript" src="{$THEME}js/imagecms.api.js"></script>
        <script type="text/javascript" src="{$THEME}js/my_js_classes_iy.js"></script>

        <script type="text/javascript" src="{$THEME}js/shop.js"></script>
        
        
    <!-- Start. Including template file for displaying drop-down login form is user is not logged in -->
    {if !$CI->dx_auth->is_logged_in()}{include_tpl('login_popup')}{/if}
    <!-- End. Including template file for displaying drop-down login form is user is not logged in -->

    <!-- Start. Callback form -->
    {include_shop_tpl('callback')}
    <!-- End. Callback form -->

    <!-- Start. Block report on appearance -->
    {include_shop_tpl('report_appearance')}
    <!-- End. Block report on appearance -->

    <!-- Start. Include js-template for popup cart and order-products-->
    {include_shop_tpl('js_templates')}
    <!-- End. Include js-template for popup cart and order-products-->

    <!-- Start. Include template for autocomplete-->
    {include_shop_tpl('search_autocomplete')}
    <!-- End. Include template for autocomplete-->
</body>
</html>