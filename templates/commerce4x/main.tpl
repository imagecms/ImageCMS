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

        {if $subStyle}
        <link rel="stylesheet" type="text/css" href="{$THEME}stylesets/{$subStyle}/style.css"/>
        { /if}

        <link href='http://fonts.googleapis.com/css?family=PT+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'>


        <script src="{$THEME}js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <!--[if lt IE 9]>
            <link rel="stylesheet" type="text/css" href="{$THEME}css/lt_ie8.css" />
            <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script src="{$THEME}js/css3-mediaqueries.js"></script>
            <script src="/js/localStorageIE.js"></script>
        <![endif]-->
        <!--[if IE 7]><link rel="stylesheet" type="text/css" href="{$THEME}css/ie_7.css" /><![endif]-->
        {$meta_noindex}
        {$canonical}
        <script type="text/javascript" src="{$THEME}js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/underscore-min.js"></script>
    </head>
    <body>
        <div class="mainBody">
            <div class="container clearfix" id="frame_additional_menu">{$CI->load->module('top_menu_additional')->render()}</div>
            <div class="header">
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
                                <div class="span7">
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
                                <div class="span5 control_shop">
                                    <nav>
                                        <ul class="nav navHorizontal frameEnterReg f-s_0">
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
                                                            data-placement="top right" class="btn btn-mini">
                                                        <span class="icon-enter"></span>
                                                        <span>Вход в магазин</span>
                                                    </button>
                                                </span>
                                            </li>
                                            <li class="c_97 divider">или</li>
                                            <li>
                                                <span class="f-s_0">
                                                    <span class="helper"></span>
                                                    <span>
                                                        <a href="/auth/register" class="t-d_n f-s_0 register">
                                                            <span class="icon-registration"></span>
                                                            <span class="text-el">Регистрация</span>
                                                        </a>
                                                    </span>
                                                </span>
                                            </li>
                                            <!--Else show link for personal cabinet -->
                                            {else:}
                                            <li class="m-r_40">
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
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </div>

            <div class="content">
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
        <!--        <div class="headerFon"></div>-->

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
        <script type="text/javascript" src="{$THEME}js/jquery.form.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/scripts.js"></script>
        <!-- Dev. scripts -->
        <script type="text/javascript" src="{$THEME}js/imagecms.api.js"></script>
        <script type="text/javascript" src="{$THEME}js/my_js_classes_iy.js"></script>

        <script type="text/javascript" src="{$THEME}js/shop.js"></script>
        <script type="text/javascript" src="{$THEME}js/shop_processing.js"></script>


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