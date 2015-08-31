<script>
    var currency = '{$CS}'
</script>
<form method="get">
    <div class="f-s_0 frame-panel-stat">
        <span class="d-i_b">
            <span class="d_b title-field">{lang('Show top brands count', 'mod_stats')}</span>
            <input class="input-small required" 
                   value="{if $_GET['stbc'] != null}{echo $_GET['stbc']}{else:}20{/if}" 
                   type="text" name="stbc" maxlength="2"/>
        </span>
        <span class="d-i_b">
            <span class="d_b title-field">{lang('Char type','mod_stats')}</span>
            <div class="btn-group" data-toggle="buttons-radio">
                <button type="button" class="btn btn-default{if $_GET['charType'] == 'pie'} active{/if}" data-val="pie" data-rel="[name='charType']" data-btn-select data-tooltip data-title="{lang('Pie char','mod_stats')}"><span class="icon-circ-diagram"></span><span class="d_n">{lang('Pie char','mod_stats')}</span></button>
                <button type="button" class="btn btn-default{if $_GET['charType'] == 'bar'} active{/if}" data-val="bar" data-rel="[name='charType']" data-btn-select data-tooltip data-title="{lang('Bar char','mod_stats')}"><span class="icon-signal"></span><span class="d_n">{lang('Bar char','mod_stats')}</span></button>
            </div>
            <input type="hidden" name="charType" value="{if $_GET['charType'] == 'bar'}bar{else:}pie{/if}"/>
        </span>
    </div>
</form>
