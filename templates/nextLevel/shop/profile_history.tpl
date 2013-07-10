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