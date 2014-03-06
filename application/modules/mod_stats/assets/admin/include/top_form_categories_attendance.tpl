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
                <span class="span3 d-i_b m-r_10" style="margin-left: 30px !important;">
                <select name='category_id'>
                    {foreach $categories as $categoryData}
                        {$level = count($categoryData['full_path_ids'])}
                        <option value='{$categoryData['id']}' {if $category_id == $categoryData['id']} selected="selected" {/if}>
                            {for $i = 0; $i < $level; $i++}
                                -
                            {/for} 
                            {$categoryData['name']}
                        </option>
                    {/foreach}
                </select>
            </span>
            <span class="frame_label no_connection">
                <span class="niceCheck b_n">
                    <input type="checkbox" name="include_childs" {if $includeChilds == 1} checked="checked"{/if}/>
                </span>
                {lang('Include childs','mod_stats')}
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
        </div>

        <!--div class="view_type">
            <label>
                <input type="radio" name="view_type" value="table" {if $_GET['view_type'] == 'table' || !isset($_GET['view_type'])}checked="checked"{/if} />
        {lang('Table','mod_stats')}
    </label>
    <label>
        <input type="radio" name="view_type" value="chart" {if $_GET['view_type'] == 'chart'}checked="checked"{/if} />
        {lang('Chart','mod_stats')}
    </label>
</div-->
    </form>
</div>
