<div class="inside-padd">
    {if count($orders) == 0}
        <div class="msg layout-highlight layout-highlight-msg">
            <div class="info">
                <span class="icon_info"></span>
                <span class="text-el">{lang('Вы еще не совершали покупки','boxVertical')}</span>
            </div>
        </div>
    {else:}
        <table class="table-profile">
            <thead>
                <tr>
                    <th>{lang('Заказ #','boxVertical')}</th>
                    <th>{lang('Время покупки','boxVertical')}</th>
                    <th>{lang('Сумма покупки','boxVertical')}</th>
                    <th>{lang('Статус заказа','boxVertical')}</th>
                    <th>{lang('Статус платежа','boxVertical')}</th>
                </tr>
            </thead>
            <tbody>
                {foreach $orders as $order}
                    <tr>
                        <td><a rel="nofollow" href="{shop_url('order/view/' . $order->getKey())}">{lang('Заказ #','boxVertical')}{echo $order->getId()}</a></td>
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
                        <td>{if $order->getPaid()} {lang('Оплачен','boxVertical')} {else:} {lang('Не оплачен','boxVertical')}{/if}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {/if}
</div>