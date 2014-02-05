<div class="hisory-table-container">
    <table class='hisory-table'>
        {$i = 0}
        {foreach $data as $row}
            <tr>
                <td>{$row['time']}</td>
                <td>
                    {if $row.type_id == 1}
                        {lang('Page','mod_stats')}
                    {/if}
                    {if $row.type_id == 2}
                        {lang('Category','mod_stats')}
                    {/if}
                    {if $row.type_id == 3}
                        {lang('Shop category','mod_stats')}
                    {/if}
                    {if $row.type_id == 4}
                        {lang('Product','mod_stats')}
                    {/if}
                    :
                    <a href="{$row['url']}">
                        {$row['page_name']}
                    </a>
                </td>
            </tr>
            {$i++}
        {/foreach}
    </table>
    {if $i > 190}
        <p style="text-align:center; color: silver;">{lang('Max 200 rows','mod_stats')}</p>
    {/if}

</div>