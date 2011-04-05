
{include_tpl("profile_menu")}

<div class="products_list">
    <table width="100%">
        <thead>
            <tr>
                <td style="width:15px;">ID</td>
                <td>Статус</td>
                <td>Оплачен</td>
                <td>Создан</td>
                <td>Обновлен</td>
                <td></td>
            </tr>
        </thead>

        {foreach $orders as $order}
        <tr style="font-size:13px;">
            <td style="width:15px;">{echo $order->getId()}</td>
            <td>{echo SOrders::$statuses[$order->getStatus()]}</td>
            <td>{if $order->getPaid()} Да {else:} Нет {/if}</td>
            <td>{date("d-m-Y H:i", $order->getDateCreated())}</td>
            <td>{date("d-m-Y H:i", $order->getDateUpdated())}</td>
            <td><a href="{shop_url('cart/view/' . $order->getKey())}">Просмотр</a></td>
        </tr>
        {/foreach}
    </table>
</div>
