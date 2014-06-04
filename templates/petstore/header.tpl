<!--Start. Top menu and authentication data block-->
<div class="content-header">
    <div class="container">
        <div class="left-header f_l mq-max mq-w-480 mq-block">
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
            <!--     end   Logo-->
        </div>
        <div class="right-header f_r">


            <div class="menu-header clearfix">
                <ul class="nav mq-max mq-w-768 mq-block" data-mq-max="768" data-mq-min="0" data-mq-target="#topMenuInShop">
                    {load_menu('top_menu')}  
                </ul>
                <ul class="nav mq-w-320 mq-w-480 mq-block menu2">
                    <li>
                        <button data-drop="#topMenuInShop" data-place="noinherit" data-overlay-opacity="0">
                            <span class="text-el">{lang('Меню', 'newLevel')}</span>
                            <span class="icon_arr-b-down"></span>
                        </button>
                    </li>
                </ul>
                <ul class="frame-drop-menu drop" id="topMenuInShop">

                </ul>
                <div class="f_r f-s_0">
                    {include_shop_tpl('wish_list_data')}
                    {include_shop_tpl('compare_data')}
                    {include_shop_tpl('auth_data')}</div>
                </div>
                <div class="left-content-header clearfix">


             <!--        Logo-->
            {if  $CI->uri->uri_string() == ''}
            <span class="logo mq-w-320 mq-block">
                <img src="{echo siteinfo('siteinfo_logo_url')}" alt="logo"/>
            </span>
            {else:}
            <a href="{site_url('')}" class="logo mq-w-320 mq-block">
                <img src="{echo siteinfo('siteinfo_logo_url')}" alt="logo"/>
            </a>
            {/if}
            <!--     end   Logo-->

                    <div class="frame-contact-bask f_r">
                        <!--                Start. contacts block-->
                        <div class="phones-header">
                            <div class="f-s_0 d_i-b">
                                <span class="icon_phone_header"></span>
                                <span class="phone">
                                    <span class="phone-number">{echo siteinfo('siteinfo_mainphone')}</span>
                                </span>
                            </div>
                            {/*}
                            <div class="btn-order-call">
                                <button data-href="#ordercall" data-drop="#ordercall" data-source="{site_url('shop/callback')}">
                                    <span class="icon_order_call"></span>
                                    <span class="text-el d_l">{lang('Заказать звонок','newLevel')}</span>
                                </button>
                            </div>
                            { */}
                        </div>


                        {/*}
                        <a href="skype:{echo siteinfo('Skype')}" class="f-s_0">
                            <span class="icon_skype"></span>
                            <span class="text-el">{echo siteinfo('Skype')}</span>
                        </a>
                        <a href="mailto:{echo siteinfo('Email')}" class="f-s_0">
                            <span class="icon_mail"></span>
                            <span class="text-el">{echo siteinfo('Email')}</span>
                        </a>

                        { */}
                        <!--               End. Contacts block--> 

                        <!--                Start. Include cart data template-->
                        <div id="tinyBask" class="frame-cleaner">
                            {include_shop_tpl('cart_data')}
                        </div>
                        <!--                    End. Include cart data template-->
                    </div>

                    <!--                Start. Show search form-->
                    <div class="frame-search-form mq-max mq-w-768 mq-block" data-mq-max="768" data-mq-min="0" data-mq-target="#topSearchShop" data-mq-update-content>
                        <div class="p_r">
                            <form name="search" method="get" action="{shop_url('search')}">
                                <span class="btn-search mq-max mq-w-768 mq-block">
                                    <button type="submit" class=""><span class="icon_search"></span></button>
                                </span>
                                 <div class="frame-search-input  mq-max mq-w-768 mq-block">
                                    <input type="text" class="input-search" id="inputString" name="text" autocomplete="off" value="{if strpos($CI->uri->uri_string, 'search') !== false}{htmlspecialchars($_GET['text'])}{/if}"  placeholder="{lang('Поиск по сайту', 'newLevel')}"/>
                                    <div id="suggestions" class="drop drop-search"></div>
                                </div>



                               <span class="btn-search mq-w-320 mq-w-480 mq-block">
                                    <button type="submit" data-drop=".drop-input-search" data-place="noinherit" data-overlay-opacity="0"><span class="text-el">{lang('поиск','newLevel')}</span><span class="icon_search2 icon_search"></span></button>
                                </span>

                                    <div class="frame-search-input mq-w-320 mq-w-480 mq-block">  
                                        <div class="wrap2-input-search drop-input-search drop"><div class="wrap-input-search"><input type="text" class="input-search " id="inputString" name="text" autocomplete="off" value="{if strpos($CI->uri->uri_string, 'search') !== false}{htmlspecialchars($_GET['text'])}{/if}"  placeholder="{lang('Поиск', 'newLevel')}"/></div></div>
                                        <div id="suggestions" class="drop drop-search">           
                                        </div>
                                    </div>



                            </form>
                        </div>
                    </div>


                    <!--             End. Show search form-->


                </div>

            </div>
        </div>

        <!--End. Top menu and authentication data block-->



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