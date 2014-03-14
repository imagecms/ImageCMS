<div class="content-header">
    <div class="container">
        <div class="left-content-header t-a_j">
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
            <!--                Start. contacts block-->
            <div class="phones-header">
                <div class="frame-ico">
                    <span class="icon_phone_header"></span>
                </div>
                <div>
                    <div class="f-s_0">
                        <span class="phone">
                            <span class="phone-number">{echo siteinfo('siteinfo_mainphone')}</span>
                            <span class="phone-number">{echo siteinfo('siteinfo_addphone')}</span>
                        </span>
                    </div>
                    <div class="btn-order-call">
                        <button data-href="#ordercall" data-drop="#ordercall" data-tab="true" data-source="{site_url('shop/callback')}">
                            <span class="icon_order_call"></span>
                            <span class="text-el d_l">{lang('Заказать звонок','newLevel')}</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="frame-time-work">
                <div class="frame-ico">
                    <span class="icon_work"></span>
                </div>
                <div>
                    Работаем: <span class="text-el">Пн–Пт 09:00–20:00,<br/>
                        Сб 09:00–17:00, Вс выходной</span>
                </div>
            </div>
            <nav class="left-header">
                <ul class="nav nav-default-inline">
                    {load_menu('top_menu')}
                </ul>
            </nav>
            <!-- End. Contacts block-->
            <!-- Start. Include cart data template-->
            <div id="tinyBask" class="frame-cleaner">
                {include_shop_tpl('cart_data')}
            </div>
            <!-- End. Include cart data template-->
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