<div class="frame-inside page-profile">
    <div class="container">
        <div class="f-s_0 title-profile without-crumbs">
            <div class="frame-title">
                <h1 class="d_i">{echo encode($profile->getName())}, добро пожаловать!</h1>
            </div>
        </div>
        <div class="left-personal f-s_0">
            <ul class="tabs tabs-data">
                <li><button data-href="#my_data" data-source="{shop_url('profile/profile_data')}">Основные данные</button></li>
                <li><button data-href="#change_pass" data-source="{shop_url('profile/profile_change_pass')}">Смена пароля</button></li>
                    {if count($orders) > 0}
                    <li><button data-href="#history_order" data-source="{shop_url('profile/profile_history')}">История заказов</button></li>
                    {/if}
            </ul>
            <div class="frame-tabs-ref frame-tabs-profile">
                <div id="my_data">
                    <div class="preloader"></div>
                </div>
                <div id="change_pass">
                    <div class="preloader"></div>
                </div>
                <div id="history_order">
                    <div class="preloader"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="drop-style drop drop-comulativ-discounts">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">Накопительные скидки</div>
    </div>
    <div class="drop-content">
        <div class="inside-padd characteristic">
            <table class="">
                <thead>
                    <tr>
                        <th>Процент скидки</th>
                        <th>Сумма покупок от</th>
                        <th>Сумма покупок до</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-discount">11%</td>
                        <td>415 {$CS}</td>
                        <td>425 {$CS}</td>
                    </tr>
                    <tr>
                        <td class="text-discount">11%</td>
                        <td>415 {$CS}</td>
                        <td>425 {$CS}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>