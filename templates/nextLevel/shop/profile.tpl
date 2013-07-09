<div class="frame-inside page-profile">
    <div class="container">
        <div class="f-s_0 title-profile without-crumbs">
            <div class="frame-title">
                <h1 class="d_i">{echo encode($profile->getName())}, добро пожаловать!</h1>
            </div>
        </div>
        <div class="left-personal f-s_0">
            <ul class="tabs tabs-data">
                <li><button data-href="#my_data">Основные данные</button></li>
                <li><button data-href="#change_pass">Смена пароля</button></li>
                    {if count($orders) > 0}
                    <li><button data-href="#history_order">История заказов</button></li>
                    {/if}
            </ul>
            <div class="frame-tabs-ref frame-tabs-profile">
                <div id="my_data">
                    <div class="inside-padd clearfix">
                        <div class="frame-change-profile">
                            {include_tpl('../profile_data_popup')}
                        </div>
                        {$discount = ShopCore::app()->SDiscountsManager->getActive();}
                        {if $discount['0']!=null && $discount['0']->getDiscount() != null}
                            <div class="layout-highlight info-discount">
                                <div class="title-default">
                                    <div class="title">Накопительная скидка</div>
                                </div>
                                <div class="content">
                                    <ul class="items items-info-discount">
                                        <li class="inside-padd">
                                            <div>
                                                Куплено товаров на сумму:
                                                <span class="price-item">
                                                    <span class="text-discount">
                                                        <span class="price"></span>
                                                        <span class="curr">{$CS}</span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div>
                                                Ваша текущая скидка:
                                                <span class="price-item">
                                                    <span class="text-discount">{echo $discount['0']->getDiscount()}%</span>
                                                </span>
                                            </div>
                                        </li>
                                        <li class="inside-padd">
                                            <div>Для следующей <b>скидки 20%</b> осталось</div>
                                            <div>совершить покупок на сумму: <b>3500 грн</b></div>
                                        </li>
                                        <li class="inside-padd">
                                            <button type="button" class="d_l_1" data-drop=".drop-comulativ-discounts" data-place="noinherit" data-placement="top left" data-overlayopacity= "0">Просмотр таблицы скидок</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        {/if}
                    </div>
                </div>
                <div id="change_pass">
                    <div class="inside-padd">
                        <div class="frame-change-password">
                            {include_tpl('../change_pass_popup')}
                        </div>
                    </div>
                </div>
                <div id="history_order">
                    <div class="inside-padd">
                        <table class="table-profile">
                            <thead>
                                <tr>
                                    <th>№ Заказа</th>
                                    <th>Время покупки</th>
                                    <th>Сумма покупки</th>
                                    <th>Статус заказа</th>
                                    <th>Статус оплаты</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $orders as $order}
                                    <tr>
                                        <td><a rel="nofollow" href="{shop_url('cart/view/' . $order->getKey())}">Заказ №{echo $order->getId()}</a></td>
                                        <td>{date("d-m-Y H:i", $order->getDateCreated())}</td>
                                        <td>
                                            <div class="frame-prices">
                                                <span class="current-prices">
                                                    <span class="price-new">
                                                        <span>
                                                            <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($order->getTotalPrice())}</span>
                                                            <span class="curr">{$CS}</span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                        </td>
                                        </span>
                                        <td>{echo $order->getSOrderStatuses()->getName()}</td>
                                        <td>{if $order->getPaid()} Оплачен {else:} Не оплачен{/if}</td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
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