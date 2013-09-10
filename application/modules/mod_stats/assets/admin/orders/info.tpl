<table class="table table-striped table-bordered table-condensed content_big_td module-cheep">
    <thead>
        <tr>
            <th colspan="6">
                {lang('Orders information', 'mod_stats')}       
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="6">
                <div id="stats_orders_info">

                    <div class="stats_label" style="width: 80px; ">Интервал:</div>
                    <div class="btn-group stats_control" style="width: 200px; " data-toggle="buttons-radio">
                        <button class="stats_order_info_interval btn" value="day">День</button>
                        <button class="stats_order_info_interval btn active" value="month">Месяц</button>
                        <button class="stats_order_info_interval btn" value="year">Год</button>
                    </div>

                    <div class="stats_label" style="width: 80px; ">Дата от:</div>
                    <div class="stats_control" style="width: 100px; ">
                        <input type="text" id="start_date" value="2011-02">
                    </div>

                    <div class="stats_label" style="width: 80px; ">Дата до:</div>
                    <div class="stats_control" style="width: 100px; ">
                        <input type="text" id="end_date" value="2013-09">
                    </div>

                    <div class="stats_control" style="margin-left: 25px; width: 100px; ">
                        <button class="btn btn-primary" id="loadOrdersInfo">Показать</button>
                    </div>

                    <div style="clear: both; height: 10px; "></div>

                    

                </div>


            </td>
        </tr>
    </tbody>
</table>

<div id="stat_info_data"></div>