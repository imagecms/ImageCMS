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
                <div class="phones-header d_i-b v-a_b">
                    <div class="f-s_0 d_i-b">
                        <span class="icon_phone_header"></span>
                        <span class="phone f-s_0">
                            <span class="phone-number">{echo siteinfo('siteinfo_mainphone')}</span>
                            <span class="phone-number">{echo siteinfo('addphone')}</span>
                        </span>
                    </div>
                    <div class="btn-order-call">
                        <button data-href="#ordercall" data-drop="#ordercall" data-source="{site_url('shop/callback')}">
                            <span class="icon_order_call"></span>
                            <span class="text-el d_l">{lang('Заказать звонок','greyVision')}</span>
                        </button>
                    </div>
                </div>
                <div class="contacts-header d_i-b v-a_b t-a_j">
                    <a href="skype:{echo siteinfo('Skype')}" class="f-s_0 btn-skype">
                        <span class="icon_skype"></span>
                        <span class="text-el">{echo siteinfo('Skype')}</span>
                    </a>
                    <a href="mailto:{echo siteinfo('Email')}" class="f-s_0 btn-mail">
                        <span class="icon_mail"></span>
                        <span class="text-el">{echo siteinfo('Email')}</span>
                    </a>
                    <span class="f-s_0 btn-icq">
                        <span class="icon_icq"></span>
                        <span class="text-el">{echo siteinfo('icq')}</span>
                    </span>
                </div>
                <!--                End. Contacts block-->
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
                                <button type="submit"><span class="icon_search"></span><span class="text-el">{lang('Найти','greyVision')}</span></button>
                            </span>
                            <div class="frame-search-input">
                                <input type="text" class="input-search" id="inputString" name="text" autocomplete="off" value="{if strpos($CI->uri->uri_string, 'search') !== false}{htmlspecialchars($_GET['text'])}{/if}"  placeholder="{lang('Поиск по сайту', 'greyVision')}"/>
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