<div class="content-footer">
    <div class="container">
        <div class="box-1">
            <div class="inside-padd">
                <div class="c_b f-w_b">© «YorStore»  {echo date('Y')}</div>
                <div class="s-t">{lang('Все права защищены', 'lightRed')}</div>
            </div>
            <div class="social-foot social-NS">
                {echo $CI->load->module('share')->_make_share_form()}
            </div>
        </div>
        <div class="box-2">
            <div class="inside-padd">
                <div class="main-title">{lang('Наши контакты','lightRed')}</div>
                <ul class="items-contacts">
                    <li>
                        <span class="phone">
                            <span class="phone-number">{echo siteinfo('siteinfo_mainphone')}</span>
                        </span>
                    </li>
                    <li><span class="f-s_0"><span class="icon_icq"></span> <span class="text-el">{echo siteinfo('icq')}</span></span></li>
                    <li><a class="f-s_0" href="mailto:{echo siteinfo('Email')}"> <span class="icon_mail"></span> <span class="text-el">{echo siteinfo('Email')}</span> </a></li>
                    <li><a class="f-s_0" href="skype:{echo siteinfo('Skype')}"> <span class="icon_skype"></span> <span class="text-el">{echo siteinfo('Skype')}</span> </a></li>
                </ul>
            </div>

        </div>
        <div class="box-3">
            <div class="inside-padd">
                <div class="main-title">{lang('Сайт','lightRed')}</div>
                <ul class="nav nav-vertical">
                    {load_menu('top_menu')}
                </ul>
            </div>
        </div>
        <div class="box-4">
            <div class="inside-padd">
                <div class="main-title">{lang('Продукция','lightRed')}</div>
                <ul class="footer-category-menu nav nav-vertical">
                    {\Category\RenderMenu::create()->setConfig(array('cache'=>FALSE))->load('footer_category_menu')}
                </ul>
            </div>
        </div>
        <div class="box-5">
            <div class="inside-padd">
                <div class="main-title">{lang('Пользователь','lightRed')}</div>
                <ul class="nav nav-vertical">
                    {if $is_logged_in}
                        <li>
                            <button type="button" onclick="location = '{site_url('auth/logout')}'" title="{lang('Выход','lightRed')}">{lang('Выход','lightRed')}</button>
                        </li>
                        <li>
                            <button type="button" onclick="location = '{site_url('shop/profile')}'" title="{lang('Личный кабинет','lightRed')}">{lang('Личный кабинет','lightRed')}</button>
                        </li>
                        <li>
                            <button type="button" onclick="location = '{site_url('wishlist')}'" title="{lang('Список желаний','lightRed')}">{lang('Список желаний','lightRed')}</button>
                        </li>
                    {else:}
                        <li>
                            <button type="button" data-trigger="#loginButton" title="{lang('Вход','lightRed')}">{lang('Вход','lightRed')}</button>
                        </li>
                        <li>
                            <button onclick="location = '{site_url('auth/register')}'" title="{lang('Регистрация','lightRed')}">{lang('Регистрация','lightRed')}</button>
                        </li>
                    {/if}
                    {if $compare = $CI->session->userdata('shopForCompare')}
                        {$count = count($compare);}
                        {if $count > 0}
                            <li><button type="button" onclick="location = '{site_url('shop/compare')}'" title="{lang('Список сравнений','lightRed')}">{lang('Список сравнений','lightRed')}</button></li>
                        {/if}
                    {/if}
                    <li><button type="button" data-trigger="[data-drop='#ordercall']" title="{lang('Обратный звонок','lightRed')}">{lang('Обратный звонок','lightRed')}</button></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="footer-footer">
    <div class="container">
        <ul class="items items-payment">
            <li>
                <span class="helper"></span>
                <span class="icon_pb"></span>
            </li>
            <li>
                <span class="helper"></span>
                <span class="icon_visa"></span>
            </li>
            <li>
                <span class="helper"></span>
                <span class="icon_master"></span>
            </li>
            <li>
                <span class="helper"></span>
                <span class="icon_sber"></span>
            </li>
            <li>
                <span class="helper"></span>
                <span class="icon_yand"></span>
            </li>
        </ul>
    </div>
</div>

