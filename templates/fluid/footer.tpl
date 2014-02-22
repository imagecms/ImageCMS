<div class="content-footer">
    <div class="container">
        <!--Start. Load menu in footer-->
        <div class="box-1">
            <div class="inside-padd">
                <div class="main-title">{lang('Сайт','newLevel')}</div>
                <ul class="nav nav-vertical">
                    {load_menu('top_menu')}
                </ul>
            </div>
        </div>
        <div class="box-2">
            <div class="inside-padd">
                <div class="main-title">{lang('Продукция','newLevel')}</div>
                <ul class="footer-category-menu nav nav-vertical">
                    {\Category\RenderMenu::create()->setConfig(array('cache'=>FALSE))->load('footer_category_menu')}
                </ul>
            </div>
        </div>
        <!--End. Load menu in footer-->

        <!--Start. User menu-->
        <div class="box-3">
            <div class="frame-benefits">
                {widget('benefits')}
            </div>
        </div>
        <!--End. User menu-->

        <!--Start. Info block-->
        <div class="box-4">
            {widget('brands')}
        </div>
        <!--End. Info block-->
    </div>
</div>
<div class="footer-footer">
    <div class="container">
        <div class="inside-padd">
            <div class="main-title">{lang('Контакты','newLevel')}</div>
            <ul>
                <li>
                    <div class="c_9">{lang('Главный офис', 'newLevel')}:</div>
                    <div class="c_w">{echo siteinfo('siteinfo_address')}</div>
                </li>
                <li>
                    <div class="c_w f-s_0"><span class="f-s_16"><span class="f-w_b">{echo siteinfo('siteinfo_mainphone')}</span></span></div>
                </li>
                <li><a class="f-s_0" href="skype:{echo siteinfo('Skype')}"> <span class="icon_skype">&nbsp;</span> <span class="text-el">{echo siteinfo('Skype')}</span> </a></li>
                <li><a class="f-s_0" href="mailto:{echo siteinfo('Email')}"> <span class="icon_mail">&nbsp;</span> <span class="text-el">{echo siteinfo('Email')}</span> </a></li>
            </ul>
        </div>
        <div class="f_l">
            <div class="c_w">{echo siteinfo('siteinfo_companytype')}</div>
            <div class="c_9">{lang('Все права защищены','newLevel')}, {echo date('Y')}</div>
        </div>
        {if function_exists('mobile_site_address')}
            <div class="f_r">
                <a href="{mobile_site_address()}" class="f-s_0 c_w">
                    <span class="icon_phone_footer"></span>
                    <span class="text-el">{lang('Мобильная версия','newLevel')}</span>
                </a>
            </div>
        {/if}
    </div>
</div>

