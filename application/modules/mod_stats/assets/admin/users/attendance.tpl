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
        <div class="clearfix span9">
            {include_tpl('../include/top_form')}
            
            {if $viewType == 'chart'}
                <svg class="cumulativeLineChartStats" data-from="users/getAttendanceData" style="height: 600px; width: 800px;"></svg>
            {else:}
                {if count($data) > 0}
                    <table class="table table-striped table-bordered table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th>{lang('Date', 'mod_stats')}</th>
                                <th>{lang('Count of unique visitors (registered + unregistered)', 'mod_stats')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $data as $day}
                                <tr>
                                    <td>{$day.date}</td>
                                    <td>{$day.users_count}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                {else:}
                    <p style="text-align: center;">There are no orders for specified period</p>
                {/if}

            {/if}
        </div>
    </div>
</section>