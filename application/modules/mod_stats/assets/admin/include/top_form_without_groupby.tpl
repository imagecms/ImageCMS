<script>
    var currency = '{$CS}'
</script>
{/*<div class="btn-group   pull-left">
    <a class="btn btn-small intervalButton" data-group="month">{lang('Last month','mod_stats')}</a>
    <a class="btn btn-small intervalButton" data-group="year">{lang('Last year','mod_stats')}</a>       
</div>*/}
<div class="">
    <form method="get">
        <div class="f-s_0 frame-panel-stat">
            <span class="d-i_b">
                <span class="d_b title-field">{lang('Period','mod_stats')}</span>
                <span class="d-i_b">
                    <label class="p_r w_95">
                        <input class="datepicker date_start maxDateForDataPicker" type="text" value="{if isset($_GET['from'])}{echo $_GET['from']}{else:}{echo date('Y-m-d',time()-(60*60*24*30))}{/if}" name="from" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off" >
                        <span class="icon-calendar"></span>
                    </label>
                </span>
                <span class="d-i_b m-r_5 m-l_5">{lang('to','mod_stats')}</span>
                <span class="d-i_b">
                    <label class="p_r w_95">
                        <input class="datepicker date_end" type="text" value="{if isset($_GET['to'])}{echo $_GET['to']}{else:}{echo date('Y-m-d')}{/if}" name="to" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off" >
                        <span class="icon-calendar"></span>
                    </label>
                </span>
                <button type="submit" class="btn btn-small btn-default" type="button" id="refreshIntervalsButton">
                    {lang('OK','mod_stats')}
                </button>
            </span>
            <span class="d-i_b">
                <span class="d_b title-field">{lang('Count of results', 'mod_stats')}</span>
                <label class="p_r w_95">
                    <input class="input-small required" 
                           value="{if $_GET['swr'] != null}{echo $_GET['swr']}{else:}200{/if}" 
                           type="text" name="swr" maxlength="5" >
                </label>
            </span>
        </div>
    </form>
</div>
