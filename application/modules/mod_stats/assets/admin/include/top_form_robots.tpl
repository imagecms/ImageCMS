<script>
    var currency = '{$CS}'
</script>

<div class="m-t_20">
    <form method="get">
        <div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span class="d-i_b m-r_10 m-l_10">{lang('Date:','mod_stats')}</span>
            <span class="d-i_b">
                <label class="p_r">
                    <input class="datepicker date_start maxDateForDataPicker" type="text" value="{if isset($_GET['date'])}{echo $_GET['date']}{else:}{echo date('Y-m-d',time()-(60*60*24*30))}{/if}" name="date" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off" >
                    <span class="icon-calendar"></span>
                </label>
            </span>

            <span class="d-i_b">
                &nbsp;&nbsp;&nbsp;
                {lang('Robots:','mod_stats')}
                <label class="d-i_b p_r">
                    <select name='currentRobot'>
                        {foreach $robots as $key => $name}
                            <option value="{$key}" {if $currentRobot == $key} selected="selected" {/if}>{$name}</option>
                        {/foreach}
                    </select>
                </label>
            </span>
            <div class="pull-right">
                <button type="submit" class="btn btn-small  btn-primary" type="button" id="refreshIntervalsButton">
                    <i class="icon-refresh"></i> {lang('Update','mod_stats')}
                </button>
            </div>
        </div>
    </form>
</div>
