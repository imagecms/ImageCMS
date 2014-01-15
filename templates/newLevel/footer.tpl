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
            <div class="inside-padd">
                <div class="main-title">{lang('Пользователь','newLevel')}</div>
                <ul class="nav nav-vertical">
                    {if $is_logged_in}
                        <li>
                            <button type="button" onclick="location = '{site_url('auth/logout')}'" title="{lang('Выход','newLevel')}">{lang('Выход','newLevel')}</button>
                        </li>
                        <li>
                            <button type="button" onclick="location = '{site_url('shop/profile')}'" title="{lang('Личный кабинет','newLevel')}">{lang('Личный кабинет','newLevel')}</button>
                        </li>
                        <li>
                            <button type="button" onclick="location = '{site_url('wishlist')}'" title="{lang('Список желаний','newLevel')}">{lang('Список желаний','newLevel')}</button>
                        </li>
                    {else:}
                        <li>
                            <button type="button" data-trigger="#loginButton" title="{lang('Вход','newLevel')}">{lang('Вход','newLevel')}</button>
                        </li>
                        <li>
                            <button onclick="location = '{site_url('auth/register')}'" title="{lang('Регистрация','newLevel')}">{lang('Регистрация','newLevel')}</button>
                        </li>
                    {/if}
                    {if $compare = $CI->session->userdata('shopForCompare')}
                        {$count = count($compare);}
                        {if $count > 0}
                            <li><button type="button" onclick="location = '{site_url('shop/compare')}'" title="{lang('Список сравнений','newLevel')}">{lang('Список сравнений','newLevel')}</button></li>
                        {/if}
                    {/if}
                    <li><button type="button" data-trigger="[data-drop='#ordercall']" title="{lang('Обратный звонок','newLevel')}">{lang('Обратный звонок','newLevel')}</button></li>
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
        </div>
        <!--End. Info block-->
    </div>
</div>
<div class="footer-footer">
    <div class="container">
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

