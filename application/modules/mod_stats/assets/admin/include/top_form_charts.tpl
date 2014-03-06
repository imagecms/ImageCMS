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
                <span class="d_b title-field">{lang('Group by','mod_stats')}</span>
                <div class="btn-group" data-toggle="buttons-radio">
                    <button type="button" class="btn btn-default{if $_GET['group'] == 'day'} active{/if}" data-val="day" data-rel="[name='group']" data-btn-select>{lang('day','mod_stats')}</button>
                    <button type="button" class="btn btn-default{if $_GET['group'] == 'month' || !isset($_GET['group'])} active{/if}" data-val="month" data-rel="[name='group']" data-btn-select>{lang('month','mod_stats')}</button>
                    <button type="button" class="btn btn-default{if $_GET['group'] == 'year'} active{/if}" data-val="year" data-rel="[name='group']" data-btn-select>{lang('year','mod_stats')}</button>
                </div>
                <input type="hidden" name='group' value="{if $_GET['group'] == 'day'}day{/if}{if $_GET['group'] == 'month' || !isset($_GET['group'])}month{/if}{if $_GET['group'] == 'year'}year{/if}"/>
            </span>
            <span class="d-i_b">
                <span class="d_b title-field">{lang('Show','mod_stats')}</span>
                <div class="btn-group" data-toggle="buttons-radio">
                    <button type="button" class="btn btn-default{if $show_by == 'Count'} active{/if}" data-val="Count" data-rel="[name='show_by']" data-btn-select>{lang('Count', 'mod_stats')}</button>
                    <button type="button" class="btn btn-default{if $show_by == 'Price'} active{/if}" data-val="Price" data-rel="[name='show_by']" data-btn-select>{lang('Price', 'mod_stats')}</button>
                </div>
                <input type="hidden" name='show_by' value="{if $show_by == 'Count'}Count{/if}{if $show_by == 'Price'}Price{/if}"/>
            </span>
        </div>
    </form>
</div>
