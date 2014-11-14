<div class="frame-benefits">
    {widget('benefits')}
</div>
<div class="content-footer">
    <div class="container">
        <!--Start. Load menu in footer-->
        <div class="box-1">
            <div class="inside-padd">
                <div>{echo siteinfo('siteinfo_companytype')}</div>
                <div class="text-el">{lang('Все права защищены','inTime')}</div>
                {if siteinfo('vkontakte-link') || siteinfo('facebook-link') || siteinfo('odnoklassniki-link') || siteinfo('gplus-link')}
                <ul class="footer-social">
                    {if siteinfo('vkontakte-link')}
                    <li><a href="{echo siteinfo('vkontakte-link')}" target="_blank" class="f-vk"></a></li>
                    {/if}
                    {if siteinfo('facebook-link')}
                    <li><a href="{echo siteinfo('facebook-link')}" target="_blank" class="f-fb"></a></li>
                    {/if}
                    {if siteinfo('odnoklassniki-link')}
                    <li><a href="{echo siteinfo('odnoklassniki-link')}" target="_blank" class="f-dn"></a></li>
                    {/if}
                    {if siteinfo('gplus-link')}
                    <li><a href="{echo siteinfo('gplus-link')}" target="_blank" class="f-gp"></a></li>
                    {/if}
                </ul>
                {/if}
            </div>
        </div>
        <div class="box-2">
            <div class="inside-padd">
                <div class="main-title">{lang('Каталог','inTime')}</div>
                <ul class="footer-category-menu nav nav-vertical">
                    {\Category\RenderMenu::create()->setConfig(array('cache'=>FALSE))->load('footer_category_menu')}
                </ul>
            </div>
        </div>
        <!--End. Load menu in footer-->

        <!--Start. User menu-->
        <div class="box-3">
            <div class="inside-padd">
                <div class="main-title">{lang('Информация','inTime')}</div>
                <ul class="nav nav-vertical">
                    {load_menu('top_menu')}
                </ul>
            </div>
        </div>
        <!--End. User menu-->

        <!--Start. Info block-->
        {if siteinfo('Email') || siteinfo('Skype') || siteinfo('siteinfo_address') || siteinfo('time_work')}
        <div class="box-4">
            <div class="inside-padd">
                <div class="main-title">{lang('Контакты','inTime')}</div>
                <ul>
                    {if siteinfo('Email')}
                    <li>
                        <a class="f-s_0" href="mailto:{echo siteinfo('Email')}">
                            <span class="icon_mail"></span>
                            <span class="text-el">{echo siteinfo('Email')}</span>
                        </a>
                    </li>
                    {/if}
                    {if siteinfo('Skype')}
                    <li>
                        <a class="f-s_0" href="skype:{echo siteinfo('Skype')}">
                            <span class="icon_skype"></span>
                            <span class="text-el">{echo siteinfo('Skype')}</span>
                        </a>
                    </li>
                    {/if}
                    {if siteinfo('siteinfo_address')}
                    <li class="f-s_0">
                        <span class="icon_address"></span>
                        <span>{echo siteinfo('siteinfo_address')}</span>
                    </li>
                    {/if}
                    {if siteinfo('time_work')}
                    <li class="f-s_0">
                        <span class="icon_time_work"></span>
                        <span>{echo siteinfo('time_work')}</span>
                    </li>
                    {/if}
                </ul>
            </div>
        </div>
        {/if}
        <!--End. Info block-->

        <div class="box-5">
            <div class="inside-padd">
                <div class="div engine">
                </div>  
            </div>
        </div>
    </div>
</div>

