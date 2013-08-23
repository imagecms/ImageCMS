<div class="content-footer">
    <div class="container">
        <!--Start. Load menu in footer-->
        <div class="box-1">
            <div class="inside-padd">
                <div class="main-title">Сайт</div>
                <ul>
                    {load_menu('top_menu')}
                </ul>
            </div>
        </div>
        <div class="box-2">
            <div class="inside-padd">
                <div class="main-title">Продукция</div>
                {\Category\RenderMenu::create()->setConfig(array('cache'=>TRUE))->load('footer_category_menu')}
            </div>
        </div>
        <!--End. Load menu in footer-->

        <!--Start. User menu-->
        <div class="box-3">
            <div class="inside-padd">
                <div class="main-title">Пользователь</div>
                <ul>
                    {if $is_logged_in}
                        <li><button type="button" onclick="location = '{site_url('auth/logout')}'" title="Выйти с магазина">Выход</button></li>
                        <li><button type="button" onclick="location = '{site_url('shop/profile')}'" title="Перейти в личний кабинет">Личный кабинет</button></li>
                        <li><button type="button" onclick="location = '{site_url('shop/wish_list')}'" title="Перейти в список желаний">Список желаний</button></li>
                        {else:}
                        <li><button type="button" data-trigger="#loginButton" title="Ввойти в магазин">Вход</button></li>
                        <li><button onclick="location = '{site_url('auth/register')}'" title="Перейти на страницу регистрации">Регистрация</button></li>
                        {/if}
                        {if $compare = $CI->session->userdata('shopForCompare')}
                            {$count = count($compare);}
                            {if $count > 0}
                            <li><button type="button" onclick="location = '{site_url('shop/compare')}'" title="Перейти в список сравнений">Список сравнений</button></li>
                            {/if}
                        {/if}
                    <li><button type="button" data-trigger="[data-drop='.drop-order-call']" title="Заказать обратный звонок">Обратный звонок</button></li>
                </ul>
            </div>
        </div>
        <!--End. User menu-->

        <!--Start. Info block-->
        <div class="box-4">
            <div class="inside-padd">
                <div class="main-title">Контакты</div>
                <ul>
                    <li><div class="c_9">Главный офис:</div></li>
                    <li><div class="c_w">Киев, ул. Шевченка 22, офис: 39</div></li>
                    <li><div class="c_w f-s_0">
                            <span class="icon_phone_header"></span>
                            <span class="f-s_16"><span>(097)</span> <span class="f-w_b">567-43-21</span></span>
                        </div>
                    </li>
                    <li>
                        <a href="skype:icon_skype" class="f-s_0">
                            <span class="icon_skype"></span>
                            <span class="text-el">imagecms</span>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:partner@imagecms.net" class="f-s_0">
                            <span class="icon_mail"></span>
                            <span class="text-el">partner@imagecms.net</span>
                        </a>
                    </li>
                     
                </ul>
            </div>
        </div>
        <!--End. Info block-->
    </div>
</div>
<div class="footer-footer">
    <div class="container">
        <div class="f_l">
            <div class="c_w">© Интернет-магазин «Imageshop»,  2013</div>
            <div class="c_9">Все права защищены</div>
        </div>
        <div class="f_r">
            <a class="f-s_0 c_w">
                <span class="icon_phone_footer"></span>
                <span class="text-el">Мобильная версия</span>            
            </a>
        </div>
    </div>
</div>
                    