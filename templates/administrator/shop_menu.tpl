{if !$ADMIN_URL}
    {$ADMIN_URL = '/admin/components/run/shop/'}
{/if}
<nav class="navbar navbar-inverse">
    <ul class="nav">
        <li class="homeAnchor" ><a href="{$ADMIN_URL}dashboard" class="pjax "><i class="icon-home"></i><span>Главная</span></a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart"></i>Заказы<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li class="nav-header">{lang('a_orders')}</li>
                <li><a href="{$ADMIN_URL}orders/index" class="pjax">Все заказы</a></li>
                <li><a href="{$ADMIN_URL}orderstatuses" class="pjax">Статусы заказов</a></li>
                <li class="nav-header">{lang('a_callbacks')}</li>
                <li><a href="{$ADMIN_URL}callbacks" class="pjax">Колбеки</a></li>
                <li><a href="{$ADMIN_URL}callbacks/statuses" class="pjax">Статусы колбеков</a></li>
                <li><a href="{$ADMIN_URL}callbacks/themes" class="pjax">Темы колбеков</a></li>
                <li class="nav-header">{lang('a_notifications')}</li>
                <li><a href="{$ADMIN_URL}notifications" class="pjax">Сообщения о появлении</a></li>
                <li><a href="{$ADMIN_URL}notificationstatuses/index" class="pjax">Статусы о появлении</a></li>
                <li class="nav-header">Прочее</li>                                  
                <li><a class="pjax" href="/admin/components/cp/comments">Комментарии</a></li>

            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt"></i>Каталог товаров<b class="caret"></b></a>
            <ul class="dropdown-menu">

                <li><a href="/admin/components/run/shop/categories/index" class="pjax">Категории</a>    </li>
                <li><a href="/admin/components/run/shop/search/index" class="pjax">Товары</a></li>
                <li><a href="/admin/components/run/shop/properties/index" class="pjax">Свойства товаров</a></li>
                <li><a href="/admin/components/run/shop/kits/index" class="pjax">Наборы товаров</a></li>
                <li><a href="/admin/components/run/shop/search/index?WithoutImages=1" class="pjax">Товары без картинок</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i>Пользователи<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{$ADMIN_URL}users/index" class="pjax">Список пользователей</a></li>
                <li><a href="/admin/rbac/roleList" class="pjax">Управление правами доступа</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-briefcase"></i>Компоненты<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/admin/components/run/shop/brands/index" class="pjax">Бренды</a></li>
                <li><a href="/admin/components/run/shop/warehouses/index" class="pjax">Склады</a></li>
                <li><a href="/admin/components/run/shop/banners/index" class="pjax">Баннеры</a></li>
                <li><a href="/admin/components/run/shop/discounts/index" class="pjax">{lang('a_reg_discount_sh')}</a></li>
                <li><a href="/admin/components/run/shop/comulativ/index" class="pjax">Накопительние скидки</a></li>
                <li><a href="/admin/components/run/shop/gifts" class="pjax">Подарочные сертификаты</a></li>
                <li><a href="/admin/components/run/shop/customfields" class="pjax">Дополнительные поля</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i>Настройки<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/admin/components/run/shop/settings" class="pjax">Глобальные настройки</a></li>
                <li><a href="/admin/components/run/shop/currencies" class="pjax">Валюты</a></li>
                <li><a href="/admin/components/run/shop/deliverymethods/index" class="pjax">Способы доставки</a></li>
                <li><a href="/admin/components/run/shop/paymentmethods/index" class="pjax">Способы оплаты</a></li>
                <li><a href="/admin/components/run/shop/system/import">Автоматизация</a></li>
            </ul>
        </li>
    </ul>
        <a class="btn btn-small pull-right btn-info" onclick=" loadBaseInterface();"  href="#"><span class="f-s_14">←</span> Администрировать сайт </a>
</nav>
