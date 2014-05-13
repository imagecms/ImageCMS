<div class="content-header">
    <div class="container">
        <!--        Logo-->
        {if  $CI->uri->uri_string() == ''}
            <span class="logo">
                <img src="{echo siteinfo('siteinfo_logo_url')}" alt="logo"/>
            </span>
        {else:}
            <a href="{site_url('')}" class="logo">
                <img src="{echo siteinfo('siteinfo_logo_url')}" alt="logo"/>
            </a>
        {/if}
        <div class="left-content-header">
            <div class="header-left-content-header t-a_j">
                <!--                Start. contacts block-->
                <div class="phones-header">
                    <div class="f-s_0 d_i-b v-a_b">
                        <span class="icon_phone_header"></span>
                        <span class="phone f-s_0">
                            <span class="phone-number">{echo siteinfo('siteinfo_mainphone')}</span>
                            <span class="phone-number">{echo siteinfo('addPhone')}</span>
                        </span>
                    </div>
                    <div class="btn-order-call v-a_b">
                        <button data-href="#ordercall" data-drop="#ordercall" data-tab="true" data-source="{site_url('shop/callback')}">
                            <span class="icon_order_call"></span>
                            <span class="text-el ref-2">{lang('Заказать звонок','boxGreen')}</span>
                        </button>
                    </div>
                </div>
                <!--End. Contacts block-->
                <div class="d_i-b f-s_0 f0I">
                    <nav class="d_i-b v-a_m">
                        <ul class="nav nav-top-menu">
                            {load_menu('top_menu')}
                        </ul>
                    </nav>
                    <div class="d_i-b v-a_m">
                        {include_shop_tpl('auth_data')}
                    </div>
                </div>
            </div>
            <div class="frame-search-cleaner">
                <!--                Start. Include cart data template-->
                <div id="tinyBask" class="frame-cleaner">
                    {include_shop_tpl('cart_data')}
                </div>
                <!--                    End. Include cart data template-->
                <!--                Start. Show search form-->
                <div class="frame-search-form">
                    <div class="p_r">
                        <form name="search" method="get" action="{shop_url('search')}">
                            <span class="btn-search">
                                <button type="submit"><span class="text-el">{lang('Поиск','boxGreen')}</span></button>
                            </span>
                            <div class="frame-search-input">
                                <span class="icon_search"></span>
                                <input type="text" class="input-search" id="inputString" name="text" autocomplete="off" value="{if strpos($CI->uri->uri_string, 'search') !== false}{htmlspecialchars($_GET['text'])}{/if}"  placeholder="{lang('Я ищу', 'boxGreen')}"/>
                                <div id="suggestions" class="drop drop-search"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--                End. Show search form-->
            </div>
        </div>
    </div>
</div>
{if strpos($CI->uri->uri_string, 'search') !== false}
    {literal}
        <script>
            $(document).on('scriptDefer', function() {
            var input = $('#inputString');
            input.setCursorPosition(input.val().length);
            });
        </script>
    {/literal}
{/if}