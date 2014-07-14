<div class="inside-padd">
    <div class="title-default">
        <div class="title">Данные магазина</div>
    </div>
    <table class="data-shop">
        <tbody>
            <tr>
                <th>
                    Сайт
                </th>
                <td>
                    <a href="http://{$user['domain']}">{$user['domain']}</a> 
                </td>
                <td>
                    <a href="#" class="btn btn-default">
                        <span class="text-el">Изменить</span>
                    </a>
                </td>
            </tr>
            <tr>
                <th>
                    Админчасть
                </th>
                <td colspan="2">
                    <a href="http://{$user['domain']}/admin">{$user['domain']}/admin</a>
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
                <td>
                    <a href="#" class="btn btn-default">
                        <span class="text-el">Изменить</span>
                    </a>
                </td>
            </tr>
            <tr>
                <th>
                    Стоимость
                </th>
                <td colspan="2">
                    {$tariff['price']}$ / мес
                </td>
            </tr>
            <tr>
                <th>
                    Наполнение
                </th>
                <td colspan="2">
                    <span class="important-text">{$serverData['productsCount']} товаров</span>  / {$tariff['prod_limit']} товаров
                    <div class="out-range">
                        {$productsPercent = ceil(($serverData['productsCount'] / $tariff['prod_limit']) * 100)}
                        <div class="range" style="width: {$productsPercent}%;"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    Вместимоть
                </th>
                <td colspan="2">
                    <span class="important-text">{$serverData['quotaUsed']} Mb</span> / 1024 Mb
                    <div class="out-range">
                        {$spacePercent = ceil(($serverData['quotaUsed'] / 1024 * 100))}
                        <div class="range" style="width: {$spacePercent}%;"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    Текущий дизайн
                </th>
                <td>
                    <span class="photo-block">
                        <img src="img/temp/layout.png"/>
                    </span>
                </td>
                <td>
                    <a href="#" class="btn btn-default">
                        <span class="text-el">Изменить</span>
                    </a>
                </td>
            </tr>
            <tr>
                <th>
                    Оплачен до
                </th>
                <td colspan="2">
                    <span class="help-block">Бесплатная пробная версия до</span>
                    <span class="important-text">12 января 2015</span>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="default-patch t-a_c">
        <div class="inside-padd">
            <button type="button" class="btn btn-success">
                <span class="text-el">Продлить аренду</span>
            </button>
        </div>
    </div>
</div>

<div id="right">

</div>