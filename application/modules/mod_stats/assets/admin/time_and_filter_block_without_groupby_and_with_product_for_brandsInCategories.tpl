<script>
    var currency = '{$CS}'
</script>
<div class="m-t_20">
    <form method="get">
        <span class="d-i_b m-r_10 m-l_10">{lang('Category', 'mod_stats')} </span>
        <span class="d-i_b">
            <label class="p_r">
                <input 
                    id="autocomleteCategory"
                    class="input-small required" 
                    style="width: 350px;"
                    autocomplete="off"
                    value="" 
                    type="text"/>
                <input 
                    id="autocomleteCategoryId"
                    type="hidden" 
                    name="ci" value="{$_GET['ci']}"/>
            </label>
        </span>
        <span class="d-i_b">
        {lang('Char Type:','mod_stats')}
        <label class="d-i_b p_r">
            <select id="selectGroupBy" name='charType'>
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
