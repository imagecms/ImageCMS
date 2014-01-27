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
            <div class="m-t_20">
                <form method="get">
                    <div>
                        <span class="d-i_b m-r_10 m-l_10">{lang('From:','mod_stats')}</span>
                        <span class="d-i_b">
                            <label class="p_r">
                                <input class="datepicker date_start maxDateForDataPicker" type="text" value="{if isset($_GET['from'])}{echo $_GET['from']}{else:}{echo date('Y-m-d',time()-(60*60*24*30))}{/if}" name="from" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off" >
                                <span class="icon-calendar"></span>
                            </label>
                        </span>
                        <span class="d-i_b m-r_10 m-l_10">{lang('To:','mod_stats')}</span>
                        <span class="d-i_b">
                            <label class="d-i_b p_r">
                                <input class="datepicker date_end" type="text" value="{if isset($_GET['to'])}{echo $_GET['to']}{else:}{echo date('Y-m-d')}{/if}" name="to" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off" >
                                <span class="icon-calendar"></span>
                            </label>
                        </span>

                        <span class="d-i_b">
                            {lang('Group by:','mod_stats')}
                            <label class="d-i_b p_r">
                                <select id="selectGroupBy" name='group'>
                                    <option value="day"{if $_GET['group'] == 'day'} selected="selected"{/if}>{lang('day','mod_stats')}</option>
                                    <option value="month"{if $_GET['group'] == 'month' || !isset($_GET['group'])} selected="selected"{/if}>{lang('month','mod_stats')}</option>
                                    <option value="year"{if $_GET['group'] == 'year'} selected="selected"{/if}>{lang('year','mod_stats')}</option>
                                </select>
                            </label>
                        </span>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-small m_t_-10" type="button" id="refreshIntervalsButton">
                                <i class="icon-refresh"></i> {lang('Update','mod_stats')}
                            </button>
                        </div>
                    </div>

                    <div class="view_type">
                        <label>
                            <input type="radio" name="view_type" value="table" {if $viewType == 'table'}checked="checked"{/if} />
                            {lang('Table','mod_stats')}
                        </label>
                        <label>
                            <input type="radio" name="view_type" value="pie_chart" {if $viewType == 'pie_chart'}checked="checked"{/if} />
                            {lang('Pie-chart','mod_stats')}
                        </label>
                        <label>
                            <input type="radio" name="view_type" value="bar_chart" {if $viewType == 'bar_chart'}checked="checked"{/if} />
                            {lang('Bar-chart','mod_stats')}
                        </label>
                    </div>

                    <div>
                        {if $viewType != 'table'}
                            <div style="text-align: center">
                                <select name="chart_field" style="width: 150px;">
                                    <option value="orders_count"{if $chartField == 'orders_count'} selected="selected" {/if}>К-во заказов</option>
                                    <option value="paid"{if $chartField == 'paid'} selected="selected" {/if}>Оплаченных</option>
                                    <option value="delivered"{if $chartField == 'delivered'} selected="selected" {/if}>Дост. заказов</option>
                                    <option value="price_sum"{if $chartField == 'price_sum'} selected="selected" {/if}>На суму</option>
                                    <option value="products_count"{if $chartField == 'products_count'} selected="selected" {/if}>К-во товаров</option>
                                    <option value="quantity"{if $chartField == 'quantity'} selected="selected" {/if}>Всего товаров</option>
                                </select>
                            </div>
                        {/if}
                    </div>
                </form>
            </div>

            {if $viewType == 'table'}
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
            {/if}

            {if $viewType == 'pie_chart'}
                <svg class="mypiechart pieChartStats" data-from="orders/getUsersData" style="height: 700px;"></svg>
            {/if}

            {if $viewType == 'bar_chart'}
                <svg class="mypiechart barChartStats" data-from="orders/getUsersData" style="height: 600px;"></svg>
            {/if}


        </div>
    </div>
</section>

