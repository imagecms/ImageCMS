<script>
    var currency = '{$CS}'
</script>
<div class="btn-group  m-t_20 pull-left">
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
        <span class="d-i_b m-r_10 m-l_10">{lang('Count of results', 'mod_stats')} </span>
        <span class="d-i_b" style="width: 60px !important;">
            <label class="p_r">
                <input class="input-small required" 
                       value="{if $_GET['swr'] != null}{echo $_GET['swr']}{else:}200{/if}" 
                       type="text" name="swr" maxlength="5" >
            </label>
        </span>

        <div class="pull-right">
            <button type="submit" class="btn btn-small btn-primary" type="button" id="refreshIntervalsButton">
                <i class="icon-refresh"></i> {lang('Update','mod_stats')}
            </button>
        </div>
    </form>
</div>
