<div class="content-footer container">
    <!--Start. Load menu in footer-->
    <div class="box-1">
        <div class="inside-padd">
            <div class="main-title">{lang('О магазине','newLevel')}</div>
            <ul class="nav nav-vertical">
                {load_menu('top_menu')}
            </ul>
        </div>
    </div>
    <div class="box-2">
        <div class="inside-padd">
            <div class="main-title">{lang('Все для питомцев','newLevel')}</div>
            <ul class="footer-category-menu nav nav-vertical">
                {\Category\RenderMenu::create()->setConfig(array('cache'=>FALSE))->load('footer_category_menu')}
            </ul>
        </div>
    </div>
    <!--End. Load menu in footer-->
    <!--Start Brands-->
    <div class="box-3">
        <div class="inside-padd">
            <div class="main-title">{lang('популярные бренды','newLevel')}</div>
            {widget('brands_footer')}
        </div>
    </div>
    <!--End Brands-->

    <!--Start. User menu-->
    <div class="box-4">
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
                <li>
                    <button type="button" onclick="location = '{site_url('shop/compare')}'" title="{lang('Список сравнений','newLevel')}">{lang('Список сравнений','newLevel')}</button>
                </li>
                {/if}
                {/if}

               {/*}
                <li>
                    <button type="button" data-href="#ordercall" data-drop="#ordercall" data-source="{site_url('shop/callback')}" title="{lang('Обратный звонок','newLevel')}">{lang('Обратный звонок','newLevel')}</button>
                </li>
               { */}
               
            </ul>
        </div>
    </div>
    <!--End. User menu-->

    <!--Start. Info block-->
    <div class="box-5">
        <div class="inside-padd">
            <div class="main-title">{lang('Возникли вопросы?','newLevel')}</div>
            <ul>
                <li>
                    <span>38 (099) 409 95 99</span>
                </li>
                <li>
                    <span>38 (099) 409 95 99</span>
                </li>
                <li>
                    <span>{lang('Помощь ветеринара','newLevel')}</span>
                </li>
                <li>
                    <span>{lang('с 09:00 до 18:00','newLevel')}</span>
                </li>
                {/*}
                <li>
                    <a class="f-s_0" href="skype:{echo siteinfo('Skype')}">
                        <span class="text-el">{echo siteinfo('Skype')}</span>
                    </a>
                </li>
                <li>
                    <a class="f-s_0" href="mailto:{echo siteinfo('Email')}">
                       <span class="text-el">{echo siteinfo('Email')}</span> 
                   </a>
               </li>
               { */}

           </ul>
       </div>
   </div>
   <!--End. Info block-->
</div>

<div class="footer-footer">
    <div class="container t-a_j f-s_0">
        <div class="d_i-b v-a_m ">
            <span class="f-s_12 c_6">{echo siteinfo('siteinfo_companytype')}</span>
        </div>
        <div class="d_i-b v-a_m">
            <ul class="f-s_0">
                <li><a href="#"><span class="icon-vk"></span></a></li>
                <li><a href="#"><span class="icon-tv"></span></a></li>
                <li><a href="#"><span class="icon-fb"></span></a></li>
                <li><a href="#"><span class="icon-google"></span></a></li>
                <li><a href="#"><span class="icon-ok"></span></a></li>
            </ul>
        </div>

        <div class="develop-info d_i-b v-a_m">
            <span class="text-el f-s_12">{lang('Создание магазина','newLevel')}</span>
            <a href="http://siteimage.com.ua" target="_blanck" class="f-s_12"><span class="icon_siteimage"></span>SITEIMAGE</a>
        </div>
    </div>
</div>
