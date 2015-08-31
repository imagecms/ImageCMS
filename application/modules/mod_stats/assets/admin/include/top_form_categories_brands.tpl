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
                    value="{echo $_SESSION['category']}" 
                    type="text"/>
                <input 
                    id="autocomleteCategoryId"
                    type="hidden" 
                    name="ci" value="{$_GET['ci']}"/>
            </span>
            <button type="submit" class="btn btn-small btn-default" type="button" id="refreshIntervalsButton">
                {lang('OK','mod_stats')}
            </button>
        </span>
        <label class="d-i_b p_r">
            <span class="d-i_b">
                <span class="d_b title-field">{lang('Char type','mod_stats')}</span>
                <div class="btn-group" data-toggle="buttons-radio">
                    <button type="button" class="btn btn-default{if $_GET['charType'] == 'pie'} active{/if}" data-val="pie" data-rel="[name='charType']" data-btn-select data-tooltip data-title="{lang('Pie char','mod_stats')}"><span class="icon-circ-diagram"></span><span class="d_n">{lang('Pie char','mod_stats')}</span></button>
                    <button type="button" class="btn btn-default{if $_GET['charType'] == 'bar'} active{/if}" data-val="bar" data-rel="[name='charType']" data-btn-select data-tooltip data-title="{lang('Bar char','mod_stats')}"><span class="icon-signal"></span><span class="d_n">{lang('Bar char','mod_stats')}</span></button>
                </div>
                <input type="hidden" name="charType" value="{if $_GET['charType'] == 'bar'}bar{else:}pie{/if}"/>
            </span>
        </label>
    </div>
</form>