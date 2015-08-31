<section class="mini-layout mod_stats">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Stats', 'mod_stats')}</span>
        </div>
    </div>
    <div class="row-fluid">
        {include_tpl('../include/left_block')}
        <div class="clearfix span9 content-statistic">
            {include_tpl('../time_and_filter_block')}
            {if count($data) > 0}
            <table class="table  table-bordered table-condensed">
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
            {else:}
            <div class="alert alert-info">
                {lang("There are no keywords searched for specified period","mod_stats")}
            </div>
            {/if}

        </div>
    </div>
</section>

