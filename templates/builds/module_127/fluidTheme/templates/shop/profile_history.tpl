<div class="inside-padd">
    {if count($orders) == 0}
        <div class="msg layout-highlight layout-highlight-msg">
            <div class="info">
                <span class="icon_info"></span>
                <span class="text-el">{lang('Вы еще не совершали покупки','newLevel')}</span>
            </div>
        </div>
    {else:}
        <table class="table-profile adaptive">
            <thead>
                <tr>
                    <th>{lang('Заказ #','newLevel')}</th>
                    <th>{lang('Время покупки','newLevel')}</th>
                    <th>{lang('Сумма покупки','newLevel')}</th>
                    <th>{lang('Статус заказа','newLevel')}</th>
                    <th>{lang('Статус платежа','newLevel')}</th>
                </tr>
            </thead>
            <tbody>
                {foreach $orders as $order}
                    <tr>
                        <td title="{lang('Заказ #','newLevel')}"><a rel="nofollow" href="{shop_url('cart/view/' . $order->getKey())}">{lang('Заказ #','newLevel')}{echo $order->getId()}</a></td>
                        <td title="{lang('Время покупки','newLevel')}">{date("d-m-Y H:i", $order->getDateCreated())}</td>
                        <td title="{lang('Сумма покупки','newLevel')}">
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
                        <td title="{lang('Статус заказа','newLevel')}">{echo $order->getSOrderStatuses()->getName()}</td>
                        <td title="{lang('Статус платежа','newLevel')}">{if $order->getPaid()} {lang('Оплачен','newLevel')} {else:} {lang('Не оплачен','newLevel')}{/if}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {/if}
</div>