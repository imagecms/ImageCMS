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
            {include_tpl('../include/top_form_without_groupby')}
            <div class="fixedTableWithLeftScroll" style="">
                {if count($data) > 0}
                <table class="table  table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>{lang('Key','mod_stats')}</th>
                            <th>{lang('Count','mod_stats')}</th>
                            <th>{lang('Date','mod_stats')}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $data as $word}
                        <tr>
                            <td>{$word.key}</td>
                            <td>{$word.key_count}</td>
                            <td>{$word.date_search}</td>
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
    </div>
</section>

