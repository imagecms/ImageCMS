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
           {include_tpl('../time_and_filter_block')}
            <svg class="mypiechart pieChartStats" data-from="search/getBrandsInSearchData" style="height: 700px;"></svg>
            <svg class="mypiechart barChartStats" data-from="search/getBrandsInSearchData" style="height: 600px;"></svg>
            <div class="chartBlock" style="display: none;">                                    
                <div class="span2 chartTypeSwitcher">
                    <div class="d-i_b">
                        <select id="selectChartType">
                            <option value="pieChart">{lang('pie', 'mod_stats')}   </option>
                            <option value="barChart">{lang('bar', 'mod_stats')}   </option>
                        </select>
                    </div>
                </div>
                <div id="pieChart" class="hideChart">
                    <svg style="height: 500px;"></svg>
                </div>
                <div id="barChart" class="hideChart span12" style="display: none;">
                    <svg style="height: 500px; width: 800px;"></svg>
                </div>
            </div>

        </div>
    </div>
</section>

