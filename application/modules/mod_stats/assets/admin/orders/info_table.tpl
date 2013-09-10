<table class="table table-striped table-bordered table-condensed content_big_td">
    <thead>
        <tr>
            <th>Период</th>
            <th>Заказов</th>
            <th>Уникальних товаров</th>
            <th>Всего товаров</th>
            <th>Сума</th>
        </tr>
    </thead>
    <tbody>
        {foreach $orders as $order}
            <tr>
                <td>{$order.date}</td>
                <td>{$order.orders_count}</td>
                <td>{$order.products_count}</td>
                <td>{$order.quantity}</td>
                <td>{$order.price_sum}</td>
            </tr>
        {/foreach}
    </tbody>
</table>