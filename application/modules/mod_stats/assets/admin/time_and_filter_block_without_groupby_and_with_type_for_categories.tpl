<script>
    var currency = '{$CS}'
</script>
<div class="m-t_20">
    <form method="get">
        
        <span class="d-i_b">
            {lang('Choose Category:','mod_stats')}
            <label class="d-i_b p_r">
                <select name='catId'>
                    <option>-</option>
                    {foreach $categories as $category}
                        <option value="{echo $category['id']}"{if $_GET['catId'] == $category['id']} selected="selected"{/if}>{echo $category['name']}</option>
                    {/foreach}
                </select>
            </label>
        </span>
        <span class="d-i_b">
            {lang('Char Type:','mod_stats')}
            <label class="d-i_b p_r">
                <select name='charType'>
                    <option value="pie"{if $_GET['charType'] == 'pie'} selected="selected"{/if}>{lang('Pie char','mod_stats')}</option>
                    <option value="bar"{if $_GET['charType'] == 'bar'} selected="selected"{/if}>{lang('Bar char','mod_stats')}</option>
                </select>
            </label>
        </span>
        <div class="pull-right">
            <button type="submit" class="btn btn-small m_t_-10" type="button" id="refreshIntervalsButton">
                <i class="icon-refresh"></i> {lang('Update','mod_stats')}
            </button>
        </div>
    </form>
</div>
<hr class="m-t_5" />
