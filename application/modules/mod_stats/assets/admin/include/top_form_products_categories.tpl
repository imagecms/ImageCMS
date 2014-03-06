<script>
    var currency = '{$CS}'
</script>
<form method="get">
    <div class="f-s_0 frame-panel-stat">
        <span class="d-i_b">
            <span class="d_b title-field">{lang('Choose Category:','mod_stats')}</span>
            <label class="d-i_b p_r">
                <select name='catId'>
                    <option>{lang('First level categories','mod_stats')}</option>
                    {foreach $categories as $category}
                        <option value="{echo $category['id']}"{if $_GET['catId'] == $category['id']} selected="selected"{/if}>{echo $category['name']}</option>
                    {/foreach}
                </select>
            </label>
        </span>
        <span class="d-i_b">
            <span class="d_b title-field">{lang('Char type','mod_stats')}</span>
            <div class="btn-group" data-toggle="buttons-radio">
                <button type="button" class="btn btn-default{if $_GET['charType'] == 'pie'} active{/if}" data-val="pie" data-rel="[name='charType']" data-btn-select>{lang('Pie char','mod_stats')}</button>
                <button type="button" class="btn btn-default{if $_GET['charType'] == 'bar'} active{/if}" data-val="bar" data-rel="[name='charType']" data-btn-select>{lang('Bar char','mod_stats')}</button>
            </div>
            <input type="hidden" name="charType" value="{if $_GET['charType'] == 'bar'}bar{else:}pie{/if}"/>
        </span>
    </div>
</form>

