<div class="inside-padd">
    <ul class="items items-info-saas">
        <li>
            <table class="data-shop">
                <tbody>
                    <tr>
                        <th>
                            {lang('Сайт','prem')}
                        </th>
                        <td>
                            <a href="http:\\{echo $user->saasUser->domain}">{echo $user->saasUser->domain}</a> 
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {lang('Админчасть','prem')}
                        </th>
                        <td>
                            <a href="http:\\{echo $user->saasUser->domain}/admin">{echo $user->saasUser->domain}/admin</a> 
                            <div class="help-block">{lang('Логин и пароль те, что в личный кабинет','prem')}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {lang('Тариф','prem')}
                        </th>
                        <td>
                            {$user_tariff.tname}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {lang('Стоимость','prem')}
                        </th>
                        <td colspan="2">
                            {$user_tariff.price}$ / {lang('мес','prem')}
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
                            {lang('Наполнение','prem')}
                        </th>
                        <td>
                            <span class="important-text">
                                {$stat[$user_tariff['server_username']]['productsCount']} {lang('товаров','prem')}
                            </span>  / {$user_tariff.prod_limit} {lang('товаров','prem')}
                            <div class="out-range">
                                <div class="range" 
                                     style="width: {echo round(($stat[$user_tariff['server_username']]['productsCount']*100)/$user_tariff.prod_limit)}%;">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {lang('Вместимоть','prem')}
                        </th>
                        <td>
                            <span class="important-text">{echo $stat[$user_tariff['server_username']]['quotaUsed']/1000} Gb</span> / {$user_tariff.disk_limit} Gb
                            <div class="out-range">
                                <div class="range" style="width: {echo round((($stat[$user_tariff['server_username']]['quotaUsed']/1000)*100)/$user_tariff.disk_limit)}%;"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {lang('Оплачен до','prem')}
                        </th>
                        <td>
                            <!--span class="help-block">Бесплатная пробная версия до</span-->
                            <span class="important-text">{data_translate(time() + ((int)($user_tariff['balance'] / ($user_tariff['price'] / 30)) * 60 * 60 * 24))}</span>
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