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
    <div class="row-fluid" id="chartArea">
        {include_tpl('../include/left_block')}
        <div class="clearfix span9 content-statistic">
            {include_tpl('../include/top_form_robots')}

            {if count($data) > 0}
                <table class="table table-striped table-bordered table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th>{lang('Time', 'mod_stats')}</th>
                            <th>{lang('Page', 'mod_stats')}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $data as $row}
                            <tr>
                                <td>{$row.time}</td>
                                <td>
                                    <a href="/{$row['url']}">
                                        {$row['page_name']}
                                    </a>
                                    {$row.users_count}
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            {else:}
                <div class="alert alert-info">
                    {lang('There are no data for specified period', 'mod_stats')}
                </div>
            {/if}


        </div>
    </div>
</section>