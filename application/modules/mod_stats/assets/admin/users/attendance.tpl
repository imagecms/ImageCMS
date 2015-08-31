<section class="mini-layout mod_stats">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Stats', 'mod_stats')}</span>
        </div>
        <div class="pull-right">

            {if $viewType == 'chart'}
            <div class="d-i_b">
                <button  class="btn btn-small btn-primary" id="saveAsPng">
                    <i class="icon-download"></i> {lang('Save Image', 'mod_stats')}
                </button>
            </div>
            {/if}
        </div>
    </div>
    <div class="row-fluid" id="chartArea">
        {include_tpl('../include/left_block')}
        <div class="clearfix span9 content-statistic">
            {include_tpl('../include/top_form')}

            {if $viewType == 'chart'}
            <svg class="cumulativeLineChartStats" data-from="users/getAttendanceData" style="height: 600px; width: 800px;"></svg>
            {else:}
            {if count($data) > 0}
            <table class="table  table-bordered table-condensed">
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
            <div class="alert alert-info">
                {lang('There are no attendance for specified period', 'mod_stats')}
            </div>
            {/if}

            {/if}
        </div>
    </div>
</section>