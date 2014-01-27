<section class="mini-layout mod_stats">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Stats', 'mod_stats')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'admin')}</span></a>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        {include_tpl('../left_block')}
        <div class="clearfix span9">
            {include_tpl('../time_and_filter_block')}
            {if count($data) > 0}
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
            {else:}
                <p style="text-align: center;">There are no orders for specified period</p>
            {/if}
        </div>
    </div>
</section>


