<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta name="generator" content="ImageCMS" />
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="{$THEME}css/jquery.fancybox-1.3.4.css" media="all" />
        <link rel="icon" type="image/x-icon" href="{$THEME}images/favicon.png"/> 
        <link rel="stylesheet" href="{$THEME}css/smoothness/jquery-ui-1.9.1.custom.min.css" type="text/css" media="screen" />

        
        <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="{$THEME}css/ie8_7_6.css" /><![endif]-->
        <!--[if IE 7]><link rel="stylesheet" type="text/css" href="{$THEME}css/ie_7.css" /><![endif]-->
        <script type="text/javascript" src="{$THEME}js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.cycle.all.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery-ui-personalized-1.5.2.packed.js"></script>
        <script type="text/javascript" src="{$THEME}js/jScrollPane.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/cusel-min-2.4.1.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.ui-slider.js" ></script>
        <script type="text/javascript" src="{$THEME}js/jquery.fancybox-1.3.4.pack.js" ></script>
        <script type="text/javascript" src="{$THEME}js/jquery.form.js"></script>
        <script type="text/javascript" src="{$THEME}js/scripts.js"></script>
        <script type="text/javascript" src="{$THEME}js/shop.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery.validate.js"></script>
        <script type="text/javascript" src="{$THEME}js/imagecms.api.js"></script>
        <script type="text/javascript" src="{$THEME}js/jquery-ui-1.8.15.custom.min.js"></script>
        <script type="text/javascript" src="{$THEME}js/autocomplete.js"></script>
    </head>
    <body>        
        <div class="main_body">
            <div class="top">
                <div class="center">
                    {load_menu('top_menu')}
                    <ul class="user_menu m-l_19">{include_shop_tpl('auth_data')}</ul>
                    <ul class="user_menu cart_data_holder">{include_shop_tpl('cart_data')}</ul>
                </div>
            </div><!-- top -->
            <div class="header center">

                <a href="{$BASE_URL}" class="logo">
                    <img src="{$THEME}images/imagecms.png">
                </a>
                {$CI->load->module('mailer')}
                <div class="frame_form_search">
                    <form name="search" class="clearfix" action="{shop_url('search')}" method="get" id="autocomlete">
                        <input type="text" name="text" value="{lang("Search this site","admin")}"  onfocus="if(this.value=='{lang("Search this site","admin")}') this.value='';" onblur="if(this.value=='') this.value='{lang("Search this site","admin")}';"  id="inputString" autocomplete="off" onkeyup="lookup(event);" class="place_hold"/>
                        <input type="submit" id="search_submit"  value="{lang("Search","admin")}" class="icon"/>
                        <span id="suggestions" style="display: none; width: 0px; right: 0px;"></span>
                    </form>
                </div>
                <div class="phone">
                    <address>(095)<span> 555-55-55</span></address>
                    <span class="js showCallback">{lang("Request Call","admin")}</span>
                </div>
                <ul class="user_menu">
                    <!--    Show callback's form    -->

                    <!--    Wish list item's for Header    -->
                    <li id="wishListHolder" class="like blue{if ShopCore::app()->SWishList->totalItems()} is_avail{/if}">
                        {include_shop_tpl('wish_list_data')}</li>
                    <!--    Wish list item's for Header    -->

                    <!--    Products in compare list for Header    -->
                    <li id="compareHolder" class="compare blue{if is_array($CI->session->userdata('shopForCompare'))} is_avail{/if}">
                        {include_shop_tpl('compare_data')}</li>
                    <!--    Products in compare list for Header    -->
                </ul>
            </div><!-- header -->

            {echo ShopCore::app()->SCategoryTree->ul()}

            {$content}

            <div class="hfooter"></div>
        </div>
        <div class="footer">
            <div class="center">
                <div class="carusel_frame brand box_title carousel_js">
                    <div class="carusel clearfix">
                        <ul>
                            {foreach ShopCore::app()->SBrandsHelper->mostProductBrands(15, TRUE) as $brand}
                                <li>
                                    <a href="{shop_url($brand.full_url)}">
                                        <img src="{media_url($brand.img_fullpath)}" title="{$brand.name}" />
                                    </a>
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                    <button class="prev"></button>
                    <button class="next"></button>
                </div>
                {load_menu('footer_menu')}
                <ul class="contacts f_l">
                    <li>
                        <span class="b">{lang("Phone.","admin")}:</span>
                        <span>(095) 555-55-55</span>
                    </li>
                    <li>
                        <span class="b">{lang("Email","admin")}:</span>
                        <span>Info@imagecms.net</span>
                    </li>
                    <li>
                        <span class="b">{lang("Skype","admin")}:</span>
                        <span>ImageCMS</span>
                    </li>
                    {$CI->load->module('star_rating')->show_star_rating()}
                </ul>
                <div class="footer_info f_r">
                    <div>© ImageCMS, {date('Y')}</div>
                    <div class="social">
                        <a href="#" class="mail"></a>
                        <a href="#" class="g_plus"></a>
                        <a href="#" class="facebook"></a>
                        <a href="#" class="vkontakte"></a>
                        <a href="#" class="twitter"></a>
                        <a href="#" class="odnoklasniki"></a>
                    </div>
                    <a href="http://imagecms.net" target="_blank" class="red">Создание интернет магазина</a>
                    <div>SEO оптимизация сайта</div>
                </div>
            </div>
        </div><!-- footer -->

        <div class="h_bg_{whereami()}"></div>
    </body>
</html>
