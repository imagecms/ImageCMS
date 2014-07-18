<div class="right"
     data-mq-elem-pool=".main-body"
     data-mq-prop-pool="height"
     data-mq-prop="min-height"
     data-mq-prop-add="-87"

     data-mq-max="1280"
     data-mq-min="0"
     data-mq-target="#right"
     >
    <div class="panel-default">
        <div class="title-default-out">
            <div class="title">
                Тур по системе
            </div>
        </div>
        <ol class="items-refers-vertical">
            {$tutorial_pages = category_pages(81,11);}
            {foreach $tutorial_pages as $number => $page}
                <li>
                    <a href="{echo site_url($page['cat_url'])}#t{echo ++$number}" class="after-icon">
                        {echo $page['title']}
                    </a>
                </li>
            {/foreach}

        </ol>
        <div class="footer-panel">
            <div class="inside-padd">
                <a href="{site_url('tutorial')}" class="btn btn-primary">
                    <span class="text-el">{echo lang('Полная документация', 'premmerce')}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="panel-default out-adding-service">
        <div class="title-default-out">
            <div class="title">
                {echo lang('Дополнительные услуги', 'premmerce')}
            </div>
        </div>
        {$CI->load->module('cfcm')->get_form(80, 97, 'page', 'additional_services_form_min')}
    </div>
</div>
<div class="inside-padd">
    <div class="title-default">
        <div class="title">Данные магазина</div>
    </div>
    <table class="data-shop">
        <tbody>
            <tr>
                <th>
                    {lang('Сайт','prem')}
                </th>
                <td>
                    <a href="http://{$user['domain']}">{$user['domain']}</a> 
                </td>
                <td>
                    <a href="#" class="btn btn-default">
                        <span class="text-el">{lang('Изменить','prem')}</span>
                    </a>
                </td>
            </tr>
            <tr>
                <th>
                    {lang('Админчасть','prem')}
                </th>
                <td colspan="2">
                    <a href="http://{$user['domain']}/admin">{$user['domain']}/admin</a>
                    <div class="help-block">{lang('Логин и пароль те, что в личный кабинет','prem')}</div>
                </td>
            </tr>
            <tr>
                <th>
                    {lang('Тариф','prem')}
                </th>
                <td>
                    {$tariff['name']}
                </td>
                <td>
                    <a href="/saas/tariffs" class="btn btn-default">
                        <span class="text-el">{lang('Изменить','prem')}</span>
                    </a>
                </td>
            </tr>
            <tr>
                <th>
                    {lang('Стоимость','prem')}
                </th>
                <td colspan="2">
                    {$tariff['price']}$ / {lang('мес','prem')}
                </td>
            </tr>
            <tr>
                <th>
                    {lang('Наполнение','prem')}
                </th>
                <td colspan="2">
                    <span class="important-text">{$serverData['productsCount']} {lang('товаров','prem')}</span>  / {$tariff['prod_limit']} {lang('товаров','prem')}
                    <div class="out-range">
                        {$productsPercent = ceil(($serverData['productsCount'] / $tariff['prod_limit']) * 100)}
                        <div class="range" style="width: {$productsPercent}%;"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    {lang('Вместимоcть','prem')}
                </th>
                <td colspan="2">
                    {if $serverData['quotaUsed'] != 0}
                        <span class="important-text">{$serverData['quotaUsed']} Mb</span> / {$tariff['disk_limit']} Mb
                        <div class="out-range">
                            {$spacePercent = ceil(($serverData['quotaUsed'] / 1024 * 100))}
                            <div class="range" style="width: {$spacePercent}%;"></div>
                        </div>
                    {else:}
                        <span class="important-text">{lang('Идет обработка дискового пространства','prem')}</span>
                    {/if}
                </td>
            </tr>
            <tr>
                <th>
                    {lang('Текущий дизайн','prem')}
                </th>
                <td>
                    <span class="photo-block">
                        <img src="img/temp/layout.png"/>
                    </span>
                </td>
                <td>
                    <a href="#" class="btn btn-default">
                        <span class="text-el">{lang('Изменить','prem')}</span>
                    </a>
                </td>
            </tr>
            <tr>
                <th>
                    {lang('Оплачен до','prem')}
                </th>
                <td colspan="2">
                    <!--span class="help-block">Бесплатная пробная версия до</span-->
                    <span class="important-text">{data_translate(time() + ((int)($user['balance'] / ($tariff['price'] / 30)) * 60 * 60 * 24))}</span>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="default-patch t-a_c">
        <div class="inside-padd">
            <button type="button" class="btn btn-success">
                <span class="text-el">{lang('Продлить аренду','prem')}</span>
            </button>
        </div>
    </div>
</div>

<div id="right">

</div>