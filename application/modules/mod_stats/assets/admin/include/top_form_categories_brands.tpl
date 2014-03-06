<script>
    var currency = '{$CS}'
</script>
<form method="get">
    <div class="f-s_0 frame-panel-stat">
        <span class="d-i_b">
            <span class="d_b title-field">{lang('Category', 'mod_stats')}</span>
            <span class="d-i_b p_r">
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
            </span>
        </span>
        <label class="d-i_b p_r">
            <span class="d_b title-field">{lang('Show','mod_stats')}</span>
            <div class="btn-group" data-toggle="buttons-radio">
                <button type="button" class="btn btn-default{if $_GET['selectGroupBy'] == 'pie'} active{/if}" data-val="pie" data-rel="[name='selectGroupBy']" data-btn-select>{lang('Pie char','mod_stats')}</button>
                <button type="button" class="btn btn-default{if $_GET['selectGroupBy'] == 'bar'} active{/if}" data-val="bar" data-rel="[name='selectGroupBy']" data-btn-select>{lang('Bar char','mod_stats')}</button>
            </div>
            <input type="hidden" name="selectGroupBy" value="{if $_GET['selectGroupBy'] == 'bar'}bar{else:}pie{/if}"/>
        </label>
    </div>
</form>