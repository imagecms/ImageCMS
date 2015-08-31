<section class="mini-layout mod_stats">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Stats', 'mod_stats')}</span>
        </div>
          </div>
    <div class="row-fluid">
        {include_tpl('../include/left_block')}
        <div class="clearfix span9 content-statistic" id="chartArea">
            {include_tpl('../include/top_form_min')}
            {if count($result) > 0}
                <table class="table  table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th style="width: 70px">{lang('Period', 'mod_stats')}</th>
                            <th>{lang('Orders', 'mod_stats')}</th>
                            <th>{lang('Delivered', 'mod_stats')}</th>
                            <th>{lang('Paid', 'mod_stats')}</th>
                            <th>{lang('Unique products', 'mod_stats')}</th>
                            <th>{lang('Total products', 'mod_stats')}</th>
                            <th style="width: 70px">{lang('Price', 'mod_stats')}</th>
                        </tr>
                    </thead>
                    <tbody>

                        {foreach $result as $order}
                            <tr>
                                <td>{$order.date}</td>
                                <td>{$order.orders_count}</td>
                                <td>{$order.delivered}</td>
                                <td>{$order.paid}</td>
                                <td>{$order.products_count}</td>
                                <td>{$order.quantity}</td>
                                <td>{echo \Currency\Currency::create()->decimalPointsFormat($order.price_sum)}</td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            {else:}
                <div class="alert alert-info">
                    {lang('There are no orders for specified period', 'mod_stats')}
                </div>
            {/if}
        </div>
    </div>
</section>