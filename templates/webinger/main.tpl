{#
/**
* @main.tpl - template for displaying shop main page
* Variables
*   $site_title: variable for insert site title
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
        {/if}

        <link href='http://fonts.googleapis.com/css?family=PT+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <script src="{$THEME}js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <!--[if lte IE 8]>
            <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script src="{$THEME}js/css3-mediaqueries.js"></script>
        <![endif]-->
        <!--[if IE 7]>
            <script src="{$THEME}js/localStorageJSON.js"></script>
        <![endif]-->
        {$canonical}
        <script type="text/javascript" src="{$THEME}js/underscore-min.js"></script>
    </head>
    <body class="is{echo $agent[0]}">
         {include_tpl('javascriptVars.tpl');}
        <div class="mainBody">
            <span class="d_b top_bg"></span>
            <div class="container clearfix" id="frame_additional_menu">{$CI->load->module('top_menu_additional')->render()}</div>
            
            {include_tpl('widgets/heder')}
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
                                    <span class="f-w_b">{lang('Тел.','webinger')}:</span>
                                    +8 (090) <span class="d_n">&minus;</span> 500-50-50,
                                    +8 (100)<span class="d_n">&minus;</span> 500-50-50
                                </li>
                                <li>
                                    <span class="icon-foot-email"></span>
                                    <span class="f-w_b">{lang('Email','webinger')}:</span> Info@imagecms.net
                                </li>
                                <li>
                                    <span class="icon-foot-skype"></span>
                                    <span class="f-w_b">{lang('Skype','webinger')}:</span> ImageCMS
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
                            <a href="http://imagecms.net" target="_blank">{lang('Создание интернет магазина','webinger')}</a><br/>
                            {lang('SEO оптимизация сайта','webinger')}
                        </div>
                        <!--End-->

                    </div>
                </div>
            </div>
        </footer>


        <!-- php vars to js -->
        <script type="text/javascript">
            var curr = '{$CS}';
            var pricePrecision = parseInt('{echo ShopCore::app()->SSettings->pricePrecision}');
            var checkProdStock = "{echo ShopCore::app()->SSettings->ordersCheckStocks}";
            var inCart = '{lang('Уже в корзине','webinger')}';
            var toCart = '{lang('Купить','webinger')}';
            var pcs = '{lang('шт.', 'webinger')}';
            var kits = '{lang('компл.', 'webinger')}';
        </script>

        <!--        Syncronization data for cart, wishlist  and comparelist     -->
        {if $comp = $CI->session->userdata('shopForCompare')}
            {$cnt_comp = count($comp)}
        {else:}
            {$cnt_comp = 0}
        {/if}
        <script>
            var inServerCart = parseInt("{echo ShopCore::app()->SCart->totalItems()}");
            var inServerWish = parseInt("{echo ShopCore::app()->SWishList->totalItems()}");
            var inServerCompare = parseInt("{$cnt_comp}");
        </script>

        <script type="text/javascript" src="{$THEME}js/jquery.imagecms.shop.js"></script>

        <script type="text/javascript" src="{$THEME}js/imagecms.api.js"></script>

        <script type="text/javascript" src="{$THEME}js/jquery.jcarousel.min.js"></script>

        <script type="text/javascript" src="{$THEME}js/scripts.js"></script>


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