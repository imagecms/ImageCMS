<!--Start. Top menu and authentication data block-->
<div class="menu-header">
    <div class="container">
        <nav class="left-header f_l">
            <ul class="nav">
                {load_menu('top_menu')}
            </ul>
        </nav>
        <div class="right-header f_r">
            {include_shop_tpl('auth_data')}
        </div>
    </div>
</div>
<!--End. Top menu and authentication data block-->
<div class="content-header">
    <div class="container">
        <!--        Logo-->
        <a href="{site_url('')}" class="logo"><img src="{$THEME}images/logo.png" alt="logo.png"/></a>
        <div class="left-content-header">
            <div class="header-left-content-header">
                <!--                Start. contacts block-->
                <span class="phones-header">
                    <span class="f-s_0">
                        <span class="icon_header_phone"></span>
                        <span class="phone">
                            <span class="phone-code">(097)</span>
                            <span class="phone-number">567-43-21</span>
                        </span>
                    </span>
                    <span class="order-call-btn">
                        <button type="button" data-event="call" data-drop=".drop-order-call" data-source="shop/callback">
                            <span class="icon_order_call"></span>
                            <span class="text-el d_l">Заказать звонок</span>
                        </button>
                    </span>
                </span>
                <a href="skype:icon_skype" class="f-s_0">
                    <span class="icon_skype"></span>
                    <span class="text-el">imagecms</span>
                </a>
                <a href="mailto:partner@imagecms.net" class="f-s_0">
                    <span class="icon_mail"></span>
                    <span class="text-el">partner@imagecms.net</span>
                </a>
                <!--                End. Contacts block-->
                <!--                Start. Show wish list and compare data-->
                <div class="f_r">
                    {include_shop_tpl('wish_list_data')}
                    {include_shop_tpl('compare_data')}
                </div>
                <!--                End. Show wish list and compare data-->
            </div>
            <div class="frame-search-cleaner">
                <!--                Start. Include cart data template-->
                <div id="bask_block" class="frame-cleaner tiny-bask">
                    {include_shop_tpl('cart_data')}
                </div>
                <!--                    End. Include cart data template-->
                <!--                Start. Show search form-->
                <div class="frame-search-form">
                    <div class="p_r">
                        <form name="search" method="get" action="{shop_url('search')}"  id="autocomlete">
                            <span class="search-btn">
                                <button type="submit"><span class="icon_search"></span><span class="text-el">{lang('search_find')}</span></button>
                            </span>
                            <div class="frame-search-input">
                                <input type="text" class="input-search" id="inputString" name="text" autocomplete="off" value="" placeholder="{lang('s_se_thi_sit')}" />
                                <div id="suggestions" class="drop-search drop"></div>
                            </div>
                        </form>
                    </div>        
                </div>
                <!--                End. Show search form-->
            </div>
        </div>
    </div>
</div>