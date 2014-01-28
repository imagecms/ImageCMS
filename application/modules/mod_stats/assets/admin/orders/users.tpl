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
        {include_tpl('../include/left_block')}
        <div class="clearfix span9" id="chartArea">
            {include_tpl('../include/top_form_orders_users')}
            <p id="showNoChartData" style="text-align: center; display: none;">{lang('No chart data for displaying','mod_stats')}</p>
            {if  $_GET['view_type'] == 'table'}
                <div id="user_information">
                    <table class="table table-striped table-bordered table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th>Польз.</th>
                                <th>К-во заказов</th>
                                <th>Оплаченных</th>
                                <th>Дост. заказов</th>
                                <th>Заказы</th>
                                <th>На суму</th>
                                <th>К-во товаров</th>
                                <th>Всего товаров</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $data as $user}
                                <tr>
                                    <td>{$user.username}</td>
                                    <td>{$user.orders_count}</td>
                                    <td>{$user.paid}</td>
                                    <td>{$user.delivered}</td>
                                    <td>{$user.orders_ids}</td>
                                    <td>{$user.price_sum}</td>
                                    <td>{$user.products_count}</td>
                                    <td>{$user.quantity}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>

                </div>
            {else:}
                <button  class="btn btn-small btn-primary" id="saveAsPng">
                <i class="icon-download"></i> </button>
                {if $_GET['charType'] == null || $_GET['charType'] == 'pie'}
                    <svg class="mypiechart pieChartStats" data-from="orders/getUsersChartData" style="height: 700px;"></svg>
                {/if}
                {if $_GET['charType'] == 'bar'}
                    <svg class="mypiechart barChartStats" data-from="orders/getUsersChartData" style="height: 600px;"></svg>
                {/if}
            {/if}

        </div>
    </div>
</section>

