<footer {if $CI->core->core_data['data_type'] == 'main'}class="footer-main"{/if}>
    {if $CI->core->core_data['data_type'] == 'main'}
        <div class="content-footer">
            <div class="container">
                <!--Start. Load menu in footer-->
                <div class="box-1">
                    <div class="inside-padd">
                        <div class="frame-seo-text">
                            <div class="text seo-text">
                                {widget('seo_text_footer')}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-2">
                    <div class="inside-padd">
                        <div class="frame-benefits">
                            <div class="title-h1">{lang('Почему мы', 'newLevel')}</div>
                            {widget('benefits')}
                        </div>
                    </div>
                </div>
                <div class="box-3">
                    <div class="inside-padd">
                        <div class="title-h1">
                            <a href="{shop_url('brand')}" class="t-d_n f-s_0 s-all-d">
                                <span class="text-el">{lang('Бренды', 'newLevel')}</span>
                                <span class="icon_arrow"></span>
                            </a>
                        </div>
                        {widget('brands')}
                    </div>
                </div>
            </div>
        </div>
    {/if}
    <div class="footer-footer">
        <div class="container">
            <div class="inside-padd t-a_j">
                <div>
                    <div class="c_b">{echo siteinfo('siteinfo_companytype')} {echo date('Y')}</div>
                    <div class="c_9">{lang('Все права защищены','newLevel')}</div>
                </div>
                <div>
                    {echo $CI->load->module('share')->_make_share_form()}
                </div>
                <div>
                    <ul class="nav nav-default-inline">
                        {load_menu('top_menu')}
                    </ul>
                </div>
                <span class="phone f-w_b">
                    <span class="phone-number d_b">{echo siteinfo('siteinfo_mainphone')}</span>
                    <span class="phone-number d_b">{echo siteinfo('siteinfo_addphone')}</span>
                </span>
                <div>
                    <ul class="items-contact">
                        <li>
                            <span class="f-s_0">
                                <span class="icon_icq"></span>
                                <span class="text-el">{echo siteinfo('icq')}</span>
                            </span>
                        </li>
                        <li>
                            <a class="f-s_0" href="mailto:{echo siteinfo('Email')}">
                                <span class="icon_mail"></span>
                                <span class="text-el">{echo siteinfo('Email')}</span>
                            </a>
                        </li>
                        <li>
                            <a class="f-s_0" href="skype:{echo siteinfo('Skype')}">
                                <span class="icon_skype"></span>
                                <span class="text-el">{echo siteinfo('Skype')}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <ul class="items items-payment">
                        <li>
                            <span class="photo-block">
                                <span class="helper"></span>
                                <span class="icon-p-1"></span>
                            </span>
                        </li>
                        <li>
                            <span class="photo-block">
                                <span class="helper"></span>
                                <span class="icon-p-2"></span>
                            </span>
                        </li>
                        <li>
                            <span class="photo-block">
                                <span class="helper"></span>
                                <span class="icon-p-3"></span>
                            </span>
                        </li>
                        <li>
                            <span class="photo-block">
                                <span class="helper"></span>
                                <span class="icon-p-4"></span>
                            </span>
                        </li>
                        <li>
                            <span class="photo-block">
                                <span class="helper"></span>
                                <span class="icon-p-5"></span>
                            </span>
                        </li>
                    </ul>
                </div>
                {if function_exists('mobile_site_address')}
                    <div>
                        <a href="{mobile_site_address()}" class="f-s_0 c_w">
                            <span class="icon_phone_footer"></span>
                            <span class="text-el">{lang('Мобильная версия','newLevel')}</span>
                        </a>
                    </div>
                {/if}
            </div>
        </div>
    </div>
</footer>