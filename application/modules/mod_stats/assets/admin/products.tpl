<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Stats', 'Stats')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back')}</span></a>
            </div>
        </div>
    </div>

    <div id="stats_products_container">

        <div id="diagram-container" class="span7">
            <svg style='height:550px'/>
        </div>

        <!--div id="options-container" class="span4">
            <select id="stat_brands_list" class="stats_select" multiple="multiple">
                {foreach $brands as $brand}
                    <option value="{$brand.id}">{$brand.name}</option>
                {/foreach}
            </select>
        </div-->

    </div>

</section>