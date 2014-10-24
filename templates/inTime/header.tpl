<div class="content-header">
    <div class="container">
        <div class="left-content-header">
            <div class="frame-search-cleaner f-s_0">
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
                <div class="f_r f-s_0 header-right">
                    <div class="d_i-b v-a_m">
                        {include_shop_tpl('auth_data')}
                    </div>
                    <div class="d_i-b v-a_m">
                        {include_shop_tpl('wish_list_data')}
                    </div>
                    <div id="tinyBask" class="frame-cleaner v-a_m">
                        {include_shop_tpl('cart_data')}
                    </div>
                </div>
                <!--                Start. Show search form-->
                <div class="frame-search-form">
                    <div class="p_r">
                        <form name="search" method="get" action="{shop_url('search')}">
                            <span class="btn-search">
                                <button type="submit"><span class="icon_search"></span></button>
                            </span>
                            <div class="frame-search-input">
                                <input type="text" class="input-search" id="inputString" name="text" autocomplete="off" value="{if strpos($CI->uri->uri_string, 'search') !== false}{htmlspecialchars($_GET['text'])}{/if}"  placeholder="{lang('Введите название товара...', 'inTime')}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Введите название товара...'"/>
                                <div id="suggestions" class="drop drop-search"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--                End. Show search form-->
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