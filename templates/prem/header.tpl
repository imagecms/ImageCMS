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
    <!--Start. Top menu and authentication data block-->
    <ul class="nav menu-header">
        {load_menu('top_menu')}
    </ul>
    <div class="right-header f-s_0">
        <span class="helper"></span>
        <div class="d_i-b v-a_m f-s_0">
            <div class="d_i-b v-a_m f-s_0">
                {include_shop_tpl('auth_data')}
                <div class="btn-create-shop">
                    <a href="#">
                        <span class="text-el">
                            {lang('Создать магазин', 'newLevel')}
                        </span>
                    </a>
                </div>
            </div>
            <div class="divider d_i-b v-a_m"></div>
            <!--End. Top menu and authentication data block-->
            <span class="phone-header d_i-b v-a_m">
                <span class="phone-number">{echo siteinfo('siteinfo_mainphone')}</span>
            </span>
        </div>
    </div>
</div>