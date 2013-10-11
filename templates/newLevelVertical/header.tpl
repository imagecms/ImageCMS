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
                <img src="{$THEME}{$colorScheme}/images/logo.png" alt="logo.png"/>
            </span>
        {else:}
            <a href="{site_url('')}" class="logo">
                <img src="{$THEME}{$colorScheme}/images/logo.png" alt="logo.png"/>
            </a>
        {/if}
        <div class="left-content-header">
            <div class="header-left-content-header">
                <!--                Start. contacts block-->
                <div class="phones-header">
                    <span class="f-s_0">
                        <span class="icon_phone_header"></span>
                        <span class="phone">
                            <span class="phone-code">(097)</span>
                            <span class="phone-number">567-43-21</span>
                        </span>
                    </span>
                    <ul class="tabs">
                        <li class="btn-order-call">
                            <a href="#ordercall" data-drop="#ordercall" data-source="{site_url('shop/callback')}">
                                <span class="icon_order_call"></span>
                                <span class="text-el d_l">{lang('Заказать звонок','newLevel')}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <a href="skype:icon_skype" class="f-s_0">
                    <span class="icon_skype"></span>
                    <span class="text-el">imagecms</span>
                </a>
                <a href="mailto:partner@imagecms.net" class="f-s_0">
                    <span class="icon_mail"></span>
                    <span class="text-el">partner@imagecms.net</span>
                </a>
                <!--                End. Contacts block-->
            </div>
            <div class="frame-search-cleaner">
                <!--                Start. Include cart data template-->
                <div id="bask_block" class="frame-cleaner">
                    {include_shop_tpl('cart_data')}
                </div>
                <!--                    End. Include cart data template-->
                <!--                Start. Show search form-->
                <div class="frame-search-form">
                    <div class="p_r">
                        <form name="search" method="get" action="{shop_url('search')}">
                            <span class="btn-search">
                                <button type="submit"><span class="icon_search"></span><span class="text-el">{lang('Найти','newLevel')}</span></button>
                            </span>
                            <div class="frame-search-input">
                                <input type="text" class="input-search" id="inputString" name="text" autocomplete="off" value="{if strpos($CI->uri->uri_string, 'search') !== false}{htmlspecialchars($_GET['text'])}{/if}"  placeholder="{lang('Поиск по сайту', 'newLevel')}"/>
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
            $(document).live('scriptDefer', function(){
            var input = $('#inputString');
            input.setCursorPosition(input.val().length);
            });
        </script>
    {/literal}
{/if}