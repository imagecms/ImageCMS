<section class="mini-layout mod_stats">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Stats', 'mod_stats')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'admin')}</span></a>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        {include_tpl('../left_block')}
        <div class="clearfix span9">
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

                    <div class="span6">
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
                    </div>
                    <div class="span4">
                        <label for='include_childs'>
                            <input type="checkbox" name="include_childs" {if $includeChilds == 1} checked="checked"{/if}/>
                            {lang('Include childs','mod_stats')}
                        </label>
                    </div>
                </form>
            </div>


            <svg class="cumulativeLineChartStats" data-from="categories/getCategoriesAttendanceData" style="height: 600px; width: 800px;"></svg>

        </div>
    </div>
</section>