<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>{$site_title}</title>
        <meta name="description" content="{if (int)$page_number>1}{echo $page_number} - {/if}{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta name="generator" content="ImageCMS" />
        {$canonical}
        <link rel="stylesheet" type="text/css" href="{$SHOP_THEME}css/style.css" media="all" />
        <!--
        <link rel="stylesheet" type="text/css" href="{$SHOP_THEME}/css/jquery.fancybox-1.3.4.css" media="all" />
        -->

        <link rel="stylesheet" href="{$SHOP_THEME}/js/fancybox/source/jquery.fancybox.css?v=2.1.0" type="text/css" media="screen" />

        <link rel="stylesheet" href="{$SHOP_THEME}css/smoothness/jquery-ui-1.9.1.custom.min.css" type="text/css" media="screen" />
        <link rel="icon" type="image/x-icon" href="{$SHOP_THEME}images/favicon.png"/>
        <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="{$SHOP_THEME}/css/ie8_7_6.css" /><![endif]-->
        <!--[if IE 7]><link rel="stylesheet" type="text/css" href="{$SHOP_THEME}/css/ie_7.css" /><![endif]-->
        <script type="text/javascript" src="{$SHOP_THEME}/js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}/js/jquery.cycle.all.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}/js/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}/js/jquery-ui-1.8.15.custom.min.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}/js/jScrollPane.min.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}/js/cusel-min-2.4.1.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}/js/jquery.ui-slider.js" ></script>
        <!--
        <script type="text/javascript" src="{$SHOP_THEME}/js/jquery.fancybox-1.3.4.pack.js" ></script>
        -->
        <script type="text/javascript" src="{$SHOP_THEME}/js/fancybox/source/jquery.fancybox.js?v=2.1.0"></script>
        <script type="text/javascript" src="{$SHOP_THEME}/js/jquery.form.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}/js/scripts.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}/js/shop.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/jquery.validate.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/autocomplete.js"></script>

        <script type="text/javascript" src="{$SHOP_THEME}js/underscore-min.js"></script>
    </head>
    <body>
        <div class="main_body">
            <div class="top">
                <div class="center">
                    {load_menu('top_menu')}
                    <ul class="user_menu m-l_19 auth_data">{include_tpl('auth_data')}</ul>
                    <ul class="user_menu cart_data_holder">
                        <!--                        <li><a href="/" style="color:silver;">ru</a></li>
                                                <li style="margin-left: 0; padding-left: 5px;"><a href="{$BASE_URL}en" style="color:silver;">en</a></li>-->
                        {include_tpl('cart_data')}</ul>
                </div>
            </div><!-- top -->
            <div class="header center">
                <a href="{$BASE_URL}" class="logo">
                    <img src="{$SHOP_THEME}images/imagecms.png">
                </a>
                <div class="frame_form_search">
                    <form name="search" class="clearfix" action="{shop_url('search')}" method="get" id="autocomlete">
                        <input type="text" name="text" value="{lang("Search this site","admin")}"  onfocus="if(this.value=='{lang("Search this site","admin")}') this.value='';" onblur="if(this.value=='') this.value='{lang("Search this site","admin")}';"  id="inputString" autocomplete="off" onkeyup="lookup(event);" class="place_hold"/>
                        <input type="submit" id="search_submit"  value="{lang("Search","admin")}" class="icon"/>
                        <span id="suggestions" style="display: none; width: 0px; right: 0px;"></span>
                    </form>
                </div>

                <div class="phone">
                    <address>(095)<span><span class="d_n">&minus;</span> 555-55-55</span></address>
                    <span class="js showCallback">{lang("Request Call","admin")}</span>
                </div>

                <ul class="user_menu">
                    <!--    Show callback's form    -->
                    {if !count(get_currencies())}
                        <li class="p-l_0">
                            <form action="" method="post" name="currencyChangeForm" id="currencyChangeForm">
                                {lang("Currency","admin")}: <select class="changeCurrency" name="setCurrency" >
                                    {foreach get_currencies() as $currency}
                                        {if $currency->getId() != ShopCore::app()->SCurrencyHelper->default->getId()}
                                            <option {if ShopCore::app()->SCurrencyHelper->additional->getId() == $currency->getId()}selected{/if} value="{echo $currency->getId()}">{echo encode($currency->getName())}</option>
                                        {/if}
                                    {/foreach}
                                </select>
                                {form_csrf()}
                            </form>
                        </li>
                    {else:}
                        <li>&nbsp;</li>
                    {/if}
                    <!--    Show callback's form    -->

                    <!--    Wish list item's for Header    -->
                    <li id="wishListHolder" class="like blue{if ShopCore::app()->SWishList->totalItems()} is_avail{/if}">
                        {include_tpl('wish_list_data')}</li>
                    <!--    Wish list item's for Header    -->

                    <!--    Products in compare list for Header    -->
                    <li id="compareHolder" class="compare blue{if $CI->session->userdata('shopForCompare') && count($CI->session->userdata('shopForCompare'))} is_avail{/if}">
                        {include_tpl('compare_data')}</li>
                    <!--    Products in compare list for Header    -->
                </ul>
            </div><!-- header -->
            {//echo ShopCore::app()->SCategoryTree->ul()}
            {\Category\RenderMenu::create()->load('category_menu')}
            {$shop_content}
            <div class="hfooter"></div>
        </div>
        <div class="footer">
            <div class="center">

                <!-- brands widget -->
                {widget('brands')}
                <!-- *** -->

                {load_menu('footer_menu')}
                <ul class="contacts f_l">
                    <li>
                        <span class="b">{lang("Phone.","admin")}:</span>
                        <span>(095) <span class="d_n">&minus; </span>555-55-55</span>
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
                    <a href="http://imagecms.net" target="_blank" class="red">{lang("Create Online Store","admin")}</a>
                    <div class="s">{lang("SEO optimization","admin")}</div>
                </div>
            </div>
        </div><!-- footer -->
        <div class="h_bg_{whereami()}"></div>



        <script type="text/template" id="cartPopupTemplate">
         {literal}
            <div class="fancy fancy_cleaner frame_head_content">
                <div class="header_title">Ваша корзина</div>
                <div class="inside_padd">
                    <table class="table table_order">
                        <colgroup>
                            <col width="20px"/>
                            <col width="80px"/>
                            <col width="260px"/>
                            <col width="140px"/>
                            <col width="140px"/>
                        </colgroup>
                        <tbody>
                            <% _.each(cart.getAllItems(), function(item){ %>
                            <tr>
                                <td><span class="times d_i-b">&times;</span></td>
                                <td>
                                    <a href="#" class="d_i-b photo">
                                        <figure>
                                            <img src="images/temp/item_thumb.png"/>
                                        </figure>
                                    </a>
                                </td>
                                <td>
                                    <a href="#"><%- item.name %></a>
                                    <div class="price price_f-s_16">
                                        <span class="first_cash"><span class="f-w_b"><%- item.price %></span> грн.</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="frame_count number d_i-b v-a_m">
                                        <div class="frame_change_count">
                                            <button type="button" class="d_b btn_small btn" id="plus">
                                                <span class="icon-plus"></span>
                                            </button>
                                            <button type="button" class="d_b btn_small btn" id="minus">
                                                <span class="icon-minus"></span>
                                            </button>
                                        </div>
                                        <input type="text" value="<%- item.count %>" data-rel="plusminus" data-title="только цифры" data-min="1"/>
                                    </div>
                                    <span class="v-a_m"><%- item.count %> шт.</span>
                                </td>
                                <td>
                                    <span>Сумма: </span>
                                    <div class="price price_f-s_16 d_i-b">
                                        <span class="first_cash"><span class="f-w_b"><%- item.count*item.price %></span> грн.</span>
                                    </div>
                                </td>
                            </tr>
                            <% }); %>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <button type="button" class="d_l_b w-s_n-w">← Продолжить покупки</button>
                                </td>
                                <td colspan="2" class="t-a_r">
                                    <a href="#" class="btn btn_cart v-a_m m-r_30">Оформить заказ</a>
                                </td>
                                <td colspan="1">
                                    <div class="t-a_l d_i-b v-a_m">
                                        <span>Итого:</span>
                                        <div class="price price_f-s_24">
                                            <span class="first_cash"><span class="f-w_b"><%- cart.getTotalPrice() %></span> руб.</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
         {/literal}
        </script>

    </body>
</html>
