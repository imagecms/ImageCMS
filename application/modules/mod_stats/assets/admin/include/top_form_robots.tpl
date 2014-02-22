<script>
    var currency = '{$CS}'
</script>

<div class="">
    <form method="get">
        <div class="f-s_0 frame-panel-stat">
            <span class="d-i_b">
                <span class="d_b title-field">{lang('Period','mod_stats')}</span>
                <span class="d-i_b">
                    <label class="p_r w_95">
                        <input class="datepicker date_start maxDateForDataPicker" type="text" value="{if isset($_GET['date'])}{echo $_GET['date']}{else:}{echo date('Y-m-d',time()-(60*60*24*30))}{/if}" name="date" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off" >
                        <span class="icon-calendar"></span>
                    </label>
                </span>
                <button type="submit" class="btn btn-small btn-default" type="button" id="refreshIntervalsButton">
                    {lang('OK','mod_stats')}
                </button>
            </span>
            <span class="d-i_b">
                <span class="d_b title-field">{lang('Robots:','mod_stats')}</span>
                <label class="d-i_b p_r">
                    <select name='currentRobot'>
                        {foreach $robots as $key => $name}
                            <option value="{$key}" {if $currentRobot == $key} selected="selected" {/if}>{$name}</option>
                        {/foreach}
                    </select>
                </label>
            </span>
        </div>
    </form>
</div>
