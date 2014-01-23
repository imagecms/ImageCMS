<script>
    var currency = '{$CS}'
</script>
<div class="btn-group  m-t_20 pull-left">
    <a class="btn btn-small intervalButton" data-group="day">{lang('Last day','mod_stats')}</a>
    <a class="btn btn-small intervalButton" data-group="month">{lang('Last month','mod_stats')}</a>
    <a class="btn btn-small intervalButton" data-group="year">{lang('Last year','mod_stats')}</a>       
</div>
<div class="m-t_20">
    <form method="get">
        <span class="d-i_b m-r_10 m-l_10">{lang('From:','mod_stats')}</span>
        <span class="d-i_b">
            <label class="p_r">
                <input class="datepicker date_start maxDateForDataPicker" type="text" value="{if isset($_GET['from'])}{echo $_GET['from']}{else:}{echo date('Y-m-d',time()-(60*60*24*30))}{/if}" name="from" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off" >
                <span class="icon-calendar"></span>
            </label>
        </span>
        <span class="d-i_b m-r_10 m-l_10">{lang('To:','mod_stats')}</span>
        <span class="d-i_b">
            <label class="d-i_b p_r">
                <input class="datepicker date_end" type="text" value="{if isset($_GET['to'])}{echo $_GET['to']}{else:}{echo date('Y-m-d')}{/if}" name="to" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off" >
                <span class="icon-calendar"></span>
            </label>
        </span>
        <div class="pull-right">
            <button type="submit" class="btn btn-small m_t_-10" type="button" id="refreshIntervalsButton">
                <i class="icon-refresh"></i> {lang('Update','mod_stats')}
            </button>
        </div>
        <br/>
        <span class="d-i_b m-r_10 m-l_10">{lang('Quantity of words', 'mod_stats')} </span>
        <span class="d-i_b">
            <label class="p_r">
                <input class="input-small required" 
                       value="{if $_GET['swc'] != null}{echo $_GET['swc']}{else:}9{/if}" 
                       type="text" name="swc" maxlength="1"/>
            </label>
        </span>
        <span class="d-i_b m-r_10 m-l_10">{lang('Count of results', 'mod_stats')} </span>
        <span class="d-i_b">
            <label class="p_r">
                <input class="input-small required" 
                       value="{if $_GET['swr'] != null}{echo $_GET['swr']}{else:}9{/if}" 
                       type="text" name="swr" maxlength="2">
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

    </form>
</div>
<hr class="m-t_5" />
