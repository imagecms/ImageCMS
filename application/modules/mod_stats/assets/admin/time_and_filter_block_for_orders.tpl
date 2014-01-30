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
        <div>
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

            <span class="d-i_b">
                {lang('Group by:','mod_stats')}
                <label class="d-i_b p_r">
                    <select id="selectGroupBy" name='group'>
                        <option value="day"{if $_GET['group'] == 'day'} selected="selected"{/if}>{lang('day','mod_stats')}</option>
                        <option value="month"{if $_GET['group'] == 'month' || !isset($_GET['group'])} selected="selected"{/if}>{lang('month','mod_stats')}</option>
                        <option value="year"{if $_GET['group'] == 'year'} selected="selected"{/if}>{lang('year','mod_stats')}</option>
                    </select>
                </label>
            </span>
            <div class="pull-right">
                <button type="submit" class="btn btn-small m_t_-10" type="button" id="refreshIntervalsButton">
                    <i class="icon-refresh"></i> {lang('Update','mod_stats')}
                </button>
            </div>
        </div>
        <hr/>
        <div class="view_type">
            <label>
                <input type="radio" name="view_type" value="table" {if $_GET['view_type'] == 'table'}checked="checked"{/if} />
                {lang('Table','mod_stats')}
            </label>
            <label>
                <input type="radio" name="view_type" value="chart" {if $_GET['view_type'] == 'chart'}checked="checked"{/if} />
                {lang('Chart','mod_stats')}
            </label>
        </div>
    </form>
</div>
