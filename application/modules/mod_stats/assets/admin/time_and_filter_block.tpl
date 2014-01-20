<div class="btn-group  m-t_20 pull-left">
    <a class="btn btn-small intervalButton" data-group="day">{lang('day','mod_stats')}</a>
    <a class="btn btn-small intervalButton" data-group="month">{lang('month','mod_stats')}</a>
    <a class="btn btn-small intervalButton" data-group="year">{lang('year','mod_stats')}</a>       
</div>
<div class="m-t_20">
    <span class="d-i_b m-r_10 m-l_10">{lang('From:','mod_stats')}</span>
    <span class="d-i_b">
        <label class="p_r">
            <input class="datepicker date_start maxDateForDataPicker" type="text" value="{if $_COOKIE['start_date_input'] != null}{$_COOKIE['start_date_input']}{/if}" name="date_begin" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off" >
            <span class="icon-calendar"></span>
        </label>
    </span>
    <span class="d-i_b m-r_10 m-l_10">{lang('To:','mod_stats')}</span>
    <span class="d-i_b">
        <label class="d-i_b p_r">
            <input class="datepicker date_end" type="text" value="{if $_COOKIE['end_date_input'] != null}{$_COOKIE['end_date_input']}{/if}" name="date_end" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off" >
            <span class="icon-calendar"></span>
        </label>
    </span>
    <button class="btn btn-small m_t_-10" type="button" id="refreshIntervalsButton">
        <i class="icon-refresh"></i>
    </button>
    <div class="pull-right">
        {lang('Group by:','mod_stats')}
        <div class="d-i_b">
            <select id="selectGroupBy">
                <option value="day" {if $_COOKIE['group_by'] == 'day'}selected = "selected"{/if}>{lang('day','mod_stats')}</option>
                <!--option value="week" {if $_COOKIE['group_by'] == 'week'}selected = "selected"{/if}>{lang('week','mod_stats')}</option-->
                <option value="month" {if $_COOKIE['group_by'] == 'month'}selected = "selected"{/if}>{lang('month','mod_stats')}</option>
                <option value="year" {if $_COOKIE['group_by'] == 'year'}selected = "selected"{/if}>{lang('year','mod_stats')}</option>
            </select>
        </div>
    </div>

</div>
<hr class="m-t_5" />
