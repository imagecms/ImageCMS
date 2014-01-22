<table class="table table-striped table-bordered table-condensed content_big_td">
    <thead>
        <tr>
            <th>{lang('Period', 'mod_stats')}</th>
            <th>{lang('Orders', 'mod_stats')}</th>
            <th>{lang('Unique products', 'mod_stats')}</th>
            <th>{lang('Total products', 'mod_stats')}</th>
            <th>{lang('Sum', 'mod_stats')}</th>
        </tr>
    </thead>
    <tbody>
        {foreach $data as $order}
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