<div class="fixedTableWithLeftScroll" style="">
    <table class="table table-striped table-bordered table-condensed content_big_td">
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
</div>