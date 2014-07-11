<div class="inside-padd">
    <ul class="items items-info-saas">
        <li>
            <table class="data-shop">
                <tbody>
                    <tr>
                        <th>
                            Сайт
                        </th>
                        <td>
                            <a href="#">www.mystore.imagego.com</a> 
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Админчасть
                        </th>
                        <td>
                            <a href="#">www.mystore.imagego.com/admin</a>
                            <div class="help-block">Логин и пароль те, что в личный кабинет</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Тариф
                        </th>
                        <td>
                            Standart
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Стоимость
                        </th>
                        <td colspan="2">
                            20$ / мес
                        </td>
                    </tr>
                </tbody>
            </table>
        </li>
        <li>
            <table class="data-shop">
                <tbody>
                    <tr>
                        <th>
                            Наполнение
                        </th>
                        <td>
                            <span class="important-text">45 товаров</span>  / 1000 товаров
                            <div class="out-range">
                                <div class="range" style="width: 20%;"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Вместимоть
                        </th>
                        <td>
                            <span class="important-text">0.3 Gb</span> / 4 gb
                            <div class="out-range">
                                <div class="range" style="width: 20%;"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Оплачен до
                        </th>
                        <td>
                            <span class="help-block">Бесплатная пробная версия до</span>
                            <span class="important-text">12 января 2015</span>
                        </td>
                    </tr>
                <tbody>
            </table>
        </li>
    </ul>
</div>
{if $tariffs}
    <div class="panel-form border-top">
        <div class="inside-padd">
            <ul class="items items-period-payment items-tarif-payment">
                {foreach $tariffs as $tariff}

                    <li class="panel-default {if $user_tariff['tariff_id'] == $tariff['tariff_id']}active{/if}">

                        <div class="title-default-out">
                            <div class="title">
                                {echo $tariff['name']}
                            </div>
                        </div>
                        <div class="content-panel">
                            <ul class="description">
                                <li>
                                    <span class="count">{echo $tariff['prod_limit']}</span>
                                    <span class="count-of">товаров</span>
                                </li>
                                <li>
                                    <span class="count">{echo $tariff['disk_limit']}</span>
                                    <span class="count-of">Gb</span>
                                </li>
                                <li>
                                    <span class="full-descr">Основные возможности <br>
                                        {$tariff_modules = json_decode($tariff['module']);}
                                        {foreach $tariff_modules as $module_id}
                                            {echo $modules[$module_id]}<br>
                                        {/foreach}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-panel">
                            <div class="inside-padd">
                                <div class="d_i-b t-a_l">
                                    <div class="frame-price">
                                        <span class="price">{echo $tariff['price']}</span>
                                        <span class="curr">$ / мес</span>
                                    </div>
                                    {if $user_tariff['tariff_id'] == $tariff['tariff_id']} 
                                        <div class="patch patch-active">
                                            <span class="icon-ok"></span>
                                            <span class="text-el">Текущий</span>
                                        </div>
                                    {else:}
                                        <a href="#" class="btn btn-primary">
                                            <span class="text-el">Перейти</span>
                                        </a>
                                    {/if}
                                </div>
                                <div class="s-t">
                                    {echo $tariff['description']}
                                </div>
                            </div>
                        </div>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
{else:}
    {lang('No tariffs', 'saas')}
{/if}