<script>
    var currency = '{$CS}'
</script>
<div class="m-t_20">
    <form method="get">
        <span class="d-i_b m-r_10 m-l_10">{lang('Product', 'mod_stats')} </span>
        <span class="d-i_b">
            <label class="p_r">
                <input 
                    id="autocomleteProduct"
                    class="input-small required" 
                    style="width: 350px;"
                    autocomplete="off"
                    value="" 
                    type="text"/>
                <input 
                    id="autocomleteProductId"
                    type="hidden" 
                    name="pi" value="{$_GET['id']}"/>
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
