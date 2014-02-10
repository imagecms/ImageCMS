<div class="frame-seotext-news">  
    <div class="frame-benefits">
        {widget('benefits')}
    </div>
    <div class="frame-seo-text">
        <div class="container">
            <div class="text seo-text">
                {widget('start_page_seo_text')}
            </div>
        </div>
    </div>
</div>
<div class="content-footer">
    <div class="container">
        <!--Start. Load menu in footer-->
        <div class="box-1">
            <div class="inside-padd">
                <div class="c_w">{echo siteinfo('siteinfo_companytype')}, {echo date('Y')}</div>
                <div class="text-el">{lang('Все права защищены','newLevel')}</div>
                {echo $CI->load->module('share')->_make_share_form()}
            </div>
        </div>
        <div class="box-2">
            <div class="inside-padd">
                <div class="main-title">{lang('Каталог','newLevel')}</div>
                <ul class="footer-category-menu nav nav-vertical">
                    {\Category\RenderMenu::create()->setConfig(array('cache'=>FALSE))->load('footer_category_menu')}
                </ul>
            </div>
        </div>
        <!--End. Load menu in footer-->

        <!--Start. User menu-->
        <div class="box-3">
            <div class="inside-padd">
                <div class="main-title">{lang('Информация','newLevel')}</div>
                <ul class="nav nav-vertical">
                    {load_menu('footer_menu')}
                </ul>
            </div>
        </div>
        <!--End. User menu-->

        <!--Start. Info block-->
        <div class="box-4">
            <div class="inside-padd">
                <div class="main-title">{lang('Контакты','newLevel')}</div>
                <ul>
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
                    <li class="f-s_0">
                        <span class="icon_address"></span>
                        <span class="c_w">{echo siteinfo('siteinfo_address')}</span>
                    </li>
                    <li class="f-s_0">
                        <span class="icon_time_work"></span>
                        <span class="c_w">{echo siteinfo('time_work')}</span>
                    </li>
                </ul>
            </div>
        </div>
        <!--End. Info block-->

        <div class="box-5">
            <div class="inside-padd">
                <div class="f-s_0">
                    <span class="icon_phone_footer"></span>
                    <span class="text-el">{echo siteinfo('siteinfo_mainphone')}</span>
                </div>
                <ul class="items items-payment-icons">
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
                </ul>
            </div>
        </div>
    </div>
</div>

