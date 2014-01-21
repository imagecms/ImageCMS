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
            <!--<div id="chartContainer" class="span12" style="margin-left: 0 !important;">-->
            
            <svg class="mypiechart pieChartStats" data-from="products/getCategoriesData"></svg>
            <svg class="mypiechart barChartStats" data-from="products/getCategoriesData"></svg>
            <!--</div>-->
        </div>
    </div>
    
</section>
